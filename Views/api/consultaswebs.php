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
		#TableroDeGestiones{
			//zoom: 70%;
		}
	</style>

	<?php
	
		Elementos::CrearImput("Accion","Accion","Accion:","3","value='1'");
		Elementos::CrearImput("URL","URL","URL:","3","value='http://apimacro.sppflash.com.ar/api/get'");
		Elementos::CrearImput("Metodo","Metodo Post o Get","Metodo:","3","value='POST'");
		//Titulo
		Elementos::CrearDesplegableConTitulo("Pieza","1");
		
		Elementos::CrearImput("Respuesta","Respuesta","Respuesta:","12","value=''");
		
		Elementos::CrearImput("ApellidoYNombre","Apellido Y Nombre","Apellido Y Nombre:","3","value='LUZCUBIR MARIA DEL'");
		Elementos::CrearImput("Apellido","Apellido","Apellido:","3","value=''");
		Elementos::CrearImput("Nombre","Nombre","Nombre:","3","value=''");
		Elementos::CrearImput("DNI","DNI","DNI:","3","value='11072890'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("Domicilio","Domicilio","Domicilio:","3","value='B STA BARBARA MINA CONCA 1131  0  0'");
		Elementos::CrearImput("Ciudad","Ciudad","Ciudad:","3","value='PALPALA'");
		Elementos::CrearImput("Provincia","Provincia","Provincia:","3","value='Jujuy'");
		Elementos::CrearImput("SucursalRadicacion","SucursalRadicacion","SucursalRadicacion:","3","value='206'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("sucursale_id","sucursale_id","sucursale_id:","3","value='165'");
		Elementos::CrearImput("DomicilioSucursal","DomicilioSucursal","DomicilioSucursal:","3","value=''");
		Elementos::CrearImput("TipoTarjeta","TipoTarjeta","TipoTarjeta:","3","value='Débito'");
		Elementos::CrearImput("MarcaTarjeta","MarcaTarjeta","MarcaTarjeta:","3","value='VISA'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("NumPiezaBanco","NumPiezaBanco","NumPiezaBanco:","3","value='004517647069566004'");
		Elementos::CrearImput("NumPiezaCorreo","NumPiezaCorreo","NumPiezaCorreo:","3","value='cf004517647069566004'");
		Elementos::CrearImput("DatoBanco","DatoBanco","DatoBanco:","3","value='Domicilio'");
		Elementos::CrearImput("EstadoPieza","EstadoPieza","EstadoPieza:","3","value='Lógico Recibido'");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("EstadoDefinitivo","EstadoDefinitivo","EstadoDefinitivo:","3","value='3'");
		Elementos::CrearImput("MotivoPieza","MotivoPieza","MotivoPieza:","3","value='Domicilio'");
		Elementos::CrearImput("flash_sucursal_id","flash_sucursal_id","flash_sucursal_id:","3","value=''");
		Elementos::CrearImput("flash_servicio_id","flash_servicio_id","flash_servicio_id:","3","value=''");
		echo('<hr class="size1 hideline">');
		Elementos::CrearImput("rescatada_at","rescatada_at","rescatada_at:","6","value=''");
		Elementos::CrearImput("rescatada_user_id","rescatada_user_id","rescatada_user_id:","6","value=''");
		//Elementos::CrearImput("FechaEstadoPieza","FechaEstadoPieza","FechaEstadoPieza:","4","value='2020-06-18 09:00:00'");
		echo('<hr class="size2 hideline">');
		echo('<p>Estado</p>');
		Elementos::CrearImput("EstadoPieza","Estado De Pieza","Estado De Pieza:","3","value='Aceptada En Distribuidora'");
		Elementos::CrearImput("MotivoPieza","Motivo De Pieza","Motivo De Pieza","3","value='Domicilio'");
		Elementos::CrearImput("FechaEstadoPieza","Fecha De Estado De Pieza","Fecha De Estado De Pieza:","3","value='2020-06-24 04:37:20'");
		Elementos::CrearImput("DatoPieza","Dato De Pieza","Dato De Pieza:","3","value='Sucursal'");
		Elementos::CrearImput("HDR","Hoja De Ruta","Hoja De Ruta:","3","value='0'");
		Elementos::CrearBoton("MandarPiezaYEstado();","12","Mandar Pieza Y Estado Inicial","");
		echo('<hr class="size2 hideline">');
		
		//Titulo
		Elementos::CrearDesplegableConTitulo("Estado","1");
		Elementos::CrearImput("EstadoPieza","Estado De Pieza","Estado De Pieza:","4","value='Aceptada En Distribuidora'");
		Elementos::CrearImput("MotivoPieza","Motivo De Pieza","Motivo De Pieza","4","value='Domicilio'");
		Elementos::CrearImput("FechaEstadoPieza","Fecha De Estado De Pieza","Fecha De Estado De Pieza:","4","value='2020-06-24 04:37:20'");
		Elementos::CrearImput("DatoPieza","Dato De Pieza","Dato De Pieza:","6","value='Sucursal'");
		Elementos::CrearImput("HDR","Hoja De Ruta","Hoja De Ruta:","6","value='0'");
		Elementos::CrearBoton("MandarEstado();","12","MandarEstado","");
		echo('<hr class="size1 hideline">');
		
	?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	