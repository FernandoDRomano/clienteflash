<?php
 //	echo("Suses");
 //	exit;
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
	$FechaIServer = date('Y-m-d H:i:s', strtotime($FechaI . ' - ' . $DiferenciaHoraria . ' hour') );
	$FechaFServer = date('Y-m-d H:i:s', strtotime($FechaF . ' - ' . $DiferenciaHoraria . ' hour') );
	
	//echo($FechaI . " " . $FechaF);exit;
	//$DiferenciaHoraria
	
	$Desde = $FechaI;
	$Hasta = $FechaF;
	
	$ComprobanteDeIngreso = issetornull('ComprobanteDeIngreso');
	$UserId = issetornull('UserId');
	$BarcodeExterno = issetornull('BarcodeExterno');
	$Documento = issetornull('Documento');
	$ApellidoYNombre = issetornull('ApellidoYNombre');
	$IdPieza = issetornull('IdPieza');
	
	
	$RealDesde = issetornull('FechaI');
	if($RealDesde != ''){
		$RealDesde = str_replace('/', '-', $RealDesde).':00';
		$RealDesde = date('Y-m-d H:i:s', strtotime($RealDesde . '') );
		//$Desde = date('Y-m-d', strtotime($Desde ) );
	}
	$RealHasta = issetornull('FechaF');
	if($RealHasta != ''){
		$RealHasta = str_replace('/', '-', $RealHasta).':00';
		$RealHasta = date('Y-m-d H:i:s', strtotime($RealHasta . '') );
		//$Hasta = date('Y-m-d', strtotime($Hasta ) );
	}
	$Destinatario = $ApellidoYNombre;
	$DNIBusqueda = $Documento;
	$NumeroDePieza = $BarcodeExterno;
	/*
		,"RemitenteNombre","RemitenteApellido", "RemitenteCodigoPostal","RemitenteProvincia"
		,"RemitenteLocalidad","RemitenteCalle","RemitenteNumero","RemitentePiso","RemitenteDepartamento"
		,"DestinatarioNombre","DestinatarioApellido","DestinatarioCodigoPostal","DestinatarioProvincia","DestinatarioLocalidad"
		,"DestinatarioCalle","DestinatarioNumero","DestinatarioPiso","DestinatarioDepartamento","RemitenteEmail"
		,"RemitenteCelular","RemitenteObservaciones","ApoderadoNombre","ApoderadoApellido","ApoderadoDNITipo"
		,"ApoderadoDocumento","ApoderadoFirma","Formulario","URLPDF"
	*/
	
	$Columnas = array("ClienteId");
	$Consulta = "
		SELECT cfc.SispoId as 'ClienteId'
		from sispoc5_correoflash.cliente  as cfc
		where cfc.Id = '$UserId'
    ";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$UserId = $ClaseMaster->ArraydResultados[0][0];
	}else{
		exit;
	}
	
	$Columnas = array("Fecha Ingreso","Identificador","Numero De Pieza","Servicio","Destinatario","DNI"
	,"Codigo_postal","Localidad","Estado","Fecha De Estado","Estados Historicos","Dirección de Entrega","Apellido Nombre Recibio","Vinculo Con Destinatario","FotoEnCalle","FotoHD","datos_varios_3"
	);
	$Consulta = "
		
		SELECT
		pe.idPieza as 'Identificador'
		,pe.BarcodeExterno as 'Id'
		,pe.BarcodeExterno as 'Numero De Pieza'


	
	
		,case 
			when pe.datos_varios_3 not like ''
			then pe.datos_varios_3
			else Piezas.datos_varios_3
			end as 'datos_varios_3'
		
		,case 
			when pe.Sub > '1'
			then pe.destinatario
			else Piezas.destinatario
			end as 'Destinatario'
			
		,case 
			when pe.Sub > '1'
			then pe.Domicilio
			else Piezas.domicilio
			end as 'Dirección de Entrega'
			
		,case 
			when pe.Sub > '1'
			then pe.CodigoPostal
			else Piezas.codigo_postal
			end as 'Codigo_postal'
		
		,case 
			when pe.Sub > '1'
			then pe.Localidad
			else Piezas.localidad
			end as 'Localidad'
		
		,CASE pe.idEstados
			WHEN 'X01' THEN 'Logico Recibido'
			WHEN 'Fisico' THEN 'Fisico Recibido'
			WHEN '0' THEN 'Hoja De Ruta Aceptada Por Catero'
			ELSE EE.NombreAPP
		END as 'Estado'
		,pe.Estados as 'Estados Historicos'
		,Piezas.documento as 'DNI'
        ,'Domicilio' as 'Destino'
		,case 
			when pe.Sub > '1'
			then 'Sin Ingreso Fisico'
			else Piezas.create
			end as 'Fecha Ingreso'
		,case 
			when pe.Sub > '1'
			then pe.Servicio
			else fs.nombre
			end as 'Servicio'
        ,$UserId
        ,DATE_ADD(pe.Fecha, INTERVAL 0 HOUR) as 'Fecha De Estado'
		, CASE pe.idEstados
			WHEN '8' THEN pe.ApellidoNombreRecibio
			ELSE ''
		END as 'Apellido Nombre Recibio'
		, CASE pe.idEstados
			WHEN '8' THEN VD.Nombre
			ELSE ''
		END as 'Vinculo Con Destinatario'
		,CASE 
			WHEN pe.FotoAndroid not like '' THEN concat('', pe.FotoAndroid)#http://sispo.com.ar/zonificacion/Android/Acusses/
			ELSE ''
		END as 'FotoEnCalle'
		,CASE 
			WHEN pe.FotoEscaner not like '' THEN concat('', pe.FotoEscaner)#http://sispo.com.ar/clienteflash/XMLHttpRequest/EstadosManuales/uploads/
			ELSE ''
		END as 'FotoHD'
		FROM 
		(
			select count(pe.id) as 'Estados', pe.* 
            from 
            (
				
                select *
				from
				(
				select pe.idVinculo as 'idVinculo'
				, Piezas.destinatario as 'Destinatario'
				, '' as 'CodigoPostal'
				, '' as 'Localidad'
				, '' as 'Domicilio'
                ,pe.id as 'id'
				, pe.idEstados as 'idEstados' 
				, pe.idPieza as 'idPieza'
				, DATE_ADD(pe.Fecha, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, pe.BarcodeExterno as 'BarcodeExterno'
				, pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
				, pe.Documento as 'Documento'
				, '1' as 'Sub'
				, '' as 'Servicio'
				,CASE 
					WHEN pe.FotoDeAcuse not like ''
						THEN pe.FotoDeAcuse
					ELSE ''
				END as 'FotoAndroid'
				,CASE 
					WHEN pe.FotoDeAcuseWeb not like '' 
						THEN pe.FotoDeAcuseWeb
					ELSE ''
				END as 'FotoEscaner'
			    ,Piezas.datos_varios_3 as 'datos_varios_3'
                from sispoc5_Ocasa.Piezas_Estados as pe
				inner join sispoc5_gestionpostal.flash_piezas as Piezas on pe.idPieza = Piezas.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on ci.cliente_id = '$UserId' and  Piezas.comprobante_ingreso_id = ci.id
				where (pe.BarcodeExterno like '$NumeroDePieza%' or '$NumeroDePieza' = '')
				and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta')
				and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta')
				and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
				and (Piezas.destinatario like '%$Destinatario%' or '$Destinatario' = '')
				order by pe.Fecha desc
                ) as pe
				
				union
                
				select
				'0' as 'idVinculo'
				, PI.Destinatario as 'Destinatario'
				, PI.CodigoPostal as 'CodigoPostal'
				, PI.Localidad as 'Localidad'
				, PI.Domicilio as 'Domicilio'
				, '0' as 'id'
				, 'Fisico' as 'idEstados'
				, Piezas.id as 'idPieza'
				, DATE_ADD(PI.Creacion, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, PI.Barra as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				, '1' as 'Sub'
				, fsSegundo.nombre as 'Servicio'
	            ,Piezas.datos_varios_3 as 'datos_varios_3'
				, '' as 'FotoAndroid'
				, '' as 'FotoEscaner'
				from sispoc5_Ocasa.PiezasIngresadas as PI
				inner join sispoc5_gestionpostal.flash_piezas as Piezas on PI.PiezaId = Piezas.id and PI.ClienteId = '$UserId'
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as cis on cis.id = PI.ServicioId
				inner JOIN sispoc5_gestionpostal.flash_servicios as fsSegundo on cis.servicio_id = fsSegundo.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
                and ci.cliente_id = '$UserId'
                where 1
				and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta')
				and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta')
				and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
				and (PI.destinatario like '%$Destinatario%' or '$Destinatario' = '')
                and PI.EstadoDeIngreso = '2'
				and  (PI.Barra like '$NumeroDePieza%' or '$NumeroDePieza' = '')

				union
                
				select
				  '0' as 'idVinculo'
				, PI.Destinatario as 'Destinatario'
		        ,Piezas.datos_varios_3 as 'datos_varios_3'
				, PI.CodigoPostal as 'CodigoPostal'
				, PI.Localidad as 'Localidad'
				, PI.Domicilio as 'Domicilio'
				, '0' as 'id'
				, 'x01' as 'idEstados'
				, Piezas.id as 'idPieza'
				, DATE_ADD(PI.Creacion, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, PI.Barra as 'BarcodeExterno'
				, '' as 'ApellidoNombreRecibio'
				, '' as 'Documento'
				, '2' as 'Sub'
				, fsSegundo.nombre as 'Servicio'
				, '' as 'FotoAndroid'
				, '' as 'FotoEscaner'
				from sispoc5_Ocasa.PiezasIngresadas as PI
				inner join sispoc5_gestionpostal.flash_piezas as Piezas on PI.PiezaId = Piezas.id and PI.ClienteId = '$UserId'
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as cis on cis.id = PI.ServicioId
				inner JOIN sispoc5_gestionpostal.flash_servicios as fsSegundo on cis.servicio_id = fsSegundo.id
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
                and ci.cliente_id = '$UserId'
                where 1
				and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta')
				and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta')
				and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
				and (PI.destinatario like '%$Destinatario%' or '$Destinatario' = '')
                and PI.EstadoDeIngreso = '1'
				and  (PI.Barra like '$NumeroDePieza%' or '$NumeroDePieza' = '')
				
				union 
				 
                select	
				
			    
		        pe.idVinculo as 'idVinculo'
				, Piezas.destinatario as 'Destinatario'
			    ,Piezas.datos_varios_3 as 'datos_varios_3'
				, '' as 'CodigoPostal'
				, '' as 'Localidad'
				, '' as 'Domicilio'
                ,pe.id as 'id'
				, pe.idEstados as 'idEstados' 
				, pe.idPieza as 'idPieza'
				, DATE_ADD(pe.Fecha, INTERVAL $DiferenciaHoraria HOUR) as 'Fecha'
				, pe.BarcodeExterno as 'BarcodeExterno'
				, pe.ApellidoNombreRecibio as 'ApellidoNombreRecibio'
				, pe.Documento as 'Documento'
				, '1' as 'Sub'
				, '' as 'Servicio'
				,CASE 
					WHEN pe.FotoDeAcuse not like ''
						THEN pe.FotoDeAcuse
					ELSE ''
				END as 'FotoAndroid'
				,CASE 
					WHEN pe.FotoDeAcuseWeb not like '' 
						THEN pe.FotoDeAcuseWeb
					ELSE ''
				END as 'FotoEscaner'
 				
 		
				from sispoc5_gestionpostal.flash_piezas as Piezas 
				inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
                inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id 
                inner join sispoc5_gestionpostal.flash_clientes as fcr on $UserId = fcr.id 
                inner join sispoc5_Ocasa.Piezas_Estados as pe on pe.idPieza = Piezas.id
				where (Piezas.datos_varios_3 = fcr.nombre_fantasia) and (ci.cliente_id = '1795') 
			
            )as pe 
	        GROUP by pe.idPieza, pe.id
			order by pe.Fecha desc
		)as pe 
		
		
        inner join sispoc5_gestionpostal.flash_piezas as Piezas on Piezas.id = pe.idPieza
        inner join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on Piezas.comprobante_ingreso_id = ci.id 
        inner join sispoc5_gestionpostal.flash_clientes as fc on ci.cliente_id = fc.id
        inner JOIN sispoc5_gestionpostal.flash_comprobantes_ingresos_servicios as fcis on Piezas.servicio_id = fcis.id
        inner JOIN sispoc5_gestionpostal.flash_servicios as fs on fcis.servicio_id = fs.id
		
		left join sispoc5_Ocasa.VinculoDestinatario as VD on  pe.idVinculo = VD.id
		inner join sispoc5_Ocasa.EstadoEntregaApp as EE on pe.idEstados = EE.id
		
		WHERE
		
        
		(fc.id = '$UserId' or fc.id is null or fc.id = '1795')
		and (Piezas.create >= '$Desde' or '$Desde' = '' or '$Desde' = '$Hasta' or pe.Sub = '2' or pe.Sub = '3')
		and (Piezas.create <= '$Hasta' or '$Hasta' = '' or '$Desde' = '$Hasta' or pe.Sub = '2' or pe.Sub = '3')
		and (Piezas.barcode_externo like '$NumeroDePieza%' or '$NumeroDePieza' = '' or pe.Sub = '2' or pe.Sub = '3')
		and ('$Destinatario' = '' or Piezas.destinatario like '%$Destinatario%' or pe.Sub = '2' or pe.Sub = '3')
		and (Piezas.documento = '$DNIBusqueda' or '$DNIBusqueda' = '')
	
		group by pe.idPieza , pe.BarcodeExterno
		order by pe.idPieza, pe.Fecha desc
		limit 10000
		
		





		

    ";
	//print_r($Consulta);
	//exit;
	
	/*
	/*
	$Columnas = array("Comprobante De Ingreso","Pieza Id","Codigo De Barra","Fecha De Solicitud","DNI/DU","Apellido Y/O Nombre","Codigo Postal","Localidad","Provincia"
	);
	$Consulta= "
		SELECT 
		FCI.numero as 'Comprobante De Ingreso'
		,FC.nombre as 'Cliente'
		, FP.id as 'Pieza Id'
		, FP.create as 'Fecha De Solicitud'
		, FCD.ApoderadoDocumento as 'DNI/DU'
		, FP.destinatario as 'Apellido Y/O Nombre'
		#, FP.barcode as 'Codigo De Barra'
		, FP.barcode_externo as 'Codigo De Barra'
		, FP.codigo_postal as 'Codigo Postal'
		
		, CASE
			WHEN FP.localidad REGEXP '^[0-9]+$' and FP.localidad not like '0'
				THEN (SELECT NombreImprimible FROM sispoc5_correoflash.localidades where id = FP.localidad)
			ELSE 
				FP.localidad
			END AS 'Localidad'
		, case WHEN (FCD.Id is not null) THEN 
				CASE
				WHEN FCD.DestinatarioProvincia REGEXP '^[0-9]+$' and FCD.DestinatarioProvincia not like '0'
					THEN (SELECT NombreImprimible FROM sispoc5_correoflash.provincias where id = FCD.DestinatarioProvincia)
				ELSE 
					FCD.DestinatarioProvincia
                END
            ELSE '' 
			END AS 'Provincia'
		FROM sispoc5_gestionpostal.flash_comprobantes_ingresos as FCI 
		inner join sispoc5_correoflash.cliente as cfc on cfc.SispoId = FCI.cliente_id
		inner join sispoc5_gestionpostal.flash_clientes as FC on FCI.cliente_id = FC.id
		inner join sispoc5_gestionpostal.flash_comprobantes_ingresos_generados as FCIG on FCIG.numero = FCI.numero
		inner join sispoc5_gestionpostal.flash_piezas as FP on FCI.id = FP.comprobante_ingreso_id
		left join sispoc5_gestionpostal.flash_piezas_cd as FCD on FP.id = FCD.IdFlashPieza
		where
		(
			FCI.numero = '$ComprobanteDeIngreso' or '$ComprobanteDeIngreso' = ''
		)
		and
		(
			(FCI.create > '$FechaI' and FCI.create <'$FechaF')
			or
			(
				'$FechaI' = '$FechaF'
			)
		)
		and cfc.Id = '$UserId'
		and (
				FP.barcode_externo = '$BarcodeExterno'  or '$BarcodeExterno' = ''
			)
		and (
				FCD.ApoderadoDocumento = '$Documento' or '$Documento' = ''
			)
		and (
				FP.destinatario like '%$ApellidoYNombre%' or '$ApellidoYNombre' = ''
			)
		and (
				FP.id like '%$IdPieza%' or '$IdPieza' = ''
			)
			
	";//15477082132949
	*/
	
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
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
	}else{
		//print_r($Consulta);
	}
	
?>













