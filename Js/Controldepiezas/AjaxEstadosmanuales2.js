//1
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
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxComprobantesDeIngresosBancoMacro.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	SelectDesdeConsulta(Config);
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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnComprobantesDeIngresosBancoMacro.php"
					
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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarPiezasEnComprobantesDeIngresosBancoMacro.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				ValorDesdeConsulta(Config);
			}
		});
	});
	
	function DarEstadosDeIngresoFisico(){
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
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxIngresoLogicoDesdeCIBancoMacro.php"
		}`);
		ValoresAElementos(Config);
	}
	
	
	function BuscarPiezasEnIngresoFisico(){
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
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnComprobantesDeIngresosBancoMacro.php"
			
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
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarPiezasEnComprobantesDeIngresosBancoMacro.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//4
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
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxHDRBancoMacro.php"
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
	"SelectId":"Estados",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxEstadosBancoMacro.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

$(document).ready(function() {
	
	$('#HDR').change(function(){
		if(! Needed("HDR","1")){return;}
		if($('#HDR').val()>=0){
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);
			var Config = JSON.parse(`
			{
				"DivContenedor":"DivPiezasEnHDR",
				"ConFiltro":true,
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				
				"CrearAlCargarDatos":true,
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasEnHDRDeBancoMacro.php"
				
			}`);
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			var ValoresDirectos = ArraydsAJson(Indices,Objetos);
			var Config = JSON.parse(`
			{
				"Elemento":"PiezasEnHDR",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":false,
				"TextoEnFail":"No Se Encontraron Resultados",
				"ValorDefault":"0",
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasEnHDRDeBancoMacro.php"
			}`);
			ValorDesdeConsulta(Config);
			
		}
	});
});
	
	function PonerEstadosMasivos(){
		if(! Needed("HDR","1")){return;}
		if(! Needed("Estados","1")){return;}
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["Tabla","Estados"];
		var Objetos = ["TablaPiezasEnHDR","Estados"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivRes",
			"ConFiltro":true,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"CrearAlCargarDatos":true,
			"Ajax":"` + Boveda + `/public/api/EstadosManualesDeBancoMacro"
			
		}`);//`/public/api/SubaDeBancoMacro"
		//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeBoveda(Config);
	}
	
	
	
	
	
	
	
	
	
	
//2
	
	

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
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxDespachosActivosDeBancoMacro.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);
	$(document).ready(function() {
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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasDeBancoMacroEnDespacho.php"
					
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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasDeBancoMacroEnDespacho.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				ValorDesdeConsulta(Config);
				
			}
		});
	});
	
	
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
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasDeBancoMacroEnDespacho.php"
			
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
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasDeBancoMacroEnDespacho.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
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
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxDespacharDespachoDeBancoMacro.php"
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//console.log(SucursalesDeUsuario);
	
	
	
	
	
	
	
	
	
	
	
	
//3

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
			"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxAceptarDespachoDeBancoMacro.php"
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
		"SelectId":"DespachosActivosEnviados",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Despachos Activos Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxDespachosDeBancoMacroAMiSucursal.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	SelectDesdeConsulta(Config);



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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasDeBancoMacroEnDespachoAMiSucursal.php"
					
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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasDeBancoMacroEnDespachoAMiSucursal.php"
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
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasDeBancoMacroEnDespachoAMiSucursal.php"
			
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
			"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContadorPiezasDeBancoMacroEnDespachoAMiSucursal.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//5
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
		
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxNumerosDeRendicionDeBancoMacro.php"
	}`);
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
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasDeBancoMacroEnNumeroDeRendicion.php"
					
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
				"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaPiezasDeBancoMacroEnNumeroDeRendicion.php"
				
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


	function PonerEtadoAcuseDeClienteEnMano(){
		
		
		if(! Needed("NumeroDeRendicion","1")){return;}
		filtro=["IdUsuario","User","time","Estados"];
		filtroX=[UserId,"","0","4"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["Tabla","NumeroDeRendicion"];
		var Objetos = ["TablaPiezasEnRendicion","NumeroDeRendicion"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivResRendiciones",
			"ConFiltro":true,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"CrearAlCargarDatos":true,
			"Ajax":"` + Boveda + `/public/api/EstadosManualesDeBancoMacro"
			
		}`);//`/public/api/SubaDeBancoMacro"
		//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeBoveda(Config);
		//console.log(Config);
	}
	
