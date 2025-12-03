<?php
	$RespuestaJsonAjax = array('');
	
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		//global $RespuestaJsonAjax;
		//ob_end_clean();
		//echo($RespuestaJsonAjax[0]);
		$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;//'1' => array('fullName' => 'Test 2', 'fullAdress' => 'Paris'),
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		//global $RespuestaJsonAjax;
		if(isset ($_GET['callback'])){
			//header("Content-Type: application/json");
			echo $_GET['callback']."(".json_encode($RespuestaJsonAjax).")";
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
	
	$Barra = issetornull('Barra');
	/*
	$Localidad = issetornull('Localidad');
	$CodigoPostal = issetornull('CodigoPostal');
	$Domicilio = issetornull('Domicilio');
	$Destinatario = issetornull('Destinatario');
	$ClienteId = issetornull('Cliente');
	$ServicioId = issetornull('Servicio');
	*/
	$Columnas = array("id","Barra");
	$Consulta= "
		SELECT TD.id, TD.Tarjeta 
		FROM sispoc5_Banco.tarjetasDeDebito as TD 
		WHERE TD.Tarjeta = '$Barra'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Pieza:" . $Barra . " Encontrada",$RespuestaJsonAjax);
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		echo("Pieza:" . $Barra . " Encontrada");exit;
		//echo("Error:La Pieza : " . $Barra . " Ya Existe");exit;
	}else{
		
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("",$RespuestaJsonAjax);
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:No Se Encontro La Pieza:" . $Barra,$RespuestaJsonAjax);
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		
		echo("Error:No Se Encontro La Pieza:" . $Barra);exit;
	}
	echo("Pieza:" . $Barra);
	
?>













