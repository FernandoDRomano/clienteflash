<?php
	
	require_once("FuncionesGenerales.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	$Email = md5(issetornull('Email'));
	$OriginalEmail=issetornull('Email');
	$time=0;
	InluirPHP('PHPMailer/src/Exception.php','1');
	InluirPHP('PHPMailer/src/PHPMailer.php','1');
	InluirPHP('PHPMailer/src/SMTP.php','1');
	
	require('config.php');
	//echo("" . getcwd() . "/" . "config.php");
	//require('authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ErrorSql.php");
		exit;
	}
	$Columnas = array("Username","Password","");
	$Consulta= "
		SELECT Username as 'Username', Password as 'Password'
		FROM sispoc5_Ocasa.Clientes
		WHERE Email LIKE '$OriginalEmail'
	";
	//echo($Consulta);
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$Columnas = array("Username","Password","");
		$Consulta= "
			UPDATE sispoc5_Ocasa.Clientes SET IntentoDeLogueo= '0' WHERE Email LIKE '$OriginalEmail'
		";
		//echo($Consulta);
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Usuario = $ClaseMaster->ArraydResultados[0][0];
		$Password = $ClaseMaster->ArraydResultados[0][1];
		$text ='Nombre De Usuario:' . $Usuario .'<BR>';//$ClaseMaster->ArraydResultados[0][1]
		$text.='Password:' . $Password . '<BR>';//
		$text=html_entity_decode($text);
		$mail=new PHPMailer();
		
		$mail->IsSMTP();
		$mail->SMTPDebug=3; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth=true;// authentication enabled
		$mail->SMTPSecure='auth';// AUTH smtp login, insecure, no funciona con tls/ssl
		$mail->Host="ssrs.reachmail.net";
		$mail->Port=587;
		$mail->IsHTML(true);
		$mail->CharSet='UTF-8';
		$mail->Encoding='quoted-printable';
		$mail->Username="correflash2017@gmail.com";
		$mail->Password="Regedit32";
		$mail->SetFrom("correflash2017@gmail.com", 'Soporte Correoflash Offline', 0);
		$subject = "Pedido de cuenta:" . $OriginalEmail ;
		$subject = html_entity_decode($subject);
		$mail->Subject = $subject;
		$mail->Body    = $text;
		$mail->AddAddress($OriginalEmail);
		if($mail->Send()){
			header("Location: MSJLOGIN/EmailMandado.php");
			die();
		}else{
			header("Location: MSJLOGIN/EmailNoMandado.php");
			die();
		}
				
		exit;
	}else{
		header("Location: MSJLOGIN/EmailNoExiste.php");
		die();
	}
	
	exit;
?>