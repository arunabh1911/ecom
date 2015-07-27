<?
$baseurl = getcwd().'/../';
require $baseurl.'index.php';
if($_SERVER['HTTP_HOST']=='localhost') {

@mysql_connect('localhost','root','');
@mysql_select_db('ecom');
}
else{
@mysql_connect('localhost','liveorg_live','lss123$#');
@mysql_select_db('liveorg_chip');
}

#### EDIT PART #####
$table = 'wkends_product';
$leave_rows = 0; //excel file row
#### EDIT PART #####

if(isset($_POST['submit2']))
{
	$fld=array_filter($_REQUEST['fld']);
	$ps=$_SESSION['array'];
	$cnt=$ps[0];
	$key=array_keys($fld);
	
	for($i=0; $i< count($ps); $i++)
	{
		for($j=0; $j< count($key); $j++)
		{
			$a=$key[$j];
			$rdb[$i][$j]=$ps[$i][$a];
		}
	}
	
	$fld=implode(",",$fld);
	$py=$_POST['py'];
	for($i=0; $i< count($ps); $i++)
	{
		if(in_array($i,$py))
		{
			$val=implode("','",$rdb[$i]);;
			$val="'$val'";
			mysql_query("insert into $table ($fld) values ($val) ");
		}
	}
		echo '<strong>imported successfully!!</strong>';
}
?>
<script>
function chk()
{
	sid = (document.getElementById('file').value.split("."));
	if(sid[1]!='xls')
	{
		alert('please select xls file');
		return false;
	}
}
</script>
<h2>Import File</h2>
<form action="adm-action.php"  method="post" enctype="multipart/form-data">			  
<strong>Upload Excel Files (.xls only)</strong>
<input type="file" name="fileuploaded" id="file"  />
 <input type="hidden" name="admin" value="import-product1" />
<input type="submit" name="submit1" value="Upload" class="submit" onclick="return chk();" /> 
<input type="submit" value="Back" class="submit" onclick="window.location='<?=site_url?>/admin/product.php'; return false; " /> 
</form>

