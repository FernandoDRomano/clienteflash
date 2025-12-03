<?php
	function issetornull($name){
		if(isset($_REQUEST[$name])){
			return ($_REQUEST[$name]);
		}else{
			return("");
		}
	}
	$cont=issetornull('cont');
	$Intentos = 3 - $cont;
	echo("
	$( \"#UserName\" ).focus();
	document.getElementById('Paragrap').innerHTML='Pasword Erroneo, Quedan: $Intentos Intentos Restantes.<b></b>';
	document.getElementById('Paragrap').style='';
	document.getElementById('Paragrap').style='color: rgb(255, 0, 0);font-size:12px;';
	");
?>


