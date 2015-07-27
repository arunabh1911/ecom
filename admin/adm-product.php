<?
$baseurl = getcwd().'/../';
require $baseurl.'index.php';
$db = new myDBC();

if($_REQUEST['cid']){
	$cat = $db->getQuery($db->runQuery("select * from ".CAT." where id='$_REQUEST[cid]' order by id DESC"));
	$par=explode(",",$cat['parameter']);
	$_SESSION['par']=$par;
}

//for color auto fill
if($_REQUEST[act]==sesion){

$b= "$_SESSION[colrs],$_REQUEST[color]";
$kd=array_unique(array_filter(explode(",",$b))); sort($kd);
$_SESSION[colrs]=implode(",",$kd); ?>
<select name="mcolor[]" style="width:200px;">
  <option value="">Select</option>
  <? for($i=0; $i< count($kd); $i++){?>
  <option value="<?=$kd[$i]?>">
  <?=ucwords($kd[$i])?>
  </option>
  <? }?>
</select>
<? die;}


if($_REQUEST[id]){
$qry=$db->runQuery("select * from ".STOCK." where product_id='$_REQUEST[id]' "); 
$view= $db->getQuery($qry);

$qty=explode(",", $view['stock']); 
$dis=explode(",", $view['discount']); 
$tags=explode(",", $view['size']);
$price=explode(",", $view['price']);
$color=explode(",", $view['colors']);	
$cname=explode(",", $view['cname']);
$mcolor=explode(",", $view['mcolor']);
$img=explode(",", $view['img']);
} 

//parameter
if($_REQUEST[act]=='par'){?>
<div class="contenttitle2 nomargintop">
<h3>Product Parameters &amp; Stock</h3>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:0px;" class="stdtable stdtablecb">
<thead>
<tr>
    <th width="14%">Quantity</th>
 <? if(@in_array('size',$par)){?>   <th width="14%">Size</th><? }?>
    <th width="14%">Price</th>
     <th width="14%">Discount %</th>
   <? if(@in_array('color',$par)){?>   <th width="15%">Color Name</th>
    <th width="">Pick color OR Color image</th> <? }?>
</tr>
</thead>
<tbody>
</table>
<input type="hidden" size="10" maxlength="7" id="rgb3" >

<div id="menu">
<? if($_REQUEST[id]){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="dataTable" style="border:0px;" class="stdtable stdtablecb">
<? for($i=0; $i< count($qty); $i++){?>
<tr>
<td width="14%"><input class="longinput" type="text" name="qty[]" style="width:90%;" value="<?=$qty[$i]?>" /></td>
<? if(@in_array('size',$par)){?>
<td width="14%"><input class="longinput" type="text" name="size[]" style="width:90%;" value="<?=$tags[$i]?>" /></td>
<? }?>
<td width="14%"><input class="longinput" type="text" name="price[]" style="width:90%;" value="<?=$price[$i]?>"/></td>
<td width="14%"><input class="longinput" type="text" name="discount[]" style="width:90%;" value="<?=$dis[$i]?>" /></td>
 <? if(@in_array('color',$par)){?>
<td width="15%"><input class="longinput" type="text" name="cname[]" style="width:90%;" value="<?=$cname[$i]?>" onblur="tempcolor()"/></td>

<td><a href="javascript:void(0)" onclick="showColorPicker(this,document.getElementById('rgb3').value,'rgb3')">Pick Color<input type="hidden" name="color[]" value="<?=$color[$i]?>" />
<span class="nactive" style="background:<?=$color[$i]?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="file" name="cimg[]" />

<a href="adm-action.php?id=<?=$i?>&product=<?=$_REQUEST['id']?>&act=del_stk" onclick="return confirm('Are You Sure Want to Delete');" ><img src="images/del.png" /></a>

<!--<td>
<? if(substr($color[$i], 0, 1)!="#"){?>
<img src="<?=$color[$i]?>" height="20" width="20" alt="" /><? }?></td>-->

</td>

<? }?>
</tr>
<? }?>
</table>
<br />
<? }?>

<!-- table data-->
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="dataTable" style="border:0px;" class="stdtable stdtablecb">
 <tr>

<td width="14%"><input class="longinput" type="text" name="qty[]" style="width:90%;" /></td>
<? if(@in_array('size',$par)){?>
<td width="14%"><input class="longinput" type="text" name="size[]" style="width:90%;" /></td>
<? }?>
<td width="14%"><input class="longinput" type="text" name="price[]" style="width:90%;" /></td>
<td width="14%"><input class="longinput" type="text" name="discount[]" style="width:90%;" /></td>
<? if(@in_array('color',$par)){?>
<td width="15%"><input class="longinput" type="text" name="cname[]" style="width:90%;" onblur="tempcolor()"/></td>
<td width="">
<a href="javascript:void(0)" onclick="showColorPicker(this,document.getElementById('rgb3').value,'rgb3')">Pick Color<input type="hidden" name="color[]" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="file" name="cimg[]" id="cimg" /></td>
<? }?>
</tr>
</table>
<br />
<button class="submit radius2" onClick="addRow('dataTable');return false;" >Add</button>
</div>


<!--duplicate--> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="yest" style="border:0px; display:none;">
    <tr>
    <td><input class="longinput" type="text" name="qty[]" style="width:90%;" /></td>
   <? if(@in_array('size',$par)){?>
    <td><input class="longinput" type="text" name="size[]" style="width:90%;" /></td>
    <? }?>
    <td><input class="longinput" type="text" name="price[]" style="width:90%;" /></td>
    <td><input class="longinput" type="text" name="discount[]" style="width:90%;" /></td>
    <? if(@in_array('color',$par)){?>
     <td><input class="longinput" type="text" name="cname[]" style="width:90%;" onblur="tempcolor()"/></td>
    <td><a href="javascript:void(0)" onclick="showColorPicker(this,document.getElementById('rgb3').value,'rgb3')">Pick Color <input type="hidden" name="color[]" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="file" name="cimg[]" id="cimg" /></td>  
    <? }?> 
</tr>
</table>

  <!--color -imnages-->

  <div style="width:100%; float:left; margin-top:30px;">
                        <div class="contenttitle2 nomargintop">
                            <h3>Product Image  <? if(@in_array('color',$par)){?>for colors<? }?></h3>
                        </div>

<? if($img[0]){?>                       
<div class="gallerywrapper">				
<ul class="imagelist">  
<? for($i=0; $i< count($img); $i++){?>
    <li>
        <img src="<?=img_path.$img[$i]?>" alt="" width="100px;" />
        <span><span style="float:left;"><?=ucwords($mcolor[$i]);?></span> 
        <a href="<?=img_path.$img[$i]?>" class="view"></a> 
        <a id="<?=$_REQUEST[id]?>" img="<?=$img[$i]?>" tbl="<?=STOCK?>" class="delete"></a></span>
    </li>
<? }?>
</ul>
</div>
<? }?>        
                                
                            <table width="100%%" border="0" cellspacing="0" cellpadding="0" class="stdtable">
                                <thead>
                                    <tr>
                                     
                                      <? if(@in_array('color',$par)){?>   <th>Choose Color</th><? }?>
                                        <th> <? if(@in_array('color',$par)){?>Color<? }?> Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                      
                    </div>

<? }?>

<? 

//colors

if($_REQUEST['act']=='clr' || $_REQUEST['act']=='par' ){ 
$idd=$_REQUEST['idd'];
if($_REQUEST['idd']=='') $idd=0;?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="dataTable1" style="border:0px;" class="stdtable">
 <tr>
 <? 
 $par=$_SESSION['par']; if(@in_array('color',$par)){?>                                   
<td width="47%">

<span id="foo9">

<?
$b= "$_SESSION[colrs],$_REQUEST[color]";
$kd=array_unique(array_filter(explode(",",$b))); sort($kd);
$_SESSION[colrs]=implode(",",$kd); ?>
<select name="mcolor[]" style="width:200px;">
<option value="">Select</option>
<? for($i=0; $i< count($kd); $i++){?>
<option value="<?=$kd[$i]?>">
<?=ucwords($kd[$i])?>
</option>
<? }?>
</select>
 </span>
</td>
<? }?>
 <td width="42%"><input type="file" name="work<?=$idd?>[]" multiple="multiple" /></td>
                                </tr>
</table>
<br />
<!--<button class="submit radius2" onClick="addRow1('dataTable1');return false;" >Add</button>-->
<? }


if($_REQUEST['act']=='par' &&  @in_array('color',$par)){?>
<div id="clr" ></div>
<button class="submit radius2" onClick="clr(document.getElementById('clr1').value);return false;" >Add</button>
<? }?>

