<?php
class ConectarMisEnvios{
    public function coneccionMisEnvios(){
		$ServerName = 'VM-1595466';
		$ServerName = 'RUBEN\\SQLEXPRESS';
		//'RUBEN\\SQLEXPRESS';//'localhost\\SQLEXPRESS';//localhost//WIN-EQ0UCOIRGL4\\SQLEXPRESS//192.168.1.29
		//$ConecionInfo = array("Database"=>"zonificacion","UID"=>"RubenGF","PWD"=>"Morgan75","CharacterSet"=>"UTF-8");
		$ConecionInfo = array("Database"=>"MisEnvios","UID"=>"Olivia","PWD"=>"Morgan75","CharacterSet"=>"UTF-8");
		$conexion = sqlsrv_connect($ServerName,$ConecionInfo);
		if ($conexion){
		}else{
			die(print_r(sqlsrv_errors(), true));
		}
		return $conexion;
    }
}
?>

