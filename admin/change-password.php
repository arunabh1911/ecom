<? include'header.php';?>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/charCount.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>s
<script>
function val()
{
	if(document.getElementById('opass').value=='')
	{
		alert('!! Enter Old Password !!');
		document.getElementById('opass').focus();
		return false;
	}
	else if(document.getElementById('npass').value=='')
	{
		alert('!! Enter New Password !!');
		document.getElementById('npass').focus();		
		return false;
	
	}
	else if(document.getElementById('npass').value!=document.getElementById('cpass').value)
	{
		alert('!! Password Not Match !!');
		document.getElementById('npass').focus();		
		return false;
	
	}
}
</script>       
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Change Password</h1>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	
        	<div id="basicform" class="subcontent">

<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }
if($_SESSION['error']){?>		
<div class="notibar msgerror">
<a class="close"></a>
<p><?=$_SESSION['error']; $_SESSION['error']='';?></p>
</div>
<? }?>
					


 <form class="stdform" action="adm-action.php" enctype="multipart/form-data" method="post" onsubmit="return val();">
    
    <p>
        <label>Old Password</label>
        <span class="field"><input type="password" name="opass" id="opass" class="smallinput" /></span>
    </p>
    <p>
        <label>New Password</label>
        <span class="field"><input type="password" name="npass" id="npass" class="smallinput" /></span> 
    </p>
    <p>
        <label>Confirm New Password</label>
        <span class="field"><input type="password" name="cpass" id="cpass" class="smallinput" /></span> 
    </p>
    
    <p class="stdformbutton">
        <button class="submit radius2" type="submit">Change Password</button>
        <input type="hidden" value="changepassword" name="admin" />
        <input type="reset" class="reset radius2" value="Reset Button" />
    </p>
    
    
</form>
                    
                    <br />

            </div>
        
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

<!-- Mirrored from themepixels.com/themes/demo/webpage/amanda/forms.html by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 14 Feb 2013 07:04:37 GMT -->
</html>
