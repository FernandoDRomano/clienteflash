//Establecer titulo de la página
document.title = "Piezas | Clientes";

// Variables globales
let PIEZAS_ESTADOS = [];

//Fecha y hora actual para inputs tipo datetime-local
const date = new Date();
let [month, day, year] = [date.getMonth(), date.getDate(), date.getFullYear()];
month = month + 1;

const FechaDesde = document.getElementById("FechaDesde");
const FechaHasta = document.getElementById("FechaHasta");

//Fecha actual
const fechaActual = `${year}-${month}-${day}`;

/* PICKADATE */
$(".datepicker").pickadate({
  // Strings and translations
  monthsFull: [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ],
  monthsShort: [
    "Ene",
    "Feb",
    "Mar",
    "Abr",
    "May",
    "Jun",
    "Jul",
    "Ago",
    "Sep",
    "Oct",
    "Nov",
    "Dic",
  ],
  weekdaysFull: [
    "Domingo",
    "Lunes",
    "Martes",
    "Miércoles",
    "Jueves",
    "Viernes",
    "Sábado",
  ],
  weekdaysShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],

  // Buttons
  today: "Hoy",
  clear: "Borrar",
  close: "Cerrar",

  // Accessibility labels
  //selectMonths: true,
  //selectYears: true,
  labelMonthNext: "Siguiente Mes",
  labelMonthPrev: "Previo Mes",
  labelMonthSelect: "Seleccione un Mes",
  labelYearSelect: "Selecciones un Año",

  // Format
  firstDay: 1,
  //format:"dddd d !de mmmm !de yyyy",
  format: "yyyy-mm-dd",
  formatSubmit: "yyyy-mm-dd",

  // Close on a user action
  closeOnSelect: true,
  closeOnClear: true,

  max: fechaActual,
});

//DATATABLE
const tablePiezas = $("#TablaSolicitudes").DataTable({
  language: { 
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  },
  scrollX: true,

  initComplete: function () {
    const api = this.api();
    
    // Crear el footer con celdas para cada columna
    const footer = $(api.table().footer());
    
    console.log('Footer encontrado:', footer.length);
    
    const row = $('<tr></tr>');
    
    // Crear una celda th para cada columna
    api.columns().every(function (index) {
      const column = this;
      const title = $(column.header()).text();
      
      // Crear celda con input de búsqueda
      const th = $('<th></th>');
      const input = $('<input type="text" placeholder="Buscar ' + title + '" style="width: 100%; padding: 5px;" class="form-control form-control-sm" />');
      
      // Agregar evento de búsqueda
      input.on('keyup change clear', function () {
        if (column.search() !== this.value) {
          column.search(this.value).draw();
        }
      });
      
      th.append(input);
      row.append(th);
    });
    
    footer.empty().append(row);
    console.log('Filtros creados. Total columnas:', api.columns().count());
  },
});

const tablaEstados = $("#tabla-estados").DataTable({
  language: { 
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  },
  scrollX: true,
  order: [], // Deshabilita el orden inicial
});


function mostrarError(msj) {
  const alertError = `
                <div class="alert alert-danger alert-dismissible fade show alert-centrado" role="alert" id="alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    ${msj} 
                </div>
            `;

  setTimeout(() => {
    document.getElementById("alert-danger").remove();
  }, 1500);

  document.getElementById("body").insertAdjacentHTML("afterbegin", alertError);
}

function verificar() {
  if (
    $("#BarcodeExterno").val().trim().length == 0 &&
    $("#FechaDesde").val().trim().length == 0 &&
    $("#FechaHasta").val().trim().length == 0
  ) {
    mostrarError(
      "Debe seleccionar un rango de fechas o ingresar el número de pieza"
    );
    return;
  }

  search();
}

async function verificarSispo() {
  if (
    $("#BarcodeExterno").val().trim().length == 0 &&
    $("#FechaDesde").val().trim().length == 0 &&
    $("#FechaHasta").val().trim().length == 0
  ) {
    mostrarError(
      "Debe seleccionar un rango de fechas o ingresar el número de pieza"
    );
    return;
  }

  // Comentado
  // searchSispo();

  try {
    await buscarPiezasEstadosSispo();
  } catch (error) {
    console.error("Error al verificar Sispo:", error);
  }
}

async function buscarPiezasEstadosSispo() {
  Loading();
  try {
    tablePiezas.clear().draw();
    PIEZAS_ESTADOS = []
    
    const data = {
      BarcodeExterno: $("#BarcodeExterno").val(),
      Documento: $("#Documento").val(),
      ApellidoYNombre: $("#ApellidoYNombre").val(),
      FechaI: $("#FechaDesde").val(),
      FechaF: $("#FechaHasta").val(),
      UserId: USER_ID,
      ClienteId: CLIENTE_ID,
    };

    const response = await fetch(
      "/XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasEstadosSispo.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    );

    const result = await response.json();

    if (result.status === "success") {
      PIEZAS_ESTADOS = result.data;

      if (PIEZAS_ESTADOS.length === 0) {
        mostrarError(
          "No se encontraron piezas para los criterios de búsqueda."
        );
        return;
      }

      PIEZAS_ESTADOS.forEach((pieza) => {
        const boton = `<button class="btn btn-block btn-secondary" onclick="buscarDetallesDePiezasSispo(${pieza.pieza_id})">Ver Datos De Pieza</button>`;
        
        const fila = [
          pieza.pieza_id,
          pieza.barcode_externo,
          pieza.sucursal,
          pieza.destinatario,
          pieza.direccion,
          pieza.cp,
          pieza.localidad,
          pieza.estado_actual,
          pieza.fecha_estado_actual,
          // pieza.cantidad_gestiones,
          pieza.ingreso_logico,
          pieza.fecha_ingreso_logico,
          pieza.ingreso_fisico,
          pieza.fecha_ingreso_fisico,
          pieza.enviado_a_1,
          pieza.fecha_enviado_a_1,
          pieza.recibido_en_1,
          pieza.fecha_recibido_en_1,
          pieza.enviado_a_2,
          pieza.fecha_enviado_a_2,
          pieza.recibido_en_2,
          pieza.fecha_recibido_en_2,
          pieza.fecha_1_distribucion,
          pieza.resultado_1_distribucion,
          pieza.fecha_resultado_1_distribucion,
          pieza.fecha_2_distribucion,
          pieza.resultado_2_distribucion,
          pieza.fecha_resultado_2_distribucion,
          pieza.fecha_3_distribucion,
          pieza.resultado_3_distribucion,
          pieza.fecha_resultado_3_distribucion,
          pieza.ultima_novedad,
          pieza.fecha_ultima_novedad,
          // pieza.documento,
          // pieza.recibio,
          // pieza.vinculo,
          pieza.existe_foto_acuse,
          boton
        ];

        
        tablePiezas.row.add(fila);
      });

      tablePiezas.draw(false);
      console.log("Datos cargados en la tabla.");
    } else {
      console.error("Error al obtener las piezas del cliente:", result.message);
      mostrarError("Error al obtener las piezas del cliente.");
    }
  } catch (error) {
    console.error("Error al obtener las piezas del cliente:", error);
  } finally {
    EndLoading();
  }
}

async function buscarDetallesDePiezasSispo(piezaId) {
  Loading();

  tablaEstados.clear().draw();
  document.getElementById("contenedor-acuse").classList.add("d-none");

  try {
    const data = {
      PiezaId: piezaId,
      UserId: USER_ID,
      ClienteId: CLIENTE_ID,
    };

    const response = await fetch("/XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePiezaSispo.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }
    );

    const result = await response.json();

    if (result.status === "success") {
      const pieza = result.data;
      console.log("Detalles de la pieza:", pieza);
      document.getElementById("DetalleDePiezaActual").innerHTML = pieza.pieza_id;

      document.getElementById("EstadosDePiezasApellidoYNombre").value = pieza.destinatario;
      document.getElementById("EstadosDePiezasDocumento").value = pieza.documento;
      document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = pieza.direccion;
      document.getElementById("EstadosDePiezasCodigoExterno").value = pieza.barcode_externo;
      document.getElementById("EstadosDePiezasUltimoEstado").value = pieza.ultimo_estado;
      document.getElementById("EstadosDePiezasFechaUltimoEstado").value = pieza.fecha_ultimo_estado;
      document.getElementById("EstadosDePiezasRecibió").value = pieza.recibio;
      document.getElementById("EstadosDePiezasVínculo").value = pieza.vinculo;

      if (pieza.existe_foto_acuse && pieza.existe_foto_acuse == "Sí") {
        document.getElementById("FotoAndroid").src = `https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/${pieza.foto_acuse}`;
        document.getElementById("contenedor-acuse").classList.remove("d-none");
      }

      pieza.estados.forEach((estado) => {
        const fila = [
          estado.estado,
          estado.fecha
        ];
        tablaEstados.row.add(fila);
      });

      tablaEstados.draw(false);

      // Mostrar el modal
      $("#ModalDatos").modal("show");
      
      // Recalcular anchos de columnas después de que el modal esté visible
      $('#ModalDatos').on('shown.bs.modal', function () {
        tablaEstados.columns.adjust().draw(false);
      });

    } else {
      console.error("Error al obtener los detalles de la pieza:",result.message);
      mostrarError("Error al obtener los detalles de la pieza.");
    }
  } catch (error) {
    console.error("Error al obtener los detalles de la pieza:", error);
  } finally {
    EndLoading();
  }
}

// var Config = JSON.parse(`{
// 		"Elemento":"BarcodeExterno",
// 		"ElementoTexto":"BoltTextBarcodeExterno",
// 		"DigitosMinimos":"1",
// 		"TextoInicial":"",
// 		"TextoMenor":""
// 	}`);
// 	Texto(Config);
// 	var Config = JSON.parse(`{
// 		"Elemento":"Documento",
// 		"ElementoTexto":"BoltTextDocumento",
// 		"DigitosMinimos":"1",
// 		"TextoInicial":"",
// 		"TextoMenor":""
// 	}`);
// 	Texto(Config);
// 	var Config = JSON.parse(`{
// 		"Elemento":"ApellidoYNombre",
// 		"ElementoTexto":"BoltTextApellidoYNombre",
// 		"DigitosMinimos":"1",
// 		"TextoInicial":"",
// 		"TextoMenor":""
// 	}`);
// 	Texto(Config);

jQuery(document).ready(function () {
  $("#SalirDeModal").on("click", function () {
    $(".ModalDatos").fadeOut("slow");
    $("#ModalDatos").modal("hide");
    //alert("Exec");
  });
  $("#SalirDeModal2").on("click", function () {
    $(".ModalDatos").fadeOut("slow");
    $("#ModalDatos").modal("hide");
    //alert("Exec");
  });
});

function Buscar() {
  filtro = ["User", "time", "UserId"];
  filtroX = ["1", Math.random(), UserId];
  var Parametros = ArraydsAJson(filtro, filtroX);
  Parametros = JSON.stringify(Parametros); // Manda Como Texto

  var Indices = [
    "BarcodeExterno",
    "Documento",
    "ApellidoYNombre",
    "FechaI",
    "FechaF",
  ];
  var Objetos = [
    "BarcodeExterno",
    "Documento",
    "ApellidoYNombre",
    "FechaDesde",
    "FechaHasta",
  ];
  var ValoresDirectos = ArraydsAJson(Indices, Objetos); //Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

  var EsconderElementos = ["1", "14", "15"];

  var Config = JSON.parse(
    `
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezas",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` +
      EsconderElementos +
      `],
			
			"DataAjax":` +
      Parametros +
      `,
			"ValoresDirectos":` +
      ValoresDirectos +
      `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` +
      URLJS +
      `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasSolicitadasPorCliente.php"
			
		}`
  );

  TablaDesdeConsulta(Config);
}

function Reporte() {
  var Documento = $("#Documento").val();
  var ApellidoYNombre = $("#ApellidoYNombre").val();
  var FechaDesde = $("#FechaDesde").val();
  var FechaHasta = $("#FechaHasta").val();
  var BarcodeExterno = $("#BarcodeExterno").val();

  location.href =
    "http://clienteflash.sppflash.com.ar/reporte.php?UserId=" +
    UserId +
    "&ApellidoYNombre=" +
    ApellidoYNombre +
    "&FechaDesde=" +
    FechaDesde +
    "&FechaHasta=" +
    FechaHasta +
    "&BarcodeExterno=" +
    BarcodeExterno +
    "&Documento=" +
    Documento;
}

function VerDetallesDePiezas(e) {
  var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;

  $(".ModalDatos").fadeOut("slow");
  $("#ModalDatos").modal("show");
  console.log(DivDeTabla.Config.Resultado[e.Data][0]);
  document.getElementById("DetalleDePiezaActual").innerHTML =
    DivDeTabla.Config.Resultado[e.Data][0];

  filtro = ["User", "time", "PiezaId"];
  filtroX = ["1", Math.random(), DivDeTabla.Config.Resultado[e.Data][0]];
  var Parametros = ArraydsAJson(filtro, filtroX);
  Parametros = JSON.stringify(Parametros); // Manda Como Texto

  document.getElementById("EstadosDePiezasApellidoYNombre").value =
    DivDeTabla.Config.Resultado[e.Data][4];
  document.getElementById("EstadosDePiezasDocumento").value =
    DivDeTabla.Config.Resultado[e.Data][5];
  document.getElementById("EstadosDePiezasDirecciónDeEntrega").value =
    DivDeTabla.Config.Resultado[e.Data][11];
  document.getElementById("EstadosDePiezasCodigoExterno").value =
    DivDeTabla.Config.Resultado[e.Data][1];
  document.getElementById("EstadosDePiezasUltimoEstado").value =
    DivDeTabla.Config.Resultado[e.Data][8];
  document.getElementById("EstadosDePiezasFechaUltimoEstado").value =
    DivDeTabla.Config.Resultado[e.Data][9];
  document.getElementById("EstadosDePiezasRecibió").value =
    DivDeTabla.Config.Resultado[e.Data][12];
  document.getElementById("EstadosDePiezasVínculo").value =
    DivDeTabla.Config.Resultado[e.Data][13];

  if (DivDeTabla.Config.Resultado[e.Data][15] != "") {
    // o 15???
    document.getElementById("FotoAndroid").src =
      "https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/" +
      DivDeTabla.Config.Resultado[e.Data][15];
    document.getElementById("FotoAndroidSpp").src =
      "https://sispo.sppflash.com.ar/image/" +
      DivDeTabla.Config.Resultado[e.Data][15];
  } else {
    document.getElementById("FotoAndroid").src = "";
    document.getElementById("FotoAndroidSpp").src = "";
  }

  var Config = JSON.parse(
    `
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` +
      Parametros +
      `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` +
      URLJS +
      `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePieza.php"
			
		}`
  );

  TablaDesdeConsulta(Config);
}

function searchSispo() {
  filtro = ["User", "time", "UserId"];
  filtroX = ["1", Math.random(), UserId];
  var Parametros = ArraydsAJson(filtro, filtroX);
  Parametros = JSON.stringify(Parametros); // Manda Como Texto

  var Indices = [
    "BarcodeExterno",
    "Documento",
    "ApellidoYNombre",
    "FechaI",
    "FechaF",
  ];
  var Objetos = [
    "BarcodeExterno",
    "Documento",
    "ApellidoYNombre",
    "FechaDesde",
    "FechaHasta",
  ];
  var ValoresDirectos = ArraydsAJson(Indices, Objetos); //Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

  var EsconderElementos = ["9", "33", "34", "35", "36"];

  //
  var Config = JSON.parse(
    `
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezasSispo",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` +
      EsconderElementos +
      `],
			"DataAjax":` +
      Parametros +
      `,
			"ValoresDirectos":` +
      ValoresDirectos +
      `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` +
      URLJS +
      `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasEstadosSispo.php"
			
		}`
  );

  TablaDesdeConsulta(Config);
}

function VerDetallesDePiezasSispo(e) {
  var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;

  $(".ModalDatos").fadeOut("slow");
  $("#ModalDatos").modal("show");
  console.log(DivDeTabla.Config.Resultado[e.Data][0]);
  document.getElementById("DetalleDePiezaActual").innerHTML =
    DivDeTabla.Config.Resultado[e.Data][0];

  filtro = ["User", "time", "PiezaId"];
  filtroX = ["1", Math.random(), DivDeTabla.Config.Resultado[e.Data][0]];
  var Parametros = ArraydsAJson(filtro, filtroX);
  Parametros = JSON.stringify(Parametros); // Manda Como Texto

  document.getElementById("EstadosDePiezasApellidoYNombre").value =
    DivDeTabla.Config.Resultado[e.Data][3];
  document.getElementById("EstadosDePiezasDocumento").value =
    DivDeTabla.Config.Resultado[e.Data][33];
  document.getElementById("EstadosDePiezasDirecciónDeEntrega").value =
    DivDeTabla.Config.Resultado[e.Data][4];
  document.getElementById("EstadosDePiezasCodigoExterno").value =
    DivDeTabla.Config.Resultado[e.Data][1];
  document.getElementById("EstadosDePiezasUltimoEstado").value =
    DivDeTabla.Config.Resultado[e.Data][7];
  document.getElementById("EstadosDePiezasFechaUltimoEstado").value =
    DivDeTabla.Config.Resultado[e.Data][8];
  document.getElementById("EstadosDePiezasRecibió").value =
    DivDeTabla.Config.Resultado[e.Data][34]; //?
  document.getElementById("EstadosDePiezasVínculo").value =
    DivDeTabla.Config.Resultado[e.Data][35]; //?

  if (DivDeTabla.Config.Resultado[e.Data][36] != "") {
    document.getElementById("FotoAndroid").src =
      "https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/" +
      DivDeTabla.Config.Resultado[e.Data][36];
    document.getElementById("FotoAndroidSpp").src =
      "https://sispo.sppflash.com.ar/image/" +
      DivDeTabla.Config.Resultado[e.Data][36];
  } else {
    document.getElementById("FotoAndroid").src = "";
    document.getElementById("FotoAndroidSpp").src = "";
  }

  var Config = JSON.parse(
    `
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` +
      Parametros +
      `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` +
      URLJS +
      `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePiezaSispo.php"
			
		}`
  );
  TablaDesdeConsulta(Config);
}

function search() {
  filtro = ["User", "time", "UserId"];
  filtroX = ["1", Math.random(), UserId];
  var Parametros = ArraydsAJson(filtro, filtroX);
  Parametros = JSON.stringify(Parametros); // Manda Como Texto

  var Indices = [
    "BarcodeExterno",
    "Documento",
    "ApellidoYNombre",
    "FechaI",
    "FechaF",
  ];
  var Objetos = [
    "BarcodeExterno",
    "Documento",
    "ApellidoYNombre",
    "FechaDesde",
    "FechaHasta",
  ];
  var ValoresDirectos = ArraydsAJson(Indices, Objetos); //Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

  var EsconderElementos = ["9", "33", "34", "35", "36"];

  //
  var Config = JSON.parse(
    `
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezas2",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` +
      EsconderElementos +
      `],
			"DataAjax":` +
      Parametros +
      `,
			"ValoresDirectos":` +
      ValoresDirectos +
      `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` +
      URLJS +
      `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasEstados.php"
			
		}`
  );

  TablaDesdeConsulta(Config);
}

function VerDetallesDePiezas2(e) {
  var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;

  $(".ModalDatos").fadeOut("slow");
  $("#ModalDatos").modal("show");
  console.log(DivDeTabla.Config.Resultado[e.Data][0]);
  document.getElementById("DetalleDePiezaActual").innerHTML =
    DivDeTabla.Config.Resultado[e.Data][0];

  filtro = ["User", "time", "PiezaId"];
  filtroX = ["1", Math.random(), DivDeTabla.Config.Resultado[e.Data][0]];
  var Parametros = ArraydsAJson(filtro, filtroX);
  Parametros = JSON.stringify(Parametros); // Manda Como Texto

  document.getElementById("EstadosDePiezasApellidoYNombre").value =
    DivDeTabla.Config.Resultado[e.Data][3];
  document.getElementById("EstadosDePiezasDocumento").value =
    DivDeTabla.Config.Resultado[e.Data][33];
  document.getElementById("EstadosDePiezasDirecciónDeEntrega").value =
    DivDeTabla.Config.Resultado[e.Data][4];
  document.getElementById("EstadosDePiezasCodigoExterno").value =
    DivDeTabla.Config.Resultado[e.Data][1];
  document.getElementById("EstadosDePiezasUltimoEstado").value =
    DivDeTabla.Config.Resultado[e.Data][7];
  document.getElementById("EstadosDePiezasFechaUltimoEstado").value =
    DivDeTabla.Config.Resultado[e.Data][8];
  document.getElementById("EstadosDePiezasRecibió").value =
    DivDeTabla.Config.Resultado[e.Data][34]; //?
  document.getElementById("EstadosDePiezasVínculo").value =
    DivDeTabla.Config.Resultado[e.Data][35]; //?

  if (DivDeTabla.Config.Resultado[e.Data][36] != "") {
    document.getElementById("FotoAndroid").src =
      "https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/" +
      DivDeTabla.Config.Resultado[e.Data][36];
    document.getElementById("FotoAndroidSpp").src =
      "https://sispo.sppflash.com.ar/image/" +
      DivDeTabla.Config.Resultado[e.Data][36];
  } else {
    document.getElementById("FotoAndroid").src = "";
    document.getElementById("FotoAndroidSpp").src = "";
  }

  var Config = JSON.parse(
    `
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` +
      Parametros +
      `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` +
      URLJS +
      `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePieza.php"
			
		}`
  );

  TablaDesdeConsulta(Config);
}

function Reporte2() {
  console.log("Empezando la descarga");

  var Documento = $("#Documento").val();
  var ApellidoYNombre = $("#ApellidoYNombre").val();
  var FechaDesde = $("#FechaDesde").val();
  var FechaHasta = $("#FechaHasta").val();
  var BarcodeExterno = $("#BarcodeExterno").val();

  const urlExportar = 
    URLJS +
    "XMLHttpRequest/clientepiezassolicitadas/reporteIntraSispo.php?UserId=" +
    UserId +
    "&ApellidoYNombre=" +
    ApellidoYNombre +
    "&FechaI=" +
    FechaDesde +
    "&FechaF=" +
    FechaHasta +
    "&BarcodeExterno=" +
    BarcodeExterno +
    "&Documento=" +
    Documento;

  console.log("URL de exportación:", urlExportar);

  location.href = urlExportar
  console.log("Termino la descarga");
}

async function exportarCSVTabla(){
  try {
    const csvHeaders = [
      'Id Pieza',
      'Barcode externo',
      'Sucursal',
      'Destinatario',
      'Dirección de Entrega',  
      'CP',
      'Localidad',
      'Estado Actual',
      'Fecha Estado Actual',
      'Ingreso Lógico',
      'Fecha Ingreso Lógico',
      'Ingreso Físico',
      'Fecha Ingreso Físico',
      'Enviado a (1)',
      'Fecha Enviado a (1)',
      'Recibido en (1)',
      'Fecha Recibido en (1)',
      'Enviado a (2)',
      'Fecha Enviado a (2)',
      'Recibido en (2)',
      'Fecha Recibido en (2)',
      'Fecha 1ª Distribución',
      'Resultado 1ª Distribución',
      'Fecha Resultado 1ª Distribución',
      'Fecha 2ª Distribución',
      'Resultado 2ª Distribución',
      'Fecha Resultado 2ª Distribución',
      'Fecha 3ª Distribución',
      'Resultado 3ª Distribución',
      'Fecha Resultado 3ª Distribución',
      'Última Novedad',
      'Fecha Última Novedad',
      'Foto Acuse Disponible'
    ];

    const csvRows = [];
    csvRows.push(csvHeaders.join(','));

    PIEZAS_ESTADOS.forEach(pieza => {
      const row = [
        pieza.pieza_id,
        pieza.barcode_externo,
        pieza.sucursal,
        pieza.destinatario,
        pieza.direccion,
        pieza.cp,
        pieza.localidad,
        pieza.estado_actual,
        pieza.fecha_estado_actual,
        pieza.ingreso_logico,
        pieza.fecha_ingreso_logico,
        pieza.ingreso_fisico,
        pieza.fecha_ingreso_fisico,
        pieza.enviado_a_1,
        pieza.fecha_enviado_a_1,
        pieza.recibido_en_1,
        pieza.fecha_recibido_en_1,
        pieza.enviado_a_2,
        pieza.fecha_enviado_a_2,
        pieza.recibido_en_2,
        pieza.fecha_recibido_en_2,
        pieza.fecha_1_distribucion,
        pieza.resultado_1_distribucion,
        pieza.fecha_resultado_1_distribucion,
        pieza.fecha_2_distribucion,
        pieza.resultado_2_distribucion,
        pieza.fecha_resultado_2_distribucion,
        pieza.fecha_3_distribucion,
        pieza.resultado_3_distribucion,
        pieza.fecha_resultado_3_distribucion,
        pieza.ultima_novedad,
        pieza.fecha_ultima_novedad,
        pieza.existe_foto_acuse
      ];
      csvRows.push(row.map(value => `"${value}"`).join(','));
    });

    const csvContent = csvRows.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', 'Piezas Estados.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);    

  } catch (error) {
    console.error("Error al exportar CSV:", error);
  } 
}

