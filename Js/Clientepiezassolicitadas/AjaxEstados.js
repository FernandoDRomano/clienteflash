	
	/*
	var Config = JSON.parse(`{
		"Elemento":"ComprobanteDeIngreso",
		"ElementoTexto":"BoltTextComprobanteDeIngreso",
		"DigitosMinimos":"1",
		"TextoInicial":"", 
		"TextoMenor":""
	}`);
	Texto(Config);
	var Config = JSON.parse(`{
		"Elemento":"IdPieza",
		"ElementoTexto":"BoltTextIdPieza",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	*/
	var Config = JSON.parse(`{
		"Elemento":"BarcodeExterno",
		"ElementoTexto":"BoltTextBarcodeExterno",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	var Config = JSON.parse(`{
		"Elemento":"Documento",
		"ElementoTexto":"BoltTextDocumento",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	var Config = JSON.parse(`{
		"Elemento":"ApellidoYNombre",
		"ElementoTexto":"BoltTextApellidoYNombre",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":""
	}`);
	Texto(Config);
	
	
	jQuery(document).ready(function() {
		$("#SalirDeModal").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
		$("#SalirDeModal2").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
	});
	
	function Buscar(){
		//if(!Needed("ComprobanteDeIngreso",10)){return;}
		
		/*
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
			"Elemento":"Solicitudes",
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarValorPiezasSolicitadasPorCliente.php"
		}`);
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		ValorDesdeConsulta(Config);
		*/
		
		filtro=["User","time","UserId"];
		filtroX=["1",Math.random(),UserId];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		/*
		var Indices=["ComprobanteDeIngreso","BarcodeExterno","Documento","ApellidoYNombre","IdPieza","FechaI","FechaF"];
		var Objetos = ["ComprobanteDeIngreso","BarcodeExterno","Documento","ApellidoYNombre","IdPieza","FechaDesde","FechaHasta"];
		*/
		var Indices=["BarcodeExterno","Documento","ApellidoYNombre","FechaI","FechaF"];
		var Objetos = ["BarcodeExterno","Documento","ApellidoYNombre","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		//"ImputsAderidosTitulo":"Barcode A Establecer(,)Test 2",
		//<i class="fas fa-eye" style="font-size: 24px;color: #333333;"></i>
		//Ver Estados De Solicitud
		//btn btn-secondary mx-1 my-1 px-1 py-1 align-middle
		
		/*
		
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"fas fa-eye",
			"EstiloDeIconoParaFuncion":"font-size: 24px;color: #ffffff;",
		*/
		
		var EsconderElementos=["1","14","15"];
		
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezas",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` + EsconderElementos + `],
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasSolicitadasPorCliente.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);

	}

	function Reporte(){

		// filtro=["User","time","UserId"];
		// filtroX=["1",Math.random(),UserId];
		// var Parametros = ArraydsAJson(filtro,filtroX);
		// alert(UserId);

		var Documento = $('#Documento').val();
		var ApellidoYNombre = $('#ApellidoYNombre').val();
		var FechaDesde = $('#FechaDesde').val();
		var FechaHasta = $('#FechaHasta').val();
		var BarcodeExterno = $('#BarcodeExterno').val();

		location.href = "http://clienteflash.sppflash.com.ar/reporte.php?UserId=" + UserId +
																	 "&ApellidoYNombre=" + ApellidoYNombre +
																	 "&FechaDesde=" + FechaDesde +
																	 "&FechaHasta=" + FechaHasta +
																	 "&BarcodeExterno=" + BarcodeExterno +
																	 "&Documento=" + Documento;

	}
	
	function VerDetallesDePiezas(e){
		var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;
		//console.log(DivDeTabla.Config);
		//console.log(e);
		//console.log(e.Data);
		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('show');
		console.log(DivDeTabla.Config.Resultado[e.Data][0]);
		document.getElementById("DetalleDePiezaActual").innerHTML = DivDeTabla.Config.Resultado[e.Data][0];
		
		filtro=["User","time","PiezaId"];
		filtroX=["1",Math.random(),DivDeTabla.Config.Resultado[e.Data][0]];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		
		/*
		document.getElementById("EstadosDePiezasApellidoYNombre").value = DivDeTabla.Config.Resultado[e.Data][3];
		//document.getElementById("EstadosDePiezasDocumento").value = DivDeTabla.Config.Resultado[e.Data][5];                         ///????
		document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = DivDeTabla.Config.Resultado[e.Data][4];
		document.getElementById("EstadosDePiezasCodigoExterno").value = DivDeTabla.Config.Resultado[e.Data][1];
		document.getElementById("EstadosDePiezasUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasFechaUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][8];
		//document.getElementById("EstadosDePiezasRecibió").value = DivDeTabla.Config.Resultado[e.Data][12];//?
		//document.getElementById("EstadosDePiezasVínculo").value = DivDeTabla.Config.Resultado[e.Data][13];//?*/
				
		document.getElementById("EstadosDePiezasApellidoYNombre").value = DivDeTabla.Config.Resultado[e.Data][4];
		document.getElementById("EstadosDePiezasDocumento").value = DivDeTabla.Config.Resultado[e.Data][5];                         
		document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = DivDeTabla.Config.Resultado[e.Data][11];
		document.getElementById("EstadosDePiezasCodigoExterno").value = DivDeTabla.Config.Resultado[e.Data][1];
		document.getElementById("EstadosDePiezasUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][8];
		document.getElementById("EstadosDePiezasFechaUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][9];
		document.getElementById("EstadosDePiezasRecibió").value = DivDeTabla.Config.Resultado[e.Data][12];
		document.getElementById("EstadosDePiezasVínculo").value = DivDeTabla.Config.Resultado[e.Data][13];
		
		
		if(DivDeTabla.Config.Resultado[e.Data][15] != ""){ // o 15???
			document.getElementById("FotoAndroid").src = "https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/" + DivDeTabla.Config.Resultado[e.Data][15];
			document.getElementById("FotoAndroidSpp").src = "https://sispo.sppflash.com.ar/image/" + DivDeTabla.Config.Resultado[e.Data][15];
		}else{
			document.getElementById("FotoAndroid").src = "";
			document.getElementById("FotoAndroidSpp").src = "";
		}
		
		
		
		/*
		document.getElementById("EstadosDePiezasCodigoPostal").value = DivDeTabla.Config.Resultado[e.Data][6];
		document.getElementById("EstadosDePiezasLocalidad").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasProvincia").value = DivDeTabla.Config.Resultado[e.Data][8];
		console.log(DivDeTabla.Config.Resultado[e.Data]);
		*/
		
		/*
		var Indices=["ComprobanteDeIngreso","FechaI","FechaF"];
		var Objetos = ["ComprobanteDeIngreso","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		*/
		//"ImputsAderidosTitulo":"Barcode A Establecer(,)Test 2",
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePieza.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
	}
	
	function searchSispo(){
	    //alert("llega");
	    
		
		filtro=["User","time","UserId"];
		filtroX=["1",Math.random(),UserId];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto


		var Indices=["BarcodeExterno","Documento","ApellidoYNombre","FechaI","FechaF"];
		var Objetos = ["BarcodeExterno","Documento","ApellidoYNombre","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

		var EsconderElementos=["9","33","34","35","36"];
		
		//
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezasSispo",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` + EsconderElementos + `],
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasEstadosSispo.php"
			
		}`);
		
	    TablaDesdeConsulta(Config);
	    
	    //console.log(Config);
	}
	
	
	
	function VerDetallesDePiezasSispo(e){
		var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;
		//console.log(DivDeTabla.Config);
		//console.log(e);
		//console.log(e.Data);
		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('show');
		console.log(DivDeTabla.Config.Resultado[e.Data][0]);
		document.getElementById("DetalleDePiezaActual").innerHTML = DivDeTabla.Config.Resultado[e.Data][0];
		
		filtro=["User","time","PiezaId"];
		filtroX=["1",Math.random(),DivDeTabla.Config.Resultado[e.Data][0]];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		
	
		document.getElementById("EstadosDePiezasApellidoYNombre").value = DivDeTabla.Config.Resultado[e.Data][3];
		document.getElementById("EstadosDePiezasDocumento").value = DivDeTabla.Config.Resultado[e.Data][33];                        
		document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = DivDeTabla.Config.Resultado[e.Data][4];
		document.getElementById("EstadosDePiezasCodigoExterno").value = DivDeTabla.Config.Resultado[e.Data][1];
		document.getElementById("EstadosDePiezasUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasFechaUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][8];
		document.getElementById("EstadosDePiezasRecibió").value = DivDeTabla.Config.Resultado[e.Data][34];//?
		document.getElementById("EstadosDePiezasVínculo").value = DivDeTabla.Config.Resultado[e.Data][35];//?

		if(DivDeTabla.Config.Resultado[e.Data][36] != ""){
			document.getElementById("FotoAndroid").src = "https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/" + DivDeTabla.Config.Resultado[e.Data][36];
			document.getElementById("FotoAndroidSpp").src = "https://sispo.sppflash.com.ar/image/" + DivDeTabla.Config.Resultado[e.Data][36];
		}else{
			document.getElementById("FotoAndroid").src = "";
			document.getElementById("FotoAndroidSpp").src = "";
		}
		

		
		/*
		document.getElementById("EstadosDePiezasCodigoPostal").value = DivDeTabla.Config.Resultado[e.Data][6];
		document.getElementById("EstadosDePiezasLocalidad").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasProvincia").value = DivDeTabla.Config.Resultado[e.Data][8];
		console.log(DivDeTabla.Config.Resultado[e.Data]);
		*/
		
		/*
		var Indices=["ComprobanteDeIngreso","FechaI","FechaF"];
		var Objetos = ["ComprobanteDeIngreso","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		*/
		//"ImputsAderidosTitulo":"Barcode A Establecer(,)Test 2",
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePiezaSispo.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
	}
	function search(){
	    //alert("llega");
	    
		
		filtro=["User","time","UserId"];
		filtroX=["1",Math.random(),UserId];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto


		var Indices=["BarcodeExterno","Documento","ApellidoYNombre","FechaI","FechaF"];
		var Objetos = ["BarcodeExterno","Documento","ApellidoYNombre","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto

		var EsconderElementos=["9","33","34","35","36"];
		
		//
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivSolicitudes",
			"BotonParaFuncion":"VerDetallesDePiezas2",
			"TextoDeBotonParaFuncion":"Ver Datos De Pieza",
			"ClasseDeBotonParaFuncion":"btn btn-block btn-secondary",
			"ClasseDeIconoParaFuncion":"",
			"EstiloDeIconoParaFuncion":"",
			"EsconderElementos":[` + EsconderElementos + `],
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarPiezasEstados.php"
			
		}`);
		
	    TablaDesdeConsulta(Config);
	    
	    //console.log(Config);
	}
	
	
	
		function VerDetallesDePiezas2(e){
		var DivDeTabla = e.parentElement.parentElement.parentElement.parentElement;
		//console.log(DivDeTabla.Config);
		//console.log(e);
		//console.log(e.Data);
		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('show');
		console.log(DivDeTabla.Config.Resultado[e.Data][0]);
		document.getElementById("DetalleDePiezaActual").innerHTML = DivDeTabla.Config.Resultado[e.Data][0];
		
		filtro=["User","time","PiezaId"];
		filtroX=["1",Math.random(),DivDeTabla.Config.Resultado[e.Data][0]];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		
	
		document.getElementById("EstadosDePiezasApellidoYNombre").value = DivDeTabla.Config.Resultado[e.Data][3];
		document.getElementById("EstadosDePiezasDocumento").value = DivDeTabla.Config.Resultado[e.Data][33];                        
		document.getElementById("EstadosDePiezasDirecciónDeEntrega").value = DivDeTabla.Config.Resultado[e.Data][4];
		document.getElementById("EstadosDePiezasCodigoExterno").value = DivDeTabla.Config.Resultado[e.Data][1];
		document.getElementById("EstadosDePiezasUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasFechaUltimoEstado").value = DivDeTabla.Config.Resultado[e.Data][8];
		document.getElementById("EstadosDePiezasRecibió").value = DivDeTabla.Config.Resultado[e.Data][34];//?
		document.getElementById("EstadosDePiezasVínculo").value = DivDeTabla.Config.Resultado[e.Data][35];//?

		if(DivDeTabla.Config.Resultado[e.Data][36] != ""){
			document.getElementById("FotoAndroid").src = "https://archivoscompartidos.intranetflash.com/public/imagenes/acuses/" + DivDeTabla.Config.Resultado[e.Data][36];
			document.getElementById("FotoAndroidSpp").src = "https://sispo.sppflash.com.ar/image/" + DivDeTabla.Config.Resultado[e.Data][36];
		}else{
			document.getElementById("FotoAndroid").src = "";
			document.getElementById("FotoAndroidSpp").src = "";
		}
		

		
		/*
		document.getElementById("EstadosDePiezasCodigoPostal").value = DivDeTabla.Config.Resultado[e.Data][6];
		document.getElementById("EstadosDePiezasLocalidad").value = DivDeTabla.Config.Resultado[e.Data][7];
		document.getElementById("EstadosDePiezasProvincia").value = DivDeTabla.Config.Resultado[e.Data][8];
		console.log(DivDeTabla.Config.Resultado[e.Data]);
		*/
		
		/*
		var Indices=["ComprobanteDeIngreso","FechaI","FechaF"];
		var Objetos = ["ComprobanteDeIngreso","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		*/
		//"ImputsAderidosTitulo":"Barcode A Establecer(,)Test 2",
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivEstadosDePiezas",
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":null,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":false,
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/clientepiezassolicitadas/BuscarEstadosDePieza.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
		
	}
	
	
	function Reporte2(){
        console.log("Empezando la descarga")
		// filtro=["User","time","UserId"];
		// filtroX=["1",Math.random(),UserId];
		// var Parametros = ArraydsAJson(filtro,filtroX);
		// alert(UserId);

		var Documento = $('#Documento').val();
		var ApellidoYNombre = $('#ApellidoYNombre').val();
		var FechaDesde = $('#FechaDesde').val();
		var FechaHasta = $('#FechaHasta').val();
		var BarcodeExterno = $('#BarcodeExterno').val();

        location.href = URLJS + "XMLHttpRequest/clientepiezassolicitadas/reporteIntraSispo.php?UserId=" + UserId + "&ApellidoYNombre=" + ApellidoYNombre + "&FechaI=" + FechaDesde + "&FechaF=" + FechaHasta + "&BarcodeExterno=" + BarcodeExterno + "&Documento=" + Documento;
        console.log("Termino la descarga")
	}








