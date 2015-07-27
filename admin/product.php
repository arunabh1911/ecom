<? 
include('header.php'); 
$load = new loader();
$load->model('site_function');
$seo='';
function RecursiveCat($pid,$sel)
{
$db = new myDBC();
static $level=0;
static $strid="";
static $strname="";
	
	$sql= $db->runQuery("select * from ".CAT." where category_parent='$pid' ");
	while($row= $db->getQuery($sql))
	{
	
	
		$id=$row['id'];
		$level--;
		$pad="";
	
		for($p=1;$p<($level*-1);$p++) $pad.="&nbsp;&nbsp;&nbsp;> ";
		$ys=''; if($sel==$row['id']){ $ys='selected';}
		$strname.='<option '.$ys.' value="'.$row['id'].'">'.$pad.ucwords(strtolower($row['category_title'])).'</option>';
		$rid=RecursiveCat($id,$sel);
		$strid[]=$row['id'];
		$level++;
	}
return $strname;
}

function category_url($id,$url="",$rpt='')
{
	$db = new myDBC();
	if($id!='' && $id!=$rpt)
	{
		$data= $db->getQuery($db->runQuery("select id,category_parent,slug from ".CAT." where id='$id'"));
		$url[]=$data['slug'];
		return category_url($data['category_parent'],$url,$id);
	}
	else
		return @trim(implode(" / ", array_reverse($url, true)), ' / ');
}


if($_REQUEST['id']!='')
{
	$data= $db->getQuery($db->runQuery("select * from ".PRODUCT." where id='$_REQUEST[id]' "));
	$_REQUEST['cid'] = $data['catId'];
	$_POST['manufacturer'] = $data['manufacturer'];
	$idd = $data['id'];
	$status = $data['status'];
}

if($_REQUEST['cid']){
	$cat = $db->getQuery($db->runQuery("select * from ".CAT." where id='$_REQUEST[cid]' order by id DESC"));
	$par=explode(",",$cat['parameter']);
	
	for($i=0; $i< count($par); $i++)
		$_POST[$par[$i]] = $data[$par[$i]];
}
?>
<script>
function val()
{
	if(document.getElementById('category').value=='')
	{
		alert('!! Select Catrgory !!');
		document.getElementById('category').focus();
		return false;
	}
	if(document.getElementById('partNum').value=='')
	{
		alert('!! Enter  Part Number !!');
		document.getElementById('partNum').focus();
		return false;
	}
	if(document.getElementById('manufacturer').value=='')
	{
		alert('!! Select Manufacturer !!');
		document.getElementById('manufacturer').focus();
		return false;
	}
	if(document.getElementById('mPartNum').value=='')
	{
		alert('!! Enter Manufacturer Part Number !!');
		document.getElementById('mPartNum').focus();
		return false;
	}
	if(document.getElementById('description').value=='')
	{
		alert('!! Enter Description !!');
		document.getElementById('description').focus();
		return false;
	}
	if(document.getElementById('leadStatus').value=='')
	{
		alert('!! Enter Lead Free Status / RoHS Status !!');
		document.getElementById('leadStatus').focus();
		return false;
	}
	if(document.getElementById('datasheet').value=='')
	{
		alert('!! Select Datasheet !!');
		document.getElementById('datasheet').focus();
		return false;
	}
	if(document.getElementById('productPhoto').value=='')
	{
		alert('!! Select Product Photo !!');
		document.getElementById('productPhoto').focus();
		return false;
	}
	if(document.getElementById('drawing').value=='')
	{
		alert('!! Select Catalog  Drawing !!');
		document.getElementById('drawing').focus();
		return false;
	}
	if(document.getElementById('minQty').value=='')
	{
		alert('!! Enter Standard Package !!');
		document.getElementById('minQty').focus();
		return false;
	}
}
</script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script> $(function(){ $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }); });</script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>


    <div class="centercontent">

        <div class="pageheader notab">
            <h1 class="pagetitle"><? if($_REQUEST['id']==''){?>Add
			  <? } if($_REQUEST['id']!=''){?> Edit <? }?> Product</h1>

<? if(!$_REQUEST['id']){?>
			<form  method="post" >
&nbsp;&nbsp;&nbsp;&nbsp;
<button class="submit radius2" onclick="window.location='import.php'; return false;">Import Product </button>
</form>
<? }?>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
		
		<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>


 <form class="stdform stdform2" action="adm-action.php" method="post" onsubmit="return val()" enctype="multipart/form-data">
<div class="two_third dashboard_left"> 
					
					
<p>
<label>Category</label>
<span class="field">
  <? if(!$_REQUEST[id]){?>
    <select name="category" id="category" onchange="window.location='?cid='+this.options[selectedIndex].value">
    <option value="">Select Category</option>
    <?=RecursiveCat('0',$_REQUEST['cid']);?>
    </select>
    <? } else{  echo ucwords(category_url($data['catId'])); ?>
	<input name="category" type="hidden" value="<?=$_REQUEST['cid']?>" />
	<? }?>
</span>
</p>

<p>
<label>Part Number</label>
<span class="field">
<input type="text" name="partNum" id="partNum" value="<?=@$data['partNum']?>" class="mediuminput" />
</span>
</p>

<p>
<label>Manufacturer</label>
<span class="field">
<? $load->site_function->dropDown(MANU, 'manufacturer', "status = 'active'  order by name" ); ?>
</span>
</p>

<p>
<label>Manufacturer Part Number</label>
<span class="field">
<input type="text" name="mPartNum" id="mPartNum" value="<?=@ucwords($data['mPartNum'])?>" class="mediuminput" />
</span>
</p>

<p>
<label>Lead Date</label>
<span class="field">
<input type="text" class="datepicker" name="lead" value="<?=$data['lead']?>" readonly="readonly" />
</span>
</p>


<p>
<label>Description</label>
<span class="field">
<input type="text" name="description" id="description" value="<?=@ucwords($data['description'])?>" class="mediuminput" />
</span>
</p>                        

<p>
<label>Lead Free Status / RoHS Status</label>
<span class="field">
<input type="text" name="leadStatus" id="leadStatus" value="<?=@ucwords($data['leadStatus'])?>" class="mediuminput" />
</span>
</p>

<p>
<label>Datasheets</label>
<span class="field">
<input name="datasheet[]" id="datasheet" type="file"  class="mediuminput"  />
<? if($data['datasheet']){?>
<a href="<?=$data['datasheet']?>" target="_blank">download</a>
<input name="datasheet1" type="hidden" value="<?=$data['datasheet']?>" />
<? }?>
</span>
</p>

<p>
<label>Product Photos</label>
<span class="field">
<input name="productPhoto[]" id="productPhoto" type="file"  class="mediuminput"  />
<? if($data['productPhoto']){?>
<img src="<?=img_path.$data['productPhoto']?>" width="100px" />
<input name="productPhoto1" type="hidden" value="<?=$data['productPhoto']?>" />
<? }?>
</span>
</p>

<p>
<label>Catalog Drawings</label>
<span class="field">
<input name="drawing[]" id="drawing" type="file"  class="mediuminput"  />
<? if($data['drawing']){?>
<img src="<?=img_path.$data['drawing']?>" width="100px" />
<input name="drawing1" type="hidden" value="<?=$data['drawing']?>" />
<? }?>
</span>
</p>

<p>
<label>Quantity</label>
<span class="field">
<input type="text" name="quantity" id="quantity" value="<?=@ucwords($data['quantity'])?>" class="mediuminput" />
</span>
</p>

<p>
<label>Price</label>
<? $price = explode(',',$data['price']); ?>
<table width="" border="0" >
  <tr>
    <td style="width:150px">1</td>
    <td><input type="text" name="price[]" id="minQty" value="<?=@$price[0]?>" class="smallinput" /> </td>
  </tr>
  <tr>
    <td>10</td>
    <td><input type="text" name="price[]" id="minQty" value="<?=@$price[1]?>" class="smallinput" /> </td>
  </tr>
  <tr>
    <td>100</td>
    <td><input type="text" name="price[]" id="minQty" value="<?=@$price[2]?>" class="smallinput" /> </td>
  </tr>
  <tr>
    <td>500</td>
    <td><input type="text" name="price[]" id="minQty" value="<?=@$price[3]?>" class="smallinput" /> </td>
  </tr>
  <tr>
    <td>1000</td>
    <td><input type="text" name="price[]" id="minQty" value="<?=@$price[4]?>" class="smallinput" /> </td>
  </tr>
  <tr>
    <td>2500</td>
    <td><input type="text" name="price[]" id="minQty" value="<?=@$price[5]?>" class="smallinput" /> </td>
  </tr>
</table>

</p>


<p>
<label>Standard Package</label>
<span class="field">
<input type="text" name="minQty" id="minQty" value="<?=@ucwords($data['minQty'])?>" class="mediuminput" />
</span>
</p>

<? 

$qry=$db->runQuery("select * from ".PAR." ");
if(mysqli_num_rows($qry) > 0){ 
while($data= $db->getQuery($qry)){

if(@in_array($data['slug'], $par)){ ?>
<p>
<label><?=$data['name']?></label>
<span class="field">
<? $load->site_function->dropDown(MASTERS, $data['slug'], "type = '".$data['slug']."' AND status = 'active'  order by name" ); ?>
</span>
</p>
<? }}}?>

<p>
<label>Operating Temperature</label>
<span class="field">
<input type="text" name="operating" id="operating" value="<?=@ucwords($data['operating'])?>" class="mediuminput" />
</span>
</p>  

<p>
<label>Other Names</label>
<span class="field">
<input type="text" name="other" id="other" value="<?=@ucwords($data['other'])?>" class="mediuminput" />
</span>
</p> 

<p>
<label>Status</label>
<span class="field">
<select name="status">
  <option <? if($status == 'active')echo 'selected';?> value="active">Active</option>
  <option <? if($status == 'inactive')echo 'selected';?> value="inactive">Inactive</option>
</select>
</span>
</p> 

   <p class="stdformbutton" align="center">
				 		
						<? if(@$_REQUEST['id']==''){?>
                        <button class="submit radius2" style="width:250px">&nbsp;&nbsp; Save &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="product-add" />
                        <? }else{?>
                         <button class="submit radius2" style="width:250px">&nbsp;&nbsp;Update &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="product-edit" />
                        <input name="id" type="hidden" value="<?=$idd?>" />
                        <? }?>
	</p>              
					<br /><br /><br />
					
                </div>            
            </form>        
        </div>
	</div>   
</div>
</body>
</html>
