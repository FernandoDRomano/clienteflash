/*
$("#Barcode").on('keypress',function(e) {
    if(e.which == 13) {
        QuitarPiezaDeStock();
    }
});

Elementos::CrearImput("NombreBarcodeDesde","text","Codigo De Barra Desde:","4",'value="1000000"');
Elementos::CrearImput("NombreBarcodeHasta","text","Codigo De Barra Hasta:","4",'value="1000000"');
*/
/*
window.onload = function() {
  document.getElementById('NombreBarcodeDesde').style.display = 'none';
  document.getElementById('NombreBarcodeHasta').style.display = 'none';
};
*/

filtro=["IdUsuario","User","time"];
filtroX=[UserId,"","0"];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);
/*
var Indices=["FechaDesde","FechaHasta"];
var Objetos = ["FechaDesde","FechaHasta"];
var ValoresDirectos = ArraydsAJson(Indices,Objetos);
*/
var Config = JSON.parse(`
{
	"Elemento":"NombreBarcodeDesde",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":false,
	"TextoEnFail":"No Se Encontraron Resultados",
	"ValorDefault":"0",
	"Ajax":"` + URLJS + `XMLHttpRequest/Controldepiezas/AjaxBarcodeMaximo.php"
}`);
ValorDesdeConsulta(Config);

//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,

function SumarValoresDeElementosAElemento(ElementoA,ElementoB,ElementoC){
	var A = '#' + ElementoA + '';
	var B = '#' + ElementoB + '';
	var C = '#' + ElementoC + '';
	//console.log(A);
	//console.log($(A).val());
	$(C).val( $(A).val() * 1 + (($(B).val()*1)-1));
	//console.log($(C).val());
	//alert(console.log($(A).val()););
}

function CodigosDeBarraAStock(){
	SumarValoresDeElementosAElemento("NombreBarcodeDesde","CantidadDeCodigosDeBarra","NombreBarcodeHasta");
	var ContenedrDeCodigosDeBarra = document.getElementById("LinkBotonCodigoDeBarra");
	var CodigosDeBarra = ContenedrDeCodigosDeBarra.getElementsByTagName("img");
	var ArrayBarcodes = new Array;
	
	RespuestasDeMultipleEnvioDeConsulta = 0;
	if(CodigosDeBarra.length == 0){
		if(typeof $.bootstrapGrowl === "function"){
			$.bootstrapGrowl("Requiere Codigos De Barra En La Lista Para Poner En Stock",{
				type: 'danger',
				align: 'center',
				width: 'auto'
			});
		}
		return;
	}
	for(var i = 0 ; i < CodigosDeBarra.length ; i++){
		
		//ArrayBarcodes[i]=CodigosDeBarra[i].id;
		
		filtro=["Barcode","IdUsuario","User","time"];
		filtroX=[CodigosDeBarra[i].id,UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		/*
		var Indices=["Menues","Usuario"];
		var Objetos=["Menues","Usuario"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		*/
		var Config = JSON.parse(`
		{
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"EnvioActual":` + i + `,
			"CantidadDePosts":` + CodigosDeBarra.length + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/Controldepiezas/AjaxPiezaAStock.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		MultipleEnvioDeConsulta(Config);
	}
	//console.log(ArrayBarcodes);
}

function CrearBarcodes(){
	Loading();
	setTimeout(() => {
		SumarValoresDeElementosAElemento("NombreBarcodeDesde","CantidadDeCodigosDeBarra","NombreBarcodeHasta");
		var NombreBarcodeDesde = document.getElementById("NombreBarcodeDesde");
		var NombreBarcodeHasta = document.getElementById("NombreBarcodeHasta");
		var CantidadBarcode = document.getElementById("CantidadBarcode");
		//var Margen = document.getElementById("Margen");
		//console.log(CantidadBarcode.value);
		//console.log(NombreBarcodeDesde.value);
		//console.log(NombreBarcodeHasta.value);
		if(NombreBarcodeDesde.value!=""){
			if(NombreBarcodeHasta.value!=""){
				if(Number.isInteger(NombreBarcodeDesde.value*1)){
					if(Number.isInteger(NombreBarcodeHasta.value*1) ){
						if( (NombreBarcodeDesde.value*1) + 1000 < NombreBarcodeHasta.value*1){
							NombreBarcodeHasta.value = (NombreBarcodeDesde.value*1) + 1000;
							if(typeof $.bootstrapGrowl === "function") {
								$.bootstrapGrowl("<p>Su PC No Soporta Mas De 1000 Codigos De Barra:</p>",{
									type: 'danger',
									align: 'center',
									width: 'auto'
								});
								$.bootstrapGrowl("<p><b>Cantidad De Codigos De Barra Establecida En 1000 De Forma Forzada</b><p>",{
									type: 'success',
									align: 'center',
									width: 'auto'
								});
							}
						}
						console.log(NombreBarcodeDesde.value);
						console.log(NombreBarcodeHasta.value);
						for(var i=NombreBarcodeDesde.value*1; i <=  NombreBarcodeHasta.value*1;i++ ){
							BarcodeSet(i,CantidadBarcode.value, 0);//Margen.value
						}
					}else{
						BarcodeSet(NombreBarcodeDesde.value,CantidadBarcode.value, 0);//Margen.value
					}
				}else{
					BarcodeSet(NombreBarcodeDesde.value,CantidadBarcode.value, 0);//Margen.value
				}
			}else{
				BarcodeSet(NombreBarcodeDesde.value,CantidadBarcode.value, 0);//Margen.value
			}
		}
		EndLoading();
	}, 100);
}

jQuery(document).ready(function() {
	$("#Margen").keyup(function() {
		SetMargen();
	});
	$("#Margen").change(function() {
		SetMargen();
	});
	$("#Ancho").keyup(function() {
		SetAncho();
	});
	$("#Ancho").change(function() {
		SetAncho();
	});
	$("#Alto").keyup(function() {
		SetAlto();
	});
	$("#Alto").change(function() {
		SetAlto();
	});
});

function SetMargen(){
	//var MargenVal = document.getElementById("Margen");
	var elementCollection = new Array();
	var allElements = document.getElementsByTagName("hr");
	for(i = 0; i < allElements.length; i++){
		if(allElements[i].id == 'PMargen'){
			allElements[i].setAttribute('style',  "margin-bottom:"+(0*1+100*1)+'px;'+"margin-top: 0px;border-top-width: 1px;visibility: hidden;");
			//allElements[i].setAttribute('style',  "margin-bottom:"+(MargenVal.value*1+100*1)+'px;'+"margin-top: 0px;border-top-width: 1px;visibility: hidden;");
			
			//elementCollection.push(allElements[i]);
		}
	}
	
	//var PMargen = document.getElementById("PMargen");
	//alert(MargenVal.value);
}

function SetAncho(){
	var Ancho = document.getElementById("Ancho");
	var Alto = document.getElementById("Alto");
	var elementCollection = new Array();
	var allElements = document.getElementsByClassName("ImagenBC");
	for(i = 0; i < allElements.length; i++){
		//allElements[i].width = "" + Ancho.value +"px;";
		allElements[i].setAttribute('style',  "width:" + Ancho.value + "px;");
		Alto.value = (allElements[i].height);
		//alert(Ancho.value);
	}
	
	//var PMargen = document.getElementById("PMargen");
	//alert(MargenVal.value);
}


function SetAlto(){
	var Ancho = document.getElementById("Ancho");
	var Alto = document.getElementById("Alto");
	var elementCollection = new Array();
	var allElements = document.getElementsByClassName("ImagenBC");
	for(i = 0; i < allElements.length; i++){
		//allElements[i].height = "" + Alto.value +"px;";
		allElements[i].setAttribute('style',  "height:" + Alto.value + "px;");
		Ancho.value = (allElements[i].width);
		//alert(Alto.value);
	}
	
	//var PMargen = document.getElementById("PMargen");
	//alert(MargenVal.value);
}



function printdiv(printdivname){
	//var MargenVal = document.getElementById("Margen");
	//var SaveNumber = MargenVal.value;
	var headstr = "<html><head></head><body>";
	var footstr = "</body>";
	var newstr = document.getElementById(printdivname).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	
	window.print();
	document.body.innerHTML = oldstr;
	$("#Margen").keyup(function() {
		SetMargen();
	});
	$("#Margen").change(function() {
		SetMargen();
	});
	//var MargenVal = document.getElementById("Margen");
	//MargenVal.value  = SaveNumber;
	
	return false;
}
function LimpiarPantalla(){
	location.reload();
}


function DescargarPDFDeCodigosDeBarra(){
	makePDF();
}
async function makePDF() {//
	var x = document.getElementById("PapelXmm").value;
	var y = document.getElementById("PapelYmm").value;
	
	var doc = new jsPDF('l', 'mm',[x, y]);
	var ContenedrDeCodigosDeBarra = document.getElementById("LinkBotonCodigoDeBarra");
	var CodigosDeBarra = ContenedrDeCodigosDeBarra.getElementsByTagName("img");
	//doc.internal.pageSize.width = 100;
	//doc.internal.pageSize.height = 100;
	
	for(var i = 0 ; i < CodigosDeBarra.length ; i++){
		//var imgData = canvas.toDataURL('image/png');
		
		var svg = CodigosDeBarra[i].src.replace(/\r?\n|\r/g, '').trim();
		var canvas = document.createElement('canvas');
		var context = canvas.getContext('2d');

		context.clearRect(0, 0, x, y);
		canvg(canvas, svg);
		
		var imgData = canvas.toDataURL('image/png');
		//console.log(CodigosDeBarra[i].src);
		/*
		Here are the numbers (paper width and height) that I found to work. 
		It still creates a little overlap part between the pages, but good enough for me.
		if you can find an official number from jsPDF, use them.
		*/
		var imgWidth = canvas.width; 
		var pageHeight = canvas.height;  
		var imgHeight = canvas.height * imgWidth / canvas.width;
		var position = 0;
		
		doc.addImage(imgData, 'PNG', 0, 0, x, y);
		if(i < CodigosDeBarra.length -1){
			doc.addPage();
		}
	}
	doc.save( 'file.pdf');
}
