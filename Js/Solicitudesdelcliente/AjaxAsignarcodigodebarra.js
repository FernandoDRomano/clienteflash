	
	var imgBase;
	$(document).ready(function () {
		imgBase = document.getElementById("imgBase");
	});
	
	var Config = JSON.parse(`{
		"Elemento":"ComprobanteDeIngreso",
		"ElementoTexto":"BoltTextComprobanteDeIngreso",
		"DigitosMinimos":"10",
		"TextoInicial":"Complete El Campo Para Buscar Datos",
		"TextoMenor":"Faltan Digitos"
	}`);
	Texto(Config);
	
	function Buscar(){
		//if(!Needed("ComprobanteDeIngreso",10)){return;}
		
		filtro=["User","time"];
		filtroX=["1","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["ComprobanteDeIngreso","FechaI","FechaF"];
		var Objetos = ["ComprobanteDeIngreso","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		//"ImputsAderidosTitulo":"Barcode A Establecer(,)Test 2",
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivIngresadas",
			"ConFiltro":false,
			"AddImput":true,
			"ImputsAderidos":"1",
			"ImputsAderidosTitulo":"Barcode A Establecer",
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/SolicitudesDelCliente/BuscarCartasDocumentosParaAsignarCodigoDeBarra.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
	}
	
	function EstablecerCodigosDeBarra(){
		
		/*
		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('hide');
		*/
		
		/*
		if( $ ('#EnviarCartaDoccumento').hasClass( "disabled" )){return;}
		if(! Needed("RemitenteNombre","1")){return;}
		*/
		
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		/*
		var Indices=[
			"textBox"
		];
		var Objetos=[
		"textBox"
		];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);
		*/
		
		var ArraydJsonPostTitulo = "Piezas";
		var Indices=[
		"TablaIngresadas"
		];
		var Objetos = [
		"TablaIngresadas"
		];
		var ArraydJsonPost = ArraydsAJson(Indices,Objetos);
		
		var Elementos=[""];
		Elementos = JSON.stringify(Elementos);
		
		var Config = JSON.parse(`
		{
			"Elemento":"Estado",
			"ArraydJsonPostTitulo":"` + ArraydJsonPostTitulo + `",
			"ArraydJsonPost":` + ArraydJsonPost + `,
			
			"Elementos":` + Elementos + `,
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/SolicitudesDelCliente/PonerCodigosDeBarra.php"
		}`);
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValoresAElementos(Config);
	}
