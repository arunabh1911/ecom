<?php

class Controller {

	function __construct() {
			$this->db = new myDBC();
			$this->load = new loader();
	}
	
	function __destruct() {
	}
}
?>