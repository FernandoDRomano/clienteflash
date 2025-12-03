<?php namespace Controllers;
	//use ModelsNombredemodelo as Nombredemodelo;
	class clienteruteoserviciosController{
		//private $Nombredemodelo;
		public function __construct(){


			//$this->Nombredemodelo = new Nombredemodelo();
		}
/*
		public function obtener_datos(){
			$peticion_get_datos = file_get_contents('https://ruteodesarrollo.sppflash.com.ar/api/seguimiento_online_peticiones');                       

			$datos = json_decode($peticion_get_datos, true);


			return $datos;
		}
*/
		
	}
	$principal = new clienteruteoserviciosController();
?>