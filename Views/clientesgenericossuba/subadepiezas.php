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
		<?php

/*
			Elementos::CrearDesplegableConTitulo("Dar Novedad Ingreso Logico","1");
			Elementos::CrearSelectt2("Cliente","Cliente","6");
			Elementos::CrearSelectt2("Servicio","Servicio","6");
			Elementos::CrearInputUploadFiles("UploadXLSX","",".csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","SubirPiezas","12","Destinatario,Domicilio,CodigoPostal,Localidad,Barra");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
			echo('<div id ="dvExcel"></div>');
			Elementos::CrearDesplegableConTitulo("Dar Novedad Ingreso Fisico","3");
			echo("<p>Se Tomaran Los Comprobantes De Ingreso Previamente Cargados En Sispo</p>");
			echo('<hr class="size1 hideline">');
			Elementos::CrearIniRow("6");
				Elementos::CrearSelectt2("ComprobantesDeIngreso","Comprobantes De Ingreso Activos","12");
				echo('<hr class="size1 hideline">');
				Elementos::CrearBoton("DarEstadosDeIngresoLogico();","12","Ingreso Fisico","");
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("6");
				Elementos::Creardashboard("","PiezasEnComprobantesDeIngreso","Piezas En Comprobantes De Ingreso","12","Uncolor","SizablePiezasEnComprobantesDeIngreso");
				Elementos::CrearBoton("BuscarPiezasEnIngresoLogico();","12","Actualizar","");
			Elementos::CrearFinRow();
			echo('<hr class="size1 hideline">');
			Elementos::CrearTabladashboard("PiezasEnComprobantesDeIngreso","12","Piezas En Comprobantes De Ingreso","display: none",true,50,"display: block","display: block",false,"display: block","display: block");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
			
			
			Elementos::CrearDesplegableConTitulo("Despachar Piezas","4");
			echo("<p>Se Tomaran Los Despachos Previamente Realizados En Sispo</p>");
			echo('<hr class="size1 hideline">');
			Elementos::CrearIniRow("6");
				Elementos::CrearSelectt2("DespachosActivos","Despachos Activos","12");
				echo('<hr class="size1 hideline">');
				Elementos::CrearBoton("DarEstadosDeDespacho();","12","Despachar Piezas","");
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("6");
				Elementos::Creardashboard("","PiezasEnDespachos","Piezas En Despacho","12","Uncolor","SizablePiezasEnDespachos");
				Elementos::CrearBoton("BuscarPiezasEnDespachos();","12","Actualizar","");
			Elementos::CrearFinRow();
			echo('<hr class="size1 hideline">');
			Elementos::CrearTabladashboard("PiezasEnDespachos","12","Piezas En Despacho","display: none",true,50,"display: block","display: block",false,"display: block","display: block");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
			
			
			Elementos::CrearDesplegableConTitulo("Recepcionar Piezas","5");
			echo("<p>Se Tomaran Los Despachos Previamente Realizados</p>");
			echo('<hr class="size1 hideline">');
			Elementos::CrearIniRow("6");
				Elementos::CrearSelectt2("DespachosActivosEnviados","Despachos Activos Enviados A Mi Sucursal","12");
				echo('<hr class="size1 hideline">');
				Elementos::CrearBoton("DarEstadosDeDespachoAceptado();","12","Aceptar Piezas De Despacho","");
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("6");
				Elementos::Creardashboard("","PiezasEnDespachosAMiSucursal","Piezas En Despacho Enviada A Mi Sucursal","12","Uncolor","SizablePiezasEnDespachosAMiSucursal");
				Elementos::CrearBoton("BuscarPiezasEnDespachosPorAceptar();","12","Actualizar","");
			Elementos::CrearFinRow();
			echo('<hr class="size1 hideline">');
			Elementos::CrearTabladashboard("PiezasEnDespachosAMiSucursal","12","Piezas En Despacho Enviada A Mi Sucursal","display: none",true,50,"display: block","display: block",false,"display: block","display: block");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
*/
			Elementos::CrearDesplegableConTitulo("Dar Estado A Piezas","6");
/*
			Elementos::CrearLeftTitulo("Aceptar HDR");
			echo("<p>Se Tomaran Las Hojas De Rutas Creadas Previamente</p>");
			echo('<hr class="size1 hideline">');
			Elementos::CrearIniRow("6");
				Elementos::CrearSelectt2("Carteros","Cartero","6");
				Elementos::CrearSelectt2("HDR","Hoja De Ruta","6");
				echo('<hr class="size1 hideline">');
				Elementos::CrearBoton("PonerEtadoHDRAceptada();","12","Aceptar HDR","");
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("6");
				Elementos::Creardashboard("","PiezasEnHDR","Piezas En HDR","12","Uncolor","SizablePiezasEnHDR");
				Elementos::CrearBoton("BuscarPiezasEnHDR();","12","Actualizar","");
			Elementos::CrearFinRow();
			echo('<hr class="size1 hideline">');
			Elementos::CrearTabladashboard("PiezasEnHDR","12","Piezas En Hoja De Ruta","display: none",true,50,"display: block","display: block",false,"display: block","display: block");
			echo('<hr class="size1 hideline">');
			echo('<hr class="size2 hideline">');
*/
			Elementos::CrearLeftTitulo("Rendida A Cliente");
			echo("<p>Se Tomaran Las Rendiciones Creadas En Previamente Un Su Sucursal</p>");
			echo('<hr class="size1 hideline">');
			Elementos::CrearIniRow("6");
				Elementos::CrearSelectt2("NumeroDeRendicion","N° De Rendicion","12");
				echo('<hr class="size1 hideline">');
				Elementos::CrearBoton("PonerEtadoAcuseDeClienteEnMano();","12","Poner Estado Rendida A Cliente","");
			Elementos::CrearFinRow();
			Elementos::CrearIniRow("6");
				Elementos::Creardashboard("","PiezasEnRendicion","Piezas En Rendicion","12","Uncolor","SizablePiezasEnRendicion");
				Elementos::CrearBoton("BuscarPiezasEnRendicion();","12","Actualizar","");
			Elementos::CrearFinRow();
			echo('<hr class="size1 hideline">');
			Elementos::CrearTabladashboard("PiezasEnRendicion","12","Piezas En Rendicion","display: none",true,50,"display: block","display: block",false,"display: block","display: block");
			echo('<hr class="size1 hideline">');
			Elementos::CerrarDesplegableConTitulo();
			echo('<hr class="size2 hideline">');
			
		?>
		
</div>





















