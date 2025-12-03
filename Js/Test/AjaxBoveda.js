/*
//filtro=["IdUsuario","User","time"];
//filtroX=[UserId,"","0"];
filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
filtroX=[UserId,"","0","4",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
var Config = JSON.parse(`
{
	"SelectId":"ComprobantesDeIngresos",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + Boveda + `/public/api/CI"
}`);
//"Ajax":"http://localhost:8081/boveda/public/api/ConsumeApi"
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
FlameSelectJquery(Config);
//alert(""+ Boveda);


//filtro=["IdUsuario","User","time"];
//filtroX=[UserId,"","0"];
filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
filtroX=[UserId,"","0","4",SucursalesDeUsuario];
var Parametros = ArraydsAJson(filtro,filtroX);
Parametros = JSON.stringify(Parametros);// Manda Como Texto
var Config = JSON.parse(`
{
	"SelectId":"HojasDeRutas",
	"DataAjax":` + Parametros + `,
	"ValoresDirectos":null,
	"MensajeEnFail":"true",
	"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
	"Ajax":"` + Boveda + `/public/api/HDR"
}`);
//"Ajax":"http://localhost:8081/boveda/public/api/ConsumeApi"
//"ValoresDirectos":null,
//"ValoresDirectos":` + ValoresDirectos + `,
FlameSelectJquery(Config);
*/

function BuscarPiezasDeApi(){
	filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
	filtroX=[UserId,"","0","4",SucursalesDeUsuario];
	
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF","NumeroDePieza","DNI","Destinatario"];
	var Objetos = ["FechaDesde","FechaHasta","NumeroDePieza","DNI","Destinatario"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivConsultaPieza",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + Boveda + `/public/api/BMConsultaDePiezasAndroid"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeBoveda(Config);
}





function BuscarPiezasDeApiTabla(){
	filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"];
	filtroX=[UserId,"","0","4",SucursalesDeUsuario];
	
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	var Indices=["FechaI","FechaF","NumeroDePieza","DNI","Destinatario","Tabla"];
	var Objetos = ["FechaDesde","FechaHasta","NumeroDePieza","DNI","Destinatario","TablaSuba"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivConsultaPieza",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		
		"CrearAlCargarDatos":false,
		"Ajax":"` + Boveda + `/public/api/BMConsultaDePiezasAndroid"
		
	}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	TablaDesdeBoveda(Config);
}



$(document).ready(function() {
	$('.InputUploadFilesRaw').change(function(){
		var input = this;
		var fileList = this.parentElement.parentElement.getElementsByClassName("ListaDeArchivos")[0];
		var SpanFile = this.parentElement.getElementsByClassName("SpanFile")[0];
		
		fileList.innerHTML = "";
		var Titulo;
		
		if(input.files.length == 0 ){
			SpanFile.innerHTML = "...";
			return;
		}
		if(input.files.length > 1 ){
			Titulo = document.createElement("b");
			var TextoTitulo = document.createTextNode('Archivos Seleccionados:');
			Titulo.appendChild(TextoTitulo);
			fileList.appendChild(Titulo);
			SpanFile.innerHTML = input.files.length + " Archivos";
		}
		if(input.files.length == 1 ){
			Titulo = document.createElement("b");
			var TextoTitulo = document.createTextNode('Archivo Seleccionado:');
			Titulo.appendChild(TextoTitulo);
			fileList.appendChild(Titulo);
			SpanFile.innerHTML = "1 Archivo";
		}
		var ul = document.createElement("ul");
		ul.className="IconFiles";
		
		for (var i = 0; i < input.files.length; ++i) {
			var li = document.createElement("li");
			li.className="IconFiles";
			var ic = document.createElement("i");
			ic.className="fas fa-file-alt";
			li.appendChild(ic);
			var Fichero = document.createTextNode(input.files.item(i).name);
			li.appendChild(Fichero);
			ul.appendChild(li);
		}
		/*
		var divBoton = document.createElement("div");
		divBoton.className = "col-md-12";
		divBoton.setAttribute = "float: none";
		*/
		
		var ElementBoton = document.createElement("button");
		var funcion = this.parentElement.parentElement.getAttribute("funcion");
		var DivContenedor = this.parentElement.parentElement;
		DivContenedor.NombreDeColumnas = DivContenedor.getAttribute("Columnas");
		DivContenedor.ColumnasDesde = DivContenedor.getAttribute("ColumnasDesde");
		DivContenedor.ColumnasHasta = DivContenedor.getAttribute("ColumnasHasta");
		
		//console.log(input.files);
		//console.log(input.files[0]);
		
		ElementBoton.onclick = function() {
			Loading();
			setTimeout(function(){ window[funcion](DivContenedor);},1000);
		};
		ElementBoton.className = "btn btn-large btn-block btn-primary";
		var Elementi = document.createElement("i");
		var TextoBoton;
		if(input.files.length == 1 ){
			TextoBoton = document.createTextNode("Cargar Archivo");
		}else{
			TextoBoton = document.createTextNode("Cargar Archivos");
		}
		Elementi.appendChild(TextoBoton);
		ElementBoton.appendChild(Elementi);
		//divBoton.appendChild(ElementBoton);
		ul.appendChild(ElementBoton);
		fileList.appendChild(ul);
		//console.log(DivContenedor);
		FicherosADataDiv(DivContenedor);
		Loading();
		FicheroAConsola(DivContenedor);
	});
	
});


function FicheroAConsola(Div){
	//console.log(Div);
	FicheroANSIADataDivYTabla(Div);
}


function FicheroANSIADataDivYTabla(Div) {
	//console.log(Div);
	EndLoading();
	Div.data = new Array;
	var fileUpload = Div.getElementsByTagName("label")[0].getElementsByTagName("input")[0];
	//var fileUpload = document.getElementById("UploadXLSX");
	if (typeof (FileReader) != "undefined") {
		var reader = new Array;
		reader[0] = new FileReader();
		//For Browsers other than IE.
		if (reader[0].readAsBinaryString) {
			var CantidadDeLoads = 0 ;
			for(var i = 0 ; i<fileUpload.files.length ; i++){
				
				reader[i] = new FileReader();
				reader[i].onload = function (e) {
					CantidadDeLoads ++;
					Div.data.push(e.target.result);
					//console.log("Datos Adentro" + Div.data);
					if(CantidadDeLoads == fileUpload.files.length){
						//ProcessExcel(Div.data);
						//console.log(Div);
						//console.log(Div.data);
						//CrearTablaDesdeEcxelADataDivYTabla(Div);
						CrearTablaDesdeRawDiv(Div);
					}
				};
				reader[i].readAsBinaryString(fileUpload.files[i]);
			}
		}
		
	}else{
		alert("This browser does not support HTML5.");
	}
};

function CrearTablaDesdeRawDiv(Div) {
	var Config = Div.Config;
	var data = Div.data;
	
	//console.log(Div.NombreDeColumnas);
	//console.log(Div.ColumnasDesde);
	//console.log(Div.ColumnasHasta);
	//console.log(data);
	//console.log(Config);
	
	var Columnas = Div.NombreDeColumnas.split(",");
	var ColumnasDesde = Div.ColumnasDesde.split(",");
	var ColumnasHasta = Div.ColumnasHasta.split(",");
	//console.log(Columnas);
	//console.log(ColumnasDesde);
	//console.log(ColumnasHasta);
	if( (Columnas.length != ColumnasDesde.length || Columnas.length != ColumnasHasta.length )){
		console.log("Columnas Inicio Y Fin No Concuerdan");
	}
	var ArraydData = data[0].split(/\r?\n/);
	var Arrayd2D = new Array();
	Arrayd2D[0]=Columnas;
	//console.log(Columnas.length);
	//console.log(ArraydData);
	//console.log(ColumnasDesde);
	//console.log(ColumnasHasta);
	for(var i = 0 ; i < ArraydData.length ; i++){
		var Arrayd1D = new Array();
		for(var j = 0 ; j < Columnas.length ; j++){
			Arrayd1D[j] = ArraydData[i].substring(ColumnasDesde[j]*1, ColumnasHasta[j]*1)
		}
		Arrayd2D[i+1] = Arrayd1D;
	}
	var ObjJSON = JSON.parse(JSON.stringify(Arrayd2D));
	Config.Resultado = ObjJSON;
	//console.log(Config);
	FormatearDatosParaTabla(Config);
	//EndLoading();
	EndLoading();
	
	/*
	var Arrayd1D = Resultado.split(";");
	var Arrayd2D = new Array();
	for(var i = 0 ; i < Arrayd1D.length ; i++ ){
		Arrayd2D[i] = Arrayd1D[i].split("|");
	}
	var ObjJSON = JSON.parse(JSON.stringify(Arrayd2D));
	Config.Resultado = ObjJSON;
	//console.log(Config);
	FormatearDatosParaTabla(Config);
	//EndLoading();
	EndLoading();
	*/
	
	
	
	
	
	
};

















