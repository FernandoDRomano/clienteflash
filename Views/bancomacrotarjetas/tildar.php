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
		//border: 1px solid rgba(0, 0, 0, .2);
	}
	#TableroDeGestiones{
		//zoom: 70%;
	}
</style>

		<div id ="dvExcel"></div>
	<?php
		Elementos::CrearDesplegableConTitulo("Tildar Piezas","1");
		Elementos::CrearSelectt("IdOBarcode","Pieza Identificada Por Id O Barcode?","6");
		Elementos::CrearInputUploadFiles("UploadXLSX","",".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","TildarPiezas","12","Destinatario,Domicilio,CodigoPostal,Localidad,Barra");//,application/pdf
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
	
		Elementos::CrearDesplegableConTitulo("Subir Base De Piezas Tildadas A Banco Macro","2");
		Elementos::CrearSelectt("IdOBarcodeSuba","Pieza Identificada Por Id O Barcode?","6");
		Elementos::CrearInputUploadFiles("SubaUploadXLSX","",".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","SubaPiezasTildadas","12","Destinatario,Domicilio,CodigoPostal,Localidad,Barra");//,application/pdf
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
	
/*
		//Caja Desplegable Con Titulo
		Elementos::CrearDesplegableConTitulo("Busqueda De Estados Por Piezas","BusquedaDeEstadosPorPiezas");
		Elementos::CrearSelectt("BusquedaIdOBarcode","Pieza Identificada Por Id O Barcode?","6");
		Elementos::CrearImput("BusquedaBarcode","text","Id O Barcode","6",$Extra = false);
		Elementos::CrearBoton("BuscarEstadosDePieza();","12","Buscar Estados De Pieza","");
		Elementos::CrearTabladashboard("EstadosDePiezas","12","Estados De Piezas","display: contents;",false,100,"display: none;","display: none;");//,
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		echo('<hr class="size2 hideline">');
		
		
		
		//Caja Desplegable Con Titulo
		Elementos::CrearDesplegableConTitulo("Insercion De Estados","InsercionDeEstados");
		Elementos::StartFormFile('12', 'http://sispo.com.ar/clienteflash/XMLHttpRequest/EstadosManuales/AjaxEstadoManual.php');
		Elementos::CrearSelectt("IdOBarcode","Pieza Identificada Por Id O Barcode?","4");
		Elementos::CrearImput("Barcode","text","Id O Barcode","4",$Extra = false);
		Elementos::CrearSelectt("EstadoDeLaPieza","Estado De La Pieza","4");
		echo('<hr class="size1 hideline">');
		Elementos::CrearSelectt("Vinculo","Vinculo","4","readonly");
		Elementos::CrearImput("ApellidoYNombres","text","Apellido Y Nombres","4","readonly");
		Elementos::CrearImput("DNI","text","DNI","4","readonly");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImputDeFecha("datetimepicker1","FechaI","Fecha Y Hora Real De Visita","12");
		Elementos::EndFormFile('image_uploads', '.jpg, .jpeg, .png', 'nomultiple', '12', 'Poner Estado', '','PonerEstado(this)');
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
	?>
	<hr class="size2 hideline">
	<?php
		//Caja Desplegable Con Titulo
		Elementos::CrearDesplegableConTitulo("Edicion De Estados","EdicionDeEstados");
		Elementos::StartFormFile('12', 'http://sispo.com.ar/clienteflash/XMLHttpRequest/EstadosManuales/AjaxEditarEstadoManual.php');//../XMLHttpRequest/EstadosManuales/AjaxEditarEstadoManual.php
		Elementos::CrearImput("EdicionIdEstado","number","Id De Estado","3",$Extra = false);
		Elementos::CrearSelectt("EdicionIdOBarcode","Identificador De Pieza","3");
		Elementos::CrearImput("EdicionBarcode","text","Id O Barcode","3",$Extra = false);
		Elementos::CrearSelectt("EdicionEstadoDeLaPieza","Estado De La Pieza","3");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImputDeFecha("datetimepicker1","EdicionFechaI","Fecha Y Hora Real De Visita","3");
		Elementos::CrearSelectt("EdicionVinculo","Vinculo","3","readonly");
		Elementos::CrearImput("EdicionApellidoYNombres","text","Apellido Y Nombres","3","readonly");
		Elementos::CrearImput("EdicionDNI","text","DNI","3","readonly");
		echo('<hr class="size1 hideline">');
		Elementos::EndFormFile('image_uploads2', '.jpg, .jpeg, .png', 'nomultiple', '12', 'Editar Estado', '','EditarEstado(this)');
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
	?>
	<hr class="size2 hideline">
	<?php
		//Caja Desplegable Con Titulo
		Elementos::CrearDesplegableConTitulo("Eliminacion De Estados","EliminacionDeEstados");
		Elementos::CrearImput("EliminacionIdEstado","number","Id De Estado","12",$Extra = false);
		Elementos::CrearBoton("EliminacionDeEstadosDePieza();","12","Eliminar Estado De Pieza","");
		echo('<hr class="size1 hideline">');
		Elementos::CerrarDesplegableConTitulo();
		*/
	?>
	







