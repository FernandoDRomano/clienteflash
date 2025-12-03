<?php
	header("Access-Control-Allow-Origin: *");
	$RespuestaJsonAjax = array('');
	$_REQUEST = json_decode($_REQUEST["js"],true);
	function ColumaEnArrayAArray($Arg = ",",$ArraydStr,$Columna){
		$Tstr = array();
		for($i = 0; $i<count($ArraydStr);$i++){
			$Tstr[$i] = $ArraydStr[$i][$Columna];
		}
		return $Tstr;
	}
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		if($RespuestaJsonAjax['0'] == ""){
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}else{
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;
		}
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		if(isset ($_GET['callback'])){
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

	$HDR = issetornull('HDR');
	$Columnas = array("Pieza Id");
	$Consulta="
		SELECT fp.id as 'Pieza Id'
		FROM sispoc5_gestionpostal.flash_hojas_rutas as hdr
		inner join sispoc5_gestionpostal.flash_piezas as fp on fp.hoja_ruta_id = hdr.id
		where hdr.id = '$HDR'
	";
	
	
	
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$Piezas = $ClaseMaster->ArraydResultados;
		$Piezas = ColumaEnArrayAArray(",",$Piezas,0);
		$Piezas = "('".implode("','",$Piezas)."')";
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Piezas:".$Piezas,$RespuestaJsonAjax);//85134300
		
		$Columnas = array("Pieza Id");
		$Consulta="
			UPDATE sispoc5_Ocasa.Piezas_Estados SET Activo = false WHERE idPieza in $Piezas
		";
		//print_r($Consulta);
		
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Columnas = array("Pieza Id");
		$Consulta="
			INSERT INTO sispoc5_Ocasa.Piezas_Estados
			(
				id
				, idPieza
				, BarcodeExterno
				, idVinculo
				, ApellidoNombreRecibio
				, Documento
				, Hora
				, Fecha
				, VercionAPP
				, Latitud
				, Longitud
				, Exactitud
				, Altitud
				, Tipo
				, idEstados
				, Activo
				, NombreDeUsuario
				, DocumentoUsuario
				, FotoDeAcuse
				, FotoDeAcuseWeb
			)
				SELECT '' as 'id'
				, fp.id as 'Pieza Id'
				, fp.barcode_externo as 'Barcode'
				,'' as 'idVinculo'
				,'' as 'ApellidoNombreRecibio'
				,'' as 'Documento'
				,'00:00:00' as 'Hora'
				,CURRENT_TIMESTAMP as 'Fecha'
				,'0' as 'VercionAPP'
				,'' as 'Latitud'
				,'' as 'Longitud'
				,'' as 'Exactitud'
				,'' as 'Altitud'
				,'' as 'Tipo'
				,'46' as 'idEstados'
				,true as 'Activo'
				,'User Web' as 'NombreDeUsuario'
				,'00000000' as 'DocumentoUsuario'
				,'' as 'FotoDeAcuse'
				,'' as 'FotoDeAcuseWe'
					FROM sispoc5_gestionpostal.flash_hojas_rutas as hdr
					inner join sispoc5_gestionpostal.flash_piezas as fp on fp.hoja_ruta_id = hdr.id
					where hdr.id = '$HDR'
		";
		
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		if($Resultado){
			//$RespuestaJsonAjax = functionRespuestaJsonAjax("Ultimo Estado Insertado:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Piezas Aceptadas:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
		}else{
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Piezas No Encontradas",$RespuestaJsonAjax);
			if($RespuestaJsonAjax[0] == ""){
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
			}
			functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
		}
		
		//
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Piezas No Encontradas",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;

?>
















