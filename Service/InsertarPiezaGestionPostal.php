<?php

namespace Service;

use Exception;
use Models\ComprobanteIngresoGenerado;
use Models\ComprobanteIngreso;
use Models\ComprobanteIngresoServicio;
use Models\Pieza;
use Models\PiezaCD;
use Models\Cliente;
use Models\ConexionSispo;
use Helpers\LogManager;

class InsertarPiezaGestionPostal {

    const servicioId = "4477"; 
    private $log;

    public function __construct() {
        $this->log = new LogManager();
    }

    public function ejecutar($data) {
        $con = new ConexionSispo();
        
        try {
            // Iniciar transacción
            $con->beginTransaction();
            $this->log->info("InsertarPiezaGestionPostal", "Iniciando transacción para inserción de pieza en Gestión Postal");

            $cliente = new Cliente();
            $departamentoId = $cliente->getDepartamentoCliente($data['clienteId']);

            // Crear Comprobante Ingreso Generado
            $comprobanteIngresoGeneradoModel = new ComprobanteIngresoGenerado();
            $comprobanteIngresoGenerado = $comprobanteIngresoGeneradoModel->crear($data['clienteId'], $con);

            // Crear Comprobante de Ingreso
            $comprobanteIngresoModel = new ComprobanteIngreso();
            $comprobanteIngresoId = $comprobanteIngresoModel->crear([
                'clienteId' => $data['clienteId'],
                'departamentoId' => $departamentoId,
                'numero' => $comprobanteIngresoGenerado['numero']
            ], $con);

            // Crear Comprobante de Ingreso Servicio
            $comprobanteIngresoServicioModel = new ComprobanteIngresoServicio();
            $comprobanteIngresoServicioId = $comprobanteIngresoServicioModel->crear([
                'comprobanteIngresoId' => $comprobanteIngresoId,
                'servicioId' => self::servicioId,
                'cantidad' => 1
            ], $con);

            // Crear Pieza
            $piezaModel = new Pieza();
            $piezaId = $piezaModel->crear([
                'comprobanteIngresoServicioId' => $comprobanteIngresoServicioId,
                'comprobanteIngresoId' => $comprobanteIngresoId,
                'codigo_externo' => $data['codigo_externo'],
                'destinatario' => $data['destinatario'],
                'domicilio' => $data['domicilio'],
                'codigo_postal' => $data['codigo_postal'],
                'localidad' => $data['localidad']
            ], $con);

            // Crear Pieza CD
            $piezaCDModel = new PiezaCD();
            $piezaCDId = $piezaCDModel->crear([
                'piezaId' => $piezaId,
                'remitenteNombre' => $data['remitenteNombre'],
                'remitenteApellido' => $data['remitenteApellido'],
                'remitenteCP' => $data['remitenteCP'],
                'remitenteProvincia' => $data['remitenteProvincia'],
                'remitenteLocalidad' => $data['remitenteLocalidad'],
                'remitenteCalle' => $data['remitenteCalle'],
                'remitenteNumero' => $data['remitenteNumero'],
                'remitentePiso' => $data['remitentePiso'],
                'remitenteDepartamento' => $data['remitenteDepartamento'],
                'destinatarioNombre' => $data['destinatarioNombre'],
                'destinatarioApellido' => $data['destinatarioApellido'],
                'destinatarioCP' => $data['destinatarioCP'],
                'destinatarioProvincia' => $data['destinatarioProvincia'],
                'destinatarioLocalidad' => $data['destinatarioLocalidad'],
                'destinatarioCalle' => $data['destinatarioCalle'],
                'destinatarioNumero' => $data['destinatarioNumero'],
                'destinatarioPiso' => $data['destinatarioPiso'],
                'destinatarioDepartamento' => $data['destinatarioDepartamento'],
                'destinatarioEmail' => $data['destinatarioEmail'],
                'destinatarioCelular' => $data['destinatarioCelular'],
                'destinatarioObservaciones' => $data['destinatarioObservaciones'],
                'apoderadoNombre' => $data['apoderadoNombre'],
                'apoderadoApellido' => $data['apoderadoApellido'],  
                'apoderadoTipoDocumento' => $data['apoderadoTipoDocumento'],
                'apoderadoDocumento' => $data['apoderadoDocumento'],
                'apoderadoFirma' => $data['apoderadoFirma'],
                'formulario' => $data['formulario']
            ], $con);

            $resultado = [
                'comprobanteIngresoGeneradoId' => $comprobanteIngresoGenerado['id'],
                'numero' => $comprobanteIngresoGenerado['numero'],
                'comprobanteIngresoId' => $comprobanteIngresoId,
                'comprobanteIngresoServicioId' => $comprobanteIngresoServicioId,
                'piezaId' => $piezaId,
                'piezaCDId' => $piezaCDId
            ];

            $con->commit();
            $this->log->info("InsertarPiezaGestionPostal", "Transacción completada exitosamente. Pieza insertada en Gestión Postal", $resultado);

            return $resultado;
        } catch (Exception $e) {
            $con->rollback();
            $this->log->exception("Error al insertar pieza en Gestión Postal. Transacción revertida: ", $e->getMessage());
            throw $e;
        }
    }
}