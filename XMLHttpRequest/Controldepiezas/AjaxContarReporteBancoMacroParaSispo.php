<?php
	/*
	print_r($_REQUEST);
	print_r($_POST);
	print_r($_GET);
	exit;
	*/
	//echo("Suses");
	//exit;
	//
	//echo password_hash("Ruben", PASSWORD_DEFAULT)."<br>";
	//$opciones = [
	//	'cost' => 13,
	//];//'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	
	//echo password_hash("Ruben", PASSWORD_BCRYPT, $opciones)."<br>";
	//echo(password_verify("spiderman2015","$2y$13$4wg3SQHg/QW3G5FDFcNVb.3h3YZMyGbLnawU80tgrXM1L31.raWhS"));
	//exit;
	
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
	//echo("<br>horaPasada:" . $horaPasada . "<br> HoraBusqueda:". $HoraBusqueda . "<br> DiferenciaHoraria:" . $DiferenciaHoraria . "<br> DiferenciaSQL:". $DiferenciaSQL . "<br>");
	
	/*
	$Columnas = array("Hora");
	$Consulta= "
		SELECT DATE_ADD('$HoraBusqueda', INTERVAL '$DiferenciaSQL' HOUR_MINUTE) as 'Hora'
	";
	//echo($Consulta);
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		//echo($ClaseMaster->ArraydResultados[0][0]);
	}
	*/
	/*
	$FechaI = issetornull('FechaI');
	$FechaI = str_replace('/', '-', $FechaI).':00';
	$FechaI = substr($FechaI,6, 4).'-'.substr($FechaI,3, 2).'-'.substr($FechaI,0, 2).substr($FechaI,10);
	*/
	
	$NumeroDeCargaInterna = issetornull('NumeroDeCargaInterna');
	
	$FechaDesde = issetornull('FechaI');
	$FechaDesde = str_replace('/', '-', $FechaDesde).':00';
	$FechaDesde = substr($FechaDesde,6, 4).'-'.substr($FechaDesde,3, 2).'-'.substr($FechaDesde,0, 2).substr($FechaDesde,10);
	
	$FechaHasta = issetornull('FechaF');
	$FechaHasta = str_replace('/', '-', $FechaHasta).':00';
	$FechaHasta = substr($FechaHasta,6, 4).'-'.substr($FechaHasta,3, 2).'-'.substr($FechaHasta,0, 2).substr($FechaHasta,10);
	
	
	if($NumeroDeCargaInterna!=''){
		$Columnas = array("Contador");
		$Consulta= "
			SELECT count(p.Id) as 'Contador'
			FROM sispoc5_Banco.Piezas as p
			left join sispoc5_Banco.sucursales as Sucur on Sucur.Numero = p.Sucursal and Sucur.Tipo like '%Sucursal%'
			left join sispoc5_Banco.PiezasTipo as pt on p.Tipo = pt.id
			left join sispoc5_Banco.Marcas as m on p.IdMarca = m.id
			WHERE p.NumeroDeCargaInterna = '$NumeroDeCargaInterna'
		";
	}else{
		$Columnas = array("Contador");
		$Consulta= "
			SELECT count(p.Id) as 'Contador'
			FROM sispoc5_Banco.Piezas as p
			left join sispoc5_Banco.sucursales as Sucur on Sucur.Numero = p.Sucursal and Sucur.Tipo like '%Sucursal%'
			left join sispoc5_Banco.PiezasTipo as pt on p.Tipo = pt.id
			left join sispoc5_Banco.Marcas as m on p.IdMarca = m.id
			WHERE p.FechaDeCargaSistemaFlash >= '$FechaDesde' and  p.FechaDeCargaSistemaFlash <= '$FechaHasta'
		";
	}
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	
	//print_r($Consulta);
	if($Resultado){
		$contador = $ClaseMaster->ArraydResultados[0][0];
		echo($contador);exit;
	}
	echo('0');exit;
?>













