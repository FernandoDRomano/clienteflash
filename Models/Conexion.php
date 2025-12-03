<?php namespace Models;
	class Conexion{
	private $con;
	public function __construct(){
		if(!isset($this->con)){
			
			$PCname=gethostname();
			//if($PCname=="RuGedit-PC"){
			if($PCname=="Ruben-"){
				$this->con = mysqli_connect("localhost", "root", "", "sispoc5_correoflash")
				//$this->con = mysqli_connect("sispo.com.ar", "sispoc5_zonif", "sispoZonificacion2017", "sispoc5_zonificacion")
				or die('No pudo conectarse: ' . \mysqli_error($this->con));
				mysqli_query($this->con,"set names 'utf8';");
			}else{
				$this->con = mysqli_connect("sispo.com.ar", "sispoc5_zonif", "sispoZonificacion2017", "sispoc5_correoflash")
				//$this->con = mysqli_connect("sispo.com.ar", "sispoc5_zonif", "sispoZonificacion2017", "sispoc5_zonificacion")
				or die('No pudo conectarse: (' . \mysqli_error($this->con) .\mysqli_connect_error($this->con) .')');
				mysqli_query($this->con,"set names 'utf8';");
			}
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
}
?>