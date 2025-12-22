<?php 

namespace Models;

use Exception;

include 'Conexion.php';

class CartaDocumento {

    const ESTADO_CREADA = 1;
    const ESTADO_AUTORIZADA = 2;

    function __construct() {
    }

    public function crear($data){
        try {
            // Debug: log the data
            error_log("DEBUG - Data recibida: " . print_r($data, true));
            
            $con = new Conexion();
            $sql = "
                INSERT INTO cartas_documentos (
                    created_user_id,
                    cliente_id,
                    estado,
                    destinatario_nombre,
                    destinatario_apellido,
                    destinatario_provincia,
                    destinatario_localidad,
                    destinatario_cp,
                    destinatario_calle,
                    destinatario_numero,
                    destinatario_piso,
                    destinatario_departamento,
                    remitente_nombre,
                    remitente_provincia,
                    remitente_localidad,
                    remitente_cp,
                    remitente_calle,
                    remitente_numero,
                    remitente_piso,
                    remitente_departamento,
                    remitente_email,
                    remitente_celular,
                    remitente_observaciones,
                    firmante_nombre,
                    firmante_apellido,
                    firmante_tipo_documento,
                    firmante_documento,
                    firma_cliente,
                    contenido
                )
                VALUES (
                    '{$data['created_user_id']}',
                    '{$data['cliente_id']}',
                    '" . self::ESTADO_CREADA . "',
                    '{$data['destinatario_nombre']}',
                    '{$data['destinatario_apellido']}',
                    '{$data['destinatario_provincia']}',
                    '{$data['destinatario_localidad']}',
                    '{$data['destinatario_cp']}',
                    '{$data['destinatario_calle']}',
                    '{$data['destinatario_numero']}',
                    '{$data['destinatario_piso']}',
                    '{$data['destinatario_departamento']}',
                    '{$data['remitente_nombre']}',
                    '{$data['remitente_provincia']}',
                    '{$data['remitente_localidad']}',
                    '{$data['remitente_cp']}',
                    '{$data['remitente_calle']}',
                    '{$data['remitente_numero']}',
                    '{$data['remitente_piso']}',
                    '{$data['remitente_departamento']}',
                    '{$data['remitente_email']}',
                    '{$data['remitente_celular']}',
                    '{$data['remitente_observaciones']}',
                    '{$data['firmante_nombre']}',
                    '{$data['firmante_apellido']}',
                    '{$data['firmante_tipo_documento']}',
                    '{$data['firmante_documento']}',
                    '{$data['firma_cliente']}',
                    '{$data['contenido']}'
                );
            ";
            
            // Debug: log the SQL
            error_log("DEBUG - SQL generado: " . $sql);
            
            $result = $con->insertar($sql);
            
            // Debug: log the result
            error_log("DEBUG - Resultado del insert: " . ($result ? $result : 'false'));
            
            return $result;

        } catch (Exception $e) {
            //registrar en el log de php
            error_log("Error al crear carta documento: " . $e->getMessage());
            echo "Error al crear carta documento."; die();
        }
    }

    public function obtenerPorId($id){
        try {
            $con = new Conexion();
            $sql = "SELECT * FROM cartas_documentos WHERE id = '{$id}' LIMIT 1;";
            $resultado = $con->consultaRetorno($sql);
            return mysqli_fetch_assoc($resultado);
        } catch (Exception $e) {
            error_log("Error al obtener carta documento por ID: " . $e->getMessage());
            echo "Error al obtener carta documento."; die();
        }
    }

    public function filtrar($filtro){
        try {
            $con = new Conexion();
            $wheres = [];
            
            if(isset($filtro['user_id']) && !empty($filtro['user_id'])){
                $wheres[] = " created_user_id = '{$filtro['user_id']}' ";
            }

            if(isset($filtro['cliente_id']) && !empty($filtro['cliente_id'])){
                $wheres[] = " cliente_id = '{$filtro['cliente_id']}' ";
            }

            if(isset($filtro['estado']) && !empty($filtro['estado'])){
                $wheres[] = " estado = '{$filtro['estado']}' ";
            }

            if(isset($filtro['fecha_desde']) && !empty($filtro['fecha_desde'])){
                $wheres[] = " created_at >= '{$filtro['fecha_desde']}' ";
            }

            if(isset($filtro['fecha_hasta']) && !empty($filtro['fecha_hasta'])){
                $wheres[] = " created_at <= '{$filtro['fecha_hasta']}' ";
            }

            $whereSql = "";
            if(count($wheres) > 0){
                $whereSql = " WHERE " . implode(" AND ", $wheres);
            }

            $sql = "SELECT * FROM cartas_documentos " . $whereSql . " ORDER BY created_at DESC;";
            $resultado = $con->consultaRetorno($sql);
            return mysqli_fetch_assoc($resultado);

        } catch (Exception $e) {
            error_log("Error al filtrar cartas documento por usuario: " . $e->getMessage());
            echo "Error al filtrar cartas documento."; die();
        }
    }

    public function autorizar($id, $usuario_id){
        try {
            $con = new Conexion();
            $sql = "
                UPDATE cartas_documentos 
                SET estado = '" . self::ESTADO_AUTORIZADA . "', 
                    authorized_user_id = '{$usuario_id}', 
                    authorized_at = CURRENT_TIMESTAMP 
                WHERE id = '{$id}';
            ";
            $con->consultaSimple($sql);
        } catch (Exception $e) {
            error_log("Error al autorizar carta documento: " . $e->getMessage());
            echo "Error al autorizar carta documento."; die();
        }
    }
}