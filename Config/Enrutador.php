<?php namespace Config;
	class Enrutador{
		public static function run(Request $request){
			
			$controlador = $request->getControlador() . "Controller";
			$ruta = "Controllers" . DS . $controlador . ".php";
			$metodo = $request->getMetodo();
			$argumento = $request->getArgumento();
			$JsDeMenu = $request->getJsDeMenu();
			if($metodo == "verificar"){
				$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if(URL != $actual_link){
					echo("$JsDeMenu");
					header("Location: " . URL);
				}
			}
			if(is_readable($ruta)){
					require_once $ruta;
				$mostrar = "Controllers\\" . $controlador;
				$controlador = new $mostrar;
				if(!isset($argumento)){
					$datos = call_user_func(array($controlador, $metodo));
				}else{
					error_reporting(0);
					$datos = call_user_func_array(array($controlador, $metodo), $argumento);
				}
				$ruta = "Views" . DS . $request->getControlador() . DS . $request->getMetodo() . ".php";
				if(is_readable($ruta)){
					echo('<div id="controlador">');
						require_once $ruta;
					echo('</div>');
					echo('
						<script>
							$(document).ready(function(){
								if($("#ForInner").length){
									$("#controlador").appendTo("#ForInner");
								}
							});
						</script>
					');
				}else{
					if($_SERVER['REQUEST_URI'] != "/" . SUBDOMINIO . "/" .'log/restablecer' || $_SERVER['REQUEST_URI'] != "/" . SUBDOMINIO . "/" .'log/cambiar_password'){
					}else{
						require_once "Views/error/error404.php";
					}
				}
			}else{
				
				$Fichero = str_replace('\\', '\\\\', $ruta);
				echo('<script>alert("El Controlador ' . $Fichero . ' No Existe, Verifique La Consola Para Mas Detalle");</script>');
				$ArraydControlador = explode(DS,$Fichero);
				$NombreDelControlador = $ArraydControlador[count($ArraydControlador)-1];
				$NombreDelControlador = str_replace('.php', '', $NombreDelControlador);
				
				echo('
				<script>console.log(`
<?php namespace Controllers;
	//use Models\Nombredemodelo as Nombredemodelo;
	class ' . $NombreDelControlador . '{
		//private $Nombredemodelo;
		public function __construct(){
			//$this->Nombredemodelo = new Nombredemodelo();
		}
	}
	$principal = new ' . $NombreDelControlador . '();
?>
				`);</script>');
				
				exit;
			}
		}
	}
?>




