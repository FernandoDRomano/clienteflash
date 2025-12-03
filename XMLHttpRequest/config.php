<?php
    /*
    if (isset($_COOKIE['idusuario'])) {
        exit;
    }
    */
	//echo("config");
	InluirPHP('../clases/ClaseMaster.php','1');
	InluirPHP('clases/ClaseMaster.php','1');
	$ClaseMaster = new Master();
	$Columnas="";
?>