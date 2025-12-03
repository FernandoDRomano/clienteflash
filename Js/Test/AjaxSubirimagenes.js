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
		"SelectId":"IdOBarcode",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxIdBarcode.php"
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
		"SelectId":"EstadoDeLaPieza",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxListarEstadosAPP.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	SelectDesdeConsulta(Config);
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["id"];
	var Objetos = ["EstadoDeLaPieza"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"SelectId":"Vinculo",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"",
		"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxListarVinculo.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	SelectDesdeConsulta(Config);
	
	$(document).ready(function() {
		$('#EstadoDeLaPieza').change(function(){
			if($('#EstadoDeLaPieza').val() == "Entregado"){
				filtro=["IdUsuario","User","time"];
				filtroX=[UserId,"","0"];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["EstadoDeLaPieza"];
				var Objetos = ["EstadoDeLaPieza"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				var Config = JSON.parse(`
				{
					"SelectId":"Vinculo",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"",
					"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxListarVinculo.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				SelectDesdeConsulta(Config);
				$("#ApellidoYNombres").attr("readonly", false);
				$("#DNI").attr("readonly", false);
				$("#Vinculo").attr("readonly", false);
			}
			else{
				$("#ApellidoYNombres").attr("readonly", true);
				$("#DNI").attr("readonly", true);
				$("#Vinculo").attr("readonly", true);
				$("#Vinculo").empty().append('<option value="0">Seleccione</option>');
			}
		});
	});
	
	function PostImagenDeFichero(e){
		if (isAdvancedUpload){
			var Intermediario = $(e).parent();
			var form = Intermediario[0];
			while(true){
				if(form.tagName != undefined){
					if(form.tagName != "FORM"){
						Intermediario = Intermediario.parent();
						form = Intermediario[0];
						//alert(form.tagName);
					}else{
						break;
					}
				}else{
					Intermediario = Intermediario.parent();
				}
			}
			UploadFormFile(form);
		}else{
			var Intermediario = $(e).parent();
			var form = Intermediario[0];
			while(true){
				if(form.tagName != undefined){
					if(form.tagName != "FORM"){
						Intermediario = Intermediario.parent();
						form = Intermediario[0];
						//alert(form.tagName);
					}else{
						break;
					}
					
				}else{
					Intermediario = Intermediario.parent();
				}
			}
			UploadFormFile(form);
		}
	}
	
	function PonerEstado(e){
		//console.log(e);
		if(EstadoDeLaPieza.value=="Entregado"){
			if(!Needed("IdOBarcode",1)){return;}
			if(!Needed("Barcode",1)){return;}
			if(!Needed("EstadoDeLaPieza",1)){return;}
			if(!Needed("Vinculo",1)){return;}
			if(!Needed("ApellidoYNombres",1)){return;}
			if(!Needed("DNI",1)){return;}
			if(!Needed("FechaI",1)){return;}
			if(!Needed("image_uploads2",1)){return;}
		}else{
			if(!Needed("IdOBarcode",1)){return;}
			if(!Needed("Barcode",1)){return;}
			if(!Needed("EstadoDeLaPieza",1)){return;}
		}
		PostImagenDeFichero(e);
	}















