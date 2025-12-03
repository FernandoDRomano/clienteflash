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
	
	<img src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/IMAGENES/portada.jpg" width="100%" height="auto" alt="">
	<!--
	<div class="col-md-12 CajaDeGrupos" style="background: aliceblue;">
		< ?php
			//Titulo
			Elementos::CrearTitulo("Sistema CorreoFlash");
		?>
		<p class="text-left">Bienvenido.</p>
		<ol>
			<li><p class="text-left">Busque En Columna De Menu La Tarea A realizar, Luego Puede Ocultar La Vista De Menues, Presione En El Icono <b style="background-color:#000000;"><i class="fas fa-exchange-alt text-light"></i></b> Para Realizar Esta Accion.</p></li>
			<li><p class="text-left">Para Ver Nuevamente El Panel De Menus, Presione En El Icono <b style="background-color:#000000;"><i class="fas fa-exchange-alt text-light"></i></b>.</p></li>
			<li><p class="text-left">Una Vez Realizada La Tarea Cierre Sesion, Presione En El Icono <b style="background-color:#000000;"><i class="fas fa-sign-out-alt text-light"></i></b> Para Realizar Esta Accion.</p></li>
			<li><p class="text-left">Recuerde Que Su Usuario Y Contraseè´–a Son Personales Y No Debe Ser Transferidos Bajo Ningun Caso.</p></li>
			<li><p class="text-left">En Caso De Requerir Un Usuario Para Otra Persona, Debe Ser Requerido A Su Superior.</p></li>
			<li><p class="text-left">En Caso De Requerir Otro Menu En Su Cuenta Pregunte A Su Superior, Su Superior Podra Agregar Nuevos Menues A Su Cuenta Si Asi Lo Requiere.</p></li>
		</ol>
	</div>
	-->
</div>







