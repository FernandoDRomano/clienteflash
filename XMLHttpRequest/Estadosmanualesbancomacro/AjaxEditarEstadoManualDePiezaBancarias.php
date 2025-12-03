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
		exit;
	}
	$HoraInicial = date('Y-m-d H:i:s', strtotime($HoraInicial . ' - 5 minutes'));
	$DiferenciaHoraria = dateDifference($HoraInicial,$HoraFinal,"%h");
	date_default_timezone_set($default_timezone);
	//F Funciones
	
	
	/*
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
	
	
	*/
	
	//I Variables
	$Barcode = issetornull('EdicionBarcode');
	$IdOBarcode = issetornull('EdicionIdOBarcode');
	$Usuario = "Usuario Web";
	$Vinculo = issetornull('EdicionVinculo');
	if($Vinculo == '0'){
		$Vinculo = '';
	}
	$vinculo = $Vinculo;
	//if($vinculo==''){$vinculo=0;}
	
	$ApellidoYNombres = issetornull('EdicionApellidoYNombres');
	$recibio = $ApellidoYNombres;
	$DNI = issetornull('EdicionDNI');
	$documento = $DNI;
	$Documento = '';
	$FechaI = issetornull('EdicionFechaI');
	$fecha = $FechaI;
	$EstadoDeLaPieza = issetornull('EdicionEstadoDeLaPieza');
	$EdicionIdEstado = issetornull('EdicionIdEstado');
	$Estado = $EdicionIdEstado;
	$Estados = $EstadoDeLaPieza;
	$time = "00:00:00";
	$fechaStamp = substr($fecha, 6, 4).'-'.substr($fecha, 3, 2).'-'.substr($fecha, 0, 2).' '.substr($fecha, 11);
	$fechaStamp = date('Y-m-d H:i:s', strtotime($fechaStamp));
	$versionAPP = "0";
	$Lat = "-26.8329531";
	$Lng = "-65.2199226";
	$Exactitud = "1";
	$Altitude = "1.0";
	$tipo = "CentroDeControl";
	$FicheroAcuse = issetornull('FicheroAcuse');
	//F Variables
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$currentDateTime = '' . date('Y-m-d H:i:s');
	
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
	
	
	
	
	//Busco Datos De La Pieza en GestionPostal
	$Columnas = array("PiezaId","BcExterno","HDR","Cliente");
	$Consulta= "
		SELECT p.id as 'PiezaId', p.barcode_externo as 'BcExterno', p.hoja_ruta_id as 'HDR', ci.cliente_id as 'Cliente'
		FROM sispoc5_gestionpostal.flash_piezas p
		left join sispoc5_gestionpostal.flash_comprobantes_ingresos as ci on p.comprobante_ingreso_id = ci.id
		WHERE p.$Columna = '$Value'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$PiezaId = $ClaseMaster->ArraydResultados[0][0];
		$id = $PiezaId;
		$BcExterno = $ClaseMaster->ArraydResultados[0][1];
		$bc = $BcExterno;
		$HDR = $ClaseMaster->ArraydResultados[0][2];
		$Cliente = $ClaseMaster->ArraydResultados[0][3];
	}else{
		//print_r($Consulta);
		echo("<P>Pieza No Encontrada En Sispo</p>");
		exit;
	}
	
	
	
	
	if(!$Cliente == 30){
		echo("<P>La Pieza Corresponde A Un Cliente No Bancario</p>");
		exit;
	}
	
	//Saca Datos{
	//Saco Id De Vinculo
	$Columnas = array("IdVinculo");
	$Consulta= "
		SELECT id as 'IdVinculo'
		FROM sispoc5_Ocasa.VinculoDestinatario
		where Nombre like '$vinculo'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$IdVinculo = $ClaseMaster->ArraydResultados[0][0];
	}else{
		$IdVinculo = '';
	}
	
	//Verifico Que Los Estados Existan
	//Banco Especifico
	$Columnas = array("id","idEstados","Fecha");
	$Consulta= "
		SELECT id as 'id', idEstados as 'idEstados', Fecha as 'Fecha'
		FROM sispoc5_Banco.PiezasEstados
		WHERE Barcode = '$BcExterno' and id = '$EdicionIdEstado'
		limit 1
	";
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		$idPiezasEstadosBanco = $ClaseMaster->ArraydResultados[0][0];
		$idEstadosBanco = $ClaseMaster->ArraydResultados[0][1];
		$FechaEstadosBanco = $ClaseMaster->ArraydResultados[0][2];
		$Columnas = array("id","idEstados","Fecha");
		$Consulta= "
			UPDATE sispoc5_Banco.PiezasEstados
			SET
				Activo = true
				,ApellidoNombreRecibio = '$ApellidoYNombres'
				,Documento = '$documento'
				,idVinculo = '$IdVinculo'
				,idEstados = '$Estados'
				,Fecha = '$fechaStamp'
			WHERE  Barcode = '$BcExterno' and id = '$EdicionIdEstado'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Consulta= "
			UPDATE sispoc5_Banco.PiezasEstados
			SET
				Activo = false
			WHERE  Barcode = '$BcExterno'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Columnas = array("Fecha");
		$Consulta= "
			SELECT max(Fecha) as 'Fecha'
			FROM sispoc5_Banco.PiezasEstados
			WHERE Barcode = '$BcExterno'
			limit 1
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		if($Resultado){
			$FechaUltimoEstadosBanco = $ClaseMaster->ArraydResultados[0][0];
		}else{
			$FechaUltimoEstadosBanco = '';
		}
		
		$Consulta= "
			UPDATE sispoc5_Banco.PiezasEstados
			SET
				Activo = true
			WHERE  Barcode = '$BcExterno' and Fecha = '$FechaUltimoEstadosBanco'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
		
		$Columnas = array("idEstados","NombreConsultasWeb");
		$Consulta= "
			SELECT idEstados as 'idEstados', Estados.NombreConsultasWeb as 'NombreConsultasWeb'
			FROM sispoc5_Banco.PiezasEstados
			inner join sispoc5_Banco.Estados on PiezasEstados.idEstados = Estados.id
			WHERE Barcode = '$BcExterno' and Fecha = '$FechaUltimoEstadosBanco'
			limit 1
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		if($Resultado){
			$idUltimoEstadosBanco = $ClaseMaster->ArraydResultados[0][0];
			$UltimoEstadosNombreConsultasWeb = $ClaseMaster->ArraydResultados[0][1];
			
			$Consulta= "
				UPDATE sispoc5_Banco.Piezas
				SET
					UltimoEstado = '$idUltimoEstadosBanco'
					, FechaDeEstado = '$FechaUltimoEstadosBanco'
				WHERE  concat('CF',Piezas.Tarjeta) = '$BcExterno'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			/*
			*
			*Consultas Web
			*
			*/
			
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
					where Id = '$idUltimoEstadosBanco'
				)
				, piezas.FechaEstadoPieza = '$FechaUltimoEstadosBanco'
				, piezas.EstadoPieza = '$UltimoEstadosNombreConsultasWeb'
				WHERE piezas.NumPiezaCorreo = '$bc'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			
		
			$Consulta= "
				UPDATE sispoc5_consultasweb.estados_piezas 
				SET 
				estados_piezas.FechaEstadoPieza = '$FechaUltimoEstadosBanco'
				, estados_piezas.EstadoPieza = '$UltimoEstadosNombreConsultasWeb'
				, estados_piezas.idEstados = '$idUltimoEstadosBanco'
				WHERE estados_piezas.NumeroPieza = '$bc' and idEstados = '$idEstadosBanco'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			echo("<P>Pieza Editada</p>");
			exit;
		}else{
			echo("<P>Ultimo Estado No Encontrado</p>");
			print_r($Consulta);
			exit;
		}
		
		
		
	}else{
		echo("<P>La Pieza No Corresponde Con Id De Estado</p>");
		exit;
	}
		
?>









