

function BuscarPiezas(){
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF","NumeroDeCargaInterna"];
	var Objetos = ["FechaDesde","FechaHasta","NumeroDeCargaInterna"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	
	var Config = JSON.parse(`
	{
		"Elemento":"Piezas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Controldepiezas/AjaxContarReporteBancoMacroParaSispo.php"
	}`);
	ValorDesdeConsulta(Config);


	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaI","FechaF","NumeroDeCargaInterna"];
	var Objetos = ["FechaDesde","FechaHasta","NumeroDeCargaInterna"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivPiezas",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Controldepiezas/AjaxReporteBancoMacroParaSispo.php"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}
