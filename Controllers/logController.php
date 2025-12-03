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
			/*
			$UsuarioGet = $_SESSION['UsuarioGet'];
			$PasswordGet = $_SESSION['PasswordGet'];
			*/
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
		public function verificar(){
			$FicheroInicial = "./";
			if(!$_POST){
			}else{
				$this->log->set('us_name',$_POST['us_name']);
				$this->log->set('us_password',$_POST['us_password']);
				echo("<br>");
				//print_r($_SESSION);
				echo("<br>");
				$datos= $this->log->LoginCliente();
				if($datos!=null){
					if($datos['Password']!= ""){
						if (password_verify($_POST['us_password'], $datos['Password'])) {
							//echo 'Cliente:';
							
							$_SESSION['us_name'] = $datos['Alias'];
							$_SESSION['us_password'] = $datos['Password'];
							$_SESSION['idusuario'] = $datos['Id'];
							$_SESSION['us_nombre'] = $datos['Nombre'];
							$_SESSION['us_apellido'] = $datos['NombreDeFantacia'];
							$_SESSION['idperfil'] = $datos['idperfil'];
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
							echo "<script>alert('Contraseña incorrecta!');</script>";
						}
					}
					else{
						echo "<script>alert('Usuario incorrecto!'); </script>";
					}
				}else{
					echo "<script>alert('Contraseña incorrecta!');</script>";
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