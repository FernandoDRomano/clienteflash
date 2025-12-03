<?php namespace Controllers;
	use Models\Formulario as Formulario;
	class testselectController{
		private $formulario;
		public function __construct(){
			$this->formulario = new Formulario();
		}
		public function inicio(){
			if(!$_POST){
				$this->formulario->set('for_fecha', date('Y-m-d'));
				$datos = $this->formulario->verFormularios();
				return $datos;
			}
		}
	}
	$principal = new testselectController();
?>