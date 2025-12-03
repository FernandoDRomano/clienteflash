<?php
	header("Access-Control-Allow-Origin: *");
	//header("Access-Control-Allow-Credentials: true");
	//header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT, DELETE");
	//header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
	//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	$RespuestaJsonAjax = array('');
	
	function functionRespuestaJsonAjax($String,$RespuestaJsonAjax){
		//global $RespuestaJsonAjax;
		//ob_end_clean();
		//echo($RespuestaJsonAjax[0]);
		if($RespuestaJsonAjax['0'] == ""){
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . $String;//'1' => array('fullName' => 'Test 2', 'fullAdress' => 'Paris'),
		}else{
			$RespuestaJsonAjax['0'] = $RespuestaJsonAjax['0'] . "|" . $String;//'1' => array('fullName' => 'Test 2', 'fullAdress' => 'Paris'),
		}
		
		return($RespuestaJsonAjax);
	}
	function functionImpimirRespuestaJsonAjax($RespuestaJsonAjax){
		//global $RespuestaJsonAjax;
		
		if(isset ($_GET['callback'])){
			//header("Content-Type: application/json");
			echo $_GET['callback']."(".json_encode($RespuestaJsonAjax).")";
		}else{
			if(isset ($_POST['callback'])){
				echo $_POST['callback']."(".json_encode($RespuestaJsonAjax).")";
			}else{
				
			}
		}
		exit;
	}
	
	$target_dir = "uploads/";
	$uploadOk = 1;
	$RespuestaJsonAjax = functionRespuestaJsonAjax("Ficheros=" . count($_FILES["image_uploads"]["name"]),$RespuestaJsonAjax);
	for($i = 0 ; $i < count($_FILES["image_uploads"]["name"]); $i++){
		$target_file = $target_dir . basename($_FILES["image_uploads"]["name"][$i]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["image_uploads"]["tmp_name"][$i]);
			if($check !== false) {
				//echo "Tipo De Imagen - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				//echo "No Es Una Imagen.";
				$uploadOk = 0;
			}
		if (file_exists($target_file)) {
			unlink($target_file);
		}
		if ($uploadOk == 0) {
			//echo "La Imagen No Se Subio";
		} else {
			if (move_uploaded_file($_FILES["image_uploads"]["tmp_name"][$i], $target_file)) {
				//$RespuestaJsonAjax = functionRespuestaJsonAjax("El Archivo ". basename( $_FILES["image_uploads"]["name"][0]). " Se Subio",$RespuestaJsonAjax);
			} else {
				$RespuestaJsonAjax = functionRespuestaJsonAjax("Error Al Intentar Subir",$RespuestaJsonAjax);
			}
		}
	}
	//echo("[{\"Susses\":\"Yes\"}]");exit;
	//$RespuestaJsonAjax = functionRespuestaJsonAjax("Success:asd",$RespuestaJsonAjax);
	if($RespuestaJsonAjax[0] == ""){
		$RespuestaJsonAjax = functionRespuestaJsonAjax("Formulario Subido",$RespuestaJsonAjax);
	}
	//functionImpimirRespuestaJsonAjax($RespuestaJsonAjax);exit;
	echo("Success");
?>
















