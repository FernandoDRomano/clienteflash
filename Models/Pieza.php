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
            $this->log->exception("Error al crear pieza", $e);
            throw new Exception("Ocurrió un error al crear la pieza.");
        }
    }

    public function filtrar($filtros, $con = null){
        try {
            if (!$con) {
                $con = new ConexionSispo();
            }

            $whereClauses = [];

            $this->log->info("Pieza",  "Iniciando filtrado de piezas con los siguientes filtros: ", [
                'filtros' => $filtros
            ]);

            if(empty($filtros['clienteId'])) {
                $this->log->error("Pieza", "El filtro 'clienteId' es obligatorio.");
                throw new Exception("El filtro 'clienteId' es obligatorio.");
            }

            $whereClauses[] = "fci.cliente_id = '" . $con->escapeString($filtros['clienteId']) . "'";

            if(!empty($filtros['BarcodeExterno'])) {
                $NumeroDePieza = $con->escapeString($filtros['BarcodeExterno']);
                $whereClauses[] = "fp.barcode_externo = '$NumeroDePieza'";
            } 

            if(!empty($filtros['Documento'])) {
                $DNIBusqueda = $con->escapeString($filtros['Documento']);
                $whereClauses[] = "cd.ApoderadoDocumento = '$DNIBusqueda'";
            }

            if(!empty($filtros['ApellidoYNombre'])) {
                $Destinatario = $con->escapeString($filtros['ApellidoYNombre']);
                $whereClauses[] = "fp.destinatario LIKE '%$Destinatario%'";
            }

            if(!empty($filtros['FechaI'])) {
                $Desde = $con->escapeString($filtros['FechaI']) . " 00:00:00";
                $whereClauses[] = "fci.create >= '$Desde'";
            } 

            if(!empty($filtros['FechaF'])) {
                $Hasta = $con->escapeString($filtros['FechaF']) . " 23:59:59";
                $whereClauses[] = "fci.create <= '$Hasta'";
            }

            if(!empty($filtros['piezaId'])) {
                $piezaId = $con->escapeString($filtros['piezaId']);
                $whereClauses[] = "fp.id = $piezaId";
            }

            $whereSql = '';
            if (count($whereClauses) > 0) {
                $whereSql = 'WHERE ' . implode(' AND ', $whereClauses);
            }
            
            $sql = "SELECT 
            	fp.barcode_externo AS 'Barcode'
                ,fpt.create AS 'FechaDeEstado'
                ,fpt.estado_id AS 'idEstado'
                ,fp.id AS 'idPieza'
                ,fp.id
                ,fev.nombre AS 'NombreDeEstado'
                ,fp.estado_id AS 'UltimoEstado'
                ,fp.update AS 'FechaDeUltimoEstado'
                ,fuev.nombre AS 'NombreDeUltimoEstado'
                ,fs.nombre AS 'Sucursal'
                ,RTRIM(fp.destinatario) AS 'Destinatario'
                ,RTRIM(fp.domicilio) AS 'Direccion de entrega'
                ,fp.codigo_postal AS 'Cp'
                ,fp.localidad AS 'Localidad'
                ,fp.documento AS 'documento'
                ,fp.recibio AS 'recibio'
            	,CASE
            		WHEN fp.vinculo LIKE 'APP-%' THEN SUBSTRING(fp.vinculo, 5)
            		ELSE fp.vinculo
            	END AS 'Vinculo'
                ,datos.fichero AS 'FotoDeAcuse'
                ,fev.flash_piezas_estados_declarados AS 'flash_piezas_estados_declarados'
            FROM
            	flash_piezas AS fp
                INNER JOIN flash_piezas_estados_variables fuev on fuev.id = fp.estado_id
                INNER JOIN flash_comprobantes_ingresos AS fci ON fci.id = fp.comprobante_ingreso_id
                INNER JOIN flash_comprobantes_ingresos_servicios AS fcis ON fcis.id = fp.servicio_id
                INNER JOIN flash_piezas_tracking AS fpt ON fpt.pieza_id  = fp.id
                INNER JOIN flash_piezas_estados_variables fev on fev.id = fpt.estado_id
                LEFT JOIN flash_datos_estados AS datos ON datos.flash_piezas_tracking_id  = fpt.id
                LEFT JOIN flash_piezas_cd AS cd ON cd.IdFlashPieza = fp.id
                LEFT JOIN flash_sucursales AS fs ON fs.id = fp.sucursal_id
            $whereSql
            ORDER BY
                fp.barcode_externo ,
                fp.id,
                fpt.create ASC;";

            $this->log->info("Pieza",  "Filtrando piezas con los siguientes filtros: ", [
                'filtros' => $filtros,
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);

            $result = $con->consultaRetorno($sql);
            $piezas = [];

            while ($row = $result->fetch_row()) {
                $piezas[] = $row;
            }

            return $piezas;

        } catch (Exception $e) {
            $this->log->exception("Error al filtrar piezas", $e);
            throw new Exception("Ocurrió un error al filtrar las piezas.");
        }
    }
}