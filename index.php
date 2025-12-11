<?php
	// Bootstrap central para Composer + .env (ver Config/bootstrap.php)
	require_once __DIR__ . '/Config/bootstrap.php';

	session_save_path($_ENV['SESSION_SAVE_PATH'] ?? 'tmp');
    
	$currentCookieParams = session_get_cookie_params();
	$rootDomain = "http://$_SERVER[HTTP_HOST]";
	define('CARPETABASEURL', "https://$_SERVER[HTTP_HOST]");
	session_set_cookie_params(
		$currentCookieParams["lifetime"],
		$currentCookieParams["path"],
		$rootDomain,
		$currentCookieParams["secure"],
		$currentCookieParams["httponly"]
	);

	//print_r($currentCookieParams);
	$sess_name = session_name();
	$UsuarioGet;
	$PasswordGet;
	$UsuarioGet = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_URL);
	$PasswordGet = filter_input(INPUT_GET, 'f', FILTER_SANITIZE_URL);
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	
	
	$UsuarioGet = issetornull("c");
	$PasswordGet = issetornull("f");
		
	if($UsuarioGet != '' && $PasswordGet != ''){
		$ruta="/clienteflash";
	}

	define('URL', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ////echo("(". URL .")"); // local(http://localhost:8081/correoflash/) server(http://sispo.com.ar/correoflash/)
	if(@session_start()){//session_start() Funciona En Servidores Solo Si No Se Imprimio Nada En Pantalla antes.
		setcookie($sess_name, session_id(), NULL, URL);
		
		if($UsuarioGet != '' && $PasswordGet != ''){
			$_SESSION['UsuarioGet'] = $UsuarioGet;
			$_SESSION['PasswordGet'] = $PasswordGet;
		}
	}
	$PCname=gethostname();
?>
<script>
	//var SinSobdominio = true;
	var PCname = <?php echo(json_encode($PCname));?>;
	var SinSobdominio;

	if(PCname == "Ruben" || PCname == "RubenGF" || PCname == "ded1521.inmotionhosting.com"){
		SinSobdominio = false;
	}else{
		SinSobdominio = true;
	}

	var SUBDOMINIO = window.location.pathname.substring( 0 , window.location.pathname.indexOf("/",1) + 1 );
	var SqlServerURLJS = "http://sispo.com.ar/" + "clienteflash/";
	
	if(PCname == "Ruben" || PCname == "RubenGF"){
		var Boveda = window.location.origin + "/boveda";
	}else{
		var Boveda = "https://apis.sppflash.com.ar";
	}

	if(!SinSobdominio){
		var URLJS = window.location.origin + SUBDOMINIO;
	}else{
		var URLJS = window.location.origin + "/";
	}
	
	function IncludeJs(jsFilePath, id){
		if(jsFilePath!='' && id != ''){
			var Element =document.getElementById(id);
			if(Element != null){
				Element.remove();
			}
			var js = document.createElement("script");
			js.id = id;
			js.type = "text/javascript";
			js.src = jsFilePath;
			var ElementoControladorHTML = document.getElementById("controlador");
			ElementoControladorHTML.appendChild(js);
		}else{
			Alert("El Fichero No Puede Ser Nulo");
		}
	}
</script>


<?php
	global $ModoDebug;
	$ModoDebug = true;
	define('DS', DIRECTORY_SEPARATOR);							//echo(DS);//Local (\)										//sispo (/)												// sppflash(/)
	define('ROOT', realpath(dirname(__FILE__)) . DS);			//echo(ROOT);//Local (C:\xampp\htdocs\correoflash\)			//sispo (/home/sispoc5/public_html/correoflash/)		// sppflash(/home/sppfla5/clienteflash.sppflash.com.ar/)
	$PCname=gethostname();
	if($PCname=="Ruben" or $PCname=="RubenGF" or $PCname == "ded1521.inmotionhosting.com"){
		define('SUBDOMINIO', "clienteflash");					//echo(SUBDOMINIO);//Local (correoflash)					//sispo (correoflash)									// sppflash(correoflash)
	}else{
		define('SUBDOMINIO', "");								//echo(SUBDOMINIO);//Local (correoflash)					//sispo (correoflash)									// sppflash(correoflash)
	}
	define('Ajax', "Js/");										//echo(Ajax);//Local (Js/)									//sispo (Js/)											// sppflash(Js/)
	$ruta = $_SERVER['REQUEST_URI'];							//echo($ruta);//Local (/correoflash/)						//sispo (/correoflash/)									// sppflash(/)
	
	if($UsuarioGet != '' && $PasswordGet != ''){
		//print_r($ruta);
		$ruta="/clienteflash";
		
	}else{echo($UsuarioGet);}
	
	require_once "Config/Autoload.php";
	
	global $NombreDeUsuario;
	global $Perfil;
	
	
	if(isset($_SESSION['us_name'])){
		$NombreDeUsuario = $_SESSION['us_name'];
	}
	if(isset($_SESSION['idperfil'])){
		$Perfil = $_SESSION['idperfil'];
	}
	if($UsuarioGet != '' && $PasswordGet != ''){
		if(isset($_COOKIE['us_name'])){$_SESSION['us_name'] = $_COOKIE["us_name"];}
		if(isset($_COOKIE['us_password'])){$_SESSION['us_password'] = $_COOKIE["us_password"];}
		if(isset($_COOKIE['idusuario'])){$_SESSION['idusuario'] = $_COOKIE["idusuario"];}
		if(isset($_COOKIE['us_nombre'])){$_SESSION['us_nombre'] = $_COOKIE["us_nombre"];}
		if(isset($_COOKIE['us_apellido'])){$_SESSION['us_apellido'] = $_COOKIE["us_apellido"];}
		if(isset($_COOKIE['idperfil'])){$_SESSION['idperfil'] = $_COOKIE["idperfil"];}
		if(isset($_COOKIE['UsuarioNombreDeMenu'])){$_SESSION['UsuarioNombreDeMenu'] = $_COOKIE["UsuarioNombreDeMenu"];}
		if(isset($_COOKIE['UsuarioMainMenu'])){$_SESSION['UsuarioMainMenu'] = explode("&",$_COOKIE["UsuarioMainMenu"]);}
		if(isset($_COOKIE['UsuarioURL'])){$_SESSION['UsuarioURL'] = explode("&",$_COOKIE["UsuarioURL"]);}
	}
	
	if(isset($_SESSION['UsuarioNombreDeMenu'])){
		$UsuarioNombreDeMenu = $_SESSION['UsuarioNombreDeMenu'];
	}if(isset($_SESSION['UsuarioURL'])){
		$UsuarioURL = $_SESSION['UsuarioURL'];
	}if(isset($_SESSION['UsuarioMainMenu'])){
		$UsuarioNombreDeMenu = $_SESSION['UsuarioMainMenu'];
	}
		
	Config\Autoload::run();
	$Request = new Config\Request();
	
	if(isset($_SESSION['us_name'])){ 
		$NombreDeUsuario = $_SESSION['us_name'];
	}
	if(isset($_SESSION['idperfil'])){
		$Perfil = $_SESSION['idperfil'];
	}
	
	if($Request->getMenu() != ''){
		require_once $Request->getMenu();//"Views/menu.php";
	}

	$URLJS =  Ajax . $Request->getJsDeMenu() . '.js';
	Config\Enrutador::run($Request);

	$pos = strpos($ruta, "XMLHttpRequest");
	if(is_readable($URLJS)){
		$Js = file_get_contents( $URLJS );
		echo("<script>$Js</script>");
	}else{
		print_r("Fichero No Encontrado:" . $URLJS);
	}
?>


