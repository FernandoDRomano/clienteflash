



function BuscarLotes(){
	filtro=["User","time","SucursalesDeUsuario"];
	filtroX=["1","0",SucursalesDeUsuario];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaIDeLoteo","FechaFDeLoteo"];
	var Objetos = ["FechaIDeLoteo","FechaFDeLoteo"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivNumerosDeLotes",
		"ConFiltro":true,
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":true,
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaTablas/AjaxNumerosDeLotes.php"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
}




