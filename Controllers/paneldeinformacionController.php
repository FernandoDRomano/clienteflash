<?php namespace Controllers;
	use Models\Formulario as Formulario;
	class paneldeinformacionController{
		private $formulario;
		public function __construct(){
			$this->formulario = new Formulario();
		}
	}
	$principal = new paneldeinformacionController();
?>