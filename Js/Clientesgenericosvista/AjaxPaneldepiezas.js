
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

function Buscar(){
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivPiezasIngresadas",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/clientesgenericosvista/AjaxPiezasSubidas.php"
		
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivPiezasFaltantesEnGestionPostal",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/clientesgenericosvista/AjaxPiezasSubidasSinFisico.php"
		
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	return;
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivPiezasFaltantesEnGestionPostal",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/clientesgenericosvista/AjaxTablaTarjetasEnGestion.php"
		
	}`);
	TablaDesdeConsulta(Config);
	*/
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto

	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"Elemento":"PiezasIngresadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/clientesgenericosvista/AjaxCountPiezasSubidas.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"PiezasFaltantesEnGestionPostal",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/clientesgenericosvista/AjaxCountPiezasSubidasSinFisico.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
}
