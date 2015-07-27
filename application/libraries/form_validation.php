<?php  

class form_validation {

protected $_error_array = TRUE;
	
	
	public function __construct($rules = array()) {
	}

	
	public function set_rules($field, $label = '', $rules = '') {
		
		if (count($_POST) == 0){
			return $this;
		}
		
		if ( ! is_string($field) OR  ! is_string($rules) OR $field == '') {
			return $this;
		}
		
		$label = ($label == '') ? $field : $label;
		
		$this->_field_data[$field] = array(	'field' => $field,
												'label' => $label,
													'rules' => $rules,
													'postdata' => $_POST[$field]
											);
		return $this;
	}

	public function run()
	{
		
		if (count($_POST) == 0) {
			return FALSE;
		}
		
		//echo "<pre>";print_r($this->_field_data);
		foreach ($this->_field_data as $field => $row) { 
		
			if ($this->_field_data[$field]['postdata'] == '' && $this->_field_data[$field]['rules'] == 'required' ) {
				return $this->_error_array = FALSE; break;
			}
		}
		return true;
	}
}