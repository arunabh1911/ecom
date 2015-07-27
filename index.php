<?php
/*
<title><?=$pageDetail->seo->meta_title;?></title>
<meta name="description" content="<?=$pageDetail->seo->meta_des;?>"> 
<meta name="keywords" content="<?=$pageDetail->seo->meta_key;?>"> 
<?=temp_path?>/
<?=site_url?>

	 $this->db->getQuery($this->db->runQuery("select * from ".CAT." where id='$_REQUEST[id]' order by id DESC"));
	$gal =  $this->db->getRecord( GALLERY, '', "id = '1' "  );
	-
	$this->load->cls = $this;
	$this->load->model('site_function');
	$this->site_function->getData('title',$pageDetail->id);
	list($img,$b)  =  $this->site_function->getData('image',34);
	
 * -------------------------------------------------------------------
 *  EDIT PART
 * -------------------------------------------------------------------
 */
 	error_reporting(E_ALL & ~E_NOTICE);
	ini_set('post_max_size', '64M');
	ini_set('upload_max_filesize', '64M');
	ini_set('max_execution_time', 300);

	$home_page_name='home'; 
	$system_path = 'system';
	$application_folder = 'application';
	$database_folder = 'database';
	$database_type = 'mysqli';
	$data_formate = 'd-m-Y';
	
	$forgetpassword_slug = 'forgot-password';
	$header_page = 'header.php';
	$footer_page = 'footer.php';
	
	$facebook_appId = '1531698760394905';
	$google_clientId = '225347526904-cuma4b2dl5m0jqoq9m765o2tq255ip1i.apps.googleusercontent.com';
	
	$ecommerce = serialize( array (
	
									'status' => '1',
									
									'product-details'=> 
										array('page' => 'product.php',
												'a' => 'b'),
												
									'category'=> 
										array('page' => 'category.php',
												'a' => 'b'),
												
									'cart'=> 
										array('page' => 'cart.php',
												'slug' => 'mycart',
													'name' => 'My Cart'),
					));
					
	$user_type = serialize( array (
									'admin'=> 
										array('session' => 'rfefg',
												'slug' => 'admin/dashboard.php?'),
									'user'=> 
										array('session' => 'bfjdbf',
												'slug' => 'account/'),
									'driver'=> 
										array('session' => 'fdfdsgsd',
												'slug' => 'associate/')
					));
	
	$notification_error = '<div class="alert alert-danger  fade in" role="alert"><strong>{msg}</strong> <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';
	
	$notification_succ = '<div class="alert alert-success  fade in" role="alert"><strong>{msg}</strong> <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>';
	
	$notification_info = '<div class="alert alert-info  fade in" role="alert">{msg}<button type="button" class="" data-dismiss="alert"><span aria-hidden="true">&times;</span>';
	
	$notification_alert = '<div class="alert alert-info  fade in" role="alert">{msg}<button type="button" class="close" data-dismiss="alert"></div>';
	
	
	$notification_error = '<div class="alert alert-info  fade in" role="alert">{msg}<button type="button" class="close" data-dismiss="alert"></div>';
	
	$notification_succ = '<div class="alert alert-info  fade in" role="alert">{msg}<button type="button" class="close" data-dismiss="alert"></div>';

	
/*
 * -------------------------------------------------------------------
 *  DATABASE SETTINGS
 * -------------------------------------------------------------------
 */
 	
	if($_SERVER['HTTP_HOST']=='localhost') {
		
		define("DB_SERVER","localhost");
		define("DB_USER","root");
		define("DB_PASS","");
		define("DB_NAME","ecom1");
		define('facebookappId', '689227107812211' );
		define('googleclientId', '225347526904-tasuosv344fmn00rtfdq6nfk71jj6c85.apps.googleusercontent.com' );
	
	} else {
		
		define("DB_SERVER","localhost");
		define("DB_USER","sajelect_ecom");
		define("DB_PASS","apnigang@123");
		define("DB_NAME","sajelect_ecom");
		define('facebookappId', $facebook_appId );
		define('googleclientId', $google_clientId );
	}

########################s########################

	if( $baseurl ) {		
		$base = $baseurl;
		$system_path = $baseurl.$system_path;
	
	} else
		$base = getcwd().'/';
			
	
	define('EXT', '.php');
	define('HOMEPAGE', empty($_REQUEST['slug']) ? $home_page_name : $_REQUEST['slug'] );	
	define('basePath', $base );
	define('sysPath', str_replace("\\", "/", $system_path).'/' );
	define('appPath', $baseurl.'application/');
	define('databasePath', sysPath.'/'.$database_folder.'/'.$database_type.'/'.$database_type.EXT);
	define('classPath', sysPath.'classes/' );
	define('controller', appPath.'controllers/' );
	define('models', appPath.'models/' );
	define('library', appPath.'libraries/' );
	
	define('userType', $user_type );
	define('ecommerce', $ecommerce );
	define('headerpage', $header_page );
	define('footerpage', $footer_page );
	define('FORGETPASS', $forgetpassword_slug );
	define('NOTIFICATION', 'notification' );
	define('DATEFORMATE', $data_formate );
	define('frontend', 'act' );
	
	define('notification_error', $notification_error );
	define('notification_succ', $notification_succ );
	define('notification_info', $notification_info );
	define('notification_alert', $notification_alert );
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	
		
	function found_error($name, $type = 'folder' ) {
		exit("Your '$name' $type does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		break;
	}
	
	switch ( $home_page_name ) {
		
		case ( !is_dir( sysPath ) ):
				found_error('SYSTEM_PATH');
				
		case ( !is_dir( appPath ) ):
				found_error('application_folder');
				
		case ( !file_exists( databasePath ) ):
				found_error('DATABASE_PATH', 'file' );
	}
require_once sysPath.'config.php';?>