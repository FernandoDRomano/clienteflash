<?php
	global $ProgramadorFarias;
	Global $Offline;
	$Offline=false;
	$PCname=gethostname();
	//echo($PCname);
	if($PCname=="RuGedit-PC")
	{
		$ProgramadorFarias=true;
	}
	else
	{
		$ProgramadorFarias=false;
	}
		$ProgramadorFarias=false;
?>
<?php
	class Conectar
	{
		public function coneccion()
		{
			global $ProgramadorFarias;
			Global $Offline;
			if(($ProgramadorFarias) or ($Offline)){
				$conexion=new mysqli('localhost', 'root', '', 'zonificacion');
			}
			else{
				if($conexion=new mysqli('sispo.com.ar', 'sispoc5_RubenGF', 'RGF32601828Ruben', 'sispoc5_zonificacion')){
					
				}
				if ($conexion->connect_errno) {
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
				mysqli_select_db($conexion, 'sispoc5_zonificacion') or die ("Error al seleccionar la Base de datos: " . mysql_error());
			}
			if($conexion){
				$conexion->query("SET NAMES 'utf8'");
			}else{}
			return $conexion;
		}
	}
?>