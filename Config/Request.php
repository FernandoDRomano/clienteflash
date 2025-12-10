<?php namespace Config;
	function CarpetasDeURLAArrayd($URL){
		$Respuesta = "";
		$ruta = explode("/", $URL);
		$ruta = array_filter($ruta);
		$Respuesta = $ruta;
		return $Respuesta;
	}
	class Request{
		private $controlador;
		private $metodo;
		private $argumento;
		private $JsDeMenu;
		private $Menu;
		
		public function __construct(){
			$this->Menu = "";
			
			
			if(isset($_GET['url'])){
				$ruta = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

				$ruta = CarpetasDeURLAArrayd($ruta);
				$buscar = ["verificar","menu"];
				$Encontrados =  array_intersect($ruta, $buscar);
				$PrimeraRuta = array_shift($ruta);

				/* 
					Si la primera ruta es reset.php, entonces setear controlador y metodo para cambiar_password_cliente,
					ya que reset.php no está en la base de datos de menús y es el único caso especial para cambiar la contraseña del cliente.
				*/
				if($PrimeraRuta == 'reset.php'){
					$this->controlador = "log";
					$this->metodo = "cambiar_password_cliente";
					$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
					return;
				}
				
				if( !isset($_SESSION['UsuarioMainMenu']) and isset($_COOKIE['UsuarioMainMenu']) ){
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

				if( isset($_COOKIE["UsuarioURL"]) ){
				    if(isset($_COOKIE['UsuarioMainMenu'])){$_SESSION['UsuarioMainMenu'] = explode("&",$_COOKIE["UsuarioMainMenu"]);}
				    if(isset($_COOKIE['UsuarioURL'])){$_SESSION['UsuarioURL'] = explode("&",$_COOKIE["UsuarioURL"]);}
				}
				
				if(isset($_SESSION['UsuarioMainMenu'])){
					$MenuesPorFichero = $_SESSION['UsuarioMainMenu'];
				}else{	
					echo('<script>window.location.replace(URLJS);</script>');exit;exit;
				}
				if(isset($_SESSION['UsuarioURL'])){
					$FicherosDeMenues = $_SESSION['UsuarioURL'];
				}else{
					echo('<script>window.location.replace(URLJS);</script>');exit;exit;
				}
				
				if(array_search($PrimeraRuta, $FicherosDeMenues) !== false || $_SESSION['idusuario'] == 1){
					$this->Menu = $MenuesPorFichero[array_search($PrimeraRuta, $FicherosDeMenues)];
				}else{
				    /*elimino modulo firework*/
					global $ModoDebug;
					if($ModoDebug){
						echo($PrimeraRuta . " No Esta Incluido En Los Archivos Aceptados En Request.php: " . " Variable -> FicherosDeMenues " . print_r($FicherosDeMenues,true) ." Ni En Base De Datos.");
						echo('<script>alert("' . $PrimeraRuta. ' No Esta Incluido En Los Archivos Aceptados En Request.php: Variable -> FicherosDeMenues Ni En Base De Datos.");</script>');
						exit;
					}else{
						echo('<script>window.location.replace(URLJS);</script>');exit;
					}
					//echo($PrimeraRuta . " No Esta Incluido En Los Archivos Aceptados En Request.php: " . " Variable -> FicherosDeMenues");
					
				}
				
				if($Encontrados){
				}else{
					if((isset($_SESSION['us_name']) && isset($_SESSION['us_password']))){// || strtolower($PrimeraRuta) == "principal"  
						$this->controlador = strtolower($PrimeraRuta);
					}else{
						$root = $_SERVER['REQUEST_URI'];
						if($root == '/correoflash/log/restablecer' || $root == '/correoflash/log/cambiar_password'){
							$this->controlador = "log";
						}else{
							$this->controlador = "log";
							$this->metodo = "verificar";
							$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
						}
					}
				}
				$this->metodo = strtolower(array_shift($ruta));
				$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
				if(!$this->metodo){
					if(file_exists("Views/error/error404.php")){
					}else{
						$this->controlador = "log";
						$this->metodo = "verificar";
						$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
					}
					$this->controlador = "log";
				}
				$root = $_SERVER['REQUEST_URI'];
				if($root == '/correoflash/log/restablecer'){
					$this->metodo = "restablecer";
					$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
				}else{
					if($root == '/correoflash/log/cambiar_password'){
						$this->metodo = "cambiar_password";
						$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
					}
				}
				$this->argumento = $ruta;
			}else{
				$this->controlador = "log";
				$this->metodo = "verificar";
				$this->JsDeMenu = ucfirst(strtolower($this->controlador)) . "/" . "Ajax" . ucfirst(strtolower($this->metodo));
			}
		}
		public function getControlador(){
			return $this->controlador;
		}
		public function getMetodo(){
			return $this->metodo;
		}
		public function getArgumento(){
			return $this->argumento;
		}
		public function getJsDeMenu(){
			return $this->JsDeMenu;
		}
		public function getMenu(){
			return $this->Menu;
		}
		
		
	}
?>




