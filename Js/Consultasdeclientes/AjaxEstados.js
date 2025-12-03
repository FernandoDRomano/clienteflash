//IncludeJs( URLJS + "js/GrowlCall.js", "GrowlCall");
IncludeJs( URLJS + "js/Date.js", "Date");
//IncludeJs( URLJS + "js/Habla.js", "Habla");
//IncludeJs( URLJS + "js/Tablas.js", "Tablas");


filtro=["UserId"];
filtroX=["1"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto

var Indices=["0"];
var Objetos = ["FechaI"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

var Config = JSON.parse(`
{
	"SelectId":"EstadoDeLaPieza",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/Testselect/AjaxArraidToSelect.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

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
function Buscar(){
	//Hablar("Este Comando Requiere Tener Cargado El HTML Por Completo, Luego De Cargar, Báse PHP y Báse jávascript Unídas");
	NoMemory++;
	var paragrap = document.getElementById("Paragrap");
	paragrap.innerHTML = "";
	var FechaI = document.getElementById("FechaI");
	var FechaF = document.getElementById("FechaF");
	if(FechaI.value!='' && FechaF.value!=''){
		filtro=["UserId","FechaI","FechaF","time","NoMemory"];
		filtroX=[UserId,FechaI.value,FechaF.value,time,NoMemory];
		var Parametros = ArraidNameValueToJSON(filtro,filtroX);
		if(Parametros == undefined){
			return;
		}
		var pagina = 0;
		var MaximoDeFilas = 5000;
		if(MaximoDeFilas>0){}else{MaximoDeFilas=1;}
		
		var Config = JSON.parse(`
		{
			"Reactivo":null,
			"HijoDeReactivo":"TablaMain",
			"Reactor":"MainTabla",
			"TextoCheckbox":"",
			"CheckBox":false,
			"DataAjax":` + Parametros + `,
			
			"hidden":false,
			"shortT":false,
			"Scaner":false,
			"MaximoDeFilas":"` + MaximoDeFilas + `",
			"MaximizeBox":false,
			"MaximizeElement":"MaximizeBox",
			"Paginador":"DivPaginador",
			"Pagina":"` + pagina + `",
			"Retorno":"Limpiar Tabla",
			"Iniciar":true,
			
			"Ajax":"` + URLJS + `XMLHttpRequest/AjaxConsultasEstadosUnificadasFinal.php"
		}`);//http://localhost:8081/correoflash/
		//` + URLJS + `
		
		console.log(Config);
		AjaxTabla(Config);
		
	}else{
		if (typeof $.bootstrapGrowl === "function") {
			$.bootstrapGrowl( "Se Requiere Fecha Inicial Y Final Para Busqueda", {
				type: 'danger',//danger
				align: 'center',
				width: 'auto'
			});
		}
		return;
	}
}
/*
$(document).ready(function() {
	$('#MainTabla').DataTable( {

		dom: 'Bfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		]

	} );
} );
*/