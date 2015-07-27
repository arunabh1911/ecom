<?php

class cHK_pAGES extends Controller {
	
private $slug;
private $className;

	function __construct($propery, $input) {
		
		parent::__construct();
		if( $input )
			$this->slug = $input;
		
		$pg=array_filter(explode("/", $this->slug )); $num = count($pg); //print_r($pg);
		
		$ecommerce = unserialize( ecommerce );
		$ekey = array_keys($ecommerce);
		
		
		/*check CATEGORY table*/
		if( ( $single =  $this->db->getRecord( CATEGORY , '', " slug='".current($pg)."' OR ( folder = '".current($pg)."' AND slug = '".next($pg)."' ) ") ) ) { //&& ( $num == '1' ) 
			@$setting = json_decode(stripslashes($single[0]['setting']), TRUE);
			if( in_array('session', explode(',', $single[0][options] )) && $_SESSION[ userType('session',$setting['userType']) ] == '' )
				redirect();
			$row = (object) current($single);
			$ty = '1';
		}
		
		/*ecommerce*/
		else if(  $ecommerce['status'] == '1' ) {
		 	
			/*product*/
			if( in_array($pg[0],$ekey) && ($single =  $this->db->getRecord( PRODUCT, '', "slug = '".$pg[1]."' " ) )) {
				$page = $ecommerce[$pg[0]]['page'];
				$row = (object) current($single);
				$row->goto = $page;
				$row->page_name = $row->mPartNum;
				$ty = '2';
			}
			/*category*/
			if( in_array($pg[0],$ekey) && ($single =  $this->db->getRecord( CAT, '', "slug = '".$pg[1]."' " ) )) {
				$page = $ecommerce[$pg[0]]['page'];
				$row = (object) current($single);
				$row->goto = $page;
				$row->page_name = $row->category_title;
				$ty = '2';
			}
			else {	/*mycart*/
				
				foreach($ecommerce as $key => $value) {
				if(@$value['slug'] == $pg[0] ) {
					@$row->page_name = $value['name'];
					@$row->goto = $value['page'];
					@$row->slug = $value['slug'];
					@$row->product_title = $value['slug'];
					$ty = '2';
					break;
					}
				}
			}
		}
		/*ecommerce*/
		
		if( $user = $this->db->getRecord( USERS, '', "userId = '".$_SESSION[$this->sessType()]."' " ) )
			@$data['user'] = current($user);
		
			
			@$seo1=explode('||', $row->seo ); //seo1 = page
			$meta_key = ( $seo1[0] == '' ) ? meta_key : $seo1[0];
			$meta_des = ( $seo1[1] == '' ) ? meta_des : $seo1[1];
			$meta_tit = ( $seo1[2] == '' ) ? $row->page_name : $seo1[2];
			$meta_title = ( current($pg) == HOMEPAGE ) ? $meta_tit : $meta_tit.' | '.title;
			
			if ($ty == '1') {
				$data['setting']['option'] = $row->options;
				if(!$row->slug) $row->slug = 'home';
				$data['pageDetail'] =  array('id' => $row->page_id,
												'name' => $row->page_name,
													'slug' => $row->slug,
														'page' => $row->folder.'/'.$row->goto,
															'seo' => (object) array( 'meta_key' => $meta_key,
																						'meta_des' => $meta_des,
																							'meta_title' => ucwords($meta_title)) );
			}
			else if ($ty == '2') {
				$data['setting']['option'] = 'header,footer';
				$data['pageDetail'] =  array('id' => $row->id,
													'parentId' => $row->category_parent,
													'catId' => $row->catId,
													'parameter' => $row->parameter,
												'name' => $row->page_name,
													'slug' => $row->slug,
														'page' => $row->folder.'/'.$row->goto,
															'seo' => (object) array( 'meta_key' => $meta_key,
																						'meta_des' => $meta_des,
																							'meta_title' => ucwords($row->page_name.' | '.title)) );
			
			}
			//echo '<pre>'; print_r($data);
			/*special class call like dashboard data */
			if( in_array($row->slug, array('dashboard','edit-profile') ) ) {
				$this->className = str_replace("-",'_',$row->slug);
				$this->load->ClassValidation = false;
				$this->load->controller('user'); 
					if(method_exists('user', $this->className ))
					$data[$this->className] = $this->load->user->{$this->className}(array('user' => $data['user']));
			}
			/*CALL Controllers CLASS IF EXIST*/
			if($row){ 
				$this->load->ClassValidation = false;
				$this->className = str_replace("-",'_',$row->slug);
				$this->load->controller( $this->className );
				if(method_exists( $this->load->{$this->className}, index ))
					$this->load->{$this->className}->index($data);
				else
					$this->load->view( $row->folder.'/'.$row->goto, $data ); //default
			}
			else
				$this->load->view( $row->goto ); //!$row- page not found
	}
	
	public function sessType () {
		$userType = unserialize( userType );
		foreach($userType as $key => $value){
			if($_SESSION[$value[session]])
				return $value[session];
		}
	}
}
?>