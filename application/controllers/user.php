
<?php

class user  extends Controller  {

	
	public function __construct() {
			parent::__construct();
			$this->load->cls = $this;
	}
	
	public function socialLogin() {
		
		if( $_POST['Id'] && $_POST['field'] ) {
			$status = array('suspended');
			$user = $this->db->getRecord( USERS, '', "email = '".$_POST['c_email']."' " );
			
			if( @$user[0]['email'] && in_array($user[0]['status'], $status) )
				redirect('', 'info|your account is '.$user[0]['status'].'');
			
			if( $user[0]['status'] == 'pending' && $user[0]['type'] == 'associate' )
				redirect('', 'info|your account is '.$user[0]['status'].'');
			
			elseif( @$user[0]['email'] ) {
				$ar1 = array();
				$ar2 = array();
				$ar3 = array();
				$ar4 = array();
				$ar5 = array();
				if( $user[0][$_POST[field]] == '' )
					$ar1 = array( $_POST['field'] => $_POST['Id'] );
				if( $user[0]['image1'] == '' )
					$ar2 = array( 'image1' => $_POST['image1'] );
				if( $user[0]['gender'] == '' )
					$ar3 = array( 'gender' => $_POST['gender'] );
				if( $user[0]['timezone'] == '' )
					$ar4 = array( 'timezone' => $_POST['timezone'] );
				if( $user[0]['status'] != 'active' )
					$ar5 = array( 'status' => 'active' );
				$array = array_merge($ar1,$ar2,$ar3,$ar4,$ar5);
				if($array)
					$this->db->update( USERS, $array ,  "email = '".$_POST['c_email']."' ") ;
					$_POST['notification'] = 'profilemsg';
					$_SESSION[ userType('session', $user[0]['type'] ) ] = $user[0]['userId'];
					redirect( userType('slug', $user[0]['type'] ) , 'succ|login successfully', 'javascript');
			}
			elseif(filter_var($_POST['c_email'], FILTER_VALIDATE_EMAIL)) {
				
				$_POST['password'] = substr(number_format(time() * rand(),0,'',''),0,4);
				$data = array(	'type' => $_POST['type'] ,
									$_POST['field'] => $_POST['Id'],
										'status' => 'active',
											'image1' =>  $_POST['image1'],
												'gender' =>  $_POST['gender'],
													'timezone' =>  $_POST['timezone']
							);
				$this->signup($data);
			}
			else
				redirect('','error|your mail not verified');
		}
		else
			redirect('', 'error|no or id field return ');
	}


	public function signup( $data = NULL, $get = NULL ) {
		
		$this->load->library('form_validation');
		$this->load->model('site_function');
		//echo '<pre>'; print_r($_POST);die;
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('c_email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		
		if ($this->form_validation->run() == FALSE)
			redirect('referer', 'error|invalid input');
		
		/*elseif($user = $this->db->getRecord( USERS, '', "email = '".$_POST['c_email']."' " ))
			redirect('referer','error|email is already exist');*/
					
		else {
				$images1 = $this->site_function->images_upload('image1');
				$images2 = $this->site_function->images_upload('image2', 'all');
		
				$image1 = empty($images1) ? $data['image1'] : $images1;
				$image2 = empty($images2) ? $data['image2'] : $images2;
				$gender = empty($_POST['gender']) ? $data['gender'] : $_POST['gender'];
				$timezone = empty($_POST['timezone']) ? $data['timezone'] : $_POST['timezone'];
				$type = empty($_POST['type']) ? $data['type'] : $_POST['type'];
				$status = empty($_POST['status']) ? $data['status'] : $_POST['status'];
				if(!$status) $status ='pending';
				$social = empty($_POST['field']) ? array() : array($_POST['field'] => $_POST['Id']);
				
				@$fields = array('date' => date('y-m-d') ,
									'companyName' => $_POST['companyName'],
										'name' => $_POST['firstname'].' '.$_POST['lastname'],
											'username' => $_POST['username'],
												'email' => $_POST['c_email'],
													'password' => md5($_POST['password']),
														'image1' => $image1,
															'image2' => $image2,
																'type' => $type,
																	'status' => $status,
																		'gender' => $gender,
																			'dob' => "$_POST[year]-$_POST[month]-$_POST[day]",
																				'timezone' => $timezone);
				if( $this->db->insert( USERS, array_merge($fields,$social) ) ) {
					$getId = $this->db->lastInsertID();
					$address = array('userId' => $getId,
										'name' => $_POST['firstname'].' '.$_POST['lastname'],
											'email' => $_POST['c_email'],
												'pincode' => $_POST['pincode'],
													'landlineNo' => $_POST['landlineNo'],
														'mobileNo' => $_POST['mobileNo'],
															'faxNo' => $_POST['faxNo'],
																'apt' => $_POST['apt'],
																	'address' => $_POST['address'],
																		'landmark' => $_POST['landmark'],
																			'city' => $_POST['city'],
																				'state' => $_POST['state'],
																					'country' => $_POST['country'],
																						'service'=> @implode(',', $_POST['service']));

					if ( $this->db->insert( ADDRESS, $address ) ) {
						$addId = $this->db->lastInsertID();
						if ( $this->db->update( USERS, array('address' => $addId, 'uniqueId' => str_pad($getId, 10, '0', STR_PAD_LEFT) ) , "userId = '$getId' " ) ){
							
							if($type == 'traveler'){
								$mail = ($status == 'active') ? '18' : '17';
								$msg = 'Registered Successfully!! '; //You will receive an e-mail containing the account verification link.
							}
							elseif($type == 'associate'){
								$mail = '4,15';
								$msg= 'Thank you for your Registration. We will get back to you shortly';
							}
							
							//$this->site_function->sendMail( $mail , array(userId => $getId, password => $_POST['password'] ) );
							if($status == 'active')
								$this->signin();
								$msg = 'Registered Successfully!!';
								if($get == 'getid')
									return array($getId, $addId);
								else
									redirect('referer', "succ|$msg");
						}
					}
				}
		}
	}
	
	
	public function signup2() {
		
		if($_POST['type'] == 'driver' ){
			
			$this->load->model('site_function');
			$images1 = $this->site_function->images_upload('dPicture');
			$images2 = $this->site_function->images_upload('dLicense');
			$carimage = $this->site_function->images_upload('vPicture');
				
			$user = array(status => 'pending',
							'make' => $_POST['make'],
								'model' => $_POST['model'],
									'year' => $_POST['year'],
										'color' => $_POST['color'],
											'license' => $_POST['license'],
												'ssn' => $_POST['ssn'],
													'dob' => $_POST['dob'],
														'backgroundCheck' => $_POST['backgroundCheck'],
															'image1' => $images1,
																'image2' => $images2,
																	'carimage' => $carimage );

			if ( $this->db->update( USERS, $user, "userId = '".$_POST['userId']."' " ) )
					redirect('admins/registration1/', "succ|Registered Successfully!!");
		}

		else if($_POST['type'] == 'user' ){
		
			$ccDetails = array('ccNumber' => $_POST['ccNumber'],
									'cvv' => $_POST['cvv'],
										'ccMonth' => $_POST['ccMonth'],
											'ccYear' => $_POST['ccYear']);
															
			$user = array(status => 'pending',
							'promoCode' => $_POST['promoCode'],
								ccDetails => json_encode($ccDetails) );
							
			if ( $this->db->update( USERS, $user, "userId = '".$_POST['userId']."' " ) )
				if ( $this->db->update( ADDRESS, array('pincode' => $_POST['postalCode'] ), "userId = '".$_POST['userId']."' "  ) ) 
					redirect('admins/registration1/', "succ|Registered Successfully!!");
			}
		}

	
	public function signin() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('c_email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			redirect('','error|invalid input');
		}
		
		else if( $user = $this->db->getRecord( USERS, '', "email = '".$this->db->clearText($_POST['c_email'])."' AND password = '".md5($this->db->clearText($_POST['password']))."' " ) ) {
		
			if($user[0]['status'] == 'active') {
				$_POST['notification'] = 'profilemsg';
				$_SESSION[ userType('session', $user[0]['type']) ] = $user[0]['userId'];
				redirect( userType('slug', $user[0]['type']) , 'succ|login successfully', 'javascript');
			}
			else if($user[0]['status'] != 'active')
				redirect('', 'error|your account is '.$user[0]['status'].'');
		}
		else
			redirect('referer','error|invalid username or password');
	}
	
	
	public function activation( $slug = '' ) {
		
		@$slug=array_filter(explode("/", $slug ));
		$_POST['notification'] = 'notimsg';
		
		if( ( $row =  $this->db->getRecord( USERS , '', " email='".$this->db->clearText($slug[1])."' AND password = '".$this->db->clearText($slug[2])."' AND status = 'inactive' ") ) ) {
			
			if ( $this->db->update( USERS, array('status' => 'active'), "userId = '".$row[0]['userId']."' " ) )
				redirect(NOTIFICATION,'succ|your account has been activated successfully','javascript');
		}
		else
			redirect(NOTIFICATION,'error|Invalid Link','javascript');
	}
	
	
	public function forgetpassword( $slug = '' ) {
		
		$_POST['notification'] = 'forgetmsg';
		if($slug) {	//link check from gmail		
		
			@$slug=array_filter(explode("/", $slug ));
			if( ( $user =  $this->db->getRecord( USERS , '', " email='".$this->db->clearText($slug[1])."' AND password = '".$this->db->clearText($slug[2])."' ") ) ) {
				
					$_SESSION['step'] = array( step => '1',
												email => $user[0]['email'] );
					redirect(FORGETPASS,'info|<strong>Select a new password for your '.title.' Account</strong>'); 
			}
			else
				redirect(FORGETPASS,'error|Password Reset Invalid or Expired Link Followed. Please try again');
		}
		
		else if($_POST['password']){ //reset step2
			$_POST['notification'] = 'notimsg';
			if ( $this->db->update( USERS, array('password' => md5($_POST['password']) ), "email = '".$_POST['email']."' " ) )
				redirect(NOTIFICATION,'succ|Your password for email address '.$_POST['email'].'  has been reset.','javascript');
			else
				redirect(NOTIFICATION,'error|password not reset please try again');
		}
		
		else { //send mail
			
			if($user = $this->db->getRecord( USERS, '', "email = '".$this->db->clearText($_POST['c_email'])."'  " )) {
				
				if( $user[0]['status'] == 'pending' && $user[0]['type'] == 'associate' )
				redirect('', 'info|your account is '.$user[0]['status'].'');
				
				$this->load->model('site_function');
				$this->site_function->sendMail( '19' , array( userId => $user[0]['userId'] ) );
				redirect(FORGETPASS,'succ|Password reset link sent to: '.$_POST['c_email']);
			}
			else 
				redirect(FORGETPASS,'error|mail not found on database');
		}
	}
	
	
	public function editMyProfile() {
		$user = array();
		$address = array();
		
		if( $_POST['firstname'] )
			$user = array( 'name' => $_POST['firstname'].' '.$_POST['lastname'] );
		if( $_POST['gender'] )
			$user = array_merge($user, array( 'gender' => $_POST['gender'] ));
		if( $_POST['dob'] )
			$user = array_merge($user, array( 'dob' => $_POST['dob'] ));
		if( $_POST['c_email'] )
			$user = array_merge($user, array( 'email' => $_POST['c_email'] ));
		if( $_POST['username'] )
			$user = array_merge($user, array( 'username' => $_POST['username'] ));
		if( $_POST['status'] )
			$user = array_merge($user, array( 'status' => $_POST['status'] ));
		
		if( $_POST['name'] )
			$address = array_merge($address, array( 'name' => $_POST['name'] ));	
		if( $_POST['mobileNo'] )
			$address = array_merge($address, array( 'mobileNo' => $_POST['mobileNo'] ));
		if( $_POST['city'] )
			$address = array_merge($address, array( 'city' => $_POST['city'] ));
		if( $_POST['state'] )
			$address = array_merge($address, array( 'state' => $_POST['state'] ));
		if( $_POST['country'] )
			$address = array_merge($address, array( 'country' => $_POST['country'] ));
		if( $_POST['pincode'] )
			$address = array_merge($address, array( 'pincode' => $_POST['pincode'] ));
		if( $_POST['apt'] )
			$address = array_merge($address, array( 'apt' => $_POST['apt'] ));
		if( $_POST['address'] )
			$address = array_merge($address, array( 'address' => $_POST['address'] ));
		if( $_POST['addTitle'] )
			$address = array_merge($address, array( 'addTitle' => $_POST['addTitle'] ));
	
		if($user)
			$this->db->update( USERS, $user ,  "userId = '".$_POST['userId']."' ") ;
		if($address)
			$this->db->update( ADDRESS, $address ,  "id = '".$_POST['addressId']."' ") ;
		$_POST['notification'] = 'profilemsg';	
		redirect('referer','succ|update successfully!!');
	}
	
	
	public function addAddress() {
		
		$address = array();
		
		if( $_POST['userId'] )
			$address = array_merge($address, array( 'userId' => $_POST['userId'] ));	
		if( $_POST['name'] )
			$address = array_merge($address, array( 'name' => $_POST['name'] ));	
		if( $_POST['mobileNo'] )
			$address = array_merge($address, array( 'mobileNo' => $_POST['mobileNo'] ));
		if( $_POST['city'] )
			$address = array_merge($address, array( 'city' => $_POST['city'] ));
		if( $_POST['state'] )
			$address = array_merge($address, array( 'state' => $_POST['state'] ));
		if( $_POST['country'] )
			$address = array_merge($address, array( 'country' => $_POST['country'] ));
		if( $_POST['pincode'] )
			$address = array_merge($address, array( 'pincode' => $_POST['pincode'] ));
		if( $_POST['apt'] )
			$address = array_merge($address, array( 'apt' => $_POST['apt'] ));
		if( $_POST['address'] )
			$address = array_merge($address, array( 'address' => $_POST['address'] ));
		if( $_POST['addTitle'] )
			$address = array_merge($address, array( 'addTitle' => $_POST['addTitle'] ));
		
		$goto = ( $_POST['goto'] != '' ) ? $_POST['goto'] : 'referer';
		
		$_POST['notification'] = 'profilemsg';
		$this->db->insert( ADDRESS, $address );
		redirect($goto,'succ|Create successfully!!');
	}
	
	
	public function changePassword() { 
		
		if(!$user = $this->db->getRecord( USERS, '', "password = '".md5($_POST['current_password'])."'  " ))
			redirect('referer','error|Current password not match');
		elseif( $this->db->update( USERS, array( 'password' => md5($_POST['password']) ), "userId = '".$_POST['userId']."'" ) )
			redirect('referer','succ|password changed successfully!!');
		else
			redirect('referer','error|try again');
	}

	
	public function uploadProfilePic() {
		$this->load->model('site_function');
		if( $img = $this->site_function->images_upload('img') ) {
			@unlink($baseurl.image_folder.'/'.$_POST['pic']);
			$this->db->update( USERS, array('image1' => $img ) ,  "userId = '".$_POST['userId']."' ");
			redirect('referer','succ|profile picture update successfully!!');
		}
		else
			redirect('referer','error|please try again!!');		
	}
	
	
	public function delete() {
		
		if($_POST['cnd'] == 'delete' ){
			$this->db->runQuery("delete from ".$_POST['tbl']." where userId='".$_POST['id']."' ");
			redirect('referer','succ|deleted successfully!!');
		}
	
	
	}


	public function edit_profile( $array = NULL ) { //spacial class
		return array(userAddress =>  $this->db->getRecord( ADDRESS , '', " userId='".$array['user']['userId']."' ") );
		}
	
	
	public function contactus() {
		
		$this->load->model('site_function');
		$data = array ( 'date' => date('Y-m-d'),
							'feedback' => $_POST['feedback'],
								'subject' => $_POST['subject'],
									'name' => $_POST['name'],
										'email' => $_POST['email'],
											'contactNo' => $_POST['contactNo'],
												'comment' => $_POST['comment']);
		
		if ( $this->db->insert( CONTACT, $data ) ) {
			$this->site_function->sendMail( '20' , array(contactus => $data ) );
			redirect('referer', "succ|<strong>Thank You!</strong>.<br /> Our Customer Support team has received your valuable feedback. Very soon a ".title." representative will get in touch with you.");
		}
	}
	
	
	public function search () {
		
		if($_POST['stype'] == 'part'){
			$sql = $this->db->runQuery("select * from ".PRODUCT." where mPartNum like '%".$_POST['text']."%' ");
					if ( $data = $this->db->getQuery($sql) ) {
					redirect('product-details/'.$data['slug']);
				}
				else {
					redirect('product-search/?searchquery=no result found', "succ|$msg");
				}
		}
		else if($_POST['stype'] == 'content'){
			$sql = $this->db->runQuery("select * from ".PRODUCT." where mPartNum like '%".$_POST['text']."%' ");
			while($data= $this->db->getQuery($sql))
				$array[] = $data['catId'];
			redirect('product-search/?searchquery='.implode(',',$array), "succ|$msg");
			}
		
		
	}

	public function logout() {
		$userType = unserialize( userType );
		foreach($userType as $key => $value){
			if($_SESSION[$value[session]]) {
				$_SESSION[$value[session]]='';
				redirect('');
			}
		}
	}
}
?>