<?php
echo("
	$( \"#UserName\" ).focus();
	document.getElementById('Paragrap').innerHTML='Usuario Bloqueado Temporalmente. <b></b><b style=\"color: rgb(0, 0, 0);font-size:12px;\">click <a href=\"javascript:FormForget();\" id=\"forget-password\">Aquí </a>para Desbloquear.</b>';
	document.getElementById('Paragrap').style='';
	document.getElementById('Paragrap').style='color: rgb(255, 0, 0);font-size:12px;';
");
?>


