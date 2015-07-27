<?php
session_start();
require_once sysPath.'tables.php';
require_once classPath.'controller.php';
require_once classPath.'loader.php';
require_once databasePath;

function redirect($uri = '', $msg = '', $method = '', $http_response_code = 302) {
		
	if($uri == 'referer' && !isset($_POST['ajx']))
		$method = 'referer';
		
	if ( ! preg_match('#^https?://#i', $uri))
		$uri = site_url.str_replace("//",'/','/'.$uri.'/');
	
	if(isset($_POST['ajx']) && $method == '')
		$method = $_POST['ajx'];
						
	getNotification($msg);
	$_SESSION['not'] = empty($_POST['notification']) ? '' : $_POST['notification']; // particualr forum echo
	
	switch($method) {
		case 'ajx' : notification( $_SESSION['not'] );
			break;
		case 'refresh' : header("Refresh:0;url=".$uri);
			break;
		case 'javascript' : echo "<script>window.location='".$uri."'</script>";
			break;
		case 'referer' : echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
			break;
		default : header("Location: ".$uri, TRUE, $http_response_code);
			break;
	}
	exit;
}


function getNotification ($msg, $type = '' ) {
	$msg = explode('|',$msg);
	if($msg[1] && $msg[0]) {
		$r = str_replace('{msg}', $msg[1], getTemp($msg[0]) );
		if($type == '2')
			return $r;
		else {
			$_SESSION[$msg[0]] = $r;
			$_SESSION['typ'] = $msg[0];
		}
	}
}

function getTemp ($tmp) {
	if($tmp == 'info' )
		return notification_info;
	if($tmp == 'error' )
		return notification_error;
	if($tmp == 'succ' )
		return notification_succ;
}

function notification( $msg = '', $not = '' ) {
	
	if( $not &&  $_SESSION['not'] == '' ){
		$str = getNotification($not,'2');
	}
	elseif($_SESSION['typ'] && $_SESSION['not'] == $msg) {
		echo $_SESSION[$_SESSION['typ']];$_SESSION[$_SESSION['typ']]='';$_SESSION['not']='';$_SESSION['typ']='';
	}
	echo '<span id="'.$msg.'">'.$str.'</span>';
	//if($_POST['notification'] == $msg )$_SESSION['not'] = '';
}


function find_Current_page() {
	
	$u1=$_SERVER['PHP_SELF'];
	$u2=explode('/',$u1);
	$len=count($u2);
	$url=$u2[$len-1];
	return $url;
}


function dateFormt( $input = '' ) {
	if($input == '0000-00-00' || $input == '0000-00-00 00:00:00' )
		return '';
	else
		return date(DATEFORMATE, strtotime($input));
}

function userType ( $input, $type = '' ) {
	if($type == '')
		$type = $_POST['type'];
	$userType = unserialize( userType );
	return $userType[$type][$input];
}
########################################################################

class config  extends loader  {

	function __construct() {
		parent::__construct();
	}
	

	public function action($input) {
		
		// admin action call
		if( $input[frontend]) {
			$textbox = array_filter(explode('/',$input[frontend] ));
			$textbox = array_values($textbox);
			$method= str_replace("-",'_',$textbox[0]);
			$this->controller( $method );
			$this->$method->$textbox[1]();
		}
		else {
		
			$a = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$b = explode(site_url.'/', $a);
			$c = explode('/', $b[1]);
			if ($c[0] == 'activation' ) {
				$this->controller('user');
				$this->user->$c[0](HOMEPAGE);
			}
			if ($c[0] == 'resetPassword' ) {
				$this->controller('user');
				$this->user->forgetpassword(HOMEPAGE);
			}
			else if( !in_array($c[0], array('admin','associate') ) )
				$this->NewObject('cHK_pAGES', HOMEPAGE );
		}
	}
	
	function __destruct() {
	}
}
$stg_one = new config();
$stg_one->NewObject('sITE_fNC');
$stg_one->action($_POST);?>