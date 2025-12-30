<?php

namespace Models;

use Exception;
use Models\ConexionSispo;
use Helpers\LogManager;

class ComprobanteIngresoServicio {

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
                INSERT INTO flash_comprobantes_ingresos_servicios
                (
                    comprobante_ingreso_id
                    , servicio_id
                    , cantidad
                    , disponible
                    , remito
                    , `create`
                    , `update`
                )
                VALUES
                (
                    '" . $data['comprobanteIngresoId'] . "'
                    ,'" . $data['servicioId'] . "'
                    ,'" . $data['cantidad'] . "'
                    ,'0'
                    ,'0'
                    , CURRENT_TIMESTAMP
                    , CURRENT_TIMESTAMP
                )
            ";
            
            $result = $con->insertar($sql);

            $this->log->info("ComprobanteIngresoServicio",  "Comprobante de ingreso servicio creado correctamente: ID {$result}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);

            return $result;
        } catch (Exception $e) {
            $this->log->exception("Error al crear comprobante de ingreso servicio: ", $e->getMessage());
            throw $e;
        }
    }
}