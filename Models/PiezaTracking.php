<?php

namespace Models;

use Exception;
use Models\ConexionSispo;
use Helpers\LogManager;

class PiezaTracking {

    private $log;
    public function __construct() {
        $this->log = new LogManager();
    }

    public function crear($data, $con = null){
        try {
            if (!$con) {
                $con = new ConexionSispo();
            }
            $sql = "
                INSERT INTO flash_piezas_tracking
                (
                    pieza_id
                    , estado_id
                    , fecha_de_novedad
                )
                VALUES
                (
                    '" . $data['piezaId'] . "'
                    , '1'
                    , CURRENT_TIMESTAMP
                )
            ";
            
            $result = $con->insertar($sql);

            $this->log->info("PiezaTracking",  "Pieza tracking creada correctamente: ID {$result}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);

            return $result;
        } catch (Exception $e) {
            $this->log->exception("Error al crear pieza tracking: ", $e->getMessage());
            throw $e;
        }
    }
}
