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
<div id ="dvExcel"></div>
	<div id="ConsultaSinRetorno" class="number" hidden></div>
		<?php
		
			Elementos::CrearDesplegableConTitulo("Test Boveda Avanzado","2");
			Elementos::CrearTitulo("Tabla Desde TXT");
			echo('<hr class="size1 hideline">');
			$Config->DivContenedor = "DivSuba";
			$Config->ConFiltro = true;
			$Config->CrearAlCargarDatos = true;
			$Config->MensajeEnFail = false;
			$Config->TextoEnFail = "";
			$Config->EsconderElementos = [0];
			
			Elementos::CrearInputUploadFilesRaw("Archivo","",".csv,.txt","FicheroAConsola","12","Id,Nombre,Exedido","0,4,10","4,10,200",json_encode($Config));
			echo('<hr class="size1 hideline">');
			Elementos::CrearBoton("BuscarPiezasDeApiTabla();","12","Buscar Pieza Para Api","De Banco Macro");
			//Elementos::Creardashboard("","Suba","Suba De Archivo Raw","6","Uncolor","SizableSuba");	
			Elementos::CrearTabladashboard("Suba","12","Suba De Archivo Raw","display: block",false,100,"","",false);
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			
			Elementos::CrearDesplegableConTitulo("Test Boveda Basico","1");
			Elementos::CrearTitulo("Serlects");
			Elementos::CrearSelectt("ComprobantesDeIngresos","Comprobantes De Ingresos","6");
			Elementos::CrearSelectt("HojasDeRutas","Hojas De Rutas","6");
			echo('<hr class="size1 hideline">');
			Elementos::CrearTitulo("Tablas");
			Elementos::CrearImputDeFecha("datetimepicker1","FechaDesde","Fecha Inicial De Busqueda","6");
			Elementos::CrearImputDeFecha("datetimepicker2","FechaHasta","Fecha Final De Busqueda","6");
			echo('<hr class="size1 hideline">');
			Elementos::CrearImput("DNI","numberNoFloat","DNI / DU:","4");
			Elementos::CrearImput("Destinatario","text","Apellido y Nombre:","4");
			Elementos::CrearImput("NumeroDePieza","numberNoFloat","Numero De Pieza:","4");
			echo('<hr class="size1 hideline">');
			Elementos::CrearBoton("BuscarPiezasDeApi();","6","Buscar Pieza Para Api","De Banco Macro");
			echo('<hr class="size1 hideline">');
			Elementos::Creardashboard("","ConsultaPieza","Consulta Pieza Para Api","6","Uncolor","SizableConsultaPieza");
			Elementos::CrearTabladashboard("ConsultaPieza","12","Consulta Pieza Para Api");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
			
			
			
		?>
</div>





















