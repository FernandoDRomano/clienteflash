<?php namespace Controllers;

	use Models\Log as log;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	define('__ROOT__',dirname(dirname(__FILE__)));
	require (__ROOT__.'/PHPMailer/Exception.php');
	require (__ROOT__.'/PHPMailer/PHPMailer.php');
	require (__ROOT__.'/PHPMailer/SMTP.php');
	define('FicheroInicial',"./");
	
	class logController{
		private $log;
		private $mail;
		public function __construct() {
			$this->log = new Log();
			$this->mail = new PHPMailer(true);
			date_default_timezone_set("America/Argentina/Tucuman");
		}
		
		public function validar(){
			if(!$_POST){
			}else{
				$codseg = $_POST['codigoseguridad'];
				$this->log->set('us_codseg',$codseg);
				$this->log->validarCuenta();
				echo('<script>window.location.replace("' . URL . 'principal/inicio");</script>');exit;
			}
		} 

		public function cambiar_password_cliente(){
			$_SESSION['password_reset_validated'] = false;
			$_SESSION['password_reset_message'] = '';
			$_SESSION['password_reset_cliente_id'] = null;
			$_SESSION['password_reset_selector'] = null;
			$_SESSION['password_reset_validator'] = null;

			$selector = issetornull('selector');
			$validator = issetornull('validator');

			if(empty($selector) || empty($validator)){
				$_SESSION['password_reset_message'] = "No existe selector o validador.";
				return;
			}

			$dataToken = $this->log->BuscarTokenDeRecuperacion($selector);
			
			if(!$dataToken){
				$_SESSION['password_reset_message'] = "Solicitud inválida. Por favor, vuelve a intentar el proceso de recuperación de contraseña.";
				return;
			}

			// Compruebo expiración
			$expires_at = strtotime($dataToken['expires_at']);
			if($expires_at < time()){
				$_SESSION['password_reset_message'] = "El enlace ha expirado. Por favor, inicia el proceso de recuperación nuevamente.";
				return;
			}
			
			// Revisar si ya se uso el token
			if(isset($dataToken['used']) && intval($dataToken['used']) === 1){
				$_SESSION['password_reset_message'] = "El enlace ya ha sido utilizado. Por favor, inicia el proceso de recuperación nuevamente.";
				return;
			}

			// Verificar token: comparar hash de validator contra token_hash guardado
			$tokenHash = $dataToken['token_hash'];
			$validatorHash = hash('sha256', $validator);
			if(!hash_equals($tokenHash, $validatorHash)){
				$_SESSION['password_reset_message'] = "Token inválido. Por favor, inicia el proceso de recuperación nuevamente.";
				exit;
			}

			// OK -> marcar validado en sesión y mostrar vista con formulario
			$_SESSION['password_reset_cliente_id'] = $dataToken['cliente_id'];
			$_SESSION['password_reset_selector'] = $selector;
			$_SESSION['password_reset_validator'] = $validator;
			$_SESSION['password_reset_validated'] = true;
		}

		public function verificar(){
			$FicheroInicial = "./";
			if(!$_POST){
			}else{
				$this->log->set('us_name',$_POST['us_name']);
				$this->log->set('us_password',$_POST['us_password']);
				$datos= $this->log->LoginCliente();
				if($datos!=null){
					if($datos['Password']!= ""){
						if (password_verify($_POST['us_password'], $datos['Password'])) {
							
							$_SESSION['us_name'] = $datos['Alias'];
							$_SESSION['us_password'] = $datos['Password'];
							$_SESSION['idusuario'] = $datos['Id'];
							$_SESSION['us_nombre'] = $datos['Nombre'];
							$_SESSION['us_apellido'] = $datos['NombreDeFantacia'];
							$_SESSION['idperfil'] = $datos['idperfil'];
							$_SESSION['cliente_id'] = $datos['SispoId'];
							$_SESSION['Actividad'] = time();
							
							$this->log->set('idusuario',$datos['Id']);
							
							$resultado = $this->log->MenuDeCiente();
							
							$datos = mysqli_fetch_assoc($resultado);
							
							$UsuarioNombreDeMenu[0] = $datos['NombreDeMenu'];
							$UsuarioURL[0] = $datos['URL'];
							$UsuarioMainMenu[0] = $datos['MainMenu'];
							
							$i=0;
							while ($fila = $resultado->fetch_assoc()) {
								$i++;
								$UsuarioNombreDeMenu[$i] = $fila['NombreDeMenu'];
								$UsuarioURL[$i] = $fila['URL'];
								$UsuarioMainMenu[$i] = $datos['MainMenu'];
								//printf ("%s (%s)\n", $fila["Name"], $fila["CountryCode"]);
							}
							$_SESSION['UsuarioNombreDeMenu'] = $UsuarioNombreDeMenu;
							$_SESSION['UsuarioURL'] = $UsuarioURL;
							$_SESSION['UsuarioMainMenu'] = $UsuarioMainMenu;
							
							//print_r($UsuarioNombreDeMenu);
							
							//print_r($datos);//exit;
							//exit;
							
							if($datos['Estado'] == 0){
								//echo('<script>alert("Estado==0");</script>');exit;
								echo('<script>window.location.replace("' . URL . 'log/validar");</script>');exit;
								
							}else{
								echo('<script>window.location.replace("' . URL . 'principal/inicio");</script>');exit;
							}
						} else {
							//echo 'La contraseña no es válida.';
						}
					}
				}
				
				
				$datos= $this->log->verLog();
				//$resultado= $this->log->verLog();
				//$datos = mysqli_fetch_assoc($resultado);
				if($datos != null and $_POST['us_name'] != null){
					if($_POST['us_name']==$datos['us_name']){
						if($_POST['us_password']==$datos['us_password']){
							$_SESSION['us_name'] = $_POST['us_name'];
							$_SESSION['us_password'] = $_POST['us_password'];
							$_SESSION['idusuario'] = $datos['idusuario'];
							$_SESSION['us_nombre'] = $datos['us_nombre'];
							$_SESSION['us_apellido'] = $datos['us_apellido'];
							$_SESSION['idperfil'] = $datos['idperfil'];
							$_SESSION['GrupoSucursalId'] = $datos['GrupoSucursalId'];
							
							$this->log->set('idusuario',$_SESSION['idusuario']);
							$this->log->set('idusuario',$datos['idusuario']);
							
							$resultado= $this->log->ObtenerSucursalesEnGrupo($_SESSION['idusuario']);
							if($datos['GrupoSucursalId'] == '0'){
								$datos['Sucursales'] = '4';
							}else{
								//print_r($datos);
								$datos = mysqli_fetch_assoc($resultado);
							}
							
							$UsuarioSucursales[0] = $datos['Sucursales'];
							$i=0;
							while ($fila = $resultado->fetch_assoc()) {
								$i++;
								$UsuarioSucursales[$i] = $fila['Sucursales'];
							}
							$_SESSION['UsuarioSucursales'] = $UsuarioSucursales;
							//print_r($_SESSION['UsuarioSucursales']);
							
							
							//print_r($_SESSION['SucursalId']);
							
							//$resultado= $this->log->MenuDeCiente();
							$resultado= $this->log->MenuDeUsuario();
							//print_r($resultado);
							//exit;
							$datos = mysqli_fetch_assoc($resultado);
							
							$UsuarioNombreDeMenu[0] = $datos['NombreDeMenu'];
							$UsuarioURL[0] = $datos['URL'];
							$UsuarioMainMenu[0] = $datos['MainMenu'];
							
							$i=0;
							while ($fila = $resultado->fetch_assoc()) {
								$i++;
								$UsuarioNombreDeMenu[$i] = $fila['NombreDeMenu'];
								$UsuarioURL[$i] = $fila['URL'];
								$UsuarioMainMenu[$i] = $datos['MainMenu'];
								//printf ("%s (%s)\n", $fila["Name"], $fila["CountryCode"]);
							}
							$_SESSION['UsuarioNombreDeMenu'] = $UsuarioNombreDeMenu;
							$_SESSION['UsuarioURL'] = $UsuarioURL;
							$_SESSION['UsuarioMainMenu'] = $UsuarioMainMenu;
							
							//print_r($UsuarioNombreDeMenu);
							//print_r($UsuarioURL);
		
							if($datos['us_estado'] == 0){
								echo('<script>window.location.replace("' . URL . 'log/validar");</script>');exit;
							}else{
								echo('<script>window.location.replace("' . URL . 'principal/inicio");</script>');exit;
							}
						}else{
							echo "<script>const LOGIN_ERROR = {code: 401, message: 'Usuario o contraseña incorrectos.'}</script>";
						}
					}
					else{
						echo "<script>alert('Usuario incorrecto!'); </script>";
					}
				}else{
					echo "<script>const LOGIN_ERROR = {code: 401, message: 'Usuario o contraseña incorrectos.'}</script>";
				}
			}
		}
		public function restablecer(){
			if(!$_POST){
			}else{
				$codigo = date('YmdHis');
				$this->log->set('us_mail', $_POST['us_mail']);
				$this->log->set('us_codseg', $codigo);
				$this->log->bloquear();
				echo 'si entra aqui';
				$us_mail = $_POST['us_mail'];
				try {
					//Server settings
					$this->mail->SMTPDebug = 3;// Enable verbose debug output
					$this->mail->isSMTP();// Send using SMTP
					$this->mail->Host       = 'smtp.gmail.com';// Set the SMTP server to send through
					$this->mail->SMTPAuth   = true;// Enable SMTP authentication
					$this->mail->Username   = 'intranetflash@gmail.com';// SMTP username
					$this->mail->Password   = 'Abcd1234!';// SMTP password
					$this->mail->SMTPSecure = 'tls';// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
					$this->mail->Port       = 587;// TCP port to connect to
					//Recipients
					$this->mail->setFrom('intranetflash@gmail.com', 'Intranet Correo Flash');
					$this->mail->addAddress($us_mail);     // Add a recipient
					// Content
					$this->mail->isHTML(true);// Set email format to HTML
					$this->mail->Subject = 'Activar cuenta';
					$this->mail->Body    = 'Estimado/a: <br>Su usuario fue bloqueado por razones de seguridad, para poder acceder a la intranet deberá restablecer su contraseña. Con el siguiente código de seguridad podrá reactivar su cuenta y establecer una nueva contraseña para su cuenta.<br><br>Código: '. $codigo. '<br><br>Saludos cordiales<br><br><em>Correo Flash</em><br><em>Área de Sistemas</em>';
					$this->mail->send();
					//echo 'Message has been sent';
				} catch (Exception $e) {
					error_reporting(0);
					//echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
				}
			}
		}


		public function cambiar_password(){
			if(!$_POST){
			}else{
				$codigo = $_POST['us_codseg'];
				if($_POST['us_codseg'] && !$_POST['us_password']){
					$this->log->set('us_codseg', $_POST['us_codseg']);
					$this->log->validarCuenta();
					$datos = 1;
					return $datos;
				}
				if($_POST['us_password']){
					$this->log->set('us_password',$_POST['us_password']);
					$this->log->set('us_codseg',$codigo);
					$this->log->cambiarPass();
//////////////////////////
//							Cambiar Host
					echo '<script type="text/javascript">
					window.location.assign("http://localhost:8081/intranet/");
					</script>';

//////////////////////////
				}
			}
		}


		public function logout(){
			if(!$_POST){
				session_start();
				session_destroy();
				echo('<script>window.location.replace("' . URL . '");</script>');exit;
			}
		}
	}
	$log = new logController();
?>