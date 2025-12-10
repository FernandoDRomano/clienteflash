<?php
@session_start([
	'cookie_lifetime' => 86400,
	'read_and_close'  => true,
]);
$_SESSION['LogTime']  = time();
$Time = time();

date_default_timezone_set("America/Argentina/Buenos_Aires");
$Fecha = date("Y-m-d H:i:s", time());
$NoMemory = strtotime(date("Ymdhis"));

if (isset($_SESSION['UsuarioGet'])) {
	$UsuarioGet = $_SESSION['UsuarioGet'];
} else {
	$UsuarioGet = '';
}

if (isset($_SESSION['PasswordGet'])) {
	$PasswordGet = $_SESSION['PasswordGet'];
} else {
	$PasswordGet = '';
}

?>
<script>
	function setCookie(name, value, days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	}

	function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		document.cookie = name + '=; Max-Age=-99999999;';
	}
</script>
<html lang="es" class="no-js">

<head>
	<meta charset="utf-8">
	<title>Login | Clientes</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="9QUKH3qdOVFnXV1F1Ax1Mn9u5ozsMJc2yS0Wrdo7">
	<script src="Js/jquery.min.js"></script>
	<script src="Js/JsRu.js"></script>
	<link href="Styles/Styles/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="Styles/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css">
	<link href="Styles/StylesLoguin/login-3.css" rel="stylesheet" type="text/css">
	<link href="Styles/Styles/loading.css" rel="stylesheet" type="text/css">
	<script src="Js/jquery-3.3.1.min.js"></script>
	<script src="Js/loading.js"></script>
</head>

<script>
	var NoMemory = <?= json_encode($NoMemory); ?>;
	var UsuarioGet = <?= json_encode($UsuarioGet); ?>;
	var PasswordGet = <?= json_encode($PasswordGet); ?>;
	jQuery(document).ready(function() {
		if (UsuarioGet != "" && PasswordGet != "") {
			AjaxMasterLogueoGet(UsuarioGet, PasswordGet, 0);
		}
	});
</script>

<div id="loading" name="loading" style="display:none"></div>

<body class="login" style="min-height: 100vh;">
	<div class="container-fluid">
		<div class="row">
			<!-- Formularios -->
			<div class="col-xs-12 col-md-6 d-flex flex-column justify-content-center" style="height: 100vh;">
				<!-- Logo de Flash -->
				<div class="contenedor-logo">
					<img src="/Styles/login/logo_flash.webp" alt="Logo de Flash Logistica" class="logo-flash">
				</div>

				<!-- Formulario de login -->
				<div id="contenedor-form-login">
					<form action="#" method="post" class="row d-flex flex-column align-items-center mt-md-5 pt-md-5" id="form-login">
						<h3 class="titulo">Bienvenido</h3>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5">
							<label for="us_name">Usuario</label>
							<input type="text" name="us_name" id="us_name" class="form-control form-control-user" placeholder="Ingresar usuario" autocomplete="off">
						</div>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 mb-4">
							<label for="us_password">Contraseña</label>
							<div class="position-relative">
								<input type="password" name="us_password" id="us_password" class="form-control form-control-user" placeholder="Ingresar contraseña" style="padding-right: 40px;">
								<img src="/Styles/login/icon-eye.png" alt="Mostrar/Ocultar contraseña" id="togglePassword" class="icon-eye">
							</div>
						</div>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 mb-5">
							<div class="d-flex align-items-center mb-2">
								<span name="remember">
									<input id="content_LoginUser_RememberMe" type="checkbox" name="RememberMe">
								</span>
								<label for="content_LoginUser_RememberMe" class="p-0 m-0" style="font-weight: normal; font-size: 1rem;">Recordarme</label>
							</div>
							<button type="submit" value="Ingresar" class="btn btn-primary btn-user btn-block" onclick="login(event)">Ingresar</button>
							<p id="login-error-mensaje" class="login-error d-none"></p>
						</div>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 text-center">
							<p class="m-0" style="font-weight: 800;">¿Olvid&oacute; su contrase&nacute;a?</p>
							<a href="#" onclick="mostrarFormForget(event);" id="forget-password">Toque aqu&iacute; para restablecerla</a>
						</div>
					</form>
				</div>
				<!-- Fin del formulario de login -->

				<!-- Formulario de recuperación -->
				<div id="contenedor-form-forget" class="d-none">
					<form id="form-forget" class="row d-flex flex-column align-items-center mt-md-5 pt-md-5" novalidate="novalidate">
						<h3 class="titulo">Olvido su contraseña?</h3>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5">
							<label for="email">Ingrese su e-mail para restablecer su contraseña.</label>
							<input id="email" name="email" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" style="width: -webkit-fill-available;">
						</div>
						
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5">
							<button type="button" id="back-btn" class="btn" onclick="mostrarFormLogin(event)">Cancelar</button>
							<button onclick="RecuperarCuenta(event, <?= json_encode($Time); ?>)" class="btn btn-primary pull-right">Aceptar</button>
						</div>
						<p id="Paragrapforget" class="login-error col-xs-9 col-sm-6 col-md-8 col-lg-5"></p>
					</form>
				</div>
				<!-- Fin del formulario de recuperación -->
			</div>

			<!-- Image background -->
			<div class="d-none d-md-block col-md-6 bg-login"></div>
		</div>
	</div>
</body>

</html>