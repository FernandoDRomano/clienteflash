<?php
	header("Access-Control-Allow-Origin: *");
	//header("Access-Control-Allow-Credentials: true");
	//header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT, DELETE");
	//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
	//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	$RespuestaJsonAjax = array('');
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		if($RespuestaJsonAjax['0'] == ""){
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}else{
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . "|" . $String;
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
	$User=0;
	//$ApiKey = 'bacfdf03ce9dea8a108f601aa8a27289';
	//$SecretKey = '4836df3b972892c22ea9034c96116772';
	
	$Data = array('api-key' => $ApiKey,'secret-key' => $SecretKey);
	$PHPRespuesta = CURL("POST", "https://clientes.sispo.com.ar/api/tokens", $Data);
	if($PHPRespuesta["http_code"] == 200){
		if(isset($PHPRespuesta["json-data"])){
			echo("Error:Sin Datos De Respuesta");
		}else{
			if(isset($PHPRespuesta["access_token"])){
				echo($PHPRespuesta["access_token"]);
			}else{
				echo("Error:Con Datos Erroneos");
			}
		}
		//print_r(json_encode($PHPRespuesta));
	}else{
		if(isset($PHPRespuesta["json-data"])){
			echo("Error:Sin Datos De Respuesta");
		}
		//print_r(json_encode($PHPRespuesta));
	}
	
	//
	//$RespuestaJsonAjax = functionRespuestaJsonAjax(json_decode($PHPRespuesta["http_code"],true),$RespuestaJsonAjax);
	//print_r($RespuestaJsonAjax);
	
	//if($RespuestaJsonAjax[0] == ""){
	//	$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	//}
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	
	/*
	$Barra = issetornull('Barra');
	$Localidad = issetornull('Localidad');
	$CodigoPostal = issetornull('CodigoPostal');
	$Domicilio = issetornull('Domicilio');
	$Destinatario = issetornull('Destinatario');
	$ClienteId = issetornull('Cliente');
	$ServicioId = issetornull('Servicio');
	
	$Columnas = array("id","Barra");
	$Consulta= "
		SELECT pi.id as 'id',
		pi.Barra as 'Barra'
		FROM sispoc5_Ocasa.PiezasIngresadas as pi
		WHERE pi.Barra = '$Barra'
		and pi.EstadoDeIngreso = '1'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
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
















