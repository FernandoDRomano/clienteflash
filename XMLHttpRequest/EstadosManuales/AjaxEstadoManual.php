<?php
	header("Access-Control-Allow-Origin: *");
	
	//I Funciones
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
	    //print_r("error al buscar la hora");
		exit;
	}
	$HoraInicial = date('Y-m-d H:i:s', strtotime($HoraInicial . ' - 5 minutes'));
	$DiferenciaHoraria = dateDifference($HoraInicial,$HoraFinal,"%h");
	date_default_timezone_set($default_timezone);
	//F Funciones
	
	
	
	//I Suba De Imagenes Si Existen
	$target_dir = "uploads/";
	$uploadOk = 1;
	//print_r($_FILES);
	//print_r($_POST);
	$UploadError = false;
	for($i = 0 ; $i < count($_FILES["image_uploads"]["name"]); $i++){
		if($_FILES["image_uploads"]["error"][$i] == 0){
			$target_file = $target_dir . basename($_FILES["image_uploads"]["name"][$i]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$check = getimagesize($_FILES["image_uploads"]["tmp_name"][$i]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
			if (file_exists($target_file)) {
				echo("Error:La Imagen Ya Existe, Cambie El Nombre De La Imagen.");exit;
				unlink($target_file);
			}
			if ($uploadOk == 0) {
			} else {
				if (move_uploaded_file($_FILES["image_uploads"]["tmp_name"][$i], $target_file)) {
				} else {
					$UploadError = true;
				}
			}
		}else{
			$UploadError = true;
		}
	}
	
	if($UploadError && count($_FILES["image_uploads"]["name"]) == 1){
		//echo("Error: Sin Imagen.");
	}
	$NombreDeArchivo = "";
	if($UploadError && count($_FILES["image_uploads"]["name"]) > 1){
		echo("Error: Imagenes Con Errores.");exit;
	}else{
		//echo("Success");
		$NombreDeArchivo = $_FILES["image_uploads"]["name"][0];;
	}
	//F Suba De Imagenes Si Existen
	
	
	
	//I Variables
	$Barcode = issetornull('Barcode');
	$IdOBarcode = issetornull('IdOBarcode');
	$Usuario = "Usuario Web";
	$Vinculo = issetornull('Vinculo');
	$vinculo = $Vinculo;
	$ApellidoYNombres = issetornull('ApellidoYNombres');
	$recibio = $ApellidoYNombres;
	$DNI = issetornull('DNI');
	$documento = $DNI;
	$FechaI = issetornull('FechaI');
	$fecha = $FechaI;
	$EstadoDeLaPieza = issetornull('EstadoDeLaPieza');
	$Estados = $EstadoDeLaPieza;
	$time = "00:00:00";
	$fechaStamp = substr($fecha, 6, 4).'-'.substr($fecha, 3, 2).'-'.substr($fecha, 0, 2).' '.substr($fecha, 11);
	$fechaStamp = date('Y-m-d H:i:s', strtotime($fechaStamp . ' -4 hour'));
	$versionAPP = "0";
	$Lat = "-26.8329531";
	$Lng = "-65.2199226";
	$Exactitud = "1";
	$Altitude = "1.0";
	$tipo = "CentroDeControl";
	//AGREGADO
    $Hdr = issetornull('Hdr');
    //$Hdr = 12345;
    
    //echo $Hdr;
    //var_dump($Hdr);

    //F Variables
	
	//I Condicional De Variables
	$Lat = ToString($Lat);
	$Lng = ToString($Lng);
	if($IdOBarcode == "Id"){
		$Columna = 'id';
		$ColumnaOcasa = 'idPieza';
		$Value = $Barcode;
	}
	if($IdOBarcode == "Barcode"){
		$Columna = 'barcode_externo';
		$ColumnaOcasa = 'BarcodeExterno';
		$Buscar = array("'", "-");
		$Poner   = array("\\'", "\\'");
		$Barcode = str_replace($Buscar, $Poner, $Barcode);
		$Value = $Barcode;
	}
	//F Condicional De Variables
	
	
	
	
	
	//I Consultas
	if($documento!=""){
		$Columnas = array("id");
		$Consulta= "
			UPDATE sispoc5_gestionpostal.flash_piezas SET 
			recibio = '$recibio'
			,documento = '$documento'
			,vinculo = '$vinculo'
			,datos_varios_2 = '$fecha'
			where $Columna = '$Value'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
	}
	
	BusquedaInicial:
	$Columnas = array("id");
	$Consulta= "SELECT * FROM sispoc5_Ocasa.Piezas_Estados WHERE $ColumnaOcasa = '$Value'";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		echo("<P>Pieza Con Estados</p>");
		$Columnas = array("id","idPieza","BarcodeExterno","tipo","Eid","NombreAPP");
		$Consulta= "
			SELECT PE.id, PE.idPieza, PE.BarcodeExterno , EE.tipo , E.id as 'Eid', EE.Nombre as 'NombreAPP'
			FROM sispoc5_Ocasa.Piezas_Estados as PE
			inner join sispoc5_Ocasa.EstadoEntregaApp as E on PE.idEstados = E.id
			inner join sispoc5_Ocasa.EstadoEntrega as EE on E.idEstado = EE.id
			WHERE PE.$ColumnaOcasa = '$Value' and PE.Activo = true and EE.tipo = '2'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		if($Resultado){
			echo("<P>La Pieza Ya Esta Con Estado Final(".$ClaseMaster->ArraydResultados[0][5]."), No Se Puede Modificar A Otro Estado</P>");
			exit;
		}
		$Columnas = array("id","idPieza","BarcodeExterno","tipo","Eid","NombreAPP");
		$Consulta= "
			SELECT PE.id, PE.idPieza, PE.BarcodeExterno , EE.tipo , E.id as 'Eid', E.NombreAPP
			FROM sispoc5_Ocasa.Piezas_Estados as PE
			inner join sispoc5_Ocasa.EstadoEntregaApp as E on PE.idEstados = E.id
			inner join sispoc5_Ocasa.EstadoEntrega as EE on E.idEstado = EE.id
			WHERE PE.$ColumnaOcasa = '$Value' and PE.Activo = true and EE.tipo <> '2'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		if($Resultado){
			echo("<P>Actualizando Estado De (".$ClaseMaster->ArraydResultados[0][5].") A (". $Estados .").</P>");
			$Columnas = array("id","idPieza","BarcodeExterno","tipo","Eid","NombreAPP");
			$Consulta= "
				UPDATE sispoc5_Ocasa.Piezas_Estados
				SET 
				Activo = false
				WHERE $ColumnaOcasa = '$Value'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$Columnas = array("id");
            //LE AGREGO LA HDR AL INSERT
			$Consulta= "
				INSERT INTO sispoc5_Ocasa.Piezas_Estados 
				(idPieza, BarcodeExterno, idVinculo, ApellidoNombreRecibio, Documento
				, Hora, Fecha, VercionAPP, Latitud, Longitud
				, Exactitud, Altitud, Tipo, idEstados, Activo
				, NombreDeUsuario, FotoDeAcuseWeb, HDR)
				VALUES
				(
				(SELECT id FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value' )
				, (SELECT barcode_externo FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value')
				,(SELECT id FROM sispoc5_Ocasa.VinculoDestinatario where Nombre like '$vinculo')
				,'$recibio'
				,'$documento'
				,'$time'
				,'$fechaStamp'
				,'$versionAPP'
				,'$Lat'
				,'$Lng'
				,'$Exactitud'
				,'$Altitude'
				,'$tipo'
				,(SELECT id FROM sispoc5_Ocasa.EstadoEntregaApp where NombreAPP like '$Estados')
				,true
				,'$Usuario'
				,'$NombreDeArchivo'
                ,'$Hdr'
				)
			";
			//echo("".$Consulta."");
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			$Columnas = array("id");
			$Consulta= "
				SELECT id 
				FROM sispoc5_Ocasa.Piezas_Estados as PE
				WHERE
				idPieza = (SELECT id FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value')
				AND BarcodeExterno = (SELECT barcode_externo FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value')
				AND (idVinculo = (SELECT id FROM sispoc5_Ocasa.VinculoDestinatario where Nombre like '$vinculo') or idVinculo is null)
				AND ApellidoNombreRecibio = '$recibio'
				AND Documento = '$documento'
				#AND Hora = '$time'
				AND VercionAPP = '$versionAPP'
				#AND Latitud = '$Lat'
				#AND Longitud = '$Lng'
				#AND Exactitud = '$Exactitud'
				#AND Altitud = '$Altitude'
				#AND Tipo = '$tipo'
				AND idEstados = (SELECT id FROM sispoc5_Ocasa.EstadoEntregaApp where NombreAPP like '$Estados')
				AND Activo = true
			";
			
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
			if($Resultado){
				echo("<P>Pieza Actualizada A:".$Estados." Correctamente</P>");
				goto PRINTTER;
				exit;
			}else{
				echo("".$Consulta."");
			}
		}else{
			echo("<P>No Se Encontro Ultimo Estado, Reestableciendo Ultimo Conocido.</P>");
			$Consulta= "
				UPDATE sispoc5_Ocasa.Piezas_Estados
				SET 
				Activo = true
				,NombreDeUsuario = '$Usuario'
				WHERE 
				$ColumnaOcasa = '$Value' and
				Fecha in (
					SELECT max(Fecha)
				)
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			goto BusquedaInicial;
		}
	}else{
		//COMO LA PIEZA NO EXISTE EN OCASA, LA CREO Y LA INSERTO CON LA HDR

        echo("Pieza Sin Estados");
		$Columnas = array("id");
		$Consulta= "
			SELECT id FROM sispoc5_gestionpostal.flash_piezas where $Columna = '$Value'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		
		if($Resultado){
			$Columnas = array("id");
			$Consulta= "
				INSERT INTO sispoc5_Ocasa.Piezas_Estados 
				(idPieza, BarcodeExterno, idVinculo, ApellidoNombreRecibio, Documento
				, Hora, Fecha, VercionAPP, Latitud, Longitud
				, Exactitud, Altitud, Tipo, idEstados, Activo
				, NombreDeUsuario, FotoDeAcuseWeb, HDR)
				VALUES
				(
				(SELECT id FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value' )
				, (SELECT barcode_externo FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value')
				,(SELECT id FROM sispoc5_Ocasa.VinculoDestinatario where Nombre like '$vinculo')
				,'$recibio'
				,'$documento'
				,'$time'
				,'$fechaStamp'
				,'$versionAPP'
				,'$Lat'
				,'$Lng'
				,'$Exactitud'
				,'$Altitude'
				,'$tipo'
				,(SELECT id FROM sispoc5_Ocasa.EstadoEntregaApp where NombreAPP like '$Estados')
				,true
				,'$Usuario'
				,'$NombreDeArchivo'
                ,'$Hdr'
				)
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			
			//echo("" . $Consulta . "");
			$Columnas = array("id");
			$Consulta= "
				SELECT id 
				FROM sispoc5_Ocasa.Piezas_Estados as PE
				WHERE
				( idPieza = (SELECT id FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value') or idPieza = '0') 
				AND (BarcodeExterno = (SELECT barcode_externo FROM sispoc5_gestionpostal.flash_piezas WHERE $Columna = '$Value')  or BarcodeExterno = '')
				AND (idVinculo = (SELECT id FROM sispoc5_Ocasa.VinculoDestinatario where Nombre like '$vinculo') or idVinculo is null)
				AND ApellidoNombreRecibio = '$recibio'
				AND Documento = '$documento'
				AND VercionAPP = '$versionAPP'
				AND idEstados = (SELECT id FROM sispoc5_Ocasa.EstadoEntregaApp where NombreAPP like '$Estados')
				AND Activo = true
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
			//echo("" . $Consulta . "");
			if($Resultado){
				echo("<P>Pieza Agregada Con Estado:".$Estados." Correctamente</P>");
				goto PRINTTER;
				exit;
			}else{
				goto PRINTTER;
				exit;
			}
		}else{
			echo("<P>La Pieza No Existe con ($Columna) = ($Value)</P>");
		}
	}
	
	exit;
	
	PRINTTER:
	$PiezaSispo = "";
	$Columnas = array($Columna,"recibio","documento","vinculo","datos_varios_2");
	$Consulta= "
		SELECT $Columna,recibio,documento,vinculo,datos_varios_2
		FROM sispoc5_gestionpostal.flash_piezas
		WHERE $Columna = '$Value'
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$PiezaSispo = "Datos En Sispo: \n\tRecibió: ". strtolower($ClaseMaster->ArraydResultados[0][1])
		. "\n\tDocumento: " . $ClaseMaster->ArraydResultados[0][2]
		. "\n\tVínculo: " . $ClaseMaster->ArraydResultados[0][3]
		. "\n\tFecha: " . $ClaseMaster->ArraydResultados[0][4];
	}
	echo("<p>$PiezaSispo </p>");
	
	//F Consultas
?>
