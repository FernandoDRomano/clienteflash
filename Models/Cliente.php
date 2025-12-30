<?php 

namespace Models;

use Exception;
use Models\Conexion;
use Models\ConexionSispo;
use Helpers\LogManager;

class Cliente {

    private $logManager;

    function __construct() {
        $this->logManager = new LogManager();
    }   

    function getUsuariosByCliente($clienteId) {
        try {
            if (empty($clienteId)) {
                throw new Exception("El ID del cliente no puede estar vacío.");
            }

            if (!is_numeric($clienteId)) {
                throw new Exception("El ID del cliente debe ser un número válido.");
            }

            $con = new Conexion();
            $sql = "
                SELECT c.Id as id, c.Alias as username, c.SispoId as cliente_sispo_id, c.idperfil as perfil_id
                FROM cliente AS c
                WHERE c.SispoId = {$clienteId}
            ";
            $datos = $con->consultaRetorno($sql);
            $usuarios = [];
            while ($row = mysqli_fetch_assoc($datos)) {
                $usuarios[] = $row;
            }

            return $usuarios;
        } catch (Exception $e) {
            $this->logManager->exception("Ocurrio un error al obtener los usuarios del cliente {$clienteId}", $e);
            return [];
        }
    }

    function getDepartamentoCliente($clienteId) {
        try {
            if (empty($clienteId)) {
                throw new Exception("El ID del cliente no puede estar vacío.");
            }

            if (!is_numeric($clienteId)) {
                throw new Exception("El ID del cliente debe ser un número válido.");
            }

            $con = new ConexionSispo();
            $sql = "
                SELECT id as 'id'
                FROM sispoc5_gestionpostal.flash_clientes_departamentos
                WHERE cliente_id = '" . $clienteId . "'
                limit 1
            ";
            $datos = $con->consultaRetorno($sql);
            if ($row = mysqli_fetch_assoc($datos)) {
                return $row['id'];
            } else {
                throw new Exception("No se encontró departamento para el cliente con ID {$clienteId}.");
            }
        } catch (Exception $e) {
            $this->logManager->exception("Ocurrio un error al obtener el departamento del cliente {$clienteId}", $e);
            throw $e;
        }
    }
}