/*
function SubirBase(Div){
	console.log(Div);
	alert("Subiendo");
	EndLoading();
}
*/

function SubirBase(){
	filtro=["IdUsuario","User","time","SucursalId","SucursalesDeUsuario"
	
	];
	filtroX=[UserId,"","0","4",SucursalesDeUsuario
	
	];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	console.log(Parametros);
	var Indices=["Tabla","fileinfo","FechaDeCargaSistemaFlash"];
	var Objetos = ["TablaSuba","fileinfoArchivo","FechaDeCargaSistemaFlash"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"DivContenedor":"DivRes",
		"ConFiltro":true,
		
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":false,
		"TextoEnFail":"No Se Encontraron Resultados",
		"CrearAlCargarDatos":true,
		"Ajax":"` + Boveda + `/public/api/SubaDeBancoMacro"
		
	}`);//`/public/api/SubaDeBancoMacro"
	//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
		//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	console.log(Config.Ajax);
	TablaDesdeBoveda(Config);
}


$(document).ready(function() {
	$('.InputUploadFilesRaw').change(function(){
		var input = this;
		
		var DivContenedor = this.parentElement.parentElement;
		if(input.files.item(0).name.search("VisaImpreRecep.067")>=0){//Grabadas Visa 1
			DivContenedor.setAttribute("Columnas","NumeroDeComprobante,CardCarrier,SecuenciaDeTargeta,NumeroDeCuenta,NumeroDeProceso,SucursalDeRadicacionDeLaCuenta,Categoria,TipoDeTarjeta,TipoDeOperacion,FechaHasta,Blancos,GrupoDeAfinidad,FechaDeAlta,FechaDeEmbozado,DenominacionDelUsuario,Calle,Puerta,Piso,NumeroDeDepartamento,Localidad,UsoReservado1,CodigoDeEntrega,Distribucion,NumeroDeSecuencia,CodigoPostal,Telefono,TipoDeDocumento,NumeroDeDocumento,NumeroDeSolicitud");
			DivContenedor.setAttribute("ColumnasDesde","0,9,19,35,45,51,54,55,56,60,68,70,74,82,90,114,139,144,146,149,169,185,186,188,192,196,208,211");
			DivContenedor.setAttribute("ColumnasHasta","9,19,35,45,51,54,55,56,60,68,70,74,82,90,114,139,144,146,149,169,185,186,188,192,196,208,211,227");
			DivContenedor.setAttribute("ReadDesde","1");
			DivContenedor.setAttribute("ReadHasta","1");
		}
		if(input.files.item(0).name.search("VisaImpreRecep.667")>=0){//Grabadas AMEX 4
			DivContenedor.setAttribute("Columnas","NumeroDeComprobante,CardCarrier,SecuenciaDeTargeta,NumeroDeCuenta,NumeroDeProceso,SucursalDeRadicacionDeLaCuenta,Categoria,TipoDeTarjeta,TipoDeOperacion,FechaHasta,Blancos,GrupoDeAfinidad,FechaDeAlta,FechaDeEmbozado,DenominacionDelUsuario,Calle,Puerta,Piso,NumeroDeDepartamento,Localidad,UsoReservado1,CodigoDeEntrega,Distribucion,NumeroDeSecuencia,CodigoPostal,Telefono,TipoDeDocumento,NumeroDeDocumento,NumeroDeSolicitud");
			DivContenedor.setAttribute("ColumnasDesde","0,9,19,35,45,51,54,55,56,60,68,70,74,82,90,114,139,144,146,149,169,185,186,188,192,196,208,211");
			DivContenedor.setAttribute("ColumnasHasta","9,19,35,45,51,54,55,56,60,68,70,74,82,90,114,139,144,146,149,169,185,186,188,192,196,208,211,221");
			DivContenedor.setAttribute("ReadDesde","1");
			DivContenedor.setAttribute("ReadHasta","1");
		}
		if(input.files.item(0).name.search("distri.flash")>=0){//Debito VISA 1
			DivContenedor.setAttribute("Columnas","Tarjeta,Nombre,Domicilio,Localidad,CodigoPostal,TipoDeTarjetaEmbosado,Recibo,CodigoDeSucursal,TipoDeEmision,TipoDeProducto,TipoDeDocumento,NumeroDeDocumento,Secuencia,FechaDeProceso,ColorDeEmbosado,CodigoDeEmision,PermicionariaEnCodigoDeEmision,Grupo,MarcaCardCarrier,CodigoEnsobrado,DistribucionDeTarjeta,DestinoSegunCodigoDeEmision,TelefonoDeCliente,EmisionDeTarjetasDeDatosUtiles,EmisionDeTarjetasDeDebito,cero,Filler");
			DivContenedor.setAttribute("ColumnasDesde","0,18,42,80,100,108,111,119,122,123,124,125,137,143,151,152,155,165,185,186,188,189,199,209,210,211");
			DivContenedor.setAttribute("ColumnasHasta","18,42,80,100,108,111,119,122,123,124,125,137,143,151,152,155,165,185,186,188,189,199,209,210,211,215");
			DivContenedor.setAttribute("ReadDesde","0");
			DivContenedor.setAttribute("ReadHasta","1");
		}
		
		if(input.files.item(0).name.search("SO305D.090")>=0){//Impresas Master
			DivContenedor.setAttribute("Columnas","TipoDeRegistro,NumeroDeTarjeta,NumeroDeICA,FechaVigenciaDesde,FechaVigenciaHasta,CodigoLimiteDeCompra,ImporteLimiteDeCompra,ImprteLimiteDeCredito,DatoNoValidable,ApellidoYNombre,DatoNoValidable2,CodigoDeLaEntidad,CodigoDeLaSucursal,FechaDeAlta,CalleYAltua,Piso,Departamento,CodigoPostal,Localidad,CodigoProvincia,Empresa,GrupoDeAfinidad,NombreDeGrupoDeAfinidad,DatoNoValidable3,TipoDeProceso,CodigoDeDestino,CodigoDeMovimiento,Clase,Cuenta,Autorizado,DatoNoValidable4,DigitoVerificador,Marca,CodigoDeMarca,Pais,NumeroDeTargetaAnterior,Permicionaria,TipoDeDocumento,Documento,DatoNoValidable5");
			DivContenedor.setAttribute("ColumnasDesde","0,1,18,24,29,34,35,46,57,60,90,91,94,97,102,132,134,137,142,162,164,182,187,204,205,206,207,210,212,219,220,222,223,226,231,232,248,250,252,261");
			DivContenedor.setAttribute("ColumnasHasta","1,18,24,29,34,35,46,57,60,90,91,94,97,102,132,134,137,142,162,164,182,187,204,205,206,207,210,212,219,220,222,223,226,231,232,248,250,252,261,349");
			DivContenedor.setAttribute("ReadDesde","1");
			DivContenedor.setAttribute("ReadHasta","2");
		}
		
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

		//var ElementBoton = document.createElement("button");
		var funcion = this.parentElement.parentElement.getAttribute("funcion");
		DivContenedor.NombreDeColumnas = DivContenedor.getAttribute("Columnas");
		DivContenedor.ColumnasDesde = DivContenedor.getAttribute("ColumnasDesde");
		DivContenedor.ColumnasHasta = DivContenedor.getAttribute("ColumnasHasta");
		
		DivContenedor.DesdeLinea = DivContenedor.getAttribute("ReadDesde");
		DivContenedor.HastaLinea = DivContenedor.getAttribute("ReadHasta");
		DivContenedor.filename = input.files.item(0).name;
		
		//ElementBoton.onclick = function() {
		//	Loading();
		//	setTimeout(function(){ window[funcion](DivContenedor);},100);
		//};
		//ElementBoton.className = "btn btn-large btn-block btn-primary";
		//var Elementi = document.createElement("i");
		//var TextoBoton;
		//if(input.files.length == 1 ){
		//	TextoBoton = document.createTextNode("Subir Archivo");
		//}else{
		//	TextoBoton = document.createTextNode("Subir Archivos");
		//}
		//Elementi.appendChild(TextoBoton);
		//ElementBoton.appendChild(Elementi);
		//ul.appendChild(ElementBoton);

		fileList.appendChild(ul);
		//FicherosADataDiv(DivContenedor);
		Loading();
		//console.log(DivContenedor);
		FicheroAConsola(DivContenedor);
	});
	
});


function FicheroAConsola(Div){
	FicheroANSIADataDivYTabla(Div);
}


function FicheroANSIADataDivYTabla(Div) {
	EndLoading();
	Div.data = new Array;
	var fileUpload = Div.getElementsByTagName("label")[0].getElementsByTagName("input")[0];
	if (typeof (FileReader) != "undefined") {
		var reader = new Array;
		reader[0] = new FileReader();
		if (reader[0].readAsBinaryString) {
			var CantidadDeLoads = 0 ;
			for(var i = 0 ; i<fileUpload.files.length ; i++){
				reader[i] = new FileReader();
				reader[i].onload = function (e) {
					CantidadDeLoads ++;
					Div.data.push(e.target.result);
					if(CantidadDeLoads == fileUpload.files.length){
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
	var DesdeLinea = Div.DesdeLinea;
	var HastaLinea = Div.HastaLinea;
	//console.log(Div.DesdeLinea);
	//console.log(Div.HastaLinea);
	var Config = Div.Config;
	var SizeLineas = Div.data[0].split(/\r?\n/).length;
	var SizeCabeza = Div.data[0].split(/\r?\n/)[0].length;
	var SizeCola = Div.data[0].split(/\r?\n/)[(Div.data[0].split(/\r?\n/).length) - 1].length;
	var Cabeza = Div.data[0].split(/\r?\n/)[0];
	var Cola = Div.data[0].split(/\r?\n/)[(Div.data[0].split(/\r?\n/).length) - 1];
	if(SizeLineas>1){
		var SizePrimeraLinea = Div.data[0].split(/\r?\n/)[1].length;
	}else{
		var SizePrimeraLinea = "";
	}
	var fileinfo = Div.getElementsByTagName("DATA")[0];
	
	
	fileinfo.fileinfo = {'fileinfoSizeLineas':SizeLineas,'fileinfoSizeCabeza':SizeCabeza,'fileinfoSizeCola':SizeCola,'fileinfoCabeza':Cabeza,'fileinfoCola':Cola,'fileinfoSizePrimeraLinea':SizePrimeraLinea,'fileinfoFilename':Div.filename};
	
	//Div.fileinfo = {'fileinfoSizeLineas':SizeLineas,'fileinfoSizeCabeza':SizeCabeza,'fileinfoSizeCola':SizeCola,'fileinfoCabeza':Cabeza,'fileinfoCola':Cola};
	//console.log(Div.fileinfo);
	/*
	console.log(SizeLineas);
	console.log(SizeCabeza);
	console.log(SizeCola);
	console.log(Cabeza);
	console.log(Cola);
	*/
	var data = Div.data;
	var Columnas = Div.NombreDeColumnas.split(",");
	var ColumnasDesde = Div.ColumnasDesde.split(",");
	var ColumnasHasta = Div.ColumnasHasta.split(",");
	if( (Columnas.length != ColumnasDesde.length || Columnas.length != ColumnasHasta.length )){
		//console.log("Columnas Inicio Y Fin No Concuerdan");
	}
	var ArraydData = data[0].split(/\r?\n/);
	var Arrayd2D = new Array();
	Arrayd2D[0]=Columnas;
	//(DesdeLinea*1)
	//- (HastaLinea*1)
	for(var i =  DesdeLinea*1 ; i < ArraydData.length  - (HastaLinea*1); i++){
		var Arrayd1D = new Array();
		for(var j = 0 ; j < Columnas.length ; j++){
			Arrayd1D[j] = ArraydData[i].substring(ColumnasDesde[j]*1, ColumnasHasta[j]*1)
		}
		Arrayd2D[i+1 -(DesdeLinea*1)] = Arrayd1D;
	}
	var ObjJSON = JSON.parse(JSON.stringify(Arrayd2D));
	Config.Resultado = ObjJSON;
	FormatearDatosParaTabla(Config);
	EndLoading();
};
