<?php
	$default_timezone = date_default_timezone_get();
	@$HoraInicial = date("Y-m-d H:i:s", time());
	@$HoraInicial = date('Y-m-d H:i:s', strtotime($HoraInicial . ' 0 minutes'));
	@date_default_timezone_set('America/Argentina/Buenos_Aires');
	@$HoraFinal = date("Y-m-d H:i:s", time());
	$DiferenciaHoraria = dateDifference($HoraInicial,$HoraFinal,"%hhour %iminutes");
	//echo("Diferencia Zona Horaria PHP: " . $DiferenciaHoraria . "<br>");
	
	$time = '0';
	$Columnas = array("Hora");
	$Consulta= "
		SELECT CURRENT_TIMESTAMP() as 'Hora'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$HoraSQL = $ClaseMaster->ArraydResultados[0][0];
		$DiferenciaHoraria = dateDifference($HoraSQL,$HoraFinal," - %hhour - %iminutes");
		$DiferenciaSQL = dateDifference($HoraSQL,$HoraFinal,"%h:%i");
		//echo("Diferencia SQl: " . $DiferenciaHoraria . "<br>");
		//echo("Hora SQl: " . $HoraSQL . "<br>");
		
		$Calculo = date('Y-m-d H:i:s', strtotime($HoraSQL.  $DiferenciaHoraria));
		//echo("Calculo: " . $Calculo . "<br>");
	}else{
		exit;
	}
?>