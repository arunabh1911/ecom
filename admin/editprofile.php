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
<script type="text/javascript" src="js/custom/forms.js"></script>
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Edit Profile</h1>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        	
        	<div id="basicform" class="subcontent">
					 <form class="stdform" action="adm-action.php" enctype="multipart/form-data" method="post">
					
<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>
                    	 <p>
                        	<label></label>
                            <span class="field"><h4><?=ucwords($admin['companyName'])?></h4></span>
                        </p>
                        
                         <p>
                        	<label></label>
                            <span class="field"><?=ucwords($admin['date'])?></span>
                        </p>
                        
                        
                        <p>
                        	<label><strong>Name</strong></label>
                            <span class="field"><input type="text" name="name" class="smallinput" value="<?=$admin['name']?>"  /></span>
                        </p>
                       
                        
                        <p>
                        	<label><strong>Image</strong></label>
                            <span class="field">
							<img src="<?=img_path.$admin['image1']?>" width="95" alt="" /><br />
                            	<input type="file" name="filename[]" />
<input type="hidden" name="unlink" value="<?=img_path.$admin['image1']?>" />
                            </span>
                        </p>
                        
                         <p>
                        	<label><strong>Account</strong></label>
                            <span class="field"><h4><?=ucwords($admin['status'])?></h4></span>
                        </p>
                        
                        
                        <p class="stdformbutton">
                        	<button class="submit radius2" name="edit_profile" type="submit">Edit Profile</button>
                            <input type="hidden" value="editprofile" name="admin" />
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
