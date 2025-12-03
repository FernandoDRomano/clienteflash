
var Config = JSON.parse(`{
	"Elemento":"UserUsuario",
	"ElementoTexto":"BoltTextUserUsuario",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
var Config = JSON.parse(`{
	"Elemento":"UserPassword",
	"ElementoTexto":"BoltTextUserPassword",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
var Config = JSON.parse(`{
	"Elemento":"UserNombre",
	"ElementoTexto":"BoltTextUserNombre",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
var Config = JSON.parse(`{
	"Elemento":"UserApellido",
	"ElementoTexto":"BoltTextUserApellido",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
var Config = JSON.parse(`{
	"Elemento":"UserEmail",
	"ElementoTexto":"BoltTextUserEmail",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);

function BuscarUsuario(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"Usuarios",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Usuarios/AjaxContarUsuariosHijos.php"
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
		"DivContenedor":"DivUsuariosCreados",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/Usuarios/AjaxBuscarUsuariosHijos.php"
		
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
	
}

function CrearUsuario(){
	if(! Needed("UserNombre","1")){return;}
	if(! Needed("UserApellido","1")){return;}
	if(! Needed("UserEmail","1")){return;}
	if(! Needed("UserUsuario","1")){return;}
	if(! Needed("UserPassword","1")){return;}
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["UserEmail","UserApellido","UserNombre","UserPassword","UserUsuario"];
	var Objetos=["UserEmail","UserApellido","UserNombre","UserPassword","UserUsuario"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Usuarios/AjaxCrearUsuarios.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
}










