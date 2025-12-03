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
</style>

<div id="ConsultaSinRetorno" class="number" hidden></div>
<div id="TableroDeGestiones" style="background: aliceblue;">
	<div class="CajaDeGrupos">
		<?php
			//Titulo
			Elementos::CrearTitulo("Suba De Archivos De Imagenes Por Api");
			/*
			Elementos::StartFormFile('6', 'http://sispo.com.ar/clienteflash/XMLHttpRequest/Test/AjaxImagen.php');//  //../XMLHttpRequest/Test/AjaxImagen.php
			Elementos::EndFormFile('image_uploads', '.jpg, .jpeg, .png', 'multiple', '12', 'Subir Datos', '','PonerEstado(this)');
			*/
			Elementos::StartFormFile('12', '../XMLHttpRequest/EstadosManuales/AjaxEstadoManual.php');
			Elementos::CrearSelectt("IdOBarcode","Pieza Identificada Por Id O Barcode?","4");
			Elementos::CrearImput("Barcode","text","Id O Barcode","4",$Extra = false);
			Elementos::CrearSelectt("EstadoDeLaPieza","Estado De La Pieza","4");
			Elementos::CrearSelectt("Vinculo","Vinculo","4","readonly");
			Elementos::CrearImput("ApellidoYNombres","text","Apellido Y Nombres","4","readonly");
			Elementos::CrearImput("DNI","text","DNI","4","readonly");
			Elementos::CrearImputDeFecha("datetimepicker1","FechaI","Fecha Y Hora Real De Visita","12");
			Elementos::EndFormFile('image_uploads2', '.jpg, .jpeg, .png', 'multiple', '12', 'Poner Estado', '','PonerEstado(this)');//
			/*
			//Tablero
			Elementos::Creardashboard("","PiezasEnBase","Piezas En Base Sispo","6","Uncolor","SizablePiezasEnBase");
			echo('<hr class="size1 hideline">');
			//Tablas De Tableros
			Elementos::CrearTabladashboard("PiezasEnBase","3","Piezas En Base Sispo");
			Elementos::CrearImput("DNIBusqueda","numberNoFloat","DNI / DU:","4");
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			*/
			//Elementos::CrearInputUploadFiles("UploadXLSX","",".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","SubirPiezas","6","Destinatario,Domicilio,CodigoPostal,Localidad,Barra");//,application/pdf
						//Botones
			//Elementos::CrearBoton("BuscarFicheroXLSX();","12","Buscar Fichero XLSX","Para Testeo");
			echo('<hr class="size1 hideline">');
		?>
		<!--
		<div class="input-group">
			<label class="file">
				<input class="InputUploadFiles" type="file" id="" multiple accept="application/vnd.ms-excel">
				<span class="SpanFile">Sin Archivos Seleccionados</span>
			</label>
			<div class="ListaDeArchivos" id=""></div>
		</div>
		-->
		<div id ="dvExcel"></div>
	</div>
</div>







