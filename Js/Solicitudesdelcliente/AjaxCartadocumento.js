	
	var imgBase;
	$(document).ready(function () {
		imgBase = document.getElementById("imgBase");
	});
	
	var Config = JSON.parse(`{
		"Elemento":"ComprobanteDeIngreso",
		"ElementoTexto":"BoltTextComprobanteDeIngreso",
		"DigitosMinimos":"10",
		"TextoInicial":"Complete El Campo Para Buscar Datos",
		"TextoMenor":"Faltan Digitos"
	}`);
	Texto(Config);
	
	function Buscar(){
		//if(!Needed("ComprobanteDeIngreso",10)){return;}
		
		filtro=["User","time"];
		filtroX=["1","0"];
		var Parametros = ArraydsAJson(filtro,filtroX);
		Parametros = JSON.stringify(Parametros);// Manda Como Texto
		var Indices=["ComprobanteDeIngreso","FechaI","FechaF"];
		var Objetos = ["ComprobanteDeIngreso","FechaDesde","FechaHasta"];
		var ValoresDirectos = ArraydsAJson(Indices,Objetos);//Manda Como Objeto En SelectDesdeConsulta Se Transforma En Terxto
		
		var Config = JSON.parse(`
		{
			"DivContenedor":"DivIngresadas",
			"ConFiltro":false,
			
			"DataAjax":` + Parametros + `,
			"ValoresDirectos":` + ValoresDirectos + `,
			"MensajeEnFail":false,
			"TextoEnFail":"No Se Encontraron Resultados",
			"ConFiltro":"true",
			"CrearAlCargarDatos":true,
			"Ajax":"` + URLJS + `XMLHttpRequest/SolicitudesDelCliente/BuscarCartasDocumentos.php"
			
		}`);//	"Ajax":"` + URLJS + `XMLHttpRequest/Tablerodegestiones/AjaxTablaTarjetasIngresadas.php"
			//"Ajax":"` + URLJS + `XMLHttpRequest/Testtabla/tabla.php"
		//"ValoresDirectos":null,
		//"ValoresDirectos":` + ValoresDirectos + `,
		TablaDesdeConsulta(Config);
	}

	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	var transparentColor = {
		r : 255,
		g : 255,
		b : 255
	};
	
	function HTMLATexto(text){
		const span = document.createElement('span');
		return text
		.replace(/&[#A-Za-z0-9]+;/gi, (entity,position,text)=> {
			span.innerHTML = entity;
			return span.innerText;
		});
	}
	
	function DescargarPDF(IdTabla,Cabecera,Base = false){
		var tabla = document.getElementById(IdTabla); 
		if(tabla.rows.length<=Cabecera){
			if(typeof $.bootstrapGrowl === "function") {
				$.bootstrapGrowl("La Tabla No Cuntiene Los Datos Requeridos",{
					type: 'success',
					align: 'center',
					width: 'auto'
				});
			}
			return;
		}
		
		var Datos = ["RemitenteNombre","RemitenteApellido", "RemitenteCodigoPostal","RemitenteProvincia"
				,"RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
				,"DestinatarioNombre","DestinatarioApellido","DestinatarioCodigoPostal","DestinatarioProvincia","DestinatarioLocalidad"
				,"DestinatarioCalle","DestinatarioNumero","DestinatarioPiso","DestinatarioDepartamento","RemitenteEmail"
				,"RemitenteCelular","RemitenteObservaciones","ApoderadoNombre","ApoderadoApellido","ApoderadoDNITipo"
				,"ApoderadoDocumento","ApoderadoFirma","Formulario","URLPDF"];
		var LugarDeVariable = new Array;
		
		//alert(tabla.rows.length);
		//alert(tabla.rows[Cabecera-1].cells.length);
		
		var ColumnasEncontradas = 0;
		//console.log(Datos);
		for(var i = Cabecera-1 ;i < Cabecera ; i++){
			for(var j = 0 ;j<tabla.rows[Cabecera-1].cells.length;j++){
				//alert(tabla.rows[i].cells[j].innerHTML);
				if(Datos.indexOf(tabla.rows[Cabecera-1].cells[j].innerHTML) > -1){
					LugarDeVariable[Datos.indexOf(tabla.rows[Cabecera-1].cells[j].innerHTML)]=j;
					ColumnasEncontradas++;
				}
			}
		}
		
		if(ColumnasEncontradas!=Datos.length){
			if(typeof $.bootstrapGrowl === "function") {
				$.bootstrapGrowl("La Tabla No Cuntiene Las Columnas Requeridas",{
					type: 'success',
					align: 'center',
					width: 'auto'
				});
			}
			return;
		}
		Loading();
		//document.getElementById("iframePDF").style.display="block";
		//Loading();
		//setTimeout( CrearBasePDFDesdeDiv(div), 500 );
		var firmas = new Array;
		for(var i = Cabecera ; i < tabla.rows.length ; i++){
			if(tabla.rows[i].cells[LugarDeVariable[25]].innerHTML != "null.png"){
			   
				firmas[i] = tabla.rows[i].cells[LugarDeVariable[25]].innerHTML;
				if(firmas[i].search(".png") == -1){
				    firmas[i] = firmas[i]  + ".png";
				}
				
			}else{
				firmas[i] = tabla.rows[i].cells[LugarDeVariable[25]].innerHTML;
			}
			
		}
		
		while(document.getElementById("Firmas") != null){
			document.getElementById("Firmas").remove();
		}
		
		var DivDeImagenes = document.getElementById("DivDeImagenes");
		var LoadingIMG = 0 ;
		var LoadingIMGDisminuidas = 0 ;
		var ArrayDeIMGDISMINUIDA = new Array;
		var ArrayIMG = new Array;
		var CONTIMG = 0;
		for(var i = Cabecera ; i < tabla.rows.length ; i++){
			if(document.getElementsByClassName(firmas[i]).length == 0){
				ArrayIMG[CONTIMG] = document.createElement("img");
				ArrayIMG[CONTIMG].id="Firmas";
				ArrayIMG[CONTIMG].className=firmas[i];
				ArrayIMG[CONTIMG].src = URLJS +"XMLHttpRequest/FirmasDeClientes/uploads/" + firmas[i];
				//console.log("LoadingIMGDisminuidas new Image:" + LoadingIMGDisminuidas);
				ArrayDeIMGDISMINUIDA[LoadingIMGDisminuidas] = new Image();
				ArrayDeIMGDISMINUIDA[LoadingIMGDisminuidas].onload = function () {
					LoadingIMG ++;
					if(LoadingIMG==tabla.rows.length - Cabecera ){
						//console.log(LoadingIMG);
						
						var ancho=216;
						var alto=355;
						var Ancho=216;
						var Alto=355;
						var pdf = new jsPDF('p', 'mm',[alto,ancho]);
						
						
						for(var i = Cabecera ; i < tabla.rows.length ; i++){
							var imgActual = 0;
							
							if(Base){
								pdf.addImage(imgBase, 'JPEG', 0, 0,ancho , alto);
							}
							
							for(var t = 0 ; t<LoadingIMGDisminuidas;t++){
								if(tabla.rows[i].cells[LugarDeVariable[25]].innerHTML != "null.png"){
								    
                    				if(tabla.rows[i].cells[LugarDeVariable[25]].innerHTML.search(".png") == -1){
                    				    if(ArrayDeIMGDISMINUIDA[t].className == tabla.rows[i].cells[LugarDeVariable[25]].innerHTML + ".png"){
    										imgActual = t;
    									}else{
    										//console.log("t:" + t);
    									}
                    				}else{
                    				    if(ArrayDeIMGDISMINUIDA[t].className == tabla.rows[i].cells[LugarDeVariable[25]].innerHTML){
    										imgActual = t;
    									}else{
    										//console.log("t:" + t);
    									}
                    				}
                    				
									
								}else{
									if(ArrayDeIMGDISMINUIDA[t].className == tabla.rows[i].cells[LugarDeVariable[25]].innerHTML){
										imgActual = t;
									}else{
										//console.log("t:" + t);
									}
								}
								
							}//s8WzJrYDO7Iwa6Wwqne8CO2YEq1qQQfVpn9tWN47sQPAETVHIu
							//console.log("imgActual:" + imgActual);
							//console.log("ArrayDeIMGDISMINUIDA[t].className:" + ArrayDeIMGDISMINUIDA[imgActual].className);
							//console.log("tabla.rows[i].cells[LugarDeVariable[25]].innerHTML:" + tabla.rows[i].cells[LugarDeVariable[25]].innerHTML + ".png");
							
							var RemitenteNombre = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[0]].innerHTML);
							var RemitenteApellido = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[1]].innerHTML);
							var RemitenteCodigoPostal = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[2]].innerHTML);
							var RemitenteProvincia = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[3]].innerHTML);
							var RemitenteLocalidad = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[4]].innerHTML);
							var RemitenteCalle = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[5]].innerHTML);
							var RemitenteNumero = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[6]].innerHTML);
							var RemitentePiso = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[7]].innerHTML);
							var RemitenteDepartamento = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[8]].innerHTML);
							var DestinatarioNombre = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[9]].innerHTML);
							var DestinatarioApellido = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[10]].innerHTML);
							var DestinatarioCodigoPostal = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[11]].innerHTML);
							var DestinatarioProvincia = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[12]].innerHTML);
							var DestinatarioLocalidad = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[13]].innerHTML);
							var DestinatarioCalle = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[14]].innerHTML);
							var DestinatarioNumero = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[15]].innerHTML);
							var DestinatarioPiso = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[16]].innerHTML);
							var DestinatarioDepartamento = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[17]].innerHTML);
							var RemitenteEmail = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[18]].innerHTML);
							var RemitenteCelular = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[19]].innerHTML);
							var RemitenteObservaciones = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[20]].innerHTML);
							var ApoderadoNombre = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[21]].innerHTML);
							var ApoderadoApellido = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[22]].innerHTML);
							var ApoderadoDNITipo = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[23]].innerHTML);
							var ApoderadoDocumento = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[24]].innerHTML);
							var ApoderadoFirma = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[25]].innerHTML);//document.getElementsByClassName(ApoderadoFirma)[0]
							var Formulario = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[26]].innerHTML);
							var URLPDF = HTMLATexto(tabla.rows[i].cells[LugarDeVariable[27]].innerHTML);
							
							var v = ArrayDeIMGDISMINUIDA[imgActual].width;
							var h = ArrayDeIMGDISMINUIDA[imgActual].height;
							var ScalaV = 20
							var ScalaH = Math.floor((v/h)*20);
							
							pdf.addImage(ArrayDeIMGDISMINUIDA[imgActual], 'PNG', 10, 305, ScalaH, ScalaV);
							//TextoBasePDFCartaDocumentoServer(pdf,ancho,alto,100,i);
							
							
							//Valores De Tablas
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
							
							var ApellidoDeDestinatario;//
							
							var Destinatario = "";//
							if(ApellidoDeDestinatario != ""){
								var Destinatario = DestinatarioApellido + " " + DestinatarioNombre;
							}else{
								var Destinatario = DestinatarioNombre;
							}
							
							var DomicilioDestino = "";//
							if(DestinatarioCalle != ""){DomicilioDestino = DomicilioDestino + DestinatarioCalle;}
							if(DestinatarioNumero != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + DestinatarioNumero;}
							if(DestinatarioPiso != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Piso:" + DestinatarioPiso;}
							if(DestinatarioDepartamento != ""){if(DomicilioDestino != ""){DomicilioDestino = DomicilioDestino + " ";} DomicilioDestino = DomicilioDestino + "Dpto:" + DestinatarioDepartamento;}
							
							var CodigoPostal = DestinatarioCodigoPostal;
							var Localidad = DestinatarioLocalidad;
							var Provincia = DestinatarioProvincia;
							
							//************************************************Imprimiendo PDF
							var RightX = 150;
							var PPPEXTRA = 1;
							//Destinatario
							Fuente = 12;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							var splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
							if(splitDestinatario.length > 1){
								if(splitDestinatario.length == 2){
									Fuente = 8;
									pdf.setFontSize(Fuente);
									splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
									pdf.text(RightX,39-4+PPPEXTRA, splitDestinatario);
									pdf.text(RightX,158-4+PPPEXTRA, splitDestinatario);
								}
								if(splitDestinatario.length > 2){
									Fuente = 6;
									pdf.setFontSize(Fuente);
									splitDestinatario = pdf.splitTextToSize(Destinatario, 55);
									pdf.text(RightX,39-4+PPPEXTRA, splitDestinatario);
									pdf.text(RightX,158-4+PPPEXTRA, splitDestinatario);
								}
							}else{
								Fuente = 12;
								pdf.setFontSize(Fuente);
								pdf.text(RightX,37+PPPEXTRA, splitDestinatario);
								pdf.text(RightX,156+PPPEXTRA, splitDestinatario);
							}


							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(RightX,42+PPPEXTRA, DomicilioDestino);
							pdf.text(RightX,162+PPPEXTRA, DomicilioDestino);

							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(RightX,48+PPPEXTRA, CodigoPostal);
							pdf.text(RightX,167+PPPEXTRA, CodigoPostal);

							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(RightX,53+PPPEXTRA, Localidad);
							pdf.text(RightX,172+PPPEXTRA, Localidad);

							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(RightX,59+PPPEXTRA, Provincia);
							pdf.text(RightX,177+PPPEXTRA, Provincia);
							
							//Remitente
							var LeftX = 50;
							Fuente = 12;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							
							var splitRemitente = pdf.splitTextToSize(RemitenteNombre, 55);
							if(splitRemitente.length > 1){
								Fuente = 8;
								pdf.setFontSize(Fuente);
								splitRemitente = pdf.splitTextToSize(RemitenteNombre, 55);
								pdf.text(LeftX,39-4+PPPEXTRA, splitRemitente);
								pdf.text(LeftX,159-4+PPPEXTRA, splitRemitente);
							}else{
								Fuente = 12;
								pdf.setFontSize(Fuente);
								pdf.text(LeftX,37+PPPEXTRA, splitRemitente);
								pdf.text(LeftX,156+PPPEXTRA, splitRemitente);
							}
							var DomicilioRemitente = "";
							if(RemitenteCalle != ""){DomicilioRemitente = DomicilioRemitente + RemitenteCalle;}
							if(RemitenteNumero != ""){if(DomicilioRemitente != ""){DomicilioRemitente = DomicilioRemitente + " ";} DomicilioRemitente = DomicilioRemitente + RemitenteNumero;}
							if(RemitentePiso != ""){if(DomicilioRemitente != ""){DomicilioRemitente = DomicilioRemitente + " ";} DomicilioRemitente = DomicilioRemitente + "Piso:" + RemitentePiso;}
							if(RemitenteDepartamento != ""){if(DomicilioRemitente != ""){DomicilioRemitente = DomicilioRemitente + " ";} DomicilioRemitente = DomicilioRemitente + "Dpto:" + RemitenteDepartamento;}
							
							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(LeftX,42+PPPEXTRA, DomicilioRemitente);
							pdf.text(LeftX,162+PPPEXTRA, DomicilioRemitente);
							
							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(LeftX,48+PPPEXTRA, RemitenteCodigoPostal);
							pdf.text(LeftX,167+PPPEXTRA, RemitenteCodigoPostal);
							
							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(LeftX,53+PPPEXTRA, RemitenteLocalidad);
							pdf.text(LeftX,172+PPPEXTRA, RemitenteLocalidad);
							
							Fuente = 8;
							pdf.setFontSize(Fuente);
							pdf.setTextColor(0, 0, 0);
							pdf.text(LeftX,59+PPPEXTRA, RemitenteProvincia);
							pdf.text(LeftX,177+PPPEXTRA, RemitenteProvincia);
							
							//Apoderado
							if(ApoderadoNombre != ""){
								var Apoderado = ApoderadoNombre + " " + ApoderadoApellido;
							}else{
								var Apoderado = ApoderadoNombre;
							}
							
							if(ApoderadoDNITipo != ""){
								var ApoderadoDoc = ApoderadoDNITipo + " " + ApoderadoDocumento;
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
							
							
							//TextBox
							var NewDiv = document.createElement("div");
							NewDiv.id="Parrafo";
							NewDiv.style.display="none";
							//console.log(Formulario.replace(/&lt;/g, "<").replace(/&gt;/g, ">"););
							NewDiv.innerHTML = Formulario.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
							document.body.appendChild(NewDiv);
							var Ressource;
							Ressource = NewDiv;
							specialElementHandlers = {
								'#bypassme': function (element, renderer) {
									return true
								}
							};
							margins = {
								top: 179,
								bottom: 0,
								left: 10,
								width: 200-5+PPPEXTRA
							};
							//pdf.setFont("courier");
							pdf.fromHTML(
								Ressource, 
								margins.left,
								margins.top, {
									'width': margins.width, 
									'elementHandlers': specialElementHandlers
								},
								function (dispose) {
									//Fin Fe La Carga
								}, margins
							);
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							if(i+1 != tabla.rows.length){
								pdf.addPage();
							}
						}
						pdf.save('VistaPrevia.pdf');
						EndLoading();
					}
				}
				ArrayDeIMGDISMINUIDA[LoadingIMGDisminuidas].onerror= function () {
					LoadingIMG ++;
					//alert("Firma No Encontrada");
					//CrearPDFDesdeDiv(div,null,pdf);
				};
				
				ArrayIMG[CONTIMG].LoadingIMGDisminuidas = LoadingIMGDisminuidas;
				ArrayIMG[CONTIMG].onload = function() {
					console.log(this.width);
					var v = this.width;
					var h = this.height;
					var ScalaV = 20
					var ScalaH = Math.floor((v/h)*20);
					canvas.height = canvas.width * (this.height / this.width);
					 
					var oc = document.createElement('canvas'),
					octx = oc.getContext('2d');
					oc.width = this.width * 0.5;
					oc.height = this.height * 0.5;
					octx.clearRect(0,0, oc.width, oc.height);
					octx.drawImage(this, 0, 0, oc.width, oc.height);
					ctx.drawImage(oc, 0, 0, oc.width, oc.height,
					0, 0, canvas.width, canvas.height);
					var pixels = ctx.getImageData(0, 0, this.width, this.height);
					for(var i = 0, len = pixels.data.length; i < len; i += 4){
						var r = pixels.data[i];
						var g = pixels.data[i+1];
						var b = pixels.data[i+2];
						if(r == transparentColor.r && g == transparentColor.g && b == transparentColor.b){
							pixels.data[i+3] = 0;
						}
					}
					ctx.putImageData(pixels,0,0);
					//console.log(ArrayDeIMGDISMINUIDA);
					//console.log(this.LoadingIMGDisminuidas);
					//console.log(ArrayDeIMGDISMINUIDA[this.LoadingIMGDisminuidas]);
					ArrayDeIMGDISMINUIDA[this.LoadingIMGDisminuidas].className = this.className;
					ArrayDeIMGDISMINUIDA[this.LoadingIMGDisminuidas].src = canvas.toDataURL("image/png");
				}
				ArrayIMG[CONTIMG].onerror= function () {
					LoadingIMG ++;
					//alert("Firma No Encontrada");
					//CrearPDFDesdeDiv(div,null,pdf);
				};
				DivDeImagenes.appendChild(ArrayIMG[CONTIMG]);
				LoadingIMGDisminuidas++;
				CONTIMG++;
			}else{
				LoadingIMG ++;
			}
		}
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	