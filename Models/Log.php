<?php namespace Models;
include 'Conexion.php';
	class Log{
            private $us_name;
			private $us_password;
			private $us_estado;
			private $us_codseg;
			private $CantidadDeIntentosPorIp = 10;
		public function __construct(){
			$this->us_name = null;
			$this->us_password = null;
			$this->us_estado = null;
			$this->us_codseg = null;
			$this->idusuario = null;
		}
		public function set($atributo, $contenido){
			$this->$atributo = $contenido;
		}
		public function get($atributo){
			return $this->$atributo;
		}
		
		public function ObtenerSucursalesEnGrupo(){
            $con = new Conexion();
			$sql = "
				SELECT cfseg.IdSucursales as 'Sucursales'
				FROM sispoc5_correoflash.usuario as cfu
				inner join sispoc5_correoflash.GrupoDeSucursales as cfGDS on cfGDS.Id = cfu.GrupoSucursalId
				inner join sispoc5_correoflash.SucursalesEnGrupos as cfseg on cfGDS.Id = cfseg.IdGrupoDeSucursales
				WHERE idusuario = '{$this->idusuario}'
			";
            $datos = $con->consultaRetorno($sql);
			//$row = mysqli_fetch_assoc($datos);
			//return $datos;
			return $datos;
		}
		
        public function verLog(){
            $con = new Conexion();
			$sql = "SELECT * FROM sispoc5_correoflash.IPIntentosDeLogin WHERE Ip = '{$_SERVER['REMOTE_ADDR']}'";//
			$datos = $con->consultaRetorno($sql);
			$Filas = mysqli_num_rows($datos);
			$Columnas = $datos->field_count;
			if($Filas> $this->CantidadDeIntentosPorIp){
				$con = new Conexion();
				$sql = "UPDATE sispoc5_correoflash.IPIntentosDeLogin SET Bloquear = '1' WHERE Ip = '{$_SERVER['REMOTE_ADDR']}'";
				$datos = $con->consultaRetorno($sql);
				return ;
			}
			
			$sql = "SELECT * FROM usuario WHERE us_name = '{$this->us_name}' AND us_password = '{$this->us_password}'";//
			/*$sql = "
				SELECT u.*, m.Nombre as 'NombreDeMenu', m.URL as 'URL', MainMenu as 'MainMenu'
				FROM sispoc5_correoflash.usuario as u
				INNER JOIN sispoc5_correoflash.menudeusuarios as mdu on u.idusuario = mdu.IdUsuario
				INNER JOIN sispoc5_correoflash.menu as m on mdu.IdMenu = m.id
				WHERE
				u.us_name = '{$this->us_name}'
				AND u.us_password = '{$this->us_password}'
			";//
			*/
            $datos = $con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			if($row == null){
				$con = new Conexion();
				$sql = "INSERT INTO sispoc5_correoflash.IPIntentosDeLogin (Id, Ip, FechaDeCreacion, Bloquear, Us, Ps) VALUES (NULL, '{$_SERVER['REMOTE_ADDR']}', CURRENT_TIMESTAMP, '0','{$this->us_name}','{$this->us_password}');";
				$con->consultaSimple($sql);
			}else{
				$con = new Conexion();
				$sql = "DELETE FROM sispoc5_correoflash.IPIntentosDeLogin WHERE Ip = '{$_SERVER['REMOTE_ADDR']}'";
				$con->consultaSimple($sql);
			}
			return $row;
		}
		public function LoginCliente(){
            $con = new Conexion();
			$sql = "
				SELECT *
				FROM cliente
				WHERE
				Alias = '{$this->us_name}'
			";
            $datos = $con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			//print_r($row);
			/*
			
			
			$sql = "SELECT * FROM usuario WHERE us_name = '{$this->us_name}' AND us_password = '{$this->us_password}'";
			
            $datos = $con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			//return $datos;
			*/
			return $row;
		}
		
        public function MenuDeUsuario(){
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
			";//
            $datos = $con->consultaRetorno($sql);
			//$row = mysqli_fetch_assoc($datos);
			return $datos;
		}
		public function MenuDeCiente(){
            $con = new Conexion();
			//$sql = "SELECT * FROM usuario WHERE us_name = '{$this->us_name}' AND us_password = '{$this->us_password}'";//
			
			/*
				SELECT c.*, m.Nombre as 'NombreDeMenu', m.URL as 'URL', MainMenu as 'MainMenu'
				FROM sispoc5_correoflash.cliente as c
				INNER JOIN sispoc5_correoflash.menudeusuarios as mdu on c.Id = mdu.IdUsuario
				INNER JOIN sispoc5_correoflash.menu as m on mdu.IdMenu = m.id
				WHERE
				c.Id = '{$this->idusuario}'
				and mdu.TipoDeLogueo = '1'
			*/
			$sql = "
				SELECT c.*, m.Nombre as 'NombreDeMenu', m.URL as 'URL', MainMenu as 'MainMenu'
				FROM sispoc5_correoflash.cliente as c
                INNER JOIN sispoc5_correoflash.menuesdegrupo as mdg on 1 = mdg.Grupo
				INNER JOIN sispoc5_correoflash.menu as m on mdg.Menu = m.id
				WHERE
				c.Id = '{$this->idusuario}'
			";//
            $datos = $con->consultaRetorno($sql);
			//$row = mysqli_fetch_assoc($datos);
			return $datos;
		}
		
		public function buscarUser(){
            $con = new Conexion();
			$sql = "SELECT * FROM usuario WHERE us_name = '{$this->us_name}'";
            $datos = $con->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			return $row;
		}
		public function validarCuenta(){
            $con = new Conexion();
			$sql = "UPDATE usuario SET us_estado = 1 WHERE us_codseg = {$this->us_codseg}";
            $con->consultaSimple($sql);
		}
		public function bloquear(){
            $con = new Conexion();
			$sql = "UPDATE usuario SET us_estado = 0, us_codseg = {$this->us_codseg} WHERE us_mail = '{$this->us_mail}'";
            $con->consultaSimple($sql);
		}
		public function cambiarPass(){
            $con = new Conexion();
			$sql = "UPDATE usuario SET us_password = '{$this->us_password}' WHERE us_codseg = {$this->us_codseg}";
            $con->consultaSimple($sql);
		}
	}
?>