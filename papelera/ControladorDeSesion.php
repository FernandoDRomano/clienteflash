<?php 
	class Session{
		private $private;
		
		public function __construct() {
			@session_start();
		}
		
		public function set($key,$val){
			$_SESSION[$key] = $val;
		}
		public function get($key){
			$val = $_SESSION[$key];
			return($val);
		}
	}
?>