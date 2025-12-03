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
<p>Este Panel Mostrara Los Pedidos Del Cliente Por Medio De Plataformas APPI, Las Piezas Creadas Por Medio De API Contienen El UsuarioId 2</p>
		<?php
			//Titulo
			
			Elementos::CrearDesplegableConTitulo("Panel De Pedidos De Clientes","1");
			
			echo('<hr class="size2 hideline">');
			Elementos::CrearLeftTitulo("Datos De La Busqueda");
			
			Elementos::CrearSelectt("ServicioGrupo","Tipo De Servicio","6");
			Elementos::CrearSelectt("Servicio","Tipo De Servicio","6");
			
			Elementos::CrearImput("ComprobanteDeIngreso","Comprobante De Ingreso","DNI / DU:","4");
			
			//Elementos Para Busqueda
			Elementos::CrearImput("DNIBusqueda","numberNoFloat","DNI / DU:","4");
			Elementos::CrearImput("Destinatario","text","Apellido y Nombre:","4");
			Elementos::CrearImput("NumeroDePieza","numberNoFloat","Numero De Pieza:","4");
			echo('<hr class="size1 hideline">');
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			Elementos::CrearBoton("Buscar();","12","Buscar Datos De Pedido","");
			echo('<hr class="size2 hideline">');
			//Tablero
			
			Elementos::CrearLeftTitulo("Resultados De Busqueda");
			Elementos::Creardashboard("divColor1","Ingresadas","Ingresadas","12","MaximixedTable","SizableIngresadas");
			echo('<hr class="size1 hideline">');
			Elementos::Creardashboard("divColor2","EnGestion","En Gestion","3","MaximixedTable","SizableEnGestion");
			Elementos::Creardashboard("divColor3","Entregadas","Entregadas","3","MaximixedTable","SizableEntregadas");
			Elementos::Creardashboard("divColor4","SolicitadasPorElCliente","Solicitadas Por El Cliente","3","MaximixedTable","SizableSolicitadasPorElClente");
			Elementos::Creardashboard("divColor5","NoEntregadas"," No Entregadas","3","MaximixedTable","SizableNoEntregadas");
			echo('<hr class="size1 hideline">');
			
			//Tablas De Tableros
			Elementos::CrearTabladashboard("Ingresadas","3","Ingresada");
			Elementos::CrearTabladashboard("EnGestion","3","En Gestion");
			Elementos::CrearTabladashboard("Entregadas","3","Entegadas");
			Elementos::CrearTabladashboard("SolicitadasPorElClente","3","Solicitadas Por El Cliente");
			Elementos::CrearTabladashboard("NoEntregadas","3","No Entregadas");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
		?>
		<div class="col-sm-12 col-xs-12" id="GraficaGestion" ></div>
		<hr class="size1 hideline">
		<div class="col-sm-12 col-xs-12" id="GraficaMotivos" ></div>
	</div>
</div>







