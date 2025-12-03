

function Buscar(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaDesde","FechaHasta"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	
	var Config = JSON.parse(`
	{
		"Elemento":"ElementoDashboard",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxContador.php"
	}`);
	ValorDesdeConsulta(Config);


	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Indices=["FechaDesde","FechaHasta"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);
	
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivElementoDashboard",
		"ConFiltro":true,
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Test/AjaxTabla.php"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}