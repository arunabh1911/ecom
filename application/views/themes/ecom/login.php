<!-------- main-start --------->

<div class="main2-wrapper">
	<div class="container">
   	  <div class="row-fluid-main2">
        	
            <div class="kyeword">
            	<p>Login </p>
<br><br>
<?=notification('loginmsg');?>
  <form action="" method="post" id="form_two"  >          
            <table cellpadding="0" cellspacing="0" border="1" class="table_2">
					<tr>
                        <th colspan="2" align="center" bgcolor="#CCCCCC">Username / Password</th>
                      
                    </tr>
                    <tr>
                        <th align="right">Username*</th>
                        <td><input autocomplete="off"  class="input-text" name="c_email" type="text" data-validation="email" data-validation-error-msg="enter correct e-mail address" /></td>
                    </tr>
                    <tr>
                        <th align="right">Password*</th>
                        <td><input class="input-text" placeholder="Password" name="password" type="password" data-validation="required" data-validation-error-msg="enter your password"></td>
                    </tr>
					
					<tr>
                  
                        <td colspan="2" align="center"> 
<input name="notification" id="notification" type="hidden" value="loginmsg" />
<input name="<?=frontend?>" id="act" type="hidden" value="user/signin" />
<input type="submit" value="Log In" class="search_again"></td>
                    </tr>
		</table>
			
</form>

			 
			 <div class="clear"></div>
			
			<p> <a href="<?=site_url?>/why-register/"> Why Register?</p></a>
			<p> <a href="<?=site_url?>/admin/">Admin?</p></a>
			
 <div class="clear">
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			 
			 </div>
			
   	  </div>
    </div>
</div>

<!-------- main-finish --------->

