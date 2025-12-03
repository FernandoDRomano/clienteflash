
    
    
    
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
			"NewURL":"back",
			"Ajax":"` + Boveda + `/public/api/CartaDocumentoCrearFormulario"
		}`);
		//"Elemento":"DivResApi",
		ElementoDesdeApi(Config); 
	}
	
	function EditarFormulario(){
		if(! Needed("custom-select-input","1","Seleccione Plantilla Que Desea Editar")){return;}
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["NombreDeFormulario","TextBox"];
		var Objetos = ["custom-select-input","textBox"];
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
			"NewURL":"back",
			"Ajax":"` + Boveda + `/public/api/CartaDocumentoEditarFormulario"
		}`);
		//"Elemento":"DivResApi",
		ElementoDesdeApi(Config); 
	}
	
	function EliminarFormulario(){
		if(! Needed("custom-select-input","1","Seleccione Plantilla Que Desea Eliminar")){return;}
		
		filtro=["IdUsuario","User","time"];
		filtroX=[UserId,"","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		//console.log(Parametros);
		var Indices=["NombreDeFormulario","TextBox"];
		var Objetos = ["custom-select-input","textBox"];
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
			"NewURL":"back",
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






// 
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
	

