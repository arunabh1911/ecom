<? include'header.php';
if($_REQUEST[id]){
	$view = $db->getQuery($db->runQuery("select * from ".BRAND." where id='$_REQUEST[id]'"));
	}

?>
<script>
function chk()
{
	if(document.getElementById('title').value=='')
	{
		alert('!! Enter Brand Name !!');
		document.getElementById('title').focus();
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
              Brand</h1>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div class="widgetcontent">
    <form class="stdform" action="adm-action.php" method="post" onsubmit="return chk()" enctype="multipart/form-data" >
    
    <? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>


<p>
<strong>Brand Name</strong><br />
<input type="text" name="title" id="title" value="<?=$view['name']?>" class="smallinput" />
</p>

<p>
<strong>Brand Image</strong><br />
<? if($view['img']){?>
<img src="<?=$locations['img_url']?>/<?=$view['img']?>" /><br  />
<? }?>
<input type="file"  class="mediuminput" name="imgess[]" />
<input type="hidden" name="img" value="<?=$view['img']?>" />
</p>
                                    
                                    <p>
                                       
                                        <? if($_REQUEST['id']==''){?>
                                         <button class="submit radius2">Add Brand</button>
                                        <input type="hidden" name="admin" value="add-brand" />
                                        <? }else{?>
                                         <button class="submit radius2">Update Brand</button>
                                         <input type="hidden" name="admin" value="edit-brand" />
                                        <input name="id" type="hidden" value="<?=$view['id']?>" />
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
