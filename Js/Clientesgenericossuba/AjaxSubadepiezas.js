	$(document).ready(function() {
		$('.select-2').select2();
	});
	
	
filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);
var Config = JSON.parse(`
{
	"SelectId":"NumeroDeRendicion",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxNumerosDeRendicionesPorSucursales.php"
}`);


SelectDesdeConsulta(Config);
$(document).ready(function() {
	$('#NumeroDeRendicion').change(function(){
		if($('#NumeroDeRendicion').val()>=0){
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
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
				
			}`);
				
			
			
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
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
		Parametros = JSON.stringify(Parametros);
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
			
		}`);
			
		
		
		TablaDesdeConsulta(Config);
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
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
		ValorDesdeConsulta(Config);
	}
}

function PonerEtadoAcuseDeClienteEnMano(){
	if(! Needed("NumeroDeRendicion","1")){return;}
	filtro=["User","time","SucursalesDeUsuario"];
	filtroX=["1","0",SucursalesDeUsuario];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
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
	
	
	
	
	/*
	
	
	filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
	filtroX=[UserId,"","0","4",SucursalesDeUsuario];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Config = JSON.parse(`
	{
		"SelectId":"ComprobantesDeIngreso",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Comprobantes De Ingreso Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxComprobantesDeIngresos.php"
	}`);
	SelectDesdeConsulta(Config);


	function BuscarPiezasEnIngresoLogico(){
		if(! Needed("ComprobantesDeIngreso","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
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
			
		}`);
		TablaDesdeConsulta(Config);
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
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
		ValorDesdeConsulta(Config);
		
	}
	
	$(document).ready(function() {
		$('#ComprobantesDeIngreso').change(function(){
			if($('#ComprobantesDeIngreso').val()>=0){
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["ComprobantesDeIngreso"];
				var Objetos = ["ComprobantesDeIngreso"];
				
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
					
				}`);
				TablaDesdeConsulta(Config);
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["ComprobantesDeIngreso"];
				var Objetos = ["ComprobantesDeIngreso"];
				
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
				ValorDesdeConsulta(Config);
			}
		});
	});
	
	function DarEstadosDeIngresoLogico(){
		if(! Needed("ComprobantesDeIngreso","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["ComprobantesDeIngreso"];
		var Objetos = ["ComprobantesDeIngreso"];
		
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
Parametros = JSON.stringify(Parametros);
var Config = JSON.parse(`
{
	"SelectId":"DespachosActivos",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Despachos Activos Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/Clientesgenericossuba/AjaxDespachosActivos.php"
}`);
SelectDesdeConsulta(Config);



filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
filtroX=[UserId,"","0","4",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);

var Config = JSON.parse(`
{
	"SelectId":"DespachosActivosEnviados",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Despachos Activos Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/Clientesgenericossuba/AjaxDespachosAMiSucursal.php"
}`);
SelectDesdeConsulta(Config);

	$(document).ready(function() {
		
		$('#DespachosActivosEnviados').change(function(){
			if($('#DespachosActivosEnviados').val()>=0){
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivosEnviados"];
				
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
					
				}`);
				TablaDesdeConsulta(Config);
				
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivosEnviados"];
				
				
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
				ValorDesdeConsulta(Config);
				
			}
		});
		
		$('#DespachosActivos').change(function(){
			if($('#DespachosActivos').val()>=0){
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivos"];
				
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
					
				}`);
				TablaDesdeConsulta(Config);
				
				filtro=["User","time","SucursalesDeUsuario"];
				filtroX=["1","0",SucursalesDeUsuario];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["DespachosActivos"];
				var Objetos = ["DespachosActivos"];
				
				
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
				ValorDesdeConsulta(Config);
				
			}
		});
	});
	
	function BuscarPiezasEnDespachosPorAceptar(){
		if(! Needed("DespachosActivosEnviados","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivosEnviados"];
		
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
			
		}`);
		TablaDesdeConsulta(Config);
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivosEnviados"];
		
		
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
		ValorDesdeConsulta(Config);
	}
		
	function BuscarPiezasEnDespachos(){
		if(! Needed("DespachosActivos","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivos"];
		
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
			
		}`);
		TablaDesdeConsulta(Config);
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivos"];
		
		
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
		
		
		ValorDesdeConsulta(Config);
	}
	
	
	function DarEstadosDeDespachoAceptado(){
		if(! Needed("DespachosActivosEnviados","1")){return;}
		
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivosEnviados"];
		
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
		Parametros = JSON.stringify(Parametros);
		var Indices=["DespachosActivos"];
		var Objetos = ["DespachosActivos"];
		
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
	}

filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);

var Config = JSON.parse(`
{
	"SelectId":"Cliente",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxClientesActivos.php"
}`);


SelectDesdeConsulta(Config);


filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);


filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);
var Config = JSON.parse(`
{
	"SelectId":"HDR",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxHDR.php"
}`);


SelectDesdeConsulta(Config);






filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);
var Config = JSON.parse(`
{
	"SelectId":"Carteros",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxCarteros.php"
}`);


SelectDesdeConsulta(Config);

$(document).ready(function() {
	$('#Carteros').change(function(){
		if($('#Carteros').val()>0){
			filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
			filtroX=[UserId,"","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			
			var Indices=["Carteros"];
			var Objetos = ["Carteros"];
			
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
			Parametros = JSON.stringify(Parametros);
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			
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
				
			}`);
				
			
			
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			
			
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
			
			
			ValorDesdeConsulta(Config);
			
		}
	});
});
	function BuscarPiezasEnHDR(){
		if(! Needed("HDR","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			
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
				
			}`);
				
			
			
			TablaDesdeConsulta(Config);
			
			filtro=["User","time","SucursalesDeUsuario"];
			filtroX=["1","0",SucursalesDeUsuario];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Indices=["HDR"];
			var Objetos = ["HDR"];
			
			
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
			
			
			ValorDesdeConsulta(Config);
	}
	function PonerEtadoHDRAceptada(){
		if(! Needed("HDR","1")){return;}
		filtro=["User","time","SucursalesDeUsuario"];
		filtroX=["1","0",SucursalesDeUsuario];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["HDR"];
		var Objetos = ["HDR"];
		
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
	
	
	
	
$(document).ready(function() {
	$('#Cliente').change(function(){
		if($('#Cliente').val()>0){
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			
			var Indices=["Cliente"];
			var Objetos = ["Cliente"];
			

			var Config = JSON.parse(`
			{
				"SelectId":"Servicio",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":"true",
				"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
				
				"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxServicioDeCliente.php"
			}`);
			
			
			SelectDesdeConsulta(Config);
		}
	});
	$('#ClienteFicico').change(function(){
		if($('#ClienteFicico').val()>0){
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			
			var Indices=["Cliente"];
			var Objetos = ["ClienteFicico"];
			

			var Config = JSON.parse(`
			{
				"SelectId":"ServicioFicico",
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":` + ValoresDirectos + `,
				"MensajeEnFail":"true",
				"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
				
				"Ajax":"` + URLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxServicioDeCliente.php"
			}`);
			
			
			SelectDesdeConsulta(Config);
		}
	});
});

function SubirPiezas(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	
	var Indices=["Cliente","Servicio"];
	var Objetos = ["Cliente","Servicio"];
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + SqlServerURLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxBaseDeControlPostal.php"
	}`);
	
	
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
	}
	
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
	
}

function DarIngresoFicico(DivContenedor){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	
	var Indices=["ClienteFicico","ServicioFicico"];
	var Objetos = ["ClienteFicico","ServicioFicico"];
	
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"Ajax":"` + SqlServerURLJS + `XMLHttpRequest/BaseDeControlPostal/AjaxDarIngresoFicico.php"
	}`);
	
	
	
	if(Config.ValoresDirectos != null){
		var jsonValoresDirectos = JsonElementosAJsonValores(Config.ValoresDirectos);
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(jsonValoresDirectos));
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
	}else{
		var PostData = {};
		PostData = jsonConcat(PostData, JSON.parse(Config.DataAjax));
	}
	
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
	
}

























function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}


async function PostDataSend(DivContenedor,PostData,Ajax) {
	for(var i = 0 ; i < DivContenedor.JsonData.length ; i++){
		if(CountLoading>500){await sleep(30000);}
		
		PostData = jsonConcat(PostData, DivContenedor.JsonData[i]);
		CargaDeXLSX(PostData,DivContenedor.JsonData.length,i,Ajax);
	}
	EndLoading();
}

*/









