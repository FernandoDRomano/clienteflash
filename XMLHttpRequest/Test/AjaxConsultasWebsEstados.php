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
	
	
	
	
	
	$EstadoPieza = issetornull('EstadoPieza');
	$MotivoPieza = issetornull('MotivoPieza');
	$FechaEstadoPieza = issetornull('FechaEstadoPieza');
	$DatoPieza = issetornull('DatoPieza');
	$HDR = issetornull('HDR');
	$User=0;
	
	$URL = issetornull('URL');
	$Metodo = issetornull('Metodo');
	
	$Data = array(
		'EstadoPieza' => $EstadoPieza,
		'MotivoPieza' => $MotivoPieza,
		'FechaEstadoPieza' => $FechaEstadoPieza,
		'DatoPieza' => $DatoPieza,
		'HDR' => $HDR
	);
	
	$PHPRespuesta = CURL($Metodo, $URL, $Data);
	print_r($PHPRespuesta);
	if($PHPRespuesta["http_code"] == 200){
		/*
		if(isset($PHPRespuesta["json-data"])){
			echo("Error:Sin Datos De Respuesta");
		}else{
			if(isset($PHPRespuesta["access_token"])){
				echo($PHPRespuesta["access_token"]);
			}else{
				echo("Error:Con Datos Erroneos");
			}
		}
		*/
		//print_r(json_encode($PHPRespuesta));
	}else{
		if(isset($PHPRespuesta["json-data"])){
			echo("Error:Sin Datos De Respuesta");
		}
		//print_r(json_encode($PHPRespuesta));
	}
	
?>
















