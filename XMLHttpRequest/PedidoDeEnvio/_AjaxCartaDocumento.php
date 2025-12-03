<?php
	header("Access-Control-Allow-Origin: *");
	//header("Access-Control-Allow-Credentials: true");
	//header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT, DELETE");
	//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
	//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
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
	/*
	$RespuestaJsonAjax = functionRespuestaJsonAjax("Api Iniciada",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	*/
	
	/*
	$ApiKey = issetornull('ApiKey');
	$SecretKey = issetornull('SecretKey');
	$AccessToken = issetornull('AccessToken');
	
	$Data = array('api-key' => $ApiKey,'secret-key' => $SecretKey);
	$PHPRespuesta = CURL("POST", "https://clientes.sispo.com.ar/api/tokens", $Data);
	if($PHPRespuesta["http_code"] == 200){
		if(isset($PHPRespuesta["json-data"])){
			//echo("Error:Sin Datos De Respuesta");
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Sin Datos De Respuesta",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}else{
			if(isset($PHPRespuesta["access_token"])){
				$AccessToken = $PHPRespuesta["access_token"];
			}else{
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Con Datos Erroneos",$RespuestaJsonAjax);
				if($RespuestaJsonAjax[0] == ""){
					$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
				}
				functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
			}
		}
	}else{
		if(isset($PHPRespuesta["json-data"])){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Sin Datos De Respuesta",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Inesperado",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	*/
	
	$ServicioId = issetornull('servicio_id');
	$ServicioId = "4477";//4477 4050
	$User=0;
	$ClienteId = issetornull('Cliente');
	$ArraydPiezas = issetornull('Piezas');
	$Formulario = issetornull('textBox');
	
	$CantidadDePiezas = count($ArraydPiezas);
	
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encntrado",$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El Usuario No Tiene Agregado Un Mail."  ,$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	/*
	$Columnas = array("id");
	$Consulta="
		SELECT flash_clientes_api.cliente_id as 'id'
		FROM sispoc5_gestionpostal.flash_clientes_api_tokens 
		INNER JOIN sispoc5_gestionpostal.flash_clientes_api ON (flash_clientes_api.id = flash_clientes_api_tokens.flash_cliente_api_id) 
		WHERE flash_clientes_api_tokens.access_token = '" . $AccessToken . "'
		AND TIMESTAMPDIFF(HOUR, flash_clientes_api_tokens.create, NOW()) < 5
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$cliente_id="";
	if($Resultado){
		$cliente_id = $ClaseMaster->ArraydResultados[0][0];
		$RespuestaJsonAjax = functionRespuestaJsonAjax($cliente_id,$RespuestaJsonAjax);
	}else{
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente Su Cuenta",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	*/
	
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $departamento_id,$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobanteDeIngreso,$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobanteDeIngresoInsertado,$RespuestaJsonAjax);
		$_REQUEST["ComprobanteDeIngreso_generadoInsertado"]= $ComprobanteDeIngreso_generadoInsertado;
	}else{
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso" . $Consulta,$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobanteDeIngresoInsertado,$RespuestaJsonAjax);
		$_REQUEST["ComprobanteDeIngresoInsertado"]= $ComprobanteDeIngresoInsertado;
	}else{
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso" . $Consulta,$RespuestaJsonAjax);
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
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobantesIngresosServicios,$RespuestaJsonAjax);
		$_REQUEST["ComprobantesIngresosServicios"]= $ComprobantesIngresosServicios;
		
	}else{
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso En Servicio" . $Consulta,$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	for($i=0;$i<count($ArraydPiezas);$i++){
		$nombres = issetornullinarrayd('Piezas',$i,'DestinatarioNombre');
		$apellidos = issetornullinarrayd('Piezas',$i,'DestinatarioApellido');
		$tipo_documento = issetornullinarrayd('Piezas',$i,'tipo_documento');
		$documento = issetornullinarrayd('Piezas',$i,'documento');
		$codigo_postal = issetornullinarrayd('Piezas',$i,'DestinatarioCodigoPostal');
		$provincia = issetornullinarrayd('Piezas',$i,'DestinatarioProvincia');
		$localidad_ciudad = issetornullinarrayd('Piezas',$i,'DestinatarioLocalidad');
		$calle = issetornullinarrayd('Piezas',$i,'DestinatarioCalle');
		$numero = issetornullinarrayd('Piezas',$i,'DestinatarioNumero');
		$piso = issetornullinarrayd('Piezas',$i,'DestinatarioPiso');
		$depto = issetornullinarrayd('Piezas',$i,'DestinatarioDepartamento');
		
		$codigo_externo = "";
		
		/*
		$codigo_externo = issetornullinarrayd('Piezas',$i,'codigo_externo');
		$telefono = issetornullinarrayd('Piezas',$i,'telefono');
		$mail = issetornullinarrayd('Piezas',$i,'mail');
		$referencia_domicilio = issetornullinarrayd('Piezas',$i,'referencia_domicilio');
		*/
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
				
				#, vista
				#, recibio
				#, documento
				#, vinculo
				#, verifico_id
				#, rendicion_id
				#, hoja_ruta_id
				#, barcode
				#, create_user_id
				#, update_user_id
				
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
			/*
			if($i>0){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("!" . ($i+1) . "°" . $PiezaIngrezada ,$RespuestaJsonAjax);
			}else{
				$RespuestaJsonAjax = functionRespuestaJsonAjax("|TABLE:" . ($i+1) . "°" . $PiezaIngrezada,$RespuestaJsonAjax);
			}
			*/
		}else{
			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza" . $Consulta,$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		
		
		$DestinatarioNombre = issetornullinarrayd('Piezas',$i,'DestinatarioNombre');
		$DestinatarioApellido = issetornullinarrayd('Piezas',$i,'DestinatarioApellido');
		$DestinatarioCodigoPostal = issetornullinarrayd('Piezas',$i,'DestinatarioCodigoPostal');
		$DestinatarioProvincia = issetornullinarrayd('Piezas',$i,'DestinatarioProvincia');
		$DestinatarioLocalidad = issetornullinarrayd('Piezas',$i,'DestinatarioLocalidad');
		$DestinatarioCalle = issetornullinarrayd('Piezas',$i,'DestinatarioCalle');
		$DestinatarioNumero = issetornullinarrayd('Piezas',$i,'DestinatarioNumero');
		$DestinatarioPiso = issetornullinarrayd('Piezas',$i,'DestinatarioPiso');
		$DestinatarioDepartamento = issetornullinarrayd('Piezas',$i,'DestinatarioDepartamento');
		
		$RemitenteNombre = issetornullinarrayd('Piezas',$i,'RemitenteNombre');
		$RemitenteCodigoPostal = issetornullinarrayd('Piezas',$i,'RemitenteCodigoPostal');
		$RemitenteProvincia = issetornullinarrayd('Piezas',$i,'RemitenteProvincia');
		$RemitenteLocalidad = issetornullinarrayd('Piezas',$i,'RemitenteLocalidad');
		$RemitenteCalle = issetornullinarrayd('Piezas',$i,'RemitenteCalle');
		$RemitenteNumero = issetornullinarrayd('Piezas',$i,'RemitenteNumero');
		$RemitentePiso = issetornullinarrayd('Piezas',$i,'RemitentePiso');
		$RemitenteDepartamento = issetornullinarrayd('Piezas',$i,'RemitenteDepartamento');
		$RemitenteEmail = issetornullinarrayd('Piezas',$i,'RemitenteEmail');
		$RemitenteCelular = issetornullinarrayd('Piezas',$i,'RemitenteCelular');
		$RemitenteObservaciones = issetornullinarrayd('Piezas',$i,'RemitenteObservaciones');
		
		$RemitenteNombreApoderado = issetornullinarrayd('Piezas',$i,'RemitenteNombreApoderado');
		$RemitenteApellidoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteApellidoApoderado');
		$RemitenteDNITipoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteDNITipoApoderado');
		$RemitenteDocumentoApoderado = issetornullinarrayd('Piezas',$i,'RemitenteDocumentoApoderado');
		
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
				, '$Formulario'
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
			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza CD" . $Consulta,$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
	}
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//Mensajeria Mail
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com";//$_POST['us_mail'];
	
	
	if($EmailDeCliente != ""){
		$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}else{
		$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}
	
	//$emailCliente = $_POST['RemitenteEmail'];
	/*
	
	if($EmailDeCliente != ""){
		$EmailDeCliente = $EmailDeCliente. "," . $emailCliente . ",correflash2017@gmail.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}else{
		$EmailDeCliente = $EmailDeCliente. $emailCliente . "," . "correflash2017@gmail.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}*/
	
	/*
	if($EmailDeCliente != ""){
		$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com";//$_POST['us_mail'];
	}else{
		$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com";//$_POST['us_mail'];
	}
	*/
	
    $mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->SMTPDebug = 0;                      //3 Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	
	/*
	    ULTIMA DE RUBEN
		$mail->Username   = 'correflash2017@gmail.com';  
		$mail->Password   = 'RGF277627';            // SMTP username (Aceptar app insegura en configuracion de mail.)
    */
    
		$mail->Username   = 'correo.flash.mail@gmail.com';                     // SMTP username (Aceptar app insegura en configuracion de mail.)
		$mail->Password   = 'yhodaeuizbfscnfy';
		 
		
		$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 587;                                    // TCP port to connect to

		//Recipients
		//$mail->setFrom('correflash2017@gmail.com', 'CorreoFlash');
		//$mail->setFrom('correoflash.test@gmail.com', 'CorreoFlash');
		$mail->setFrom('correo.flash.mail@gmail.com', 'CorreoFlash');
		
		$Emails = explode( ',', $EmailDeCliente);
		for($i=0;$i<count($Emails);$i++){
			$mail->addAddress($Emails[$i]);     // Add a recipient
		}

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Su Envio De Carta Documento';
		$mail->Body    = '<p>Estimado cliente,</p>' .
		'<p>Su Carta Documento esta siendo procesada.</p>' .
		'<p>Dentro del plazo de una hora recibira un proximo mail con el Codigo de Seguimiento donde podra conocer el estado de su Carta Documento en la pagina web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>' .
		'<p>Email del cliente </p>' . $emailCliente .
		'';
		
		/*
		'Estimado/a: <br>Su pedido fue dado de alta. '.
		'Para ver el estado de su Pedido consulte en su cuenta de cliente Con: Comprobante De Ingreso:(' . $ComprobanteDeIngreso . ')' .
		'';
		*/
		$mail->send();
		//echo 'Message has been sent';
	} catch (Exception $e) {
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Pudo Enviar Mail Con El Estado Del Pedido",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////

		
	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Estimado cliente,</p> <p>Su Carta Documento está siendo procesada.</p> <p>Dentro del plazo de una hora recibirá un próximo mail con el Código de Seguimiento donde podrá conocer el estado de su Carta Documento en la página web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>'  . "</b>",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	
	
	/*
	$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
    $mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->SMTPDebug = 0;                      //3 Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'correoflash2020@gmail.com';                     // SMTP username (Aceptar app insegura en configuracion de mail.)
		$mail->Password   = 'Rugedit32Ruben';                               // SMTP password
		$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('correflash2017@gmail.com', 'CorreoFlash');
		
		$Emails = explode( ',', $EmailDeCliente);
		for($i=0;$i<count($Emails);$i++){
			$mail->addAddress($Emails[$i]);     // Add a recipient
		}

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Su Envio De Carta Documento';
		$mail->Body    = 'Un Cliente Solicita Carta Documento: <br>Con Comprobante De Ingreso:(' . $ComprobanteDeIngreso . ')'.
		'';
		$mail->send();
		//echo 'Message has been sent';
	} catch (Exception $e) {
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Pudo Enviar Mail Con El Estado Del Pedido",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	*/
	
/*	
	print_r($_REQUEST);
	exit;
*/
	/*
	
	
	
	
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	*/
?>
















