<?php 

namespace Models;

use Exception;
use Models\ConexionSispo;
use Helpers\LogManager;

class ComprobanteIngreso {
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
                INSERT INTO flash_comprobantes_ingresos
                (
                    empresa_id
                    , sucursal_id
                    , cliente_id
                    , departamento_id
                    , numero
                    , estado
                    , fecha_pedido
                    , cantidad
                    , `create`
                    , `update`
                )
                VALUES 
                (
                    null
                    ,'4'
                    ,'" . $data['clienteId'] . "'
                    ,'" . $data['departamentoId'] . "'
                    ,'" . $data['numero'] . "'
                    ,'0'
                    ,'" . date('Y-m-d') . "'
                    ,'1'
                    , CURRENT_TIMESTAMP
                    , CURRENT_TIMESTAMP
                )
            ";
            
            $result = $con->insertar($sql);

            $this->log->info("ComprobanteIngreso",  "Comprobante de ingreso creado correctamente: ID {$result}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);

            return $result;
        } catch (Exception $e) {
            $this->log->exception("Error al crear comprobante de ingreso: ", $e->getMessage());
            throw $e;
        }
    }
}