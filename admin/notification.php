<? 
include'header.php';
$qry=$db->runQuery("select * from ".SETTINGS." "); 
while($view= $db->getQuery($qry))
{
	$setting=$view['setting'];
	$$setting=$view['value'];
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
<script>
function chk(input) {
	if(input == 'php' ) {
		document.getElementById('hemail').style.display='none';
	}
	if(input == 'smtp' ) {
		document.getElementById('hemail').style.display='';
	}
}
</script>
    <div class="centercontent">
    
         <div class="pageheader">
            <h1 class="pagetitle">Notification</h1>
        </div>
        
        
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div class="widgetcontent">
            
<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>
                <form class="stdform stdform2" action="adm-action.php" method="post" enctype="multipart/form-data">

					
<div class="two_third dashboard_left">   	
  <div id="general" class="subcontent">	
        
        <h3> Admin</h3>
			<p></p>
        <p>
            <label>Admin Announcement</label>
             <span class="field">
             <textarea name="admin_announcement" cols="80" rows="6" class="largeinput"><?=$admin_announcement;?></textarea>
             </span>
        </p>
        
        <p>
            <label>Admin Notification</label>
             <span class="field">
             <textarea name="admin_notification" cols="80" rows="5" class="largeinput"><?=$admin_notification;?></textarea>
             </span>
        </p>
        
        <br /><h3> Associate</h3>
			<p></p>
        
        <p>
            <label>Associate Announcement</label>
             <span class="field">
             <textarea name="associate_announcement" cols="80" rows="6" class="largeinput"><?=$associate_announcement;?></textarea>
             </span>
        </p>
        
         <p>
            <label>Associate Notification</label>
             <span class="field">
             <textarea name="associate_notification" cols="80" rows="6" class="largeinput"><?=$associate_notification;?></textarea>
             </span>
        </p>
             
                        
    </div>
</div>



<div class="two_third dashboard_left">   	
<p>
<span class="field">
<input type="hidden" name="admin" value="setting" />
<input id="submit" type="submit" style="display:none;" />
<button class="submit radius2" id="pry" onClick="document.getElementById('submit').click();return false;" 
style="width:200px;"> SAVE  </button>
</span>
</p>

<br />
<br />
<br />
</div>
		</form>
            </div>
        
        </div>
        
        <br clear="all" />
        
	</div>
    
    
</div>
</body>
</html>
