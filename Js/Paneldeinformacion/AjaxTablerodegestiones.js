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
		"Elemento":"TarjetasIngresadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
		"MensajeEnFail":"false",
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
