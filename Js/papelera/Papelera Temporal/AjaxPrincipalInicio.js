$(function () {
	$('.FechaHoraMinuto').datetimepicker({
		format: 'DD/MM/YYYY HH:mm',locale: 'ru',
		date: new Date()
	});
	
});
$(function () {
	$('.Fecha').datetimepicker({
		format: 'YYYY/MM/DD',locale: 'ru',
		date: new Date()
	});
	
});

function DescargarTablas(id,NombreDeArchivo){
	Loading();
	setTimeout(
		function(){
			var DivTabla = document.getElementById(id);
			if (typeof(DivTabla) != 'undefined' && DivTabla != null){
				var Tabla = DivTabla.getElementsByTagName("table");
				if (typeof(Tabla[0]) != 'undefined' && Tabla[0] != null){
					var LoadConfig = { raw:'true' };
					var workbook = XLSX.utils.table_to_book(document.getElementById(id),LoadConfig);
					//console.log(workbook);
					if(typeof require !== 'undefined') XLSX = require('xlsx');
					//var wopts = { bookType:'xlsx', bookSST:false, type:'binary', format_cell:'true' };
					var wopts = { format_cell:'true' };
					XLSX.writeFile(workbook, NombreDeArchivo+'.xlsx', wopts );
				}else{
					$.bootstrapGrowl("La Tabla No Existe,Cree La Tabla Para Poder Descargar.", {
						type: 'danger',//danger
						align: 'center',
						width: 'auto'
					});
				}
			}
			EndLoading();
		}, 100
	);
}

var Config = JSON.parse(`{
	"Elemento":"DNIBusqueda",
	"ElementoTexto":"BoltTextDNIBusqueda",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
var Config = JSON.parse(`{
	"Elemento":"Destinatario",
	"ElementoTexto":"BoltTextDestinatario",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
var Config = JSON.parse(`{
	"Elemento":"NumeroDePieza",
	"ElementoTexto":"BoltTextNumeroDePieza",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);

var pagina = 0;
filtro=["UserId","IdentificadorDeUsuario","time","NoMemory"];
filtroX=[UserId,UserId,time,NoMemory];
var Parametros = ArraidNameValueToJSON(filtro,filtroX);

var Indices=["0","1","2","3","4"];
var Objetos = ["NumeroDePieza","Desde","Hasta","Destinatario","DNIBusqueda"];
var ValoresDirectos = ArraidNameValueToJSON(Indices,Objetos);

filtro=["0","1","2","3","4","5","6","7","8","9"];
filtroX=["DatosDePieza","NumPiezaCorreo","ApellidoYNombre","DNI","Domicilio","EstadoPieza","FechaEstadoPieza","recibio","documento","vinculo"];
var ElementosDeEmergente = ArraidNameValueToJSON(filtro,filtroX);

var Config = JSON.parse(`{
	"RuCheckBox":true,
	"RuInicio":true,
	"ConFiltro":true,
	"RuFiltrado":false,
	"RuConPaginado":true,
	"DivPaginador":"DivPaginador",
	"RuMaximizeBox":true,
	"ElementoMaximoDeFilas": "CantidadDeResultadosEnTabla",
	"CheckBox":false,
	"MaximizeBox":true,
	"IdCheckBox":"marcacb",
	"TextoEnBotonEmergente":"Ver Datos De Pieza",
	"ElementosDeEmergente":` + ElementosDeEmergente + `,
	"IdentificadorDeEmergente":"IdPieza",
	"AjaxDeEmergente":"` + URLJS + `XMLHttpRequest/AjaxGetEstadosDePiezas.php",
	
	"ValoresDirectos":` + ValoresDirectos + `,
	"Select":"ConfigContainer",
	"Tabla":"TablaDeResultados",
	"DivDeTabla":"MainTabla",
	"hidden":false,
	"shortT":false,
	"Scaner":true,
	"MaximizeElement":"MaximizeBox",
	"TextoCheckbox":"",
	"Pagina":"` + pagina + `",
	"DataAjax":` + Parametros + `,
	"Retorno":"Limpiar Tabla",
	"Ajax":"` + URLJS + `XMLHttpRequest/AjaxGetPiezas.php"
	
}`);
//"Ajax":"` + "../../" + `XMLHttpRequest/AjaxGetPiezas.php"
//alert( window.location.pathname.substring( 0 , window.location.pathname.indexOf("/",1) + 1 ));
//alert(window.location.origin +""+ window.location.pathname.substring(window.location.pathname.indexOf("/", window.location.pathname.indexOf("/") - 1)));
//alert(window.location.origin +""+ window.location.pathname.substring(window.location.pathname.indexOf("/", window.location.pathname.indexOf("/") - 1) + 1));
RuTablaDesdeSelect(Config);


function DescargarReporteCompleto(){
	filtro=["UserId","time","NoMemory"];
	filtroX=[UserId,time,NoMemory];
	var Parametros = ArraidNameValueToJSON(filtro,filtroX);
	var NombreDelFichero = "Reporte";
	
	var Indices=["0","1","2","3","4"];
	var Objetos = ["NumeroDePieza","Desde","Hasta","Destinatario","DNIBusqueda"];
	var ValoresDirectos = ArraidNameValueToJSON(Indices,Objetos);
	
	var Config = JSON.parse(`{
		"exel":true,
		"txt":true,
		"Folder":"ConsultasClientes/",
		"NombreDelFichero":"` + NombreDelFichero + `",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + URLJS + `ConsultasClientes/AjaxGetAllPiezas.php"
	}`);
	AjaxConsultaYDescargaArchivo(Config);
}

function DescargarReporteCompletoUltimosEstados(){
	filtro=["UserId","time","NoMemory"];
	filtroX=[UserId,time,NoMemory];
	var Parametros = ArraidNameValueToJSON(filtro,filtroX);
	var NombreDelFichero = "Reporte";
	
	var Indices=["0","1","2","3","4"];
	var Objetos = ["NumeroDePieza","Desde","Hasta","Destinatario","DNIBusqueda"];
	var ValoresDirectos = ArraidNameValueToJSON(Indices,Objetos);
	
	var Config = JSON.parse(`{
		"exel":true,
		"txt":true,
		"Folder":"ConsultasClientes/",
		"NombreDelFichero":"` + NombreDelFichero + `",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + URLJS + `ConsultasClientes/AjaxGetAllPiezasUltimosEstados.php"
	}`);
	AjaxConsultaYDescargaArchivo(Config);
}


function BuscarResultados(){
	var pagina = 0;
	//,"NumeroDePieza","Desde","Hasta","Destinatario","DNIBusqueda",
	//,NumeroDePieza.value,Desde.value,Hasta.value,Destinatario.value,DNIBusqueda.value,
	
	filtro=["UserId","IdentificadorDeUsuario","time","NoMemory"];
	filtroX=[UserId,UserId,time,NoMemory];
	var Parametros = ArraidNameValueToJSON(filtro,filtroX);
	
	var Indices=["0","1","2","3","4"];
	var Objetos = ["NumeroDePieza","Desde","Hasta","Destinatario","DNIBusqueda"];
	var ValoresDirectos = ArraidNameValueToJSON(Indices,Objetos);
	
	filtro=["0","1","2","3","4","5","6","7","8","9"];//,"NumeroDePieza","Desde","Hasta","Destinatario","DNIBusqueda"
	filtroX=["DatosDePieza","NumPiezaCorreo","ApellidoYNombre","DNI","Domicilio","EstadoPieza","FechaEstadoPieza","recibio","documento","vinculo"];//NumeroDePieza.value,Desde.value,Hasta.value,Destinatario.value,DNIBusqueda.value,
	var ElementosDeEmergente = ArraidNameValueToJSON(filtro,filtroX);

	var Config = JSON.parse(`{
		"RuCheckBox":true,
		"RuInicio":true,
		"ConFiltro":true,
		"RuFiltrado":false,
		"RuConPaginado":true,
		"DivPaginador":"DivPaginador",
		"RuMaximizeBox":true,
		"ElementoMaximoDeFilas": "CantidadDeResultadosEnTabla",
		"CheckBox":false,
		"MaximizeBox":true,
		"IdCheckBox":"marcacb",
		"TextoEnBotonEmergente":"Ver Datos De Pieza",
		"ElementosDeEmergente":` + ElementosDeEmergente + `,
		"IdentificadorDeEmergente":"IdPieza",
		"AjaxDeEmergente":"` + URLJS + `ConsultasClientes/AjaxGetEstadosDePiezas.php",
		
		"ValoresDirectos":` + ValoresDirectos + `,
		"Select":"ConfigContainer",
		"Tabla":"TablaDeResultados",
		"DivDeTabla":"MainTabla",
		"hidden":false,
		"shortT":false,
		"Scaner":true,
		"MaximizeElement":"MaximizeBox",
		"TextoCheckbox":"",
		"Pagina":"` + pagina + `",
		"DataAjax":` + Parametros + `,
		"Retorno":"Limpiar Tabla",
		"Ajax":"` + URLJS + `ConsultasClientes/AjaxGetPiezas.php"
	}`);
	RuTablaBoton(Config);
}
jQuery(document).ready(function() {
	$("#SalirDeModal").on("click", function () {
		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('hide');
		//alert("Exec");
	});
});