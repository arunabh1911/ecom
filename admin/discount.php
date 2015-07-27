<? include'header.php';
if($_REQUEST['id']){
	$view = $db->getQuery($db->runQuery("select * from ".COUP." where id='$_REQUEST[id]' "));
	$date= explode('-',$view['valid']);krsort($date);$val=implode("-",$date);
} ?>

<script>
function chk()
{
	
	if(document.getElementById('valid').value=='')
	{
		alert('!! Date !!');
		document.getElementById('valid').focus();
		return false;
	}
	
	if(document.getElementById('discount').value=='')
	{
		alert('!! Enter Discount !!');
		document.getElementById('discount').focus();
		return false;
	}
}
</script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script> $(function(){ $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }); });</script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
    <div class="centercontent">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">
            <? if($_REQUEST['id']==''){?>Add
			  <? } if($_REQUEST['id']!=''){?> Edit <? }?>
              Promno Code</h1>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div class="widgetcontent">
    <form class="stdform" action="adm-action.php" method="post" onsubmit="return chk()" enctype="multipart/form-data" >
    
    <? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>


<p>
<strong>Type</strong><br />
<select name="type" onchange="$('.yes').toggle()">
<option value="multiple">Multiple Time Promo Code Use </option>
<option value="single">One Time Promo Code Use </option>
</select>
</p>

<p class="yes" style="display:none;">
<strong>No Of Promo Code</strong><br />
<input type="text" name="no" id="title" maxlength="2" value="<?=$view['name']?>" class="smallinput" style="width:100px;" />
</p>


<p class="yes">
<strong>Name Promo Code </strong><br />
<input type="text" name="name" id="title" value="<?=$view['name']?>" class="smallinput" />
</p>

<p>
<strong>Valid Till</strong><br />
<input type="text" name="valid" id="valid" class="datepicker" value="<?=$val?>" readonly="readonly"/>
</p>

<p>
<strong>Discount</strong><br />
<input type="text" name="discount" id="discount" value="<?=$view['discount']?>" style="width:50px;"/> %
</p>                            
                                    <p>
                                        <? if($_REQUEST['id']==''){?>
                                         <button class="submit radius2">Add Coupons</button>
                                        <input type="hidden" name="admin" value="add-coupons" />
                                        <? }else{?>
                                         <button class="submit radius2">Update Coupons</button>
                                         <input type="hidden" name="admin" value="edit-coupons" />
                                        <input name="id" type="hidden" value="<?=$view['id']?>" />
                                        <? }?>
                                    </p>
                                </form>
                            </div>
        
        </div><!--contentwrapper-->
        
        <br clear="all" />
        
	</div>  
    
</div>
</body>
</html>
