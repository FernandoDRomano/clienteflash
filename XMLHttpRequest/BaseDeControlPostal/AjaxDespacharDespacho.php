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

	$DespachosActivos = issetornull('DespachosActivos');
	$Columnas = array("Pieza Id");
	$Consulta="
		SELECT pd.id as 'Despacho', fs.nombre as 'Sucursal De Destino', fp.comprobante_ingreso_id as 'Comprobante De Ingreso', fp.id as 'Pieza Id', fp.barcode_externo as 'Barcode'
		FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
		left join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id
		left join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
		left join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.destino_id
		left join sispoc5_Ocasa.Piezas_Estados as pe on fp.id = pe.idPieza
		left join sispoc5_Ocasa.EstadoEntregaApp as peApp on pe.idEstados = peApp.id
		
		where
		pd.id = '$DespachosActivos'
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
				,case pd.destino_id
					when 1 THEN '22'
					when 2 THEN '23'
					when 3 THEN '24'
					when 4 THEN '25'
					when 5 THEN '26'
					when 6 THEN '27'
					when 7 THEN '28'
					when 8 THEN '29'
					when 9 THEN '30'
					when 10 THEN '31'
					when 11 THEN '32'
					when 12 THEN '33'
					else '-1'
                END as 'idEstados'
				,true as 'Activo'
				,'User Web' as 'NombreDeUsuario'
				,'00000000' as 'DocumentoUsuario'
				,'' as 'FotoDeAcuse'
				,'' as 'FotoDeAcuseWe'
					FROM sispoc5_gestionpostal.flash_piezas_despacho as pd
					left join sispoc5_gestionpostal.flash_piezas_despacho_piezas as pdp on pd.id = pdp.despacho_id
					left join sispoc5_gestionpostal.flash_piezas as fp on pdp.pieza_id = fp.id
					left join sispoc5_gestionpostal.flash_sucursales as fs on fs.id = pd.destino_id
					where
					pd.id = '$DespachosActivos'
		";
		
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		if($Resultado){
			//$RespuestaJsonAjax = functionRespuestaJsonAjax("Ultimo Estado Insertado:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Piezas Despachadas:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
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
















