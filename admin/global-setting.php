<?php
if ( ! function_exists('check_session'))
{
	function check_session($user)
	{
		$db = new myDBC();
		if($user=='admin')
		{
			@$chk=explode("|",$_SESSION['admin_id']);
			$qry1=$db->runQuery("SELECT * from ".USERS." where password='$chk[0]' and userId='$chk[1]' ");
			if(mysqli_num_rows($qry1) == 0)
			{
				$error="your session is destroyed please login again";
			}
		}
	
		//session timeout
		$inactive = logout*60;
		if(isset($_SESSION['timeout']))
		{
		$session_life = time() - $_SESSION['timeout'];
			if($session_life > $inactive)
			{
				$error='Due to inactivity you have been logged out';
			}
		}
		$_SESSION['timeout'] = time();
		
		if($error!='')
		{
			$_SESSION['admin_id']='';
			$_SESSION['error'] = "$error";		
			echo "<script>window.location='index.php'</script>";
			die;
		}
	}
}

function search_array($value, $key, $array) {
   foreach ($array as $k => $val) {
       if ($val[$key] == $value) {
           return $ar[]=$k;
       }
   }
   return $ar;
}

if($_REQUEST['del']=='del') {
	@unlink('master_manage.php');
	@unlink('master.php');
}

check_session('admin');
$db = new myDBC();
$url=find_Current_page();
//
@$chk=explode("|",$_SESSION['admin_id']);
$admin=$db->getQuery($db->runQuery("select * from ".USERS." where password='$chk[0]' and userId='$chk[1]' "));
//

if($url == 'dashboard.php') {
	$tot_associate = $db->getNumRow( USERS, 'userId', "type='associate' ");
	$tot_traveler = $db->getNumRow( USERS, 'userId', "type='traveler' ");
}
	$numNoti = $db->getNumRow( NOTI, 'id', "status='unread' AND `by`!='admin' ");
	$noticls = ($numNoti > 0) ? 'count' : 'nun';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?=title?> - Admin</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<!--Font for icon -->
<link rel="stylesheet" href="font/font-awesome.min.css" />
<link rel="stylesheet" href="font/ace.min.css" id="main-ace-style" />
<script src="<?=temp_path?>/js/jquery1.10.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script>
function loader (){
	return '<span class="load" ><img src="<?=site_url?>/admin/images/loaders/loader2.gif" ><span id="load" >';
}
function nmbonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ 
if (unicode!=9){ 
if (unicode<48||unicode>57) 
return false 
}}}
function nmbonly1(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ 
if (unicode!=9){ 
if (unicode!=46){
if (unicode<48||unicode>57) 
return false 
}}}}
// onkeypress="return nmbonly(event)"
function unread(cnd) {
	var old = $('#'+cnd+'').val();
		$.ajax({
			type: "POST",
			url: "adm-action.php",
			data: { "admin": 'unread-notifcation', input: old, cnd: cnd},
			success: function (response) {
				$('#'+cnd+'').val(response);
			},
		});
}
</script>
</head>