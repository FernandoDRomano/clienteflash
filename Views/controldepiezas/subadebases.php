<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
	$InicioDeAnio = "InicioDeAnio";
	$Fecha = "Fecha";
	use Config\Elementos as Elementos;
	
?>


<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">

<script>
	
</script>
<style>
	#ModalDatos ::-webkit-scrollbar {
	width: 16px;
	}
	#ModalDatos ::-webkit-scrollbar-track {
	background: #00F0F0; 
	}
	#ModalDatos ::-webkit-scrollbar-thumb {
	background: #00B0B0;
	}
	#ModalDatos ::-webkit-scrollbar-thumb:hover {
	background: #00A0A0; 
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
</style>

<style>
	ul.pagination li a.active{
		background: #CDDC39;
	}
	#ParaTabla{
		overflow-x: scroll !important;
		margin: 0 auto;
		white-space: nowrap;
	}
</style>

<style>
	.btn-secondary {
		color: #fff !important;
		background-color: #6c757d;
		border-color: #6c757d;
	}
</style>

<style>
	.control-label.Active{
		background: none;
	}
	#TablaDeResultados{
		display: contents;
	}
	.CajaDeGrupos{
		border: 1px solid rgba(0, 0, 0, .2);
	}
	#TableroDeGestiones{
		//zoom: 70%;
	}
	.SpanFile:before {
		content: "Seleccionar Archivo";
		position: relative;
		cursor: alias;
	}
	.SpanFile {
		border: 1px solid #999;
		cursor: alias;
		display: block;
		width: 100%;
	}
	.file {
		width: 100%;
	}
	.CajaDeGrupos{
		box-sizing: border-box;
	}
</style>
<div id ="dvExcel"></div>
	<div id="ConsultaSinRetorno" class="number" hidden></div>
		<?php
			Elementos::CrearDesplegableConTitulo("Suba De Banco Macro","1");
			Elementos::CrearTitulo("");
			
			echo('<hr class="size1 hideline">');
			
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDeCargaSistemaFlash","Fecha De Carga","6");
			$Config->DivContenedor = "DivSuba";
			$Config->ConFiltro = true;
			$Config->CrearAlCargarDatos = true;
			$Config->MensajeEnFail = false;
			$Config->TextoEnFail = "";
			//$Config->EsconderElementos = [0];
			Elementos::CrearInputUploadFilesRaw("Archivo","",".csv,.txt","SubirBase","12","","",""
			,json_encode($Config),0,0);
			//Elementos::Creardashboard("","Suba","Suba De Archivo Raw","6","Uncolor","SizableSuba");	
			Elementos::CrearTabladashboard("Suba","12","Suba De Archivo","display: block",false,10,"","",false);
			echo('<hr class="size1 hideline">');
			echo('<hr class="size2 hideline">');
			Elementos::CrearBoton("SubirBase();","12","Subir Base","");//SubirBase
			echo('<hr class="size2 hideline">');
			Elementos::CrearTitulo("Respuestas De Suba");
			Elementos::CrearTabladashboard("Res","12","Respuesta De Suba","display: block",false,10,"","",false);
			echo('<hr class="size1 hideline">');
			echo('<hr class="size2 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
			echo('<hr class="size2 hideline">');
			echo('<hr class="size2 hideline">');
		?>
</div>
