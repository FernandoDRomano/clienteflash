<?php 
    ini_set('memory_limit','9999M');

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

    $log->info("BuscarPiezasEstadosSispo", "Request recibida", $request);

    $barcodeExterno = $request['BarcodeExterno'] ?? null;
    $documento = $request['Documento'] ?? null;
    $apellidoYNombre = $request['ApellidoYNombre'] ?? null;
    $fechaInicial = $request['FechaI'] ?? null;
    $fechaFinal = $request['FechaF'] ?? null;
    $userId = $request['UserId'] ?? null;
    $clienteId = $request['ClienteId'] ?? null;

    try {
        $piezaModel = new Pieza();
        $data = $piezaModel->filtrar([
            'BarcodeExterno' => $barcodeExterno,
            'Documento' => $documento,
            'ApellidoYNombre' => $apellidoYNombre,
            'FechaI' => $fechaInicial,
            'FechaF' => $fechaFinal,
            'userId' => $userId,
            'clienteId' => $clienteId
        ]);

        if (!$data || count($data) === 0) {
            $log->info("BuscarPiezasEstadosSispo", "No se encontraron piezas con los filtros proporcionados.", [
                'filtros' => $request
            ]);

            http_response_code(404);
            echo json_encode([
                'data' => [],
                'message' => 'No se encontraron piezas con los filtros proporcionados.',
                'status' => 'success'
            ]); die;
        }
        
        $data = EstadosEnFilas($data);

        $indices = ['pieza_id','barcode_externo','sucursal','destinatario','direccion'
                    ,'cp','localidad','estado_actual','fecha_estado_actual','cantidad_gestiones'
                    ,'ingreso_logico','fecha_ingreso_logico','ingreso_fisico','fecha_ingreso_fisico'
                    ,'enviado_a_1','fecha_enviado_a_1','recibido_en_1','fecha_recibido_en_1'
                    ,'enviado_a_2','fecha_enviado_a_2','recibido_en_2','fecha_recibido_en_2'
                    ,'fecha_1_distribucion','resultado_1_distribucion','fecha_resultado_1_distribucion'
                    ,'fecha_2_distribucion','resultado_2_distribucion','fecha_resultado_2_distribucion'
                    ,'fecha_3_distribucion','resultado_3_distribucion','fecha_resultado_3_distribucion'
                    ,'ultima_novedad','fecha_ultima_novedad'
                    ,'documento','recibio','vinculo','foto_acuse', 'imagen'];

        $data = agregarIndices($data, $indices);

        // Procesar fotos de acuse
        $fotosAcuses = filtrarFotosAcuse($data);
        $fotosAcuses = toStringArray($fotosAcuses);

        // Verificar fotos de acuse mediante API externa
        $dataAcuses = buscarFotosAcusesAPI($fotosAcuses);

        // Sincronizar información de fotos de acuse con los datos principales
        $data = sincronizarInformacionFotoAcuse($data, $dataAcuses);

        echo json_encode([
            'data' => $data,
            'message' => 'Piezas Encontradas.',
            'status' => 'success'
        ]); die;
    } catch (Throwable $e) {
        $log->exception("BuscarPiezasEstadosSispo", $e);
        http_response_code(500);
        echo json_encode([
            'data' => null,
            'message' => 'Ocurrió un error al buscar las piezas.',
            'status' => 'error'
        ]);
        die;
    }

    function filtrarFotosAcuse($data){
        $fotosAcuses = array_map(function($item) {
            return $item['foto_acuse'];
        }, $data);

        $fotosAcusesUnicos = array_values(array_unique($fotosAcuses));
        $fotosAcusesUnicos = array_filter($fotosAcusesUnicos, function($value) {
            return !is_null($value) && $value !== '';
        });

        return $fotosAcusesUnicos;
    }

    function toStringArray($array){
        return implode(",", $array);
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
    
    function EstadosEnFilas($respuesta){
        //return $respuesta;
        $idGrupo = 0 ;
        $FilasEnGrupo = 0;
        $GropoDeEstadosDePieza=[];
        $PiezasConEstadosEnFila = [];
        $keys = array_keys($respuesta[0]);
        for($i=0; $i < count($respuesta); $i++){
            if($i>0){
                $FilaActual = $respuesta[$i];
                $FilaAnterior = $respuesta[$i-1];
                if($FilaActual[$keys[3]] == $FilaAnterior[$keys[3]] ){
                    $GropoDeEstadosDePieza[$idGrupo][$FilasEnGrupo] = $FilaActual;
                    $FilasEnGrupo++;
                }else{
                    $idGrupo++;
                    $FilasEnGrupo=0;
                    $GropoDeEstadosDePieza[$idGrupo][$FilasEnGrupo] = $FilaActual;
                    $FilasEnGrupo++;
                }
                
            }else{
                $GropoDeEstadosDePieza[$idGrupo][$FilasEnGrupo] = $respuesta[0];//8000000
                $FilasEnGrupo++;
            }
        }
        //return $GropoDeEstadosDePieza;
        
        $Respuesta = [];
        for($i=0; $i < count($GropoDeEstadosDePieza); $i++){
            $EstadosDePiezas = $GropoDeEstadosDePieza[$i];
            $PiezasConEstadosEnFila[0] = $EstadosDePiezas[0][3];
            $PiezasConEstadosEnFila[1] = $EstadosDePiezas[0][0];
            $PiezasConEstadosEnFila[2] = $EstadosDePiezas[0][9];
            $PiezasConEstadosEnFila[3] = utf8_encode($EstadosDePiezas[0][10]);
            $PiezasConEstadosEnFila[4] = utf8_encode($EstadosDePiezas[0][11]);
            $PiezasConEstadosEnFila[5] = $EstadosDePiezas[0][12];
            $PiezasConEstadosEnFila[6] = utf8_encode($EstadosDePiezas[0][13]);
            $PiezasConEstadosEnFila[7] = utf8_encode($EstadosDePiezas[0][8]);
            $PiezasConEstadosEnFila[8] = $EstadosDePiezas[0][7];
            
            $PiezasConEstadosEnFila[9] = null;
            
            $PiezasConEstadosEnFila[10] = null;
            $PiezasConEstadosEnFila[11] = null;
            $PiezasConEstadosEnFila[12] = null;
            $PiezasConEstadosEnFila[13] = null;
            $PiezasConEstadosEnFila[14] = null;
            $PiezasConEstadosEnFila[15] = null;
            $PiezasConEstadosEnFila[16] = null;
            $PiezasConEstadosEnFila[17] = null;
            $PiezasConEstadosEnFila[18] = null;
            $PiezasConEstadosEnFila[19] = null;
            $PiezasConEstadosEnFila[20] = null;
            $PiezasConEstadosEnFila[21] = null;
            $PiezasConEstadosEnFila[22] = null;
            $PiezasConEstadosEnFila[23] = null;
            $PiezasConEstadosEnFila[24] = null;
            $PiezasConEstadosEnFila[25] = null;
            $PiezasConEstadosEnFila[26] = null;
            $PiezasConEstadosEnFila[27] = null;
            $PiezasConEstadosEnFila[28] = null;
            $PiezasConEstadosEnFila[29] = null;
            $PiezasConEstadosEnFila[30] = null;
            $PiezasConEstadosEnFila[31] = utf8_encode($EstadosDePiezas[0][8]);
            $PiezasConEstadosEnFila[32] = $EstadosDePiezas[0][7];
            $PiezasConEstadosEnFila[33] = $EstadosDePiezas[0][14];
            $PiezasConEstadosEnFila[34] = null;
            $PiezasConEstadosEnFila[35] = null;
            $PiezasConEstadosEnFila[36] = '';
            /*
            $PiezasConEstadosEnFila[34] = $EstadosDePiezas[0][14];
            $PiezasConEstadosEnFila[35] = 'NULL';
            $PiezasConEstadosEnFila[36] = 'NULL';
            $PiezasConEstadosEnFila[37] = 'NULL';
            */
            
            
            //.....
            $EstadosDePiezas = $GropoDeEstadosDePieza[$i];
            $contadorDeEnvios=0;
            $contadorDeRecepcion=0;
            $contadorDedistribucion=0;
            for($j=0; $j< count($EstadosDePiezas) ; $j++){
                $estado = utf8_encode($EstadosDePiezas[$j][5]);
                
                if($EstadosDePiezas[$j][2] == 13 ){
                    $PiezasConEstadosEnFila[34] = $EstadosDePiezas[$j][15];
                    $PiezasConEstadosEnFila[35] = $EstadosDePiezas[$j][16];
                    $PiezasConEstadosEnFila[36] = $EstadosDePiezas[$j][17];
                    //$PiezasConEstadosEnFila[36] = $EstadosDePiezas[0][16];
                    //$PiezasConEstadosEnFila[37] = $EstadosDePiezas[0][17];
                }
                
                //Logico
                if($EstadosDePiezas[$j][2] == 1 ){
                    $PiezasConEstadosEnFila[10] = $estado;
                    $PiezasConEstadosEnFila[11] = $EstadosDePiezas[$j][1];
                }else{
                    //Fisico
                    if($EstadosDePiezas[$j][2] == 33 ){
                        $PiezasConEstadosEnFila[12] = $estado;
                        $PiezasConEstadosEnFila[13] = $EstadosDePiezas[$j][1];
                    }else{
                        //Enviado A
                        if($EstadosDePiezas[$j][18] == 5 and $EstadosDePiezas[$j][2] != 32 and $contadorDeEnvios == 0){//
                            $PiezasConEstadosEnFila[14] = $estado;
                            $PiezasConEstadosEnFila[15] = $EstadosDePiezas[$j][1];
                            $contadorDeEnvios++;
                        }else{
                            //En
                            if($EstadosDePiezas[$j][18] == 6 and $EstadosDePiezas[$j][2] != 33 and $contadorDeRecepcion == 0){//fpt.flash_piezas_estados_declarados
                                $PiezasConEstadosEnFila[16] = $estado;
                                $PiezasConEstadosEnFila[17] = $EstadosDePiezas[$j][1];
                                $contadorDeRecepcion++;
                            }else{
                                //Enviado A
                                if($EstadosDePiezas[$j][18] == 5 and $EstadosDePiezas[$j][2] != 32 and $contadorDeEnvios >= 1){
                                    $PiezasConEstadosEnFila[18] = $estado;
                                    $PiezasConEstadosEnFila[19] = $EstadosDePiezas[$j][1];
                                }else{
                                    //En
                                    if($EstadosDePiezas[$j][18] == 6 and $EstadosDePiezas[$j][2] != 33 and $contadorDeRecepcion >= 1){
                                        $PiezasConEstadosEnFila[20] = $estado;
                                        $PiezasConEstadosEnFila[21] = $EstadosDePiezas[$j][1];
                                        $contadorDeRecepcion++;
                                        break;
                                    }else{
                                        
                                        
                                        //Distri 1 
                                        if($EstadosDePiezas[$j][2] == 2 and $contadorDedistribucion == 0){
                                            $PiezasConEstadosEnFila[22] = $EstadosDePiezas[$j][1];
                                            $contadorDedistribucion ++;
                                        }else{
                                            //Distri 2 
                                            if($EstadosDePiezas[$j][2] == 2 and $contadorDedistribucion == 1){
                                                $PiezasConEstadosEnFila[25] = $EstadosDePiezas[$j][1];
                                                    $contadorDedistribucion ++;
                                            }
                                            else{
                                                //Distri 3 
                                                if($EstadosDePiezas[$j][2] == 2  and $contadorDedistribucion >= 2){
                                                    $PiezasConEstadosEnFila[28] = $EstadosDePiezas[$j][1];
                                                    $contadorDedistribucion ++;
                                                }
                                                else{
                                                    //Resultado 1
                                                    if($EstadosDePiezas[$j][2] != 2 and $contadorDedistribucion == 1){
                                                        $PiezasConEstadosEnFila[23] = $estado;
                                                        $PiezasConEstadosEnFila[24] = $EstadosDePiezas[$j][1];
                                                    }
                                                    else{
                                                        //Resultado 2
                                                        if($EstadosDePiezas[$j][2] != 2 and $contadorDedistribucion == 2){
                                                            $PiezasConEstadosEnFila[26] = $estado;
                                                            $PiezasConEstadosEnFila[27] = $EstadosDePiezas[$j][1];
                                                        }
                                                        else{
                                                            //Resultado3
                                                            if($EstadosDePiezas[$j][2] != 2 and $contadorDedistribucion == 3){
                                                                if($PiezasConEstadosEnFila[29] == 'NULL'){
                                                                    $PiezasConEstadosEnFila[29] = $estado;
                                                                    $PiezasConEstadosEnFila[30] = $EstadosDePiezas[$j][1];   
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $PiezasConEstadosEnFila[9] = $contadorDedistribucion;
            $Respuesta[] = $PiezasConEstadosEnFila;
        }
        return $Respuesta;

        //return $respuesta;
    }

    function agregarIndices($data, $indices){
        $dataConIndices = [];
        for($i=0; $i < count($data); $i++){
            $filaConIndices = [];
            for($j=0; $j < count($data[$i]); $j++){
                $indice = $indices[$j] ?? $j;
                $filaConIndices[$indice] = $data[$i][$j];
            }
            $dataConIndices[] = $filaConIndices;
        }
        return $dataConIndices;
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