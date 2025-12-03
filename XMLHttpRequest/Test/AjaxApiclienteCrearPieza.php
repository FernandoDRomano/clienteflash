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
	
	
	
	
	$ApiKey = issetornull('ApiKey');
	$SecretKey = issetornull('SecretKey');
	//$ApiKey = 'bacfdf03ce9dea8a108f601aa8a27289';
	//$SecretKey = '4836df3b972892c22ea9034c96116772';
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
		//print_r(json_encode($PHPRespuesta));
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
		//print_r(json_encode($PHPRespuesta));
	}
	
	/*access_token************/
	//$AccessToken = issetornull('AccessToken');
	$ServicioId = issetornull('servicio_id');
	$User=0;
	$ClienteId = issetornull('Cliente');
	$ArraydPiezas = issetornull('Piezas');
	
	$CantidadDePiezas = count($ArraydPiezas);
	
	
	
	
	
	/*
	$_REQUEST["PiezaT"][0]["id"] = "1";
	$_REQUEST["PiezaT"][1]["id"] = "2";
	$_REQUEST["PiezaT"][2]["id"] = "3";
	$_REQUEST["PiezaT"][3]["id"] = "4";
	*/
	
	//print_r(json_encode($_REQUEST,true));
	
	//exit;
	
	
	
	//$Data = array('access_token' => $AccessToken,'id' => $Pieza);
	/*
	$Data = array(
		'access_token' => $AccessToken,'sucursal_origen' => $sucursal_origen,'sucursal_destino' => $sucursal_destino
		,'codigo_externo' => $codigo_externo,'descripcion_paquete' => $descripcion_paquete
		,'dimensiones' => $dimensiones,'peso' => $peso,'bultos' => $bultos,'dias_entrega' => $dias_entrega,'nombres' => $nombres
		,'apellidos' => $apellidos,'tipo_documento' => $tipo_documento,'documento' => $documento,'codigo_postal' => $codigo_postal
		,'provincia' => $provincia
		,'localidad_ciudad' => $localidad_ciudad,'calle' => $calle,'numero' => $numero,'piso' => $piso,'depto' => $depto
		,'telefono' => $telefono,'mail' => $mail,'referencia_domicilio' => $referencia_domicilio
	);
	$PHPRespuesta = CURL("POST", "https://clientes.sispo.com.ar/api/envios", $Data);
	if($PHPRespuesta["http_code"] == 200){
		if(isset($PHPRespuesta["json-data"])){
			//echo("Error:Sin Datos De Respuesta");
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Sin Datos De Respuesta",$RespuestaJsonAjax);
		}else{
			if(isset($PHPRespuesta["pieza_id"])){
				//echo($PHPRespuesta["data"][0]["fecha"] . " ");
				//echo($PHPRespuesta["data"][0]["estado"]);
				$RespuestaJsonAjax = functionRespuestaJsonAjax($PHPRespuesta["pieza_id"],$RespuestaJsonAjax);
				if(isset($PHPRespuesta["codigo_externo"])){
					$RespuestaJsonAjax = functionRespuestaJsonAjax($PHPRespuesta["codigo_externo"],$RespuestaJsonAjax);
				}else{
					$RespuestaJsonAjax = functionRespuestaJsonAjax("Sin Barcode Externo",$RespuestaJsonAjax);
				}
			}else{
				echo("Error:Con Datos Erroneos");
			}
		}
		//print_r(json_encode($PHPRespuesta));
	}else{
		if(isset($PHPRespuesta["json-data"])){
			//echo("Error:Sin Datos De Respuesta");
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Sin Datos De Respuesta",$RespuestaJsonAjax);
		}
		//print_r(json_encode($PHPRespuesta));
	}
	*/
	
	
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
	
	
	$Columnas = array("id");
	$Consulta="
		SELECT id as 'id'
		FROM sispoc5_gestionpostal.flash_clientes_departamentos
		WHERE cliente_id = '" . $cliente_id . "'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$departamento_id = "";
	if($Resultado){
		$departamento_id = $ClaseMaster->ArraydResultados[0][0];
		$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $departamento_id,$RespuestaJsonAjax);
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Encontro El Departamento Del Cliente",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	GenerarComprobanteDeIngreso:
	$numero = "9999" . $cliente_id . GenerateRandomNumber();
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
		$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobanteDeIngreso,$RespuestaJsonAjax);
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
		,'" . $cliente_id . "'
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
		$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobanteDeIngresoInsertado,$RespuestaJsonAjax);
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
		$RespuestaJsonAjax = functionRespuestaJsonAjax("|" . $ComprobantesIngresosServicios,$RespuestaJsonAjax);
	}else{
		$RespuestaJsonAjax = array('');
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto El Comprobante De Ingreso En Servicio" . $Consulta,$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	for($i=0;$i<count($ArraydPiezas);$i++){
		$codigo_externo = issetornullinarrayd('Piezas',$i,'codigo_externo');
		$nombres = issetornullinarrayd('Piezas',$i,'nombres');
		$apellidos = issetornullinarrayd('Piezas',$i,'apellidos');
		$tipo_documento = issetornullinarrayd('Piezas',$i,'tipo_documento');
		$documento = issetornullinarrayd('Piezas',$i,'documento');
		$codigo_postal = issetornullinarrayd('Piezas',$i,'codigo_postal');
		$provincia = issetornullinarrayd('Piezas',$i,'provincia');
		$localidad_ciudad = issetornullinarrayd('Piezas',$i,'localidad_ciudad');
		$calle = issetornullinarrayd('Piezas',$i,'calle');
		$numero = issetornullinarrayd('Piezas',$i,'numero');
		$piso = issetornullinarrayd('Piezas',$i,'piso');
		$depto = issetornullinarrayd('Piezas',$i,'depto');
		$telefono = issetornullinarrayd('Piezas',$i,'telefono');
		$mail = issetornullinarrayd('Piezas',$i,'mail');
		$referencia_domicilio = issetornullinarrayd('Piezas',$i,'referencia_domicilio');
		
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
				,'" . $ServicioId . "'
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
			if($i>0){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("!" . ($i+1) . "°" . $PiezaIngrezada ,$RespuestaJsonAjax);
			}else{
				$RespuestaJsonAjax = functionRespuestaJsonAjax("|TABLE:" . ($i+1) . "°" . $PiezaIngrezada,$RespuestaJsonAjax);
			}
		}else{
			$RespuestaJsonAjax = array('');
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Inserto La Pieza" . $Consulta,$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		
	}
	
	
	
	
	
	
	
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	
	
	/*
	if($Resultado){
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){
				//echo(";");
				$RespuestaJsonAjax = functionRespuestaJsonAjax(";",$RespuestaJsonAjax);
			}
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					//if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						//echo("");
						$RespuestaJsonAjax = functionRespuestaJsonAjax("",$RespuestaJsonAjax);
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							//echo("".$resultado);
							$RespuestaJsonAjax = functionRespuestaJsonAjax($resultado,$RespuestaJsonAjax);
						}else{
							if($Columnas[0]=="PieceNumber"){
								//echo(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
								$RespuestaJsonAjax = functionRespuestaJsonAjax(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2],$RespuestaJsonAjax));
							}else{
								//echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
								$RespuestaJsonAjax = functionRespuestaJsonAjax($ClaseMaster->ArraydResultados[$cont][$cont2],$RespuestaJsonAjax);
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						//echo("|"."");
						$RespuestaJsonAjax = functionRespuestaJsonAjax("|"."",$RespuestaJsonAjax);
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							//echo("|".$resultado);
							
							$RespuestaJsonAjax = functionRespuestaJsonAjax("|".$resultado,$RespuestaJsonAjax);
						}else{
							//echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
							$RespuestaJsonAjax = functionRespuestaJsonAjax("|".$ClaseMaster->ArraydResultados[$cont][$cont2],$RespuestaJsonAjax);
						}
					}
					
				}
			}
		}
	}
	
	
	
	
	*/
	/*
	if($Resultado){
		/ *
		for($cont=0;$cont< count($Columnas) ;$cont++){
			if($cont>0){echo("|");}
			echo($Columnas[$cont]);
		}
		echo(";");
		* /
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo(";");}
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					//if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("".$resultado);
						}else{
							if($Columnas[0]=="PieceNumber"){
								echo(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
							}else{
								echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("|"."");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("|".$resultado);
						}else{
							echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
					
				}
			}
		}
	}
	*/
	
	
	
	
	
	//
	//$RespuestaJsonAjax = functionRespuestaJsonAjax(json_decode($PHPRespuesta["http_code"],true),$RespuestaJsonAjax);
	//print_r($RespuestaJsonAjax);
	
	//if($RespuestaJsonAjax[0] == ""){
	//	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	//}
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	
	/*
	
	*/
	
	
	
	/*
	$target_dir = "uploads/";
	$uploadOk = 1;
	$RespuestaJsonAjax = functionRespuestaJsonAjax("Ficheros=" . count($_FILES["image_uploads"]["name"]),$RespuestaJsonAjax);
	for($i = 0 ; $i < count($_FILES["image_uploads"]["name"]); $i++){
		$target_file = $target_dir . basename($_FILES["image_uploads"]["name"][$i]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["image_uploads"]["tmp_name"][$i]);
			if($check !== false) {
				//echo "Tipo De Imagen - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				//echo "No Es Una Imagen.";
				$uploadOk = 0;
			}
		if (file_exists($target_file)) {
			unlink($target_file);
		}
		if ($uploadOk == 0) {
			//echo "La Imagen No Se Subio";
		} else {
			if (move_uploaded_file($_FILES["image_uploads"]["tmp_name"][$i], $target_file)) {
				//$RespuestaJsonAjax = functionRespuestaJsonAjax("El Archivo ". basename( $_FILES["image_uploads"]["name"][0]). " Se Subio",$RespuestaJsonAjax);
			} else {
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error Al Intentar Subir",$RespuestaJsonAjax);
			}
		}
	}
	*/
?>
















