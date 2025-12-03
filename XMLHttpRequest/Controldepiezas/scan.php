<?php
	header('Access-Control-Allow-Origin:*');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	@$fecha = date("Y-m-d H:i:s",time());
	$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$zonahoraria = date_default_timezone_get();
	$anio;$mes;$Dia;$Hora;$minuto;$segundo;
	$date = new DateTime('now');
	$anio =  $date->format('Y');
	$mes = $date->format('m');
	$Dia = $date->format('d');
	$Hora = $date->format('H');
	$minuto = $date->format('i');
	$segundo = $date->format('s');
	$date->modify('last day of this month');
	$UltimoDiaDelMes=$date->format('d');
	$time = $anio.$mes.$Dia.$Hora.$minuto.$segundo;
$dir = "files";
$time = 0 ;
// Run the recursive function 

$response = scan($dir,$time);


// This function scans the files folder recursively, and builds a large array

function scan($dir,$time){

	$files = array();

	// Is there actually such a folder/file?

	if(file_exists($dir)){
		foreach(scandir($dir) as $f) {
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}
			if(is_dir($dir . '/' . $f)) {
				// The path is a folder
				$f = utf8_encode($f);
				$dir = utf8_encode($dir);
				//echo($f);
				//echo($dir);
				
				$files[] = array(
					"name" => $f,
					"type" => "folder",
					"path" => $dir . '/' . $f,
					"items" => scan($dir . '/' . $f,$time) // Recursively get the contents of the folder
				);
			}
			
			else {

				// It is a file
				$size = filesize($dir . '/' . $f);
				$f = utf8_encode($f);
				$dir = utf8_encode($dir);
				$files[] = array(
					"name" => $f,
					"type" => "file",
					"path" => $dir . '/' . $f,
					"size" => $size // Gets the size of this file
				);
			}
		}
	
	}

	return $files;
}



// Output the directory listing as JSON

header('Content-type: application/json');
//print_r($response);

//echo json_encode(
//));

$arr = array(
	"name" => "files",
	"type" => "folder"
	,"path" => $dir
	,"items" => $response
	);
	
echo json_encode($arr)."";
















