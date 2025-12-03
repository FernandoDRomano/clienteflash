
<?php
	echo("1|2020-02-11|-10|11|12|100;2|2020-02-12|13|14|15|100;3|2020-02-13|16|17|18|100;4|2020-02-14|19|20|21|100");
	
	
	
	//$FechaDesde = issetornull('FechaDesde');
	//$FechaHasta = issetornull('FechaHasta');
	//echo($FechaDesde);
	//echo($FechaHasta);
	
	
	/*
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
	InluirPHP('../clases/ClaseMaster.php','1');//Tendria Que Entrar Por Config.php
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
	require('../config.php');
	require('../authenticate.php');
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
	$FechaDesde = issetornull('FechaDesde');
	$FechaHasta = issetornull('FechaHasta');
	$User = issetornull('User');
	$FechaHasta =date('Y-m-d', strtotime($FechaHasta));
	$FechaDesde =date('Y-m-d', strtotime($FechaDesde));
	$Columnas = array("id","Usuario","Password","Fecha");
	$Consulta= "
		SELECT Id as 'id', Username as 'Usuario', Password as 'Password', TimeStamp as 'Fecha'
		#, MD5 as '', IdGestionPostal as '', Borrado as '', IntentoDeLogueo as '', Email as ''
		FROM sispoc5_Ocasa.Clientes
		WHERE TimeStamp > '$FechaDesde' and TimeStamp < '$FechaHasta'
	";
	//echo($Consulta);
	$Resultado = $ClaseMaster->SQL_Master($Consulta,$Columnas,$time,true);
	if($Resultado){
		for($cont=0;$cont< count($ClaseMaster->ArraydResultados) ;$cont++){
			if($cont>0){echo(";");}
			for($cont2=0;$cont2< count($Columnas) ;$cont2++){
				if($cont2==0){
					if($cont2==0){echo(($cont+1)."|");}
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d');//-H-i-s');
							echo("".$resultado);
						}else{
							echo($ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
				}else{
					if($ClaseMaster->ArraydResultados[$cont][$cont2]==null and $ClaseMaster->ArraydResultados[$cont][$cont2]!='0'){
						echo("|"."");
					}else{
						if ($ClaseMaster->ArraydResultados[$cont][$cont2] instanceof DateTime) {
							$resultado = $ClaseMaster->ArraydResultados[$cont][$cont2]->format('Y-m-d');//-H-i-s');
							echo("|".$resultado);
						}else{
							echo("|".$ClaseMaster->ArraydResultados[$cont][$cont2]);
						}
					}
					
				}
			}
		}
	}else{
		echo("NULL");
		exit;
	}
	*/
?>







