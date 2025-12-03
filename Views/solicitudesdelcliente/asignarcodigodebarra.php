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
	/*
	.CajaDeGrupos{
		border: 1px solid rgba(0, 0, 0, .2);
	}
	*/
	#TableroDeGestiones{
		//zoom: 70%;
	}
</style>

<style>
	div#Parrafo p{
		margin-top: 0px;
		margin-bottom: 0px;
	}
	div#Parrafo blockquote{
		font-size: 12px;
		padding-top: 0px;
		padding-bottom: 0px;
		margin: 0 0 0 40px;
		border: none;
	}
</style>
<!-- 
<p>Este Panel Mostrara Los Pedidos Del Cliente Por Medio De Plataformas APPI, Las Piezas Creadas Por Medio De API Contienen El UsuarioId 2</p>
-->
<img id="imgBase" src="../BasePDF.jpg" alt="Smiley face" height="auto" width="auto" hidden> 
		<?php
			//Titulo
			
			Elementos::CrearDesplegableConTitulo("Asignar Codigo De Barra A Piezas Solicitadas Por Cliente","1");
			
			echo('<hr class="size2 hideline">');
			Elementos::CrearLeftTitulo("Datos De La Busqueda");
			
			//Elementos::CrearSelectt("ServicioGrupo","Tipo De Servicio","6");
			//Elementos::CrearSelectt("Servicio","Tipo De Servicio","6");
			
			Elementos::CrearImput("ComprobanteDeIngreso","text","Comprobante De Ingreso:","12",false,true,false);
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			Elementos::CrearBoton("Buscar();","12","Buscar Datos De Pedido","");
			/*
			//Elementos Para Busqueda
			Elementos::CrearImput("DNIBusqueda","numberNoFloat","DNI / DU:","4");
			Elementos::CrearImput("Destinatario","text","Apellido y Nombre:","4");
			Elementos::CrearImput("NumeroDePieza","numberNoFloat","Numero De Pieza:","4");
			echo('<hr class="size1 hideline">');
			Elementos::CrearBoton("Buscar();","12","Buscar Datos De Pedido","");
			echo('<hr class="size2 hideline">');
			//Tablero
			*/
			
			Elementos::CrearLeftTitulo("Resultados De Busqueda");
			//Elementos::Creardashboard("divColor1","Ingresadas","Ingresadas","12","MaximixedTable","SizableIngresadas");
			Elementos::CrearTabladashboard("Ingresadas","12","Ingresada","display:block",false,10,"","",false,"");
			echo('<hr class="size1 hideline">');
			
			Elementos::CrearBoton("EstablecerCodigosDeBarra();","12","Establecer Codigos De Barra","");
			/*
			
			echo('<hr class="size1 hideline">');
			Elementos::Creardashboard("divColor2","EnGestion","En Gestion","3","MaximixedTable","SizableEnGestion");
			Elementos::Creardashboard("divColor3","Entregadas","Entregadas","3","MaximixedTable","SizableEntregadas");
			Elementos::Creardashboard("divColor4","SolicitadasPorElCliente","Solicitadas Por El Cliente","3","MaximixedTable","SizableSolicitadasPorElClente");
			Elementos::Creardashboard("divColor5","NoEntregadas"," No Entregadas","3","MaximixedTable","SizableNoEntregadas");
			echo('<hr class="size1 hideline">');
			
			//Tablas De Tableros
			Elementos::CrearTabladashboard("EnGestion","3","En Gestion");
			Elementos::CrearTabladashboard("Entregadas","3","Entegadas");
			Elementos::CrearTabladashboard("SolicitadasPorElClente","3","Solicitadas Por El Cliente");
			Elementos::CrearTabladashboard("NoEntregadas","3","No Entregadas");
			*/
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
		?>
		<div class="" id="DivDeImagenes" style="display:none"></div>
		<canvas id="canvas"  height="200px" width="auto" ></canvas>
		</div>
	</div>
</div>







