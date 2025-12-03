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
			Elementos::CrearTitulo("Carga De Documento XLSX");
			/*
			//Tablero
			Elementos::Creardashboard("","PiezasEnBase","Piezas En Base Sispo","6","Uncolor","SizablePiezasEnBase");
			Elementos::Creardashboard("","PiezasEnBaseDeBanco","Piezas En Base BancoMacro","6","Uncolor","SizablePiezasEnBaseDeBanco");
			echo('<hr class="size1 hideline">');
			//Tablas De Tableros
			Elementos::CrearTabladashboard("PiezasEnBase","3","Piezas En Base Sispo");
			Elementos::CrearTabladashboard("PiezasEnBaseDeBanco","3","Piezas En Base BancoMacro");
			
			Elementos::CrearImput("DNIBusqueda","numberNoFloat","DNI / DU:","4");
			
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			*/
			Elementos::CrearInputUploadFiles("UploadXLSX","",".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","SubirPiezas","6","Destinatario,Domicilio,CodigoPostal,Localidad,Barra");//,application/pdf
			Elementos::CrearInputUploadFiles("UploadXLSX2","",".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","SubirPiezas","6","Destinatario,Domicilio,CodigoPostal,Localidad,Barra");
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







