<?php

namespace Models;

use Exception;
use Helpers\LogManager;
use Models\Conexion;
use Models\ConexionSispo;

class Log {

	private $logger;
	private $us_name;
	private $us_password;
	private $us_estado;
	private $us_codseg;

	const CANTIDAD_DE_INTENTOS_POR_IP = 5;
	const TIEMPO_BLOQUEO_MINUTOS = 30;

	public function __construct()
	{
		$this->us_name = null;
		$this->us_password = null;
		$this->us_estado = null;
		$this->us_codseg = null;
		$this->idusuario = null;
		$this->logger = new LogManager();
	}

	public function set($atributo, $contenido)
	{
		$this->$atributo = $contenido;
	}

	public function get($atributo)
	{
		return $this->$atributo;
	}

	public function ObtenerSucursalesEnGrupo()
	{
		$con = new Conexion();
		$sql = "
				SELECT cfseg.IdSucursales as 'Sucursales'
				FROM sispoc5_correoflash.usuario as cfu
				inner join sispoc5_correoflash.GrupoDeSucursales as cfGDS on cfGDS.Id = cfu.GrupoSucursalId
				inner join sispoc5_correoflash.SucursalesEnGrupos as cfseg on cfGDS.Id = cfseg.IdGrupoDeSucursales
				WHERE idusuario = '{$this->idusuario}'
			";
		$datos = $con->consultaRetorno($sql);

		return $datos;
	}

	public function verificarCredencialesUsuario(){
		try {
			$con = new Conexion();
			$username = $con->escapeString($this->us_name);
			
			$sql = "SELECT * FROM usuario WHERE us_name = '{$username}'";
			$datos = $con->consultaRetorno($sql);
			$user = mysqli_fetch_assoc($datos);
			
			// Usuario no existe
			if($user == null){
				$this->registrarIntentoFallido();
				return null;
			}
			
			// Verificar contraseña (hash o texto plano para compatibilidad)
			if(!empty($user['us_password'])){
				// Intentar como hash primero
				if(password_verify($this->us_password, $user['us_password'])){
					$this->limpiarIntentosFallidosUsuario();
					return $user; // Credenciales correctas
				}
				// Fallback: comparar texto plano (legacy)
				else if($this->us_password === $user['us_password']){
					$this->limpiarIntentosFallidosUsuario();
					return $user; 
				}
			}
			
			// Usuario existe pero contraseña incorrecta
			$this->registrarIntentoFallido();
			return null; 
		} catch (Exception $e) {
			$this->logger->exception("Log: Error verificando credenciales de usuario: ", $e, [
				'sql' => preg_replace('/\s+/', ' ', trim($sql))
			]);

			throw $e;
		}
	}

	public function verificarBloqueoPorIP()
	{
		try {
			$con = new Conexion();

			// Limpiar intentos antiguos
			$this->limpiarIntentosExpirados($con);

			// Escapar valores
			$ip = $con->escapeString($_SERVER['REMOTE_ADDR']);
			$username = $con->escapeString($this->us_name);

			// Contar intentos de este usuario desde esta IP
			$sql = "SELECT COUNT(*) as intentos, MAX(Bloquear) as bloqueado,
							MAX(FechaDeCreacion) as ultimo_intento
						FROM IPIntentosDeLogin 
						WHERE Ip = '{$ip}' AND Us = '{$username}'";

			$datos = $con->consultaRetorno($sql);
			$info = mysqli_fetch_assoc($datos);

			// Si está bloqueado o excedió intentos
			if ($info['intentos'] >= self::CANTIDAD_DE_INTENTOS_POR_IP || $info['bloqueado'] == '1') {
				$this->logger->warning("Log: verificarBloqueoPorIP()", "Bloqueo por IP activado para usuario: ", [
					'ip' => $ip,
					'username' => $username,
					'intentos' => $info['intentos'],
					'ultimo_intento' => $info['ultimo_intento'],
					'bloqueado' => $info['bloqueado']
				]);

				return [
					'bloqueado' => true,
					'intentos' => $info['intentos'],
					'ultimo_intento' => $info['ultimo_intento']
				];
			}

			return ['bloqueado' => false, 'intentos' => $info['intentos']];
		} catch (Exception $e) {
			$this->logger->exception("Log: Error verificando bloqueo por IP: ", $e, [
				'sql' => preg_replace('/\s+/', ' ', trim($sql))
			]);

			throw $e;
		}
	}

	private function limpiarIntentosExpirados($con)
	{
		try {
			$con = new Conexion();

			$ip = $con->escapeString($_SERVER['REMOTE_ADDR']);
			$username = $con->escapeString($this->us_name);
			$tiempoBloqueo = self::TIEMPO_BLOQUEO_MINUTOS;

			$sql = "DELETE FROM IPIntentosDeLogin 
					WHERE FechaDeCreacion < DATE_SUB(NOW(), INTERVAL {$tiempoBloqueo} MINUTE)
					AND Ip = '{$ip}' AND Us = '{$username}'";

			$con->consultaSimple($sql);
		} catch (Exception $e) {
			$this->logger->exception("Log: Error limpiando intentos expirados: ", $e, [
				'sql' => preg_replace('/\s+/', ' ', trim($sql))
			]);

			throw $e;
		}
	}

	private function registrarIntentoFallido()
	{
		try {
			$con = new Conexion();
			$ip = $con->escapeString($_SERVER['REMOTE_ADDR']);
			$username = $con->escapeString($this->us_name);
			$password = substr($con->escapeString($this->us_password), 0, 3) .  '***';
			
			$sql = "INSERT INTO IPIntentosDeLogin 
					(Id, Ip, FechaDeCreacion, Bloquear, Us, Ps) 
					VALUES (NULL, '{$ip}', NOW(), '0', '{$username}', '{$password}')";
			$con->consultaSimple($sql);
			
			// Verificar si alcanzó el límite
			$sql = "SELECT COUNT(*) as intentos FROM IPIntentosDeLogin 
					WHERE Ip = '{$ip}' AND Us = '{$username}'";
			$datos = $con->consultaRetorno($sql);
			$count = mysqli_fetch_assoc($datos);
			
			if($count['intentos'] >= self::CANTIDAD_DE_INTENTOS_POR_IP){
				// Marcar como bloqueado
				$sql = "UPDATE IPIntentosDeLogin 
						SET Bloquear = '1' 
						WHERE Ip = '{$ip}' AND Us = '{$username}'";
				$con->consultaSimple($sql);
			}
		} catch (Exception $e) {
			$this->logger->exception("Log: Error registrando intento fallido de usuario: ", $e, [
				'sql' => preg_replace('/\s+/', ' ', trim($sql))
			]);
	
			throw $e;
		}
	}

	private function limpiarIntentosFallidosUsuario()
	{
		try {
			$con = new Conexion();
			$ip = $con->escapeString($_SERVER['REMOTE_ADDR']);
			$username = $con->escapeString($this->us_name);

			$sql = "DELETE FROM IPIntentosDeLogin WHERE Ip = '{$ip}' AND Us = '{$username}'";
			$con->consultaSimple($sql);
		} catch (Exception $e) {
			$this->logger->exception("Log: Error limpiando intentos fallidos de usuario: ", $e, [
				'sql' => preg_replace('/\s+/', ' ', trim($sql))
			]);
	
			throw $e;
		}
	}

	public function esUsuarioActivo(){
		try {
			$con = new Conexion();
			$sql = "SELECT us_estado FROM usuario WHERE us_name = '{$this->us_name}' AND us_estado = 1 ";
			$datos = $con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);

			return count($row) > 0;
		} catch (Exception $e) {
			$this->logger->exception("Log: Error verificando si el usuario está activo: ", $e, [
				'sql' => preg_replace('/\s+/', ' ', trim($sql))
			]);

			throw $e;
		}
	}

	public function LoginCliente()
	{
		$con = new Conexion();
		$sql = "SELECT * FROM cliente WHERE Alias = '{$this->us_name}'";
		$datos = $con->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);

		return $row;
	}

	public function ClienteActivoEnSispo($idSispo)
	{
		$con = new ConexionSispo();
		$sql = "SELECT * FROM flash_clientes WHERE id = '{$idSispo}' AND cliente_estado_id = 1 ";
		$datos = $con->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);

		return count($row) > 0;
	}

	public function UsuarioActivoEnSispo($id)
	{
		$con = new Conexion();
		$sql = "SELECT Estado FROM cliente WHERE id = '{$id}' AND Estado = 1 ";
		$datos = $con->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);

		return count($row) > 0;
	}

	public function GetClientePorEmail($email)
	{
		$con = new Conexion();
		$sql = "SELECT * FROM cliente WHERE Mail = '{$email}' ";
		$datos = $con->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);
		return $row;
	}

	public function GuardarTokenDeRecuperacion($id, $selector, $token_hash, $expires_at)
	{
		$con = new Conexion();
		$sql = "INSERT INTO password_resets (cliente_id, selector, token_hash, expires_at) VALUES ('{$id}', '{$selector}', '{$token_hash}', '{$expires_at}')";
		$con->consultaSimple($sql);
	}

	public function BuscarTokenDeRecuperacion($selector)
	{
		$con = new Conexion();
		$sql = " SELECT * FROM password_resets WHERE selector = '{$selector}' ";
		$datos = $con->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);
		return $row;
	}

	public function ActualizarPasswordCliente($cliente_id, $passwordPlain)
	{
		$con = new Conexion();
		$hash = password_hash($passwordPlain, PASSWORD_DEFAULT);
		$sql = "UPDATE cliente SET Password = '{$hash}' WHERE Id = '{$cliente_id}'";
		$con->consultaSimple($sql);
	}

	public function MarcarTokenComoUsado($selector)
	{
		$con = new Conexion();
		// Intentar marcar used si existe la columna, si no eliminar el registro
		$sql = "UPDATE password_resets SET used = 1 WHERE selector = '{$selector}'";
		$con->consultaSimple($sql);
	}

	public function MenuDeUsuario()
	{
		$con = new Conexion();
		//$sql = "SELECT * FROM usuario WHERE us_name = '{$this->us_name}' AND us_password = '{$this->us_password}'";//
		$sql = "
				SELECT u.*, m.Nombre as 'NombreDeMenu', m.URL as 'URL', MainMenu as 'MainMenu'
				FROM sispoc5_correoflash.usuario as u
				INNER JOIN sispoc5_correoflash.menudeusuarios as mdu on u.idusuario = mdu.IdUsuario
				INNER JOIN sispoc5_correoflash.menu as m on mdu.IdMenu = m.id
				WHERE
				u.idusuario = '{$this->idusuario}'
				and mdu.TipoDeLogueo = '0'
			"; //
		$datos = $con->consultaRetorno($sql);
		//$row = mysqli_fetch_assoc($datos);
		return $datos;
	}

	public function MenuDeCiente()
	{
		$con = new Conexion();

		$sql = "
				SELECT c.*, m.Nombre as 'NombreDeMenu', m.URL as 'URL', MainMenu as 'MainMenu'
				FROM sispoc5_correoflash.cliente as c
                INNER JOIN sispoc5_correoflash.menuesdegrupo as mdg on 1 = mdg.Grupo
				INNER JOIN sispoc5_correoflash.menu as m on mdg.Menu = m.id
				WHERE
				c.Id = '{$this->idusuario}'
			";
		$datos = $con->consultaRetorno($sql);
		return $datos;
	}

	public function buscarUser()
	{
		$con = new Conexion();
		$sql = "SELECT * FROM usuario WHERE us_name = '{$this->us_name}'";
		$datos = $con->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);
		return $row;
	}

	public function validarCuenta()
	{
		$con = new Conexion();
		$sql = "UPDATE usuario SET us_estado = 1 WHERE us_codseg = {$this->us_codseg}";
		$con->consultaSimple($sql);
	}

	public function bloquear()
	{
		$con = new Conexion();
		$sql = "UPDATE usuario SET us_estado = 0, us_codseg = {$this->us_codseg} WHERE us_mail = '{$this->us_mail}'";
		$con->consultaSimple($sql);
	}

	public function cambiarPass()
	{
		$con = new Conexion();
		$sql = "UPDATE usuario SET us_password = '{$this->us_password}' WHERE us_codseg = {$this->us_codseg}";
		$con->consultaSimple($sql);
	}
}
