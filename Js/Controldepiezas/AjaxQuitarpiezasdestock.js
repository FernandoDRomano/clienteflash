var Config = JSON.parse(`{
	"Elemento":"MenuNombre",
	"ElementoTexto":"BoltTextMenuNombre",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);

$("#Barcode").on('keypress',function(e) {
    if(e.which == 13) {
        QuitarPiezaDeStock();
    }
});

function QuitarPiezaDeStock(){
	if(! Needed("Barcode","1")){return;}
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["Barcode"];
	var Objetos=["Barcode"];
	
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/Controldepiezas/AjaxQuitarPiezasDeStock.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
	document.getElementById("Barcode").value="";
	//console.log(Config);
}