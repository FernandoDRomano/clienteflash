<?php
	global $ProgramadorFarias;
	Global $Offline;
	$Offline=false;
	$PCname=gethostname();
	if($PCname=="RuGedit-PC"){
		$ProgramadorFarias=true;
	}
	else{$ProgramadorFarias=false;}
	$ProgramadorFarias=false;
	class ConectarSppFlash{
		public function coneccion(){
			global $ProgramadorFarias;
			Global $Offline;
			if(($ProgramadorFarias) or ($Offline)){
				$conexion=new mysqli('localhost', 'root', '', 'zonificacion');
			}
			else{
				if($conexion=new mysqli('sppflash.com.ar', 'sppfla5_zonif', 'sispoZonificacion2017', 'sppfla5_solicitud')){}
				if ($conexion->connect_errno) {
/*
$ip_server = $_SERVER['SERVER_ADDR'];
echo "Server IP Address is: $ip_server";
$ip = $_SERVER['REMOTE_ADDR'];
echo "IP Address is: $ip", "<br>";
*/
					header("Location: ErrorSql.php");
					exit;
				}
			}
			if (mysqli_connect_errno()){
				header("Location: ErrorSql.php");
				exit;
			}
			$conexion or die("Error al conectar " . mysql_error());
			if(($ProgramadorFarias) or ($Offline)){
				mysqli_select_db($conexion, 'zonificacion') or die ("Error al seleccionar la Base de datos: " . mysql_error());
			}else{
				mysqli_select_db($conexion, 'sppfla5_solicitud') or die ("Error al seleccionar la Base de datos: " . mysql_error());
			}
			if($conexion){
				$conexion->query("SET NAMES 'utf8'");
			}else{}
			return $conexion;
		}
	}
?>