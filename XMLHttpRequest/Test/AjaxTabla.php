<?php
	echo("Columna 0|Columna 1|Columna 2|Columna 3|Columna 4|Columna 5|Columna 6|Columna 7|Columna 8|Columna 9|Columna 10;");
	$ParaImprimir = "";
	$Filas = 100;
	$Columnas = 10;
	for($i = 0 ; $i<$Filas ; $i++){
		$ParaImprimir = "Id " . $i. "|";
		for($j = 0 ; $j<$Columnas ; $j++){
			if($j == $Columnas-1){
				if($i == $Filas-1){
					$ParaImprimir = $ParaImprimir . "Fila " . ($i+1) . ", Columna " . ($j+1) . "";
				}else{
					$ParaImprimir = $ParaImprimir . "Fila " . ($i+1) . ", Columna " . ($j+1) . ";";
				}
			}else{
				$ParaImprimir = $ParaImprimir . "Fila " . ($i+1) . ", Columna " . ($j+1) . "|";
			}
		}
		echo($ParaImprimir);
	}
?>













