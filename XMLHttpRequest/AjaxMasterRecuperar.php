<?php
	ini_set('display_errors', 0); // Desactivar para evitar que se imprima antes de headers
	ini_set('display_startup_errors', 0);
	error_reporting(E_ERROR | E_WARNING); // Solo errores críticos, no notices
	
	date_default_timezone_set("America/Argentina/Tucuman");

	require_once("FuncionesGenerales.php");

	// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
	require_once __DIR__ . '/../Config/bootstrap.php';
	
	$Email = md5(issetornull('Email'));
	$OriginalEmail=issetornull('Email');
	$time=0;

	// Registrar autoload para cargar clases en namespace (Models, Config, etc.)
	require_once(__DIR__ . '/../Config/Autoload.php');
	// Cambiar directorio de trabajo a la raíz del proyecto para que el autoload
	// busque archivos relativos a la raíz (Models/Log.php, etc.).
	chdir(__DIR__ . '/..');
	Config\Autoload::run();
	
	// Incluir PHPMailer (rutas absolutas relativas al archivo)
	require_once(__DIR__ . '/../PHPMailer/Exception.php');
	require_once(__DIR__ . '/../PHPMailer/PHPMailer.php');
	require_once(__DIR__ . '/../PHPMailer/SMTP.php');
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use Models\Log; 

	$logModel = new Log();

	$Resultado = $logModel->GetClientePorEmail($OriginalEmail);

	if($Resultado){
		// Generar selector y token
		try{
			$selector = bin2hex(random_bytes(8));
			$token = bin2hex(random_bytes(32));
		}catch(Exception $e){
			// Fallback a menos entropía si random_bytes falla
			$selector = bin2hex(openssl_random_pseudo_bytes(8));
			$token = bin2hex(openssl_random_pseudo_bytes(32));
		}

		$token_hash = hash('sha256', $token);
		$expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hora

		$logModel->GuardarTokenDeRecuperacion($Resultado['Id'], $selector, $token_hash, $expires_at);

		// Construir URL de restablecimiento
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
		$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
		$baseUrl = $protocol . '://' . $host;
		$resetUrl = $baseUrl . '/reset.php?selector=' . $selector . '&validator=' . $token;

		// Preparar email (HTML)
		$text = "<p>Hola,</p>";
		$text .= "<p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Haz clic en el siguiente botón para continuar. Este enlace expirará en 1 hora.</p>";
		$text .= "<p><a href='" . $resetUrl . "' style='background:#007bff;color:#fff;padding:10px 16px;text-decoration:none;border-radius:4px;'>Restablecer contraseña</a></p>";
		$text .= "<p>Si no solicitaste este cambio, ignora este correo o contacta con soporte.</p>";
		$text = html_entity_decode($text);

		$mail=new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug=0; // Desactivar debug en producción (usar 2 para debug)
		$mail->SMTPAuth=true;
		$mail->SMTPSecure= getenv('MAIL_ENCRYPTION');
		$mail->Host= getenv('MAIL_HOST');
		$mail->Port= getenv('MAIL_PORT');
		$mail->Timeout = 10;
		$mail->IsHTML(true);
		$mail->CharSet='UTF-8';
		$mail->Encoding='quoted-printable';
		$mail->Username= getenv('MAIL_USERNAME'); 
		$mail->Password= getenv('MAIL_PASSWORD'); 
		$mail->SetFrom( getenv('MAIL_USERNAME'), getenv('MAIL_FROM'), 0);
		$subject = "Restablecer tu contraseña";
		$mail->Subject = html_entity_decode($subject);
		$mail->Body    = $text;
		$mail->AddAddress($OriginalEmail);

		// Respuesta neutral al cliente (evitar enumerar cuentas)
		if($mail->Send()){
			echo "document.getElementById('Paragrapforget').innerHTML='Email enviado con éxito. Revise su casilla de correo.';
				document.getElementById('Paragrapforget').style.color = 'green';";
			exit;
		}else{
			$error = $mail->ErrorInfo;
			// Registrar error en consola para debugging
			echo "document.getElementById('Paragrapforget').innerHTML='Ocurrio un error al enviar el email. Espere un momento y reintente por favor';";
			// echo "console.error('PHPMailer Error: " . addslashes($error) . "');";
			exit;
		}
	}else{
		echo "document.getElementById('Paragrapforget').innerHTML='No se encontró el email. Por favor contacte con soporte.';";
		exit;
	}
	
	exit;
?>