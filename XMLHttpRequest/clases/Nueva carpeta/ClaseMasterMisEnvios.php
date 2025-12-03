<?php
	require_once("claseConeccionMisEnvios.php");
	class MasterMisEnvios{
		public $ArraydResultadosMisEnvios;
		public $NumeroDeResultadosMisEnvios;
		public function __construct(){
			$this->db=ConectarMisEnvios::coneccionMisEnvios();
		}
		public function SQL_MasterMisEnvios($SQLquery,$Columnas,$time,$Retorna){
			$consulta=sqlsrv_query($this->db,$SQLquery);
			if($consulta){
				if (sqlsrv_has_rows ($consulta)>0){
					if($Retorna){
						$this->ArraydResultadosMisEnvios = array();
						$this->NumeroDeResultadosMisEnvios =0;
						while($fila = sqlsrv_fetch_array($consulta, SQLSRV_FETCH_ASSOC)){
							for($cont=0;$cont<count($Columnas);$cont++){
								$this->ArraydResultadosMisEnvios[$this->NumeroDeResultadosMisEnvios][$cont]=$fila[$Columnas[$cont]];
							}
							$this->NumeroDeResultadosMisEnvios++;
						}
					}
					return(true);
				}else{
					return(false);
				}
			}else{
				return(false);
			}
		}
	}
?>




