function Buscar(){
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
	
	
}
