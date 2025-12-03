<?php
	//echo("Suses");
	//exit;
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
	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
		$interval = date_diff($datetime1, $datetime2);
		return $interval->format($differenceFormat);
	}
	//echo("<p>" .date_default_timezone_get() . "</p>");
	$default_timezone = date_default_timezone_get();
	$HoraInicial = date("Y-m-d H:i:s", time());
	//echo($HoraInicial);
	//exit;
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	//echo("<p>" .date_default_timezone_get() . "</p>");
	$HoraFinal = date("Y-m-d H:i:s", time());
	//echo($HoraInicial);
	//echo($HoraFinal);
	$file_ticket = 'UploadConfirmed.ticket.txt';
	if(!function_exists ('InluirPHP')){
		function InluirPHP($PHPFILE,$FILEID){
			if (file_exists($PHPFILE)){
				require_once($PHPFILE);
			}
		}
	}
	function StrToHTML($str) { 
		$a = array('&quot;');
		$b = array(' ');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('–');
		$b = array('-');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('<o:p>');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('</o:p>');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('<o:p >');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('</o:p >');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		
		$a = array('<u>');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('</u>');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('<u >');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('</u >');
		$b = array('');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		
		$a = array('“');
		$b = array('"');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		$a = array('”');
		$b = array('"');
		//$str = htmlentities($str);
		$str = html_entity_decode($str);
		$str = str_replace($a, $b, $str);
		
		return str_replace($a, $b, $str); 
	}
	
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
	
	InluirPHP('../clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$Fecha = date("Y-m-d H:i:s", time()); 
	$Date = date('Y-m-d H:i:s', strtotime($Fecha . ' - 5 minutes'));
	$time = '0';
	
	/*
	if(session_id() != '') {
		session_destroy();
	}
	session_start([
			'cookie_lifetime' => 86400,
			'read_and_close'  => true,
	]);
	*/
	$_SESSION['logged_in'] = TRUE;
	$iptocheck = $_SERVER['REMOTE_ADDR'];
	require('../config.php');
	require('../authenticate.php');
	if(!$ClaseMaster->db){
		header("Location: ../ErrorSql.php");
		exit;
	}
	
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	
	
	$FechaIFPN = issetornull('FechaI');
	$FechaFFPN = issetornull('FechaF');
	
	$FechaI = issetornull('FechaI');
	$FechaI = str_replace('/', '-', $FechaI).':00';
	$FechaI = substr($FechaI,6, 4).'-'.substr($FechaI,3, 2).'-'.substr($FechaI,0, 2).substr($FechaI,10);
	$FechaF = issetornull('FechaF');
	$FechaF = str_replace('/', '-', $FechaF).':00';
	$FechaF = substr($FechaF,6, 4).'-'.substr($FechaF,3, 2).'-'.substr($FechaF,0, 2).substr($FechaF,10);
	$DiaYMes = '-' . substr($FechaF,8, 2) . '-' . substr($FechaF,5, 2);
	
	$FechaISpp = date('Y-m-d H:i:s', strtotime($FechaI));
	$FechaFSpp = date('Y-m-d H:i:s', strtotime($FechaF));
	
	$Columnas = array("Hora");
	$Consulta= "
		SELECT CURRENT_TIMESTAMP() as 'Hora'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$HoraInicial = $ClaseMaster->ArraydResultados[0][0];
		
	}else{
		exit;
	}
	
	$HoraInicial = date('Y-m-d H:i:s', strtotime($HoraInicial . ' - 5 minutes'));
	$DiferenciaHoraria = dateDifference($HoraInicial,$HoraFinal,"%h");
	date_default_timezone_set($default_timezone);
	
	$FechaISpp = date('Y-m-d H:i:s', strtotime($FechaI));
	$FechaFSpp = date('Y-m-d H:i:s', strtotime($FechaF));
	
	$FechaI = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaF = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	
	
	
	$FechaI = issetornull('FechaI');
	$FechaI = str_replace('/', '-', $FechaI).':00';
	$FechaI = substr($FechaI,6, 4).'-'.substr($FechaI,3, 2).'-'.substr($FechaI,0, 2).substr($FechaI,10);
	$FechaF = issetornull('FechaF');
	$FechaF = str_replace('/', '-', $FechaF).':00';
	$FechaF = substr($FechaF,6, 4).'-'.substr($FechaF,3, 2).'-'.substr($FechaF,0, 2).substr($FechaF,10);
	/*
	$FechaI = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaF = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	*/
	//echo($FechaI . " " . $FechaF);exit;
	//$DiferenciaHoraria
	
	
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	//chdir("../");
	chdir("../");
	chdir("../");
	//echo getcwd();
	$path = 'cliente_flash_reportes/';
	if(!is_dir($path)){mkdir($path);}
	$path = $path . 'files/';
	if(!is_dir($path)){mkdir($path);}
	$path = $path . date('Y', time()) . '/';
	if(!is_dir($path)){mkdir($path);}
	$path = $path . date('m', time()) . '/';
	if(!is_dir($path)){mkdir($path);}
	$path = $path . date('d', time()) . '/';
	if(!is_dir($path)){mkdir($path);}
	$FileAndFolder = $path . 'Credito ' . date('H', time()) . 'Horas '. date('i', time()) .'Minutos '. date('s', time()) .'Segundos '. '.txt';
	$File = fopen($FileAndFolder, "w");
	$Sizes = ["10","50","10","3","25","50","15","50","10","2","2","50","20","20","12","10","10","9","3","20"];
	date_default_timezone_set($default_timezone);
	$ResultadoAnterior = false;
	
	
	
	$Columnas = array("PIEZANUME","DESTINATARIO","FECHAIMPOSICION","ESTADOCODI"
	,"PIEZACLIENTENUME","DOMICILIO","CODPOSTAL","CIUDAD","FECHANOVEDAD","VISITA","MOTIVOCODI"
	,"RECEPTOR","DOCUNUME","VINCULO","CARTERENDICION","FECHACARTARENDICION"
	,"FECHARETIRO","MATERIAL","SUCURCODI","SUCURDESCRI"
	);
	$Consulta= "
		SELECT 
			fp.id as PIEZANUME
			, fp.destinatario as 'DESTINATARIO'
			, p.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
			, e.CodigoDeEstado as 'ESTADOCODI'
			, p.Tarjeta as  'PIEZACLIENTENUME'
			, fp.domicilio as 'DOMICILIO'
			, fp.codigo_postal as 'CODPOSTAL'
			, fp.localidad as 'CIUDAD'
			, pe.Fecha  + INTERVAL + $DiferenciaHoraria HOUR as 'FECHANOVEDAD' # $DiferenciaHoraria
			, case 
				when e.IdTipoDeEstado = '4' then '1'
				when e.IdTipoDeEstado = '3' then '1'
				when e.IdTipoDeEstado = '6' then '1'
				else ''
				end as 'VISITA'
			, e.CodigoDeMotivo as 'MOTIVOCODI'
			, e.IdTipoDeEstado as 'Orden'
			,case  
				when pe.idEstados = 13 then pe.ApellidoNombreRecibio
				else ''
				end as 'RECEPTOR'
			,case  
				when pe.idEstados = 13 then pe.Documento
				else ''
				end as 'DOCUNUME'
			,case  
				when pe.idEstados = 13 then vinculo.Nombre
				else ''
				end as 'VINCULO'
			,case  
				when e.CodigoDeReporte <> 'SOL' then ''
				else concat('CF',right(1000000+(DATEDIFF(pe.Fecha,'2019-12-17')),5),right(1000000+p.Sucursal,3))
			end as 'CARTERENDICION'
			,fci.create as 'FECHACARTARENDICION'
			,p.FechaDeCargaSistemaFlash as 'FECHARETIRO'
			,m.Nombre as 'MATERIAL' 
			,p.Sucursal as'SUCURCODI'
			,'' as 'SUCURDESCRI'
		FROM (
			SELECT *
			FROM sispoc5_Banco.PiezasEstados as pe
			WHERE
			pe.Fecha >= '$FechaI' AND pe.Fecha < '$FechaF'
			#and pe.idPieza is not null  
			and pe.Barcode <> ''
		) as pe
		inner join sispoc5_gestionpostal.flash_piezas as fp on pe.Barcode = fp.barcode_externo #pe.idPieza = fp.id
		inner join sispoc5_Banco.Piezas as p on pe.Barcode = concat('CF',p.Tarjeta) #p.IdSispoPieza = pe.idPieza
		inner join sispoc5_Banco.Estados as e on pe.idEstados = e.Id
		left JOIN sispoc5_Ocasa.VinculoDestinatario as vinculo on vinculo.id = pe.idVinculo
		inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on  fci.id = fp.comprobante_ingreso_id
		inner JOIN sispoc5_Banco.Marcas as m on p.IdMarca = m.id
		WHERE
		pe.Fecha >= '$FechaI' AND pe.Fecha < '$FechaF'
		and pe.idEstados > '1'#No Saca Por Reporte Logico Recibido
		and p.Tipo = '2'
		and e.NombreReporte not like '' and e.NombreReporte is not null
		order by e.IdTipoDeEstado asc
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$ResultadoAnterior = true;
		for($cont=0;$cont< count($Columnas) ;$cont++){
			if($cont>0){echo("(|)");}
			echo($Columnas[$cont]);
		}
		echo("(;)");
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo("(;)");}
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
								echo(StrToHTML($ClaseMaster->ArraydResultados[$cont][$cont2]));
							}
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("(|)"."");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d-H-i-s');
							echo("(|)".$resultado);
						}else{
							echo("(|)".StrToHTML($ClaseMaster->ArraydResultados[$cont][$cont2]));
						}
					}
				}
			}
		}
		if($Resultado){
			//fwrite($GestorDeFichero,"Con Resultados");
			for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
				for($cont2=0; $cont>=0 && $cont2< count($Columnas) ;$cont2++){
					$str = $ClaseMaster->ArraydResultados[$cont][$cont2];
					if($cont2 == 2 || $cont2 == 8 || $cont2 == 15 || $cont2 == 16){
						$str = str_replace('-','/',$str);
					}
					if($cont2 == 0 || $cont2 == 18){
						$relleno = "0";
						$str = StringSize($str,$Sizes[$cont2],'UTF-8',$relleno,STR_PAD_LEFT,'|');
					}else{
						$relleno = " ";
						if($cont2+1 == count($Columnas)){
							$str = StringSize($str,$Sizes[$cont2],'UTF-8',$relleno,STR_PAD_RIGHT,'');
						}else{
							$str = StringSize($str,$Sizes[$cont2],'UTF-8',$relleno,STR_PAD_RIGHT,'|');
						}
					}
					fwrite($File,$str);
				}
				fwrite($File, ''.PHP_EOL.'' );
			}
		}else{
			//fwrite($GestorDeFichero,"Sin Resultados");
		}
	}
	else{
		print_r($Consulta);
	}
	fclose($File);
?>













