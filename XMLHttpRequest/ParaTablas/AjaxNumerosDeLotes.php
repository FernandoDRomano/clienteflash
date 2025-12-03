<?php
	if(!function_exists ('InluirPHP')){
		function InluirPHP($PHPFILE,$FILEID){
			if (file_exists($PHPFILE)){
				require_once($PHPFILE);
			}
		}
	}
	function StringSize($str,$size,$modo,$Relleno,$LugarDeRelleno,$FinalDeLinea){
		$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,$modo) . $FinalDeLinea ;
		return $strT;
	}
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$Fecha = date("Y-m-d H:i:s", time()); 
	$Date = date('Y-m-d H:i:s', strtotime($Fecha . ' - 5 minutes'));
	$time = '0';
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	
	$FechaIDeLoteo = issetornull('FechaIDeLoteo');
	$FechaIDeLoteo = str_replace('/', '-', $FechaIDeLoteo).':00';
	$FechaIDeLoteo = substr($FechaIDeLoteo,6, 4).'-'.substr($FechaIDeLoteo,3, 2).'-'.substr($FechaIDeLoteo,0, 2);//.substr($FechaIDeLoteo,10)
	$FechaFDeLoteo = issetornull('FechaFDeLoteo');
	$FechaFDeLoteo = str_replace('/', '-', $FechaFDeLoteo).':00';
	$FechaFDeLoteo = substr($FechaFDeLoteo,6, 4).'-'.substr($FechaFDeLoteo,3, 2).'-'.substr($FechaFDeLoteo,0, 2);//.substr($FechaFDeLoteo,10)
	
	$FechaActual = date("Y-m-d H:i:s", time());
	
	$Muchos = 5000;
	echo("Fecha|Lote;");
	//$Fechas = $FechaIDeLoteo;
	//echo($Fechas. "|" . "");
	
	for($Fechas = $FechaIDeLoteo; strtotime($Fechas) <= strtotime($FechaFDeLoteo) ; $Fechas = date('Y-m-d', strtotime($Fechas . ' + 1 days') )){
		$Muchos--;
		$CantidadDeDias = ceil(abs(strtotime($Fechas) - strtotime("2019-12-17")) / 86400);
		$relleno = "0";
		$Sucursal = 'XXX';
		$StrCliente = StringSize($Sucursal,3,'UTF-8',$relleno,STR_PAD_LEFT,'');
		$NumeroDeLote = $CantidadDeDias . "" . $StrCliente;
		$NumeroDeLote = StringSize($NumeroDeLote,8,'UTF-8',$relleno,STR_PAD_LEFT,'');
		$Lote = "CF" . $NumeroDeLote;
		if(strtotime($Fechas) < strtotime($FechaFDeLoteo)){
			echo($Fechas."|". $Lote . ";");
		}else{
			echo($Fechas."|".  $Lote );
		}
		if($Muchos<=0){
			return;
		}
	}
?>
