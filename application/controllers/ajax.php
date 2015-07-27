<?php

class ajax  extends Controller  {
	
	public function __construct() {
			
			parent::__construct();
			$this->load->cls = $this;
	}
	
	public function index($data) {
		
		if($_POST['getState']) {
			
			$this->load->model('site_function');
			if($_POST['type'] == 'state'){
				$table = REGION;
				$fld = 'fk_c_country_code';
			}
			if($_POST['type'] == 'city'){
				$table = CITY;	
				$fld = 'fk_i_region_id';
			}
			//$this->site_function->clas = 'data-placeholder="state" class="chzn-select" style="width:350px;"';
			$this->site_function->setName = 's_name';
			$this->site_function->setId = 'pk_i_id';
			echo  $this->site_function->dropDown( $table, $_POST['type'], "$fld = '$_POST[getState]' order by s_name ");
		}
		
		if(isset($_POST['c_email'])) {
			
			@$user = $this->db->getRecord( USERS, '', "email = '".$this->db->clearText($_POST['c_email'])."' " );
			if($_POST['c_email']=='')
				
				$response = array(	'valid' => false,
										'message' => 'Please enter your email');
				
			elseif(!filter_var($_POST['c_email'], FILTER_VALIDATE_EMAIL))
					
				$response = array(	'valid' => false,
										'message' => 'incorrent email'.$_REQUEST['a'] );
				
			elseif( !$user && $_REQUEST['od'] == 'no' )
					
				$response = array(	'valid' => false,
										'message' => 'mail not found on database' );
			
			elseif( $user && $_REQUEST['od'] == 'yes' )
					
				$response = array(	'valid' => false,
										'message' => 'This email is already registered.' );
											
			else
				$response = array('valid' => true);
				echo json_encode($response);
				die;
		}
	}
}
?>