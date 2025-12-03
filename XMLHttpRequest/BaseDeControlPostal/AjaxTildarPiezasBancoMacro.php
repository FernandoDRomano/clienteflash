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
	$BarraDeBaseSinId = $Barra;
	$IdOBarcode = issetornull('IdOBarcode');
	if($IdOBarcode == '0'){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:El IDentificador De La Pieza Es Incorrecto:",$RespuestaJsonAjax);
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	$ColumnaSispo;
	if($IdOBarcode == 'Id'){
		$ColumnaSispo = 'id';
	}
	if($IdOBarcode == 'Barcode'){
		$ColumnaSispo = 'barcode_externo';
	}
	
	$Columnas = array("id","Barra");
	$Consulta= "
		SELECT fp.id as 'id', fp.barcode_externo as 'Barra'
		FROM sispoc5_gestionpostal.flash_piezas as fp
		WHERE fp.$ColumnaSispo = '$Barra'
		LIMIT 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	
	$ArraydDeResultados = $ClaseMaster->ArraydResultados;
	
	if($Resultado){
		$BarraDeBaseSinId = $ArraydDeResultados[0][1];
		if($BarraDeBaseSinId != ''){
			$Columnas = array("id","Barra");
			$Consulta= "
				UPDATE sispoc5_gestionpostal.flash_piezas
				SET 
				barcode_externo= CONCAT('$BarraDeBaseSinId','T')
				WHERE barcode_externo = '$BarraDeBaseSinId'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
	}
	
	$Columnas = array("id","Tarjeta");
	$Consulta= "
		SELECT TD.id as 'id', TD.Tarjeta  as 'Tarjeta'
		FROM sispoc5_Banco.tarjetasDeDebito as TD 
		WHERE TD.Tarjeta = REPLACE('$BarraDeBaseSinId','cf','')
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Consulta= "
				UPDATE sispoc5_Banco.tarjetasDeDebito
				SET Tarjeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				WHERE Tarjeta = REPLACE('$BarraDeBaseSinId','cf','')
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("En Banco Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("id","NumeroDeTarjeta");
	$Consulta= "
		SELECT Id as 'id', NumeroDeTarjeta as 'NumeroDeTarjeta'
		FROM sispoc5_Banco.TarjetasImpresas
		WHERE NumeroDeTarjeta = REPLACE('$BarraDeBaseSinId','cf','')
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Consulta= "
				UPDATE sispoc5_Banco.TarjetasImpresas
				SET NumeroDeTarjeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				WHERE NumeroDeTarjeta = REPLACE('$BarraDeBaseSinId','cf','')
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("En Banco Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	$Columnas = array("id","SecuenciaDeTargeta");
	$Consulta= "
		SELECT Id as 'id', SecuenciaDeTargeta as 'SecuenciaDeTargeta'
		FROM sispoc5_Banco.TarjetasSinChipEMV 
		WHERESecuenciaDeTargeta = REPLACE('$BarraDeBaseSinId','cf','')
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Consulta= "
				UPDATE sispoc5_Banco.TarjetasSinChipEMV
				SET SecuenciaDeTargeta = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				WHERE SecuenciaDeTargeta = REPLACE('$BarraDeBaseSinId','cf','')
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("En Banco Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
		//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	
	
	
	$Columnas = array("id","NumPiezaCorreo");
	$Consulta= "
		SELECT CWP.id as 'id', CWP.NumPiezaCorreo as 'NumPiezaCorreo'
		FROM sispoc5_consultasweb.piezas as CWP
		WHERE CWP.NumPiezaCorreo = '$BarraDeBaseSinId'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Columnas = array("");
				$Consulta= "
				UPDATE sispoc5_consultasweb.piezas
				SET NumPiezaBanco = CONCAT(REPLACE('$BarraDeBaseSinId','cf',''),'T')
				, NumPiezaCorreo = CONCAT('$BarraDeBaseSinId','T')
				WHERE NumPiezaCorreo = '$BarraDeBaseSinId'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("En Web Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
	}
	
	$Columnas = array("id","NumeroPieza");
	$Consulta= "
		SELECT id as 'id', NumeroPieza as 'NumeroPieza'
		FROM sispoc5_consultasweb.estados_piezas
		WHERE NumeroPieza = '$BarraDeBaseSinId'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Columnas = array("");
				$Consulta= "
				UPDATE sispoc5_consultasweb.estados_piezas
				SET NumeroPieza = CONCAT('$BarraDeBaseSinId','T')
				WHERE NumeroPieza = '$BarraDeBaseSinId'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Estado En Web Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
	}
	
	$Columnas = array("id","BarcodeExterno");
	$Consulta= "
		SELECT id as 'id', BarcodeExterno as 'BarcodeExterno'
		FROM sispoc5_Ocasa.Piezas_Estados
		WHERE BarcodeExterno = '$BarraDeBaseSinId'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($BarraDeBaseSinId != ''){
			$Columnas = array("");
				$Consulta= "
				UPDATE sispoc5_Ocasa.Piezas_Estados
				SET BarcodeExterno = CONCAT('$BarraDeBaseSinId','T')
				WHERE BarcodeExterno = '$BarraDeBaseSinId'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Estado En Ocasa De Pieza:" . $BarraDeBaseSinId . " Encontrada:" ,$RespuestaJsonAjax);
		}
	}
	
	if($RespuestaJsonAjax == array('')){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("",$RespuestaJsonAjax);
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	
	
	
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	
	
?>













