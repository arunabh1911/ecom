<?php include('header.php');

if(@$_REQUEST['id'])
{
	$data = $db->getQuery($db->runQuery("select * from ".MANU." where id = '".$_REQUEST['id']."' "));
}
?>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/charCount.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<script type="text/javascript" src="js/custom/editor.js"></script>

<script>
function val()
{
	if(document.getElementById('name').value=='')
	{
		alert('!! Enter  Name !!');
		document.getElementById('name').focus();
		return false;
	}
}
</script>
      
    <div class="centercontent">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">
              <? if(@$_REQUEST['id']) echo 'Edit'; else echo 'Add'; ?>  Manufacturer</h1>
            <span class="pagedesc"></span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">


<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>

 <form class="stdform stdform2" action="adm-action.php" method="post" onsubmit="return val()">
<div class="two_third dashboard_left">                    	
<p>
<label><?=ucwords($_REQUEST['name']);?> Name</label>
<span class="field">
<input type="text" name="name" id="name" value="<?=@ucwords($data['name'])?>" class="mediuminput" />
</span>
</p>

<? if(@$_REQUEST['id']!=''){?>
<p>
<label><?=ucwords($_REQUEST['name']);?> Name</label>
<span class="field">
<select name="status">
  <option <? if($data['status'] == 'active')echo 'selected';?> value="active">Active</option>
  <option <? if($data['status'] == 'inactive')echo 'selected';?> value="inactive">Inactive</option>
</select>
</span>
</p>
<? }?>


                  <p class="stdformbutton">
				 		 <input type="hidden" name="type" value="<?=$_REQUEST['name']?>" />             
						<? if(@$_REQUEST['id']==''){?>
                        <button class="submit radius2">&nbsp;&nbsp; Save &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="manufacturer-add" />
                        <? }else{?>
                         <button class="submit radius2">&nbsp;&nbsp;Update &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="manufacturer-edit" />
                        <input name="id" type="hidden" value="<?=$data['id']?>" />
                        <? }?>
					</p>                      

                </div>
            </form>        
        </div>
	</div>   
</div>
</body>
</html>
