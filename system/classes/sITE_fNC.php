<?php

class sITE_fNC extends myDBC  {

	public function __construct() {
		
		parent::__construct();
		$query = $this->runQuery( "SELECT * from `".SETTINGS."` where `autoload` = 'yes' " );
		while( $row = $this->getQuery( $query ) ) {
			define( $row['setting'] , $row['value'] );
		}
		define( temp_location , 'application/views/themes/'.theme_folder.'/' );
		define( temp_path , site_url.'/'.temp_location );
		define( img_path , site_url.'/'.image_folder.'/' );
		define( thirdParty , site_url.'/application/third_party/' );
		return $setting; 
	}	
}
?>