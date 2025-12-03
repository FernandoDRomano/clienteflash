<?php
	@session_start([
		'cookie_lifetime' => 86400,
		'read_and_close'  => true,
	]);
	$_SESSION['LogTime']  = time();
	$Time = time();
	
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$Fecha = date("Y-m-d H:i:s", time()); 
	//echo $HoraDescontandoVencimiento = date('Y-m-d H:i:s', strtotime($Fecha . ' - 5 minutes'));
	//echo($actual_link = "http://$_SERVER[HTTP_HOST]");
	$NoMemory = strtotime(date("Ymdhis"));
	
	if(isset($_SESSION['UsuarioGet'])){
		$UsuarioGet = $_SESSION['UsuarioGet'];
		//print_r("<p>Usuario:" . $UsuarioGet) . "</p>";
		//unset($_SESSION['UsuarioGet']);
	}else{
		$UsuarioGet = '';
	}
	
	if(isset($_SESSION['PasswordGet'])){
		$PasswordGet = $_SESSION['PasswordGet'];
		//print_r("<p>Password:" . $PasswordGet . "</p>");
		//unset($_SESSION['PasswordGet']);
	}else{
		$PasswordGet = '';
	}
	
?>
<script>
function setCookie(name,value,days) {
	var expires = "";
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days*24*60*60*1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	//alert(name + "=" + (value || ""));
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}
</script>
<html lang="es" class="no-js">
	<head>
		<meta charset="utf-8">
		<title>Clientes</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<script src="Js/jquery.min.js"></script>
		<script src="Js/JsRu.js"></script>
		<link href="Styles/Styles/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="Styles/assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css">
		<link href="Styles/StylesLoguin/login-3.css" rel="stylesheet" type="text/css">
		<script src="Js/jquery-3.3.1.min.js"></script>
	</head>
		
	<script>
		var NoMemory = <?php echo json_encode($NoMemory); ?>;
		var UsuarioGet = <?php echo json_encode($UsuarioGet); ?>;
		var PasswordGet = <?php echo json_encode($PasswordGet); ?>;
		jQuery(document).ready(function() {
			if(UsuarioGet != "" && PasswordGet != ""){
				AjaxMasterLogueoGet(UsuarioGet,PasswordGet,0);
			}
		});
	</script>
	
	<div id="loading" name="loading" style="display:none"></div>
	<style>
	.noselect {
		-webkit-touch-callout: none; /* iOS Safari */
		-webkit-user-select: none; /* Safari */
		-khtml-user-select: none; /* Konqueror HTML */
		-moz-user-select: none; /* Firefox */
		-ms-user-select: none; /* Internet Explorer/Edge */
		user-select: none; /* Non-prefixed version, currently
		supported by Chrome and Opera */
	}
	#loading {
		display: block;
		position: absolute;
		top: 0;
		left: 0;
		z-index: 100;
		width: 100vw;
		height: 100vh;
		background-color: rgba(192, 192, 192, 0.5);
		background-image: url("https://i.stack.imgur.com/MnyxU.gif");
		background-repeat: no-repeat;
		background-position: center;
	}
	</style>
<html lang="es" style="height: calc(100% - 200px);min-height: 400px;" >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="9QUKH3qdOVFnXV1F1Ax1Mn9u5ozsMJc2yS0Wrdo7">
		<title>CorreoFlash</title>
	</head>
	
	<body class="login" style="background-image: url(<?php echo(URL); ?>Styles/IMAGENES/call-center-01.jpg);background-repeat: no-repeat;background-size: unset;">
		<nav class="navbar navbar-default">
			<div class="container" style="display: table;width: max-content;left: 0;right: 0;">
				<div class="navbar-header h3" style="display: table;width: max-content;left: 0;right: 0;">
					<img src="<?php echo(URL); ?>/Styles/IMAGENES/logo.png" height="80px" onclick="location.href=&#39;<?php echo(URL); ?>&#39;"; style="cursor: pointer;"><!-- http://correoflash.com -->
					<!-- <b class="noselect">Plataforma Correo Flash&nbsp;</b> -->
				</div>
			</div>
		</nav>
		<div style="height: 100%;display: flex;align-items: center;">
			<div class="content page-lock">
				<div class="form-title">
					<div class="text-center"><b class="noselect">Bienvenido</b>
					</div>
				</div>
				<hr>
				<form method="post" enctype="multipart/form-data" method="post" id="form1" class="user login-form" role="form" novalidate="novalidate">
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>
						<span>
							Ingrese nombre de usuario y contraseña.
						</span>
						<div id="content_LoginUser_LoginUserValidationSummary" class="failureNotification" style="display:none;">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Usuario:
						
						</label>
						<label class="control-label"><b class="noselect">Usuario:</b>
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextUserName"></b>
						</label>
						<div class="input-icon">
							<i class="fa fa-user"></i>
							<input type="text" class="form-control form-control-user" id="us_name" name="us_name" placeholder="Nombre de usuario" autocomplete="off">
							<!--
							<input name="UserName" type="text" id="UserName" class="textEntry valid" placeholder="Usuario" aria-invalid="false" style="width: -webkit-fill-available;">
							-->
							</div>		
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Contraseña:</label>
						<label class="control-label"><b class="noselect">Contraseña:</b>
							<span class="required" aria-required="true">*</span>
							<b id="BoltTextPassword"></b>
						</label>
						<div class="input-icon">
							<i class="fa fa-lock"></i>
							<input type="password" class="form-control form-control-user" id="us_password" name="us_password" placeholder="Contraseña">
							<!--
							<input name="Password" type="password" id="Password" class="passwordEntry valid" placeholder="Contraseña" aria-invalid="false" style="width: -webkit-fill-available;">
							-->
						</div>
					</div>
					<div class="form-actions">
						<span name="remember"><input id="content_LoginUser_RememberMe" type="checkbox" name="RememberMe"></span>
						<label class="inline noselect">Recordarme</label>
						<input type="submit" value="Ingresar" class="btn btn-primary btn-user btn-block"/>
						<!--
						<a name="Login" id="Login" title="Ingresar" style="display:inline;" class="btn btn btn-primary"green-haze pull-right onclick="javascript:Login(< ?php echo json_encode($Time);? >)">Ingresar
						<i class="m-icon-swapright m-icon-white"></i>
						</a>				
						-->
					</div>
					<div class="forget-password">
						<h4 class="inline noselect" >Olvido su contraseña?</h4>
						<br>
						<p class="inline noselect">click <a href="javascript:FormForget();" id="forget-password">Aquí </a>para restablecerla.</p>
					</div>
					<h3><p id="Paragrap"></p></h3>
				</form>
				<form id="forget" class="forget-form" novalidate="novalidate" >
					<h3 class="inline noselect">Olvido su contraseña?</h3>
					<br>
					<p class="inline noselect">Ingrese su e-mail para restablecer su contraseña.</p>
					<div class="form-group">
						<div class="input-icon">
							<i class="fa fa-envelope"></i>
							<input id="email" name="email" class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" style="width: -webkit-fill-available;">
						</div>
					</div>
					<div >
						<button type="button" id="back-btn" class="btn" onclick="FormLogin()">
							<i class="m-icon-swapleft"></i>
							Cancelar
						</button>
						<a onclick="javascript:RecuperarCuenta(<?php echo json_encode($Time);?>)" class="btn green-haze pull-right">
							Aceptar
							<i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
					<h3><p id="Paragrapforget"></p></h3>
				</form>
			</div>
		</div>
	</body>
</html>
<!--
<script src="Js/jsLogin.js"></script>
-->
