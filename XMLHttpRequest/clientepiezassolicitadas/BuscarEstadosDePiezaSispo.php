<?php
	//echo("Suses");
	//exit;

	//Iniciar sessiones si no están iniciadas
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    header("Access-Control-Allow-Origin: *");
        
    // Bootstrap central: carga Composer + .env y promueve variables (ver Config/bootstrap.php)
    require_once __DIR__ . '/../../Config/bootstrap.php';

    use Throwable;
    use Models\Pieza;
    use Helpers\LogManager;

    //Obtener datos de la request
    $request = file_get_contents("php://input");
    $request = json_decode($request, true);

    $log = new LogManager();

    $log->info("BuscarEstadosDePiezaSispo", "Request recibida", $request);

	$piezaId = $request['PiezaId'] ?? null;
	$clienteId = $request['ClienteId'] ?? null;
	$userId = $request['UserId'] ?? null;

	try {
		$piezaModel = new Pieza();
		$data = $piezaModel->filtrar([
            'clienteId' => $clienteId,
            'piezaId' => $piezaId
        ]);

        if (!$data || count($data) === 0) {
            $log->info("BuscarEstadosDePiezaSispo", "No se encontraron piezas estados con los filtros proporcionados.", [
                'filtros' => $request
            ]);

            http_response_code(404);
            echo json_encode([
                'data' => [],
                'message' => 'No se encontraron piezas estados con los filtros proporcionados.',
                'status' => 'success'
            ]); die;
        }

		$data = formatearRespuesta($data);
		$dataAcuse = buscarFotosAcusesAPI($data['foto_acuse']);
		$data = sincronizarInformacionFotoAcuse([$data], $dataAcuse);
		$data = $data[0];

		http_response_code(200);
		echo json_encode([
			"status" => "success",
			"message" => "Piezas estados encontrados correctamente.",
			"data" => $data
		]);
	} catch (Throwable $e) {
		$log->exception("Error al buscar estados de pieza Sispo: ", $e->getMessage());

		http_response_code(500);
		echo json_encode([
			"status" => "error",
			"message" => "Ocurrió un error al buscar los estados de la pieza."
		]);
	}

	die;

	function formatearRespuesta($dataEstado){
		$pieza = $dataEstado[0];

		$data = [
			"barcode_externo" => $pieza[0],
			"pieza_id" => $pieza[3],
			"ultimo_estado" => $pieza[8],
			"fecha_ultimo_estado" => $pieza[7],
			"destinatario" => $pieza[10],
			"documento" => $pieza[14],
			"direccion" => $pieza[11],
			"recibio" => $pieza[15],
			"vinculo" => $pieza[16],
			"foto_acuse" => null,
		];

		$estados = [];
		foreach($dataEstado as $estado){
			//Agregar todos los estados
			$estados[] = [
				"estado_id" => $estado[2],
				"estado" => $estado[5],
				"fecha" => $estado[1]
			];

			//Agregar foto
			if(!empty($estado[17] && !is_null($estado[17]))){
				$data["foto_acuse"] = $estado[17];
			}
		}

		$data["estados"] = $estados;

		return $data;
	}

    function buscarFotosAcusesAPI($fotosAcuses){
        try {
            $apiUrl = "https://apiimagenes.intranetflash.com/api/buscar";
    
            $postParameter = [
                "archivos" => $fotosAcuses
            ];
            
            $respuesta = curlPost($apiUrl, $postParameter);

            return $respuesta;
        } catch (Throwable $e) {
            $log = new LogManager();
            $log->exception("buscarFotosAcusesAPI", $e);
            return [];
        }
    }

    function sincronizarInformacionFotoAcuse($data, $dataAcuses){
        // Si no hay acuses, marcar todos como 'No'
        if(!$dataAcuses || count($dataAcuses) === 0){
            return array_map(function($item) {
                $item['existe_foto_acuse'] = 'No';
                return $item;
            }, $data);
        }

        // Actualizar cada fila según la información de acuses
        for($i=0; $i < count($data); $i++){
            $fotoAcuse = $data[$i]['foto_acuse'];
            if(array_key_exists($fotoAcuse, $dataAcuses) && $dataAcuses[$fotoAcuse] == true){
                $data[$i]['existe_foto_acuse'] = 'Sí';
            }else{
                $data[$i]['existe_foto_acuse'] = 'No';
            }
        }
        return $data;
    }
	
	//Agregada
	function curlPost(string $url, array $data){
        $log = new LogManager();
        
        $curl = curl_init();
        
        // API espera y retorna JSON
        $jsonData = json_encode($data);
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // Timeout de 30 segundos
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        $curlErrno = curl_errno($curl);
        
        curl_close($curl);
        
        // Loguear detalles del request/response para debug
        $log->info("curlPost", "Detalles de la petición cURL", [
            'url' => $url,
            'http_code' => $httpCode,
            'curl_error' => $curlError,
            'curl_errno' => $curlErrno,
            'response_raw' => substr($response, 0, 500) // Primeros 500 chars
        ]);
        
        if ($curlErrno) {
            $log->error("curlPost", "Error en cURL: $curlError", [
                'errno' => $curlErrno,
                'url' => $url
            ]);
            return null;
        }
        
        if ($httpCode !== 200) {
            $log->warning("curlPost", "HTTP code no exitoso: $httpCode", [
                'url' => $url,
                'response' => $response
            ]);
        }
        
        $responseDecoded = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $log->error("curlPost", "Error al decodificar JSON: " . json_last_error_msg(), [
                'response' => substr($response, 0, 200)
            ]);
            return null;
        }

        return $responseDecoded;
    }
	
?>













