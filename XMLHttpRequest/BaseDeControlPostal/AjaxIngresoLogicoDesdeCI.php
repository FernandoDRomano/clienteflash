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
	$ComprobantesDeIngreso = issetornull('ComprobantesDeIngreso');
	
	$Columnas = array("Pieza Id");
	$Consulta="
		INSERT INTO sispoc5_Ocasa.PiezasIngresadas
		(
			id
			, Destinatario
			, Domicilio
			, CodigoPostal
			, Localidad
			, Barra
			, Creacion
			, ClienteId
			, ServicioId
			, EstadoDeIngreso
			, PiezaId
		) 
		SELECT null as 'id'
		, null as 'Destinatario'
		, null as 'Domicilio'
		, null as 'CodigoPostal'
		, null as 'Localidad'
		, fp.barcode_externo as 'Barra'
		, CURRENT_TIMESTAMP as 'Creacion'
		, ci.cliente_id as 'ClienteId'
		, fp.servicio_id as 'servicio_id'
		, '2' as 'EstadoDeIngreso'
		, fp.id as 'PiezaId'
		FROM sispoc5_gestionpostal.flash_comprobantes_ingresos as ci
		inner join sispoc5_gestionpostal.flash_sucursales as suc on ci.sucursal_id = suc.id
		inner join sispoc5_gestionpostal.flash_piezas as fp on fp.comprobante_ingreso_id = ci.id
		left join sispoc5_Ocasa.Piezas_Estados as pe on fp.id = pe.idPieza
		left join sispoc5_Ocasa.EstadoEntregaApp as eapp on pe.idEstados = eapp.id
		where ci.id = '$ComprobantesDeIngreso' and fp.tipo_id = '2'
	";

	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	if($ClaseMaster->Insertado > 0){
		//$RespuestaJsonAjax = functionRespuestaJsonAjax("Ultimo Estado Insertado:".$ClaseMaster->Insertado,$RespuestaJsonAjax);//85134300
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Piezas Ingresada Fisicamente:",$RespuestaJsonAjax);//85134300
	}else{
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:Piezas No Ingresadas",$RespuestaJsonAjax);
		if($RespuestaJsonAjax[0] == ""){
			$RespuestaJsonAjax = functionRespuestaJsonAjax("Error:data:" ,$RespuestaJsonAjax);
		}
		functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	}
	functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
?>
















