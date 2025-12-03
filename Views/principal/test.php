	<?php
		$Objeto = json_encode($_REQUEST);
		$Post = json_decode($Objeto, false);
		$InicioDeAnio = "InicioDeAnio";
		$Fecha = "Fecha";
		if(isset($_SESSION['idusuario'])){
			$UserId = $_SESSION['idusuario'];
			//$IdUsuarioSpp = $_SESSION['idusuario'];
		}
		use Config\Elementos as Elementos;
		
	?>
	<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #mapa {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        width: 350px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
      #latlng {
        width: 225px;
      }
    </style>
	<!--
	<div id="floating-panel">
		<input id="address" type="textbox" value="Gral Alvarez Condarco 894, Tafi Viejo, Tucuman">
		<input id="submit" type="button" value="Geocode">
		
		<input id="Descargar" type="button" value="Descargar" onclick="Descargar('Forzado.txt');">
	</div>
	<div id="mapa"></div>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVVkGi-OeMDJJU7SxlHOJyom1VrND8e-M&sensor=false&amp;libraries=places">
	</script>
	-->
	
	<img src="/clienteflash/XMLHttpRequest/FirmasDeClientes/uploads/IMG_20200414_120127720.jpg" id="mug"  hidden/>
	<canvas id="myCanvas" width="400px" height="auto" hidden></canvas>

	<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">
	<style>
		#ModalDatos ::-webkit-scrollbar {
		width: 16px;
		}
		#ModalDatos ::-webkit-scrollbar-track {
		background: #c0c0c0; 
		}
		#ModalDatos ::-webkit-scrollbar-thumb {
		background: #000000;
		}
		#ModalDatos ::-webkit-scrollbar-thumb:hover {
		background: #505050; 
		}
		.form-control:focus {
			box-sizing: border-box;
			box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25) !important;
		}
		.card-header {
			color: #fff;
			background-color: #292d57;
			border-bottom: 1px solid #292d57;
			padding: .75rem 1.25rem;
		}
		.escondibles{
			border-style: groove;
			border-color: #33333305;
		}
		
		#crearPlantilla:hover{
		    color: white;
		}
		
	</style>
	<div class="col-md-12">
		<div class="form-group">
			<div id="ModalDatos" class="modal fade" >
				<div class="row" id="container" style="border-top-width: 10px;background: #f0f8ff;color: #000000;position: absolute;top: calc(50% - 100px);left: calc(50% - 200px);right: calc(50% - 200px);border: groove;border-color: #292d57;padding: 4px 4px 4px 4px;">
					<div class="col-md-12" style="text-align: center;color: #333333;letter-spacing: 6px;text-transform: uppercase;text-decoration: underline;">
						<h1>!Importante<h1>
					</div>
					<div class="col-md-12">
						<p style="text-align: justify;text-shadow: 2px 2px 10px #bfbfbf;border-style: double;padding: inherit;border-color: #292d57;">Una vez confirmada la Carta Documento los datos contenidos en la misma no podrán modificarse. Controle antes de confirmar su envío ya que luego no se podrán hacer reclamos al correo por datos incorrectos o inexistentes</p>
					</div>
					<div class="col-md-">
						<button type="button"  class="btn btn-large btn-block btn-tertiary" id="SalirDeModal" style="width: 100%;"> <!-- onclick="javascript:window.history.back();" -->
							<!-- <i class="fas fa-arrow-circle-left"></i> -->
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">
									Volver A Edicion De Carta Documento
								</font>
							</font>
						</button>
					</div>
					<hr class="size1 hideline">
					<div class="col-md-">
						<button type="button"  class="btn btn-large btn-block btn-tertiary" id="SalirDeModal" onclick="EnviarCartaDoccumento(this)" style="width: 100%;"> <!-- onclick="javascript:window.history.back();" -->
							<!-- <i class="fas fa-arrow-circle-left"></i> -->
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">
									Confirmar Y Enviar Carta Documento
								</font>
							</font>
						</button>
					</div>
					<hr class="size2 hideline">
				</div>
			</div>
		</div>
	</div>
	
	
	<?php
		//print_r($_SESSION);
		//Titulo
		
		//Elementos::CrearTitulo("Envio De Carta Documento");
		Elementos::CrearDesplegableConTitulo("Envio De Carta Documento","1");
		
		echo('<hr class="size2 hideline">');
		Elementos::StartHide("ApiKey");
		Elementos::EndHide();
		Elementos::StartHide("SecretKey");
		Elementos::EndHide();
		
		//Elementos::CrearDesplegableConTitulo("Datos De Destinatario","2");
		Elementos::CrearLeftTitulo("Datos De Destinatario");
		Elementos::CrearImput("DestinatarioNombre","text","Nombre","6","value=''",true);//Ruben Gonzalo
		Elementos::CrearImput("DestinatarioApellido","text","Apellido","6","value=''",true);//Farias
		echo('<hr class="size1 hideline">');
		Elementos::CrearSelectt2("DestinatarioProvincia","Provincia","4",false,true);//
		Elementos::CrearSelectt2("DestinatarioLocalidad","Localidad","4",false,true);//
		Elementos::CrearImput("DestinatarioCodigoPostal","CodigoPostal","Codigo Postal","4","value=''",true);//4000
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("DestinatarioCalle","text","Calle","3","value=''",true);//Avenida Salta
		Elementos::CrearImput("DestinatarioNumero","numberNoFloat","Numero","3","value=''",true);//10000
		Elementos::CrearImput("DestinatarioPiso","text","Piso","3","value=''");//5
		Elementos::CrearImput("DestinatarioDepartamento","text","Dpto","3","value=''");//B
		echo('<hr class="size2 hideline">');
		
		echo('<hr class="size2 hideline">');
		Elementos::CrearLeftTitulo("Datos De Remitente");
		Elementos::CrearImput("RemitenteNombre","text","Apellido Nombre/ Razon social","6","value=''",true);//Servicios Privados Postales
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("RemitenteCalle","text","Calle","3","value=''",true);//Combate De Las Piedras
		Elementos::CrearImput("RemitenteNumero","numberNoFloat","Numero","3","value=''",true);//1284
		Elementos::CrearImput("RemitentePiso","numberNoFloat","Piso","3");//
		Elementos::CrearImput("RemitenteDepartamento","text","Dpto","3");//
		echo('<hr class="size1 hideline">');
		Elementos::CrearSelectt2("RemitenteProvincia","Provincia","4",false,true);//
		Elementos::CrearSelectt2("RemitenteLocalidad","Localidad","4",false,true);//
		Elementos::CrearImput("RemitenteCodigoPostal","CodigoPostal","Codigo Postal","4","value=''",true);//4000
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("RemitenteEmail","textCorreo","E-Mail","6","value=''",true);//Sistemas@Correoflash.com
		Elementos::CrearImput("RemitenteCelular","Celular","Celular","6","value=''",true);//(123) 456 7890
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("RemitenteObservaciones","text","Observaciones","12","value=''",false);//Correoflash
		echo('<hr class="size2 hideline">');
		Elementos::CrearLeftTitulo("Datos De Firmante");
		Elementos::CrearImput("RemitenteNombreApoderado","text","Nombre","6","value=''",true);//Federico
		Elementos::CrearImput("RemitenteApellidoApoderado","text","Apellido","6","value=''",true);//Vigo
		echo('<hr class="size1 hideline">');
		//Elementos::CrearImput("RemitenteDNITipoApoderado","text","Tipo De Documento","4","value='DNI'","value=''",true);//DNI
		?>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Tipo De Documento
					<span class="required" aria-required="true">*</span>
					<b id="BoltTextRemitenteDNITipoApoderado"></b><!-- BoltTextCliente -->
				</label>
				<div>
					<select id="RemitenteDNITipoApoderado" name="RemitenteDNITipoApoderado" class="form-control select1-Borrado select1-hidden-accessible-Borrado" tabindex="-1" aria-hidden="true" >
						<option value="0">Seleccione</option>
						<option value="DNI" selected>DNI</option>
						<option value="DU" >DU</option>
					</select>
				</div>
			</div>
		</div>
		<?php
		Elementos::CrearImput("RemitenteDocumentoApoderado","numberNoFloat","Documento ","8","value=''",true);//20-32601828-8
		echo('<hr class="size2 hideline">');
		
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		?>
		
		<?php
		
		//Elementos::CrearDesplegableConTitulo("Carta Documento","3");
		//Elementos::CrearTitulo("Formulario");
		Elementos::CrearDesplegableConTitulo("Formulario","2");
		?>
		
		
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
				<?php
					Elementos::CrearLeftTitulo("Formularios Predefinidos");
					echo('<hr class="size1 hideline">');
				?>
					<label for="custom-select-input"></label>
					<div id='custom-select-status' class='hidden-visually' aria-live="polite"></div>
					<div class="custom-select" id="myCustomSelect">
						<input type="text" id="custom-select-input" class="select-css" aria-describedby="custom-select-info">
						<span id="custom-select-info" class="hidden-visually">Arrow down for options or start typing to filter.</span>
						<span class="custom-select-icons">
							<svg width="16" height="16" viewBox="0 0 16 16" focusable="false" aria-hidden="true" id="icon-circle-down" class="icon" role="img">
								<path d="M16 8c0-4.418-3.582-8-8-8s-8 3.582-8 8 3.582 8 8 8 8-3.582 8-8zM1.5 8c0-3.59 2.91-6.5 6.5-6.5s6.5 2.91 6.5 6.5-2.91 6.5-6.5 6.5-6.5-2.91-6.5-6.5z"></path>
								<path d="M4.957 5.543l-1.414 1.414 4.457 4.457 4.457-4.457-1.414-1.414-3.043 3.043z"></path>
							</svg>
							<svg width="16" height="16" viewBox="0 0 16 16" focusable="false" aria-hidden="true" id="icon-circle-up" class="icon hidden-all" role="img">
								<path d="M0 8c0 4.418 3.582 8 8 8s8-3.582 8-8-3.582-8-8-8-8 3.582-8 8zM14.5 8c0 3.59-2.91 6.5-6.5 6.5s-6.5-2.91-6.5-6.5 2.91-6.5 6.5-6.5 6.5 2.91 6.5 6.5z"></path>
								<path  d="M11.043 10.457l1.414-1.414-4.457-4.457-4.457 4.457 1.414 1.414 3.043-3.043z"></path>
							</svg>							
						</span>
						<ul class="custom-select-options hidden-all" id="custom-select-list">
						    
    						<div class="col-md-3 Escondibles" style="display:none">
    							<a href="../Documentos/NuevaPlantilla.xlsx" download="">
    							</a>
    						</div>
							<li class="linck">
							    <strong style="font-size: 2em">Crea/Edita tus Plantillas<i style="color: #171056c9;" class="fas fa-link"></i></strong>
							    <strong class="data" style="font-size: 12px;color: darkgray;" hidden>
								</strong>
							</li>
							<li>
								<strong style="font-size: 2em;">Despido Con Causa</strong>
								<strong class="data" style="font-size: 12px;color: darkgray;" hidden>Habiéndose acreditado que Ud. [descripción de la causa], siendo tales hechos graves y violatorios de la buena fe laboral, dañinos para la empresa y configurantes de injuria laboral grave queda Ud. despedido a partir de la fecha, conforme lo dispuesto por art. 242 LCT (justa causa). Ponemos a su disposición haberes devengados y certificados art. 80 LCT. Queda Ud. debidamente notificado.
								</strong>
							</li>
							<li>
								<strong style="font-size: 2em;">Despido Por Abandono De Trabajo</strong>
								<strong class="data" style="font-size: 12px;color: darkgray;" hidden>Ante sus inasistencias injustificadas de los días [días] y no habiéndose presentado a justificar las mismas ni ha retomado sus tareas, lo notificamos por este medio fehaciente que ha quedado incurso en abandono de trabajo. Haberes, liquidación final y certificados art 80 LCT a su disposición. Queda Ud. debidamente notificado.
								</strong>
							</li>
							<li>
								<strong style="font-size: 2em;">Despido Sin Causa</strong>
								<strong class="data" style="font-size: 12px;color: darkgray;" hidden>Por medio de la presente comunicamos a Ud. que a partir del día de la fecha [fecha] prescindimos de sus servicios. Liquidación final y certificados art. 80 LCT a su disposición en términos de ley. Queda Ud. debidamente notificado.
								</strong>
							</li>
							<li>
								<strong style="font-size: 2em;">Intimacion A Desalojo Por Finalizacion De Locacion</strong>
								<strong class="data" style="font-size: 12px;color: darkgray;" hidden>En su carácter de locatario del inmueble ubicado en [dirección e identificación del inmueble], propiedad del Sr. [nombre propietario] de acuerdo al contrato de locación de fecha [fecha contrato de locación] por Ud. firmado, lo intimamos por esta vía al desalojo de dicho inmueble, en virtud de haber operado el día [fecha vencimiento de contrato] el vencimiento del plazo pactado en el contrato mencionado. De no proceder a desalojar el inmueble dentro de las 24 horas siguientes a la recepción de la presente me veré obligado a iniciar las correspondientes acciones judiciales. Asimismo hago expresa reserva de accionar por los daños y perjuicios ocasionados. Queda Ud. debidamente notificado.
								</strong>
							</li>
							<li>
								<strong style="font-size: 2em;">Intimacion A Desalojo Por Incumplimiento De Contrato De Locacion</strong>
								<strong class="data" style="font-size: 12px;color: darkgray;" hidden>En su carácter de locatario del inmueble ubicado en [dirección e identificación del inmueble], propiedad del Sr. [nombre propietario] de acuerdo al contrato de locación de fecha [fecha de contrato de locación] por Ud. firmado, lo intimamos por esta vía a que abone los alquileres atrasados correspondientes a los meses de [meses atrasados ] más intereses y gastos a la fecha de la presente, lo que hace un total de [moneda de pago en letras] ($ [total en números]), dentro de las [horas ] horas de recibida la presente en [lugar de pago] de lunes a viernes en el horario de [horario desde] a [horario hasta] horas.
								En caso de incumplimiento de dicha intimación, declaramos rescindido el contrato de locación según lo estipulado en la cláusula [cláusula] del mismo y se iniciará acción judicial por desalojo y cobro de dicha deuda contra Ud. y el Fiador por capital, intereses y costas. Queda Ud. debidamente notificado.
								</strong>
							</li>
							<li>
								<strong style="font-size: 2em;">Intimacion A Regularizar Situacion Laboral</strong>
								<strong class="data" style="font-size: 12px;color: darkgray;" hidden>Ante su negativa a otorgar tareas desde el día [día desde] hasta la fecha pese a mis insistencias, intimo por este medio aclare situación laboral y me otorgue tareas dentro de las 48 hs., caso contrario me consideraré gravemente injuriado/a y despedido/a por su exclusiva culpa. Queda Ud. legalmente notificado.
								</strong>
							</li>
						</ul>
					</div>
					
					<div class='PanelDeEscondibles'>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/NuevaPlantilla.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/DespidoConCausa.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/DespidoPorAbandonoDeTrabajo.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/DespidoSinCausa.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/IntimaciónADesalojoPorFinalizaciónDeLocación.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/IntimaciónADesalojoPorIncumplimientoDeContratoDeLocación.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
						<div class="col-md-3 Escondibles" style="display:none">
							<a href="../Documentos/IntimaciónARegularizarSituaciónLaboral.xlsx" download="">Plantilla Para Este Formulario<img src="../xlsx-512.png" alt="Documento Base" width="52px">
							</a>
						</div>
					</div>
					<hr class="size2 hideline">
				</div>
				
				<hr class="size2 hideline">
		
				<div class="col-md-12" style="border-color: black;border-style: double;">
				
				<?php
					Elementos::CrearLeftTitulo("Editor Manual");
				?>
						<!--
					<div id="toolBar1">
						<select onchange="formatDoc('formatblock',this[this.selectedIndex].value);this.selectedIndex=0;">
							<option selected="">Formatos</option>
							<option value="h1">Titulo Grande</option>
							<option value="h2">Titulo Medio Grande</option>
							<option value="h3">Titulo Mediano</option>
							<option value="h4">Titulo Medio Chico</option>
							<option value="h5">Titulo 5 Chico</option>
							<option value="h6">SubTitulo</option>
							<option value="p">Texto</option>
							<!-- <option value="pre">Pre-Formateado &lt;pre&gt;</option> - ->
						</select>
						<select onchange="formatDoc('fontname',this[this.selectedIndex].value);this.selectedIndex=0;">
							<option class="heading" selected="">Tipo de Letra</option>
							<option>Arial</option>
							<option>Arial Black</option>
							<option>Courier New</option>
							<option>Times New Roman</option>
						</select>

						<select onchange="formatDoc('fontsize',this[this.selectedIndex].value);this.selectedIndex=0;">
							<option class="heading" selected="">Tamaño</option>
							<option value="7">Muy Grande</option>
							<option value="6">Grande</option>
							<option value="5">Medio Grande</option>
							<option value="4">Medio</option>
							<option value="3">Normal</option>
							<option value="2">Medio Chico</option>
							<option value="1">Chico</option>
						</select>
						<select onchange="formatDoc('forecolor',this[this.selectedIndex].value);this.selectedIndex=0;">
							<option class="heading" selected="">Color</option>
							<option value="red">Rojo</option>
							<option value="blue">Azul</option>
							<option value="green">Verde</option>
							<option value="black">Negro</option>
							<option value="orange">Naranja</option>
							<option value="yellow">Amarillo</option>
							<option value="white">Blanco</option>
						</select>
						<select onchange="formatDoc('backcolor',this[this.selectedIndex].value);this.selectedIndex=0;">
							<option class="heading" selected="">Fondo</option>
							<option value="red">Rojo</option>
							<option value="blue">Azul</option>
							<option value="green">Verde</option>
							<option value="black">Negro</option>
							<option value="orange">Naranja</option>
							<option value="yellow">Amarillo</option>
							<option value="white">Blanco</option>
						</select>
					</div>
						-->
					<div id="toolBar2">
						<img class="intLink" title="Borrar" onclick="if(validateMode()&amp;&amp;confirm('Quiere Reiniciar El Documento?')){oDoc.innerHTML=sDefTxt};" src="data:image/gif;base64,R0lGODlhFgAWAIQbAD04KTRLYzFRjlldZl9vj1dusY14WYODhpWIbbSVFY6O7IOXw5qbms+wUbCztca0ccS4kdDQjdTLtMrL1O3YitHa7OPcsd/f4PfvrvDv8Pv5xv///////////////////yH5BAEKAB8ALAAAAAAWABYAAAV84CeOZGmeaKqubMteyzK547QoBcFWTm/jgsHq4rhMLoxFIehQQSAWR+Z4IAyaJ0kEgtFoLIzLwRE4oCQWrxoTOTAIhMCZ0tVgMBQKZHAYyFEWEV14eQ8IflhnEHmFDQkAiSkQCI2PDC4QBg+OAJc0ewadNCOgo6anqKkoIQA7">
						<img class="intLink" title="Imprimir" onclick="printDoc();" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oEBxcZFmGboiwAAAAIdEVYdENvbW1lbnQA9syWvwAAAuFJREFUOMvtlUtsjFEUx//n3nn0YdpBh1abRpt4LFqtqkc3jRKkNEIsiIRIBBEhJJpKlIVo4m1RRMKKjQiRMJRUqUdKPT71qpIpiRKPaqdF55tv5vvusZjQTjOlseUkd3Xu/3dPzusC/22wtu2wRn+jG5So/OCDh8ycMJDflehMlkJkVK7KUYN+ufzA/RttH76zaVocDptRxzQtNi3mRWuPc+6cKtlXZ/sddP2uu9uXlmYXZ6Qm8v4Tz8lhF1H+zDQXt7S8oLMXtbF4e8QaFHjj3kbP2MzkktHpiTjp9VH6iHiA+whtAsX5brpwueMGdONdf/2A4M7ukDs1JW662+XkqTkeUoqjKtOjm2h53YFL15pSJ04Zc94wdtibr26fXlC2mzRvBccEbz2kiRFD414tKMlEZbVGT33+qCoHgha81SWYsew0r1uzfNylmtpx80pngQQ91LwVk2JGvGnfvZG6YcYRAT16GFtW5kKKfo1EQLtfh5Q2etT0BIWF+aitq4fDbk+ImYo1OxvGF03waFJQvBCkvDffRyEtxQiFFYgAZTHS0zwAGD7fG5TNnYNTp8/FzvGwJOfmgG7GOx0SAKKgQgDMgKBI0NJGMEImpGDk5+WACEwEd0ywblhGUZ4Hw5OdUekRBLT7DTgdEgxACsIznx8zpmWh7k4rkpJcuHDxCul6MDsmmBXDlWCH2+XozSgBnzsNCEE4euYV4pwCpsWYPW0UHDYBKSWu1NYjENDReqtKjwn2+zvtTc1vMSTB/mvev/WEYSlASsLimcOhOBJxw+N3aP/SjefNL5GePZmpu4kG7OPr1+tOfPyUu3BecWYKcwQcDFmwFKAUo90fhKDInBCAmvqnyMgqUEagQwCoHBDc1rjv9pIlD8IbVkz6qYViIBQGTJPx4k0XpIgEZoRN1Da0cij4VfR0ta3WvBXH/rjdCufv6R2zPgPH/e4pxSBCpeatqPrjNiso203/5s/zA171Mv8+w1LOAAAAAElFTkSuQmCC">
						<img class="intLink" title="Undo" onclick="formatDoc('undo');" src="data:image/gif;base64,R0lGODlhFgAWAOMKADljwliE33mOrpGjuYKl8aezxqPD+7/I19DV3NHa7P///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARR8MlJq7046807TkaYeJJBnES4EeUJvIGapWYAC0CsocQ7SDlWJkAkCA6ToMYWIARGQF3mRQVIEjkkSVLIbSfEwhdRIH4fh/DZMICe3/C4nBQBADs=">
						<img class="intLink" title="Redo" onclick="formatDoc('redo');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAB1ChDljwl9vj1iE34Kl8aPD+7/I1////yH5BAEKAAcALAAAAAAWABYAAANKeLrc/jDKSesyphi7SiEgsVXZEATDICqBVJjpqWZt9NaEDNbQK1wCQsxlYnxMAImhyDoFAElJasRRvAZVRqqQXUy7Cgx4TC6bswkAOw==">
						<img class="intLink" title="Quitar Formato" onclick="formatDoc('removeFormat')" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9oECQMCKPI8CIIAAAAIdEVYdENvbW1lbnQA9syWvwAAAuhJREFUOMtjYBgFxAB501ZWBvVaL2nHnlmk6mXCJbF69zU+Hz/9fB5O1lx+bg45qhl8/fYr5it3XrP/YWTUvvvk3VeqGXz70TvbJy8+Wv39+2/Hz19/mGwjZzuTYjALuoBv9jImaXHeyD3H7kU8fPj2ICML8z92dlbtMzdeiG3fco7J08foH1kurkm3E9iw54YvKwuTuom+LPt/BgbWf3//sf37/1/c02cCG1lB8f//f95DZx74MTMzshhoSm6szrQ/a6Ir/Z2RkfEjBxuLYFpDiDi6Af///2ckaHBp7+7wmavP5n76+P2ClrLIYl8H9W36auJCbCxM4szMTJac7Kza////R3H1w2cfWAgafPbqs5g7D95++/P1B4+ECK8tAwMDw/1H7159+/7r7ZcvPz4fOHbzEwMDwx8GBgaGnNatfHZx8zqrJ+4VJBh5CQEGOySEua/v3n7hXmqI8WUGBgYGL3vVG7fuPK3i5GD9/fja7ZsMDAzMG/Ze52mZeSj4yu1XEq/ff7W5dvfVAS1lsXc4Db7z8C3r8p7Qjf///2dnZGxlqJuyr3rPqQd/Hhyu7oSpYWScylDQsd3kzvnH738wMDzj5GBN1VIWW4c3KDon7VOvm7S3paB9u5qsU5/x5KUnlY+eexQbkLNsErK61+++VnAJcfkyMTIwffj0QwZbJDKjcETs1Y8evyd48toz8y/ffzv//vPP4veffxpX77z6l5JewHPu8MqTDAwMDLzyrjb/mZm0JcT5Lj+89+Ybm6zz95oMh7s4XbygN3Sluq4Mj5K8iKMgP4f0////fv77//8nLy+7MCcXmyYDAwODS9jM9tcvPypd35pne3ljdjvj26+H2dhYpuENikgfvQeXNmSl3tqepxXsqhXPyc666s+fv1fMdKR3TK72zpix8nTc7bdfhfkEeVbC9KhbK/9iYWHiErbu6MWbY/7//8/4//9/pgOnH6jGVazvFDRtq2VgiBIZrUTIBgCk+ivHvuEKwAAAAABJRU5ErkJggg==">
						<img class="intLink" title="Negrita" onclick="formatDoc('bold');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAInhI+pa+H9mJy0LhdgtrxzDG5WGFVk6aXqyk6Y9kXvKKNuLbb6zgMFADs=">
						<img class="intLink" title="Inclinado" onclick="formatDoc('italic');" src="data:image/gif;base64,R0lGODlhFgAWAKEDAAAAAF9vj5WIbf///yH5BAEAAAMALAAAAAAWABYAAAIjnI+py+0Po5x0gXvruEKHrF2BB1YiCWgbMFIYpsbyTNd2UwAAOw==">
						<img class="intLink" title="Subrayado" onclick="formatDoc('underline');" src="data:image/gif;base64,R0lGODlhFgAWAKECAAAAAF9vj////////yH5BAEAAAIALAAAAAAWABYAAAIrlI+py+0Po5zUgAsEzvEeL4Ea15EiJJ5PSqJmuwKBEKgxVuXWtun+DwxCCgA7">
						<img class="intLink" title="Alinear izquierda" onclick="formatDoc('justifyleft');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JMGELkGYxo+qzl4nKyXAAAOw==">
						<img class="intLink" title="Alinear medio" onclick="formatDoc('justifycenter');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIfhI+py+0Po5y02ouz3jL4D4JOGI7kaZ5Bqn4sycVbAQA7">
						<img class="intLink" title="Alinear Derecha" onclick="formatDoc('justifyright');" src="data:image/gif;base64,R0lGODlhFgAWAID/AMDAwAAAACH5BAEAAAAALAAAAAAWABYAQAIghI+py+0Po5y02ouz3jL4D4JQGDLkGYxouqzl43JyVgAAOw==">
						<img class="intLink" title="Lista numero" onclick="formatDoc('insertorderedlist');" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAADljwliE35GjuaezxtHa7P///////yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKSespwjoRFvggCBUBoTFBeq6QIAysQnRHaEOzyaZ07Lu9lUBnC0UGQU1K52s6n5oEADs=">
						<img class="intLink" title="Lista Punto" onclick="formatDoc('insertunorderedlist');" src="data:image/gif;base64,R0lGODlhFgAWAMIGAAAAAB1ChF9vj1iE33mOrqezxv///////yH5BAEAAAcALAAAAAAWABYAAAMyeLrc/jDKSesppNhGRlBAKIZRERBbqm6YtnbfMY7lud64UwiuKnigGQliQuWOyKQykgAAOw==">
						<img class="intLink" title="Salto y Tabulador" onclick="formatDoc('formatblock','blockquote');" src="data:image/gif;base64,R0lGODlhFgAWAIQXAC1NqjFRjkBgmT9nqUJnsk9xrFJ7u2R9qmKBt1iGzHmOrm6Sz4OXw3Odz4Cl2ZSnw6KxyqO306K63bG70bTB0rDI3bvI4P///////////////////////////////////yH5BAEKAB8ALAAAAAAWABYAAAVP4CeOZGmeaKqubEs2CekkErvEI1zZuOgYFlakECEZFi0GgTGKEBATFmJAVXweVOoKEQgABB9IQDCmrLpjETrQQlhHjINrTq/b7/i8fp8PAQA7">
						<img class="intLink" title="Quitar Tabulador" onclick="formatDoc('outdent');" src="data:image/gif;base64,R0lGODlhFgAWAMIHAAAAADljwliE35GjuaezxtDV3NHa7P///yH5BAEAAAcALAAAAAAWABYAAAM2eLrc/jDKCQG9F2i7u8agQgyK1z2EIBil+TWqEMxhMczsYVJ3e4ahk+sFnAgtxSQDqWw6n5cEADs=">
						<img class="intLink" title="Agregar Tabulador" onclick="formatDoc('indent');" src="data:image/gif;base64,R0lGODlhFgAWAOMIAAAAADljwl9vj1iE35GjuaezxtDV3NHa7P///////////////////////////////yH5BAEAAAgALAAAAAAWABYAAAQ7EMlJq704650B/x8gemMpgugwHJNZXodKsO5oqUOgo5KhBwWESyMQsCRDHu9VOyk5TM9zSpFSr9gsJwIAOw==">
						<!--
						<img class="intLink" title="Vinculo" onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&amp;&amp;sLnk!=''&amp;&amp;sLnk!='http://'){formatDoc('createlink',sLnk)}" src="data:image/gif;base64,R0lGODlhFgAWAOMKAB1ChDRLY19vj3mOrpGjuaezxrCztb/I19Ha7Pv8/f///////////////////////yH5BAEKAA8ALAAAAAAWABYAAARY8MlJq7046827/2BYIQVhHg9pEgVGIklyDEUBy/RlE4FQF4dCj2AQXAiJQDCWQCAEBwIioEMQBgSAFhDAGghGi9XgHAhMNoSZgJkJei33UESv2+/4vD4TAQA7">
						<img class="intLink" title="Vincular Imagen" style="width:32px; height:32px;" onclick="TImage();" src="data:image/png;base64,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">
						-->
						<img class="intLink" title="Cortar" onclick="formatDoc('cut');" src="data:image/gif;base64,R0lGODlhFgAWAIQSAB1ChBFNsRJTySJYwjljwkxwl19vj1dusYODhl6MnHmOrpqbmpGjuaezxrCztcDCxL/I18rL1P///////////////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAVu4CeOZGmeaKqubDs6TNnEbGNApNG0kbGMi5trwcA9GArXh+FAfBAw5UexUDAQESkRsfhJPwaH4YsEGAAJGisRGAQY7UCC9ZAXBB+74LGCRxIEHwAHdWooDgGJcwpxDisQBQRjIgkDCVlfmZqbmiEAOw==">
						<img class="intLink" title="Copiar" onclick="formatDoc('copy');" src="data:image/gif;base64,R0lGODlhFgAWAIQcAB1ChBFNsTRLYyJYwjljwl9vj1iE31iGzF6MnHWX9HOdz5GjuYCl2YKl8ZOt4qezxqK63aK/9KPD+7DI3b/I17LM/MrL1MLY9NHa7OPs++bx/Pv8/f///////////////yH5BAEAAB8ALAAAAAAWABYAAAWG4CeOZGmeaKqubOum1SQ/kPVOW749BeVSus2CgrCxHptLBbOQxCSNCCaF1GUqwQbBd0JGJAyGJJiobE+LnCaDcXAaEoxhQACgNw0FQx9kP+wmaRgYFBQNeAoGihCAJQsCkJAKOhgXEw8BLQYciooHf5o7EA+kC40qBKkAAAGrpy+wsbKzIiEAOw==">
						<img class="intLink" title="Pegar" onclick="formatDoc('paste');" src="data:image/gif;base64,R0lGODlhFgAWAIQUAD04KTRLY2tXQF9vj414WZWIbXmOrpqbmpGjudClFaezxsa0cb/I1+3YitHa7PrkIPHvbuPs+/fvrvv8/f///////////////////////////////////////////////yH5BAEAAB8ALAAAAAAWABYAAAWN4CeOZGmeaKqubGsusPvBSyFJjVDs6nJLB0khR4AkBCmfsCGBQAoCwjF5gwquVykSFbwZE+AwIBV0GhFog2EwIDchjwRiQo9E2Fx4XD5R+B0DDAEnBXBhBhN2DgwDAQFjJYVhCQYRfgoIDGiQJAWTCQMRiwwMfgicnVcAAAMOaK+bLAOrtLUyt7i5uiUhADs=">
						<hr>
					</div>
					
					<form hidden name="compForm" method="post" action="sample.php" onsubmit="if(validateMode()){this.myDoc.value=oDoc.innerHTML;return true;}return false;">
						<p id="editMode"><input type="checkbox" name="switchMode" id="switchBox" onchange="setDocMode(this.checked);" /> <label for="switchBox">Ver Codigo HTML</label></p>
					</form>
					<style>
						div#textBox p{
							margin-top: 0px;
							margin-bottom: 0px;
						}
						div#textBox blockquote{
							font-size: 12px;
							padding-top: 0px;
							padding-bottom: 0px;
							margin: 0 0 0 40px;
							border: none;
						}
					</style>
					<div id="textBox" value="innerHTML" contenteditable="true" style="border-color: black;border-style: dotted;min-height: 279px;">
						<p style="font-size: 12px;">Edite Su Carta Documento Aqui</p>
					</div><!-- onpaste="Limpiardiv(this, event)" -->
					<?php
						//echo('<p id="ResApi" >Esperando Datos</p>');
						//Elementos::CrearImput("ResApi","text","Respuesta Api","12","value=''",true);//Combate De Las Piedras
						//Elementos::CrearSelectt("ResApi","Respuesta Api","12",false,true);//
						echo('<hr class="size1 hideline">');
						/*
						Elementos::CrearIniRow("12","border-color: #292d57;border-style: double;color: #292d57;");
							Elementos::CrearLeftTitulo("Guardar En Mis Formularios");
							echo("<div class='col-md-12' style=''> <b style='font-size: 12px;'>Al Guardar Este Formulario Sera Visible Solo En Su Cuenta.</b></div>");
							Elementos::CrearImput("NombreDeFormulario","text","Nombre De Formulario","12","value=''",true);//Combate De Las Piedras
							echo('<hr class="size1 hideline">');
							Elementos::CrearBoton("GuardarFormulario();","4","Guardar Plantilla","","","","btn2 btn-large btn-block btn-primary");//white-space: unset;
							Elementos::CrearBoton("EditarFormulario();","4","Editar Plantilla","","","","btn2 btn-large btn-block btn-warning");//white-space: unset;
							Elementos::CrearBoton("EliminarFormulario();","4","Eliminar Plantilla","","","","btn2 btn-large btn-block btn-Danger");//white-space: unset;
							//Elementos::CrearTabladashboard("ResApi","12","Respuesta De Rendiciones","display: block",false,10,"","",false);
							
						Elementos::CrearFinRow();
						echo('<hr class="size2 hideline">');
						*/
					?>
				</div>
			</div>
		</div>
		<img id="imgBase" src="BasePDF.jpg" alt="Smiley face" height="auto" width="auto" hidden>
		<div hidden>
		<canvas id="canvas"  height="200px" width="auto" ></canvas>
		</div>
		<?php
		
		echo('<hr class="size2 hideline">');
		Elementos::CrearLeftTitulo("Firma De Formulario");
		
		/***************************************************/
		//Formulario De Firma//
		// 
		//print_r(URLMAIN);
		//print_r(URL);
		//print_r(CARPETABASEURL . DS . SUBDOMINIO);
		
		Elementos::StartFormFile('12', CARPETABASEURL . DS . SUBDOMINIO . '/XMLHttpRequest/FirmasDeClientes/AjaxSubaDeArchivos.php');//'http://localhost:8081/clienteflash/XMLHttpRequest/FirmasDeClientes/AjaxSubaDeArchivos.php'
		//Elementos::StartFormFile('12', 'http://sispo.com.ar/clienteflash/XMLHttpRequest/FirmasDeClientes/AjaxSubaDeArchivos.php');
		Elementos::StartHide("");
		Elementos::CrearImput("UserId","text","UserId","6","value='" . $UserId . "'");
		Elementos::EndHide();
		Elementos::FormFileDosColumnas('image_uploads', '.png', 'nomultiple', '12', 'Subir Firma Digital', '','SubirFirma(this)','Seleccione Firma Digital');//Elementos::EndFormFile('image_uploads', '.jpg, .jpeg, .png', 'nomultiple', '12', 'Subir Firma Digital', '','SubirFirma(this)','Seleccione Firma');
		Elementos::CrearBoton('VistaPreviaPDF(\'textBox\')',"4","Cargar Vista Previa","","VistaPrevia");//,"display:none;"
		Elementos::CerrarFormulario();
		/***************************************************/
		
		//echo('<hr class="size2 hideline">');
		//Elementos::CerrarDesplegableConTitulo();
		//echo('<hr class="size2 hideline">');
		
		//Elementos::CrearDesplegableConTitulo("Vista Previa","4");
		//Elementos::CrearLeftTitulo("Vista Previa De Formulario");
		//echo('<hr class="size2 hideline">');
		echo('<hr class="size1 hideline">');
		
		
		//Elementos::CrearTitulo("Firmas");
		?>
		<style>
			#Paragrapiframe{
				font-size: 48;
				position: absolute;
				left: 0%;
				top: 0%;
				opacity: 0.5;
			}
		</style>
		
		<div class="col-md-12" style="">
			<!--<p id="Paragrapiframe">Copia No Valida Legalmente</p>-->
			<iframe id="iframePDF" type="application/pdf" style="width: inherit;height:266mm;display: none;"><!---->
			</iframe><!--  width:279mm; height:266mm-->
		</div>
		<?php
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		//Elementos::CerrarDesplegableConTitulo();
		//Elementos::CrearDesplegableConTitulo("Enviar Carta Documento","5");
		
		//Elementos::CrearTerminosYCondiciones("Terminos","EnviarCartaDoccumento","Acepto Los ","Terminos Y Condiciones", "terminosycondiciones","12");
		
		//if( $ ('#EnviarCartaDoccumento').hasClass( "disabled" )){return;}
		
		//Elementos::CrearBotonDisabled('EnviarCartaDoccumento(this)',"12","Confirmar Y Enviar Carta Documento","","EnviarCartaDoccumento");
		//Elementos::CrearBoton('EnviarCartaDoccumento(this)',"12","Confirmar Y Enviar Carta Documento","","EnviarCartaDoccumento");
		Elementos::CrearBoton('',"12","Continuar Con Envio De Carta Documento","","EntrarAModall");
		
		echo('<hr class="size1 hideline">');
		//Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		echo('<hr class="size2 hideline">');
		
	?>


		



		























































<style>

body {
	font-family: sans-serif;
	background: #eeeeee;
}
.wrapper {
	margin: 1em auto;
	text-align: left;
}
.sample {
	border: 1px solid #eeeeee;
	background: #ffffff;
	max-width: 30em;
	padding: 1em;
	margin-bottom: 1em;
}
.custom-select {
	position: relative;
}
.select-css {
	display: block;
	font-size: 1em;
	font-family: sans-serif;
	font-weight: 700;
	color: #444;
	line-height: 1.3;
	padding: .6em 1.4em .5em .8em;
	width: 100%;
	max-width: 100%;
	box-sizing: border-box;
	margin: 0;
	border: 1px solid #aaa;
	box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
	border-radius: .25em;
	-moz-appearance: none;
	-webkit-appearance: none;
	appearance: none;
	background-color: #fff;
	position: relative;
	z-index: 10;
}
.select-css::-ms-expand {
	display: none;
}
.select-css:hover {
	border-color: #888;
}
.select-css:focus {
	//border: 2px dashed blue; 
	color: #222;
	outline: none;
}
.custom-select-icons {
	position: absolute;
	top: 0.5em;
	right: 0.5em;
	z-index: 20;
	border: 1px solid white;
	background: transparent;
}

.custom-select-options {
    border: 1px solid #0068a9;
    /* border-radius: 0 0 0.5em .5em!important; */
    /* line-height: 0.0; */
    margin: 0;
    /* margin-top: -0.5em; */
    padding: 0;
    list-style-type: none;
    font-weight: normal;
    cursor: pointer;
    z-index: 2;
    position: absolute;
    width: calc(100% - 1px);
    background-color: #ffffff;
}
.custom-select-options li {
	padding: 1px;
    font-size: 8px;
}
.custom-select-options li:hover {
	background: blue;
	color: #fff;
	border: 1px solid blue;
	border-width: 0 0 0 1px;
}

.custom-select-options li:focus {
	border: 2px blue;
}


.custom-select-options li.linck {
	padding: 1px;
    font-size: 8px;
    
    background: #eeeeee;
    color: #333333;
    border: 1px solid #eeeeee;
    border-width: 0 0 0 1px;
}
.custom-select-options li.linck:hover {
	background: blue;
	color: #fff;
	border: 1px solid blue;
	border-width: 0 0 0 1px;
}
.custom-select-options li.linck:focus {
	border: 2px blue;
}


.icon {
		fill: ButtonText;
		pointer-events: none;
	}
@media screen and (-ms-high-contrast: active) {
	.icon {
		fill: ButtonText;
	}
}
.hidden-all {
	display: none;
}
.hidden-visually {
	position: absolute;
	width: 1px;
	height: 1px;
	padding: 0;
	overflow: hidden;
	clip: rect(0,0,0,0);
	white-space: nowrap;
	-webkit-clip-path: inset(50%);
	clip-path: inset(50%);
	border: 0;}
		</style>

