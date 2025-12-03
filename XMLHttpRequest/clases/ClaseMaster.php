<?php
	require_once("ClaseConeccion.php");
	require_once("ClaseConeccionSppFlash.php");
	class Master
	{
		public $ArraydResultados;
		public $NumeroDeResultados;
		public $Insertado;
		public function __construct()
		{
			@$this->db=Conectar::coneccion();
			@$this->dbSppFlash=ConectarSppFlash::coneccion();
		}
		public function SQL_Master($SQLquery,$Columnas,$time,$Retorna)
		{
			$this->Insertado=0;
			$consulta=$this->db->query($SQLquery);
			$Debug = false;
			if($this->db->error and $Debug){
				echo("SQLERROR:" . $this->db->error);
				print_r($this->db);
				print_r($SQLquery);
			}
			if( (mysqli_affected_rows($this->db))>0 or $this->Insertado != null){
				if($Retorna){
					$this->ArraydResultados = array();
					$this->NumeroDeResultados =0;
					//$this->Insertado = mysql_insert_id();
					$this->Insertado = $this->db->insert_id;
					while($fila = mysqli_fetch_assoc($consulta)){
						for($cont=0;$cont<count($Columnas);$cont++){
							$this->ArraydResultados[$this->NumeroDeResultados][$cont]=$fila[$Columnas[$cont]];
						}
						$this->NumeroDeResultados++;
					}
				}else{
					$this->Insertado = $this->db->insert_id;
					//$this->Insertado = mysql_insert_id();
				}
				return(true);
			}else{
				return(false);
			}
		}
		public function SQL_MasterSppFlash($SQLquery,$Columnas,$time,$Retorna)
		{
			$this->Insertado=0;
			$consulta=$this->dbSppFlash->query($SQLquery);
			$Debug = false;
			if($this->dbSppFlash->error and $Debug){
				echo("SQLERROR:" . $this->dbSppFlash->error);
				print_r($this->dbSppFlash);
				print_r($SQLquery);
			}
			if( (mysqli_affected_rows($this->dbSppFlash))>0  or $this->Insertado != null){
				if($Retorna){
					$this->ArraydResultados = array();
					$this->NumeroDeResultados =0;
					//$this->Insertado = mysql_insert_id();
					$this->Insertado = $this->db->insert_id;
					while($fila = mysqli_fetch_assoc($consulta)){
						for($cont=0;$cont<count($Columnas);$cont++){
							$this->ArraydResultados[$this->NumeroDeResultados][$cont]=$fila[$Columnas[$cont]];
						}
						$this->NumeroDeResultados++;
					}
				}else{
					$this->Insertado = $this->db->insert_id;
					//$this->Insertado = mysql_insert_id();
				}
				return(true);
			}else{
				return(false);
			}
		}
	}
?>