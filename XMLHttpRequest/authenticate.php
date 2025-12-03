<?php
	//echo("Aut");
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$arraydhack = explode("%3c?php", $actual_link);
	if(count($arraydhack)>1){header('Location: 403forbidden.php');exit;}
	$_SESSION['logged_in'] = TRUE;
	$iptocheck = $_SERVER['REMOTE_ADDR'];
	if (!($_SESSION['logged_in']) == TRUE) {
		echo("GoUrl(\"403forbidden.php\");/*login trap* /");exit;
	}
	$validationresults = TRUE;
	$registered = TRUE;
	$recaptchavalidation = TRUE;
	$iptocheck = $_SERVER['REMOTE_ADDR'];
	//$iptocheck = mysql_real_escape_string($iptocheck);
	
	/*
	
	
	if($fetch = mysql_fetch_array(mysql_query("SELECT `Ip` FROM `IpBloqueo` WHERE `Ip`='$iptocheck'"))) {
		$resultx = mysql_query("SELECT `Contador` FROM `IpBloqueo` WHERE `Ip`='$iptocheck'");
		$rowx = mysql_fetch_array($resultx);
		$loginattempts_total = $rowx['Contador'];
		If ($loginattempts_total > $maxfailedattempt) {
			echo("GoUrl(\"403forbidden.php\");/ *login trap* /");exit;
			exit;
		}
	}
	*/
?>