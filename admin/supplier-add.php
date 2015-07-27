<?php include('header.php');

if(@$_REQUEST['id'])
{
	
	$data = $db->getQuery($db->runQuery("select * from ".SUPPLIER." where supp_id = '".$_REQUEST['id']."' "));
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
              <? if(@$_REQUEST['id']) echo 'Edit'; else echo 'Add'; ?>  Supplier</h1>
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
<input type="text" name="name" id="name" value="<?=@ucwords($data['supplier_name'])?>" class="mediuminput" />
</span>
</p>




                  <p class="stdformbutton">
				 		 <input type="hidden" name="type" value="<?=$_REQUEST['name']?>" />             
						<? if(@$_REQUEST['id']==''){?>
                        <button class="submit radius2">&nbsp;&nbsp; Save &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="supplier-add" />
                        <? }else{?>
                         <button class="submit radius2">&nbsp;&nbsp;Update &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="supplier-edit" />
                        <input name="id" type="hidden" value="<?=$data['supp_id']?>" />
                        <? }?>
					</p>                      

                </div>
            </form>        
        </div>
	</div>   
</div>
</body>
</html>
