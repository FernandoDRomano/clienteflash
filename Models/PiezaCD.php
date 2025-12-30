<?php 

namespace Models;

use Exception;
use Models\ConexionSispo;
use Helpers\LogManager;

class PiezaCD {

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
                INSERT INTO flash_piezas_cd
                (
                    IdFlashPieza
                    , RemitenteNombre
                    , RemitenteApellido
                    , RemitenteCodigoPostal
                    , RemitenteProvincia
                    , RemitenteLocalidad
                    , RemitenteCalle
                    , RemitenteNumero
                    , RemitentePiso
                    , RemitenteDepartamento
                    , DestinatarioNombre
                    , DestinatarioApellido
                    , DestinatarioCodigoPostal
                    , DestinatarioProvincia
                    , DestinatarioLocalidad
                    , DestinatarioCalle
                    , DestinatarioNumero
                    , DestinatarioPiso
                    , DestinatarioDepartamento
                    , RemitenteEmail
                    , RemitenteCelular
                    , RemitenteObservaciones
                    , ApoderadoNombre
                    , ApoderadoApellido
                    , ApoderadoDNITipo
                    , ApoderadoDocumento
                    , ApoderadoFirma
                    , Formulario
                )
                VALUES
                (
                    '" . $data['piezaId'] . "'
                    ,'" . $data['remitenteNombre'] . "'
                    ,'" . $data['remitenteApellido'] . "'
                    ,'" . $data['remitenteCP'] . "'
                    ,'" . $data['remitenteProvincia'] . "'
                    ,'" . $data['remitenteLocalidad'] . "'
                    ,'" . $data['remitenteCalle'] . "'
                    ,'" . $data['remitenteNumero'] . "'
                    ,'" . $data['remitentePiso'] . "'
                    ,'" . $data['remitenteDepartamento'] . "'
                    ,'" . $data['destinatarioNombre'] . "'
                    ,'" . $data['destinatarioApellido'] . "'
                    ,'" . $data['destinatarioCP'] . "'
                    ,'" . $data['destinatarioProvincia'] . "'
                    ,'" . $data['destinatarioLocalidad'] . "'
                    ,'" . $data['destinatarioCalle'] . "'
                    ,'" . $data['destinatarioNumero'] . "'
                    ,'" . $data['destinatarioPiso'] . "'
                    ,'" . $data['destinatarioDepartamento'] . "'
                    ,'" . $data['destinatarioEmail'] . "'
                    ,'" . $data['destinatarioCelular'] . "'
                    ,'" . $data['destinatarioObservaciones'] . "'
                    ,'" . $data['apoderadoNombre'] . "'
                    ,'" . $data['apoderadoApellido'] . "'
                    ,'" . $data['apoderadoTipoDocumento'] . "'
                    ,'" . $data['apoderadoDocumento'] . "'
                    ,'" . $data['apoderadoFirma'] . "'
                    , '" . $data['formulario'] . "'
                )
            ";
            
            $result = $con->insertar($sql);

            $this->log->info("PiezaCD",  "Pieza CD creada correctamente: ID {$result}", [
                'sql' => preg_replace('/\s+/', ' ', trim($sql))
            ]);
            
            return $result;
        } catch (Exception $e) {
            $this->log->exception("Error al crear pieza cd: ", $e->getMessage());
            throw new Exception("Ocurrió un error al crear la pieza cd.");
        }
    }
}