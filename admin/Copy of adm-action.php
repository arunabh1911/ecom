<?php 
$baseurl = getcwd().'/../';
require $baseurl.'index.php';
$act=$_POST['admin'];
$db = new myDBC();
$load = new loader();

function RecursiveCat($pid,$sel='',$sel1)
{
$db = new myDBC();
if($sel){$cnd="and category_parent!='$sel'";}
static $level=0;
static $strid="";
static $strname="";

$sql= $db->runQuery("select * from ".CAT." where category_parent='$pid' $cnd ");
	while($row= $db->getQuery($sql))
	{
		$id=$row['id'];
		$level--;
		$pad="";
	
		for($p=1;$p<($level*-1);$p++) $pad.="&nbsp;&nbsp;&nbsp;> ";
		$ys=''; if($sel1==$row['id']){ $ys='selected';}
		$strname.='<option '.$ys.' value="'.$row['id'].'">'.$pad.ucwords(strtolower($row['category_title'])).'</option>';
		$rid=RecursiveCat($id,$sel,$sel1);
		$strid[]=$row['id'];
		$level++;
	}
return $strname;
}

if($act == 'import-product2') {
	$load->model('site_function');
	echo '<pre>';
	$fld=array_filter($_REQUEST['fld']);
	$ps=$_SESSION['array'];
	$cnt=$ps[0];
	$key=array_keys($fld);
	$esp = array();
	
	//print_r($key); // only selcted dropdown key
	
	$category = $_POST['category'];
	//print_r($ps); // sab kuch
	//die;
	
	for($i=0; $i< count($ps); $i++)
	{
		for($j=0; $j< count($key); $j++)
		{
			$a=$key[$j];
			$rdb[$i][$j]=$ps[$i][$a];
		}
	}
	
	//print_r($rdb); // filter data only
	//print_r($fld); // mysql filter fields
	
	## GET READY ARRAY ##
		
		/*re-arrange field key 0-1-2-3*/
		$arr = array_values($fld);
		if(!in_array('partNum', $arr))
			die('you havent select Product Part No');		
		
		
		/*manufacturer*/
		$manufacturer = array();
		$qry = $db->runQuery("SELECT * FROM ".MANU." ");
		while ( $res=$db->getQuery($qry))
			$manufacturer[$res['id']]= strtolower($res['name']);
		
		/*partNum*/
		$partNum = array();
		$qry = $db->runQuery("SELECT partNum FROM ".PRODUCT." ");
		while ( $res=$db->getQuery($qry))
			$partNum[]= $res['partNum'];
		
		/*parameters*/
		$qry = $db->runQuery("SELECT * FROM ".PAR." ");
		while ( $res=$db->getQuery($qry))
			$par[]= strtolower($res['slug']);
			
		/*masters*/
		$masters = array();
		$qry = $db->runQuery("SELECT * FROM ".MASTERS." ");
		while ( $res=$db->getQuery($qry))
			$masters[$res['id']]= strtolower($res['name'].$res['type']);
	
	
	## CATEGORY ##
		$cat = array_search('catId', $arr);
		if ($cat !== false) {
			for($i=0; $i< count($rdb); $i++) {
				if($category[$i] > 0)
					$rdb[$i][$cat] = $category[$i];
				else {
					$esp[] =  $i; $rsn[] =  $i.'|'.$rdb[$i][$cat];
				}
			}
		}
		
	## PRODUCT IMAGE ##
		$img = array_search('productPhoto', $arr);
		if ($img !== false) {
			for($i=0; $i< count($rdb); $i++) {
				$ext = explode('.',$rdb[$i][$img]);
				if( end($ext) == 'jpg' || end($ext) == 'png' ) {
					$content = file_get_contents($rdb[$i][$img]);
					$random = substr(number_format(time() * rand(),0,'',''),0,4).'.'.end($ext);
					$fp = fopen('../'.image_folder.'/'.$random, "w");
					fwrite($fp, $content);
					fclose($fp);
					$rdb[$i][$img] = $random;
				}
				else
					$rdb[$i][$img] = '';
			}
		}
	
	## DATASHEET IMAGE ##
		$shet = array_search('datasheet', $arr);
		if ($shet !== false) {
			for($i=0; $i< count($rdb); $i++) {
				$ext = explode('.',$rdb[$i][$shet]);
				if( end($ext) == 'pdf' ) {
					$content = file_get_contents($rdb[$i][$shet]);
					$random = substr(number_format(time() * rand(),0,'',''),0,4).'.'.end($ext);
					$fp = fopen('../'.image_folder.'/'.$random, "w");
					fwrite($fp, $content);
					fclose($fp);
					$rdb[$i][$shet] = $random;
				}
				else
					$rdb[$i][$shet] = '';
			}
		}
		
	## PART NUMBER EXIST ##
	
	$slug = array_search('slug', $arr);
	
		$prt = array_search('partNum', $arr);
		if ($prt !== false) {
			for($i=0; $i< count($rdb); $i++) {
				@$key = array_search($rdb[$i][$prt], $partNum);
					if ($key !== false ) {
						$esp[] =  $i; 
							if($rdb[$i][$prt] == '') 
								$rsn[] =  $i.'| blank';
							else
								$rsn[] =  $i.'|'.$rdb[$i][$prt];
						}
						$rdb[$i][$slug] = $load->site_function->slugify($rdb[$i][$prt]);   //echo ' - '.$rdb[$i][$slug];;
				}
			}
	
	## MANUFACTURER ##	
		$mnf = array_search('manufacturer', $arr);
		if ($mnf !== false) {
			for($i=0; $i< count($rdb); $i++) {
				$key = array_search(strtolower($rdb[$i][$mnf]), $manufacturer);
				if ($key !== false)
					$rdb[$i][$mnf] =  $key;
				else {
					$esp[] =  $i; $rsn[] =  $i.'|'.$rdb[$i][$mnf];
					}
			}
		}
	
	## PARAMETERS ##	
		//$arr; // no of dropdown
		//$par; // all parameters from database
		//print_r($rdb); // data which insert
		// $master
		//die;
		
		for($j=0; $j< count($par); $j++) {

			$slg = array_search($par[$j], $arr);
			if ($slg !== false) {
				
				for($i=0; $i< count($rdb); $i++) {	
						
						$key = array_search(strtolower($rdb[$i][$slg].$par[$j]), $masters);
						if ($key !== false)
							$rdb[$i][$slg] =  $key;
						else {
							if($rdb[$i][$slg] == '-')
								$rdb[$i][$slg] =  '';
							else
								$esp[] =  $i; $rsn[] =  $i.'|-'.$rdb[$i][$slg].'|-'.$par[$j];
							}
					}
			}
		}
	
	//print_r($rdb); 
	//print_r($fld);
	//print_r($rsn); 
	//die;
	
	$fld='`'.implode("`,`",$fld).'`';
	$py=$_POST['py'];
	$py = array_merge(array_diff($esp, $py), array_diff($py, $esp));
	
	$tot=0;
	for($i=0; $i< count($ps); $i++)
	{
		if(in_array($i,$py)) {
		
			$val=implode("','",$rdb[$i]);;
			$val="'$val'";
			
			$db->runQuery("insert into ".PRODUCT." ($fld) values ($val) ");
			$tot += 1;
		}
	}
		echo "<strong>$tot row insert successfully!!</strong>";?>
		<a href="<?=site_url?>/admin/import.php">back</a>
		<? die;
}


if($act == 'import-product1') {
	$load->model('site_function');
	$table = PRODUCT;
	$leave_rows = 0; 

	error_reporting(E_ALL ^ E_NOTICE);
	require_once("excel/reader.php");
	require_once("excel/oleread.php");
	require_once("excel/OLE.php");
	$edata = new Spreadsheet_Excel_Reader();

	$nn= $_FILES['fileuploaded']['name'];
	if($_FILES['fileuploaded']['tmp_name']) {
		$edata->read($_FILES['fileuploaded']['tmp_name']);
	}	
	$arr=array();
	
	$query = $db->runQuery("SELECT * FROM ".PRODUCT." ");
	while ($property = mysqli_fetch_field($query))
		$fld[]= $property->name;
?>

<form action="adm-action.php" method="post">
<table width="100%" border="1">
    <tr>
    
     <td>
    <input type="checkbox" checked="checked" />
    </td>
    
    <?php
    for($m=0;$m< $edata->sheets[0]['numCols']+1 ;$m++)
    {?>
    	<td>
		<? if($m !='0'){?>
        <select name="fld[]">
        <option value="">None</option>
        <?php for($i=0; $i<count($fld); $i++) { ?>
        <option value="<?=$fld[$i]?>"><?=ucwords($load->site_function->parameters($fld[$i]))?></option>
        <?php }?>
        </select>
		<? }else{?>	 <input name="fld[]" value="catId" type="hidden" />
		<? }?>
        </td>
    <?php }?>
	<input name="fld[]" value="slug" type="hidden" />
    </tr>

<?php
$num=0;
echo '<pre>';

for($i = 1+$leave_rows; $i <= $edata->sheets[0]['numRows']; $i++)
{
	
	for ($j = 0; $j <= $edata->sheets[0]['numCols']; $j++)
	{
		if($j == '0'){
			$farr[]='catId';
		}
		else {
	
			$arr[$i][$j]=$edata->sheets[0]['cells'][$i][$j];
			$farr[]=$arr[$i][$j];
		}
		
	}

?>
	<td align="center">
	<? 
	
	if($num =='0') { ?>
		<input name="py[]" type="hidden" value="<?=$num?>" />
	<? }else{ echo $num; ?>
    	<!--<input name="py[]" type="checkbox" value="<?=$num?>" checked="checked" />-->
		<input name="py[]" type="hidden" value="<?=$num?>" />
	<? }?>
    </td>
	
	
<?php		
	
	for($h=0; $h<=  $edata->sheets[0]['numCols']; $h++) {
		
	if($h == '0'){ $row.='catId||'; ?>
	
		<td>
			<select name="category[]" style="width:200px;" >
			<option value="0">No Parent</option>
			<?=RecursiveCat('0',$_REQUEST['id'],$view['category_parent']);?>
			</select>
		</td>
	
	<? }else{ $row.=$arr[$i][$h].'||';?>
   		
		<td><?=$arr[$i][$h]?></td>
	<?php }   }  $row.='slug||';    ?>
	
	</tr>
		
		
    <?php 
	$com=array_filter(explode("||", $row));
	$ps[]=$com;
	$row='';
	$num++; 
	} ?>
</table>

<?php 
$_SESSION['array']=$ps;?>
 <input type="hidden" name="admin" value="import-product2" />
<input name="submit2" type="submit" />
</form>

<? }

####################################################################################

function setBlnk($input) { //notification
	if(isset($_POST[$input]) && $_POST[$input] == '' )
		$_POST[$input] = 'x';
}

function adminNoti($type, $typeId, $userId, $name = '') { // address/service | addressid | userId
	$db = new myDBC();
	$array = array('date'=> date('Y-m-d H:i:s'), 
						'remark' => $name,
							'type'=> $type,
								'by' => 'admin',
									'userId' => $userId,
										'typeid' =>$typeId );
	$db->insert( NOTI, $array );
}

if($act == 'unread-notifcation') {
	if($_POST['cnd']) {
		echo $str = empty($_POST['input']) ? 'starred' : '';
		$db->update(NOTI, array(star => $str), " id = '".$_POST['cnd']."' ");
	}
	else
		$db->update(NOTI, array(status => 'read'), " id > '0' ");
}

if($act == 'image-delete') {
		$img = $_POST['img'];
		$tbl = $_POST['tbl'];
		$id = $_POST['id'];		
		
		$d=$db->getQuery($db->runQuery("select * from $tbl where id='$id'")); 
		@$ar=explode(',',$d['img']);
		@$clr=explode(',',$d['title']);
		@$key=array_search($img,$ar);
		@unlink($baseurl.image_folder.'/'.$ar[$key]);
		unset($ar[$key]);
		unset($clr[$key]);
		$db->runQuery("update $tbl set img='".implode(',',$ar)."', title='".implode(',',$clr)."' where id='$id'");
}


if($act=='gallery1' || $_REQUEST['act']=='gallery1')
{
	if($_REQUEST['stp']=='2')
	{
		$qry1=$db->runQuery("SELECT * from ".GALLERY." where id='$_REQUEST[id]' ");
		$gal=$db->getQuery($qry1);
		//$gal=mysql_fetch_array(mysql_query("select * from gallery1 where id='$_REQUEST[id]' "));
		$img=explode(',',$gal['img']);
		$tit=explode(',',$gal['title']);
		
		$value=$_REQUEST;
		$name=array_keys($value);	
		for($i=0; $i< count($value); $i++)
		{
			$pst=str_replace("_",'.',$name[$i]);
			$d=explode('.',$pst);
			if(is_numeric($d[0]))
			{
				$key=array_search($pst,$img);
				$tit[$key]=$_REQUEST[$name[$i]];
			}
		}
		$title=implode(',',$tit);
		//mysql_query("update gallery1 set title='$title' where id='$_REQUEST[id]' ");
		$db->runQuery("update ".GALLERY." set title='$title' where id='$_REQUEST[id]' "); ?>
        <div class="notibar msgsuccess">
		<a class="close"></a><p>Save Successfully</p></div>
		<? die;
	}
	
	$load->model('site_function');
	//$img1=images_upload('imgaes','image',$base);
	$img1 = $load->site_function->images_upload('imgaes', 'image', $baseurl);
	
	if($img1){
	$tit1=str_repeat(",x",count(explode(',',$img1))); 
	$db->runQuery("update ".GALLERY." set 
	title='".trim($_POST['tit'].$tit1, ',')."',
	img='".trim($_POST['img'].','.$img1, ',')."'
	where id='$_REQUEST[id]' ");?>
    
            <div class="gallerywrapper">				
            <ul class="imagelist">  
            <? 
            $img=explode(",", $img1);
            for($i=0; $i< count($img); $i++){
            ?>
            <li>
            <img src="<?=img_path.$img[$i]?>" alt="" width="100px;" />
            <span style="float:left;"><input name="<?=$img[$i]?>" type="text" placeholder="title" /></span> 
            </li>
            <? }?>
            </ul>
            </div>
                    <p class="stdformbutton">
                    <button class="submit radius2">Submit</button>
                    <input type="hidden" name="id" value="<?=$_POST['id']?>" />
                  	<input type="hidden" name="stp" value="2" />
                    <input type="hidden" name="admin"value="gallery1" />
                    </p>	

<? }else{echo'please upload image only';}die;}




if($act=='logout')
{
	$_SESSION['admin_id']='';
	$_SESSION['error'] = 'Logged Out Successfully!';		
	echo "<script>window.location='index.php'</script>";
	die;
}

if($act=='login')
{	
	$pass=md5($_POST['password']);
	$user=$db->clearText($_POST['username']);
	$qry1=$db->runQuery("SELECT * from ".USERS." where email='$user' AND password='$pass' AND type = 'admin' ");
	if(mysqli_num_rows($qry1) > 0)
	{
		$user=$db->getQuery($qry1);
		$_SESSION['admin_id'] = $user['password'].'|'.$user['userId'];
		$_SESSION['succ'] = 'Login Successfully';
		echo "<script>window.location='dashboard.php'</script>";
		die;
	}
	else
	{
		$_SESSION['error'] = 'username or password you entered is incorrect';
		echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		die;
	}
}

if($act=='setting') {
	
	$load->model('site_function');
	
	/*if($_POST['eway1'])
	{
		$_POST['eway'] = $_POST['eway1'].'|'.$_POST['eway2'].'|'.$_POST['eway3'];
		
		$eway=explode('|',$_POST['eway-chk']);
		if($eway[0] != $_POST['eway1'] || $eway[1] != $_POST['eway2'] || $eway[2] != $_POST['eway3'])
		{
			$fname = "$base/site-includes/gateway/eway/config.ini";
			$fhandle = fopen($fname,"r");
			$content = fread($fhandle,filesize($fname));
			$search= array ($eway[0],$eway[1],$eway[2]);
			$replace=array($_POST['eway1'],$_POST['eway2'],$_POST['eway3']);			
			$content =str_replace($search,$replace,$content);			
			$fhandle = fopen($fname,"w");
			fwrite($fhandle,$content);
			fclose($fhandle);
		}
	}*/
	
	setBlnk('admin_announcement');
	setBlnk('admin_notification');
	setBlnk('associate_announcement');
	setBlnk('associate_notification');	
	
	if($_POST['s_facebook']) { //site_address
	$address =  array(youtube => $_POST['s_youtube'], linkedin => $_POST['s_linkedin'], facebook => $_POST['s_facebook'], twitter => $_POST['s_twitter'], pinterest => $_POST['s_pinterest'], google => $_POST['s_google'], instagram => $_POST['s_instagram']);
		$_POST['social'] = json_encode($address);
	}
	
	
	if($_POST['paypal1'])
		$_POST['paypal_standard'] = "$_POST[paypal1]|$_POST[paypal3]|$_POST[paypal2]";
	
	if($_POST['cc1'])
		$_POST['CCAvenue'] = "$_POST[cc1]|$_POST[cc2]";
	
	
	
	if($_POST['add_phone_one']) { //site_address
	$address =  array(add_phone_one => $_POST['add_phone_one'], add_email_one => $_POST['add_email_one'], add_one => $_POST['add_one'], add_two => $_POST['add_two'], add_three => $_POST['add_three'], add_four => $_POST['add_four'] );
		$_POST['site_address'] = json_encode($address);
	}
	
	if( $img = $load->site_function->images_upload('site_logo', 'image', $baseurl) ) { //site_logo
		@unlink($_POST['unlink']);
		$_POST['site_logo'] = $img;
	}
	
	if($_POST['email_status']) { //emailConfiguration
		$email = array(status => $_POST['email_status'], type => $_POST['email_type'], smtp => $_POST['email_smtp'], port => $_POST['email_port'], username => $_POST['email_user'], password => $_POST['email_pass'] );
		$_POST['emailConfiguration'] = json_encode($email);
	}
	
	$value=$_POST;
	$name=array_keys($value);		
	for ($i=0; $i< count($value); $i++) {
		if(current($value)!='') {
			$db->runQuery("update ".SETTINGS." set value='".$db->clearText(current($value))."' where setting='$name[$i]' ");
		}
			next($value);
	}
	$_SESSION['succ']='Settings Save Successfully';
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}

if($act=='editprofile')
{
	$load->model('site_function');
	$img = $load->site_function->images_upload('filename', 'image', $baseurl);
	
	if($img)
	{
		@unlink($_POST['unlink']);
		$cnd=",image1 = '$img'";
	}
	
	@$chk=explode("|",$_SESSION['admin_id']);
	$db->runQuery("update ".USERS." set name='".$db->clearText($_POST['name'])."' $cnd where password ='$chk[0]' and userId='$chk[1]' ");
	$_SESSION['succ'] = 'Update Successfully';		
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}

if($act=='changepassword')
{
	$opass=md5($_POST['opass']);
	$npass=md5($_POST['npass']);
	$pass=explode('|',$_SESSION['admin_id']);
	$qry1 = $db->runQuery("SELECT * from ".USERS." where userId='$pass[1]' AND password='$opass' ");
	if(mysqli_num_rows($qry1) > 0)
	{
		@$chk=explode("|",$_SESSION['admin_id']);
		$db->runQuery("update ".USERS." set password='".$db->clearText($npass)."' where userId='$chk[1]'");
		$_SESSION['succ'] = 'Password Change Successfully';		
		$_SESSION['admin_id']="$npass|$pass[1]";
	}
	else
	{
		$_SESSION['error'] = 'Incorrect Old Password';	
	}
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}


/*add_master*/

if($act=='add_master')
{
	$load->model('site_function');
	
		$date=date('Y-m-d');
		$typp=$_POST['selection'];
		$page_name = $db->clearText(strtolower($_POST['page_name']));
		$goto = $db->clearText(strtolower($_POST['goto']));
		if($_POST['editor']=='0'){$_POST['ajax_upload']='0';}
		$slug =  $load->site_function->slugify($page_name);
		$option=implode(',',array_filter(explode(',',"$_POST[title],$_POST[date],$_POST[text],$_POST[editor],$_POST[img],$_POST[seo],$_POST[header],$_POST[footer],$_POST[subpage],$_POST[ajax_upload],$_POST[sess]")));
		$msg='Create';
		
		$setting = json_encode(array('userType' => $_POST['tpe']));		
		
		if($typp=='gallery')
		{
			$option="$_POST[title],gallery";
		}
		
		$seo=''; if($_POST['seo']==''){$seo="seo='',";}
		
		if($_POST['id']!='')
		{
			$slug =  $load->site_function->slugify($db->clearText($_POST['slug']));
			$getid=$_POST['id'];
			$msg='Update';
			
			$db->runQuery("update ".CATEGORY." set 
					parent_id='$_POST[category]', 
					page_name='$page_name',
					options='$option',
					$seo
					setting = '".$db->clearText($setting)."',
					folder='$_POST[folder]',
					goto='$goto',
					slug='$slug'
					where page_id='$getid'
					");
			
				//title
				if($_POST['title']=='title')
				{
					$title1 = $db->clearText(strtolower($_POST['title1']));
					$db->runQuery("update ".FORM." set title='$title1' where id='$_POST[titleid]' and sub_id='0' ");
				}
						
				//date
				$edate=$_POST['edate'];
				$eid=$_POST['dateid'];
				for($i=0; $i<= count($edate); $i++)
				{
					if($edate[$i]!='')
					{
						$edate1 = $db->clearText(strtolower($edate[$i]));
						$db->runQuery("update ".FORM." set title='$edate1' where id='$eid[$i]' and sub_id='0' ");
					}
					else
					{
						$db->runQuery("delete from ".FORM." where id='$eid[$i]'");
					}
				}
				
				//textbox
				$edate=$_POST['etextbox'];
				$eid=$_POST['textboxid'];
				for($i=0; $i<= count($edate); $i++)
				{
					if($edate[$i]!='')
					{
						$edate1 = $db->clearText(strtolower($edate[$i]));
						$n="ftextbox$eid[$i]"; $opt=$_POST[$n];
						$db->runQuery("update ".FORM." set title='$edate1', options='$opt' where id='$eid[$i]' and sub_id='0' ");
					}
					else
					{
						$db->runQuery("delete from ".FORM." where id='$eid[$i]'");
					}
				}
				
				//editor
				$edate=$_POST['eeditor'];
				$eid=$_POST['editorid'];
				for($i=0; $i<= count($edate); $i++)
				{
					if($edate[$i]!='')
					{
						$edate1 = $db->clearText(strtolower($edate[$i]));
						$db->runQuery("update ".FORM." set title='$edate1' where id='$eid[$i]' and sub_id='0' ");
					}
					else
					{
						$db->runQuery("delete from ".FORM." where id='$eid[$i]'");
					}
				}
				
				//img
				$edate=$_POST['eimg'];
				$eid=$_POST['imgid'];
				for($i=0; $i<= count($edate); $i++)
				{
					if($edate[$i]!='')
					{
						$edate1 = $db->clearText(strtolower($edate[$i]));
						$n="fimg$eid[$i]"; $opt1=$_POST[$n]; $o="gimg$eid[$i]"; $opt2=$_POST[$o];
						$p="timg$eid[$i]"; $opt3=$_POST[$p];
						$opt="$opt1|$opt2|$opt3";
						$db->runQuery("update ".FORM." set title='$edate1', options='$opt' where id='$eid[$i]' and sub_id='0' ");
					}
					else
					{
						$db->runQuery("delete from ".FORM." where id='$eid[$i]'");
					}
				}
				
				$cnd="forms='x'";
				if($_POST['title']=='0')
				{
					$cnd.=" OR forms='title'";
				}
				if($_POST['date']=='0')
				{
					$cnd.=" OR forms='date'";
				}
				if($_POST['text']=='0')
				{
					$cnd.=" OR forms='textbox'";
				}
				if($_POST['editor']=='0')
				{
					$cnd.=" OR forms='editor'";
				}
				if($_POST['img']=='0')
				{
					$cnd.=" OR forms='img'";
				}
				$db->runQuery("delete from ".FORM." where category_id='$getid' and ($cnd)");
		}
		
		else
		{
			$db->runQuery("insert into ".CATEGORY."
					(
					parent_id,
					page_name,
					type,
					setting,
					options,
					goto,
					slug	
					)
					values
					(
					'$_POST[category]',
					'$page_name',
					'$typp',
					'".$db->clearText($setting)."',
					'$option',
					'$goto',
					'$slug'
					)
					");
			$getid= $db->lastInsertID();
		}
		
		
		//title
		if($_POST['titleid']=='' && $_POST['title1']!='')
		{
			$cdate = $db->clearText(strtolower($_POST['title1']));
			$db->runQuery("insert into ".FORM." (category_id,forms,title,options) values('$getid','title','$cdate','1')");
		}

		//date
		if($_POST['date']=='date' && $getid!='' && $typp!='gallery')
		{
			$sdate=$_POST['sdate'];
			for($i=0; $i< count($sdate); $i++)
			{
				$cdate = $db->clearText(strtolower($sdate[$i]));
				$db->runQuery("insert into ".FORM." (category_id,forms,title,options) values('$getid','date','$cdate','1')");
			}}	
		
		//textbox
		if($_POST['text']=='textbox' && $getid!='' && $typp!='gallery')
		{
			$stext=$_POST['stextbox'];
			for($i=0; $i< count($stext); $i++)
			{
				$ctext = $db->clearText(strtolower($stext[$i]));
				$t="stextbox$i";$type=$_POST[$t];
				$db->runQuery("insert into ".FORM." (category_id,forms,title,options) values('$getid','textbox','$ctext','$type')");
			}
		}
		
		//texteditor
		if($_POST['editor']=='editor' && $getid!='' && $typp!='gallery')
		{
			$seditor=$_POST['seditor'];
			for($i=0; $i< count($seditor); $i++)
			{
				$ceditor = $db->clearText(strtolower($seditor[$i]));
				$db->runQuery("insert into ".FORM." (category_id,forms,title,options) values('$getid','editor','$ceditor','1')");
			}
		}
		
		//images
		if($_POST['img']=='img' && $getid!='' && $typp!='gallery')
		{
			$simg=$_POST['simg'];
			for($i=0; $i< count($simg); $i++)
			{
				$cimg = $db->clearText(strtolower($simg[$i]));
				$t="simg$i";$type1=$_POST[$t];
				$u="isimg$i";$type2=$_POST[$u];
				$v="tsimg$i";$type3=$_POST[$v];
				$db->runQuery("insert into ".FORM." (category_id,forms,title,options) values('$getid','img','$cimg','$type1|$type2|$type3')");
			}
		}
		
	$_SESSION['succ']=''.$msg.' Successfully';
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;	
}

if($_REQUEST['act']=='ajax_create')
{
	$name=$_REQUEST['name'];
	for($i=0; $i< $_REQUEST['val']; $i++)
	{?>
		<input type="text" name="<?=$name?>[]" class="smallinput" placeholder="name" />
		&nbsp;&nbsp;&nbsp;
		<? if($name=='stextbox' || $name=='simg'){?>
		<input type="radio" name="<?=$name.$i?>" value="1" checked /> Single &nbsp; &nbsp;
		<input type="radio" name="<?=$name.$i?>" value="0" /> Multiple &nbsp; &nbsp;
		<? }?>
		<? if($name=='simg'){?>
		<br />
		<input type="radio" name="i<?=$name.$i?>" onclick="$('#img1').show()" value="1" /> Image &nbsp; &nbsp;
		<input type="radio" name="i<?=$name.$i?>" onclick="$('#img1').show()" value="2" /> Video &nbsp; &nbsp;
		<input type="radio" name="i<?=$name.$i?>" onclick="$('#img1').show()" value="3" /> Img/Video &nbsp; &nbsp;
        <input name="t<?=$name.$i?>" type="checkbox" value="1" />&nbsp; Title
		<br /><br />
		<? }?>		
		<br />
	<? }
	die;
}

if($_REQUEST['act']=='add_button')
{
	$id=$_REQUEST['id'];
	$options=explode("|",$_REQUEST['opt']);
	if($_REQUEST['name']=='textbox')
	{?>
        <input type="text" name="t<?=$id?>[]" />
	<? }
	if($_REQUEST['name']=='img')
	{?>
		<table width="100%" border="0">
<tr>
<td width="10%">&nbsp;</td>
<? if($options[1]=='2' || $options[1]=='3'){?><td>
<input name="v<?=$id?>[]" type="text" style="width:100px;" /></td><? }?>
<? if($options[1]=='1' || $options[1]=='3'){?><td>
<input name="im<?=$id?>[]" type="file" />
<font color="#FFFFFF">.....</font>

</td><? }?>
<? $tit='text'; if($options[2]!='1'){$tit='hidden';}?>
<td><input name="it<?=$id?>[]" type="<?=$tit?>" style="width:180px;"  /></td>
<!--<td width="31%"><input type="checkbox" name="hide" value="1" /></td>-->
</tr>
</table>
	<? }
}

/*add_master*/


if($_REQUEST['admin'] == 'delete_row') {
	
	$field = ($_REQUEST['field'] == '' || $_REQUEST['field'] == 'undefined' ) ? 'id' : $_REQUEST['field'];
	
	if( $_REQUEST['tbl'] == FORM  ) {
		$sql_result=$db->runQuery("select sub_id from ".FORM." where sub_id='$_REQUEST[id]' ");
		if(mysqli_num_rows($sql_result) > 0) {
			$db->runQuery("delete from ".FORM." where sub_id='$_REQUEST[id]' ");
			die;
		}
	}
	//also del form table with category table
	if($_REQUEST['tbl'] == CATEGORY ) {
		$db->runQuery("delete from $_REQUEST[tbl] where page_id='$_REQUEST[id]' ");
		$db->runQuery("delete from ".FORM." where category_id='$_REQUEST[id]' ");
		die;
	}
	
	//for all
	$db->runQuery("delete from $_REQUEST[tbl] where $field = '$_REQUEST[id]' ");
	
	//users address
	if($_REQUEST['tbl'] == USERS ) {
		$db->runQuery("delete from ".ADDRESS." where userId='$_REQUEST[id]' ");
	}
	die;	
}

if($act == 'del-mail') {
	
	$db->runQuery("delete from ".EMAILTEMP." where id='$_POST[user]' ");
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}


if($act=='update_pages')
{
	$load->model('site_function');
	$value=$_POST;
	$name=array_keys($value);		
	$files=$_FILES; 
	$fname=array_keys($files);
	$rand=substr(number_format(time() * rand(),0,'',''),0,5);	
	
	//seo
	$db->runQuery("update ".CATEGORY." set seo='".$db->clearText($_POST['meta_keywords'].'||'.$_POST['meta_description'].'||'.$_POST['meta_title'])."' where page_id='$_POST[id]' ");
	
	for ($i=0; $i< count($fname); $i++)
	{
		$chk[substr($fname[$i],2)]=$files[$fname[$i]]['name'];
		$img[]=explode('||',$load->site_function->images_upload($fname[$i],'image',$baseurl,'||'));
	}
	
	for ($i=0; $i< count($name); $i++)
	{
		$set1=implode(',',explode(",", current($name)));
		$cnd=substr($set1, 0, 1); //echo " - ";
		@$val= implode('||',array_filter($value[$name[$i]]));
		
		if($cnd=='d')
		{
			$forms='date';
			$date= explode('-',$val);krsort($date);$val=implode("-",$date);
		}
		if($cnd=='l'){$forms='title';} if($cnd=='t'){$forms='textbox';} if($cnd=='e'){$forms='editor';}
		if($cnd=='v'){$forms='img';}
			
		if(@in_array(substr($set1, 1),array_keys($chk)))
		{
			$v='';
			if($k==''){$k=0;}
			$vdo=explode('||',$val);
			for ($j=0; $j<count($img[$k]); $j++)
			{	
				if($img[$k][$j]=='')
				{
					$v[]=$vdo[$j];
				}
				else
				{
					$v[]=$img[$k][$j];
				}
			}
			$k++;
			$val=implode('||',array_filter($v));
		}
		
		
		if($_POST['type']=='single page' || $_POST['sub_id']!='')
		{
			if(is_numeric(substr($set1, 1)))
			{
				$db->runQuery("update ".FORM." set content='".$db->clearText($val)."' where id='".substr($set1, 1)."' ");
			}
			if((substr($set1,0, 2))=='it')
			{
				@$val= implode('||',$value[$name[$i]]);
				$db->runQuery("update ".FORM." set content2='".$db->clearText($val)."' where id='".substr($set1, 2)."' ");
			}
		}
			
		if($_POST['type']=='multiple page' && $_POST['sub_id']=='')
		{
			if(is_numeric(substr($set1, 1)))
			{
				$db->runQuery("insert into ".FORM." 
							(category_id,
							sub_id,
							forms,
							content
							)
							values(
							'$_POST[id]',
							'$rand',
							'$forms',
							'".$db->clearText($val)."'
							)");							
			}
		}
		next($name);		
	}
	
	$_SESSION['succ']='Update Successfully';
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;	
}


if($act == 'images-upload') {
	$load->library('ajax_upload');
	$idx=$_POST['idx'];
	
	if($_POST['del']){		
			@unlink($baseurl.image_folder.'/'.$_POST['del']);
			$db->runQuery("delete from ".IMG." where img='$_POST[del]' ");
	}
	else if($_POST['name']) {//edit
		$load->model('site_function');
		if( $img = $load->site_function->images_upload('images', 'image', $baseurl) ) {
			@unlink($baseurl.image_folder.'/'.$_POST['name']);
			$db->runQuery("UPDATE ".IMG." SET img='$img' WHERE slug = '$_POST[slug]' ");	
		}
	}
	else {//new
		$load->model('site_function');	
		if( $img = $load->site_function->images_upload('media', 'image', $baseurl) ) {
			$f = explode('.', $img); $file="{IMAGE-$f[0]}";
			$db->runQuery("insert into ".IMG." (img,page_id,slug) values('$img','$idx','$file')");
		}
	}
	$load->ajax_upload->show_db($idx);
}


if($act == 'email-template') {
	
	$email = $db->clearText($_POST['email']);
	$message_content = $db->clearText($_POST['content']);
	$subject = $db->clearText($_POST['subject']);
	$date = date('Y-m-d');
	$id = $_POST['id'];
	
	$db->runQuery("UPDATE ".EMAILTEMP." SET subject = '".$subject."', email = '".$email."', content = '".$message_content."',dateModify = '".$date."', status = '".$_POST['status']."' WHERE id = '".$id."'");
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}

if($act == 'user-status' ) {
		
		$load->model('site_function');
		$paassword = substr(number_format(time() * rand(),0,'',''),0,4); 
		
		$data = array('status' => $_POST['userStatus'] ,
						'dateApprove' => date('y-m-d') ,
							'password' => md5($password) );
		
			
		if( $db->update( USERS, $data, "userId = '$_POST[id]' " )  ) {
			
			if ( $db->getNumRow( ADDRESS,'id', "userId = '".$_POST['id']."' ") == '1' && $_POST['userStatus'] == 'active' )
				$db->update( ADDRESS, array(status => 'active'), "userId = '$_POST[id]' " );
			
			
			if($_POST['sendMail'] == 'true' )
			$load->site_function->sendMail('16',  array(userId => $_POST['id'], password => $paassword) );
		
		if($_POST['userStatus'] == 'active')
			$chng = 'inactive';
		if($_POST['userStatus'] == 'inactive')
			$chng = 'active';
		if($_POST['userStatus'] == 'suspended')
			$chng = 'active';
		
		if($_POST['ajax'] == '1')
		echo '<li><a href="javascript:void(0)" current="'.$_POST['userStatus'].'" id="'.$chng.'" onclick="statuss(this)">'.ucwords($chng).'</a></li><li><a href="javascript:void(0)" current="'.$_POST['userStatus'].'" id="suspended" onclick="statuss(this)">Suspend</a></li>';
		else
			echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		die;
		}
}

if($act == 'default-status') { //amenity, asso-address, service, hotel, associate, email, traveler

		$cnd = empty($_POST['cnd']) ? $_POST['cnds'] : $_POST['cnd'];

		if($_POST['id'] && $cnd && $_POST['tbl'] ){
			$id = 'id';
			if($_POST['tbl'] == USERS)
				$id = 'userId';
			
			if( $db->update( $_POST['tbl'], array('status' => $cnd ) , " `".$id."` = '$_POST[id]' " )  ) {
				
				if($_POST['tbl'] == ADDRESS)
					adminNoti('address', $_POST['id'], $_POST['userId'], "your address status changed to $cnd" );
				
				$_SESSION['succ'] = 'Status Changed successfully';
				echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";die;
			}
		}
}


if($act == 'approve') {
		//print_r($_POST);die;
		$noti = $db->getRecord( NOTI, '', "id = '".$_POST['notiId']."' " );
		$rdata = json_decode(stripslashes($noti[0]['data']), TRUE);
		
		if($noti[0]['record'] == 'new' )
			$data = array('status' => ($_POST['cnd'] == 'approved') ? 'active' : $_POST['cnd'] );
			
		else if(ADDRESS == $_POST['tbl'] && $_POST['type'] == 'service' ) {
			$address = $db->getRecord( ADDRESS,'', "id = '".$noti[0]['typeId']."' " );
			if( $_POST['cnd'] == 'approved' ) {
				$array = trim(implode(',',array_unique(array_merge(explode(',',$address[0]['service']),$_POST['service'] ))),',');
				$data = array('service' => $array );
			}
		}
		
		else if(ADDRESS == $_POST['tbl'])		
			$data = array('name' => $rdata['name'] ,		
							'email' => $rdata['email'] ,
								'pincode' => $rdata['pincode'],
									'landlineNo' => $rdata['landlineNo'],
										'mobileNo' => $rdata['mobileNo'],
											'faxNo' => $rdata['faxNo'],
												'address' => $rdata['address'],
													'landmark' => $rdata['landmark'],
														'city' => $rdata['city'],
															'state' => $rdata['state'],
																'country' => $rdata['country'] );
		
		else if(HOTEL == $_POST['tbl'])
			$data = array(	'name' => $rdata['name'] ,
								'contactPerson' => $rdata['contactPerson'] ,
									'email' => $rdata['email'] ,
										'pincode' => $rdata['pincode'],
											'landlineNo' => $rdata['landlineNo'],
												'mobileNo' => $rdata['mobileNo'],
													'faxNo' => $rdata['faxNo'],
														'address' => $rdata['address'],
															'landmark' => $rdata['landmark'],
																'city' => $rdata['city'],
																	'state' => $rdata['state'],
																		'country' => $rdata['country'],
																			'image1' => $rdata['image1'],
																				'about' => $rdata['about'] );
		
		##
		if( $_POST['cnd'] == 'approved' || $noti[0]['record'] == 'new' )
			 $db->update( $_POST['tbl'], $data , "id = '".$noti[0]['typeId']."' " );

		$cmt = ($_POST['input'] == 'undefined' || $_POST['input'] == '' ) ? '' : "<br/><strong>Remark:</strong> $_POST[input]";
		if( $db->update( NOTI, array(cnd => $_POST['cnd'], sdate => date('Y-m-d H:i:s') ) , "id='".$_POST['notiId']."'" ) ) {
			adminNoti($noti[0][type],$noti[0]['typeId'],$noti[0]['userId'],"your ".$noti[0][type]." request is $_POST[cnd] $cmt");
			$_SESSION['succ'] = ucwords($_POST[cnd]).' Successfully';
			echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}
}

################# E-Commerce ##############################


if($act=='add-brand')
{
	$load->model('site_function');
	@$img1= $load->site_function->images_upload('imgess', 'image', $baseurl);
	
		$data = array('slug' => $load->site_function->slugify($_POST['title']),
					'name' => $_POST['title'],
						'img' => $img1,
							'date' => date('Y-m-d')
							);
		$db->insert( BRAND , $data );							
		$_SESSION['succ'] = "Save successfully!";
		echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		die;
}

if($act=='edit-brand')
{
	$load->model('site_function');
	@$img1= $load->site_function->images_upload('imgess', 'image', $baseurl);
	if($img1){$img=$img1;}else{$img=$_POST['img'];}
	
	$data = array('slug' => $load->site_function->slugify($_POST['title']),
					'name' => $_POST['title'],
						'img' => $img1,
							'date' => date('Y-m-d')
							);

	$db->update(BRAND, $data, " id = '".$_POST['id']."' ");						
	$_SESSION['succ'] = "Update successfully!";
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}



if($act=='add-cat')
{
	$load->model('site_function');
	@$img1= $load->site_function->images_upload('imgess', 'image', $baseurl);
	
	$data = array('slug' => $load->site_function->slugify($_POST['title']),
					'category_parent' => $_POST['page_parent'],
						'category_title' => $_POST['title'],
							'img' => $img1,
								'parameter' => @implode(',',$_POST['par']),
									'category_date' => date('Y-m-d') 
									);
																				

	$db->insert( CAT , $data );
	
	$_SESSION['message'] = "Category saved successfully!";
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}

if($act=='edit-cat')
{
	$load->model('site_function');
	@$img1= $load->site_function->images_upload('imgess', 'image', $baseurl);
	if($img1) $img=$img1; else $img=$_POST['img'];
	
	$data = array('slug' => $load->site_function->slugify($_POST['title']) ,
					'category_parent' => $_POST['page_parent'] ,
						'category_title' => $_POST['title'],
							'img' => $img1,
								'parameter' => @implode(',',$_POST['par']),
									'category_moddate' => date('Y-m-d') 
									);
								
	$db->update(CAT, $data, " id = '".$_POST['recId']."' ");
	$_SESSION['msg'] = 'Update successfully!.';
	echo "<script>window.location = '$_SERVER[HTTP_REFERER]'</script>";
	die;

}




if($_REQUEST['act']=='delProductImage')
{
	$id=$_REQUEST['id'];
	$tbl=$_REQUEST['tbl'];
	$img=$_REQUEST['img'];

		$d= $db->getQuery($db->runQuery("select product_id,img,mcolor from $tbl where product_id='$id'")); 
		@$ar=explode(',',$d['img']);
		@$clr=explode(',',$d['mcolor']);
		@$key=array_search($img,$ar);
		@unlink($baseurl.image_folder.'/'.$ar[$key]);
		unset($ar[$key]);
		unset($clr[$key]);
		$db->runQuery("update $tbl set img='".implode(',',$ar)."', mcolor='".implode(',',$clr)."' where product_id='$id'");
		die;
}


if($_REQUEST['act']=='featured')
{
	$fet= $db->getQuery($db->runQuery("select id,featured from ".PRODUCT." where id='$_REQUEST[id]' "));
	@$featured=explode(',',$fet['featured']);
	if(in_array($_REQUEST['name'],$featured))
	{
		$key= array_search($_REQUEST['name'], $featured);  
		unset($featured[$key]);
		@$lik=implode(',',$featured);
		echo No;
	}
	else
	{
		@$lik=implode(',',$featured).','.$_REQUEST['name'];
		echo Yes;
	}
		$db->runQuery("update ".PRODUCT." set featured='$lik' where id='$_REQUEST[id]' ");
		die;
}


################# E-Commerce ##############################


if($act == 'parameter-add') {
		$load->model('site_function');
		$db->insert( PAR, array('name' => $_POST['name']) );
		$getid= $db->lastInsertID();
		
		$slug = $load->site_function->slugify($_POST['name']).$getid;
		$db->runQuery("ALTER TABLE ".PRODUCT." ADD `".$slug."` INT(5) NOT NULL AFTER `minQty`");
		$db->update( PAR, array(slug => $slug ) , "id = '".$getid."' " );
	
		$_SESSION['succ'] = 'Inserted Successfully';
		echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}



if($act == 'parameter-edit') {
			
		$data = array('name' => $_POST['name'], status => $_POST['status'] );		
		$db->update( PAR, $data , "id = '".$_POST['id']."' " );
		$_SESSION['succ'] = 'Update Successfully';
		echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}
		

if($act == 'masters-add') {
		
		$data = array('name' => $_POST['name'] ,		
							'type' => $_POST['type'] );
		
			$db->insert( MASTERS, $data );
			$id = $db->lastInsertID();
			$db->update( MASTERS, array('uniqueId' => str_pad($id, 4, '0', STR_PAD_LEFT) ) , "id = '".$id."' " );
			$_SESSION['succ'] = 'Inserted Successfully';
			echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}



if($act == 'masters-edit') {
			
		$data = array('name' => $_POST['name'] ,		
							'status' => $_POST['status'] );
		
			$db->update( MASTERS, $data , "id = '".$_POST['id']."' " );
			$_SESSION['succ'] = 'Update Successfully';
			echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}


if($act == 'manufacturer-add') {
		
		$data = array('name' => $_POST['name']);
		
			$db->insert( MANU, $data );
			$id = $db->lastInsertID();
			$db->update( MASTERS, array('uniqueId' => str_pad($id, 4, '0', STR_PAD_LEFT) ) , "id = '".$id."' " );
			$_SESSION['succ'] = 'Inserted Successfully';
			echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}



if($act == 'manufacturer-edit') {
			
		$data = array('name' => $_POST['name'] ,		
							'status' => $_POST['status'] );
		
			$db->update( MANU, $data , "id = '".$_POST['id']."' " );
			$_SESSION['succ'] = 'Update Successfully';
			echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
		}




if($act == 'product-add') {

	$load->model('site_function');
	@$datasheet= $load->site_function->images_upload('datasheet', 'all', $baseurl);
	@$productPhoto= $load->site_function->images_upload('productPhoto', 'image', $baseurl);
	@$drawing= $load->site_function->images_upload('drawing', 'image', $baseurl);
	
	
	$cat= $db->getQuery($db->runQuery("select parameter from ".CAT." where id='".$_POST['category']."'"));
	$par = explode(',',$cat['parameter']);
	$ar1 = array();
	for($i=0; $i< count($par); $i++) {
		if($_POST[$par[$i]])
			$ar1 = array_merge($ar1, array( $par[$i] => $_POST[$par[$i]] ));
	}	
	
	$data = array('catId' => $_POST['category'] ,
					'partNum' => $_POST['partNum'] ,
						'manufacturer' => $_POST['manufacturer'],
							'mPartNum' => $_POST['mPartNum'],
								'description' => $_POST['description'], 
									'lead' => $_POST['lead'], 
									leadStatus => $_POST['leadStatus'], 
										datasheet => $datasheet,
											productPhoto => $productPhoto,
												drawing => $drawing,
													minQty => $_POST['minQty'],
														quantity => $_POST['quantity'],
															price => @implode(',', $_POST['price']),
																operating => $_POST['operating'],
																	other => $_POST['other'],
																		slug => $load->site_function->slugify($_POST['mPartNum']) 
													);
																				
	$db->insert( PRODUCT, array_merge($data,$ar1) );
	$_SESSION['succ'] = 'Insert successfully!.</div>';
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
}


if($act == 'product-edit') {

	$load->model('site_function');
	
	@$datasheet= $load->site_function->images_upload('datasheet', 'all', $baseurl);
	@$productPhoto = $load->site_function->images_upload('productPhoto', 'image', $baseurl);
	@$drawing= $load->site_function->images_upload('drawing', 'image', $baseurl);
	
	if(!$datasheet) $datasheet = $_POST['datasheet1'];
	if(!$productPhoto) $productPhoto = $_POST['productPhoto1'];
	if(!$drawing) $drawing = $_POST['drawing1'];
	
	
	$cat= $db->getQuery($db->runQuery("select parameter from ".CAT." where id='".$_POST['category']."'"));
	$par = explode(',',$cat['parameter']);
	$ar1 = array();
	for($i=0; $i< count($par); $i++) {
		if($_POST[$par[$i]])
			$ar1 = array_merge($ar1, array( $par[$i] => $_POST[$par[$i]] ));
	}	
	
	
	$data = array(
					'partNum' => $_POST['partNum'] ,
						'manufacturer' => $_POST['manufacturer'],
							'mPartNum' => $_POST['mPartNum'],
								'description' => $_POST['description'],
									'lead' => $_POST['lead'],  
									leadStatus => $_POST['leadStatus'], 
										datasheet => $datasheet,
											productPhoto => $productPhoto,
												drawing => $drawing,
													minQty => $_POST['minQty'],
														quantity => $_POST['quantity'],
															price => @implode(',', $_POST['price']),
																operating => $_POST['operating'],
																	other => $_POST['other'],
																		status => $_POST['status'],
																		slug => $load->site_function->slugify($_POST['mPartNum']) 
													);
																				
	$res =  array_merge($data,$ar1);
	//echo '<pre>'; print_r($res);die;
	
	$db->update( PRODUCT , $res , "id = '".$_POST['id']."' "  );
	$_SESSION['succ'] = 'Update successfully!.</div>';
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
}


if($act=='add-coupons')
{
	$date1 = date('Y-m-d');
	$date= explode('-',$_POST['valid']);krsort($date);$val=implode("-",$date);
	$name = $_POST['name'];
	$data = array('date' => $date1 ,
					'type' => $_POST['type'] ,
						'name' => $name,
							'valid' => $val,
								'discount' => $_POST['discount']  );
																				
	
	if($_POST['type']=='multiple')
		$db->insert( COUP , $data );
		
	else if($_POST['type']=='single') {
		for ($i=0; $i< $_POST['no']; $i++) {
			$data['name'] = title.'-'.substr(number_format(time() * rand(),0,'',''),0,8);
				$db->insert( COUP , $data );
		}
	}
	
	$_SESSION['succ'] = "Save successfully!";
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}


if($act=='edit-coupons') {
	
	$date= explode('-',$_POST['valid']);krsort($date);$val=implode("-",$date);
		$data = array('name' => $_POST['name'],
							'valid' => $val,
								'discount' => $_POST['discount']  );
	
	$db->update( COUP , $data, " id='$_REQUEST[id]' " );
	$_SESSION['succ'] = "Update successfully!";
	echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
	die;
}


if($act=='add-subpage')
{
	$pname= mysql_real_escape_string($_POST['page_name']);
	$slug =  slugify($pname);
	mysql_query("insert into site_category 
				(
				parent_id,
				type,
				page_name,
				options,
				goto,
				slug
				)
				values(
				'$_POST[id]',
				'$_POST[type]',
				'$pname',
				'$_POST[options1]',
				'$_POST[goto]',
				'$slug')
				");
	$getid= mysql_insert_id();
	echo "<script>window.location='add-pages.php?tbl=site_category&forms=$getid'</script>";
	die;	
}







## ADD USER FROM ##

if($act == 'builder-add' ) 
  { $nm = substr(number_format(time() * rand(),0,'',''),0,4);
 
   
   $us = array('formId' => $nm ,'name' => $_POST['name'], 'userId' =>$_POST['id']);
   //print_r($us);die;
   $db->insert( BUILDER, $us );
   $getid = $db->lastInsertID();
   $_SESSION['succ'] = 'Form Add Successfully';
   echo "<script>window.location='builder-add.php?fid=".$getid."'</script>";
   die;
  }
  
 if($act == 'builder-form' )
 { 
  $nm = substr(number_format(time() * rand(),0,'',''),0,4);
 //echo '<pre>'; print_r($_POST);die;
 $typ = $_POST['typ'];
 $lbl = $_POST['lbl'];
 $req = $_POST['req'];
 $naam = $_POST['naam'];
  
 foreach($lbl as $key => $value) {
  if(@$value) {
   
   if($typ[$key] == 'checkbox' || $typ[$key] == 'radio' || $typ[$key] == 'list'){
    @$sub = implode(',',$_POST[$naam[$key]]);
   } 
   
   $wo = array('formId' => $nm,
       //'userId' => 
       'name' => $_POST['name'],
       'userId' =>$_POST['userid'],
        'report' => $_POST['report'],
         'seq' => @$key,
          'type' => @$typ[$key],
           'require' => $req[$key],
            'label' => $value,
             'subLabel' =>  @$sub );
             
   $db->insert( BUILDER, $wo );
  }
 }
  $_SESSION['succ'] = 'Update Successfully';
   $loc="viewform.php?formid=".$_POST[userid];
  echo "<script>window.location='".$loc."'</script>";
  

 }
 
 if($act == 'builder-edit' ) { $nm = $_POST['id'];
 //echo '<pre>'; print_r($_POST);die;
 $typ = $_POST['typ'];
 $lbl = $_POST['lbl'];
 $req = $_POST['req'];
 $naam = $_POST['naam'];
 
 $db->runQuery("delete from ".BUILDER." where formId = '$nm' ");
 
 foreach($lbl as $key => $value) {
  if(@$value) {
   
   if($typ[$key] == 'checkbox' || $typ[$key] == 'radio' || $typ[$key] == 'list'){
    @$sub = implode(',',$_POST[$naam[$key]]);
   } 
   
   $wo = array('formId' => $nm,
       'userId' => $_POST['userid'],
       'name' => $_POST['name'],
        'report' => $_POST['report'],
         'seq' => @$key,
          'type' => @$typ[$key],
           'require' => $req[$key],
            'label' => $value,
             'subLabel' =>  @$sub);
           
   $db->insert( BUILDER, $wo );
  }
 }
  $_SESSION['succ'] = 'Update Successfully';
  echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
  die;
}


##  Form Input Answer ##

if($act == 'updateform-answer' ) 
{
 //print_r($_REQUEST);die;
 $load->model('site_function');
 if($_REQUEST['userId']!="")
 {
 @$sql = $db->runQuery("SELECT * FROM ".BUILDER."  where formId='".$_REQUEST['formId']."' ");
 
 
  while(@$fields = $db->getQuery($sql))
  {
   if($fields['type'] == 'checkbox')
   {
   
   $val=str_replace(' ', '', $fields['label'].'_'.$fields['id']);
   $db->update(BUILDER, array ('field_answer' => @implode(',', 
   $_POST[$val])), " id = '".$fields['id']."' ");
   }
   elseif($fields['type'] == 'image')
   {
   $val=str_replace(' ', '', $fields['label'].'_'.$fields['id']);
   $img_nm= $val;
   //echo $img_nm;
    //echo $_POST['pre_'.$img_nm][0];die;
     if( $file = $load->site_function->images_upload($img_nm, 'all' , $baseurl) )
     {
      $image = $file; 
     //@unlink($_POST['unlink']);    
     
     } 
     else
     {
      $image = $_POST['pre_'.$img_nm][0];
     }
     $db->update(BUILDER, array ('field_answer' => $image) ," id = '".$fields['id']."' ");
     
   
   }
  else
   {
   // $_POST[$fields['label'].'_'.$fields['id']];
   $val=str_replace(' ', '', $fields['label'].'_'.$fields['id']);
   $db->update(BUILDER, array ('field_answer' => $_POST[$val]), " id = '".$fields['id']."' ");
   }
  }
 
  $_SESSION['succ'] = 'Update Successfully';
  echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
  die;
 }
 }
  ###  supplier model #########
if($act == 'supplier-add') {
  
  $data = array('supplier_name' => $_POST['name'] , 'date_of_reg' => date('Y-m-d'));
  
   $db->insert(SUPPLIER, $data );
   $id = $db->lastInsertID();
   $_SESSION['succ'] = 'Inserted Successfully';
   echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
  }
  
if($act == 'supplier-edit') {
   
  $data = array('supplier_name' => $_POST['name'] );
  
   $db->update( SUPPLIER, $data , "supp_id = '".$_POST['id']."' " );
   $_SESSION['succ'] = 'Update Successfully';
   echo "<script>window.location='$_SERVER[HTTP_REFERER]'</script>";
  }




?>