<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
	$InicioDeAnio = "InicioDeAnio";
	$Fecha = "Fecha";
	use Config\Elementos as Elementos;
	echo("menu eliminado por la empresa");
	return;
	
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
			Elementos::CrearTitulo("Novedades De Piezas");
			//Elementos Para Busqueda
			Elementos::StartHide("");
			Elementos::CrearImput("DNIBusqueda","numberNoFloat","DNI / DU:","4");
			Elementos::CrearImput("Destinatario","text","Apellido y Nombre:","4");
			Elementos::CrearImput("NumeroDePieza","numberNoFloat","Numero De Pieza:","4");
			echo('<hr class="size1 hideline">');
			Elementos::EndHide();
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			Elementos::CrearBoton("Buscar();","12","Buscar Datos De Tarjetas","Tarjetas Bancarias Con Datos");
			//Tablero
			Elementos::Creardashboard("divColor1","PiezasIngresadas","Piezas Con Novedad Logico Recibido","6","MaximixedTable","SizablePiezasIngresadas");
			Elementos::Creardashboard("divColor2","PiezasFaltantesEnGestionPostal","Piezas Con Novedad Logico Recibido, Faltantes En Gestion Postal","6","MaximixedTable","SizablePiezasFaltantesEnGestionPostal");
			//Elementos::Creardashboard("divColor3","TarjetasEntregadas","Faltantes En ClienteSispo","12","MaximixedTable","SizableTarjetasEntregadas");
			echo('<hr class="size1 hideline">');
			//Tablas De Tableros
			Elementos::CrearTabladashboard("PiezasIngresadas","3","Piezas Ingresadas");
			Elementos::CrearTabladashboard("PiezasFaltantesEnGestionPostal","3","Piezas Faltantes En Gestion Postal");
			//Elementos::CrearTabladashboard("TarjetasEntregadas","3","Faltantes En ClienteSispo");
		?>
		<div class="col-sm-12 col-xs-12" id="GraficaGestion" ></div>
		<hr class="size1 hideline">
		<div class="col-sm-12 col-xs-12" id="GraficaMotivos" ></div>
	</div>
</div>







