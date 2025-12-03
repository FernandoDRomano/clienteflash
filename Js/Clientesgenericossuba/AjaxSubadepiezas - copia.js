	$(document).ready(function() {
		$('.select-2').select2();
	});
	
	filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
	filtroX=[UserId,"","0","4",SucursalesDeUsuario];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	/*
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaI","FechaF"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	*/
	var Config = JSON.parse(`
	{
		"SelectId":"ComprobantesDeIngreso",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Comprobantes De Ingreso Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxComprobantesDeIngresos.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	SelectDesdeConsulta(Config);


	function BuscarPiezasEnIngresoLogico(){
		if(! Needed("ComprobantesDeIngreso","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["ComprobantesDeIngreso"];
		var Objetos = ["ComprobantesDeIngreso"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivPiezasEnComprobantesDeIngreso",
			"ConFiltro":true,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnComprobantesDeIngresos.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["ComprobantesDeIngreso"];
		var Objetos = ["ComprobantesDeIngreso"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"PiezasEnComprobantesDeIngreso",
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarPiezasEnComprobantesDeIngresos.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
		
	}
	
	$(document).ready(function() {
		
		$('#ComprobantesDeIngreso').change(function(){
			if($('#ComprobantesDeIngreso').val()>=0){
				
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["ComprobantesDeIngreso"];
				var Objetos = ["ComprobantesDeIngreso"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				var Config = JSON.parse(`
				{
					"DivContenedor":"DivPiezasEnComprobantesDeIngreso",
					"ConFiltro":true,
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"No Se Encontraron Resultados",
					
					"CrearAlCargarDatos":true,
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnComprobantesDeIngresos.php"
					
				}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
					//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				TablaDesdeConsulta(Config);
				
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["ComprobantesDeIngreso"];
				var Objetos = ["ComprobantesDeIngreso"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				
				var Config = JSON.parse(`
				{
					"Elemento":"PiezasEnComprobantesDeIngreso",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"No Se Encontraron Resultados",
					"ValorDefault":"0",
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarPiezasEnComprobantesDeIngresos.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				ValorDesdeConsulta(Config);
			}
		});
	});
	
	function DarEstadosDeIngresoLogico(){
		if(! Needed("ComprobantesDeIngreso","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["ComprobantesDeIngreso"];
		var Objetos = ["ComprobantesDeIngreso"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Elementos=[""];
		Elementos = JSON.stringify(Elementos);
		var Config = JSON.parse(`
		{
			"ArraydJsonPostTitulo":null,
			"ArraydJsonPost":null,
			
			"Elementos":` + Elementos + `,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxIngresoLogicoDesdeCI.php"
		}`);
		ValoresAElementos(Config);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	

filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
filtroX=[UserId,"","0","4",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
var Config = JSON.parse(`
{
	"SelectId":"DespachosActivos",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Despachos Activos Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/Clientesgenericossuba/AjaxDespachosActivos.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);



filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
filtroX=[UserId,"","0","4",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
var Config = JSON.parse(`
{
	"SelectId":"DespachosActivosEnviados",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Despachos Activos Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/Clientesgenericossuba/AjaxDespachosAMiSucursal.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);




/*
$(document).ready(function() {
	$('#DespachosActivos').change(function(){
		if($('#DespachosActivos').val()>0){
			//console.log(Config);
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			
			var Indices=["DespachosActivos"];
			var Objetos = ["DespachosActivos"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);
			var Config = JSON.parse(`
			{
				"SelectId":"SucursalDeDestino",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":"true",
				"TextoEnFail":"No Se Encontraron Despachos Activos Para Seleccionar",
				"Ajax":"` + URLJS + `XMLHttpRequest/Clientesgenericossuba/AjaxDespachosASucursal.php"
			}`);
			SelectDesdeConsulta(Config);
		}
	});
});
*/



	$(document).ready(function() {
		
		$('#DespachosActivosEnviados').change(function(){
			if($('#DespachosActivosEnviados').val()>=0){
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivosEnviados"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				var Config = JSON.parse(`
				{
					"DivContenedor":"DivPiezasEnDespachosAMiSucursal",
					"ConFiltro":true,
					
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"No Se Encontraron Resultados",
					
					"CrearAlCargarDatos":true,
					"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxTablaPiezasEnDespachoAMiSucursal.php"
					
				}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
					//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				TablaDesdeConsulta(Config);
				
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivosEnviados"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				
				var Config = JSON.parse(`
				{
					"Elemento":"PiezasEnDespachosAMiSucursal",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"No Se Encontraron Resultados",
					"ValorDefault":"0",
					"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxContadorPiezasEnDespachoAMiSucursal.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				ValorDesdeConsulta(Config);
				
			}
		});
		
		$('#DespachosActivos').change(function(){
			if($('#DespachosActivos').val()>=0){
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivos"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				var Config = JSON.parse(`
				{
					"DivContenedor":"DivPiezasEnDespachos",
					"ConFiltro":true,
					
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"No Se Encontraron Resultados",
					
					"CrearAlCargarDatos":true,
					"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxTablaPiezasEnDespacho.php"
					
				}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
					//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				TablaDesdeConsulta(Config);
				
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivos"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				
				var Config = JSON.parse(`
				{
					"Elemento":"PiezasEnDespachos",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"No Se Encontraron Resultados",
					"ValorDefault":"0",
					"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxContadorPiezasEnDespacho.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				ValorDesdeConsulta(Config);
				
			}
		});
	});
	
	function BuscarPiezasEnDespachosPorAceptar(){
		if(! Needed("DespachosActivosEnviados","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivosEnviados"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivPiezasEnDespachosAMiSucursal",
			"ConFiltro":true,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxTablaPiezasEnDespachoAMiSucursal.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivosEnviados"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"PiezasEnDespachosAMiSucursal",
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxContadorPiezasEnDespachoAMiSucursal.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
	}
		
	function BuscarPiezasEnDespachos(){
		if(! Needed("DespachosActivos","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivos"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivPiezasEnDespachos",
			"ConFiltro":true,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxTablaPiezasEnDespacho.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivos"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"PiezasEnDespachos",
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxContadorPiezasEnDespacho.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
	}
	
	
	function DarEstadosDeDespachoAceptado(){
		if(! Needed("DespachosActivosEnviados","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivosEnviados"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Elementos=[""];
		Elementos = JSON.stringify(Elementos);
		var Config = JSON.parse(`
		{
			"ArraydJsonPostTitulo":null,
			"ArraydJsonPost":null,
			
			"Elementos":` + Elementos + `,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxAceptarDespacho.php"
		}`);
		ValoresAElementos(Config);
	}
	
	function DarEstadosDeDespacho(){
		if(! Needed("DespachosActivos","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivos"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Elementos=[""];
		Elementos = JSON.stringify(Elementos);
		var Config = JSON.parse(`
		{
			"ArraydJsonPostTitulo":null,
			"ArraydJsonPost":null,
			
			"Elementos":` + Elementos + `,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxDespacharDespacho.php"
		}`);
		ValoresAElementos(Config);
			/*
			var ArraydJsonPostTitulo = "Piezas";
			var Indices=[
			,"RemitenteNombre","RemitenteNombreApoderado","RemitenteApellidoApoderado","RemitenteDNITipoApoderado","RemitenteDocumentoApoderado"
			,"RemitenteCodigoPostal","RemitenteProvincia","RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
			,"RemitenteEmail","RemitenteCelular","RemitenteObservaciones","TablaDestinatario"
			];
			var Objetos = [
			,"RemitenteNombre","RemitenteNombreApoderado","RemitenteApellidoApoderado","RemitenteDNITipoApoderado","RemitenteDocumentoApoderado"
			,"RemitenteCodigoPostal","RemitenteProvincia","RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
			,"RemitenteEmail","RemitenteCelular","RemitenteObservaciones","TablaDestinatario"
			];
			var ArraydJsonPost = ArraydsAJson(Indices,Objetos);
			*/
			//"ArraydJsonPostTitulo":"` + ArraydJsonPostTitulo + `",
			//"ArraydJsonPost":` + ArraydJsonPost + `,
			//
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			//
			
	}

filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
var Config = JSON.parse(`
{
	"SelectId":"Cliente",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxClientesActivos.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);


filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
/*
var Config = JSON.parse(`
{
	"SelectId":"ClienteFicico",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxClientesActivos.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);
*/

filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
//var Indices=["FechaI","FechaF"];
//var Objetos = ["FechaI","FechaF"];
//var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
var Config = JSON.parse(`
{
	"SelectId":"HDR",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxHDR.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);


filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
//var Indices=["FechaI","FechaF"];
//var Objetos = ["FechaI","FechaF"];
//var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
var Config = JSON.parse(`
{
	"SelectId":"NumeroDeRendicion",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxNumerosDeRendicionesPorSucursales.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);
$(document).ready(function() {
	$('#NumeroDeRendicion').change(function(){
		if($('#NumeroDeRendicion').val()>=0){
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			var Indices=["NumeroDeRendicion"];
			var Objetos = ["NumeroDeRendicion"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
			var Config = JSON.parse(`
			{
				"DivContenedor":"DivPiezasEnRendicion",
				"ConFiltro":true,
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				
				"CrearAlCargarDatos":true,
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnNumeroDeRendicion.php"
				
			}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
				//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			var Indices=["NumeroDeRendicion"];
			var Objetos = ["NumeroDeRendicion"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
			
			var Config = JSON.parse(`
			{
				"Elemento":"PiezasEnRendicion",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				"ValorDefault":"0",
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasEnNumeroDeRendicion.php"
			}`);
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			ValorDesdeConsulta(Config);
			
		}
	});
});
function BuscarPiezasEnRendicion(){
	if(! Needed("NumeroDeRendicion","1")){return;}
	if($('#NumeroDeRendicion').val()>=0){
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["NumeroDeRendicion"];
		var Objetos = ["NumeroDeRendicion"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivPiezasEnRendicion",
			"ConFiltro":true,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnNumeroDeRendicion.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["NumeroDeRendicion"];
		var Objetos = ["NumeroDeRendicion"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"PiezasEnRendicion",
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasEnNumeroDeRendicion.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
		
	}
}






filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
//var Indices=["FechaI","FechaF"];
//var Objetos = ["FechaI","FechaF"];
//var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
var Config = JSON.parse(`
{
	"SelectId":"Carteros",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxCarteros.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

$(document).ready(function() {
	$('#Carteros').change(function(){
		if($('#Carteros').val()>0){
			//console.log(Config);
			filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
			filtroX=[UserId,"","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			
			var Indices=["Carteros"];
			var Objetos = ["Carteros"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);
			var Config = JSON.parse(`
			{
				"SelectId":"HDR",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":"true",
				"TextoEnFail":"No Se Encontraron HDR Para Seleccionar",
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxHDR.php"
			}`);
			SelectDesdeConsulta(Config);
		}
	});
	
	$('#HDR').change(function(){
		if($('#HDR').val()>=0){
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
			var Config = JSON.parse(`
			{
				"DivContenedor":"DivPiezasEnHDR",
				"ConFiltro":true,
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				
				"CrearAlCargarDatos":true,
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnHDR.php"
				
			}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
				//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
			
			var Config = JSON.parse(`
			{
				"Elemento":"PiezasEnHDR",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				"ValorDefault":"0",
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasEnHDR.php"
			}`);
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			ValorDesdeConsulta(Config);
			
		}
	});
});
	function BuscarPiezasEnHDR(){
		if(! Needed("HDR","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
			var Config = JSON.parse(`
			{
				"DivContenedor":"DivPiezasEnHDR",
				"ConFiltro":true,
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				
				"CrearAlCargarDatos":true,
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnHDR.php"
				
			}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
				//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
			
			var Config = JSON.parse(`
			{
				"Elemento":"PiezasEnHDR",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				"ValorDefault":"0",
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasEnHDR.php"
			}`);
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			ValorDesdeConsulta(Config);
	}
	function PonerEtadoHDRAceptada(){
		if(! Needed("HDR","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["HDR"];
		var Objetos = ["HDR"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Elementos=[""];
		Elementos = JSON.stringify(Elementos);
		var Config = JSON.parse(`
		{
			"ArraydJsonPostTitulo":null,
			"ArraydJsonPost":null,
			
			"Elementos":` + Elementos + `,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxPonerEstadoHDRAceptada.php"
		}`);
		ValoresAElementos(Config);
		
		
	}
	
	function PonerEtadoAcuseDeClienteEnMano(){
		if(! Needed("NumeroDeRendicion","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["NumeroDeRendicion"];
		var Objetos = ["NumeroDeRendicion"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Elementos=[""];
		Elementos = JSON.stringify(Elementos);
		var Config = JSON.parse(`
		{
			"ArraydJsonPostTitulo":null,
			"ArraydJsonPost":null,
			
			"Elementos":` + Elementos + `,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxPonerEstadoRendidaACliente.php"
		}`);
		ValoresAElementos(Config);
		
		
	}
	
	
$(document).ready(function() {
	$('#Cliente').change(function(){
		if($('#Cliente').val()>0){
			//alert($('#Cliente').val());
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			
			var Indices=["Cliente"];
			var Objetos = ["Cliente"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

			var Config = JSON.parse(`
			{
				"SelectId":"Servicio",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":"true",
				"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
				
				"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxServicioDeCliente.php"
			}`);
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			SelectDesdeConsulta(Config);
			//console.log(Config);
		}
	});
	$('#ClienteFicico').change(function(){
		if($('#ClienteFicico').val()>0){
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);// Manda Como Texto
			
			var Indices=["Cliente"];
			var Objetos = ["ClienteFicico"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

			var Config = JSON.parse(`
			{
				"SelectId":"ServicioFicico",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":"true",
				"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
				
				"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxServicioDeCliente.php"
			}`);
			//"ValoresDirectos":null,
			//"ValoresDirectos":` + ValoresDirectos + `,
			SelectDesdeConsulta(Config);
			//console.log(Config);
		}
	});
});

function SubirPiezas(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["Cliente","Servicio"];
	var Objetos = ["Cliente","Servicio"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	//console.log(Parametros);
	//console.log(ValoresDirectos);
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + SqlServerURLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxBaseDeControlPostal.php"
	}`);//SqlServer
	//alert(Config.Ajax);
	
	
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);//JsonElementosAJsonValores FlameBase
		var PostData = {};
		//console.log( JSON.parse(jsonValoresDirectos));
		//console.log( JSON.parse(Config.DataAjax));
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));//jsonConcat FlameBase
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));//jsonConcat FlameBase
		//console.log(jsonValoresDirectos);
		//console.log(PostData);
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
		//console.log(PostData);
	}
	
	//alert("DescargarXLSXUnificados");
	
	if(CagarDataXLSXAJson(DivContenedor)){
		if(DivContenedor.JsonData.length > 5000){
			PostDataSend(DivContenedor,PostData,Config.Ajax);
		}else{
			for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
				PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);
				CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Config.Ajax);
			}
			EndLoading();
		}
	}
	//JsonAFicheroUnificado(DivContenedor);
	//console.log(DivContenedor.JsonData);
	
}

function DarIngresoFicico(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["ClienteFicico","ServicioFicico"];
	var Objetos = ["ClienteFicico","ServicioFicico"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	//console.log(Parametros);
	//console.log(ValoresDirectos);
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + SqlServerURLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxDarIngresoFicico.php"
	}`);
	
	
	
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);//JsonElementosAJsonValores FlameBase
		var PostData = {};
		//console.log( JSON.parse(jsonValoresDirectos));
		//console.log( JSON.parse(Config.DataAjax));
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));//jsonConcat FlameBase
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));//jsonConcat FlameBase
		//console.log(jsonValoresDirectos);
		//console.log(PostData);
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
		//console.log(PostData);
	}
	
	//alert("DescargarXLSXUnificados");
	
	if(CagarDataXLSXAJson(DivContenedor)){
		if(DivContenedor.JsonData.length > 500){
			PostDataSend(DivContenedor,PostData,Config.Ajax);
		}else{
			for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
				PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);
				CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Config.Ajax);
			}
			EndLoading();
		}
	}
	//JsonAFicheroUnificado(DivContenedor);
	//console.log(DivContenedor.JsonData);
	
}

























function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}


async function PostDataSend(DivContenedor,PostData,Ajax) {
	for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
		if(CountLoading>500){await sleep(30000);}
		
		PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);//jsonConcat FlameBase
		//console.log(PostData);
		CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Ajax);
	}
	EndLoading();
}











