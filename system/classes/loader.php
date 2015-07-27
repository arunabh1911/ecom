<?php

class loader  {

public $LibraryPath = classPath;
public $ClassValidation = true;
public $cls;

	function __construct() {
		$this->cls = $this;
	}

	public function __call($method, $arg){
			if ($method == 'classes')
				$this->LibraryPath = classPath;
			if ($method == 'controller')
				$this->LibraryPath = controller;
			if ($method == 'model')
				$this->LibraryPath = models;
			if ($method == 'library')
				$this->LibraryPath = library;
			$this->NewObject($arg[0], $arg);
	}
	
	public function NewObject($Name, $Parameters = array()) {
		
			if (!class_exists($Name) && !$this->LoadClass($Name))
			if ($this->ClassValidation == true )
				die('Library File `'.$this->LibraryPath.$Name.'.php` not found.');
			if (class_exists($Name)){
				$_SESSION['classes'][] = $this->LibraryPath.$Name;
			return $this->cls->$Name  = new $Name($this, $Parameters); 
			}
		}
	
	public function LoadClass($Name) {
			$File = $this->LibraryPath.$Name.'.php';
			if (file_exists($File))
					return include($File);
			else    return false;
	}

	public function view($page, $data = NULL ) {
		$this->load = new loader();
		if( file_exists( temp_location.$page ) && $page != ''  ) {
			foreach ($data as $key => $value) {
				$$key = (object) $value;
			}
			$this->db = new myDBC();
			//unset($data);
			$this->load->cls = $this; 
			if( in_array('header', explode(',', $setting->option )) )
				include temp_location.headerpage;
			include temp_location.$page;
			if( in_array('footer', explode(',', $setting->option )) )
				include temp_location.footerpage;
		}
		else {
			include temp_location.headerpage;
			include temp_location.'notfound.php';
			include temp_location.footerpage;
		}
		die;
	}
	
	public function third_party($folder, $file) {
		$ext = explode('.',$file);
		if ( end($ext) == 'js' )
		echo '<script src="'.thirdParty.$folder.'/'.$file.'" type="text/javascript"></script>';
		if ( end($ext) == 'php' )
		include appPath.'third_party/'.$folder.'/'.$file;
	}
	
	function __destruct() {
	}
}
?>