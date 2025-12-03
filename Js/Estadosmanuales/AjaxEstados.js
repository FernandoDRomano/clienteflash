/*
	$(document).ready(function(){
		$(".btn-minimize-CajaDeGrupos").click(function(){
			$(this).toggleClass('btn-plus');
			var Elemento = $(this).attr("for");
			$("#"+Elemento).slideToggle();
		});
	});
*/
	
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
	"SelectId":"BusquedaIdOBarcode",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxIdBarcode.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);



function BuscarEstadosDePieza(){
	if(!Needed("BusquedaIdOBarcode",1)){return;}
	if(!Needed("BusquedaBarcode",1)){return;}
	
	filtro=["User","time"];
	filtroX=["1","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["IdOBarcode","Barcode"];
	var Objetos = ["BusquedaIdOBarcode","BusquedaBarcode"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivEstadosDePiezas",
		"ConFiltro":false,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":true,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":true,
		"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxBuscarEstadosDePieza.php"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeConsulta(Config);
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
	"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxListarEstadosDefinitivosAPP.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

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
        //AGREGADO
        if(!Needed("Hdr",1)){return;}
	}else{
		if(!Needed("IdOBarcode",1)){return;}
		if(!Needed("Barcode",1)){return;}
		if(!Needed("EstadoDeLaPieza",1)){return;}
        //AGREGADO
        if(!Needed("Hdr",1)){return;}
	}
	PostImagenDeFichero(e);
}








//Edicion
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
	"SelectId":"EdicionIdOBarcode",
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
	"SelectId":"EdicionEstadoDeLaPieza",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxListarEstadosDefinitivosAPP.php"
}`);
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
SelectDesdeConsulta(Config);

filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
var Indices=["EstadoDeLaPieza"];
var Objetos = ["EstadoDeLaPieza"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
var Config = JSON.parse(`
{
	"SelectId":"EdicionVinculo",
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
	$('#EdicionEstadoDeLaPieza').change(function(){
		if($('#EdicionEstadoDeLaPieza').val() == "Entregado"){
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
				"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxListarVinculo.php"
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

function EditarEstado(e){
	//console.log(e);
	if(EstadoDeLaPieza.value=="Entregado"){
		if(!Needed("EdicionIdOBarcode",1)){return;}
		if(!Needed("EdicionBarcode",1)){return;}
		if(!Needed("EdicionEstadoDeLaPieza",1)){return;}
		if(!Needed("EdicionVinculo",1)){return;}
		if(!Needed("EdicionApellidoYNombres",1)){return;}
		if(!Needed("EdicionDNI",1)){return;}
		if(!Needed("EdicionFechaI",1)){return;}
		if(!Needed("Edicionimage_uploads2",1)){return;}
		if(!Needed("EdicionIdEstado",1)){return;}
		
	}else{
		if(!Needed("EdicionIdOBarcode",1)){return;}
		if(!Needed("EdicionBarcode",1)){return;}
		if(!Needed("EdicionEstadoDeLaPieza",1)){return;}
		if(!Needed("EdicionIdEstado",1)){return;}
	}
	PostImagenDeFichero(e);
}


var Config = JSON.parse(`{
	"Elemento":"EliminacionIdEstado",
	"ElementoTexto":"BoltTextEliminacionIdEstado",
	"DigitosMinimos":"1",
	"TextoInicial":"",
	"TextoMenor":""
}`);
Texto(Config);
function EliminacionDeEstadosDePieza(){
	//console.log(e);
	if(!Needed("EliminacionIdEstado",1)){return;}
	
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=["Estado"];
	var Objetos=["EliminacionIdEstado"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/EstadosManuales/AjaxBorrarEstado.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	//console.log(Config);
	GrowlDesdeConsulta(Config);
	
}
 

