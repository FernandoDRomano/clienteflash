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
			Elementos::CrearTitulo("Stock De Piezas De BancoMacro");
			
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			Elementos::CrearBoton("BuscarPiezasEnStock();","4","Buscar Piezas En Stock","");//Para Banco Macro
			echo('<hr class="size1 hideline">');
			
			Elementos::Creardashboard("","PiezasEnStock","Piezas En Stock","12","Uncolor","SizablePiezasEnStock");
			Elementos::CrearTabladashboard("PiezasEnStock","3","Piezas En Stock");
			echo('<hr class="size1 hideline">');
			
			
			
			//Botones
			/*
			Elementos::CrearBoton("BuscarPiezasSinDestino();","6","Buscar Piezas Sin Destino","En Consultas Web De Banco Macro");
			Elementos::CrearBoton("PonerPiezasConDestino();","6","Editar Destinos A Todos","Desde Piezas Subidas");
			echo('<hr class="size1 hideline">');
			//Tablero
			Elementos::Creardashboard("","PiezasSinDestino","Piezas Sin Destino","6","Uncolor","SizablePiezasSinDestino");
			Elementos::Creardashboard("","PiezasSinDestinoConBaseBancaria","Piezas Sin Destino Con Base Bancaria","6","Uncolor","SizablePiezasSinDestinoConBaseBancaria");
			echo('<hr class="size1 hideline">');
			//Tablas De Tableros
			Elementos::CrearTabladashboard("PiezasSinDestino","3","Piezas Sin Destino");
			Elementos::CrearTabladashboard("PiezasSinDestinoConBaseBancaria","3","Piezas Sin Destino Con Base Bancaria");
			*/
		?>
	</div>
	
	<hr class="size2 hideline">
	
	<?php
		/*
		//Titulo
		Elementos::CrearTitulo("Gestion De Piezas");
		//Elementos Para Busqueda
		Elementos::CrearImput("DNIBusqueda","numberNoFloat","DNI / DU:","4");
		Elementos::CrearImput("Destinatario","text","Apellido y Nombre:","4");
		Elementos::CrearImput("NumeroDePieza","numberNoFloat","Numero De Pieza:","4");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
		Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
		Elementos::CrearBoton("Buscar();","12","Buscar Datos De Tarjetas","Tarjetas Bancarias Con Datos");
		//Tablero
		Elementos::Creardashboard("divColor1","TarjetasIngresadas","Tarjetas Ingresadas","3","MaximixedTable","SizableTarjetasIngresadas");
		Elementos::Creardashboard("divColor2","TarjetasEnGestion","Tarjetas En Gestion","3","MaximixedTable","SizableTarjetasEnGestion");
		Elementos::Creardashboard("divColor3","TarjetasEntregadas","Tarjetas Entregadas","3","MaximixedTable","SizableTarjetasEntregadas");
		Elementos::Creardashboard("divColor4","SolicitadasPorElCliente","Solicitadas Por El Cliente","3","MaximixedTable","SizableTarjetasSolicitadasPorElClente");
		echo('<hr class="size1 hideline">');
		Elementos::Creardashboard("divColor5","TarjetasNoEntregadas","Tarjetas No Entregadas","12","MaximixedTable","SizableTarjetasNoEntregadas");
		echo('<hr class="size1 hideline">');
		Elementos::Creardashboard("divColor6","DomicilioInsuficiente","Domicilio Insuficiente","3","MaximixedTable","SizableDomicilioInsuficiente");
		Elementos::Creardashboard("divColor7","SeMudo","Se Mudo","3","MaximixedTable","SizableSeMudo");
		Elementos::Creardashboard("divColor8","Fallecio","Fallecio","3","MaximixedTable","SizableFallecio");
		Elementos::Creardashboard("divColor9","SeNiegaARecibir","Se Niega A Recibir","3","MaximixedTable","SizableSeNiegaARecibir");
		echo('<hr class="size1 hideline">');
		Elementos::Creardashboard("divColor10","SegundaVisitas","Segunda Visitas","6","MaximixedTable","SizableTresVisitas");
		Elementos::Creardashboard("divColor11","OtrasRazonesDeNoEntregadas","Otras Razones De (No Entregadas)","6","MaximixedTable","SizableOtrasRazonesDeNoEntregadas");
		//Tablas De Tableros
		Elementos::CrearTabladashboard("TarjetasIngresadas","3","Tarjetas Ingresada");
		Elementos::CrearTabladashboard("TarjetasEnGestion","3","Tarjetas En Gestion");
		Elementos::CrearTabladashboard("TarjetasEntregadas","3","Tarjetas Entegadas");
		Elementos::CrearTabladashboard("TarjetasSolicitadasPorElClente","3","Solicitadas Por El Cliente");
		Elementos::CrearTabladashboard("TarjetasNoEntregadas","3","Tarjetas No Entregadas");
		Elementos::CrearTabladashboard("DomicilioInsuficiente","3","Domicilio Insuficiente");
		Elementos::CrearTabladashboard("SeMudo","3","Se Mudo");
		Elementos::CrearTabladashboard("Fallecio","3","Fallecio");
		Elementos::CrearTabladashboard("SeNiegaARecibir","3","Se Niega A Recibir");
		Elementos::CrearTabladashboard("TresVisitas","3","Dos Visitas");
		Elementos::CrearTabladashboard("OtrasRazonesDeNoEntregadas","3","Otras Razones De No Entregadas");
		*/
	?>
</div>







