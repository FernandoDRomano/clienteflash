<?php
	header("Access-Control-Allow-Origin: *");
	//header("Access-Control-Allow-Credentials: true");
	//header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT, DELETE");
	//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
	//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	$RespuestaJsonAjax = array('');
	//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encntrado",$RespuestaJsonAjax);
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	/*
	print_r($_REQUEST);
	echo $_GET['callback']."(".json_encode($_REQUEST).")";
	exit;
	*/
	
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
	$ServicioId = "4050";
	$User=0;
	$ClienteId = issetornull('Cliente');
	$ArraydPiezas = issetornull('Piezas');
	$CantidadDeDatosDeDestinaario = count($ArraydPiezas[0]["Destinatario-Nombre"]);
	
	//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Array Nombres:" . $nombres[0] , $RespuestaJsonAjax);
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	//exit;
	
	
	
	
	
	
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
	
	$Arraydnombres = issetornullinarraydgatarray('Piezas',0,'Destinatario-Nombre');
	$Arraydapellidos = issetornullinarraydgatarray('Piezas',0,'Destinatario-Apellido');
	$Arraydprovincia = issetornullinarraydgatarray('Piezas',0,'Destinatario-Provincia');
	$Arraydlocalidad_ciudad = issetornullinarraydgatarray('Piezas',0,'Destinatario-Localidad');
	$Arraydcodigo_postal = issetornullinarraydgatarray('Piezas',0,'Destinatario-CodigoPostal');
	$Arraydcalle = issetornullinarraydgatarray('Piezas',0,'Destinatario-Calle');
	$Arraydnumero = issetornullinarraydgatarray('Piezas',0,'Destinatario-Numero');
	
	$Arraydpiso = issetornullinarraydgatarray('Piezas',0,'Destinatario-Piso');
	$Arrayddepto = issetornullinarraydgatarray('Piezas',0,'Destinatario-Departamento');
	
	//$Formulario = issetornull('textBox');
	
	//$Arraydtipo_documento = issetornullinarraydgatarray('Piezas',0,'tipo_documento');
	//$Arrayddocumento = issetornullinarraydgatarray('Piezas',0,'documento');
	
	//print_r($_REQUEST);
	
	for($i=0;$i<$CantidadDePiezas;$i++){
		$Formulario = issetornull('textBox');
		$FormularioFinal=$Formulario;
		//print_r($_REQUEST);
		
		for($DatosEnFormularios=0 ; $DatosEnFormularios<count($ArrayDeFormularios) ;$DatosEnFormularios++){
			$temp = issetornullinarraydgatarray('Piezas',0,$ArrayDeFormularios[$DatosEnFormularios]);
			$FormularioFinal = str_replace("[".$ArrayDeFormularios[$DatosEnFormularios]."]", $temp[$i], $FormularioFinal);
			/*print_r($DatosEnFormularios);
			print_r($ArrayDeFormularios[$DatosEnFormularios]);
			print_r($temp);
			print_r($FormularioFinal);
			*/
		}
		//for($i=0;$i<count($ArraydPiezas);$i++){
		
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
		
		
		
		//$tipo_documento = issetornullinarrayd('Piezas',$i,'tipo_documento');
		//$documento = issetornullinarrayd('Piezas',$i,'documento');
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
    //$EmailDeCliente = "correflash2017@gmail.com";//$_POST['us_mail']; ,sistemas2@correoflash.com,sistemas@correoflash.com
	
	if($EmailDeCliente != ""){
		$EmailDeCliente = $EmailDeCliente. ",correflash2017@gmail.com,sistemas@correoflash.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}else{
		$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com,sistemas@correoflash.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
	}
    $mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->SMTPDebug = 0;                      //3 Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'correoflash2020@gmail.com';                     // SMTP username (Aceptar app insegura en configuracion de mail.)
		$mail->Password   = 'RGF32601828Ruben';                               // SMTP password
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
		$mail->Body = '<p>Estimado cliente,</p>' .
		'<p>Su Carta Documento está siendo procesada.</p>' .
		'<p>Dentro del plazo de una hora recibirá un próximo mail con el Código de Seguimiento donde podrá conocer el estado de su Carta Documento en la página web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>' .
		'';
		
		/*
		= 'Estimado/a : <br>Su pedido fue dado de alta. '.
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

	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Estimado cliente,</p> <p>Su Carta Documento está siendo procesada.</p> <p>Dentro del plazo de una hora recibirá un próximo mail con el Código de Seguimiento donde podrá conocer el estado de su Carta Documento en la página web del correo <a href="www.correoflash.com">www.correoflash.com</a></p>' . "</b>",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	/*
	$EmailDeCliente = $EmailDeCliente. "correflash2017@gmail.com,sistemas@correoflash.com,operaciones@correoflash.com,despachos2@correoflash.com,auditoria@correoflash.com";//$_POST['us_mail'];
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
















