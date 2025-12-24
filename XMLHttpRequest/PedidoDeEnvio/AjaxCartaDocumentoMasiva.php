<?php
	header("Access-Control-Allow-Origin: *");

	// Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
	require_once __DIR__ . '/../../Config/bootstrap.php';

    use Helpers\LogManager;

	$RespuestaJsonAjax = array('');
	$_REQUEST = json_decode($_REQUEST["js"],true);

	// Instanciar LogManager
	$logger = new LogManager();
	$logger->info('Inicio de AjaxCartaDocumentoMasiva', 'Procesando cartas documentos masivas', [
		'request' => $_REQUEST
	]);

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
	
	$ServicioId = issetornull('servicio_id');
	$ServicioId = "4477";//4477 4050
	$User=0;
	$ClienteId = issetornull('Cliente');
	$ArraydPiezas = issetornull('Piezas');
	
	
	$CantidadDeDatosDeDestinaario = count($ArraydPiezas[0]["Destinatario-Nombre"]);
	
	$Formulario = issetornull('textBox');
	$ArrayDeFormularios = array();
	
	$PosI=0;
	$PosF=0;
	for($i=0,$j=0; $i<strlen($Formulario) ; $i++){
		$PosI = strpos ($Formulario,'[',$i);
		if($PosI !== false){
			$PosF = strpos ($Formulario,']',$PosI);
			if($PosF !== false){
				$Ofsets = ($PosF-$PosI)-1;
				$ArrayDeFormularios[$j] = substr($Formulario,$PosI+1,$Ofsets);
				$j++;
				$i=$PosF;
			}else{
				$i=strlen($Formulario);
			}
		}else{
			$i=strlen($Formulario);
		}
	}
	//print_r($ArrayDeFormularios);
	
	
	$CantidadDePiezas = count($ArraydPiezas[0]["Destinatario-Nombre"]);
	
	$IdUsuario = issetornull('IdUsuario');
	$GPIdUsuario = "";
	$Columnas = array("id");
	$Consulta="
		SELECT cfc.SispoId as 'id' FROM sispoc5_correoflash.cliente as cfc WHERE cfc.Id = '$IdUsuario'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$GPIdUsuario = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["GPIdUsuario"]= $GPIdUsuario;
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encontrado",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("firma");
	$Consulta="
		SELECT cfc.URLFirma as 'firma' FROM sispoc5_correoflash.cliente as cfc WHERE cfc.Id = '$IdUsuario'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$FirmaDelCliente = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["FirmaDelCliente"]= $FirmaDelCliente;
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:La Firma Requiere Ser Cargada Antes Del Pedido.",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	$Columnas = array("email");
	$Consulta="
		SELECT fcc.emails as 'email' 
		FROM sispoc5_gestionpostal.flash_clientes_contactos as fcc
		WHERE fcc.cliente_id = '$GPIdUsuario'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$EmailDeCliente = "";
	if($Resultado){
		$EmailDeCliente = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["FirmaDelCliente"]= $FirmaDelCliente;
	}else{
		$EmailDeCliente = "correflash2017@gmail.com";
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El Usuario No Tiene Agregado Un Mail."  ,$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("id");
	$Consulta="
		SELECT id as 'id'
		FROM sispoc5_gestionpostal.flash_clientes_departamentos
		WHERE cliente_id = '" . $GPIdUsuario . "'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$departamento_id = "";
	if($Resultado){
		$departamento_id = $ClaseMaster->ArraydResultados[0][0];
		$_REQUEST["departamento_id"]= $departamento_id;
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Encontro El Departamento Del Cliente",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}

	
	GenerarComprobanteDeIngreso:
	$numero = "" . $GPIdUsuario . GenerateRandomNumber();
	$Columnas = array("numero");
	$Consulta="
		SELECT numero
		FROM sispoc5_gestionpostal.flash_comprobantes_ingresos_generados
		WHERE numero='" . $numero . "'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		goto GenerarComprobanteDeIngreso;
	}else{
		$ComprobanteDeIngreso = $numero;
		$_REQUEST["ComprobanteDeIngreso"]= $ComprobanteDeIngreso;
	}
	
	
	$Columnas = array("");
	$Consulta="
		INSERT INTO sispoc5_gestionpostal.flash_comprobantes_ingresos_generados(
			talonario_id, numero, estado, flash_comprobantes_ingresos_generados.create, flash_comprobantes_ingresos_generados.update, create_user_id, update_user_id
		)
		VALUES (
			'1'
			, '$numero'
			, '1'
			, CURRENT_TIMESTAMP
			, NULL
			, NULL
			, NULL
		);
	";
	
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$ComprobanteDeIngreso_generadoInsertado="";
	if($Resultado){
		$ComprobanteDeIngreso_generadoInsertado=$ClaseMaster->Insertado;
		$_REQUEST["ComprobanteDeIngreso_generadoInsertado"]= $ComprobanteDeIngreso_generadoInsertado;
	}else{
		$logger->error('Error al insertar comprobante de ingreso generado', 'No se pudo insertar el comprobante de ingreso generado', [
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso", $RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	$Columnas = array("");
	$Consulta="
	INSERT INTO sispoc5_gestionpostal.flash_comprobantes_ingresos
	(
		empresa_id
		, sucursal_id
		, cliente_id
		, departamento_id
		, numero
		, estado
		, fecha_pedido
		, cantidad
		, `create`
		, `update`
	)
	VALUES
	(
		null
		,'4'
		,'" . $GPIdUsuario . "'
		,'" . $departamento_id . "'
		,'" . $numero . "'
		,'0'
		,'" . date('Y-m-d') . "'
		,'1'
		,'" . date("Y-m-d H:i:s") . "'
		,'" . date("Y-m-d H:i:s") . "'
	)
	";
	
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$ComprobanteDeIngresoInsertado="";
	if($Resultado){
		$ComprobanteDeIngresoInsertado=$ClaseMaster->Insertado;
		$_REQUEST["ComprobanteDeIngresoInsertado"]= $ComprobanteDeIngresoInsertado;
	}else{
		$logger->error('Error al insertar comprobante de ingreso', 'No se pudo insertar el comprobante de ingreso', [
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso", $RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("");
	$Consulta="
		INSERT INTO sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios
		(
			comprobante_ingreso_id
			, servicio_id
			, cantidad
			, disponible
			, remito
			, `create`
			, `update`
		)
		VALUES
		(
			'" . $ComprobanteDeIngresoInsertado . "'
			,'" . $ServicioId . "'
			,'" . $CantidadDePiezas . "'
			,'0'
			,'0'
			,'" . date("Y-m-d H:i:s") . "'
			,'" . date("Y-m-d H:i:s") . "'
		)
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	$ComprobantesIngresosServicios="";
	if($Resultado){
		$ComprobantesIngresosServicios=$ClaseMaster->Insertado;
		$_REQUEST["ComprobantesIngresosServicios"]= $ComprobantesIngresosServicios;
		
	}else{
		$logger->error('Error al insertar comprobante de ingreso servicio', 'No se pudo insertar el comprobante de ingreso servicio', [
			'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso En Servicio", $RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Arraydnombres = issetornullinarraydgatarray('Piezas',0,'Destinatario-Nombre');
	$Arraydapellidos = issetornullinarraydgatarray('Piezas',0,'Destinatario-Apellido');
	$Arraydprovincia = issetornullinarraydgatarray('Piezas',0,'Destinatario-Provincia');
	$Arraydlocalidad_ciudad = issetornullinarraydgatarray('Piezas',0,'Destinatario-Localidad');
	$Arraydcodigo_postal = issetornullinarraydgatarray('Piezas',0,'Destinatario-CodigoPostal');
	$Arraydcalle = issetornullinarraydgatarray('Piezas',0,'Destinatario-Calle');
	$Arraydnumero = issetornullinarraydgatarray('Piezas',0,'Destinatario-Numero');
	
	$Arraydpiso = issetornullinarraydgatarray('Piezas',0,'Destinatario-Piso');
	$Arrayddepto = issetornullinarraydgatarray('Piezas',0,'Destinatario-Departamento');
	
	$ArraydPiezas[0][$key]=str_replace("'","\\'",$value);
	
	for($i=0;$i<$CantidadDePiezas;$i++){
		$Formulario = issetornull('textBox');
		$FormularioFinal=$Formulario;
		//print_r($_REQUEST);
		
		for($DatosEnFormularios=0 ; $DatosEnFormularios<count($ArrayDeFormularios) ;$DatosEnFormularios++){
			$temp = issetornullinarraydgatarray('Piezas',0,$ArrayDeFormularios[$DatosEnFormularios]);
			$FormularioFinal = str_replace("[".$ArrayDeFormularios[$DatosEnFormularios]."]", $temp[$i], $FormularioFinal);
		}
		
		$nombres = $Arraydnombres[$i];
		$apellidos = $Arraydapellidos[$i];
		$codigo_postal = $Arraydcodigo_postal[$i];
		$provincia = $Arraydprovincia[$i];
		$localidad_ciudad = $Arraydlocalidad_ciudad[$i];
		$calle = $Arraydcalle[$i];
		$numero = $Arraydnumero[$i];
		
		if(count($Arraydpiso)>=$i){
			$piso = $Arraydpiso[$i];
		}
		if(count($Arrayddepto)>=$i){
			$depto = $Arrayddepto[$i];
		}
		
		$codigo_externo = "";
		
		$Destinatario = $apellidos . " " . $nombres;
		if($piso != "" and $depto != ""){$Domicilio = $calle . " " .  $numero . " " . $piso . " " . $depto;}
		if($piso != "" and $depto == ""){$Domicilio = $calle . " " .  $numero . " " . $piso;}
		if($piso == "" and $depto == ""){$Domicilio = $calle . " " .  $numero;}
		
		$Columnas = array("");
		$Consulta="
			INSERT INTO sispoc5_gestionpostal.flash_piezas
			(
				usuario_id
				, servicio_id
				, tipo_id
				, sucursal_id
				, estado_id
				, cantidad
				, comprobante_ingreso_id
				, barcode_externo
				, destinatario
				, domicilio
				, codigo_postal
				, localidad
				, `create`
				, `update`
			)
			VALUES 
			(
				'2'
				,'" . $ComprobantesIngresosServicios . "'
				,'2'
				,'4'
				,'1'
				,'1'
				,'" . $ComprobanteDeIngresoInsertado . "'
				,'" . $codigo_externo . "'
				,'" . $Destinatario . "'
				,'" . $Domicilio . "'
				,'" . $codigo_postal . "'
				,'" . $localidad_ciudad . "'
				,'" . date("Y-m-d H:i:s") . "'
				,'" . date("Y-m-d H:i:s") . "'
			)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$PiezaIngrezada="";
		if($Resultado){
			$PiezaIngrezada=$ClaseMaster->Insertado;
			$_REQUEST["PiezaIngrezada"][$i]= $PiezaIngrezada;
		}else{
			$logger->error('Error al insertar pieza', 'No se pudo insertar la pieza', [
				'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
				'usuario_id' => $GPIdUsuario,
				'data' => $_REQUEST
			]);

			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		
		
		$DestinatarioNombre = $Arraydnombres[$i];
		$DestinatarioApellido = $Arraydapellidos[$i];
		$DestinatarioCodigoPostal = $Arraydcodigo_postal[$i];
		$DestinatarioProvincia = $Arraydprovincia[$i];
		$DestinatarioLocalidad = $Arraydlocalidad_ciudad[$i];
		$DestinatarioCalle = $Arraydcalle[$i];
		$DestinatarioNumero = $Arraydnumero[$i];
		
		if(count($Arraydpiso)>=$i){
			$DestinatarioPiso = $Arraydpiso[$i];
		}
		if(count($Arrayddepto)>=$i){
			$DestinatarioDepartamento = $Arrayddepto[$i];
		}
		
		$RemitenteNombre = issetornullinarrayd('Piezas',0,'RemitenteNombre');
		$RemitenteCodigoPostal = issetornullinarrayd('Piezas',0,'RemitenteCodigoPostal');
		$RemitenteProvincia = issetornullinarrayd('Piezas',0,'RemitenteProvincia');
		$RemitenteLocalidad = issetornullinarrayd('Piezas',0,'RemitenteLocalidad');
		$RemitenteCalle = issetornullinarrayd('Piezas',0,'RemitenteCalle');
		$RemitenteNumero = issetornullinarrayd('Piezas',0,'RemitenteNumero');
		$RemitentePiso = issetornullinarrayd('Piezas',0,'RemitentePiso');
		$RemitenteDepartamento = issetornullinarrayd('Piezas',0,'RemitenteDepartamento');
		$RemitenteEmail = issetornullinarrayd('Piezas',0,'RemitenteEmail');
		$RemitenteCelular = issetornullinarrayd('Piezas',0,'RemitenteCelular');
		$RemitenteObservaciones = issetornullinarrayd('Piezas',0,'RemitenteObservaciones');
		
		$RemitenteNombreApoderado = issetornullinarrayd('Piezas',0,'RemitenteNombreApoderado');
		$RemitenteApellidoApoderado = issetornullinarrayd('Piezas',0,'RemitenteApellidoApoderado');
		$RemitenteDNITipoApoderado = issetornullinarrayd('Piezas',0,'RemitenteDNITipoApoderado');
		$RemitenteDocumentoApoderado = issetornullinarrayd('Piezas',0,'RemitenteDocumentoApoderado');
		
		$Columnas = array("");
		$Consulta="
			INSERT INTO sispoc5_gestionpostal.flash_piezas_cd
			(
				IdFlashPieza
				, RemitenteNombre, RemitenteApellido
				, RemitenteCodigoPostal, RemitenteProvincia, RemitenteLocalidad
				, RemitenteCalle, RemitenteNumero, RemitentePiso, RemitenteDepartamento
				, DestinatarioNombre, DestinatarioApellido
				, DestinatarioCodigoPostal, DestinatarioProvincia, DestinatarioLocalidad
				, DestinatarioCalle, DestinatarioNumero, DestinatarioPiso, DestinatarioDepartamento
				, RemitenteEmail, RemitenteCelular, RemitenteObservaciones
				, ApoderadoNombre, ApoderadoApellido
				, ApoderadoDNITipo, ApoderadoDocumento
				, ApoderadoFirma, Formulario, URLPDF
			)
			VALUES
			(
				'$PiezaIngrezada'
				, '$RemitenteNombre', ''
				, '$RemitenteCodigoPostal', '$RemitenteProvincia', '$RemitenteLocalidad'
				, '$RemitenteCalle', '$RemitenteNumero', '$RemitentePiso', '$RemitenteDepartamento'
				, '$DestinatarioNombre', '$DestinatarioApellido'
				, '$DestinatarioCodigoPostal', '$DestinatarioProvincia', '$DestinatarioLocalidad'
				, '$DestinatarioCalle', '$DestinatarioNumero', '$DestinatarioPiso', '$DestinatarioDepartamento'
				, '$RemitenteEmail', '$RemitenteCelular', '$RemitenteObservaciones'
				, '$RemitenteNombreApoderado', '$RemitenteApellidoApoderado'
				, '$RemitenteDNITipoApoderado', '$RemitenteDocumentoApoderado'
				, '$FirmaDelCliente'
				, '$FormularioFinal'
				, ''
			)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		$PiezaCDIngrezada="";
		if($Resultado){
			$PiezaCDIngrezada=$ClaseMaster->Insertado;
			$_REQUEST["PiezaCDIngrezada"][$i]= $PiezaCDIngrezada;
		}
		else{
			$logger->error('Error al insertar pieza carta documento', 'No se pudo insertar la pieza carta documento', [
				'consulta' => preg_replace('/[\r\n\t]+/', '', $Consulta),
				'usuario_id' => $GPIdUsuario,
				'data' => $_REQUEST
			]);

			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza CD",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}

		$logger->info('Carta documento masiva procesada', 'Se procesó una carta documento masiva', [
			'usuario_id' => $GPIdUsuario,
			'pieza_id' => $PiezaIngrezada,
			'pieza_cd_id' => $PiezaCDIngrezada,
		]);
	}
	
	$logger->info('Final de AjaxCartaDocumentoMasiva', 'Se finalizó el procesamiento de cartas documentos masivas', [
		'request' => $_REQUEST
	]);
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//Mensajeria Mail
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //$EmailDeCliente = "correflash2017@gmail.com";//$_POST['us_mail']; ,sistemas2@correoflash.com
	
	if($EmailDeCliente != ""){
		$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com";//$_POST['us_mail'];
	}else{
		$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com";//$_POST['us_mail'];
	}
	
	$EmailDeCliente = "correflash2017@gmail.com";
	
    $mail = new PHPMailer(true);
	try {
		$body = '<p>Estimado cliente,</p>' .
		'<p>Su Carta Documento esta siendo procesada.</p>' .
		'<p>Recibirás en el transcurso del día un mail con el Codigo de Seguimiento donde podra conocer el estado de su Carta Documento en la pagina web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>';

		//Server settings
		$mail->SMTPDebug = 0;                      
		$mail->isSMTP();                                            
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = getenv('MAIL_ENCRYPTION');
		$mail->Host = getenv('MAIL_HOST');
		$mail->Port = getenv('MAIL_PORT');
		$mail->Username = getenv('MAIL_USERNAME');
		$mail->Password = getenv('MAIL_PASSWORD'); 
		$mail->SetFrom( getenv('MAIL_USERNAME'), getenv('MAIL_FROM'), 0);
        $mail->CharSet = 'UTF-8';
		$mail->Timeout = 10;
		$mail->IsHTML(true);
		//Recipients
		$Emails = explode( ',', $EmailDeCliente);
		for($i=0;$i<count($Emails);$i++){
			$mail->addAddress($Emails[$i]);     // Add a recipient
		}

		// Content
		$mail->isHTML(true);                                 
		$mail->Subject = html_entity_decode('Su Envio De Carta Documento');
		$mail->Body = html_entity_decode($body);
		
		$mail->send();
	} catch (Exception $e) {
		$logger->exception('Error al enviar mail con el estado del pedido', $e, [
			'usuario_id' => $GPIdUsuario,
			'data' => $_REQUEST
		]);

		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Pudo Enviar Mail Con El Estado Del Pedido",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////

	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Estimado cliente,</p> <p>Su Carta Documento está siendo procesada.</p> <p>Recibirás en el transcurso del día un mail con el Código de Seguimiento donde podrá conocer el estado de su Carta Documento en la página web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>' . "</b>",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;

?>
















