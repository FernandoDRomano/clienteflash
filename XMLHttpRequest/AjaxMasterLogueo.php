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
	
	if(file_exists('/config.php')){
		require('/config.php');
	}
	
	if(file_exists('config.php')){
		require('config.php');
	}
	if(file_exists('/authenticate.php')){
		require('/authenticate.php');
	}
	if(file_exists('authenticate.php')){
		require('authenticate.php');
	}
	//exit;
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
	
	
	//echo("alert('Pasa 1');");exit;
	$user = issetornull("user");
	$pass = issetornull("pass");
	
	
	$Columnas = array("User","Password","Email","Id");
	$Consulta= "
		SELECT username as 'User',password_hash as 'Password', email as 'Email',idCliente_Sispo as 'Id'
		from user
		where username = '$user' and password_hash = '$pass'
	";
	$Resultado = $ClaseMaster->SQL_MasterSppFlash($Consulta,$Columnas,$time,true);
	$TestDeUsuarioRealizado=0;
	if($Resultado){
		$_SESSION['us_name'] = $ClaseMaster->ArraydResultados[0][0];
		$_SESSION['us_password'] = $ClaseMaster->ArraydResultados[0][1];
		//$_SESSION['idusuario'] = $ClaseMaster->ArraydResultados[0][3];
		
		$ALIASDECLIENTE = $ClaseMaster->ArraydResultados[0][0];
		$PASSWORDDECLIENTE = str_replace('$','\\\$',$ClaseMaster->ArraydResultados[0][1]);
		$PASSWORDDECLIENTE = $ClaseMaster->ArraydResultados[0][1];
		$EMAILDECLIENTE = $ClaseMaster->ArraydResultados[0][2];
		$IDSISPODECLIENTE = $ClaseMaster->ArraydResultados[0][3];
			
			
		//echo("alert(`" . $Consulta . "`);");
		TestDeUsuario:
		if($TestDeUsuarioRealizado==2){
			//echo("window.location.replace(URLJS + 'principal/inicio');");
			exit;
		}
		$TestDeUsuarioRealizado++;
		
		$Columnas = array("User","Password","Email","Id","idusuario");
		$Consulta= "
			SELECT C.Alias as 'User', C.Password as 'Password', C.Mail as 'Email', SispoId as 'Id', Id as 'idusuario'
			FROM sispoc5_correoflash.cliente as C
			WHERE C.Alias = '$user' and C.Password = '$pass'
		";
		$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
		if($Resultado){
			$_SESSION['us_name'] = $ClaseMaster->ArraydResultados[0][0];
			$_SESSION['us_password'] = $ClaseMaster->ArraydResultados[0][1];
			//$_SESSION['idusuario'] = $ClaseMaster->ArraydResultados[0][3];
			$_SESSION['idusuario'] = $ClaseMaster->ArraydResultados[0][4];
			
			$_SESSION['us_nombre'] = "";
			$_SESSION['us_apellido'] = "";
			$_SESSION['idperfil'] = "";
			$_SESSION['UsuarioNombreDeMenu'] = "cliente";
			$_SESSION['UsuarioMainMenu'] = ["Views/cliente.php","Views/cliente.php","Views/cliente.php","Views/cliente.php"];
			$_SESSION['UsuarioURL'] = ["principal","pedidodeenvio","clientepiezassolicitadas","clienteruteoservicios"];
			
			echo("setCookie('us_name','" . $_SESSION['us_name'] . "');");
			echo("setCookie('us_password','" . $_SESSION['us_password'] . "');");
			echo("setCookie('idusuario','" . $_SESSION['idusuario'] . "');");
			echo("setCookie('us_nombre','" . $_SESSION['us_nombre'] . "');");
			echo("setCookie('us_apellido','" . $_SESSION['us_apellido'] . "');");
			echo("setCookie('idperfil','" . $_SESSION['idperfil'] . "');");
			echo("setCookie('UsuarioNombreDeMenu','" . $_SESSION['UsuarioNombreDeMenu'] . "');");
			echo("setCookie('UsuarioURL','" . implode ($_SESSION['UsuarioURL'],"&") . "');");
			echo("setCookie('UsuarioMainMenu','" . implode ($_SESSION['UsuarioMainMenu'],"&") . "');");
			
			echo("window.location.replace(URLJS + 'principal/inicio');");
			exit;
		}else{
			$Columnas = array("");
			$Consulta= "
				INSERT INTO sispoc5_correoflash.cliente
				(
					cliente.Alias
					, cliente.Password
					, cliente.Mail
					, cliente.Nombre
					, cliente.NombreDeFantacia
					, cliente.FechaDeCreacion
					, cliente.IdCreador
					, cliente.Estado
					, cliente.CodigoDeSeguimiento
					, cliente.idperfil
					, cliente.URLFirma
					, cliente.SispoId
				)
				VALUES
				(
					'$ALIASDECLIENTE'
					, '$PASSWORDDECLIENTE'
					, '$EMAILDECLIENTE'
					, 'cliente'
					, 'cliente'
					, CURRENT_TIMESTAMP
					, '0'
					, '1'
					, '0'
					, '0'
					, ''
					, '$IDSISPODECLIENTE'
				)
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
			
			$Columnas = array("IdUsuario");
			$Consulta= "
				SELECT C.Id as 'IdUsuario'
				FROM sispoc5_correoflash.cliente as C
				WHERE C.Alias = '$user' and C.Password = '$pass'
			";
			$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
			if($Resultado){
				$IDDEUSUARIO = $ClaseMaster->ArraydResultados[0][0];
				
				$Columnas = array("Menu");
				$Consulta= "
					SELECT MDG.Menu as 'Menu'
					FROM sispoc5_correoflash.menuesdegrupo as MDG
					WHERE MDG.Grupo = '1'
				";
				$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
				if($Resultado){
					$IDDEMENUES;
					for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
						$IDDEMENUES[$cont] = $ClaseMaster->ArraydResultados[$cont][0];
					}
					for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
						$Columnas = array("");
						$Consulta= "
							INSERT INTO sispoc5_correoflash.menudeusuarios
							(
								IdUsuario
								, IdMenu
								, Creador
								, FechaDeCreacion
								, TipoDeLogueo
							)
							VALUES
							(
								'$IDDEUSUARIO'
								, '$IDDEMENUES[$cont]'
								, '1'
								, CURRENT_TIMESTAMP
								, '1'
								
							)
						";
						$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,false);
					}
				}
			}
			
			
			//echo($Consulta);
			//exit;
			goto TestDeUsuario;
		}
	}
	
	/*
	if($Resultado){
		/ *
		for($cont=0;$cont< count($Columnas) ;$cont++){
			if($cont>0){echo("|");}
			echo($Columnas[$cont]);
		}
		echo(";");
		* /
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













