

$('.select-2').select2();

filtro=["UserId"];
filtroX=["1"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto

var Indices=["FechaI","FechaF"];
var Objetos = ["FechaI","FechaF"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

var Config = JSON.parse(`
{
	"SelectId":"Select1",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":` + ValoresDirectos + `,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/Testselect/AjaxArraidToSelect.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

filtro=[""];
filtroX=[""];
var Parametros = ArraidNameValueToJSON(filtro,filtroX);
var Config = JSON.parse(`
{
	"SelectId":"Select2",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	
	"Ajax":"` + URLJS + `XMLHttpRequest/Testselect/AjaxNULL.php"
}`);
SelectDesdeConsulta(Config);


filtro=[""];
filtroX=[""];
var Parametros = ArraidNameValueToJSON(filtro,filtroX);
var Config = JSON.parse(`
{
	"SelectId":"Select3",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/Testselect/AjaxSinDatos.php"
}`);
SelectDesdeConsulta(Config);
