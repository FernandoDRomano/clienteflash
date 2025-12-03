<?php
	header("Access-Control-Allow-Origin: *");
	//I Funciones
	$Recursiva = 1;
	function ToASCIITilde($str) { 
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ'); 
		$b = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'h', 'h', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'ij', 'j', 'j', 'k', 'k', 'l', 'l', ' Lv', 'l', 'l', 'l', 'l', 'l', 'l', 'l', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'oe', 'r', 'r', 'r', 'r', 'r', 'r', 's', 's', 's', 's', 's', 's', 's', 's', 't', 't', 't', 't', 't', 't', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'w', 'y', 'y', 'y', 'z', 'z', 'z', 'z', 'z', 'z', 's', 'f', 'o', 'o', 'u', 'u', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'a', 'a', 'ae', 'ae', 'o', 'o');
		return str_replace($a, $b, $str); 
	}
	function ToString($var){
		return str_replace(".","",$var);
	}
	function StringSize($str,$size,$modo,$Relleno,$LugarDeRelleno,$FinalDeLinea){
		$strT ;
		if(mb_detect_encoding($str, "auto") === "UTF-8"){
			$str = ToASCIITilde($str);
			$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,"UTF-8") . $FinalDeLinea ;
		}else{
			$strT = mb_substr( str_pad($str,$size,$Relleno,$LugarDeRelleno),0,$size,$modo) . $FinalDeLinea ;
		}
		return $strT;
	}
	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
		$interval = date_diff($datetime1, $datetime2);
		return $interval->format($differenceFormat);
	}
	$default_timezone = date_default_timezone_get();
	$HoraInicial = date("Y-m-d H:i:s", time());
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$HoraFinal = date("Y-m-d H:i:s", time());
	$file_ticket = 'UploadConfirmed.ticket.txt';
	if(!function_exists ('InluirPHP')){
		function InluirPHP($PHPFILE,$FILEID){
			if (file_exists($PHPFILE)){
				require_once($PHPFILE);
			}
		}
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
	//F Funciones
	
	//I Variables
	$Barcode = issetornull('Barcode');
	$IdOBarcode = issetornull('IdOBarcode');
	$Usuario = "Usuario Web";
	$Vinculo = issetornull('Vinculo');
	if($Vinculo == '0'){
		$Vinculo = '';
	}
	$vinculo = $Vinculo;
	$ApellidoYNombres = issetornull('ApellidoYNombres');
	$recibio = $ApellidoYNombres;
	$DNI = issetornull('DNI');
	$documento = $DNI;
	$Documento = '';
	$FechaI = issetornull('FechaI');
	$fecha = $FechaI;
	$EstadoDeLaPieza = issetornull('EstadoDeLaPieza');
	$Estados = $EstadoDeLaPieza;
	$time = "00:00:00";
	$fechaStamp = substr($fecha, 6, 4).'-'.substr($fecha, 3, 2).'-'.substr($fecha, 0, 2).' '.substr($fecha, 11);
	//$fechaStamp = date('Y-m-d H:i:s', strtotime($fechaStamp . ' -4 hour'));
	$fechaStamp = date('Y-m-d H:i:s', strtotime($fechaStamp));
	$versionAPP = "0";
	$Lat = "-26.8329531";
	$Lng = "-65.2199226";
	$Exactitud = "1";
	$Altitude = "1.0";
	$tipo = "estadosmanualesbancomacro";
	$FicheroAcuse = issetornull('FicheroAcuse');
	//Agregado
	$hoja_de_ruta = issetornull('Hdr');
	//F Variables
	
	//I Condicional De Variables
	$Lat = ToString($Lat);
	$Lng = ToString($Lng);
	if($IdOBarcode == "Id"){
		//$id = $Barcode;
		$ColumnaOcasa = 'idPieza';
		$Columna = 'id';
		$ColumnaBanco = 'idPieza';
		$Value = $Barcode;
	}
	if($IdOBarcode == "Barcode"){
		$ColumnaOcasa = 'BarcodeExterno';
		$Columna = 'barcode_externo';
		$ColumnaBanco = 'Barcode';
		$Buscar = array("'", "-");
		$Poner   = array("\\'", "\\'");
		$Barcode = str_replace($Buscar, $Poner, $Barcode);
		$Value = $Barcode;
	}
	$PreVinculo = "";
	if($versionAPP > 0){
		$PreVinculo = "APP-";
	}
	$VinculoCompleto = $PreVinculo . $vinculo;
	//F Condicional De Variables
	
	
	//Busco Datos De La Pieza En Conjunto
	$BusquedaGlobal=false;
	BusquedaGlobal:
	$Columnas = array("PiezaId","BcExterno","HDR","Cliente"
	,"IdPiezaWeb","Motivo"
	,"IdEstadoBanco","NombreEstadoWeb"
	,"TipoDeEstadoActivo"
	,"TipoDeEstadoInactivo"
	,"IdVinculo"
	,"idPiezaBanco");
	$Consulta= "
		SELECT 
		p.id as 'PiezaId'
		, p.barcode_externo as 'BcExterno'
		, p.hoja_ruta_id as 'HDR'
		, ci.cliente_id as 'Cliente'
		,pw.id as 'IdPiezaWeb'
		, pw.MotivoPieza as 'Motivo'
		,eid.id as 'IdEstadoBanco'
		, eid.NombreConsultasWeb as 'NombreEstadoWeb'
		,ea.IdTipoDeEstado as 'TipoDeEstadoActivo'
		,e.IdTipoDeEstado as 'TipoDeEstadoInactivo'
		,VinculoDestinatario.id as 'IdVinculo'
		
		,pb.Id as 'idPiezaBanco'
		FROM (
			select * from sispoc5_gestionpostal.flash_piezas as p WHERE p.$Columna = '$Value' #id 88060349
		) as p
		left join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on p.comprobante_ingreso_id = ci.id
		left join sispoc5_consultasweb.piezas as pw on pw.NumPiezaCorreo = p.barcode_externo
		left join sispoc5_Banco.Piezas as pb on p.barcode_externo = concat('CF',pb.Tarjeta)
		left join sispoc5_Banco.PiezasEstados as pe on pe.Barcode = p.barcode_externo
		left join sispoc5_Banco.Estados as e on pe.idEstados = e.id
		left join sispoc5_Banco.Estados as ea on pe.idEstados = ea.id and pe.Activo = true
		left join sispoc5_Banco.Estados as eid on eid.Id like '$Estados'
		left join sispoc5_Ocasa.VinculoDestinatario on VinculoDestinatario.Nombre like '$vinculo'
		WHERE p.$Columna = '$Value' #id 88060349
		order by pe.Activo desc
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$PiezaId = $ClaseMaster->ArraydResultados[0][0];//sispo pieza id
		$id = $PiezaId;//sispo pieza id
		$BcExterno = $ClaseMaster->ArraydResultados[0][1];//barcodeexterno
		$bc = $BcExterno;//barcodeexterno
		$HDR = $ClaseMaster->ArraydResultados[0][2];//id hdr
		$Cliente = $ClaseMaster->ArraydResultados[0][3];//numero de cliente
		
		$IdPiezaWeb = $ClaseMaster->ArraydResultados[0][4];
		$MotivoWeb = $ClaseMaster->ArraydResultados[0][5];
		if($MotivoWeb == "Domicilio"){
			$idMotivoWeb = 1;
		}
		if($MotivoWeb == "Sucursal"){
			$idMotivoWeb = 2;
		}
		$IdEstadoBanco = $ClaseMaster->ArraydResultados[0][6];//Id Estado
		$NombreEstadoWeb = $ClaseMaster->ArraydResultados[0][7];//Nombre Web
		$TipoDeEstado = $ClaseMaster->ArraydResultados[0][8];//Estado Activo
		$TipoDeEstadoInactivo = $ClaseMaster->ArraydResultados[0][9];//Cualquier Estado
		$IdVinculo = $ClaseMaster->ArraydResultados[0][10];// vinculo Destinatario
		if($IdVinculo == ''){$IdVinculo = 0;}
		$idPiezaBanco = $ClaseMaster->ArraydResultados[0][11];// Id Pieza De Banco
	}else{
		//print_r($Consulta);
		echo("<P>Pieza No Encontrada</p>");
		exit;
	}
	
	//Agregado
	if(is_null($HDR) && (is_null($hoja_de_ruta) || empty($hoja_de_ruta))){
		echo("<p>La pieza no tiene HDR asociada, ingresala en el campo Hoja de Ruta y reintente la operación.</p>");
		exit;
	}
    
    
	if((!is_null($hoja_de_ruta) && !empty($hoja_de_ruta))){
	    //COLOCAR LOGICA PARA VALIDAR QUE SEA UNA HDR QUE HAYA TENIDO LA PIEZA CON ANTERIORIDAD
	    $columnas = array("id","hoja_ruta_id","pieza_id","pieza_estado_id");

	    $sql = "
	            SELECT sp.id as 'id', sp.hoja_ruta_id as 'hoja_ruta_id', sp.pieza_id as 'pieza_id', sp.pieza_estado_id as 'pieza_estado_id'
                FROM sispoc5_gestionpostal.flash_subpiezas sp 
                INNER JOIN sispoc5_gestionpostal.flash_piezas p ON p.id = sp.pieza_id
                WHERE p.$Columna = '$Value' AND sp.hoja_ruta_id = '$hoja_de_ruta'
                ";
                
        $resultado = $ClaseMaster->SQL_Master($sql,$columnas,$time,true);
        
        if($resultado && $ClaseMaster->NumeroDeResultados > 0){
            //EXISTE LA HOJA DE RUTA EN LA TABLA SUB PIEZAS PARA LA PIEZA DADA
            $HDR = $hoja_de_ruta;
        }else{
            echo("<p>La HDR ingresada no se encontro que este asociada a la pieza en el SISPO</p>");
		    exit;
        }
	}
	//Fin del Agregado
	
	if( is_null($TipoDeEstado) and !is_null($IdEstadoBanco) ){
		if(!$BusquedaGlobal){
			$Consulta= "
				UPDATE sispoc5_Banco.PiezasEstados
				SET PiezasEstados.Activo = false
				where PiezasEstados.Barcode = '$BcExterno'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$Consulta= "
				UPDATE sispoc5_Banco.PiezasEstados
				inner join (
					select max(Fecha) as 'Fecha', id as 'id'
					from sispoc5_Banco.PiezasEstados 
					where PiezasEstados.Barcode = '$BcExterno'
					GROUP BY PiezasEstados.Barcode
				) as max
				SET PiezasEstados.Activo = true
				where max.id = PiezasEstados.id and PiezasEstados.Barcode = '$BcExterno'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			
			$BusquedaGlobal=true;
			goto BusquedaGlobal;
			exit;
		}
	}
	if( is_null($IdPiezaWeb)){
		echo("<P>Pieza Web No Encontrada</p><br>");
		exit;
	}
	if( is_null($MotivoWeb)){
		echo("<P>Pieza Web Sin Motivo</p><br>");
		exit;
	}
	
	if($documento!=""){
		$Columnas = array("id");
		$Consulta= "
			UPDATE sispoc5_gestionpostal.flash_piezas SET 
			recibio = '$recibio'
			,documento = '$documento'
			,vinculo = '$VinculoCompleto'
			,datos_varios_2 = '$fecha'
			where $Columna = '$Value'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	}
	
	
	echo("<P>Actualizando Estado A (". $Estados .").</P>");
	$Columnas = array("");
	$Consulta= "
		UPDATE sispoc5_Banco.PiezasEstados
		SET 
		Activo = false
		,idPieza = '$PiezaId'
		WHERE Barcode like '$BcExterno' #$ColumnaBanco = '$Value'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	
	date_default_timezone_set('America/Argentina/Tucuman');
	$currentDateTime = '' . date('Y-m-d H:i:s');
    
	$Columnas = array("id");
	$Consulta= "
		INSERT INTO sispoc5_Banco.PiezasEstados 
		(
			idPieza
			, Barcode
			, idVinculo
			, ApellidoNombreRecibio
			, Documento
			, VercionAPP
			, Latitud
			, Longitud
			, Exactitud
			, Altitud
			, Tipo
			, idEstados
			, Activo
			, NombreDeUsuario
			, DocumentoUsuario
			, FotoDeAcuse
			, Cliente
			, HDR
			, Fecha
		)
		VALUES
		(
		'$PiezaId'
		, '$BcExterno'
		, '$IdVinculo'
		, '$recibio'
		, '$documento'
		, '$versionAPP'
		, '$Lat'
		, '$Lng'
		, '$Exactitud'
		, '$Altitude'
		, '$tipo'
		, '$IdEstadoBanco'
		, false
		, '$Usuario'
		, '$Documento'
		, '$FicheroAcuse'
		, '30'
		, '$HDR'
		, '$fechaStamp'
		)
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	//echo("<P>Recursiva (". $Recursiva .").</P>");
	//$Recursiva++;
	
	if($ClaseMaster->Insertado > 0){
    	$Consulta= "
    		UPDATE sispoc5_Banco.PiezasEstados
    		inner join (
    			select max(Fecha) as 'Fecha', Barcode as 'Barcode'
    			from sispoc5_Banco.PiezasEstados 
    			where PiezasEstados.Barcode = '$BcExterno'
    			GROUP BY PiezasEstados.Barcode
    		) as max
    		SET PiezasEstados.Activo = true
    		where max.Barcode = PiezasEstados.Barcode and max.Fecha = PiezasEstados.Fecha
    	";
    	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
    	
		echo("<P>Pieza Actualizada A:".$Estados." Correctamente</P>");
		
		$Columnas = array("");
		$Consulta= "
			UPDATE sispoc5_Banco.Piezas
			SET 
			IdSispoPieza = '$PiezaId'
			,UltimoEstado = '$IdEstadoBanco'
			,FechaDeEstado = '$fechaStamp'
			WHERE Id = '$idPiezaBanco'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Columnas = array("");
		$Consulta= "
			INSERT INTO sispoc5_consultasweb.estados_piezas(
				id,
				pieza_id,
				NumeroPieza,
				EstadoPieza,#Delete
				idEstados,
				MotivoPieza,#Delete
				idMotivo,
				FechaEstadoPieza,
				DatoPieza,
				HDR
			)
			VALUES
			(
				'0'
				, '$IdPiezaWeb'
				,'$bc'
				, '$NombreEstadoWeb'#Delete
				, '$IdEstadoBanco'
				, '$MotivoWeb'#Delete
				, '$idMotivoWeb'
				, '$fechaStamp'
				, ''
				, '$HDR'
			)
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		
		$Consulta= "
			UPDATE sispoc5_consultasweb.piezas 
			SET 
			piezas.EstadoDefinitivo = (
				select idEstadoDefinitivoWeb as 'EstadoDefinitivo'
				/*
					case 
						when IdTipoDeEstado < 4 then '3'
						when IdTipoDeEstado = 4 and (CodigoDeReporte = 'SOL' or CodigoDeReporte = 'END') then '4'
						else '1'
					end as 'EstadoDefinitivo'
				*/
				from sispoc5_Banco.Estados
				where Id = '$IdEstadoBanco'
			)
			, piezas.FechaEstadoPieza = '$fechaStamp'
			, piezas.EstadoPieza = '$NombreEstadoWeb'
			, piezas.MotivoPieza = '$MotivoWeb'
			WHERE piezas.id = '$IdPiezaWeb'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		exit;
	}else{
	    if($HDR==''){
	        echo("La Pieza No Tiene Una Ruta En Sispo");
	    }
	    //echo("Problema En Banco Macro");
	    //print_r($Consulta);
	}
?>



