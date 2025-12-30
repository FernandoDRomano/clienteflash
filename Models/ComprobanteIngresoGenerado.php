<?php 

namespace Models;

use Exception; 
use Models\ConexionSispo;
use Helpers\LogManager;

class ComprobanteIngresoGenerado{
    private $log;
    public function __construct() {
        $this->log = new LogManager();
    }

    private function generarNumeroRandom($userId, $length = 10){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $userId . $randomString;
    }

    private function numeroComprobanteDisponible($numeroComprobante, $con = null){
        try {
            if (!$con) {
                $con = new ConexionSispo();
            }
            $sql = "
                SELECT numero
                FROM sispoc5_gestionpostal.flash_comprobantes_ingresos_generados
                WHERE numero='" . $numeroComprobante . "'
                limit 1
            ";

            $this->log->info("ComprobanteIngresoGenerado",  "Verificando disponibilidad de numero de comprobante generado: {$numeroComprobante}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);
            
            $result = $con->consultaRetorno($sql);
            return ($result->num_rows === 0);

        } catch (Exception $e) {
            $this->log->exception("Error al verificar disponibilidad de numero de comprobante generado: ", $e->getMessage());
            throw $e;
        }
    }

    public function crear($userId){
        try {
            $con = new ConexionSispo();
            $numeroComprobante = null;

            do {
                $numeroComprobante = $this->generarNumeroRandom($userId, 10);
            } while (!$this->numeroComprobanteDisponible($numeroComprobante));

            $sql = "
                INSERT INTO flash_comprobantes_ingresos_generados
                (
                    talonario_id
                    , numero
                    , estado
                    , flash_comprobantes_ingresos_generados.create
                    , flash_comprobantes_ingresos_generados.update
                    , create_user_id
                    , update_user_id
                )
                VALUES (
                    '1'
                    , '$numeroComprobante'
                    , '1'
                    , CURRENT_TIMESTAMP
                    , NULL
                    , NULL
                    , NULL
                );
            ";
            
            $result = $con->insertar($sql);
            
            $this->log->info("ComprobanteIngresoGenerado",  "Comprobante de ingreso generado creado correctamente: ID {$result}, Numero {$numeroComprobante}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);

            return [
                'id' => $result,
                'numero' => $numeroComprobante
            ];
        } catch (Exception $e) {
            $this->log->exception("Error al crear comprobante de ingreso generado: ", $e->getMessage());
            throw $e;
        }
    }
}