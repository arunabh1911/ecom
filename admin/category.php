<? 
include'header.php';
/*$load = new loader();
$load->model('site_function');*/
if($_REQUEST['id']){
	$view = $db->getQuery($db->runQuery("select * from ".CAT." where id='$_REQUEST[id]' order by id DESC"));
	@$par=explode(',',$view['parameter']);
}


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
?>
<script>
function chk()
{
	if(document.getElementById('title').value=='')
	{
		alert('!! Enter Category Name !!');
		document.getElementById('title').focus();
		return false;
	}
	if(document.getElementById('parent').value==document.getElementById('id').value)
	{
		alert('!! You Cant Select Same Category !!');
		document.getElementById('parent').focus();
		return false;
	}
}
</script>

<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/charCount.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>
      
    <div class="centercontent">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">
              <? if($_REQUEST['id']==''){?>Add
			  <? } if($_REQUEST['id']!=''){?> Edit <? }?>
              Category</h1>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div class="widgetcontent">
<form class="stdform" action="adm-action.php" method="post" onsubmit="return chk()" enctype="multipart/form-data"><p>
<strong>Parent</strong><br />
    <select name="page_parent" id="parent">
    <option value="0">No Parent</option>
    <?=RecursiveCat('0',$_REQUEST['id'],$view['category_parent']);?>
    </select>
</p>
                                    
                                    
<p>
<strong>Category Title</strong><br />
<input type="text" name="title" id="title" value="<?=$view['category_title']?>" class="smallinput" />
</p>


<p>
<strong>Image</strong><br />
<? if($view['img']){?>
<img src="<?=img_path.$view['img']?>" width="150px" /><br  />
<? }?>
<input type="file"  class="mediuminput" name="imgess[]" />
<input type="hidden" name="img" value="<?=$view['img']?>" />
</p>
      


<p>
<strong>Choose mutiple parameters</strong><br />
    <select data-placeholder="Choose mutiple parameters..." class="chzn-select" multiple="multiple" style="width:350px;" tabindex="4" 
	name="par[]">
<?
$qry=$db->runQuery("select * from ".PAR." ");
if(mysqli_num_rows($qry) > 0){ 
while($data= $db->getQuery($qry)){?>
	<option <? if(@in_array($data['slug'],$par)) echo 'selected';?> value="<?=$data['slug'];?>"> <?=$data['name'];?></option>
<? }}?>
</select>
</p>

                                    
                                    <p>
                                        
                                        <? if($_REQUEST['id']==''){?>
                                        <button class="submit radius2">Add Category</button>
                                        <input type="hidden" name="admin" value="add-cat" />
                                        <? }else{?>
                                        <button class="submit radius2">Update Category</button>
                                        <input type="hidden" name="admin" value="edit-cat" />
                                        <input name="recId" id="id" type="hidden" value="<?=$view['id']?>" />
                                        <? }?>
                                    </p>
                                </form>
                            </div>
        
        </div><!--contentwrapper-->
        
        <br clear="all" />
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

<!-- Mirrored from themepixels.com/themes/demo/webpage/amanda/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 14 Feb 2013 07:04:53 GMT -->
</html>
