<?php
	/*
	echo("<p>_REQUEST</p>");
	print_r($_REQUEST);
	echo("<p>_GET</p>");
	print_r($_GET);
	echo("<p>_POST</p>");
	print_r($_POST);
	*/
	$distancia = abs(ord('a')-ord('A'));
	$letra = 65;
	for($i = 1; $letra < 91 ; $i++,$letra++){
		if($letra+1 < 91){
			echo("" . $i . "|". chr(abs($letra+$distancia)) . ";");
		}else{
			echo("" . $i . "|". chr(abs($letra+$distancia)));
		}
		
	}
?>