	/*
	*
	*
	*
	*
	*
	*/
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Config = JSON.parse(`
	{
		"SelectId":"BusquedaIdOBarcode",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxIdBarcode.php"
	}`);
	SelectDesdeConsulta(Config);
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Config = JSON.parse(`
	{
		"SelectId":"IdOBarcode",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxIdBarcode.php"
	}`);
	SelectDesdeConsulta(Config);
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Config = JSON.parse(`
	{
		"SelectId":"EdicionIdOBarcode",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxIdBarcode.php"
	}`);
	SelectDesdeConsulta(Config);
	
	
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Config = JSON.parse(`
	{
		"SelectId":"EstadoDeLaPieza",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxListarEstadosBancarios.php"
	}`);
	SelectDesdeConsulta(Config);
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);
	var Config = JSON.parse(`
	{
		"SelectId":"EdicionEstadoDeLaPieza",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxListarEstadosBancarios.php"
	}`);
	SelectDesdeConsulta(Config);
	
	/*
	*
	*
	*
	*
	*
	*/
	
	$(document).ready(function() {
		$('#EstadoDeLaPieza').change(function(){
			if($('#EstadoDeLaPieza').val() == "13"){
				filtro=["IdUsuario","User","time"];
				filtroX=[UserId,"","0"];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);
				var Indices=["EstadoDeLaPieza"];
				var Objetos = ["EstadoDeLaPieza"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);
				var Config = JSON.parse(`
				{
					"SelectId":"Vinculo",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"",
					"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxListarVinculo.php"
				}`);
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
		
		$('#EdicionEstadoDeLaPieza').change(function(){
			if($('#EdicionEstadoDeLaPieza').val() == "13"){
				filtro=["IdUsuario","User","time"];
				filtroX=[UserId,"","0"];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				var Indices=["EstadoDeLaPieza"];
				var Objetos = ["EdicionEstadoDeLaPieza"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				var Config = JSON.parse(`
				{
					"SelectId":"EdicionVinculo",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":false,
					"TextoEnFail":"",
					"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxListarVinculo.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				SelectDesdeConsulta(Config);
				$("#EdicionApellidoYNombres").attr("readonly", false);
				$("#EdicionDNI").attr("readonly", false);
				$("#EdicionVinculo").attr("readonly", false);
			}
			else{
				$("#EdicionApellidoYNombres").attr("readonly", true);
				$("#EdicionDNI").attr("readonly", true);
				$("#EdicionVinculo").attr("readonly", true);
				$("#EdicionVinculo").empty().append('<option value="0">Seleccione</option>');
			}
		});
	});
	
	/*
	*
	*
	*
	*
	*
	*/
	
	function BuscarEstadosDePieza(){
		if(!Needed("BusquedaIdOBarcode",1)){return;}
		if(!Needed("BusquedaBarcode",1)){return;}
		
		filtro=["User","time"];
		filtroX=["1","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["IdOBarcode","Barcode"];
		var Objetos = ["BusquedaIdOBarcode","BusquedaBarcode"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);
		
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivEstadosDePiezas",
			"ConFiltro":false,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":true,
			"TextoEnFail":"No Se Encontraron Resultados",
			
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxBuscarEstadosDePiezaBancarias.php"
			
		}`);
		TablaDesdeConsulta(Config);
	}
/*
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
*/
	function PonerEstado(){//e
		if(EstadoDeLaPieza.value=="13"){
			if(!Needed("IdOBarcode",1)){return;}
			if(!Needed("Barcode",1)){return;}
			if(!Needed("EstadoDeLaPieza",1)){return;}
			if(!Needed("Vinculo",1)){return;}
			if(!Needed("ApellidoYNombres",1)){return;}
			if(!Needed("DNI",1)){return;}
			if(!Needed("FechaI",1)){return;}
			//if(!Needed("image_uploads2",1)){return;}
		}else{
			if(!Needed("IdOBarcode",1)){return;}
			if(!Needed("Barcode",1)){return;}
			if(!Needed("EstadoDeLaPieza",1)){return;}
		}
		//PostImagenDeFichero(e);
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["IdOBarcode","Barcode","EstadoDeLaPieza","Vinculo","ApellidoYNombres","DNI","FechaI", "Hdr"];
		var Objetos=["IdOBarcode","Barcode","EstadoDeLaPieza","Vinculo","ApellidoYNombres","DNI","FechaI", "Hdr"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);
		var Config = JSON.parse(`
		{
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxEstadoManualBancario.php"
		}`);
		GrowlDesdeConsulta(Config);
		
	}

	function EditarEstado(e){
		//console.log(e);
		if(EstadoDeLaPieza.value=="13"){
			if(!Needed("EdicionIdOBarcode",1)){return;}
			if(!Needed("EdicionBarcode",1)){return;}
			if(!Needed("EdicionEstadoDeLaPieza",1)){return;}
			if(!Needed("EdicionVinculo",1)){return;}
			if(!Needed("EdicionApellidoYNombres",1)){return;}
			if(!Needed("EdicionDNI",1)){return;}
			if(!Needed("EdicionFechaI",1)){return;}
			//if(!Needed("Edicionimage_uploads2",1)){return;}
			if(!Needed("EdicionIdEstado",1)){return;}
			
		}else{
			if(!Needed("EdicionIdOBarcode",1)){return;}
			if(!Needed("EdicionBarcode",1)){return;}
			if(!Needed("EdicionEstadoDeLaPieza",1)){return;}
			if(!Needed("EdicionIdEstado",1)){return;}
		}
		
		//PostImagenDeFichero(e);
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["EdicionIdOBarcode","EdicionBarcode","EdicionEstadoDeLaPieza","EdicionVinculo","EdicionApellidoYNombres","EdicionDNI","EdicionFechaI","EdicionIdEstado"];
		var Objetos=["EdicionIdOBarcode","EdicionBarcode","EdicionEstadoDeLaPieza","EdicionVinculo","EdicionApellidoYNombres","EdicionDNI","EdicionFechaI","EdicionIdEstado"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);
		var Config = JSON.parse(`
		{
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxEditarEstadoManualDePiezaBancarias.php"
		}`);
		GrowlDesdeConsulta(Config);
		
	}
	
	
	function EliminacionDeEstadosDePieza(){
		if(!Needed("EliminacionIdEstado",1)){return;}
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=["Estado"];
		var Objetos=["EliminacionIdEstado"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);
		var Config = JSON.parse(`
		{
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/Estadosmanualesbancomacro/AjaxBorrarEstado.php"
		}`);
		GrowlDesdeConsulta(Config);
	}
	