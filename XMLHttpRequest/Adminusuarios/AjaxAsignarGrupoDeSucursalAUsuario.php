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
	
	$IdUsuario = issetornull('IdUsuario');
	
	$Usuario = issetornull('Usuario');
	$GrupoDeSucursalParaUsuarios = issetornull('GrupoDeSucursalParaUsuarios');
	
	$Columnas = array("Id");
	$Consulta= "
		SELECT u.idusuario as 'Id'
		FROM sispoc5_correoflash.usuario as u
		inner join sispoc5_correoflash.GrupoDeSucursales as gds on u.GrupoSucursalId = gds.Id
		WHERE u.idusuario = '$Usuario' and gds.Id = '$GrupoDeSucursalParaUsuarios'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		echo("Error:El Usuario Ya Contiene Este Grupo De Sucursales.");exit;
	}
	
	$Columnas = array("GrupoSucursalId");
	$Consulta= "
		SELECT u.GrupoSucursalId as 'GrupoSucursalId'
		FROM sispoc5_correoflash.usuario as u
		WHERE u.idusuario = '$Usuario'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$GrupoSucursalId = $ClaseMaster->ArraydResultados[0][0];
		$Columnas = array("");//,"Password","Email","Nombre","Apellido","Fecha De Creacion"
		$Consulta= "
			UPDATE sispoc5_correoflash.usuario
			SET GrupoSucursalId = '$GrupoDeSucursalParaUsuarios'
			WHERE idusuario = '$Usuario'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		
		$Columnas = array("Id");
		$Consulta= "
			SELECT u.idusuario as 'Id'
			FROM sispoc5_correoflash.usuario as u
			inner join sispoc5_correoflash.GrupoDeSucursales as gds on u.GrupoSucursalId = gds.Id
			WHERE u.idusuario = '$Usuario' and gds.Id = '$GrupoDeSucursalParaUsuarios'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		if($Resultado){
			echo("Sucursal Actualizada");exit;
		}else{
			echo("Error: No Se Pudo Actualizar La Sucursal");exit;
		}
	}
	
	/*
	$Columnas = array("Nombre");
	$Consulta= "
		SELECT CFM.Nombre as 'Nombre'
		#, CFM.URL as 'MenuCarpetaRaiz'
		#, CFM.MainMenu as 'Vista De Menu'
		#, CFM.FechaDeCreacion as 'Fecha De Creacion'
		#, CFM.Creador as 'U.IdCreador'
		FROM sispoc5_correoflash.menu as CFM
		WHERE CFM.Nombre = '$MenuNombre'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	
	if($Resultado){
		echo("El Menu " . $MenuNombre . " Fue Creado.<br>Busque Menues Creados, (Para Ver Los Nuevos Menues).");exit;
	}else{
		echo("El Menu " . $MenuNombre . " No Fue Creado.");exit;
	}
	*/
	/*
	if($Resultado){
		for($cont=0;$cont< count($Columnas) ;$cont++){
			if($cont>0){echo("|");}
			echo($Columnas[$cont]);
		}
		echo(";");
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo(";");}
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					//if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("".$resultado);
						}else{
							if($Columnas[0]=="PieceNumber"){
								echo(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
							}else{
								echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("|"."");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("|".$resultado);
						}else{
							echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
					
				}
			}
		}
	}
	*/
	
?>













