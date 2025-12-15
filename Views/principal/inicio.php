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
</style>

<link rel="stylesheet" href="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/Styles/Tablero.css">
<div id="ConsultaSinRetorno" class="number" hidden></div>

<div class="d-flex flex-column justify-content-center align-items-center px-3" style="height: 90vh;">
	<img src="<?php if(SUBDOMINIO != ""){echo ("/" . SUBDOMINIO. "/");}else{echo ("/");} ?>Styles/inicio/bienvenido.webp" alt="Icono de Bienvenida" class="img-fluid mx-auto d-block img-inicio">
	<h1 class="titulo-principal">Le damos la bienvenida a su perfil</h1>
	<h3 class="subtitulo">Ya puede empezar a trabajar</h3>
</div>