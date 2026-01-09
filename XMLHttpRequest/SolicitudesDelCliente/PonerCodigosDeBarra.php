<?php
	header("Access-Control-Allow-Origin: *");

	// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
	require_once __DIR__ . '/../../Config/bootstrap.php';
	use Service\EmailService;
	use Helpers\LogManager;

	$logger = new LogManager();

	$RespuestaJsonAjax = array('');

	$_REQUEST = json_decode($_REQUEST["js"],true);	
	
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		if($RespuestaJsonAjax['0'] == ""){
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}else{
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
			//Suplantado Dado Que Impide Que Arme Tabla Desde Este Formato
			//$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . "|" . $String;
		}
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		if(isset ($_GET['callback'])){
			//header("Content-Type: application/json");
			echo $_GET['callback']."(".json_encode($RespuestaJsonAjax).")";
		}else{
			if(isset ($_POST['callback'])){
				echo $_POST['callback']."(".json_encode($RespuestaJsonAjax).")";
			}else{
				
			}
		}
		exit;
	}
	require('../FuncionesGenerales.php');
	InluirPHP('../clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
	require('../config.php');
	require('../authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ../ErrorSql.php");
		exit;
	}
	require('../FuncionesHorarias.php');
	$horaPasada = date("Y-m-d H:i:s", strtotime('2020-02-25 00:00:00'));
	$HoraBusqueda = date('Y-m-d H:i:s', strtotime($horaPasada. $DiferenciaHoraria));
	
	$CantidadDePiezas = count($_REQUEST["Piezas"][0]["Pieza Id"]);

	$Editadas = 0;
	$archivoLog = 'registro-email.log';
	$emails = [];

	for($i=0;$i<$CantidadDePiezas;$i++){
		if($_REQUEST["Piezas"][0]["Barcode A Establecer"][$i] !=""){
			$Editadas++;
			$Pieza = $_REQUEST["Piezas"][0]["Pieza Id"][$i];
			$BarcodeExterno = $_REQUEST["Piezas"][0]["Barcode A Establecer"][$i];
			$Columnas = array("");
			$Consulta="
				UPDATE sispoc5_gestionpostal.flash_piezas SET barcode_externo = '$BarcodeExterno' WHERE id = '$Pieza'
				#limit 1
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);

			//AGREGADO, ENVIANDO EL EMAIL AL CLIENTE
			$Columnas = array("email", "enviado", "cliente");
			$Consulta="
				SELECT p.id, cl.id as 'cliente_id', cl.nombre as 'cliente', cl2.Mail as 'email', cd.EmailEnviado as 'enviado'
				FROM sispoc5_gestionpostal.flash_piezas p 
				INNER JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos ci ON ci.id = p.comprobante_ingreso_id
				INNER JOIN sispoc5_gestionpostal.flash_clientes cl ON cl.id = ci.cliente_id
				INNER JOIN sispoc5_gestionpostal.flash_piezas_cd cd ON cd.IdFlashPieza = p.id
				LEFT JOIN sispoc5_correoflash.cliente cl2 ON cl2.SispoId = cl.id
				WHERE p.id = '$Pieza'
				limit 1
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);

			$EmailDeCliente = "";
			if($Resultado){
				$EmailDeCliente = $ClaseMaster->ArraydResultados[0][0];
				$enviado = $ClaseMaster->ArraydResultados[0][1];

				$body    = '<p>Estimado cliente.</p>' .
				"<p>El código de seguimiento de su Carta Documento es: <b>$BarcodeExterno</b> </p>" .
				'<p>Para conocer el estado de su Carta Documento ingrese <a href="https://correoflash.com/check2?q='. $BarcodeExterno .'">aquí</a> o puede visitar nuestra página web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>' .
				'<p>Saludos.</p>';
				$emails[] = [
					"email" => $EmailDeCliente,
					"body" => $body,
					"pieza" => $Pieza,
					"enviado" => $enviado
				];
				

			}else{
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El Cliente No Tiene Agregado Un Mail."  ,$RespuestaJsonAjax);
				if($RespuestaJsonAjax[0] == ""){
					$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
				}
				functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
			}

			
		}
		
	}

	
	$data = json_encode($emails);
	$mensaje = date('Y-m-d H:i:s') . " - DATA: $data ";
	$manejadorArchivo = fopen($archivoLog, 'a');
	fwrite($manejadorArchivo, $mensaje . PHP_EOL); // PHP_EOL agrega un salto de línea al final del mensaje
	fclose($manejadorArchivo);

    
	/////////////////////////////////////////////////////////////////////////////////
	//ENVIAR EMAIL
	foreach ($emails as $correo) {
		//SI NO SE ENVIO EL EMAIL ANTERIORMENTE, SE LE ENVIARA AHORA
		if($correo['enviado'] != 1){

			try {
				$emailService = new EmailService();
				$destinatarioEmail = $correo['email'];
				
				if (empty($destinatarioEmail)) {
					$logger->warning("PonerCodigosDeBarra", "No se pudo enviar email: destinatario sin email", [
						'piezaId' => $correo['pieza']
					]);
					throw new Exception("Destinatario sin email");
				}

				$subject = "Su Envío De Carta Documento - Correo Flash";
				$body = $correo['body'];

				$emailService->send($destinatarioEmail, $subject, $body, [
					'isHtml' => true
				]);

				$logger->info("PonerCodigosDeBarra", "Email de notificación enviado", [
					'destinatario' => $destinatarioEmail,
					'piezaId' => $correo['pieza'],
					'mensaje' => $body
				]);

				$id = $correo['pieza'];
				$fecha = date('Y-m-d H:i:s');
				$Columnas = array("");
				$Consulta="UPDATE sispoc5_gestionpostal.flash_piezas_cd SET EmailEnviado = 1, FechaEnvioEmail = '$fecha' WHERE IdFlashPieza = '$id'";
				$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);

			} catch (Exception $e) {
				$logger->exception("Error al enviar email de notificación carta documento", $e, [
					'destinatario' => $destinatarioEmail ?? 'N/A'
				]);

				$RespuestaJsonAjax = array('');
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error: No se pudo enviar el correo al cliente",$RespuestaJsonAjax);
				if($RespuestaJsonAjax[0] == ""){
					$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
				}
				functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
			} catch (Throwable $t) {
				$logger->exception("Error al enviar email de notificación carta documento", $t, [
					'destinatario' => $destinatarioEmail ?? 'N/A'
				]);

				$RespuestaJsonAjax = array('');
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error: No se pudo enviar el correo al cliente",$RespuestaJsonAjax);
				if($RespuestaJsonAjax[0] == ""){
					$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
				}
				functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
			}

		}
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////
    

	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Piezas Editadas: <b>' . $Editadas . "</b></p>",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	//echo $_GET['callback']."(".json_encode($_REQUEST).")";
	exit;
	
	
	
?>