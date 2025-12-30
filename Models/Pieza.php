<?php

namespace Models;

use Exception;
use Models\ConexionSispo;
use Helpers\LogManager;

class Pieza {

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
                INSERT INTO flash_piezas
                (
                    usuario_id
                    , servicio_id
                    , tipo_id
                    , sucursal_id
                    , estado_id
                    , cantidad
                    , comprobante_ingreso_id
                    , barcode_externo
                    , destinatario
                    , domicilio
                    , codigo_postal
                    , localidad
                    , `create`
                    , `update`
                )
                VALUES 
                (
                    '2'
                    ,'" . $data['comprobanteIngresoServicioId'] . "'
                    ,'2'
                    ,'4'
                    ,'1'
                    ,'1'
                    ,'" . $data['comprobanteIngresoId'] . "'
                    ,'" . $data['codigo_externo'] . "'
                    ,'" . $data['destinatario'] . "'
                    ,'" . $data['domicilio'] . "'
                    ,'" . $data['codigo_postal'] . "'
                    ,'" . $data['localidad'] . "'
                    , CURRENT_TIMESTAMP
                    , CURRENT_TIMESTAMP
                )
            ";
            
            $result = $con->insertar($sql);

            $this->log->info("Pieza",  "Pieza creada correctamente: ID {$result}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]); 
            
            return $result;
        } catch (Exception $e) {
            $this->log->exception("Error al crear pieza: ", $e->getMessage());
            throw new Exception("Ocurrió un error al crear la pieza.");
        }
    }
}