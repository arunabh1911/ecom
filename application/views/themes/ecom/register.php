<!-------- main-start --------->

<div class="main2-wrapper">
	<div class="container">
   	  <div class="row-fluid-main2">
        	
            <div class="kyeword">
            	<p>Register: </p>
<br><br>
	Please fill in the following information to register with <?=title?>.<br>
	<?=title?> personnel will verify registration information, confirm via email, and you will have access by the next business day.<br>
	<b>NOTE:</b> All fields marked with * are required.
    <br> <br>
            
    
	</div>
        <? notification('registermsg','info|'.$this->site_function->getData('notification',$pageDetail->id).'');?>                         
<form action="" id="form_three"  method="post" >  
            <table cellpadding="0" cellspacing="0" border="1" class="table_2">
					<tr>
                        <th colspan="2" align="center" bgcolor="#CCCCCC">Username / Password</th>
                      
                    </tr>
                    <tr>
                        <th align="right">Username*</th>
                        <td><input type="text" id="username" name="username" data-validation="required"
            data-validation-error-msg="Please enter your username"  ></td>
                    </tr>
                    <tr>
                        <th align="right">Password*</th>
                        <td><input type="password" name="password_confirmation" data-validation="length" data-validation-length="min6" ></td>
                    </tr>
					<tr>
                        <th align="right">Re-enter Password*</th>
                        <td><input type="password" name="password"  data-validation="confirmation"  data-validation-error-msg="The Password and the Confirm Password don't match." ></td>
                    </tr>
		</table>
			<div class="clear"></div>
			<table cellpadding="0" cellspacing="0" border="1" class="table_2">
					<tr>
                        <th colspan="2" align="center" bgcolor="#CCCCCC">Contact Information</th>
                      
                    </tr>
                    <tr>
                        <th align="right">Full Name*</th>
                        <td><input type="text" id="firstname" name="firstname" data-validation="required"
            data-validation-error-msg="Please enter your name"  ></td>
                    </tr>
                    <tr>
                        <th align="right">Email Address*</th>
                        <td><input type="text" name="c_email" class="server-validation input-text"  
data-validation="server" data-validation-url="<?=site_url;?>/ajax/&od=yes" autocomplete="off" /></td>
                    </tr>
					<tr>
                        <th align="right">Telephone</th>
                        <td><input type="text" id="mobileNo" name="mobileNo" data-validation="required"
            data-validation-error-msg="Please enter your Telephone"  ></td>
                    </tr>
		</table> 
			 <div class="clear"></div>
			
<input name="type" type="hidden" value="user" />
<input name="status" type="hidden" value="pending" />
<input name="notification" id="notification" type="hidden" value="registermsg" />
<input name="<?=frontend?>" type="hidden" value="user/signup" />   
<input type="submit" value="Register" class="search_again">
</form>

			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			
   	  </div>
    </div>
</div>

<!-------- main-finish --------->

