<?php
	$Objeto = json_encode($_REQUEST);
	$Post = json_decode($Objeto, false);
	$InicioDeAnio = "InicioDeAnio";
	$Fecha = "Fecha";
	use Config\Elementos as Elementos;
	
?>

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

<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">
<div id="ConsultaSinRetorno" class="number" hidden></div>

<div >
	<div class="col-md-12 CajaDeGrupos" style="background: aliceblue;">
		<?php
			//Titulo
			Elementos::CrearLeftTitulo("Lista De Menues");
			//Tablero
			Elementos::Creardashboard("","MenuesCreados","Menues Creados","12","Uncolor","SizableMenuesCreados");
			echo('<hr class="size1 hideline">');
			//Tablas De Tableros
			Elementos::CrearTabladashboard("MenuesCreados","12","Menues Creados");
			//Botones
			Elementos::CrearBoton("BuscarMenues();","12","Buscar Menues Creados","");
			echo('<hr class="size1 hideline">');
		?>
	</div>
	<hr class="size2 hideline">
	<div class="col-md-12 CajaDeGrupos" style="background: aliceblue;">
		<?php
			//Titulo
			Elementos::CrearLeftTitulo("Asignar Menu A Usuario");
			//Elementos Para Consulta
			Elementos::CrearSelectt("Usuario","Usuario","6");
			Elementos::CrearSelectt("Menues","Menues","6");
			Elementos::CrearBoton("AsignarMenuAUsuario();","12","Asignar Menu A Usuario","");
		?>
	</div>
</div>







