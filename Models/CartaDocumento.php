<?php 

namespace Models;

use Exception;
use Models\Conexion;
use Models\CartaDocumentoEstado;
use Helpers\LogManager;

class CartaDocumento {

    const MODULO_CARTA_DOCUMENTO_SIMPLE = 'SIMPLE';
    const MODULO_CARTA_DOCUMENTO_MASIVA = 'MASIVA';
    private $log;

    function __construct() {
        $this->log = new LogManager();
    }

    public function crear($data){
        try {

            if(!isset($data['destinatario_provincia_nombre']) || empty($data['destinatario_provincia_nombre'])){
                $data['destinatario_provincia_nombre'] = null;
            }

            if(!isset($data['destinatario_localidad_nombre']) || empty($data['destinatario_localidad_nombre'])){
                $data['destinatario_localidad_nombre'] = null;
            }

            if($data['destinatario_provincia_nombre'] == null && $data['destinatario_provincia'] == null){
                throw new Exception("La provincia del destinatario es obligatoria.");
            }

            if($data['destinatario_localidad_nombre'] == null && $data['destinatario_localidad'] == null){
                throw new Exception("La localidad del destinatario es obligatoria.");
            }

            if(!isset($data['origen_modulo']) || empty($data['origen_modulo'])){
                $data['origen_modulo'] = self::MODULO_CARTA_DOCUMENTO_SIMPLE;
            }
            
            $destinatario_provincia = $data['destinatario_provincia'] === null ? 'NULL' : "'{$data['destinatario_provincia']}'";
            $destinatario_provincia_nombre = $data['destinatario_provincia_nombre'] === null ? 'NULL' : "'{$data['destinatario_provincia_nombre']}'";
            $destinatario_localidad = $data['destinatario_localidad'] === null ? 'NULL' : "'{$data['destinatario_localidad']}'";
            $destinatario_localidad_nombre = $data['destinatario_localidad_nombre'] === null ? 'NULL' : "'{$data['destinatario_localidad_nombre']}'";
            
            $con = new Conexion();
            $sql = "
                INSERT INTO cartas_documentos (
                    created_user_id,
                    cliente_id,
                    estado,
                    destinatario_nombre,
                    destinatario_apellido,
                    destinatario_provincia,
                    destinatario_provincia_nombre,
                    destinatario_localidad,
                    destinatario_localidad_nombre,
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
                    contenido,
                    origen_modulo
                )
                VALUES (
                    '{$data['created_user_id']}',
                    '{$data['cliente_id']}',
                    '" . CartaDocumentoEstado::PENDIENTE . "',
                    '{$data['destinatario_nombre']}',
                    '{$data['destinatario_apellido']}',
                    {$destinatario_provincia},
                    {$destinatario_provincia_nombre},
                    {$destinatario_localidad},
                    {$destinatario_localidad_nombre},
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
                    '{$data['contenido']}',
                    '{$data['origen_modulo']}'
                );
            ";
            
            $result = $con->insertar($sql);
            
            return $result;

        } catch (Exception $e) {
            $this->log->exception("Error al crear carta documento: ", $e->getMessage());
            throw $e;
        }
    }

    public function obtenerPorId($id){
        try {
            $con = new Conexion();
            $sql = "SELECT * FROM cartas_documentos WHERE id = '{$id}' LIMIT 1;";
            $resultado = $con->consultaRetorno($sql);
            return mysqli_fetch_assoc($resultado);
        } catch (Exception $e) {
            $this->log->exception("Error al obtener carta documento por ID: ", $e->getMessage());
            throw $e;
        }
    }

    public function filtrar($filtro){
        try {
            $con = new Conexion();
            $wheres = [];
            
            if(isset($filtro['user_id']) && !empty($filtro['user_id'])){
                $wheres[] = " cd.created_user_id = '{$filtro['user_id']}' ";
            }

            if(isset($filtro['cliente_id']) && !empty($filtro['cliente_id'])){
                $wheres[] = " cd.cliente_id = '{$filtro['cliente_id']}' ";
            }

            if(isset($filtro['estado']) && !empty($filtro['estado'])){
                $wheres[] = " cd.estado = '{$filtro['estado']}' ";
            }

            if(isset($filtro['fecha_desde']) && !empty($filtro['fecha_desde'])){
                $wheres[] = " cd.created_at >= '{$filtro['fecha_desde']} 00:00:00' ";
            }

            if(isset($filtro['fecha_hasta']) && !empty($filtro['fecha_hasta'])){
                $wheres[] = " cd.created_at <= '{$filtro['fecha_hasta']} 23:59:59' ";
            }

            $whereSql = "";
            if(count($wheres) > 0){
                $whereSql = " WHERE " . implode(" AND ", $wheres);
            }

            $sql = "
                SELECT 
                    cd.*,
                    cl_creo.Id AS usuario_creo_id,
                    cl_creo.Alias AS usuario_creo_username,
                    cl_creo.Nombre AS usuario_creo_nombre,
                    cl_creo.Apellido AS usuario_creo_apellido,
                    cl_autorizo.Id AS usuario_autorizo_id,
                    cl_autorizo.Alias AS usuario_autorizo_username,
                    cl_autorizo.Nombre AS usuario_autorizo_nombre,
                    cl_autorizo.Apellido AS usuario_autorizo_apellido,
                    cl_rechazo.Id AS usuario_rechazo_id,
                    cl_rechazo.Alias AS usuario_rechazo_username,
                    cl_rechazo.Nombre AS usuario_rechazo_nombre,
                    cl_rechazo.Apellido AS usuario_rechazo_apellido,
                    p.Nombre AS provincia_nombre,
                    l.nombre AS localidad_nombre
                FROM cartas_documentos cd 
                LEFT JOIN cliente cl_creo ON cd.created_user_id = cl_creo.Id
                LEFT JOIN cliente cl_autorizo ON cd.authorized_user_id = cl_autorizo.Id
                LEFT JOIN cliente cl_rechazo ON cd.refused_user_id = cl_rechazo.Id
                LEFT JOIN provincias p on p.id = cd.destinatario_provincia
                LEFT JOIN localidades l on l.id = cd.destinatario_localidad
                " . $whereSql . " ORDER BY created_at DESC;";
            $datos = $con->consultaRetorno($sql);

            $cartasDocumentos = [];
            while ($row = mysqli_fetch_assoc($datos)) {
                $cartasDocumentos[] = $row;
            }

            return $cartasDocumentos;

        } catch (Exception $e) {
            $this->log->exception("Error al filtrar cartas documentos: ", $e->getMessage());
            throw $e;
        }
    }

    public function autorizar($id, $usuario_id){
        try {
            $con = new Conexion();
            $sql = "
                UPDATE cartas_documentos 
                SET estado = '" . CartaDocumentoEstado::AUTORIZADO . "', 
                    authorized_user_id = '{$usuario_id}', 
                    authorized_at = CURRENT_TIMESTAMP 
                WHERE id = '{$id}';
            ";
            $con->consultaSimple($sql);
        } catch (Exception $e) {
            $this->log->exception("Error al autorizar carta documento: ", $e->getMessage());
            throw new Exception("Error al autorizar carta documento.");
        }
    }

    public function rechazar($id, $usuario_id){
        try {
            $con = new Conexion();
            $sql = "
                UPDATE cartas_documentos 
                SET estado = '" . CartaDocumentoEstado::RECHAZADO . "', 
                    refused_user_id = '{$usuario_id}', 
                    refused_at = CURRENT_TIMESTAMP 
                WHERE id = '{$id}';
            ";
            $con->consultaSimple($sql);
        } catch (Exception $e) {
            $this->log->exception("Error al rechazar carta documento: ", $e->getMessage());
            throw new Exception("Error al rechazar carta documento.");
        }
    }
}