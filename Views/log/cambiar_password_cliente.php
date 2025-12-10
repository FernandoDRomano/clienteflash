<?php
@session_start([
	'cookie_lifetime' => 86400,
	'read_and_close'  => true,
]);
$_SESSION['LogTime']  = time();
$Time = time();

date_default_timezone_set("America/Argentina/Tucuman");
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

// VALIDAR ERROR DE SESSION POR TOKEN DE RESTABLECIMIENTO Y REDIRECCIONAR
if (isset($_SESSION['password_reset_validated']) && $_SESSION['password_reset_validated'] === false) {
    echo "<script>
            alert('{$_SESSION['password_reset_message']}');
            window.location.replace('/');
        </script>";
}

// SI ES VALIDO EL TOKEN, PASAR A LA VISTA LOS DATOS DEL SELECTOR Y VALIDATOR, PARA SER ENVIADOS AL SERVIDOR POR AJAX
echo "<script>
	const DATA = {
		selector: " . json_encode($_SESSION['password_reset_selector'] ?? null) . ",
		validator: " . json_encode($_SESSION['password_reset_validator'] ?? null) . "
	}
</script>";

?>
<html lang="es" class="no-js">

<head>
	<meta charset="utf-8">
	<title>Recuperar Contraseña | Clientes</title>
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

				<!-- Formulario de recuperación -->
				<div id="contenedor-form-login">
					<form action="#" method="post" class="row d-flex flex-column align-items-center mt-md-5 pt-md-5" id="form-login">
						<h3 class="titulo">Cambiar Contraseña</h3>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 mb-4">
							<label for="us_password">Nueva Contraseña</label>
							<div class="position-relative">
								<input type="password" name="us_password" id="us_password" class="form-control form-control-user" placeholder="Ingresar contraseña" style="padding-right: 40px;">
								<img src="/Styles/login/icon-eye.png" alt="Mostrar/Ocultar contraseña" id="togglePassword" class="icon-eye">
							</div>
						</div>

                        <div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 mb-4">
							<label for="us_password_confirm">Repetir Contraseña</label>
							<div class="position-relative">
								<input type="password" name="us_password_confirm" id="us_password_confirm" class="form-control form-control-user" placeholder="Ingresar contraseña" style="padding-right: 40px;">
								<img src="/Styles/login/icon-eye.png" alt="Mostrar/Ocultar contraseña" id="togglePasswordConfirm" class="icon-eye">
							</div>
						</div>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 mb-3">
							<button onclick="actualizarPassword(event)" type="submit" value="Ingresar" class="btn btn-primary btn-user btn-block">Aceptar</button>
							<p id="login-error-mensaje" class="login-error d-none"></p>
						</div>
	
						<div class="form-group col-xs-9 col-sm-6 col-md-8 col-lg-5 text-center">
							<a href="/" >Volver al Login</a>
						</div>
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