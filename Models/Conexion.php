<?php namespace Models;
	class Conexion{
	private $con;
	public function __construct(){
		if(!isset($this->con)){
			$dbHost = getenv('DB_HOST');
			$dbUser = getenv('DB_USERNAME');
			$dbPass = getenv('DB_PASSWORD');
			$dbName = getenv('DB_DATABASE');
			$dbPort = getenv('DB_PORT');

			if (!$dbHost) {
				die('No pudo conectarse: (DB_HOST vacío)');
			}

			if ($dbPort) {
				$this->con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName, (int)$dbPort);
			} else {
				$this->con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
			}

			if (!$this->con) {
				die('No pudo conectarse: (' . $dbHost . ') ' . mysqli_connect_error());
			}

			mysqli_query($this->con, "set names 'utf8';");
		}
	}
	public function consultaSimple($sql){
		$resultado = mysqli_query($this->con,$sql);
		if(!$resultado){
			echo '<strong>¡Error!</strong> <br>'. \mysqli_error($this->con). '<br>'. $sql . '<br>';
			echo '<a href="'.URL.'principal/buscar">VOLVER</a>';
			exit();
		}
	}
	public function consultaRetorno($sql){
		$datos = mysqli_query($this->con,$sql);
		if(!$datos){
			echo '<strong>¡Error!</strong> <br>'. \mysqli_error($this->con). '<br>'. $sql . '<br>';
			echo '<a href="'.URL.'principal/buscar">VOLVER</a>';
			exit();
		}else{
			return $datos;
		}
	}
	public function insertar($sql){
		$resultado = mysqli_query($this->con, $sql);
		if(!$resultado){
			echo '<strong>¡Error!</strong> <br>'. mysqli_error($this->con). '<br>'. $sql . '<br>';
			echo '<a href="'.URL.'principal/buscar">VOLVER</a>';
			exit();
		}
		return mysqli_insert_id($this->con);
	}
}
?>