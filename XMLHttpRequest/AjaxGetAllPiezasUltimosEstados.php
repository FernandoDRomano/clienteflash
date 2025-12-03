<?php
	function ToASCIITilde($str) { 
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
		//$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o'); 
		$b = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'h', 'h', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'ij', 'j', 'j', 'k', 'k', 'l', 'l', ' Lv', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'oe', 'r', 'r', 'r', 'r', 'r', 'r', 's', 's', 's', 's', 's', 's', 's', 's', 't', 't', 't', 't', 't', 't', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'w', 'y', 'y', 'y', 'z', 'z', 'z', 'z', 'z', 'z', 's', 'f', 'o', 'o', 'u', 'u', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'a', 'a', 'ae', 'ae', 'o', 'o');
		return str_replace($a, $b, $str); 
	}
	function StringSize($str,$size,$modo,$Relleno,$LugarDeRelleno,$FinalDeLinea){
		$strT ;
		if(mb_detect_encoding($str, "auto") === "UTF-8"){
			//$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,"ASCII");
			$str = ToASCIITilde($str);
			$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,"UTF-8") . $FinalDeLinea ;
		}else{
			$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,$modo) . $FinalDeLinea ;
		}
		//$strT = $strT . "(".mb_detect_encoding($str, "auto").")";
		return $strT;
	}
	function StringFormat($str,$modo,$FinalDeLinea){
		$strT ;
		if(mb_detect_encoding($str, "auto") === "UTF-8"){
			//$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,"ASCII");
			$str = ToASCIITilde($str);
			$strT = mb_substr($str,0,null,"UTF-8") . $FinalDeLinea ;
		}else{
			$strT = mb_substr($str,0,null,$modo) . $FinalDeLinea ;
		}
		//$strT = $strT . "(".mb_detect_encoding($str, "auto").")";
		return $strT;
	}
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
	
	
	function ArraydParaXLSXStrig($keys, $values){
		$result = array();
		foreach ($keys as $i => $k) {
			$result[$k][] = $values;
		}

		array_walk($result, function(&$v){
			$v = (count($v) == 1) ? array_pop($v): $v;
		});
		return $result;
	}
	
	InluirPHP('xlsxwriter.class.php','2');
	//ini_set('display_errors', 0);
	//ini_set('log_errors', 1);
	//error_reporting(E_ALL & ~E_NOTICE);
	$filename = "Excel.xlsx";
	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	$writer = new XLSXWriter();
	$writer->setAuthor('Farias Ruben Gonzalo');
	
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
	$Fecha = date("Y", time());
	$A = substr($Fecha,0, 4);
	$Fecha = date("m", time());
	$M = substr($Fecha,0, 2);
	$Fecha = date("d", time());
	$D = substr($Fecha,0, 2);
	$Fecha = date("Y-m-d H:i:s", time());
	
	$Sizes = ["10","50","10","3","25","50","15","50","10","2","2","50","20","20","12","10","10","9","3","20"];
	$relleno = " ";
	$ArrayForWrite;
	
	$path = 'files/';
	if(!is_dir($path)){mkdir($path);}
	$path = 'files/' . $A . '/';
	if(!is_dir($path)){mkdir($path);}
	$path = 'files/' . $A . '/' . $M . '/';
	if(!is_dir($path)){mkdir($path);}
	$path = 'files/' . $A . '/' . $M . '/' . $D . '/';
	if(!is_dir($path)){mkdir($path);}
	$FileAndFolder = $path . 'Reporte'.'.xlsx';
	$FicheroTXT = $path . 'Reporte'. '.txt';
	$GestorDeFichero = fopen($FicheroTXT, "w");
	
	
	
	$NumeroDePieza = issetornull('NumeroDePieza');
	$Desde = issetornull('Desde');
	if($Desde != ''){
		$Desde = str_replace('/', '-', $Desde).':00';
		$Desde = date('Y-m-d H:i:s', strtotime($Desde . ' - 5 hour') );
	}
	$Hasta = issetornull('Hasta');
	if($Hasta != ''){
		$Hasta = str_replace('/', '-', $Hasta).':00';
		$Hasta = date('Y-m-d H:i:s', strtotime($Hasta . ' - 5 hour') );
	}
	$Destinatario = issetornull('Destinatario');
	$DNIBusqueda = issetornull('DNIBusqueda');
	$UserId = issetornull('UserId');
	
	
	$Columnas = array("Fecha Ingreso","Numero De Pieza","Servicio","Destinatario","DNI"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Estados Historicos"
	);//"idEstado",,"Visor De Datos"
	
	
	$ArraydXlsx = array();
	$ArraydXlsx = ArraydParaXLSXStrig( $Columnas , 'string' );
	$writer->writeSheetHeader('Sheet1', $ArraydXlsx);
	
	$Consulta= "
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
	//Fin modificaciones 14-01-2020
	
	
	//echo($Consulta);
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	$ArrayForWrite;
	if($Resultado){
		$ArrayForWrite = array();
		/*
		for($cont=0;$cont< count($Columnas) ;$cont++){
			//if($cont>0){echo("|");}
			//echo($Columnas[$cont]);
			array_push($ArrayForWrite , $Columnas[$cont]);
		}
		$writer->writeSheetRow('Sheet1', $ArrayForWrite);
		*/
		//echo(";");
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			//if($cont>0){echo(";");}
			$ArrayForWrite = array();
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					//if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						$resultado = "";
						//echo("");
						array_push($ArrayForWrite , $resultado);
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("".$resultado);
							array_push($ArrayForWrite , $resultado);
						}else{
							if($Columnas[0]=="PieceNumber"){
								//echo(BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
								array_push($ArrayForWrite , BCFOROCASA($ClaseMaster->ArraydResultados[$cont][$cont2]));
							}else{
								//echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
								array_push($ArrayForWrite ,$ClaseMaster->ArraydResultados[$cont][$cont2]);
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						$resultado = "";
						//echo("|"."");
						array_push($ArrayForWrite , $resultado);
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							//echo("|".$resultado);
							array_push($ArrayForWrite , $resultado);
						}else{
							//echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
							array_push($ArrayForWrite , $ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
					
				}
			}
			$writer->writeSheetRow('Sheet1', $ArrayForWrite);
		}
		if($Resultado){
			for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
				//fwrite($GestorDeFichero, 'Filas' );
				for($cont2=0; $cont>=0 && $cont2< count($Columnas) ;$cont2++){
					$str = $ClaseMaster->ArraydResultados[$cont][$cont2];
					$str = StringFormat($str,'UTF-8','|');
					fwrite($GestorDeFichero,$str);
				}
				fwrite($GestorDeFichero, ''.PHP_EOL.'' );
			}
		}else{
			fwrite($GestorDeFichero, 'Sin Resultados' );
		}
	}else{
		echo("NULL");
		exit;
	}
	$writer->writeToFile($FileAndFolder);
	fclose($GestorDeFichero);
	echo($FileAndFolder);
	exit;
?>