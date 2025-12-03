
filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
var Config = JSON.parse(`
{
	"SelectId":"GrupoDeSucursal",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontro Gropo De Sucursal Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxGrupoDeSucursales.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
var Config = JSON.parse(`
{
	"SelectId":"Sucursales",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontro Sucursal Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxSucursales.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
/*
var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
*/
var Config = JSON.parse(`
{
	"SelectId":"GrupoDeSucursalParaUsuarios",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontro Gropo De Sucursal Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxGrupoDeSucursales.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

filtro=["IdUsuario","User","time","SucursalesDeUsuario"];
filtroX=[UserId,"","0",SucursalesDeUsuario];
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
	"TextoEnFail":"No Se Encontro Gropo De Sucursal Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxBuscarUsuariosHijos.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);




function AsignarGrupoDeSucursalAUsuario(){
	if(! Needed("Usuario","1")){return;}
	if(! Needed("GrupoDeSucursalParaUsuarios","1")){return;}
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["Usuario","GrupoDeSucursalParaUsuarios"];
	var Objetos=["Usuario","GrupoDeSucursalParaUsuarios"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxAsignarGrupoDeSucursalAUsuario.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
}

function CrearSucursal(){
	if(! Needed("SucursalNombre","1")){return;}
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["SucursalNombre"];
	var Objetos=["SucursalNombre"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxCrearSucursal.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
}
function CrearGrupoDeSucursal(){
	if(! Needed("GrupoDeSucursalNombre","1")){return;}
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["GrupoDeSucursalNombre"];
	var Objetos=["GrupoDeSucursalNombre"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxCrearGrupoDeSucursal.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
}
function AsignarSucursalAGrupoDeSucursal(){
	if(! Needed("GrupoDeSucursal","1")){return;}
	if(! Needed("Sucursales","1")){return;}
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["GrupoDeSucursal","Sucursales"];
	var Objetos=["GrupoDeSucursal","Sucursales"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxAsignarSucursalAGrupoDeSucursal.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
}
function QuitarSucursalAGrupoDeSucursal(){
	if(! Needed("GrupoDeSucursal","1")){return;}
	if(! Needed("Sucursales","1")){return;}
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["GrupoDeSucursal","Sucursales"];
	var Objetos=["GrupoDeSucursal","Sucursales"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Adminusuarios/AjaxQuitarSucursalAGrupoDeSucursal.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
}








function BuscarSucursales(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"SucursalesCreadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarSucursales.php"
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
		"DivContenedor":"DivSucursalesCreadas",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaSucursales.php"
		
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}
function BuscarGrupoDeSucursales(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"GrupoDeSucursalesCreadas",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarGrupoDeSucursales.php"
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
		"DivContenedor":"DivGrupoDeSucursalesCreadas",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaGrupoDeSucursales.php"
		
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}
function BuscarSucursalesEnGrupoDeSucursales(){
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Config = JSON.parse(`
	{
		"Elemento":"SucursalesAsignadasEnGruposDeSucursales",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxContarSucursalesEnGrupoDeSucursales.php"
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
		"DivContenedor":"DivSucursalesAsignadasEnGruposDeSucursales",
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxTablaSucursalesEnGrupoDeSucursales.php"
		
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}




