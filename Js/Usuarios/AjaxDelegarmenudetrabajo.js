
var Config = JSON.parse(`{
	"Elemento":"Menues",
	"ElementoTexto":"BoltTextMenues",
	"DigitosMinimos":"1",
	"TextoInicial":"Seleccione",
	"TextoMenor":""
}`);
Texto(Config);

var Config = JSON.parse(`{
	"Elemento":"Usuario",
	"ElementoTexto":"BoltTextUsuario",
	"DigitosMinimos":"1",
	"TextoInicial":"Seleccione",
	"TextoMenor":""
}`);
Texto(Config);



function BuscarMenues(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"MenuesCreados",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxContarMenues.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValorDesdeConsulta(Config);
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	/*
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaDesde","FechaHasta"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	*/
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivMenuesCreados",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxBuscarMenues.php"
		
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
	
}

function AsignarMenuAUsuario(){
	if(! Needed("Menues","1")){return;}
	if(! Needed("Usuario","1")){return;}
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["Menues","Usuario"];
	var Objetos=["Menues","Usuario"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxAsignar.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
	//console.log(Config);
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
	"SelectId":"Menues",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxBuscarMenuesHijos.php"
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
var Config = JSON.parse(`
{
	"SelectId":"Usuario",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxBuscarUsuariosHijos.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);
//console.log(Config);

















