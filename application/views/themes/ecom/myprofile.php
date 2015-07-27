<!-------- main-start --------->

<div class="main2-wrapper">
	<div class="container">
   	  <div class="row-fluid-main2">
        	
            <div class="kyeword">
            	<p>Customer Information: </p>
<br><br>
	
            
    
	</div>
        <? notification('registermsg','info|'.$this->site_function->getData('notification',$pageDetail->id).'');
			$naam = explode(' ',$user->name); ?>                         
<form action="" id="form_three"  method="post" >  
            <table cellpadding="0" cellspacing="0" border="1" class="table_2">
					<tr>
                        <th colspan="2" align="center" bgcolor="#CCCCCC">Shipping Address</th>
                      
                    </tr>
                    <tr>
                        <th align="right">First Name*</th>
                        <td><input type="text" id="username" name="username" data-validation="required"
            data-validation-error-msg="Please enter your username"  value="<?=$naam[0];?>" ></td>
                    </tr>
                    <tr>
                        <th align="right">Last Name*</th>
                        <td><input type="text" name="password_confirmation" data-validation="length" data-validation-length="min6" value="<?=$naam[1];?>" ></td>
                    </tr>
					<tr>
                        <th align="right">Mail*</th>
                        <td><input type="text" name="password"  data-validation="confirmation"  data-validation-error-msg="The Password and the Confirm Password don't match." value="<?=$user->email?>" ></td>
                    </tr>
					<tr>
                        <th align="right">Address*</th>
                        <td><input type="password" name="password"  data-validation="confirmation"  data-validation-error-msg="The Password and the Confirm Password don't match." ></td>
                    </tr>
					<tr>
                        <th align="right">City*</th>
                        <td><input type="password" name="password"  data-validation="confirmation"  data-validation-error-msg="The Password and the Confirm Password don't match." ></td>
                    </tr>
					<tr>
                        <th align="right">State*</th>
                        <td><input type="password" name="password"  data-validation="confirmation"  data-validation-error-msg="The Password and the Confirm Password don't match." ></td>
                    </tr>
					<tr>
                        <th align="right">Postal Code*</th>
                        <td><input type="password" name="password"  data-validation="confirmation"  data-validation-error-msg="The Password and the Confirm Password don't match." ></td>
                    </tr>
		</table>
			
			 
			 <div class="clear"></div>
			
<input name="type" type="hidden" value="user" />
<input name="status" type="hidden" value="pending" />
<input name="notification" id="notification" type="hidden" value="registermsg" />
<input name="<?=frontend?>" type="hidden" value="user/signup" />   
<input type="submit" value="Submit" class="search_again">
<input onclick="window.location='<?=site_url?>/account/'" type="button" value="Retuen to previous page" class="search_again">
</form>

			 <p>&nbsp;</p>
			 <p>&nbsp;</p>
			
   	  </div>
    </div>
</div>

<!-------- main-finish --------->

