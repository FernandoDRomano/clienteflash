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
	$contador = 0;
	$ResultadoAnterior = false;
	
	
	$Columnas = array("Contador");
	$Consulta= "
	select count(*) AS 'Contador'
	FROM  (
	
		SELECT fp.id as 'PIEZANUME'
		,fp.destinatario as 'DESTINATARIO'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
		,case  
		when EP.Codigo = '13' then EP.Estado
		when EP.Codigo = '14' then EP.Estado
		when EP.Codigo = 'Z4' then EP.Estado
		when EP.Codigo = '21' then EP.Estado
		when EP.Codigo = '' then EP.Estado
		else 'SOL'
		end as 'ESTADOCODI'
		,BancoGrabadas.SecuenciaDeTargeta as  'PIEZACLIENTENUME'
		,fp.domicilio as 'DOMICILIO'
		,fp.codigo_postal as 'CODPOSTAL'
		,fp.localidad as 'CIUDAD'
		,E.Fecha  + INTERVAL + $DiferenciaHoraria HOUR as 'FECHANOVEDAD' # $DiferenciaHoraria
		,'1' as 'VISITA'
		,case  
		when EP.Codigo = '13' then EP.Codigo
		when EP.Codigo = '14' then EP.Codigo
		when EP.Codigo = 'Z4' then EP.Codigo
		when EP.Codigo = '21' then EP.Codigo
		else ''
		end as 'MOTIVOCODI'
		,case  
		when EP.Codigo = '13' then '2'
		when EP.Codigo = '14' then '3'
		when EP.Codigo = 'Z4' then '3'
		when EP.Codigo = '21' then '2'
		else '4'
		end as 'Orden'
		
		,case  
		when E.idEstados = 8 then E.ApellidoNombreRecibio
		else ''
		end as 'RECEPTOR'
		,case  
		when E.idEstados = 8 then E.Documento
		else ''
		end as 'DOCUNUME'
		,case  
		when E.idEstados = 8 then VCD.Nombre
		else ''
		end as 'VINCULO'
		,case  
			when EP.Codigo = '13' then ''
			when EP.Codigo = '14' then ''
			when EP.Codigo = 'Z4' then ''
			when EP.Codigo = '21' then ''
			else concat('CF',right(1000000+(DATEDIFF(E.Fecha,'2019-12-17')),5),right(1000000+BancoGrabadas.SucursalDeRadicacionDeLaCuenta,3))
			#concat('FLASH',BancoGrabadas.LoteImpreso)
		end as 'CARTERENDICION'
		,fci.create as 'FECHACARTARENDICION'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHARETIRO'
		,'VISA' as 'MATERIAL' 
		,BancoGrabadas.SucursalDeRadicacionDeLaCuenta as'SUCURCODI'
		,'' as 'SUCURDESCRI'
		FROM sispoc5_Ocasa.Piezas_Estados as E
		inner JOIN sispoc5_Ocasa.EstadoEntregaApp as EEA on E.Fecha >= '$FechaI' AND E.Fecha < '$FechaF' AND E.BarcodeExterno like 'cf%' and E.idEstados = EEA.id and (EEA.id = '8' or EEA.id = '13' or EEA.id = '12' or EEA.id = '46') 
		inner JOIN sispoc5_Banco.EstadoVisa as EV on EEA.idEstado = EV.IdApp
		inner JOIN sispoc5_Banco.EstadosPlasticos as EP on EV.IdPlasticos = EP.Id
		inner JOIN 
		(
			select TCCCE.Blancos
			,TCCCE.Calle, TCCCE.CardCarrier, TCCCE.Categoria, TCCCE.CodigoDeEntrega, TCCCE.CodigoPostal,TCCCE.DenominacionDelUsuario, TCCCE.FechaDeAlta, TCCCE.FechaDeCargaSistemaFlash, TCCCE.FechaDeEmbozado, TCCCE.FechaHasta, TCCCE.GrupoDeAfinidad, TCCCE.Id, TCCCE.InterfazDeTarjeta, TCCCE.Localidad, TCCCE.NumeroDeComprobante, TCCCE.NumeroDeCuenta, TCCCE.NumeroDeDepartamento, TCCCE.NumeroDeProceso, TCCCE.Piso, TCCCE.Puerta, TCCCE.SecuenciaDeTargeta,concat('CF',TCCCE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TCCCE.SucursalDeRadicacionDeLaCuenta, TCCCE.Telefono, TCCCE.TipoDeOperacion, TCCCE.TipoDeTarjeta, TCCCE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasConChipEMV as TCCCE
			union
			select TCCSE.Blancos
			,TCCSE.Calle, TCCSE.CardCarrier, TCCSE.Categoria, TCCSE.CodigoDeEntrega, TCCSE.CodigoPostal, TCCSE.DenominacionDelUsuario, TCCSE.FechaDeAlta, TCCSE.FechaDeCargaSistemaFlash, TCCSE.FechaDeEmbozado, TCCSE.FechaHasta, TCCSE.GrupoDeAfinidad, TCCSE.Id, TCCSE.InterfazDeTarjeta, TCCSE.Localidad, TCCSE.NumeroDeComprobante, TCCSE.NumeroDeCuenta, TCCSE.NumeroDeDepartamento, TCCSE.NumeroDeProceso, TCCSE.Piso, TCCSE.Puerta, TCCSE.SecuenciaDeTargeta,concat('CF',TCCSE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TCCSE.SucursalDeRadicacionDeLaCuenta, TCCSE.Telefono, TCCSE.TipoDeOperacion, TCCSE.TipoDeTarjeta, TCCSE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasConChipEMVSinCab as TCCSE
			union
			select TSCCE.Blancos
			,TSCCE.Calle, TSCCE.CardCarrier, TSCCE.Categoria, TSCCE.CodigoDeEntrega, TSCCE.CodigoPostal, TSCCE.DenominacionDelUsuario, TSCCE.FechaDeAlta, TSCCE.FechaDeCargaSistemaFlash, TSCCE.FechaDeEmbozado, TSCCE.FechaHasta, TSCCE.GrupoDeAfinidad, TSCCE.Id, '' as InterfazDeTarjeta, TSCCE.Localidad, TSCCE.NumeroDeComprobante, TSCCE.NumeroDeCuenta, TSCCE.NumeroDeDepartamento, TSCCE.NumeroDeProceso, TSCCE.Piso, TSCCE.Puerta, TSCCE.SecuenciaDeTargeta,concat('CF',TSCCE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TSCCE.SucursalDeRadicacionDeLaCuenta, TSCCE.Telefono, TSCCE.TipoDeOperacion, TSCCE.TipoDeTarjeta, TSCCE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasSinChipEMV as TSCCE
			union
			select TSCSE.Blancos
			,TSCSE.Calle, TSCSE.CardCarrier, TSCSE.Categoria, TSCSE.CodigoDeEntrega, TSCSE.CodigoPostal, TSCSE.DenominacionDelUsuario, TSCSE.FechaDeAlta, TSCSE.FechaDeCargaSistemaFlash, TSCSE.FechaDeEmbozado, TSCSE.FechaHasta, TSCSE.GrupoDeAfinidad, TSCSE.Id, '' as InterfazDeTarjeta, TSCSE.Localidad, TSCSE.NumeroDeComprobante, TSCSE.NumeroDeCuenta, TSCSE.NumeroDeDepartamento, TSCSE.NumeroDeProceso, TSCSE.Piso, TSCSE.Puerta, TSCSE.SecuenciaDeTargeta,concat('CF',TSCSE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TSCSE.SucursalDeRadicacionDeLaCuenta, TSCSE.Telefono, TSCSE.TipoDeOperacion, TSCSE.TipoDeTarjeta, TSCSE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasSinChipEMVSinCab as TSCSE
		) as BancoGrabadas on  E.BarcodeExterno = BancoGrabadas.SecuenciaDeTargetaComparar
		inner JOIN sispoc5_gestionpostal.flash_piezas as fp on E.BarcodeExterno = fp.barcode_externo
		inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on  fci.id = fp.comprobante_ingreso_id
		left JOIN sispoc5_Ocasa.VinculoDestinatario as VCD on VCD.id = E.IdVinculo
		WHERE
		E.Fecha >= '$FechaI' AND E.Fecha < '$FechaF' AND E.BarcodeExterno like 'cf%'
		
		union
		
		SELECT fp.id as 'PIEZANUME'
		,fp.destinatario as 'DESTINATARIO'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
		,case  
		when EP.Codigo = '13' then EP.Estado
		when EP.Codigo = '14' then EP.Estado
		when EP.Codigo = 'Z4' then EP.Estado
		when EP.Codigo = '21' then EP.Estado
		else 'SOL'
		end as 'ESTADOCODI'
		,BancoGrabadas.SecuenciaDeTargeta as  'PIEZACLIENTENUME'
		,fp.domicilio as 'DOMICILIO'
		,fp.codigo_postal as 'CODPOSTAL'
		,fp.localidad as 'CIUDAD'
        ,FPN.update + INTERVAL + 0 HOUR as 'FECHANOVEDAD' #$DiferenciaHoraria
        #,FPN.update + INTERVAL + 5  HOUR as 'FECHANOVEDAD' 
		,'1' as 'VISITA'
		,case  
		when EP.Codigo = '13' then EP.Codigo
		when EP.Codigo = '14' then EP.Codigo
		when EP.Codigo = 'Z4' then EP.Codigo
		when EP.Codigo = '21' then EP.Codigo
		else ''
		end as 'MOTIVOCODI'
		,case  
		when EP.Codigo = '13' then '2'
		when EP.Codigo = '14' then '3'
		when EP.Codigo = 'Z4' then '3'
		when EP.Codigo = '21' then '2'
		else '4'
		end as 'Orden'
		
        ,'' as 'RECEPTOR'
        ,'' as 'DOCUNUME'
        ,'' as 'VINCULO'
		,case  
			when EP.Codigo = '13' then ''
			when EP.Codigo = '14' then ''
			when EP.Codigo = 'Z4' then ''
			when EP.Codigo = '21' then ''
			else concat('CF',right(1000000+(DATEDIFF(FPN.update,'2019-12-17')),5),right(1000000+BancoGrabadas.SucursalDeRadicacionDeLaCuenta,3))
			#concat('FLASH',BancoGrabadas.LoteImpreso)
			
		end as 'CARTERENDICION'
		,fci.create as 'FECHACARTARENDICION'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHARETIRO'
		,'VISA' as 'MATERIAL' 
		,BancoGrabadas.SucursalDeRadicacionDeLaCuenta as 'SUCURCODI'
		,'' as 'SUCURDESCRI'
		FROM sispoc5_gestionpostal.flash_piezas as fp
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on fci.id = fp.comprobante_ingreso_id and fci.cliente_id = '30'
        inner join sispoc5_gestionpostal.flash_clientes as Cliente on fci.cliente_id = Cliente.id
        #inner join sispoc5_gestionpostal.flash_piezas_novedades as FPN on fp.id = FPN.pieza_id and FPN.update >= '2019-12-19' and FPN.update < '2019-12-20'
		inner join sispoc5_gestionpostal.flash_piezas_novedades as FPN on fp.id = FPN.pieza_id and FPN.update >= '$FechaI' and FPN.update < '$FechaF'
		INNER JOIN sispoc5_gestionpostal.flash_piezas_estados_variables as PEV on FPN.estado_nuevo_id = PEV.id
		INNER JOIN sispoc5_Ocasa.EstadoEntregaAppGestionPostal as EEAGP on PEV.id = EEAGP.IdEstadoEntregaGestionPostal
        inner JOIN sispoc5_Ocasa.EstadoEntregaApp as EEA on EEAGP.IdEstadoEntregaApp = EEA.id and (EEA.id <> '8' AND EEA.id <> '13' AND EEA.id <> '12' AND EEA.id <> '46')
		
		inner JOIN sispoc5_Banco.EstadoVisa as EV on EEA.idEstado = EV.IdApp
		inner JOIN sispoc5_Banco.EstadosPlasticos as EP on EV.IdPlasticos = EP.Id
		inner JOIN 
		(
			select TCCCE.Blancos
			,TCCCE.Calle, TCCCE.CardCarrier, TCCCE.Categoria, TCCCE.CodigoDeEntrega, TCCCE.CodigoPostal,TCCCE.DenominacionDelUsuario, TCCCE.FechaDeAlta, TCCCE.FechaDeCargaSistemaFlash, TCCCE.FechaDeEmbozado, TCCCE.FechaHasta, TCCCE.GrupoDeAfinidad, TCCCE.Id, TCCCE.InterfazDeTarjeta, TCCCE.Localidad, TCCCE.NumeroDeComprobante, TCCCE.NumeroDeCuenta, TCCCE.NumeroDeDepartamento, TCCCE.NumeroDeProceso, TCCCE.Piso, TCCCE.Puerta, TCCCE.SecuenciaDeTargeta,concat('CF',TCCCE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TCCCE.SucursalDeRadicacionDeLaCuenta, TCCCE.Telefono, TCCCE.TipoDeOperacion, TCCCE.TipoDeTarjeta, TCCCE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasConChipEMV as TCCCE
			union
			select TCCSE.Blancos
			,TCCSE.Calle, TCCSE.CardCarrier, TCCSE.Categoria, TCCSE.CodigoDeEntrega, TCCSE.CodigoPostal, TCCSE.DenominacionDelUsuario, TCCSE.FechaDeAlta, TCCSE.FechaDeCargaSistemaFlash, TCCSE.FechaDeEmbozado, TCCSE.FechaHasta, TCCSE.GrupoDeAfinidad, TCCSE.Id, TCCSE.InterfazDeTarjeta, TCCSE.Localidad, TCCSE.NumeroDeComprobante, TCCSE.NumeroDeCuenta, TCCSE.NumeroDeDepartamento, TCCSE.NumeroDeProceso, TCCSE.Piso, TCCSE.Puerta, TCCSE.SecuenciaDeTargeta,concat('CF',TCCSE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TCCSE.SucursalDeRadicacionDeLaCuenta, TCCSE.Telefono, TCCSE.TipoDeOperacion, TCCSE.TipoDeTarjeta, TCCSE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasConChipEMVSinCab as TCCSE
			union
			select TSCCE.Blancos
			,TSCCE.Calle, TSCCE.CardCarrier, TSCCE.Categoria, TSCCE.CodigoDeEntrega, TSCCE.CodigoPostal, TSCCE.DenominacionDelUsuario, TSCCE.FechaDeAlta, TSCCE.FechaDeCargaSistemaFlash, TSCCE.FechaDeEmbozado, TSCCE.FechaHasta, TSCCE.GrupoDeAfinidad, TSCCE.Id, '' as InterfazDeTarjeta, TSCCE.Localidad, TSCCE.NumeroDeComprobante, TSCCE.NumeroDeCuenta, TSCCE.NumeroDeDepartamento, TSCCE.NumeroDeProceso, TSCCE.Piso, TSCCE.Puerta, TSCCE.SecuenciaDeTargeta,concat('CF',TSCCE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TSCCE.SucursalDeRadicacionDeLaCuenta, TSCCE.Telefono, TSCCE.TipoDeOperacion, TSCCE.TipoDeTarjeta, TSCCE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasSinChipEMV as TSCCE
			union
			select TSCSE.Blancos
			,TSCSE.Calle, TSCSE.CardCarrier, TSCSE.Categoria, TSCSE.CodigoDeEntrega, TSCSE.CodigoPostal, TSCSE.DenominacionDelUsuario, TSCSE.FechaDeAlta, TSCSE.FechaDeCargaSistemaFlash, TSCSE.FechaDeEmbozado, TSCSE.FechaHasta, TSCSE.GrupoDeAfinidad, TSCSE.Id, '' as InterfazDeTarjeta, TSCSE.Localidad, TSCSE.NumeroDeComprobante, TSCSE.NumeroDeCuenta, TSCSE.NumeroDeDepartamento, TSCSE.NumeroDeProceso, TSCSE.Piso, TSCSE.Puerta, TSCSE.SecuenciaDeTargeta,concat('CF',TSCSE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TSCSE.SucursalDeRadicacionDeLaCuenta, TSCSE.Telefono, TSCSE.TipoDeOperacion, TSCSE.TipoDeTarjeta, TSCSE.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasSinChipEMVSinCab as TSCSE
		) as BancoGrabadas on fp.barcode_externo = BancoGrabadas.SecuenciaDeTargetaComparar
		inner JOIN sispoc5_Ocasa.VinculoDestinatario as VCD on VCD.id = '1'
		WHERE
        FPN.update >= '$FechaI' and FPN.update < '$FechaF' AND fp.barcode_externo like '%cf%'
        #FPN.update >= '2019-12-19' and FPN.update < '2019-12-20' AND fp.barcode_externo like '%cf%'
		
		union
		
		SELECT fp.id as 'PIEZANUME'
		,fp.destinatario as 'DESTINATARIO'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
		,'ODP' as 'ESTADOCODI'
		,BancoGrabadas.SecuenciaDeTargeta as  'PIEZACLIENTENUME'
		,fp.domicilio as 'DOMICILIO'
		,fp.codigo_postal as 'CODPOSTAL'
		,fp.localidad as 'CIUDAD'
		,PSpp.FechaDeEstado as 'FECHANOVEDAD'
		,' ' as 'VISITA'
		,''  as 'MOTIVOCODI'
		,'1' as 'Orden'
		,'' as 'RECEPTOR'
		,'' as 'DOCUNUME'
		,'' as 'VINCULO'
		,''  as 'CARTERENDICION' #,concat('FLASH',BancoGrabadas.LoteImpreso) as 'CARTERENDICION'
		,fci.create as 'FECHACARTARENDICION'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHARETIRO'
		,'VISA' as 'MATERIAL' 
		,BancoGrabadas.SucursalDeRadicacionDeLaCuenta as'SUCURCODI'
		,'' as 'SUCURDESCRI'
		FROM sispoc5_Ocasa.PiezasSpp as PSpp
		inner JOIN 
			(
				select TCCCE.Blancos
				,TCCCE.Calle, TCCCE.CardCarrier, TCCCE.Categoria, TCCCE.CodigoDeEntrega, TCCCE.CodigoPostal, TCCCE.DenominacionDelUsuario, TCCCE.FechaDeAlta, TCCCE.FechaDeCargaSistemaFlash, TCCCE.FechaDeEmbozado, TCCCE.FechaHasta, TCCCE.GrupoDeAfinidad, TCCCE.Id, TCCCE.InterfazDeTarjeta, TCCCE.Localidad, TCCCE.NumeroDeComprobante, TCCCE.NumeroDeCuenta, TCCCE.NumeroDeDepartamento, TCCCE.NumeroDeProceso, TCCCE.Piso, TCCCE.Puerta, TCCCE.SecuenciaDeTargeta,concat('CF',TCCCE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TCCCE.SucursalDeRadicacionDeLaCuenta, TCCCE.Telefono, TCCCE.TipoDeOperacion, TCCCE.TipoDeTarjeta, TCCCE.LoteImpreso as 'LoteImpreso'
				FROM sispoc5_Banco.TarjetasConChipEMV as TCCCE
				union
				select TCCSE.Blancos
				,TCCSE.Calle, TCCSE.CardCarrier, TCCSE.Categoria, TCCSE.CodigoDeEntrega, TCCSE.CodigoPostal, TCCSE.DenominacionDelUsuario, TCCSE.FechaDeAlta, TCCSE.FechaDeCargaSistemaFlash, TCCSE.FechaDeEmbozado, TCCSE.FechaHasta, TCCSE.GrupoDeAfinidad, TCCSE.Id, TCCSE.InterfazDeTarjeta, TCCSE.Localidad, TCCSE.NumeroDeComprobante, TCCSE.NumeroDeCuenta, TCCSE.NumeroDeDepartamento, TCCSE.NumeroDeProceso, TCCSE.Piso, TCCSE.Puerta, TCCSE.SecuenciaDeTargeta,concat('CF',TCCSE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TCCSE.SucursalDeRadicacionDeLaCuenta, TCCSE.Telefono, TCCSE.TipoDeOperacion, TCCSE.TipoDeTarjeta, TCCSE.LoteImpreso as 'LoteImpreso'
				FROM sispoc5_Banco.TarjetasConChipEMVSinCab as TCCSE
				union
				select TSCCE.Blancos
				,TSCCE.Calle, TSCCE.CardCarrier, TSCCE.Categoria, TSCCE.CodigoDeEntrega, TSCCE.CodigoPostal, TSCCE.DenominacionDelUsuario, TSCCE.FechaDeAlta, TSCCE.FechaDeCargaSistemaFlash, TSCCE.FechaDeEmbozado, TSCCE.FechaHasta, TSCCE.GrupoDeAfinidad, TSCCE.Id, '' as InterfazDeTarjeta, TSCCE.Localidad, TSCCE.NumeroDeComprobante, TSCCE.NumeroDeCuenta, TSCCE.NumeroDeDepartamento, TSCCE.NumeroDeProceso, TSCCE.Piso, TSCCE.Puerta, TSCCE.SecuenciaDeTargeta,concat('CF',TSCCE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TSCCE.SucursalDeRadicacionDeLaCuenta, TSCCE.Telefono, TSCCE.TipoDeOperacion, TSCCE.TipoDeTarjeta, TSCCE.LoteImpreso as 'LoteImpreso'
				FROM sispoc5_Banco.TarjetasSinChipEMV as TSCCE
				union
				select TSCSE.Blancos
				,TSCSE.Calle, TSCSE.CardCarrier, TSCSE.Categoria, TSCSE.CodigoDeEntrega, TSCSE.CodigoPostal, TSCSE.DenominacionDelUsuario, TSCSE.FechaDeAlta, TSCSE.FechaDeCargaSistemaFlash, TSCSE.FechaDeEmbozado, TSCSE.FechaHasta, TSCSE.GrupoDeAfinidad, TSCSE.Id, '' as InterfazDeTarjeta, TSCSE.Localidad, TSCSE.NumeroDeComprobante, TSCSE.NumeroDeCuenta, TSCSE.NumeroDeDepartamento, TSCSE.NumeroDeProceso, TSCSE.Piso, TSCSE.Puerta, TSCSE.SecuenciaDeTargeta,concat('CF',TSCSE.SecuenciaDeTargeta) as 'SecuenciaDeTargetaComparar', TSCSE.SucursalDeRadicacionDeLaCuenta, TSCSE.Telefono, TSCSE.TipoDeOperacion, TSCSE.TipoDeTarjeta, TSCSE.LoteImpreso as 'LoteImpreso'
				FROM sispoc5_Banco.TarjetasSinChipEMVSinCab as TSCSE
			) as BancoGrabadas on  PSpp.Barcode = BancoGrabadas.SecuenciaDeTargetaComparar
		inner JOIN sispoc5_gestionpostal.flash_piezas as fp on PSpp.Barcode = fp.barcode_externo and PSpp.Barcode not like ''
		inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on  fci.id = fp.comprobante_ingreso_id
		WHERE
		#PSpp.FechaDeEstado >= '2019-01-01' AND PSpp.FechaDeEstado < '2020-01-01' AND PSpp.Barcode like '%cf%'
		PSpp.FechaDeEstado >= '$FechaI' AND PSpp.FechaDeEstado < '$FechaF' AND PSpp.Barcode like '%cf%'
		
	) as Orden
	#order by Orden.Orden asc
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$ResultadoAnterior = true;
		$contador = $ClaseMaster->ArraydResultados[0][0];
		//echo($ClaseMaster->ArraydResultados[0][0]);
	}
	//print_r($Consulta);exit;
	
	$Consulta= "
	select count(*) AS 'Contador'
	FROM  (
		
		SELECT fp.id as 'PIEZANUME'
		,fp.destinatario as 'DESTINATARIO'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
		#,EO.ESTADOCODI  as 'ESTADOCODI'
		#,EP.Estado as 'ESTADOCODI'
		,case  
		when EP.Codigo = '13' then EP.Estado
		when EP.Codigo = '14' then EP.Estado
		when EP.Codigo = 'Z4' then EP.Estado
		when EP.Codigo = '21' then EP.Estado
		when EP.Codigo = '' then EP.Estado
		else 'SOL'
		end as 'ESTADOCODI'
		#,concat('CF',BancoGrabadas.SecuenciaDeTargeta)  as  'PIEZACLIENTENUME'
		,concat('0',BancoGrabadas.SecuenciaDeTargeta) as  'PIEZACLIENTENUME'
		,fp.domicilio as 'DOMICILIO'
		,fp.codigo_postal as 'CODPOSTAL'
		,fp.localidad as 'CIUDAD'
		,E.Fecha  + INTERVAL + $DiferenciaHoraria HOUR as 'FECHANOVEDAD'#$DiferenciaHoraria
		,'1' as 'VISITA'
		,case  
		when EP.Codigo = '13' then EP.Codigo
		when EP.Codigo = '14' then EP.Codigo
		when EP.Codigo = 'Z4' then EP.Codigo
		when EP.Codigo = '21' then EP.Codigo
		else ''
		end as 'MOTIVOCODI'
		,case  
		when EP.Codigo = '13' then '2'
		when EP.Codigo = '14' then '3'
		when EP.Codigo = 'Z4' then '3'
		when EP.Codigo = '21' then '2'
		else '4'
		end as 'Orden'
		#,EP.Codigo  as 'MOTIVOCODI'
		#,EO.codigo as 'MOTIVOCODI'
		,case  
		when E.idEstados = 8 then E.ApellidoNombreRecibio
		else ''
		end as 'RECEPTOR'
		,case  
		when E.idEstados = 8 then E.Documento
		else ''
		end as 'DOCUNUME'
		,case  
		when E.idEstados = 8 then VCD.Nombre
		else ''
		end as 'VINCULO'
		,case  
			when EP.Codigo = '13' then ''
			when EP.Codigo = '14' then ''
			when EP.Codigo = 'Z4' then ''
			when EP.Codigo = '21' then ''
			else concat('CF',right(1000000+(DATEDIFF(E.Fecha,'2019-12-17')),5),right(1000000+BancoGrabadas.SucursalDeRadicacionDeLaCuenta,3))
				#concat('FLASH',BancoGrabadas.LoteImpreso)
		end as 'CARTERENDICION'
		#,concat('FLASH',BancoGrabadas.SucursalDeRadicacionDeLaCuenta) as 'CARTERENDICION'
		,fci.create as 'FECHACARTARENDICION'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHARETIRO'
		,'MASTER' as 'MATERIAL' 
		,BancoGrabadas.SucursalDeRadicacionDeLaCuenta as'SUCURCODI'
		,'' as 'SUCURDESCRI'
		FROM sispoc5_Ocasa.Piezas_Estados as E
		
		inner JOIN sispoc5_Ocasa.EstadoEntregaApp as EEA on E.idEstados = EEA.id  and (EEA.id = '8' or EEA.id = '13' or EEA.id = '12' or EEA.id = '46')
		
		inner JOIN sispoc5_Banco.EstadoVisa as EV on EEA.idEstado = EV.IdApp
		inner JOIN sispoc5_Banco.EstadosPlasticos as EP on EV.IdPlasticos = EP.Id
		
		#inner JOIN sispoc5_Ocasa.EstadoEntregaAppOcasa as EEAO on EEAO.IdEstadoEntregaApp = E.idEstados
		#inner join sispoc5_Ocasa.EstadosOcasa as EO on EEAO.IdEstadoOcasa = EO.id
		inner JOIN 
		(
            SELECT Impresas.FechaDeCargaSistemaFlash as 'FechaDeCargaSistemaFlash', Impresas.NumeroDeTarjeta as 'SecuenciaDeTargeta',concat('CF',Impresas.NumeroDeTarjeta) as 'SecuenciaDeTargetaComparar', Impresas.CodigoDeLaSucursal as 'SucursalDeRadicacionDeLaCuenta', Impresas.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasImpresas as Impresas
		) as BancoGrabadas on  E.BarcodeExterno = BancoGrabadas.SecuenciaDeTargetaComparar #BancoGrabadas.SecuenciaDeTargetaComparar
		inner JOIN sispoc5_gestionpostal.flash_piezas as fp on E.BarcodeExterno = fp.barcode_externo
		inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on  fci.id = fp.comprobante_ingreso_id
		left JOIN sispoc5_Ocasa.VinculoDestinatario as VCD on VCD.id = E.IdVinculo
		WHERE
		#E.Fecha >= '2001-01-01' AND E.Fecha < '2020-01-01' AND E.BarcodeExterno like '%cf%'
		E.Fecha >= '$FechaI' AND E.Fecha < '$FechaF' AND E.BarcodeExterno like '%cf%'
        #and BancoGrabadas.SecuenciaDeTargeta like '%05502302004023802'
		
		union
		
		SELECT fp.id as 'PIEZANUME'
		,fp.destinatario as 'DESTINATARIO'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
		,case  
		when EP.Codigo = '13' then EP.Estado
		when EP.Codigo = '14' then EP.Estado
		when EP.Codigo = 'Z4' then EP.Estado
		when EP.Codigo = '21' then EP.Estado
		else 'SOL'
		end as 'ESTADOCODI'
		,BancoGrabadas.SecuenciaDeTargeta as  'PIEZACLIENTENUME'
		,fp.domicilio as 'DOMICILIO'
		,fp.codigo_postal as 'CODPOSTAL'
		,fp.localidad as 'CIUDAD'
		,FPN.update + INTERVAL + 0 HOUR as 'FECHANOVEDAD' #$DiferenciaHoraria
        #,FPN.update + INTERVAL + 5  HOUR as 'FECHANOVEDAD' 
		,'1' as 'VISITA'
		,case  
		when EP.Codigo = '13' then EP.Codigo
		when EP.Codigo = '14' then EP.Codigo
		when EP.Codigo = 'Z4' then EP.Codigo
		when EP.Codigo = '21' then EP.Codigo
		else ''
		end as 'MOTIVOCODI'
		,case  
		when EP.Codigo = '13' then '2'
		when EP.Codigo = '14' then '3'
		when EP.Codigo = 'Z4' then '3'
		when EP.Codigo = '21' then '2'
		else '4'
		end as 'Orden'
        ,'' as 'RECEPTOR'
        ,'' as 'DOCUNUME'
        ,'' as 'VINCULO'
		,case  
			when EP.Codigo = '13' then ''
			when EP.Codigo = '14' then ''
			when EP.Codigo = 'Z4' then ''
			when EP.Codigo = '21' then ''
			else concat('CF',right(1000000+(DATEDIFF(FPN.update,'2019-12-17')),5),right(1000000+BancoGrabadas.SucursalDeRadicacionDeLaCuenta,3))
				#concat('FLASH',BancoGrabadas.LoteImpreso)
		end as 'CARTERENDICION'
		,fci.create as 'FECHACARTARENDICION'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHARETIRO'
		,'MASTER' as 'MATERIAL' 
		,BancoGrabadas.SucursalDeRadicacionDeLaCuenta as'SUCURCODI'
		,'' as 'SUCURDESCRI'
		FROM sispoc5_gestionpostal.flash_piezas as fp
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on fci.id = fp.comprobante_ingreso_id and fci.cliente_id = '30'
        inner join sispoc5_gestionpostal.flash_clientes as Cliente on fci.cliente_id = Cliente.id
        #inner join sispoc5_gestionpostal.flash_piezas_novedades as FPN on fp.id = FPN.pieza_id and FPN.update >= '2019-12-19' and FPN.update < '2019-12-20'
		inner join sispoc5_gestionpostal.flash_piezas_novedades as FPN on fp.id = FPN.pieza_id and FPN.update >= '$FechaI' and FPN.update < '$FechaF'
        
		INNER JOIN sispoc5_gestionpostal.flash_piezas_estados_variables as PEV on FPN.estado_nuevo_id = PEV.id
		INNER JOIN sispoc5_Ocasa.EstadoEntregaAppGestionPostal as EEAGP on PEV.id = EEAGP.IdEstadoEntregaGestionPostal
        inner JOIN sispoc5_Ocasa.EstadoEntregaApp as EEA on EEAGP.IdEstadoEntregaApp = EEA.id and (EEA.id <> '8' AND EEA.id <> '13' AND EEA.id <> '12' AND EEA.id <> '46)
		
		inner JOIN sispoc5_Banco.EstadoVisa as EV on EEA.idEstado = EV.IdApp
		inner JOIN sispoc5_Banco.EstadosPlasticos as EP on EV.IdPlasticos = EP.Id
		inner JOIN 
		(
			SELECT Impresas.FechaDeCargaSistemaFlash as 'FechaDeCargaSistemaFlash', Impresas.NumeroDeTarjeta as 'SecuenciaDeTargeta',concat('CF',Impresas.NumeroDeTarjeta) as 'SecuenciaDeTargetaComparar', Impresas.CodigoDeLaSucursal as 'SucursalDeRadicacionDeLaCuenta', Impresas.LoteImpreso as 'LoteImpreso'
			FROM sispoc5_Banco.TarjetasImpresas as Impresas
		) as BancoGrabadas on  fp.barcode_externo = BancoGrabadas.SecuenciaDeTargetaComparar
		inner JOIN sispoc5_Ocasa.VinculoDestinatario as VCD on VCD.id = '1'
		WHERE
		FPN.update >= '$FechaI' and FPN.update < '$FechaF' AND fp.barcode_externo like '%cf%'
        #FPN.update >= '2019-12-19' and FPN.update < '2019-12-20' AND fp.barcode_externo like '%cf%'
		
        union
		
		SELECT fp.id as 'PIEZANUME'
		,fp.destinatario as 'DESTINATARIO'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHAIMPOSICION'
		,'ODP' as 'ESTADOCODI'
		,concat('0',BancoGrabadas.SecuenciaDeTargeta) as  'PIEZACLIENTENUME'
		,fp.domicilio as 'DOMICILIO'
		,fp.codigo_postal as 'CODPOSTAL'
		,fp.localidad as 'CIUDAD'
		,PSpp.FechaDeEstado as 'FECHANOVEDAD'
		,' ' as 'VISITA'
		,''  as 'MOTIVOCODI'
		,'1' as 'Orden'
		,'' as 'RECEPTOR'
		,'' as 'DOCUNUME'
		,'' as 'VINCULO'
		,'' as 'CARTERENDICION'
		#,concat('FLASH',BancoGrabadas.SucursalDeRadicacionDeLaCuenta) as 'CARTERENDICION'
		,fci.create as 'FECHACARTARENDICION'
		,BancoGrabadas.FechaDeCargaSistemaFlash as 'FECHARETIRO'
		,'MASTER' as 'MATERIAL' 
		,BancoGrabadas.SucursalDeRadicacionDeLaCuenta as'SUCURCODI'
		,'' as 'SUCURDESCRI'

		FROM sispoc5_Ocasa.PiezasSpp as PSpp
		inner JOIN 
			(
				#select TCCCE.FechaDeCargaSistemaFlash, TCCCE.SecuenciaDeTargeta, TCCCE.SucursalDeRadicacionDeLaCuenta
                #FROM sispoc5_Banco.TarjetasConChipEMV as TCCCE
                #UNION
                #select TCCSE.FechaDeCargaSistemaFlash, TCCSE.SecuenciaDeTargeta, TCCSE.SucursalDeRadicacionDeLaCuenta
                #FROM sispoc5_Banco.TarjetasConChipEMVSinCab as TCCSE
                #UNION
                #select TSCCE.FechaDeCargaSistemaFlash, TSCCE.SecuenciaDeTargeta, TSCCE.SucursalDeRadicacionDeLaCuenta
                #FROM sispoc5_Banco.TarjetasSinChipEMV as TSCCE
                #UNION
                #select TSCSE.FechaDeCargaSistemaFlash, TSCSE.SucursalDeRadicacionDeLaCuenta, TSCSE.SecuenciaDeTargeta
                #FROM sispoc5_Banco.TarjetasSinChipEMVSinCab as TSCSE
				#union
				
				SELECT Impresas.FechaDeCargaSistemaFlash as 'FechaDeCargaSistemaFlash', Impresas.NumeroDeTarjeta as 'SecuenciaDeTargeta',concat('CF',Impresas.NumeroDeTarjeta) as 'SecuenciaDeTargetaComparar', Impresas.CodigoDeLaSucursal as 'SucursalDeRadicacionDeLaCuenta', Impresas.LoteImpreso as 'LoteImpreso'
				FROM sispoc5_Banco.TarjetasImpresas as Impresas
			) as BancoGrabadas on  PSpp.Barcode = BancoGrabadas.SecuenciaDeTargetaComparar and PSpp.Barcode not like ''
		inner JOIN sispoc5_gestionpostal.flash_piezas as fp on PSpp.Barcode = fp.barcode_externo
		inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos as fci on  fci.id = fp.comprobante_ingreso_id
		WHERE
		#PSpp.FechaDeEstado >= '2001-01-01' AND PSpp.FechaDeEstado < '2020-01-01' AND PSpp.Barcode like '%cf%'
		PSpp.FechaDeEstado >= '$FechaI' AND PSpp.FechaDeEstado < '$FechaF' AND PSpp.Barcode like '%cf%'
	) as Orden
	#order by Orden.Orden asc
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		if($ResultadoAnterior){
			$contador = $contador + $ClaseMaster->ArraydResultados[0][0];
		}
		echo($contador);
	}
	
?>













