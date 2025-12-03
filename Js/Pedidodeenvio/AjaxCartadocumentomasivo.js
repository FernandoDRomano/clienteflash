    
    jQuery(document).ready(function() {
        const selectElement = document.querySelector('#custom-select-input');
        selectElement.addEventListener('change',function(){
            if(this.value == "Crea/Edita tus Plantillas"){
                this.value = "";
                window.location.href = "formularios";
            }else{
            }
        });
    });
    
	filtro=["IdUsuario","User","time"];
	filtroX=[UserId,"","0"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	//console.log(Parametros);
	var Indices=["TextBox"];//"NombreDeFormulario",
	var Objetos = ["textBox"];//"NombreDeFormulario",
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
	var Config = JSON.parse(`
	{
		"Elemento":"custom-select-list",
		"ElementoTexto":"",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":` + ValoresDirectos + `,
		"MensajeEnFail":true,
		"TextoEnFail":"",
		"CrearAlCargarDatos":true,
		"Reload":false,
		"Ajax":"` + Boveda + `/public/api/CartaDocumentoObtenerMisFormularios"
	}`);
	//"Elemento":"DivResApi",
	ElementoDesdeApi(Config); 

	function GuardarFormulario(){
		
		
		if(! Needed("NombreDeFormulario","1","Complete El Campo Con El Nombre De La Plantilla Que Desea Guardar")){return;}
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["NombreDeFormulario","TextBox"];
		var Objetos = ["NombreDeFormulario","textBox"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"",
			"ElementoTexto":"BoltTextRemitenteDNITipoApoderado",
			"ConFiltro":true,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":true,
			"TextoEnFail":"",
			"CrearAlCargarDatos":true,
			"Reload":true,
			"Ajax":"` + Boveda + `/public/api/CartaDocumentoCrearFormulario"
		}`);
		//"Elemento":"DivResApi",
		ElementoDesdeApi(Config); 
	}
	
	function EditarFormulario(){
		if(! Needed("NombreDeFormulario","1","Complete El Campo Con El Nombre De La Plantilla Que Desea Editar")){return;}
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["NombreDeFormulario","TextBox"];
		var Objetos = ["NombreDeFormulario","textBox"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"",
			"ElementoTexto":"BoltTextRemitenteDNITipoApoderado",
			"ConFiltro":true,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":true,
			"TextoEnFail":"",
			"CrearAlCargarDatos":true,
			"Reload":true,
			"Ajax":"` + Boveda + `/public/api/CartaDocumentoEditarFormulario"
		}`);
		//"Elemento":"DivResApi",
		ElementoDesdeApi(Config); 
	}
	
	function EliminarFormulario(){
		if(! Needed("NombreDeFormulario","1","Complete El Campo Con El Nombre De La Plantilla Que Desea Eliminar")){return;}
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["NombreDeFormulario","TextBox"];
		var Objetos = ["NombreDeFormulario","textBox"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"Elemento":"",
			"ElementoTexto":"BoltTextRemitenteDNITipoApoderado",
			"ConFiltro":true,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":true,
			"TextoEnFail":"",
			"CrearAlCargarDatos":true,
			"Reload":true,
			"Ajax":"` + Boveda + `/public/api/CartaDocumentoEliminarFormulario"
		}`);
		//"Elemento":"DivResApi",
		ElementoDesdeApi(Config); 
	}

	
	textBox.addEventListener("paste", function(e) {
		e.preventDefault();
		var text = (e.originalEvent || e).clipboardData.getData('text/plain');
		document.execCommand("insertHTML", false, text);
	});
	
	
	$(document).ready(function () {
		$("#Botonimage_uploads")[0].addEventListener('click', function(){ ShowElement($("#VistaPrevia")) });
		
	});
	function ShowElement(e){
		console.log(e);
		e.parent().parent().attr("style", "display:block;");
	}
	
	$(document).ready(function () {
		$("#custom-select-input")[0].addEventListener('change', function(){ HisdeEscondibles(this) });
		
	});
	
	$(document).ready(function () {
		for(var i = 0; i<$(".Escondibles").length ;i++){
			$(".Escondibles")[i].addEventListener('click', function(){ Mensaje("Por favor no modificar los títulos y el orden de las columnas. Solo completar con los datos correspondientes, de lo contrario no podrá avanzar con la carga masiva de datos") });
		}
	});
	
	function Mensaje(str = "Falta Mensaje"){
		if(typeof $.bootstrapGrowl === "function") {
			$.bootstrapGrowl(str,{
				type: 'success',
				align: 'center',
				width: 'auto'
			});
		}
	}
	
	function HisdeEscondibles(e){
		var DivDeLinksEjemplos = document.getElementsByClassName('Escondibles');
		for(var i = 0 ; i < DivDeLinksEjemplos.length ; i++){
			DivDeLinksEjemplos[i].style.display = "none" ;
		}
		DivDeLinksEjemplos[e.opcion].style.display = "block" ;
		e.parentElement.parentElement.classList.remove("col-md-12");
		e.parentElement.parentElement.classList.add("col-md-9");
		/*
		switch(){
			case :
			break;
			case :
			break;
			case :
			break;
			case :
			break;
			case :
			break;
			case :
			break;
			case :
			break;
		}
		console.log(e);
		console.log(e.opcion);
		
		*/
		//Escondibles
		//e.parent().parent().attr("style", "display:block;");
	}
	
	
	$(document).ready(function() {
		$('.select-2').select2({
		    theme: 'bootstrap4',
            language: "es",
		});
		$('#RemitenteProvincia').change(function(){
			if($('#RemitenteProvincia').val() != "0"){
				filtro=["IdUsuario","User","time"];
				filtroX=[UserId,"","0"];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				
				var Indices=["Id"];
				var Objetos = ["RemitenteProvincia"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				
				var Config = JSON.parse(`
				{
					"SelectId":"RemitenteLocalidad",
					"DataAjax":` + Parametros + `,
					"ValoresDirectos":` + ValoresDirectos + `,
					"MensajeEnFail":"true",
					"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
					"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxLocalidades.php"
				}`);
				//"ValoresDirectos":null,
				//"ValoresDirectos":` + ValoresDirectos + `,
				SelectDesdeConsulta(Config);
			}else{
				$("#RemitenteLocalidad").attr("readonly", true);
				//$("#DestinatarioLocalidad").empty().append('<option value="0">Seleccione</option>');
				$("#RemitenteLocalidad").empty();
			}
		});
		
		var Config = JSON.parse(`{
			"Elemento":"RemitenteDNITipoApoderado",
			"ElementoTexto":"BoltTextRemitenteDNITipoApoderado",
			"DigitosMinimos":"1",
			"TextoInicial":"",
			"TextoMenor":"Seleccione Opcion"
		}`);
		Texto(Config);
	});
	
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
		"SelectId":"RemitenteProvincia",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":"true",
		"TextoEnFail":"No Se Encontraron Resultados Para Seleccionar",
		"Ajax":"` + URLJS + `XMLHttpRequest/ParaSelects/AjaxProvincias.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	SelectDesdeConsulta(Config);
	
	jQuery(document).ready(function() {
		$("#SalirDeModal").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
		$("#SalirDeModall").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
		$("#EntrarAModall").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('show');
			//alert("Exec");
		});
		$("#EntrarAModall").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('show');
			//alert("Exec");
		});
		
	});


function formatDoc(sCmd, sValue){
	if (validateMode()){
		document.execCommand(sCmd, false, sValue); oDoc.focus();
	}
}

function validateMode(){
  if (!document.compForm.switchMode.checked){return true;}
  //alert("Uncheck \"Show HTML\".");
  oDoc.focus();
  return false;
}

var oDoc, sDefTxt;
$(document).ready(function(){
	oDoc = document.getElementById("textBox");
	sDefTxt = oDoc.innerHTML;
	if (document.compForm.switchMode.checked){setDocMode(true);}
});
	function VistaPreviaPDF(div){
		document.getElementById("iframePDF").style.display="block";
/*
		if(! Needed("DestinatarioNombre","1")){return;}
		if(! Needed("DestinatarioApellido","1")){return;}
		if(! Needed("DestinatarioProvincia","1")){return;}
		if(! Needed("DestinatarioLocalidad","1")){return;}
		if(! Needed("DestinatarioCodigoPostal","1")){return;}
		if(! Needed("DestinatarioCalle","1")){return;}
		if(! Needed("DestinatarioNumero","1")){return;}
*/
		//if(! Needed("DestinatarioPiso","1")){return;}
		//if(! Needed("DestinatarioDepartamento","1")){return;}


		var Tabla = document.getElementById("TablaDestinatario");
		if(Tabla.rows.length<2){
			//alert(Tabla.rows.length);
			document.getElementById("DivContenedorEcxelATabla").focus();
			if (typeof $.bootstrapGrowl === "function") {
				$.bootstrapGrowl( "Suba Plantilla Para Continuar", {
					type: 'danger',//danger
					align: 'center',
					width: 'auto'
				});
			}
			return;
		}
		
		if(! Needed("RemitenteNombre","1")){return;}
		if(! Needed("RemitenteCalle","1")){return;}
		if(! Needed("RemitenteNumero","1")){return;}
		
		//if(! Needed("RemitentePiso","1")){return;}
		//if(! Needed("RemitenteDepartamento","1")){return;}
		if(! Needed("RemitenteProvincia","1")){return;}
		if(! Needed("RemitenteLocalidad","1")){return;}
		if(! Needed("RemitenteCodigoPostal","4")){return;}
		if(! Needed("RemitenteEmail","1")){return;}
		if(! Needed("RemitenteCelular","14")){return;}
		//if(! Needed("RemitenteObservaciones","1")){return;}
		
		if(! Needed("RemitenteNombreApoderado","1")){return;}
		if(! Needed("RemitenteApellidoApoderado","1")){return;}
		if(! Needed("RemitenteDNITipoApoderado","1")){return;}
		if(! Needed("RemitenteDocumentoApoderado","1")){return;}
		
	
		Loading();
		setTimeout( CrearBasePDFDesdeDiv(div), 500 );
	}
	
	
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	var transparentColor = {
		r : 255,
		g : 255,
		b : 255
	};
	var EsperandoDescarga=false;
	function CrearBasePDFDesdeDiv(div){
		var ancho=216;
		var alto=355;
		var pdf = new jsPDF('p', 'mm',[alto,ancho]);
		//pdf.addPage();
		var Tabla = document.getElementById("TablaDestinatario");
		
		var FirmaSeleccionada = document.getElementsByName("image0")[0];
		if(FirmaSeleccionada == undefined){
			var Firma = URLJS +"XMLHttpRequest/FirmasDeClientes/uploads/null.png";
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Config = JSON.parse(`
			{
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":null,
				"MensajeEnFail":false,
				"TextoEnFail":"",
				"Ajax":"` + URLJS + `XMLHttpRequest/FirmasDeClientes/AjaxPonerFirmaDeUsuario.php"
			}`);
			//alert(URLJS);
			SyncObtenerValorDeConsulta(Config);
			
		}else{
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Config = JSON.parse(`
			{
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":null,
				"MensajeEnFail":false,
				"TextoEnFail":"Firma No Subida",
				"Ajax":"` + URLJS + `XMLHttpRequest/FirmasDeClientes/AjaxSacarFirmaDeUsuario.php"
			}`);
			SyncObtenerValorDeConsulta(Config);
			if(ResultadoSyncObtenerValorDeConsulta==''){
				var Firma = URLJS +"XMLHttpRequest/FirmasDeClientes/uploads/null.png";
			}else{
				var Firma = URLJS +"XMLHttpRequest/FirmasDeClientes/uploads/" + ResultadoSyncObtenerValorDeConsulta;
			}
		}
		
		
		var img = new Image();
		img.src = Firma;
		
		var IMGDISMINUIDA = new Image();
		IMGDISMINUIDA.onload = function () {
			var v = IMGDISMINUIDA.width;
			var h = IMGDISMINUIDA.height;
			var ScalaV = 20
			var ScalaH = Math.floor((v/h)*20);
			var imgBase = document.getElementById("imgBase");
			
			source = $('#'+div)[0];
			
			var Variables= new Array;
			var PosisionInicialDeVariable=-1;
			var PosisionFinalDeVariable=-1;
			for(var i = 0 ; i<source.innerHTML.length; i++){
				var PosisionInicialDeVariable = source.innerHTML.indexOf("[",i);
				var PosisionFinalDeVariable;
				if(PosisionInicialDeVariable>=0){
					PosisionFinalDeVariable = source.innerHTML.indexOf("]",PosisionInicialDeVariable);
					if(PosisionFinalDeVariable>=0){
						PosisionFinalDeVariable++;
						Variables[i] = source.innerHTML.substring(PosisionInicialDeVariable,PosisionFinalDeVariable);
						//console.log("Nombre De La Variable:(" + Variables[i] + ")");
						i = PosisionFinalDeVariable-1;
					}else{
						i = source.innerHTML.length;
					}
				}else{
					i = source.innerHTML.length;
				}
			}
			
			
			
			
			for(var i = 2 ; i<Tabla.rows.length; i++){
				if(i>2){
					pdf.addPage();
				}
				pdf.addImage(imgBase, 'JPEG', 0, 0,ancho , alto);
				
				pdf.addImage(IMGDISMINUIDA, 'PNG', 10, 305, ScalaH, ScalaV);
				
				TextoBasePDFCartaDocumentoServer(pdf,ancho,alto,100,i);
				
				var Ressource = source.cloneNode(true);
				for(var j = 0 ; j<Variables.length; j++){
					for(var k=0; k<Tabla.rows[1].cells.length;k++){
						if(Variables[j] == "[" + Tabla.rows[1].cells[k].innerHTML + "]"){
							Ressource.innerHTML = Ressource.innerHTML.replace(Variables[j],Tabla.rows[i].cells[k].innerHTML);
						}
					}
				}
				
				specialElementHandlers = {
					'#bypassme': function (element, renderer) {
						return true
					}
				};
				margins = {
					top: 182,
					bottom: 0,
					left: 10,
					width: 200-5
				};
				
				
				//console.log(source.innerHTML);
				
				pdf.fromHTML(
					Ressource, 
					margins.left,
					margins.top, {
						'width': margins.width, 
						'elementHandlers': specialElementHandlers
					},
					function (dispose) {
						//pdf.save('VistaPrevia.pdf');
						//console.log(pdf);
						data = pdf.output('datauristring');
						if( i+1 == Tabla.rows.length){
							pdf.save('VistaPrevia.pdf');
							$('iframe').attr('src', data);
							EndLoading();
						}
					}, margins
				);
			}
			//CrearPDFDesdeDiv(div,IMGDISMINUIDA,pdf);
		};
	
		IMGDISMINUIDA.onerror= function () {
		//alert("Firma No Encontrada");
		//CrearPDFDesdeDiv(div,null,pdf);
		};
	
		img.onload = function () {
			var v = img.width;
			var h = img.height;
			var ScalaV = 20
			var ScalaH = Math.floor((v/h)*20);
			 canvas.height = canvas.width * (img.height / img.width);
			 
			var oc = document.createElement('canvas'),
			octx = oc.getContext('2d');
			oc.width = img.width * 0.5;
			oc.height = img.height * 0.5;
			octx.clearRect(0,0, oc.width, oc.height);
			octx.drawImage(img, 0, 0, oc.width, oc.height);
			ctx.drawImage(oc, 0, 0, oc.width, oc.height,
			0, 0, canvas.width, canvas.height);
			var pixels = ctx.getImageData(0, 0, img.width, img.height);
			for(var i = 0, len = pixels.data.length; i < len; i += 4){
				var r = pixels.data[i];
				var g = pixels.data[i+1];
				var b = pixels.data[i+2];
				if(r == transparentColor.r && g == transparentColor.g && b == transparentColor.b){
					pixels.data[i+3] = 0;
				}
			}
			ctx.putImageData(pixels,0,0);
			IMGDISMINUIDA.src = canvas.toDataURL("image/png");
		};
		/*
		img.onerror= function () {
			CrearPDFDesdeDiv(div,null,pdf);
		};
		*/
	}
	
	
	function CrearPDFDesdeDiv(div,img,pdf){
		specialElementHandlers = {
			'#bypassme': function (element, renderer) {
				return true
			}
		};
		margins = {
			top: 182,
			bottom: 0,
			left: 10,
			width: 200-5
		};
		source = $('#'+div)[0];
		pdf.fromHTML(
			source, 
			margins.left,
			margins.top, {
				'width': margins.width, 
				'elementHandlers': specialElementHandlers
			},
			function (dispose) {
				//pdf.save('VistaPrevia.pdf');
				//console.log(pdf);
				data = pdf.output('datauristring')
				$('iframe').attr('src', data);
			}, margins
		);
	}
	function HTMLATexto(text){
		const span = document.createElement('span');
		return text
		.replace(/&[#A-Za-z0-9]+;/gi, (entity,position,text)=> {
			span.innerHTML = entity;
			return span.innerText;
		});
	}
	
	function TextoBasePDFCartaDocumentoServer(pdf,Ancho,Alto,Cabecera,Index){
		var Doc = pdf;
		var HCentro = Ancho/2;
		var VCentro = Alto/2;
		var Fuente = 12;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		var Linea = 1;
		var PosYPrevia = 0;
		var margen = 4;
		var Calc = ((Fuente/2)/2+1)+margen;
		var PosY = Calc;
		
		var Tabla = document.getElementById("TablaDestinatario");
		var NombreDeDestinatario,ApellidoDeDestinatario,Calle,Altura,Piso,Departamento,CodigoPostalDestinatario,LocalidadDestinatario,ProvinciaDestinatario;
		for(var i = 0 ; i<Tabla.rows[0].cells.length; i++){
			switch(Tabla.rows[1].cells[i].innerHTML){
				case "Destinatario-Nombre":
					NombreDeDestinatario = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Apellido":
					ApellidoDeDestinatario = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Provincia":
					ProvinciaDestinatario = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Localidad":
					LocalidadDestinatario = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-CodigoPostal":
					CodigoPostalDestinatario = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Calle":
					Calle = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Numero":
					Altura = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Piso":
					Piso = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
				case "Destinatario-Departamento":
					Departamento = HTMLATexto(Tabla.rows[Index].cells[i].innerHTML);
				break;
			}
		}
		
	//	var NombreDeDestinatario = document.getElementById("DestinatarioNombre").value;
	//	var ApellidoDeDestinatario = document.getElementById("DestinatarioApellido").value;
		if(ApellidoDeDestinatario != ""){
			var Destinatario = ApellidoDeDestinatario + " " + NombreDeDestinatario;
		}else{
			var Destinatario = NombreDeDestinatario;
		}
		
		var DomicilioDestino = "";
	//	var Calle = document.getElementById("DestinatarioCalle").value;
	//	var Altura = document.getElementById("DestinatarioNumero").value;
	//	var Piso = document.getElementById("DestinatarioPiso").value;
	//	var Departamento = document.getElementById("DestinatarioDepartamento").value;
		if(Calle != ""){DomicilioDestino = DomicilioDestino + Calle;}
		if(Altura != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + Altura;}
		if(Piso != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Piso:" + Piso;}
		if(Departamento != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Dpto:" + Departamento;}
		
	//	var CodigoPostalDestinatario = document.getElementById("DestinatarioCodigoPostal").value;
	//	var LocalidadDestinatario = document.getElementById("DestinatarioLocalidad").options[document.getElementById("DestinatarioLocalidad").selectedIndex].innerHTML;
	//	var ProvinciaDestinatario = document.getElementById("DestinatarioProvincia").options[document.getElementById("DestinatarioProvincia").selectedIndex].innerHTML;
		
		var CodigoPostal = CodigoPostalDestinatario;
		var Localidad = LocalidadDestinatario;
		var Provincia = ProvinciaDestinatario;
		
		var RightX = 150;
		
		Fuente = 12;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		var splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
		if(splitDestinatario.length > 1){
			Fuente = 8;
			pdf.setFontSize(Fuente);
			splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
			pdf.text(RightX,41-4, splitDestinatario);
			pdf.text(RightX,160-4, splitDestinatario);
		}else{
			Fuente = 12;
			pdf.setFontSize(Fuente);
			pdf.text(RightX,41, splitDestinatario);
			pdf.text(RightX,160, splitDestinatario);
		}
		
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(RightX,47, DomicilioDestino);
		pdf.text(RightX,165, DomicilioDestino);
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(RightX,52, CodigoPostal);
		pdf.text(RightX,170, CodigoPostal);
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(RightX,57, Localidad);
		pdf.text(RightX,175, Localidad);
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(RightX,62, Provincia);
		pdf.text(RightX,180, Provincia);
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Remitente
		var LeftX = 50;
		var NombreDeDestinatario = document.getElementById("RemitenteNombre").value;
		var Remitente = NombreDeDestinatario;
		
		var DomicilioRemitente = "";
		var CalleRemitente = document.getElementById("RemitenteCalle").value;
		var AlturaRemitente = document.getElementById("RemitenteNumero").value;
		var PisoRemitente = document.getElementById("RemitentePiso").value;
		var DepartamentoRemitente = document.getElementById("RemitenteDepartamento").value;
		if(CalleRemitente != ""){DomicilioRemitente = DomicilioRemitente + CalleRemitente;}
		if(AlturaRemitente != ""){if(DomicilioRemitente != ""){DomicilioRemitente = DomicilioRemitente + " ";} DomicilioRemitente = DomicilioRemitente + AlturaRemitente;}
		if(PisoRemitente != ""){if(DomicilioRemitente != ""){DomicilioRemitente = DomicilioRemitente + " ";} DomicilioRemitente = DomicilioRemitente + "Piso:" + PisoRemitente;}
		if(DepartamentoRemitente != ""){if(DomicilioRemitente != ""){DomicilioRemitente = DomicilioRemitente + " ";} DomicilioRemitente = DomicilioRemitente + "Dpto:" + DepartamentoRemitente;}
		
		var CodigoPostalRemitente = document.getElementById("RemitenteCodigoPostal").value;
		var LocalidadRemitente = document.getElementById("RemitenteLocalidad").options[document.getElementById("RemitenteLocalidad").selectedIndex].innerHTML;
		var ProvinciaRemitente = document.getElementById("RemitenteProvincia").options[document.getElementById("RemitenteProvincia").selectedIndex].innerHTML;
		
		Fuente = 12;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		
		var splitRemitente = pdf.splitTextToSize(Remitente, 55);
		if(splitRemitente.length > 1){
			Fuente = 8;
			pdf.setFontSize(Fuente);
			splitRemitente = pdf.splitTextToSize(Remitente, 55);
			pdf.text(LeftX,41-4, splitRemitente);
			pdf.text(LeftX,160-4, splitRemitente);
		}else{
			Fuente = 12;
			pdf.setFontSize(Fuente);
			pdf.text(LeftX,41, splitRemitente);
			pdf.text(LeftX,160, splitRemitente);
		}
		
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(LeftX,47, DomicilioRemitente);
		pdf.text(LeftX,165, DomicilioRemitente);
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(LeftX,52, CodigoPostalRemitente);
		pdf.text(LeftX,170, CodigoPostalRemitente);
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(LeftX,57, LocalidadRemitente);
		pdf.text(LeftX,175, LocalidadRemitente);
		
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		pdf.text(LeftX,62, ProvinciaRemitente);
		pdf.text(LeftX,180, ProvinciaRemitente);
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Aclaracion Y Documento
		var NombreDeApoderado = document.getElementById("RemitenteNombreApoderado").value;
		var ApellidoDeApoderado = document.getElementById("RemitenteApellidoApoderado").value;
		if(NombreDeApoderado != ""){
			var Apoderado = NombreDeApoderado + " " + ApellidoDeApoderado;
		}else{
			var Apoderado = NombreDeApoderado;
		}
		var ApoderadoTipoDeDocumento = document.getElementById("RemitenteDNITipoApoderado").value;
		var ApoderadoDocumento = document.getElementById("RemitenteDocumentoApoderado").value;
		if(ApoderadoTipoDeDocumento != ""){
			var ApoderadoDoc = ApoderadoTipoDeDocumento + " " + ApoderadoDocumento;
		}else{
			var ApoderadoDoc = ApoderadoDocumento;
		}
		Fuente = 12;
		pdf.setFontSize(Fuente);
		pdf.setTextColor(0, 0, 0);
		var splitApoderado = pdf.splitTextToSize(Apoderado, 45);
		if(splitApoderado.length > 1){
			Fuente = 8;
			pdf.setFontSize(Fuente);
			splitApoderado = pdf.splitTextToSize(Apoderado, 45);
		}else{Fuente = 12;}
		pdf.text(85,325, splitApoderado);
		Fuente = 8;
		pdf.setFontSize(Fuente);
		pdf.text(150,325, ApoderadoDoc);
	}
	
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

	function EnviarCartaDoccumento(e){
		$(".ModalDatos").fadeOut("slow");
		$('#ModalDatos').modal('hide');
		
		if( $ ('#EnviarCartaDoccumento').hasClass( "disabled" )){return;}
		/*
		if(! Needed("DestinatarioNombre","1")){return;}
		if(! Needed("DestinatarioApellido","1")){return;}
		if(! Needed("DestinatarioCalle","1")){return;}
		if(! Needed("DestinatarioNumero","1")){return;}
		*/
		
		if(! Needed("RemitenteNombre","1")){return;}
		if(! Needed("RemitenteCalle","1")){return;}
		if(! Needed("RemitenteNumero","1")){return;}
		
		if(! Needed("RemitenteProvincia","1")){return;}
		if(! Needed("RemitenteLocalidad","1")){return;}
		if(! Needed("RemitenteCodigoPostal","4")){return;}
		if(! Needed("RemitenteEmail","1")){return;}
		if(! Needed("RemitenteCelular","14")){return;}
		
		if(! Needed("RemitenteNombreApoderado","1")){return;}
		if(! Needed("RemitenteApellidoApoderado","1")){return;}
		if(! Needed("RemitenteDNITipoApoderado","1")){return;}
		if(! Needed("RemitenteDocumentoApoderado","1")){return;}
		//if(! Needed("RemitenteObservaciones","1")){return;}
		
		var FirmaSeleccionada = document.getElementsByName("image0")[0];
		if(FirmaSeleccionada == undefined){
			var Firma = URLJS +"XMLHttpRequest/FirmasDeClientes/uploads/null.png";
			filtro=["IdUsuario","User","time"];
			filtroX=[UserId,"","0"];
			var Parametros = ArraydsAJson(filtro,filtroX);
			Parametros = JSON.stringify(Parametros);
			var Config = JSON.parse(`
			{
				"DataAjax":` + Parametros + `,
				"ValoresDirectos":null,
				"MensajeEnFail":false,
				"TextoEnFail":"",
				"Ajax":"` + URLJS + `XMLHttpRequest/FirmasDeClientes/AjaxPonerFirmaDeUsuario.php"
			}`);
			//alert(URLJS);
			SyncObtenerValorDeConsulta(Config);
		}
		
		filtro=["IdUsuario","User","time","servicio_id"];
		filtroX=[UserId,"","0","33"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);
		var Indices=[
			"textBox"
		];
		var Objetos=[
		"textBox"
		];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);
		
		var ArraydJsonPostTitulo = "Piezas";
		var Indices=[
		,"RemitenteNombre","RemitenteNombreApoderado","RemitenteApellidoApoderado","RemitenteDNITipoApoderado","RemitenteDocumentoApoderado"
		,"RemitenteCodigoPostal","RemitenteProvincia","RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
		,"RemitenteEmail","RemitenteCelular","RemitenteObservaciones","TablaDestinatario"
		];
		var Objetos = [
		,"RemitenteNombre","RemitenteNombreApoderado","RemitenteApellidoApoderado","RemitenteDNITipoApoderado","RemitenteDocumentoApoderado"
		,"RemitenteCodigoPostal","RemitenteProvincia","RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
		,"RemitenteEmail","RemitenteCelular","RemitenteObservaciones","TablaDestinatario"
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
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ValorDefault":"0",
			"Ajax":"` + URLJS + `XMLHttpRequest/PedidoDeEnvio/AjaxCartaDocumentoMasiva.php"
		}`);
		ValoresAElementos(Config);
	}
	
	
	
	
	
	
	
	