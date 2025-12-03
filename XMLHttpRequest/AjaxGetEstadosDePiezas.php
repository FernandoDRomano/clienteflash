<?php
	//echo("1|Carter1;2|Carter2;3|Carter3;4|Carter4;5|Carter5;6|Carter6;7|Carter7;8|Carter8;9|Carter9;10|Carter10");
	if(!function_exists ('InluirPHP')){
		function InluirPHP($PHPFILE,$FILEID){
			if (file_exists($PHPFILE)){
				require_once($PHPFILE);
			}
		}
	}
	/*
	if(!function_exists ('ftp_CreateDir')){
		function ftp_CreateDir($conn_id, $Dir) {
			$d = explode("/",$Dir);
			for($i=0 ; $i<count($d) ; $i++ ){
				if (!@ftp_chdir($conn_id, $d[$i])) {
					ftp_mkdir($conn_id, $d[$i]);
					ftp_chdir($conn_id, $d[$i]);
				}
			}
		}
	}
	*/
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*
	InluirPHP('xlsxwriter.class.php','2');
	ini_set('display_errors', 0);
	ini_set('log_errors', 1);
	error_reporting(E_ALL & ~E_NOTICE);
	$filename = "Impresas.xlsx";
	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	$writer = new XLSXWriter();
	$writer->setAuthor('Farias Ruben Gonzalo');
	*/
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function SQLServerScape($str){ 
		$a = array('[','!','"','#','$','%','&','/','(',')','=',',','.',';',':','_','-','{','}','´','\'');
		$b = array('[[]','[!]','["]','[#]','[$]','[%]','[&]','[/]','[(]','[)]','[=]','[,]','[.]','[;]','[:]','[_]','[-]','[{]','[}]','[´]',"''");
		$str = str_replace($a, $b, $str);
		return $str;
	}
	
	function BCFOROCASA($str){ 
		$a = array('\'');
		$b = array('-');
		$str = str_replace($a, $b, $str);
		return $str;
	}
	
	InluirPHP('clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$Fecha = date("Y-m-d H:i:s", time()); 
	$Date = date('Y-m-d H:i:s', strtotime($Fecha . ' - 5 minutes'));
	$time = '0';
	session_start([
			'cookie_lifetime' => 86400,
			'read_and_close'  => true,
		]);
	$_SESSION['logged_in'] = TRUE;
	$iptocheck = $_SERVER['REMOTE_ADDR'];
	require('config.php');
	require('authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ErrorSql.php");
		exit;
	}
	
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	
	$IdPieza = issetornull('IdPieza');
	
	$ColumnasOriginal = array("Id","Numero De Pieza","Destinatario","DNI","Domicilio"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Destino"
	);//"idEstado",
	$ConsultaOriginal= "
		SELECT Piezas.id as 'Id'
		,Piezas.barcode_externo as 'Numero De Pieza'
		,Piezas.destinatario as 'Destinatario'
		,Piezas.domicilio as 'Domicilio'
		,Piezas.codigo_postal as 'Codigo_postal'
		,Piezas.localidad as 'Localidad'
		#,EE.NombreAPP as 'Estado'
		,CASE pe.idEstados
			WHEN 'X01' THEN 'Logico Recibido'
			WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
			ELSE EE.NombreAPP
		END as 'Estado'
		#,pe.id as 'idEstado'
		,Piezas.documento as 'DNI'
		,'Domicilio' as 'Destino'
		,DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha De Estado'
		FROM sispoc5_gestionpostal.flash_piezas as Piezas
		left join(
			 select '0' as 'idVinculo', 'x01' as 'idEstados', flash_piezas.id as 'idPieza', DATE_ADD(flash_piezas.create, INTERVAL 5 HOUR) as 'Fecha'
			 
			from sispoc5_gestionpostal.flash_piezas
			where flash_piezas.id = '$IdPieza'
			
			union
			
			SELECT '0' as 'idVinculo', 'x02' as 'idEstados' ,idPieza as 'idPieza', Fecha as 'Fecha'
			FROM sispoc5_Ocasa.PiezasAceptadasWeb
			where idPieza = '$IdPieza'
			
			union
			
			select Piezas_Estados.idVinculo as 'idVinculo', Piezas_Estados.idEstados as 'idEstados' , Piezas_Estados.idPieza as 'idPieza', DATE_ADD(Piezas_Estados.Fecha, INTERVAL 5 HOUR) as 'Fecha'
			from sispoc5_Ocasa.Piezas_Estados
			where idPieza = '$IdPieza'
           
		)
		as pe on Piezas.id = pe.idPieza
		left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
		left join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
		WHERE 1 and (Piezas.id = '$IdPieza' )
		order by Piezas.id, pe.Fecha desc
	";
	
	//Modificaciones del 14-01-2020
	
	$Columnas = array("Numero De Pieza","Destinatario","DNI","Domicilio"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado"
	);//"idEstado",
	$Consulta= "
		SELECT Piezas.id as 'Id'
		,Piezas.barcode_externo as 'Numero De Pieza'
		,Piezas.destinatario as 'Destinatario'
		,Piezas.domicilio as 'Domicilio'
		,Piezas.codigo_postal as 'Codigo_postal'
		,Piezas.localidad as 'Localidad'
		#,EE.NombreAPP as 'Estado'
		,CASE pe.idEstados
			WHEN 'X01' THEN 'Logico Recibido'
			WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
			ELSE EE.NombreAPP
		END as 'Estado'
		#,pe.id as 'idEstado'
		,Piezas.documento as 'DNI'
		,'Domicilio' as 'Destino'
		,DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha De Estado'
		FROM sispoc5_gestionpostal.flash_piezas as Piezas
		left join(
			 select '0' as 'idVinculo', 'x01' as 'idEstados', flash_piezas.id as 'idPieza', DATE_ADD(flash_piezas.create, INTERVAL 5 HOUR) as 'Fecha'
			 
			from sispoc5_gestionpostal.flash_piezas
			where flash_piezas.id = '$IdPieza'
			
			union
			
			SELECT '0' as 'idVinculo', 'x02' as 'idEstados' ,idPieza as 'idPieza', Fecha as 'Fecha'
			FROM sispoc5_Ocasa.PiezasAceptadasWeb
			where idPieza = '$IdPieza'
			
			union
			
			select Piezas_Estados.idVinculo as 'idVinculo', Piezas_Estados.idEstados as 'idEstados' , Piezas_Estados.idPieza as 'idPieza', DATE_ADD(Piezas_Estados.Fecha, INTERVAL 5 HOUR) as 'Fecha'
			from sispoc5_Ocasa.Piezas_Estados
			where idPieza = '$IdPieza'
           
		)
		as pe on Piezas.id = pe.idPieza
		left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
		left join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
		WHERE 1 and (Piezas.id = '$IdPieza' )
		order by Piezas.id, pe.Fecha desc
	";
	
	//fin modificaciones del 14-01-2020
	
	
	//echo("".$Consulta.";1");
	//echo("".$Desde. " " .$Hasta);
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	//$ArrayForWrite;
	if($Resultado){
		//echo("Columna|");
		//$ArrayForWrite = array();
		
		for($cont=0;$cont< count($Columnas) ;$cont++){
			if($cont>0){echo("|");}
			echo($Columnas[$cont]);
			//array_push($ArrayForWrite , $Columnas[$cont]);
		}
		
		//$writer->writeSheetRow('Sheet1', $ArrayForWrite);
		echo(";");
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo(";");}
			//$ArrayForWrite = array();
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					//if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("");
						//array_push($ArrayForWrite , $resultado);
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("".$resultado);
							//array_push($ArrayForWrite , $resultado);
						}else{
							if($Columnas[0]=="PieceNumber"){
								echo(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
								//array_push($ArrayForWrite , BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
							}else{
								echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
								//array_push($ArrayForWrite ,$ClaseMaster->ArraydResultados[$cont][$cont2]);
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("|"."");
						//array_push($ArrayForWrite , $resultado);
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("|".$resultado);
							//array_push($ArrayForWrite , $resultado);
						}else{
							echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
							//array_push($ArrayForWrite , $ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
					
				}
			}
			//$writer->writeSheetRow('Sheet1', $ArrayForWrite);
		}
	}else{
		echo("NULL");
		exit;
	}
	exit;
?>