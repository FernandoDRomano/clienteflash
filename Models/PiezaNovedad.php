<?php

namespace Models;

use Exception;
use Models\ConexionSispo;
use Helpers\LogManager;

class PiezaNovedad {

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
                INSERT INTO flash_piezas_novedades
                (
                    pieza_id
                    , usuario_id
                    , cantidad
                    , estado_actual_id
                    , estado_nuevo_id
                    , fecha_de_novedad
                    , `update`
                )
                VALUES
                (
                    '" . $data['piezaId'] . "'
                    , '0'
                    , '1'
                    , '1'
                    , '1'
                    , CURRENT_TIMESTAMP
                    , CURRENT_TIMESTAMP
                )
            ";
            
            $result = $con->insertar($sql);

            $this->log->info("PiezaNovedad",  "Pieza novedad creada correctamente: ID {$result}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);

            return $result;
        } catch (Exception $e) {
            $this->log->exception("Error al crear pieza novedad: ", $e->getMessage());
            throw $e;
        }
    }
}