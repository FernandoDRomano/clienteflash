//Establecer titulo de la página
document.title = "Autorizar Cartas de Documento - Clientes";

//Deshabilitar click derecho
document.addEventListener('contextmenu', event => event.preventDefault());

$('[data-toggle="tooltip"]').tooltip();

//Cargar usuarios del cliente para el select
getUsuariosCliente();

$(document).ready(function() {
    // Inicializar Select2
    $('.select-2').select2({
        theme: 'bootstrap4',
        language: "es",
    });
});

let CARTAS_DOCUMENTOS = [];

//Fecha y hora actual para inputs tipo datetime-local
const date = new Date();
let [month, day, year] = [date.getMonth(), date.getDate(), date.getFullYear()];
month = month + 1;

const FechaDesde = document.getElementById("FechaDesde")
const FechaHasta = document.getElementById("FechaHasta")

//Fecha actual
const fechaActual = `${year}-${month}-${day}`

/* PICKADATE */
$('.datepicker').pickadate({
    // Strings and translations
    monthsFull: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    weekdaysFull: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    weekdaysShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],

    // Buttons
    today: "Hoy",
    clear: "Borrar",
    close: "Cerrar",

    // Accessibility labels
    //selectMonths: true,
    //selectYears: true,
    labelMonthNext: 'Siguiente Mes',
    labelMonthPrev: 'Previo Mes',
    labelMonthSelect: 'Seleccione un Mes',
    labelYearSelect: 'Selecciones un Año',

    // Format
    firstDay: 1,
    //format:"dddd d !de mmmm !de yyyy",
    format: "yyyy-mm-dd",
    formatSubmit: "yyyy-mm-dd",

    // Close on a user action
    closeOnSelect: true,
    closeOnClear: true,

    max: fechaActual,
})

//Inicializar datatables 
const tableCD = $('#tabla-cd').DataTable({
    "order": [], // Deshabilita el orden inicial
    "ordering": true, // Habilita el ordenamiento
    "scrollX": true, // Habilita el scroll horizontal
    "pageLength": 25, // Muestra 25 elementos por página por defecto
    "language": { // Configuración de la traducción al español
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
    "createdRow": function(row, data, dataIndex) {
        $(row).attr('id', `${data[0]}`);
    },
    "columnDefs": [
        // Ocultar la columna del ID
        {
            "targets": [0],
            "visible": false,
            "searchable": false
        }
    ]
})

async function getUsuariosCliente() {
    Loading();
    try {
        const data = {
            userId: USER_ID,
            clientId: CLIENTE_ID,
            perfilId: PERFIL_USUARIO
        }

        const response = await fetch('/XMLHttpRequest/PedidoDeEnvio/AjaxGetUsuariosCliente.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.status === "success") {
            const usuarios = result.data;
            const usuarioSelect = document.getElementById("UsuarioCartaDocumento");

            usuarios.forEach(usuario => {
                const option = document.createElement("option");
                option.value = usuario.id;
                option.text = usuario.username;
                usuarioSelect.appendChild(option);
            });

            // Actualizar Select2 después de agregar las opciones
            $('#UsuarioCartaDocumento').trigger('change');
        } else {
            console.error("Error al obtener los usuarios del cliente:", result.message);
        }
    } catch (error) {
        console.error("Error al obtener los usuarios del cliente:", error);
    } finally {
        EndLoading();
    }
}

async function buscarCartasDocumentos(event) {
    event.preventDefault();
    
    if(!validarFiltros()) {
        return;
    }

    Loading();
    try {
        tableCD.clear().draw(); // Limpiar la tabla antes de agregar nuevos datos

        const fechaDesde = document.getElementById("FechaDesde").value;
        const fechaHasta = document.getElementById("FechaHasta").value;
        const usuarioCD = document.getElementById("UsuarioCartaDocumento").value;
        const estadoCD = document.getElementById("EstadoCartaDocumento").value;

        const data = {
            userId: USER_ID,
            clientId: CLIENTE_ID,
            perfilId: PERFIL_USUARIO,
            fechaDesde: fechaDesde,
            fechaHasta: fechaHasta,
            usuarioCD: usuarioCD,
            estadoCD: estadoCD
        }

        const response = await fetch('/XMLHttpRequest/PedidoDeEnvio/AjaxBuscarCartaDocumento.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.status === "success") {
            const cartasDocumentos = result.data;
            CARTAS_DOCUMENTOS = cartasDocumentos;
        
            cartasDocumentos.forEach(cd => {
                const destinatario = `${cd.destinatario_apellido}, ${cd.destinatario_nombre}`;
                const estado = getEstadoCartaDocumentoText(cd.estado);
                const provincia = cd.provincia_nombre ? cd.provincia_nombre : cd.destinatario_provincia_nombre;
                const localidad = cd.localidad_nombre ? cd.localidad_nombre : cd.destinatario_localidad_nombre;

                // Determinar si los botones deben estar habilitados o deshabilitados
                const esPendiente = cd.estado == CARTA_DOCUMENTO_ESTADO.PENDIENTE;
                const esAutorizado = cd.estado == CARTA_DOCUMENTO_ESTADO.AUTORIZADO;

                const botonAutorizar = `<button onclick="autorizarCartaDocumento(${cd.id})" data-toggle="tooltip" data-placement="top" title="Autorizar Carta Documento" class="btn btn-sm btn-primary d-flex justify-content-center align-items-center ${!esPendiente ? 'disabled' : ''}" ${!esPendiente ? 'disabled' : ''} style="gap: 5px;"><i class="fas fa-check-circle"></i> Autorizar</button>`;
                const botonRechazar = `<button onclick="rechazarCartaDocumento(${cd.id})" data-toggle="tooltip" data-placement="top" title="Rechazar Carta Documento" class="btn btn-sm btn-danger d-flex justify-content-center align-items-center ${!esPendiente ? 'disabled' : ''}" ${!esPendiente ? 'disabled' : ''} style="gap: 5px;"> <i class="fas fa-times-circle"></i>Rechazar</button>`;
                const botonVer = `<button onclick="verDetalle(${cd.id})" data-toggle="tooltip" data-placement="top" title="Ver detalles de Carta Documento" class="btn btn-sm btn-warning text-white d-flex justify-content-center align-items-center" style="gap: 5px;"><i class="fas fa-eye"></i> Ver</button>`;
                const botonDescargar = `<button onclick="descargarPDF(${cd.id})" data-toggle="tooltip" data-placement="top" title="Descargar PDF de Carta Documento" class="btn btn-sm btn-info btn-descargar-cd d-flex justify-content-center align-items-center ${!esAutorizado ? 'disabled' : ''}"  ${!esAutorizado ? 'disabled' : ''} style="gap: 5px;"><i class="fas fa-download"></i> Descargar</button>`;

                const botones = `
                    <div class="btn-group" style="gap: 10px;" role="group" aria-label="Acciones Carta Documento">
                        ${ [PERFILES_USUARIOS.ADMINISTRADOR, PERFILES_USUARIOS.AUTORIZADOR].includes(PERFIL_USUARIO) ? botonAutorizar : '' }
                        ${ [PERFILES_USUARIOS.ADMINISTRADOR, PERFILES_USUARIOS.AUTORIZADOR].includes(PERFIL_USUARIO) ? botonRechazar : '' }
                        ${ botonVer }
                        ${ [PERFILES_USUARIOS.ADMINISTRADOR, PERFILES_USUARIOS.IMPRIMIDOR].includes(PERFIL_USUARIO) ? botonDescargar : '' }
                    </div>
                `

                const fila = [
                    cd.id,
                    estado,
                    cd.usuario_creo_username,
                    cd.created_at,
                    cd.usuario_autorizo_username,
                    cd.authorized_at,
                    cd.usuario_rechazo_username,
                    cd.refused_at,
                    destinatario,
                    provincia,
                    localidad,
                    cd.destinatario_cp,
                    botones
                ];
                tableCD.row.add(fila);
            });

            tableCD.draw(); // Redibujar la tabla con los nuevos datos

        } else {
            console.error("Error al buscar cartas de documento:", result.message);
            mostrarMensaje(result.message || "Error al buscar cartas de documento.", 'danger');
        }
    } catch (error) {
        console.error("Error al buscar cartas de documento:", error);
    } finally {
        EndLoading();
    }
}

function validarFiltros() {
    const fechaDesde = document.getElementById("FechaDesde").value;
    const fechaHasta = document.getElementById("FechaHasta").value; 
    const usuarioCD = document.getElementById("UsuarioCartaDocumento").value;
    const estadoCD = document.getElementById("EstadoCartaDocumento").value;

    if (new Date(fechaDesde) > new Date(fechaHasta)) {
        mostrarMensaje("La fecha 'Desde' no puede ser mayor que la fecha 'Hasta'.", 'danger');
        return false;
    }

    if(!usuarioCD && !estadoCD && !fechaDesde && !fechaHasta) {
        mostrarMensaje("Por favor, seleccione al menos un filtro para la búsqueda.", 'danger');
        return false;
    }
    
    return true;
}       

function getEstadoCartaDocumentoText(estadoCode) {
    switch (parseInt(estadoCode)) {
        case CARTA_DOCUMENTO_ESTADO.PENDIENTE:
            return '<span class="badge badge-pill badge-secondary">Pendiente</span>';
        case CARTA_DOCUMENTO_ESTADO.AUTORIZADO:
            return '<span class="badge badge-pill badge-primary">Autorizado</span>';
        case CARTA_DOCUMENTO_ESTADO.RECHAZADO:
            return '<span class="badge badge-pill badge-danger">Rechazado</span>';
        default:
            return '<span class="badge badge-pill badge-dark">Desconocido</span>';
    }
}

async function autorizarCartaDocumento(cartaDocumentoId) {
    if(!confirm("¿Está seguro que desea autorizar esta carta documento?")) {
        return;
    }

    Loading();
    try {
        const data = {
            userId: USER_ID,
            clientId: CLIENTE_ID,
            perfilId: PERFIL_USUARIO,
            cartaDocumentoId: cartaDocumentoId,
        }

        const response = await fetch('/XMLHttpRequest/PedidoDeEnvio/AjaxAutorizarCartaDocumento.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.status === "success") {
            mostrarMensaje("Carta documento autorizada correctamente.", 'success');
            buscarCartasDocumentos(new Event('submit'));
        } else {
            console.error("Error al autorizar la carta documento:", result.message);
            mostrarMensaje(result.message || "Error al autorizar la carta documento.", 'danger');
        }
    } catch (error) {
        console.error("Error al autorizar la carta documento:", error);
        mostrarMensaje("Error al autorizar la carta documento.", 'danger');
    } finally {
        EndLoading();
    }
}

async function rechazarCartaDocumento(cartaDocumentoId) {
    if(!confirm("¿Está seguro que desea rechazar esta carta documento?")) {
        return;
    }

    Loading();
    try {
        const data = {
            userId: USER_ID,
            clientId: CLIENTE_ID,
            perfilId: PERFIL_USUARIO,
            cartaDocumentoId: cartaDocumentoId,
        }

        const response = await fetch('/XMLHttpRequest/PedidoDeEnvio/AjaxRechazarCartaDocumento.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.status === "success") {
            mostrarMensaje("Carta documento rechazada correctamente.", 'success');
            buscarCartasDocumentos(new Event('submit'));
        } else {
            console.error("Error al rechazar la carta documento:", result.message);
            mostrarMensaje(result.message || "Error al rechazar la carta documento.", 'danger');
        }
    } catch (error) {
        console.error("Error al rechazar la carta documento:", error);
        mostrarMensaje("Error al rechazar la carta documento.", 'danger');
    } finally {
        EndLoading();
    }
}

async function verDetalle(cartaDocumentoId) {
    Loading();
    try {
        const cartaData = CARTAS_DOCUMENTOS.find(cd => cd.id == cartaDocumentoId);

        if (!cartaData) {
            mostrarMensaje("No se encontró la carta documento.", 'danger');
            EndLoading();
            return;
        }

        const imagenPNG = await generarImagenCartaDocumento(cartaData);
        mostrarModalImagen(imagenPNG);

    } catch (error) {
        console.error("Error al obtener carta documento:", error);
        mostrarMensaje("Error al cargar los datos de la carta documento", 'danger');
        EndLoading();
    }
}

async function descargarPDF(cartaDocumentoId){
    Loading();
    try {
        const cartaData = CARTAS_DOCUMENTOS.find(cd => cd.id == cartaDocumentoId);

        if (!cartaData) {
            mostrarMensaje("No se encontró la carta documento.", 'danger');
            EndLoading();
            return;
        }

        await descargarPDFCartaDocumento(cartaData);
    } catch (error) {
        console.error("Error al descargar el PDF de la carta documento:", error);
        mostrarMensaje("Error al descargar la carta documento", 'danger');
    } finally {
        EndLoading();
    }
}

async function descargarPDFCartaDocumento(cartaData) {
    try {
        const pdfDataUri = await generarPDFCartaDocumento(cartaData);
        const link = document.createElement('a');
        link.href = pdfDataUri;
        link.download = `carta-documento-${ cartaData.id.padStart(6, '0') }.pdf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (error) {
        console.error("Error al descargar el PDF de la carta documento:", error);
        mostrarMensaje("Error al descargar la carta documento", 'danger');
    }
}

async function generarPDFCartaDocumento(cartaData) {
    try {
                const ancho = 216;
        const alto = 355;
        
        // Crear PDF temporal
        const pdf = new jsPDF('p', 'mm', [alto, ancho]);
        
        // Verificar si existe imagen base
        const imgBase = document.getElementById("imgBase");
        if (imgBase) {
            pdf.addImage(imgBase, 'JPEG', 0, 0, ancho, alto);
        }
        
        // Agregar texto al PDF
        agregarTextoCartaDocumento(pdf, ancho, alto, cartaData);
        
        // Agregar firma si existe
        if (cartaData.firma_cliente) {
            try {
                // Construir la URL completa de la firma
                const firmaUrl = `/XMLHttpRequest/FirmasDeClientes/uploads/${cartaData.firma_cliente}`;
                
                const firmaImg = await cargarImagen(firmaUrl);
                const ScalaV = 20;
                const ScalaH = Math.floor((firmaImg.width / firmaImg.height) * 20);
                pdf.addImage(firmaImg, 'PNG', 10, 305, ScalaH, ScalaV);
            } catch (error) {
                console.error("No se pudo cargar la firma:", error);
            }
        }
        
        // Agregar contenido HTML si existe
        if (cartaData.contenido) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = cartaData.contenido;
            tempDiv.style.position = 'absolute';
            tempDiv.style.left = '-9999px';
            document.body.appendChild(tempDiv);
            
            const margins = {
                top: 182,
                bottom: 0,
                left: 10,
                width: 195
            };
            
            await new Promise((resolve, reject) => {
                try {
                    pdf.fromHTML(
                        tempDiv,
                        margins.left,
                        margins.top,
                        {
                            'width': margins.width
                        },
                        function() {
                            document.body.removeChild(tempDiv);
                            resolve();
                        },
                        margins
                    );
                } catch (error) {
                    document.body.removeChild(tempDiv);
                    reject(error);
                }
            });
        }
        
        // Obtener el PDF como Data URL
        const pdfDataUri = pdf.output('dataurlstring');

        return pdfDataUri;
    } catch (error) {
        console.error("Error al generar el PDF:", error);
        mostrarMensaje("Error al generar la vista previa de la carta documento.", 'danger');
        throw error;
    }
}

function agregarTextoCartaDocumento(pdf, ancho, alto, data) {
    let Fuente = 12;
    pdf.setFontSize(Fuente);
    pdf.setTextColor(0, 0, 0);
    
    // DESTINATARIO
    const RightX = 150;
    
    // Nombre completo destinatario
    const nombreDestinatario = data.destinatario_apellido 
        ? `${data.destinatario_apellido} ${data.destinatario_nombre}`
        : data.destinatario_nombre;
    
    let splitDestinatario = pdf.splitTextToSize(nombreDestinatario, 55);
    if (splitDestinatario.length > 1) {
        Fuente = 8;
        pdf.setFontSize(Fuente);
        splitDestinatario = pdf.splitTextToSize(nombreDestinatario, 55);
        pdf.text(RightX, 41-4, splitDestinatario);
        pdf.text(RightX, 160-4, splitDestinatario);
    } else {
        Fuente = 12;
        pdf.setFontSize(Fuente);
        pdf.text(RightX, 41, splitDestinatario);
        pdf.text(RightX, 160, splitDestinatario);
    }
    
    // Domicilio destinatario
    let domicilioDestino = data.destinatario_calle;
    if (data.destinatario_numero) domicilioDestino += ` ${data.destinatario_numero}`;
    if (data.destinatario_piso) domicilioDestino += ` Piso:${data.destinatario_piso}`;
    if (data.destinatario_departamento) domicilioDestino += ` Dpto:${data.destinatario_departamento}`;
    
    Fuente = 8;
    pdf.setFontSize(Fuente);
    pdf.text(RightX, 47, domicilioDestino);
    pdf.text(RightX, 165, domicilioDestino);
    
    // Código Postal
    pdf.text(RightX, 52, data.destinatario_cp || '');
    pdf.text(RightX, 170, data.destinatario_cp || '');
    
    // Localidad
    const localidadDest = data.localidad_nombre || data.destinatario_localidad_nombre || '';
    pdf.text(RightX, 57, localidadDest);
    pdf.text(RightX, 175, localidadDest);
    
    // Provincia
    const provinciaDest = data.provincia_nombre || data.destinatario_provincia_nombre || '';
    pdf.text(RightX, 62, provinciaDest);
    pdf.text(RightX, 180, provinciaDest);
    
    // REMITENTE
    const LeftX = 50;
    
    const nombreRemitente = data.remitente_nombre || '';
    let splitRemitente = pdf.splitTextToSize(nombreRemitente, 55);
    if (splitRemitente.length > 1) {
        Fuente = 8;
        pdf.setFontSize(Fuente);
        splitRemitente = pdf.splitTextToSize(nombreRemitente, 55);
        pdf.text(LeftX, 41-4, splitRemitente);
        pdf.text(LeftX, 160-4, splitRemitente);
    } else {
        Fuente = 12;
        pdf.setFontSize(Fuente);
        pdf.text(LeftX, 41, splitRemitente);
        pdf.text(LeftX, 160, splitRemitente);
    }
    
    // Domicilio remitente
    let domicilioRemitente = data.remitente_calle || '';
    if (data.remitente_numero) domicilioRemitente += ` ${data.remitente_numero}`;
    if (data.remitente_piso) domicilioRemitente += ` Piso:${data.remitente_piso}`;
    if (data.remitente_departamento) domicilioRemitente += ` Dpto:${data.remitente_departamento}`;
    
    Fuente = 8;
    pdf.setFontSize(Fuente);
    pdf.text(LeftX, 47, domicilioRemitente);
    pdf.text(LeftX, 165, domicilioRemitente);
    
    pdf.text(LeftX, 52, data.remitente_cp || '');
    pdf.text(LeftX, 170, data.remitente_cp || '');
    
    const localidadRem = data.remitente_localidad_nombre || '';
    pdf.text(LeftX, 57, localidadRem);
    pdf.text(LeftX, 175, localidadRem);
    
    const provinciaRem = data.remitente_provincia_nombre || '';
    pdf.text(LeftX, 62, provinciaRem);
    pdf.text(LeftX, 180, provinciaRem);
    
    // APODERADO
    const nombreApoderado = data.firmante_nombre && data.firmante_apellido
        ? `${data.firmante_nombre} ${data.firmante_apellido}`
        : data.firmante_nombre || '';
    
    Fuente = 12;
    pdf.setFontSize(Fuente);
    let splitApoderado = pdf.splitTextToSize(nombreApoderado, 45);
    if (splitApoderado.length > 1) {
        Fuente = 8;
        pdf.setFontSize(Fuente);
        splitApoderado = pdf.splitTextToSize(nombreApoderado, 45);
    }
    pdf.text(85, 325, splitApoderado);
    
    const apoderadoDoc = data.firmante_tipo_documento 
        ? `${data.firmante_tipo_documento} ${data.firmante_documento}`
        : data.firmante_documento || '';
    
    Fuente = 8;
    pdf.setFontSize(Fuente);
    pdf.text(150, 325, apoderadoDoc);
}

async function generarImagenCartaDocumento(cartaData) {
    try {
        
        const pdfDataUri = await generarPDFCartaDocumento(cartaData);
        const imagenPNG = await convertirPDFaImagen(pdfDataUri);

        return imagenPNG;
    } catch (error) {
        console.error("generarImagenCartaDocumento", error);
        mostrarMensaje("Error al generar la vista previa de la carta documento.", 'danger');
        throw error;
    }
}

function cargarImagen(url) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = () => resolve(img);
        img.onerror = reject;
        img.src = url;
    });
}

async function convertirPDFaImagen(pdfDataUrl) {
    try {
        // Verificar si PDF.js está disponible
        if (typeof pdfjsLib === 'undefined') {
            throw new Error('PDF.js no está cargado. Asegúrate de incluir la librería.');
        }

        // Convertir Data URL a ArrayBuffer
        const base64 = pdfDataUrl.split(',')[1];
        const binaryString = atob(base64);
        const len = binaryString.length;
        const bytes = new Uint8Array(len);
        for (let i = 0; i < len; i++) {
            bytes[i] = binaryString.charCodeAt(i);
        }

        // Cargar el PDF
        const loadingTask = pdfjsLib.getDocument({ data: bytes });
        const pdf = await loadingTask.promise;

        // Obtener la primera página
        const page = await pdf.getPage(1);

        // Configurar escala para alta calidad (ajusta según necesites)
        const scale = 2.0;
        const viewport = page.getViewport({ scale: scale });

        // Crear canvas
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        // Renderizar PDF en canvas
        const renderContext = {
            canvasContext: context,
            viewport: viewport
        };

        await page.render(renderContext).promise;

        // Convertir canvas a imagen PNG
        const imagenDataUrl = canvas.toDataURL('image/png');
        
        return imagenDataUrl;

    } catch (error) {
        console.error('Error al convertir PDF a imagen:', error);
        throw error;
    }
}

function mostrarModalImagen(imagenDataUrl) {
    // Crear modal si no existe
    let modal = document.getElementById('modalCartaDocumento');
    
    if (!modal) {
        const modalHTML = `
            <div class="modal fade" id="modalCartaDocumento" tabindex="-1" role="dialog" aria-labelledby="modalCartaDocumentoLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCartaDocumentoLabel">Detalle de Carta Documento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center" style="padding: 20px; background-color: #f5f5f5;">
                            <img id="imagenCartaDocumento" src="" alt="Carta Documento" style="max-width: 100%; height: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        modal = document.getElementById('modalCartaDocumento');
    }
    
    const imgElement = document.getElementById('imagenCartaDocumento');
    
    // Agregar listener para cuando la imagen termine de cargar
    imgElement.onload = function() {
        EndLoading();
    };
    
    // Agregar listener para errores
    imgElement.onerror = function() {
        console.error("Error al cargar la imagen en el modal");
        EndLoading();
    };
    
    // Establecer la imagen
    imgElement.src = imagenDataUrl;
    
    // Mostrar modal
    $('#modalCartaDocumento').modal('show');
}

function descargarImagen() {
    const imgElement = document.getElementById('imagenCartaDocumento');
    const link = document.createElement('a');
    link.download = `carta-documento-${Date.now()}.png`;
    link.href = imgElement.src;
    link.click();
}

function mostrarMensaje(mensaje, tipo = 'info') {
    $.bootstrapGrowl(mensaje, {
        type: tipo,
        delay: 3000,
        align: 'center',
        width: 'auto',
        allow_dismiss: true,
    });
}