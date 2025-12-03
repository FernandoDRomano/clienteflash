<?php
	header("Access-Control-Allow-Origin: *");
	//header("Access-Control-Allow-Credentials: true");
	//header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT, DELETE");
	//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
	//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	$RespuestaJsonAjax = array('');
	//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encntrado",$RespuestaJsonAjax);
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);
	
	//print_r(count($_REQUEST));
	
	//print_r("<br>");
	
	//print_r($_REQUEST);
	$_REQUEST = json_decode($_REQUEST["js"],true);
	
	//print_r($_REQUEST);
	//print_r($_REQUEST["Piezas"]);
	
	//print_r(array_keys($_REQUEST)[1]);
	
	//print_r(json_decode("\"" . $_REQUEST[array_keys($_REQUEST)[1]] . "\""));
	//print_r(json_decode($_REQUEST[array_keys($_REQUEST)[1]]);
	//$_REQUEST["data"] = json_decode(json_encode(json_encode($_REQUEST[array_keys($_REQUEST)[1]])));
	//print_r(json_decode($_REQUEST["data"]));
	//print_r("<br>");
	//$_REQUEST = json_decode("'" . $_REQUEST[array_keys($_REQUEST)[1]] . "'");
	//$_GET = json_decode($_GET);
	
	
	
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
	
	//print_r($_REQUEST["IdUsuario"]);
	
	//print_r($_REQUEST["User"]);
	//print_r($_REQUEST["time"]);
	//print_r($_REQUEST["Piezas"]);
	//print_r($_REQUEST["Piezas"][0]);
	
	//print_r($_REQUEST["Piezas"][0]["Pieza Id"]);
	//print_r($_REQUEST["Piezas"][0]["Barcode A Establecer"]);
	$CantidadDePiezas = count($_REQUEST["Piezas"][0]["Pieza Id"]);
	//print_r($_REQUEST["Piezas"][0]["Test 2"]);
	$Editadas = 0;
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
			/*
			if($Resultado){
				//$PiesaInsertada=$ClaseMaster->Insertado;
			}else{
				//$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Periodo De Pedidos Terminado Autorice Nuevamente(" . $Consulta . ")",$RespuestaJsonAjax);
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Cliente No Encntrado",$RespuestaJsonAjax);
				if($RespuestaJsonAjax[0] == ""){
					$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
				}
				functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
			}
			*/
		}
		
	}
	$RespuestaJsonAjax = functionRespuestaJsonAjax('<p>Piezas Editadas: <b>' . $Editadas . "</b></p>",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	//echo $_GET['callback']."(".json_encode($_REQUEST).")";
	exit;
	
	
	
?>