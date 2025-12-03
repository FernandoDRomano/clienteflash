
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


function BuscarPiezasSinDestino(){
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"PiezasSinDestino",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxPiezasSinDestino.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);



	var Config = JSON.parse(`
	{
		"Elemento":"PiezasSinDestinoConBaseBancaria",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxPiezasSinDestinoConBaseBancaria.php"
	}`);
	ValorDesdeConsulta(Config);



	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivPiezasSinDestino",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaPiezasSinDestino.php"
		
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
		"DivContenedor":"DivPiezasSinDestinoConBaseBancaria",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaPiezasSinDestinoConBaseBancaria.php"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
	
}

function BuscarEnBase(){
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"PiezasEnBase",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxContarPiezasSispoBancoMacro.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);



	var Config = JSON.parse(`
	{
		"Elemento":"PiezasEnBaseDeBanco",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxContarPiezasBancoMacro.php"
	}`);
	ValorDesdeConsulta(Config);



	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivPiezasEnBase",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaPiezasSispoBancoMacro.php"
		
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
		"DivContenedor":"DivPiezasEnBaseDeBanco",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaPiezasBancoMacro.php"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}

function PonerPiezasConDestino(){
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"ConsultaSinRetorno",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxPonerPiezasConDestino.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
}

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
		"DivContenedor":"DivTarjetasIngresadas",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		
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
		"DivContenedor":"DivTarjetasEnGestion",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasEnGestion.php"
		
	}`);
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
		"DivContenedor":"DivTarjetasEntregadas",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasEntregadas.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivTarjetasSolicitadasPorElClente",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaSolicitadasPorElCliente.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivTarjetasNoEntregadas",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasNoEntregadas.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivDomicilioInsuficiente",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaDomicilioInsuficiente.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivSeMudo",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaSeMudo.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivFallecio",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaFallecio.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivSeNiegaARecibir",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaSeNiegaARecibir.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivTresVisitas",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaSegundaVisitas.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	
	
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivOtrasRazonesDeNoEntregadas",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaOtrasRazonesDeNoEntregadas.php"
		
	}`);
	TablaDesdeConsulta(Config);
	
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
		"Elemento":"TarjetasIngresadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTarjetasIngresadas.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"TarjetasEnGestion",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTarjetasEnGestion.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	var Config = JSON.parse(`
	{
		"Elemento":"TarjetasEntregadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTarjetasEntregadas.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"SolicitadasPorElCliente",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxSolicitadasPorElCliente.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"TarjetasNoEntregadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTarjetasNoEntregadas.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"DomicilioInsuficiente",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxDomicilioInsuficiente.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"SeMudo",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxSeMudo.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"Fallecio",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxFallecio.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"SeNiegaARecibir",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxSeNiegaARecibir.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"SegundaVisitas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxSegundaVisitas.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	var Config = JSON.parse(`
	{
		"Elemento":"OtrasRazonesDeNoEntregadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxOtrasRazonesDeNoEntregadas.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	
	
	
	
	
	
	
	
	
	
	/*
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaDesde","FechaHasta"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivDeGrafica":"GraficaGestion",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		
		"PronombraData":"%,%,%",
		"typeData":"column,column,column",
		"ColorData":"#2143a2,#4C8219,#000000",
		"NombresDeVariables":"Tarjetas En Gestion,Tarjetas Entregadas,Solicitadas Por El Cliente",
		"Titulo":"Grafica Porcentual De Estados De Piezas Por Fecha",
		"SubTituloLateral":"Porcentaje De Estados/Ingresadas)",
		"Ymin":"100",
		"Ymax":"0",
		"SubTitulo":"Automatico",
		
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxGetFullData.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	GraficaDesdeConsulta(Config);
	
	var Config2 = JSON.parse(`
	{
		"DivDeGrafica":"GraficaMotivos",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		
		"PronombraData":"%,%,%",
		"typeData":"column,column,column",
		"ColorData":"#2143a2,#4C8219,#000000",
		"NombresDeVariables":"Tarjetas Ingresadas,Tarjetas En Gestion,Tarjetas Entregadas",
		"Titulo":"Grafica Tarjetas, Estados De Piezas Por Fecha",
		"SubTituloLateral":"Porcentaje De Piezas",
		"Ymin":"100",
		"Ymax":"0",
		"SubTitulo":"Automatico",
		
		"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxGetFullData.php"
	}`);
	//spline column
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	GraficaDesdeConsulta(Config2);
	*/
	
}
