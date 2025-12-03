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
	
	InluirPHP('../clasessispo/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
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
	
	$NumeroDePieza = issetornull('NumeroDePieza');
	$Desde = issetornull('Desde');
	if($Desde != ''){
		$Desde = str_replace('/', '-', $Desde).':00';
		$Desde = date('Y-m-d H:i:s', strtotime($Desde . ' - 5 hour') );
		//$Desde = date('Y-m-d', strtotime($Desde ) );
	}
	$Hasta = issetornull('Hasta');
	if($Hasta != ''){
		$Hasta = str_replace('/', '-', $Hasta).':00';
		$Hasta = date('Y-m-d H:i:s', strtotime($Hasta . ' - 5 hour') );
		//$Hasta = date('Y-m-d', strtotime($Hasta ) );
	}
	$Destinatario = issetornull('Destinatario');
	$DNIBusqueda = issetornull('DNIBusqueda');
	//375
	$UserId = issetornull('UserId');
	
	//echo("(".$Desde. ") (" .$Hasta . ")");
	
	//echo("(2019-12-12 00:00:00) (2019-12-13 00:00:00)");
	
	
	/*
	$FechaI = issetornull('FechaI');
	
	//$Fecha =date('Y-m-d', strtotime($Fecha .' +1 day'));
	
	$FechaI = issetornull('FechaI');
	$FechaI = str_replace('/', '-', $FechaI).':00';
	$FechaI = substr($FechaI,6, 4).'-'.substr($FechaI,3, 2).'-'.substr($FechaI,0, 2).substr($FechaI,10);
	//echo( date('Y-m-d',strtotime(date( "Y-m-d", strtotime(str_replace('/', '-',substr($FechaI,0,10)).' +1 day')))).''. substr($FechaI,10));
	//echo( date('Y-m-d',strtotime(date( "Y-m-d", strtotime(str_replace('/', '-',substr($FechaI,0,10)).' +1 day')))));
	
	$FechaF = issetornull('FechaF');
	$FechaF = str_replace('/', '-', $FechaF).':00';
	$FechaF = substr($FechaF,6, 4).'-'.substr($FechaF,3, 2).'-'.substr($FechaF,0, 2).substr($FechaF,10);
	
	$FechaI = date('Y-m-d H:i:s', strtotime($FechaI . ' - 4 hour') );
	$FechaF = date('Y-m-d H:i:s', strtotime($FechaF . ' - 4 hour') );
	*/
	$ColumnasOriginal = array("Id","Numero De Pieza","Destinatario","DNI","Domicilio"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Estados Historicos","Destino","Visor De Datos"
	);//"idEstado",
	
	$ConsultaOriginal= "
		
		SELECT Piezas.id as 'Id'
		,Piezas.barcode_externo as 'Numero De Pieza'
		,Piezas.destinatario as 'Destinatario'
		,Piezas.domicilio as 'Domicilio'
		,Piezas.codigo_postal as 'Codigo_postal'
		,Piezas.localidad as 'Localidad'
		,CASE pe.idEstados
			WHEN 'X01' THEN 'Logico Recibido'
			WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
			ELSE EE.NombreAPP
		END as 'Estado'
		#,EE.NombreAPP as 'Estado'
		#,pe.id as 'idEstado'
		,pe.Estados as 'Estados Historicos'
		,Piezas.documento as 'DNI'
		,'Domicilio' as 'Destino'
		,concat(
			'EmergenteEnTabla=',
			COALESCE(Piezas.id,''),'[,]',
			COALESCE(Piezas.barcode_externo,''),'[,]',
			COALESCE(Piezas.destinatario,''),'[,]',
			COALESCE(Piezas.documento,''),'[,]',
			COALESCE(Piezas.domicilio,''),'. ',
			COALESCE(Piezas.codigo_postal,''),'. ',
			COALESCE(Piezas.localidad,''),'[,]',
			COALESCE(
			CASE pe.idEstados
				WHEN 'X01' THEN 'Logico Recibido'
				WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
				ELSE EE.NombreAPP
			END
			,''),'[,]',
			COALESCE(DATE_ADD(pe.Fecha, INTERVAL 5 HOUR),''),'[,]',
			COALESCE(pe.ApellidoNombreRecibio,''),'[,]',
			COALESCE(pe.Documento,''),'[,]',
			COALESCE(VD.Nombre,'')
		) as 'Visor De Datos'
        ,fc.id
		,DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha De Estado'
		FROM sispoc5_gestionpostal.flash_piezas as Piezas
		inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id
		inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id 
		inner join 
		(
			select count(pe.id) as 'Estados', pe.* 
            from 
            (
				select *
				from
				(
				select pe.idVinculo as 'idVinculo'
                ,pe.id as 'id'
				, pe.idEstados as 'idEstados' 
				, pe.idPieza as 'idPieza'
				, DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha'
				, pe.BarcodeExterno as 'BarcodeExterno'
				, pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
				, pe.Documento as 'Documento'
                from sispoc5_Ocasa.Piezas_Estados as pe
				where (pe.BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
                #ORDER BY pe.id desc
				order by pe.Fecha desc
                ) as pe
				
				union
				
				SELECT 
				'0' as 'idVinculo'
                ,'0' as 'id'
				, 'x02' as 'idEstados'
				,idPieza as 'idPieza'
				, Fecha as 'Fecha'
				, BarcodeExterno as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				FROM sispoc5_Ocasa.PiezasAceptadasWeb
				where (BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
				
				union
				
				select
				'0' as 'idVinculo'
                ,'0' as 'id'
				, 'x01' as 'idEstados'
				, Piezas.id as 'idPieza'
				, DATE_ADD(Piezas.create, INTERVAL 5 HOUR) as 'Fecha'
				, Piezas.barcode_externo as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				from sispoc5_gestionpostal.flash_piezas as Piezas
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id and ci.cliente_id = '$UserId'
				where 1
				and (Piezas.create >= '$Desde') 
				and (Piezas.create <= '$Hasta')
				#and  (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '') 
                
            )as pe
			where (pe.BarcodeExterno like '' or '' = '')
	        GROUP by pe.BarcodeExterno
		)as pe on Piezas.id = pe.idPieza
		left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
		left join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
		WHERE fc.id = '$UserId'
		and (Piezas.create >= '$Desde')
		and (Piezas.create <= '$Hasta')
		and (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '')
		and ('$Destinatario' = '' or Piezas.destinatario like '%$Destinatario%')
		group by pe.BarcodeExterno
		order by Piezas.id, pe.Fecha desc
		limit 10000
	";
	
	
	
	
	
	
	
	//Modificacion de 13-01-2020
	$ColumnasNuevo = array("Id","Fecha Ingreso","Numero De Pieza","Servicio","Destinatario","DNI","Domicilio"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Estados Historicos","Destino","Visor De Datos"
	);//"idEstado",
	
	
	$ConsultaNuevo= "
		
		SELECT Piezas.id as 'Id'
        ,Piezas.barcode_externo as 'Numero De Pieza'
        ,Piezas.destinatario as 'Destinatario'
        ,Piezas.domicilio as 'Domicilio'
        ,Piezas.codigo_postal as 'Codigo_postal'
        ,Piezas.localidad as 'Localidad'
        ,CASE pe.idEstados
            WHEN 'X01' THEN 'Logico Recibido'
            WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
        ELSE EE.NombreAPP END as 'Estado'
        ,pe.Estados as 'Estados Historicos'
        ,Piezas.documento as 'DNI'
        ,'Domicilio' as 'Destino'
        ,Piezas.create as 'Fecha Ingreso'
        ,fs.nombre as 'Servicio'
        ,concat( 'EmergenteEnTabla=',
            COALESCE(Piezas.id,''),'[,]',
            COALESCE(Piezas.barcode_externo,''),'[,]',
            COALESCE(Piezas.destinatario,''),'[,]',
            COALESCE(Piezas.documento,''),'[,]',
            COALESCE(Piezas.domicilio,''),'. ',
            COALESCE(Piezas.codigo_postal,''),'. ',
            COALESCE(Piezas.localidad,''),'[,]',
            COALESCE( CASE pe.idEstados
                 WHEN 'X01' THEN 'Logico Recibido'
                 WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
                 ELSE EE.NombreAPP
                 END 
            ,''),'[,]',
            COALESCE(DATE_ADD(pe.Fecha, INTERVAL 5 HOUR),''),'[,]',
            COALESCE(pe.ApellidoNombreRecibio,''),'[,]',
            COALESCE(pe.Documento,''),'[,]',
            COALESCE(VD.Nombre,'') ) as 'Visor De Datos'
            ,fc.id
            ,DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha De Estado'
        
        FROM sispoc5_gestionpostal.flash_piezas as Piezas
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
        inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id
        INNER JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as fcis on Piezas.servicio_id = fcis.id
        INNER JOIN sispoc5_gestionpostal.flash_servicios as fs on fcis.servicio_id = fs.id
        inner join ( select count(pe.id) as 'Estados',
                    pe.* from ( select * from
                               ( select pe.idVinculo as 'idVinculo'
                                ,pe.id as 'id'
                                , pe.idEstados as 'idEstados'
                                , pe.idPieza as 'idPieza'
                                , DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha'
                                , pe.BarcodeExterno as 'BarcodeExterno'
                                , pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
                                , pe.Documento as 'Documento'
                                from sispoc5_Ocasa.Piezas_Estados as pe
                                where (pe.BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
                                #ORDER BY pe.id desc
                                order by pe.Fecha desc ) as pe
                               
                               union
                               
                               SELECT '0' as 'idVinculo'
                               ,'0' as 'id'
                               , 'x02' as 'idEstados'
                               ,idPieza as 'idPieza'
                               , Fecha as 'Fecha'
                               , BarcodeExterno as 'BarcodeExterno'
                               , '' as 'ApellidoNombreRecibio'
                               , '' as 'Documento'
                               FROM sispoc5_Ocasa.PiezasAceptadasWeb
                               where (BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
                               
                               union
                               
                               select '0' as 'idVinculo'
                               ,'0' as 'id' ,
                               'x01' as 'idEstados'
                               , Piezas.id as 'idPieza'
                               , DATE_ADD(Piezas.create, INTERVAL 5 HOUR) as 'Fecha'
                               , Piezas.barcode_externo as 'BarcodeExterno' ,
                               '' as 'ApellidoNombreRecibio' ,
                               '' as 'Documento'
                               from sispoc5_gestionpostal.flash_piezas as Piezas
                               inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci
                               on Piezas.comprobante_ingreso_id = ci.id and ci.cliente_id = '624'
                               where 1 and (Piezas.create >= '$Desde')
                               and (Piezas.create <= '$Hasta')
                               #and (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '')
                              )as pe where (pe.BarcodeExterno like '' or '' = '')
                    GROUP by pe.BarcodeExterno )as pe on Piezas.id = pe.idPieza
                    left join sispoc5_Ocasa.VinculoDestinatario as VD on pe.idVinculo = VD.id
                    left join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
                    WHERE fc.id = '$UserId'
                    and (Piezas.create >= '$Desde')
                    and (Piezas.create <= '$Hasta')
                    and (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '')
                    and ('$Destinatario' = '' or Piezas.destinatario like '%$Destinatario%')
                    group by pe.BarcodeExterno
                    order by Piezas.id, pe.Fecha
                    desc limit 10000
	";
	//Fin de modificacion del 13-01-2020
	
	//////////////////////////////////
	
	//Modificacion de consulta 14-01-2020
	
	$Columnas = array("Fecha Ingreso","Numero De Pieza","Servicio","Destinatario","DNI"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Estados Historicos","Visor De Datos"
	);//"idEstado",
	
	$Consulta = "
		
		SELECT Piezas.id as 'Id'
		,Piezas.barcode_externo as 'Numero De Pieza'
		,Piezas.destinatario as 'Destinatario'
		,Piezas.domicilio as 'Domicilio'
		,Piezas.codigo_postal as 'Codigo_postal'
		,Piezas.localidad as 'Localidad'
		,CASE pe.idEstados
			WHEN 'X01' THEN 'Ingreso a Planta'
			WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
			ELSE EE.NombreAPP
		END as 'Estado'
		#,EE.NombreAPP as 'Estado'
		#,pe.id as 'idEstado'
		,pe.Estados as 'Estados Historicos'
		,Piezas.documento as 'DNI'
        ,'Domicilio' as 'Destino'
        ,Piezas.create as 'Fecha Ingreso'
        ,fs.nombre as 'Servicio'
		,concat(
			'EmergenteEnTabla=',
			COALESCE(Piezas.id,''),'[,]',
			COALESCE(Piezas.barcode_externo,''),'[,]',
			COALESCE(Piezas.destinatario,''),'[,]',
			COALESCE(Piezas.documento,''),'[,]',
			COALESCE(Piezas.domicilio,''),'. ',
			COALESCE(Piezas.codigo_postal,''),'. ',
			COALESCE(Piezas.localidad,''),'[,]',
			COALESCE(
			CASE pe.idEstados
				WHEN 'X01' THEN 'Logico Recibido'
				WHEN 'X02' THEN 'Hoja De Ruta Aceptada Por Catero'
				ELSE EE.NombreAPP
			END
			,''),'[,]',
			COALESCE(DATE_ADD(pe.Fecha, INTERVAL 5 HOUR),''),'[,]',
			COALESCE(pe.ApellidoNombreRecibio,''),'[,]',
			COALESCE(pe.Documento,''),'[,]',
			COALESCE(VD.Nombre,'')
		) as 'Visor De Datos'
        ,fc.id
        ,DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha De Estado'
        
		FROM sispoc5_gestionpostal.flash_piezas as Piezas
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
        inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id
        INNER JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as fcis on Piezas.servicio_id = fcis.id
        INNER JOIN sispoc5_gestionpostal.flash_servicios as fs on fcis.servicio_id = fs.id
		inner join 
		(
			select count(pe.id) as 'Estados', pe.* 
            from 
            (
				select *
				from
				(
				select pe.idVinculo as 'idVinculo'
                ,pe.id as 'id'
				, pe.idEstados as 'idEstados' 
				, pe.idPieza as 'idPieza'
				, DATE_ADD(pe.Fecha, INTERVAL 5 HOUR) as 'Fecha'
				, pe.BarcodeExterno as 'BarcodeExterno'
				, pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
				, pe.Documento as 'Documento'
                from sispoc5_Ocasa.Piezas_Estados as pe
				where (pe.BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
                #ORDER BY pe.id desc
				order by pe.Fecha desc
                ) as pe
				
				union
				
				SELECT 
				'0' as 'idVinculo'
                ,'0' as 'id'
				, 'x02' as 'idEstados'
				,idPieza as 'idPieza'
				, Fecha as 'Fecha'
				, BarcodeExterno as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				FROM sispoc5_Ocasa.PiezasAceptadasWeb
				where (BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
				
				union
				
				select
				'0' as 'idVinculo'
                ,'0' as 'id'
				, 'x01' as 'idEstados'
				, Piezas.id as 'idPieza'
				, DATE_ADD(Piezas.create, INTERVAL 5 HOUR) as 'Fecha'
				, Piezas.barcode_externo as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				from sispoc5_gestionpostal.flash_piezas as Piezas
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id and ci.cliente_id = '$UserId'
				where 1
				and (Piezas.create >= '$Desde') 
				and (Piezas.create <= '$Hasta')
				#and  (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '') 
                
            )as pe
			where (pe.BarcodeExterno like '' or '' = '')
	        GROUP by pe.BarcodeExterno
		)as pe on Piezas.id = pe.idPieza
		left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
		left join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
		WHERE fc.id = '$UserId'
		and (Piezas.create >= '$Desde')
		and (Piezas.create <= '$Hasta')
		and (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '')
		and ('$Destinatario' = '' or Piezas.destinatario like '%$Destinatario%')
		group by pe.BarcodeExterno
		order by Piezas.id, pe.Fecha desc
		limit 50000
    ";
	
	//Fin modificacion 14-01-2020
	
	
	
	
	
	
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