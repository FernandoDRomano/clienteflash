<?php
    session_save_path('tmp');
    //session_start();
	//session_save_path('/var/cpanel/php/sessions/ea-php72');
    //session_start();
        /*
    $_SESSION['color'] = 'Red';
    */
    
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
		//print_r($ruta);
		$ruta="/clienteflash";
		//define('URL', "http://$_SERVER[HTTP_HOST]/clienteflash/log/verificar.php");
	}else{
		
		//define('URL', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ////echo("(". URL .")"); // local(http://localhost:8081/correoflash/) server(http://sispo.com.ar/correoflash/)
	}
	define('URL', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ////echo("(". URL .")"); // local(http://localhost:8081/correoflash/) server(http://sispo.com.ar/correoflash/)
	if(@session_start()){//session_start() Funciona En Servidores Solo Si No Se Imprimio Nada En Pantalla antes.
		setcookie($sess_name, session_id(), NULL, URL);
		
		if($UsuarioGet != '' && $PasswordGet != ''){
			$_SESSION['UsuarioGet'] = $UsuarioGet;
			$_SESSION['PasswordGet'] = $PasswordGet;
			//echo("<p>" . $UsuarioGet . "</p>");
			//echo("<p>" . $PasswordGet . "</p>");
		}else{
			/*
			if(isset($_COOKIE['us_name'])){ unset($_COOKIE['us_name']);}
			if(isset($_COOKIE['us_password'])){ unset($_COOKIE['us_password']);}
			if(isset($_COOKIE['idusuario'])){ unset($_COOKIE['idusuario']);}
			if(isset($_COOKIE['us_nombre'])){ unset($_COOKIE['us_nombre']);}
			if(isset($_COOKIE['us_apellido'])){ unset($_COOKIE['us_apellido']);}
			if(isset($_COOKIE['idperfil'])){ unset($_COOKIE['idperfil']);}
			if(isset($_COOKIE['UsuarioNombreDeMenu'])){ unset($_COOKIE['UsuarioNombreDeMenu']);}
			if(isset($_COOKIE['UsuarioMainMenu'])){ unset($_COOKIE['UsuarioMainMenu']);}
			if(isset($_COOKIE['UsuarioURL'])){ unset($_COOKIE['UsuarioURL']);}
			if(isset($_SESSION["UsuarioGet"])){unset($_SESSION["UsuarioGet"]);}
			if(isset($_SESSION["PasswordGet"])){unset($_SESSION["PasswordGet"]);}
			if(isset($_SESSION['us_name'])){ unset($_SESSION['us_name']);}
			if(isset($_SESSION['us_password'])){ unset($_SESSION['us_password']);}
			if(isset($_SESSION['idusuario'])){ unset($_SESSION['idusuario']);}
			if(isset($_SESSION['us_nombre'])){ unset($_SESSION['us_nombre']);}
			if(isset($_SESSION['us_apellido'])){ unset($_SESSION['us_apellido']);}
			if(isset($_SESSION['idperfil'])){ unset($_SESSION['idperfil']);}
			if(isset($_SESSION['UsuarioNombreDeMenu'])){ unset($_SESSION['UsuarioNombreDeMenu']);}
			if(isset($_SESSION['UsuarioMainMenu'])){ unset($_SESSION['UsuarioMainMenu']);}
			if(isset($_SESSION['UsuarioURL'])){ unset($_SESSION['UsuarioURL']);}
			*/
		}
	}
	$PCname=gethostname();
	//echo($_SERVER['REQUEST_URI']);
	//print_r($_POST);
	//print_r($_GET);
	//print_r($_REQUEST);
?>
<script>
	//var SinSobdominio = true;
	var PCname = <?php echo(json_encode($PCname));?>;
	var SinSobdominio;
	if(PCname == "Ruben" || PCname == "RubenGF" || PCname == "ded1521.inmotionhosting.com"){
		SinSobdominio = false;
	}else{
		//alert(PCname);
		SinSobdominio = true;
	}
	//alert(PCname);
	var SUBDOMINIO = window.location.pathname.substring( 0 , window.location.pathname.indexOf("/",1) + 1 );
	var SqlServerURLJS = "http://sispo.com.ar/" + "clienteflash/";
	
	if(PCname == "Ruben" || PCname == "RubenGF"){
		var Boveda = window.location.origin + "/boveda";
	}else{
		//alert(PCname);
		var Boveda = "https://apis.sppflash.com.ar";
	}
	if(!SinSobdominio){
		var URLJS = window.location.origin + SUBDOMINIO;
		
		//var Boveda = "http://apis.sppflash.com.ar";
	}else{
		var URLJS = window.location.origin + "/";
		//alert(window.location.origin);
		//alert(window.location.origin.indexOf('.',0));
		//alert(window.location.origin.substring(window.location.origin.indexOf('.',0),0));
		
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
	
	//print_r($_COOKIE["UsuarioURL"]);
	//print_r($_SESSION);
		
	Config\Autoload::run();
	$Request = new Config\Request();
	
	
	
	if(isset($_SESSION['us_name'])){ 
		$NombreDeUsuario = $_SESSION['us_name'];
	}
	if(isset($_SESSION['idperfil'])){
		$Perfil = $_SESSION['idperfil'];
	}
	
	//if($ruta != "/" . SUBDOMINIO . "/" && $ruta != "/" . SUBDOMINIO . "/" . "log/verificar" && isset($_SESSION['us_name']) && isset($_SESSION['us_password'])){
		if($Request->getMenu() != ''){
			require_once $Request->getMenu();//"Views/menu.php";
		}

	//}
	/*
	//echo("Usuario:" . $UsuarioGet . " Menu:" . $Request->getMenu() !="");
	if($UsuarioGet == '' && $PasswordGet == '' && !isset($_GET['url'])){
		if(isset($_COOKIE['us_name'])){ unset($_COOKIE['us_name']);}
		if(isset($_COOKIE['us_password'])){ unset($_COOKIE['us_password']);}
		if(isset($_COOKIE['idusuario'])){ unset($_COOKIE['idusuario']);}
		if(isset($_COOKIE['us_nombre'])){ unset($_COOKIE['us_nombre']);}
		if(isset($_COOKIE['us_apellido'])){ unset($_COOKIE['us_apellido']);}
		if(isset($_COOKIE['idperfil'])){ unset($_COOKIE['idperfil']);}
		if(isset($_COOKIE['UsuarioNombreDeMenu'])){ unset($_COOKIE['UsuarioNombreDeMenu']);}
		if(isset($_COOKIE['UsuarioMainMenu'])){ unset($_COOKIE['UsuarioMainMenu']);}
		if(isset($_COOKIE['UsuarioURL'])){ unset($_COOKIE['UsuarioURL']);}
		if(isset($_SESSION["UsuarioGet"])){unset($_SESSION["UsuarioGet"]);}
		if(isset($_SESSION["PasswordGet"])){unset($_SESSION["PasswordGet"]);}
		if(isset($_SESSION['us_name'])){ unset($_SESSION['us_name']);}
		if(isset($_SESSION['us_password'])){ unset($_SESSION['us_password']);}
		if(isset($_SESSION['idusuario'])){ unset($_SESSION['idusuario']);}
		if(isset($_SESSION['us_nombre'])){ unset($_SESSION['us_nombre']);}
		if(isset($_SESSION['us_apellido'])){ unset($_SESSION['us_apellido']);}
		if(isset($_SESSION['idperfil'])){ unset($_SESSION['idperfil']);}
		if(isset($_SESSION['UsuarioNombreDeMenu'])){ unset($_SESSION['UsuarioNombreDeMenu']);}
		if(isset($_SESSION['UsuarioMainMenu'])){ unset($_SESSION['UsuarioMainMenu']);}
		if(isset($_SESSION['UsuarioURL'])){ unset($_SESSION['UsuarioURL']);}
	}
	*/
	$URLJS =  Ajax . $Request->getJsDeMenu() . '.js';
	//echo("<P>" . $URLJS . "</P>");
	Config\Enrutador::run($Request);
	/*
	print_r($UsuarioGet);
	print_r($PasswordGet);
	exit;
	*/
	$pos = strpos($ruta, "XMLHttpRequest");
	if(is_readable($URLJS)){
		$Js = file_get_contents( $URLJS );
		echo("<script>$Js</script>");
	}else{
		print_r("Fichero No Encontrado:" . $URLJS);
	}
	
	/*
    print_r('_SESSION =');
    print_r($_SESSION);
    print_r('_COOKIE=');
    print_r($_COOKIE);
    */
	//include 'h_footer.php';
?>


