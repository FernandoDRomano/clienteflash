


function Buscar(){
	filtro=["UserId"];
	filtroX=["1"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto

	var Indices=["FechaDesde","FechaHasta"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

	var Config = JSON.parse(`
	{
		"Elemento":"TarjetasIngresadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Testvalorunico/Ajaxvalorunico.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	var Config = JSON.parse(`
	{
		"Elemento":"TarjetasIngresadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		
		"Ajax":"` + URLJS + `XMLHttpRequest/Testvalorunico/falso.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
}
