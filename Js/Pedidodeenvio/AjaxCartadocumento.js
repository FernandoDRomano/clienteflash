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







	function CopyToClipboard (texto) {
		var textToClipboard = texto;
		var success = true;
		if (window.clipboardData) { // Internet Explorer
			window.clipboardData.setData ("Text", textToClipboard);
		}
		else {
			
			var forExecElement = CreateElementForExecCommand (textToClipboard);
					/* Select the contents of the element 
						(the execCommand for 'copy' method works on the selection) */
			SelectContent (forExecElement);
			var supported = true;
				// UniversalXPConnect privilege is required for clipboard access in Firefox
			try {
				if (window.netscape && netscape.security) {
					netscape.security.PrivilegeManager.enablePrivilege ("UniversalXPConnect");
				}
					// Copy the selected content to the clipboard
					// Works in Firefox and in Safari before version 5
				success = document.execCommand ("copy", false, null);
			}
			catch (e) {
				success = false;
			}
			// remove the temporary element
			document.body.removeChild (forExecElement);
		}
		if (success) {
			//alert ("The text is on the clipboard, try to paste it!");
		}
		else {
			//alert ("Your browser doesn't allow clipboard access!");
		}
	}
	function SelectContent (element) {
		// first create a range
		var rangeToSelect = document.createRange ();
		rangeToSelect.selectNodeContents (element);
		// select the contents
		var selection = window.getSelection ();
		selection.removeAllRanges ();
		selection.addRange (rangeToSelect);
	}
	
	function CreateElementForExecCommand (textToClipboard) {
		var forExecElement = document.createElement ("div");
		// place outside the visible area
		forExecElement.style.position = "absolute";
		forExecElement.style.left = "-10000px";
		forExecElement.style.top = "-10000px";
		// write the necessary text into the element and append to the document
		forExecElement.textContent = textToClipboard;
		document.body.appendChild (forExecElement);
		// the contentEditable mode is necessary for the  execCommand method in Firefox
		forExecElement.contentEditable = true;
		return forExecElement;
	}
	function getSelectionRange() {
		var sel;
		if (window.getSelection) {
		sel = window.getSelection();
		if (sel.rangeCount) {
			return sel.getRangeAt(0);
		}
		} else if (document.selection) {
			return document.selection.createRange();
		}
		return null;
	}
	function Limpiardiv(e,event){
		//e.innerHTML=(e.innerHTML).replace("<img src=", "<img style='max-height:500px;max-width:500px;' src=");
		//var target = $('#capture');
		//console.log(event);
		rangeToSelect = getSelectionRange()
		console.log(getSelectionRange());
		var regex = /(<([^>]+)>)/ig;
		let paste = (event.clipboardData || window.clipboardData).getData('text');
		paste = paste.toUpperCase().replace(regex, "");
		CopyToClipboard(paste);
		console.log(paste);
		//e.focus();
		//e.innerHTML = e.innerHTML.replace(regex, "");
		var selection = window.getSelection ();
		selection.removeAllRanges ();
		selection.addRange (rangeToSelect);
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
	
	jQuery(document).ready(function() {
	    /*
		$("#SalirDeModal").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
		*/
		$("#SalirDeModall").on("click", function () {
			//$("#ModalDatos").fadeOut("slow");
			$('#ModalDatos').modal('hide');
			//alert("Exec");
		});
		
		/*
		$("#EntrarAModall").on("click", function () {
			$(".ModalDatos").fadeOut("slow");
			//$('#ModalDatos').modal('show');
			//alert("Exec");
		});
		*/
		
		$("#EntrarAModall").on("click", function () {
		    //COMENTADO PARA CAMBIAR POR UN ALERT SIMPLE
			//$("#ModalDatos").fadeOut("slow");
			//$('#ModalDatos').modal('show');
			//alert("Exec");
			const conf = confirm("Una vez confirmada la Carta Documento los datos contenidos en la misma no podrán modificarse. Controle antes de confirmar su envío ya que luego no se podrán hacer reclamos al correo por datos incorrectos o inexistentes");
		    if(conf){
		        EnviarCartaDoccumento(this)
		    }
		    
		});
		
		
	});
	$(document).ready(function() {
		$('.select-2').select2({
		    theme: 'bootstrap4',
            language: "es",
		});
		
		$('#DestinatarioProvincia').change(function(){
			if($('#DestinatarioProvincia').val() != "0"){
				filtro=["IdUsuario","User","time"];
				filtroX=[UserId,"","0"];
				var Parametros = ArraydsAJson(filtro,filtroX);
				Parametros = JSON.stringify(Parametros);// Manda Como Texto
				
				var Indices=["Id"];
				var Objetos = ["DestinatarioProvincia"];
				var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
				
				var Config = JSON.parse(`
				{
					"SelectId":"DestinatarioLocalidad",
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
				$("#DestinatarioLocalidad").attr("readonly", true);
				//$("#DestinatarioLocalidad").empty().append('<option value="0">Seleccione</option>');
				$("#DestinatarioLocalidad").empty();
			}
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
	
	
	filtro=["IdUsuario","User","time","Id"];
	filtroX=[UserId,"","0","24"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	/*
	var Indices=["FechaI","FechaF"];
	var Objetos = ["FechaI","FechaF"];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	*/
	var Config = JSON.parse(`
	{
		"SelectId":"DestinatarioProvincia",
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
		"Elemento":"ApiKey",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"Ocurrio Un Error Al Cargar, Reintente",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/PedidoDeEnvio/AjaxApiKey.php"
	}`);
	ValorDesdeConsulta(Config);
	//"ValoresDirectos":` + ValoresDirectos + `,
	
	
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
		"Elemento":"SecretKey",
		"DataAjax":` + Parametros + `,
		"ValoresDirectos":null,
		"MensajeEnFail":false,
		"TextoEnFail":"Ocurrio Un Error Al Cargar, Reintente",
		"ValorDefault":"0",
		"Ajax":"` + URLJS + `XMLHttpRequest/PedidoDeEnvio/AjaxSecretKey.php"
	}`);
	ValorDesdeConsulta(Config);
	//"ValoresDirectos":` + ValoresDirectos + `,
	
	var Config = JSON.parse(`{
		"Elemento":"RemitenteDNITipoApoderado",
		"ElementoTexto":"BoltTextRemitenteDNITipoApoderado",
		"DigitosMinimos":"1",
		"TextoInicial":"",
		"TextoMenor":"Seleccione Opcion"
	}`);
	Texto(Config);
	
});

function EnviarCartaDoccumento(e){
	//alert(textBox);
	
	//$(".ModalDatos").fadeOut("slow");
	$('#ModalDatos').modal('hide');
	if( $ ('#EnviarCartaDoccumento').hasClass( "disabled" )){return;}
	
	
	if(! Needed("DestinatarioNombre","1")){return;}
	if(! Needed("DestinatarioApellido","1")){return;}
	if(! Needed("DestinatarioProvincia","1")){return;}
	if(! Needed("DestinatarioLocalidad","1")){return;}
	if(! Needed("DestinatarioCodigoPostal","4")){return;}
	if(! Needed("DestinatarioCalle","1")){return;}
	if(! Needed("DestinatarioNumero","1")){return;}
	//if(! Needed("DestinatarioPiso","1")){return;}
	//if(! Needed("DestinatarioDepartamento","1")){return;}
	
	//if(! Needed("DestinatarioObservaciones","1")){return;}
	
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
	//if(! Needed("RemitenteObservaciones","1")){return;}
	
	//if(! Needed("RemitenteNumeroInterno","1")){return;}
	//if(! Needed("RemitenteReferencia","1")){return;}
	//if(! Needed("RemitenteInformacionAdicional","1")){return;}
	
	//if(! Needed("textBox","1")){return;}
	
	
	filtro=["IdUsuario","User","time","servicio_id"];
	filtroX=[UserId,"","0","33"];
	var Parametros = ArraydsAJson(filtro,filtroX);
	Parametros = JSON.stringify(Parametros);// Manda Como Texto
	
	var Indices=[
	"textBox"
	//,"RemitenteNumeroInterno","RemitenteReferencia","RemitenteInformacionAdicional"
	];
	
	var Objetos=[
	"textBox"
	//,"RemitenteNumeroInterno","RemitenteReferencia","RemitenteInformacionAdicional"
	];
	var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	//console.log(ValoresDirectos);
	
	
	var ArraydJsonPostTitulo = "Piezas";
	var Indices=[
	"DestinatarioNombre","DestinatarioApellido","DestinatarioCodigoPostal","DestinatarioProvincia","DestinatarioLocalidad",,"DestinatarioCalle","DestinatarioNumero","DestinatarioPiso","DestinatarioDepartamento"
	//,"DestinatarioObservaciones"
	,"RemitenteNombre","RemitenteNombreApoderado","RemitenteApellidoApoderado","RemitenteDNITipoApoderado","RemitenteDocumentoApoderado"
	,"RemitenteCodigoPostal","RemitenteProvincia","RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
	,"RemitenteEmail","RemitenteCelular","RemitenteObservaciones"
	];
	var Objetos = [
	"DestinatarioNombre","DestinatarioApellido","DestinatarioCodigoPostal","DestinatarioProvincia","DestinatarioLocalidad",,"DestinatarioCalle","DestinatarioNumero","DestinatarioPiso","DestinatarioDepartamento"
	//,"DestinatarioObservaciones"
	,"RemitenteNombre","RemitenteNombreApoderado","RemitenteApellidoApoderado","RemitenteDNITipoApoderado","RemitenteDocumentoApoderado"
	,"RemitenteCodigoPostal","RemitenteProvincia","RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
	,"RemitenteEmail","RemitenteCelular","RemitenteObservaciones"
	];
	var ArraydJsonPost = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
	
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
		"Ajax":"` + URLJS + `XMLHttpRequest/PedidoDeEnvio/AjaxCartaDocumento.php"
	}`);
	//"ValoresDirectos":null,
	//"ValoresDirectos":` + ValoresDirectos + `,
	ValoresAElementos(Config);
	//ValorDesdeConsulta(Config);
}


/****************************************************************************************************************/
//Div Editable (Solo 1 Por Pagina)
function TImage(){
	var imgSrc = prompt('Enter image location', '');
	if (validateMode()) { document.execCommand('insertimage', false, imgSrc);   oDoc.focus(); }
	var box = document.getElementById("textBox");
	//alert(box.innerHTML);
	box.innerHTML=(box.innerHTML).replace("<img src=", "<img style='max-height:500px;max-width:500px;' src=");;
   
}
function printDoc() {
	if (!validateMode()){return;}
	var oPrntWin = window.open("","_blank","width=450,height=1470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
	oPrntWin.document.open();
	oPrntWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body onload=\"print();\">" + oDoc.innerHTML + "<\/body><\/html>");
	oPrntWin.document.close();
}
var oDoc, sDefTxt;
$(document).ready(function(){
	oDoc = document.getElementById("textBox");
	sDefTxt = oDoc.innerHTML;
	if (document.compForm.switchMode.checked){setDocMode(true);}
});
function setDocMode(bToSource){
	var oContent;
	if (bToSource){
		oContent = document.createTextNode(oDoc.innerHTML);
		oDoc.innerHTML = "";
		var oPre = document.createElement("pre");
		oDoc.contentEditable = false;
		oPre.id = "sourceText";
		oPre.contentEditable = true;
		oPre.appendChild(oContent);
		oDoc.appendChild(oPre);
		document.execCommand("defaultParagraphSeparator", false, "div");
	}else{
		if(document.all){
			oDoc.innerHTML = oDoc.innerText;
		}else{
			oContent = document.createRange();
			oContent.selectNodeContents(oDoc.firstChild);
			oDoc.innerHTML = oContent.toString();
		}
		oDoc.contentEditable = true;
	}
	oDoc.focus();
}
function validateMode(){
  if (!document.compForm.switchMode.checked){return true;}
  //alert("Uncheck \"Show HTML\".");
  oDoc.focus();
  return false;
}
function formatDoc(sCmd, sValue){
	if (validateMode()){
		document.execCommand(sCmd, false, sValue); oDoc.focus();
	}
}
//Div Editable
/*************************************************************************************************************/

function VistaPreviaPDF(div){
	
	if(! Needed("DestinatarioNombre","1")){return;}
	if(! Needed("DestinatarioApellido","1")){return;}
	if(! Needed("DestinatarioProvincia","1")){return;}
	if(! Needed("DestinatarioLocalidad","1")){return;}
	if(! Needed("DestinatarioCodigoPostal","4")){return;}
	if(! Needed("DestinatarioCalle","1")){return;}
	if(! Needed("DestinatarioNumero","1")){return;}
	//if(! Needed("DestinatarioPiso","1")){return;}
	//if(! Needed("DestinatarioDepartamento","1")){return;}
	
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
	document.getElementById("iframePDF").style.display="block";
	
	Loading();
	setTimeout( CrearBasePDFDesdeDiv(div), 1 );
	
	//ImagenFirmaBasePDFCartaDocumento(div);
}
function DibujoBasePDFCartaDocumento(pdf,Ancho,Alto,Cabecera){
	var Doc = pdf;
	var HCentro = Ancho/2;
	var VCentro = Alto/2;
	
	//Recuadro
	pdf.setDrawColor(0,0,0);
	pdf.setFillColor(0,0,0);//
	pdf.rect(1, 1, Ancho-2, 216, 'D');//F = Solido //FD Solido borde //D Borde
	
	//Cabecera
	pdf.setDrawColor(0,0,0);
	pdf.setFillColor(0,0,0);//
	pdf.rect(1, Cabecera, Ancho-2, Alto-Cabecera-1, 'D');//F = Solido //FD Solido borde //D Borde
	
	pdf.line (HCentro, 1, HCentro, Cabecera); // linea horizontal  
    pdf.setLineWidth (0.5);
	
}
function addWaterMark(doc,Ancho,Alto){
	var HCentro = Ancho/2;
	var VCentro = Alto/2;
	var totalPages = doc.internal.getNumberOfPages();
	for (i = 1; i <= totalPages; i++) {
		doc.setPage(i);
		doc.setTextColor(255, 255, 255,10);
		doc.setFontSize(6);
		for(var i = 10 ; i < Alto ; i+=20){
			doc.text(10, i, '             COPIA NO VALIDA LEGALMENTE.                                                                COPIA NO VALIDA LEGALMENTE.                                                                COPIA NO VALIDA LEGALMENTE.');
		}
		//doc.text(50, doc.internal.pageSize.height - 30, 'Watermark');
	}
	return doc;
}

function pdfCuadricula(pdf,Ancho,Alto,Cabecera){
	pdf.setFontSize(6);
	
	pdf.setTextColor(0, 0, 0);
	for(var i = 5 ; i < Alto ; i+=5){
		pdf.text(10,i, ''+i);
		pdf.line (0, i, Ancho, i);
	}
	for(var i = 5 ; i < Ancho ; i+=5){
		pdf.text(i,10, ''+i);
		pdf.line (i, 0, i, Alto);
	}
}

function TextoBasePDFCartaDocumento(pdf,Ancho,Alto,Cabecera){
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
	
	var NombreDeDestinatario = document.getElementById("DestinatarioNombre").value;
	var ApellidoDeDestinatario = document.getElementById("DestinatarioApellido").value;
	if(ApellidoDeDestinatario != ""){
		var Destinatario = ApellidoDeDestinatario + " " + NombreDeDestinatario;
	}else{
		var Destinatario = NombreDeDestinatario;
	}
	
	var DomicilioDestino = "";
	var Calle = document.getElementById("DestinatarioCalle").value;
	var Altura = document.getElementById("DestinatarioNumero").value;
	var Piso = document.getElementById("DestinatarioPiso").value;
	var Departamento = document.getElementById("DestinatarioDepartamento").value;
	if(Calle != ""){DomicilioDestino = DomicilioDestino + Calle;}
	if(Altura != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + Altura;}
	if(Piso != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Piso:" + Piso;}
	if(Departamento != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Dpto:" + Departamento;}
	
	var CodigoPostalDestinatario = document.getElementById("DestinatarioCodigoPostal").value;
	var LocalidadDestinatario = document.getElementById("DestinatarioLocalidad").value;
	var ProvinciaDestinatario = document.getElementById("DestinatarioProvincia").value;
	
	var CodigoPostal = CodigoPostalDestinatario;
	var Localidad = LocalidadDestinatario;
	var Provincia = ProvinciaDestinatario;
	
	var RightX = 147;
	
	Fuente = 12;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	var splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
	if(splitDestinatario.length > 1){
		Fuente = 8;
		pdf.setFontSize(Fuente);
		splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
	}else{Fuente = 12;}
	pdf.setFontSize(Fuente);
	pdf.text(RightX,36, splitDestinatario);
	pdf.text(RightX,154, splitDestinatario);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(RightX,44, DomicilioDestino);
	pdf.text(RightX,161, DomicilioDestino);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(RightX,50, CodigoPostal);
	pdf.text(RightX,166, CodigoPostal);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(RightX,55, Localidad);
	pdf.text(RightX,171, Localidad);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(RightX,60, Provincia);
	pdf.text(RightX,176, Provincia);
	
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
	var LocalidadRemitente = document.getElementById("RemitenteLocalidad").value;
	var ProvinciaRemitente = document.getElementById("RemitenteProvincia").value;
	
	
	Fuente = 12;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	
	var splitRemitente = pdf.splitTextToSize(Remitente, 55);
	if(splitRemitente.length > 1){
		Fuente = 8;
		pdf.setFontSize(Fuente);
		splitRemitente = pdf.splitTextToSize(Remitente, 55);
	}else{Fuente = 12;}
	
	pdf.setFontSize(Fuente);
	pdf.text(LeftX,36, splitRemitente);
	pdf.text(LeftX,154, splitRemitente);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(LeftX,44, DomicilioRemitente);
	pdf.text(LeftX,161, DomicilioRemitente);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(LeftX,50, CodigoPostalRemitente);
	pdf.text(LeftX,166, CodigoPostalRemitente);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(LeftX,55, LocalidadRemitente);
	pdf.text(LeftX,171, LocalidadRemitente);
	
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.setTextColor(0, 0, 0);
	pdf.text(LeftX,60, ProvinciaRemitente);
	pdf.text(LeftX,176, ProvinciaRemitente);
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Aclaracion Y Documento
	var NombreDeApoderado = document.getElementById("RemitenteNombreApoderado").value;
	var ApellidoDeApoderado = document.getElementById("RemitenteApellidoApoderado").value;
	if(RemitenteNombre != ""){
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
	pdf.text(85,315, splitApoderado);
	Fuente = 8;
	pdf.setFontSize(Fuente);
	pdf.text(150,315, ApoderadoDoc);
}


function TextoBasePDFCartaDocumentoServer(pdf,Ancho,Alto,Cabecera){
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
	
	var NombreDeDestinatario = document.getElementById("DestinatarioNombre").value;
	var ApellidoDeDestinatario = document.getElementById("DestinatarioApellido").value;
	if(ApellidoDeDestinatario != ""){
		var Destinatario = ApellidoDeDestinatario + " " + NombreDeDestinatario;
	}else{
		var Destinatario = NombreDeDestinatario;
	}
	
	var DomicilioDestino = "";
	var Calle = document.getElementById("DestinatarioCalle").value;
	var Altura = document.getElementById("DestinatarioNumero").value;
	var Piso = document.getElementById("DestinatarioPiso").value;
	var Departamento = document.getElementById("DestinatarioDepartamento").value;
	if(Calle != ""){DomicilioDestino = DomicilioDestino + Calle;}
	if(Altura != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + Altura;}
	if(Piso != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Piso:" + Piso;}
	if(Departamento != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Dpto:" + Departamento;}
	
	var CodigoPostalDestinatario = document.getElementById("DestinatarioCodigoPostal").value;
	var LocalidadDestinatario = document.getElementById("DestinatarioLocalidad").options[document.getElementById("DestinatarioLocalidad").selectedIndex].innerHTML;
	var ProvinciaDestinatario = document.getElementById("DestinatarioProvincia").options[document.getElementById("DestinatarioProvincia").selectedIndex].innerHTML;
	
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

/*
function getImgFromUrl(logo_url, callback) {
    var img = new Image();
    img.src = logo_url;
    img.onload = function () {
        callback(img);
    };
}
function loadImage(src, callback) {
    var img = new Image();
    img.onload = callback;
    img.setAttribute('crossorigin', 'anonymous'); // works for me
    img.src = src;
    return img;
}
function ImagenFirmaBasePDFCartaDocumento(div){
	var logo_url = "/logo.png";
	getImgFromUrl(logo_url, function (img) {
		//generatePDF(img);
		CrearPDFDesdeDiv(div,img);
	});
	//var imgData = new Image()
	//imgData.src = 'https://graph.facebook.com/10207333389077000/picture?type=large'
	//var imgData = 'data:image/jpeg;base64,'+ Base64.encode('Koala.jpeg');
}
*/

function CrearPDFDesdeDiv(div,img,pdf){
	if(img != null){
		var v = img.width;
        var h = img.height;
		var ScalaV = 20
		var ScalaH = Math.floor((v/h)*20);
		console.log(ScalaV);
		console.log(ScalaH);
		console.log(img);
		pdf.addImage(img, 'PNG', 10, 305, ScalaH, ScalaV);
	}
	
	specialElementHandlers = {
		'#bypassme': function (element, renderer) {
			return true
		}
	};
	
	//Paragrapiframe
	//var htmlString ="<html><body ><P id='Paragrapiframe'>INPUT TYPEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</label></body></html>";
	//pdf.fromHTML(htmlString,100,100,{});
	
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
			EndLoading();
		}, margins
	);
}


var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var transparentColor = {
    r : 255,
    g : 255,
    b : 255
};

function CrearBasePDFDesdeDiv(div){
	
	var ancho=216;
	var alto=355;
	var pdf = new jsPDF('p', 'mm',[alto,ancho]);
	
	var imgBase = document.getElementById("imgBase");
	pdf.addImage(imgBase, 'JPEG', 0, 0,ancho , alto);
	
	//addWaterMark(pdf,ancho,alto);
	//pdfCuadricula(pdf,ancho,alto,100);
	TextoBasePDFCartaDocumentoServer(pdf,ancho,alto,100);
	//TextoBasePDFCartaDocumento(pdf,ancho,alto,100);
	/*
	DibujoBasePDFCartaDocumento(pdf,216,279,100);
	*/
	//ImagenFirmaBasePDFCartaDocumento(pdf,266,279,100);
	
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
	
	//var Firma = URLJS +"XMLHttpRequest/FirmasDeClientes/uploads/" + ResultadoSyncObtenerValorDeConsulta;
    var img = new Image();
    img.src = Firma;
	
	var IMGDISMINUIDA = new Image();
	IMGDISMINUIDA.onload = function () {
		CrearPDFDesdeDiv(div,IMGDISMINUIDA,pdf);
	};
	IMGDISMINUIDA.onerror= function () {
        //alert("Firma No Encontrada");
		CrearPDFDesdeDiv(div,null,pdf);
    };
	
	img.onload = function () {
		//alterImage(img)
		
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
		//octx.drawImage(oc, 0, 0, oc.width * 0.5, oc.height * 0.5);
		//ctx.drawImage(oc, 0, 0, oc.width * 0.5, oc.height * 0.5,
		//0, 0, canvas.width, canvas.height);
		ctx.drawImage(oc, 0, 0, oc.width, oc.height,
		0, 0, canvas.width, canvas.height);
		
		var pixels = ctx.getImageData(0, 0, img.width, img.height);

		// iterate through pixel data (1 pixels consists of 4 ints in the array)
		for(var i = 0, len = pixels.data.length; i < len; i += 4){
			var r = pixels.data[i];
			var g = pixels.data[i+1];
			var b = pixels.data[i+2];

			// if the pixel matches our transparent color, set alpha to 0
			if(r == transparentColor.r && g == transparentColor.g && b == transparentColor.b){
				pixels.data[i+3] = 0;
			}
		}

		// write pixel data to destination context
		ctx.putImageData(pixels,0,0);
		
		IMGDISMINUIDA.src = canvas.toDataURL("image/png");
		
		
		//resizeBase64Img(img,20,41);
        
    };
	img.onerror= function () {
        //alert("Firma No Encontrada");
		CrearPDFDesdeDiv(div,null,pdf);
    };
	/*
	pdf.addPage();
	pdfCuadricula(pdf,ancho,alto,100);
	*/
}





/*
window.onload = function(){
	var imageObj = document.getElementById("mug");
	//imageObj.onload = function(){ alterImage(this); }
	alterImage(imageObj);
}
*/
function canvasToImg(imageObj,canvas) {
	//alert("canvasToImg");
	var urlcanvas = canvas.toDataURL();
	imageObj.src = urlcanvas;
	imageObj.style.width="400px";
	imageObj.style.height="auto";
}

function alterImage(imageObj){
	var canvas = document.getElementById("myCanvas");
	canvas.width = imageObj.width;
	canvas.height = imageObj.height;
	var ctx= canvas.getContext("2d");
	ctx.drawImage(imageObj, 0, 0);
	var id= ctx.getImageData(0, 0, canvas.width, canvas.height);
	for (var i = 0; i < id.data.length; i += 4) {
		if(id.data[i] > 120 && id.data[i+1] > 120 && id.data[i+2] > 120){
			id.data[i] = 255;
			id.data[i+1] = 230;
			id.data[i+2] = 213;
		}
	}
	ctx.putImageData(id, 0, 0);
	imageObj.src = canvas.toDataURL();
	canvasToImg(imageObj,canvas);
}




































function iFrameElementsHeight(){
		var iFrameElementsHeight = document.getElementsByTagName('IFRAME');
		console.log(iFrameElementsHeight);
		for( var i = 0; i < iFrameElementsHeight.length ; i++ ){
			if(iFrameElementsHeight[i]) {
				iFrameElementsHeight[i].height = iFrameElementsHeight[i].contentWindow.document.body.scrollHeight + "px";
			}
		}
		 
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






























	/*var gmaps;
	function initMap() {
	gmaps = new google.maps.Map(document.getElementById('mapa'), {
	zoom: 8,
	center: {lat: -34.397, lng: 150.644}
	});
	var geocoder = new google.maps.Geocoder();

	document.getElementById('submit').addEventListener('click', function() {
	geocodeAddress(geocoder, gmaps);
	});
	}
	
	function geocodeLatLng(geocoder, map, infowindow,LatLong, lat, lng) {
		var input = LatLong;
		var latlngStr = input.split(',', 2);
		var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
		
		geocoder.geocode({'location': latlng}, function(results, status) {
		if (status === 'OK') {
			if (results[0]) {
				map.setZoom(11);
				var marker = new google.maps.Marker({
				position: latlng,
				map: map
				});
				gmaps.setCenter(new google.maps.LatLng(LatLong));
				infowindow.setContent(results[0].formatted_address);
				infowindow.open(map, marker);
				getCP(geocoder, map,results[0].formatted_address, lat, lng);
			} else {
				window.alert('No results found');
			}
		} else {
			window.alert('Geocoder failed due to: ' + status);
		}
		});
	}
	
	function getCP(geocoder, resultsMap, address, lat , lng) {
		//var address = document.getElementById('address').value;
		var CP = false;
		geocoder.geocode({componentRestrictions: {country: 'AR'},'address': address}, function(results, status) {
			if (status === 'OK') {
				//resultsMap.setCenter(results[0].geometry.location);
				console.log(results);//country: 'AR',postalCode: 'T4000', locality: 'San Miguel De Tucuman', postal_code_suffix: 'IRA'
				for(var i=0; i<results.length ;i++){
					if(results[i]["address_components"]!=undefined){
						for(var j=0; j<results[i]["address_components"].length ;j++){
							if(results[i]["address_components"][j]["types"][0] == "postal_code"){
								console.log(results[i]["address_components"][j]["long_name"]);
								CP = true;
							}
						}
					}
				}
			}
		});
		if(!CP){
			lat+=0.001;
			LatLong = lat + "," + lng;
			var infowindow = new google.maps.InfoWindow;
			geocodeLatLng(geocoder, resultsMap, infowindow,LatLong, lat ,  lng);
		}
	}
function sleep(milliseconds) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
}

	function initialize() {
		var input = document.getElementById('address');
		var options = {
			types: ['(regions)'],
			componentRestrictions: {
				country: "in"
			}
		}
		var autocomplete = new google.maps.places.Autocomplete(input);
	}
	google.maps.event.addDomListener(window, 'load', initialize);

	var cp = "";
	var Error = false;
	
	
	
	
	
	var StringToFileArchive="";
	function Descargar(filename) {
		var pom = document.createElement('a');
		pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(StringToFileArchive));
		pom.setAttribute('download', filename);

		if (document.createEvent) {
			var event = document.createEvent('MouseEvents');
			event.initEvent('click', true, true);
			pom.dispatchEvent(event);
		}
		else {
			pom.click();
		}
	}
	
	
	
	
	
	
	
	function geocodeAddress(geocoder, resultsMap, Contador = 4000, PrimeraLetra = 0, SegundaLetra = 0, TerceraLetra = 0) {
		if(Contador == 4200){
			Descargar("Data.txt");
			return;
		}
		
		var address = document.getElementById('address').value;
		var Resultado = false;
		//alert("" + address);
		
		/ *
		var i=Contador
		
		if(PrimeraLetra == 0 && SegundaLetra == 0 && TerceraLetra == 0){
			cp = "T" + i;
			PrimeraLetra = 65;
			SegundaLetra = 65;
			TerceraLetra = 64;
		}else{
			cp = "T" + i + String.fromCharCode(PrimeraLetra) + String.fromCharCode(SegundaLetra) + String.fromCharCode(TerceraLetra);
		}
		
		if(Error){i=999999};
		geocoder.geocode(
			{componentRestrictions: {country: 'Argentina',postalCode: cp,'address': address}}//,'address': address
			, function(results, status) {
				if (status === 'OK') {
					resultsMap.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
					map: resultsMap,
						position: results[0].geometry.location
						
					});
					console.log(results);//country: 'AR',postalCode: 'T4000', locality: 'San Miguel De Tucuman', postal_code_suffix: 'IRA'
					for(var i=0; i<results.length ;i++){
						if(results[i]["address_components"]!=undefined){
							for(var j=0; j<results[i]["address_components"].length ;j++){
								if(results[i]["address_components"][j]["types"][0] == "postal_code"){
									console.log(results[i]["address_components"][j]["long_name"]);
									StringToFileArchive += results[i]["formatted_address"] + "|" + results[i]["address_components"][j]["long_name"] + ";\n";
									//Contador ++;
									PrimeraLetra = 0;
									SegundaLetra = 0;
									TerceraLetra = 0;
									Contador ++;
									//sleep(100);
									geocodeAddress(geocoder, resultsMap, Contador, PrimeraLetra, SegundaLetra, TerceraLetra);
								}
							}
						}
					}
				}else{
					if(status === 'OVER_QUERY_LIMIT'){
						sleep(1000);
						//console.log(status);
						geocodeAddress(geocoder, resultsMap, Contador, PrimeraLetra, SegundaLetra, TerceraLetra);
						//geocodeAddress(geocoder, resultsMap, Contador);
					}else{
						//Contador ++;
						TerceraLetra++;
						if(TerceraLetra==91){
							TerceraLetra = 65;
							SegundaLetra ++;
						}
						if(SegundaLetra==91){
							PrimeraLetra ++;
							SegundaLetra = 65;
						}
						if(PrimeraLetra==91){
							PrimeraLetra = 0;
							SegundaLetra = 0;
							TerceraLetra = 0;
							Contador ++;
						}
						
						//PrimeraLetra = String.fromCharCode(65);
						//SegundaLetra = String.fromCharCode(65);
						//TerceraLetra = String.fromCharCode(65);
						
						console.log(status + " CodigoPostal:T" + Contador + String.fromCharCode(PrimeraLetra) + String.fromCharCode(SegundaLetra) + String.fromCharCode(TerceraLetra));
						geocodeAddress(geocoder, resultsMap, Contador, PrimeraLetra, SegundaLetra, TerceraLetra);
					}
				}
			});
			
		return;
		* /
		var address = document.getElementById('address').value;
		geocoder.geocode(
			{componentRestrictions: {country: 'AR'},'address': address}, function(results, status) {
		if (status === 'OK') {
		resultsMap.setCenter(results[0].geometry.location);
		console.log(results);//country: 'AR',postalCode: 'T4000', locality: 'San Miguel De Tucuman', postal_code_suffix: 'IRA'
		for(var i=0; i<results.length ;i++){
			if(results[i]["address_components"]!=undefined){
				for(var j=0; j<results[i]["address_components"].length ;j++){
					if(results[i]["address_components"][j]["types"][0] == "postal_code"){
						console.log(results[i]["address_components"][j]["long_name"]);
					}
				}
			}
		}
		var geocoder = new google.maps.Geocoder;
		var infowindow = new google.maps.InfoWindow;
		//console.log(results[0].geometry.location);
		var LatLong = results[0].geometry.location.lat() + "," + results[0].geometry.location.lng();
		
		geocodeLatLng(geocoder, resultsMap, infowindow,LatLong, results[0].geometry.location.lat() ,  results[0].geometry.location.lng());
		//avenida salta 1, San Miguel De Tucuman, Tucuman 
		var marker = new google.maps.Marker({
		map: resultsMap,
			position: results[0].geometry.location
			
		});
		} else {
		alert('Geocode was not successful for the following reason: ' + status);
		}
		});
	}
	  
	  initMap();
	  */
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////
	  ///////////////////////////////////////////////////////////////////////


