<? 
include'header.php';
$qry=$db->runQuery("select * from ".SETTINGS." "); 
while($view= $db->getQuery($qry))
{
	$setting=$view['setting'];
	$$setting=$view['value'];
}
@$add=explode("|",$site_address);
$eSetup = json_decode(stripslashes($emailConfiguration), TRUE);
$address = json_decode(stripslashes($site_address), TRUE);
$social = json_decode(stripslashes($social), TRUE);
$hemail = ($eSetup['type'] == 'smtp')  ? '' : 'style="display: none"';
$paypal_standard = explode('|',$paypal_standard);
$CCAvenue = explode('|',$CCAvenue);
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
            <h1 class="pagetitle">Settings</h1>
           <!-- <span class="pagedesc">your site settings</span>-->
            
            <ul class="hornav">
                <li class="current"><a href="#general ">General </a></li>
                <li><a href="#social">Social</a></li>
                <li><a href="#address">Address</a></li>
                  <li><a href="#email">Email Configuration</a></li>
                <li><a href="#gateway">Payment Gateway</a></li>
			</ul>
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
        <p>
            <label>Site Title</label>
            <span class="field">
            <input class="mediuminput" name="title" value="<?=$title;?>" type="text" />
            </span>
        </p>
        
         <p>
            <label>Site  Logo</label>
             <span class="field">
            <input class="mediuminput" name="site_logo[]" type="file" />
            <img src="<?=img_path.$site_logo;?>" width="30px" />
            <input type="hidden" name="unlink" value="<?=img_path.$site_logo;?>" />
            </span>
         </p>
        
        <p>
            <label>Meta Keywords</label>
             <span class="field">
            <input name="meta_key" cols="80" rows="5"  value="<?=$meta_key;?>" class="mediuminput tags" />
            </span>
        </p>
        
        
        <p>
            <label>Meta Description</label>
             <span class="field">
            <textarea class="mediuminput" name="meta_des" cols="90" rows="5" ><?=$meta_des;?></textarea>
            </span>
        </p>
        
        
         <p>
            <label>Site E-Mail</label>
             <span class="field">
            <input class="mediuminput" name="site_mail" value="<?=$site_mail;?>" type="text" />
            </span>
        </p>
      
        <p>
            <label>Copyright text</label>
             <span class="field">
            <input class="mediuminput" name="site_copyright" value="<?=$site_copyright;?>" type="text" />
            </span>
        </p>
        
        <p>
            <label>Image Extension</label>
             <span class="field">
            <input class="tags" name="img_ext" value="<?=$img_ext;?>" />
            </span>
        </p>
 
    <p>
        <label>File Extension</label>
         <span class="field">
        <input class="tags" name="file_ext" value="<?=$file_ext;?>" />
        </span>
    </p>
  
    <p>
        <label>Auto Logout</label>
         <span class="field">
        <input class="mediuminput" name="logout" value="<?=$logout;?>" type="text" style="width:30px;" /> min
        </span>
    </p>   
              
                          
     <p>
        <label>Site Currency</label>
       	<span class="field">                
        <select name="siteCurrency" class="chzn-select" tabindex="2"> 
        <option <? if($siteCurrency=='Rs')echo selected;?> value="Rs">(Rs) Rupee</option> 
        <option <? if($siteCurrency=='€')echo selected;?> value="&euro;"> (&euro;) Euro</option>
        <option <? if($siteCurrency=='$')echo selected;?> value="$"> ($) Dollar</option> 
        <option <? if($siteCurrency=='£')echo selected;?> value="&pound;"> (&pound;) Pound </option> 
        </select>
        </span>
    </p>
               
			   
			                       
    </div>
</div>

<div class="two_third dashboard_left"> 	
 <div id="social" class="subcontent" style="display: none">
               
               	
                    <p>
                        <label>Youtube Page link</label>
                        <span class="field">
                        <input class="mediuminput" name="s_youtube" value="<?=$social['youtube'];?>" type="text" />
                        </span>
                    </p>
					 <p>
                        <label>Facebook Page link</label>
                        <span class="field">
                        <input class="mediuminput" name="s_facebook" value="<?=$social['facebook'];?>" type="text" />
                        </span>
                    </p>
                    <p>
                        <label>Twitter Page link</label>
                        <span class="field">
                        <input class="mediuminput" name="s_twitter" value="<?=$social['twitter'];?>" type="text" />
                        </span>
                    </p>
					<p>
                        <label>Linked In</label>
                        <span class="field">
                        <input class="mediuminput" name="s_linkedin" value="<?=$social['linkedin'];?>" type="text" />
                        </span>
                    </p>
					
					 <p>
                        <label>Google+</label>
                        <span class="field">
                        <input class="mediuminput" name="s_google" value="<?=$social['google'];?>" type="text" />
                        </span>
                    </p>
					<!-- <p>
                        <label>Instagram</label>
                        <span class="field">
                        <input class="mediuminput" name="s_instagram" value="<?=$social['instagram'];?>" type="text" />
                        </span>
                    </p>
						 <p>
                        <label>Pinterest</label>
                        <span class="field">
                        <input class="mediuminput" name="s_pinterest" value="<?=$social['pinterest'];?>" type="text" />
                        </span>
                    </p>
					-->
				                    
                   
					
                  </div>
</div>

<div class="two_third dashboard_left">                    
 <div id="address" class="subcontent" style="display: none">
			<p>
                        <label>Phone</label>
                        <span class="field">
                        <input class="mediuminput" name="add_phone_one" type="text" value="<?=$address['add_phone_one'];?>" />
                        </span>
			</p>
				   
				   <p>
                        <label>Email</label>
                        <span class="field">
                        <input class="mediuminput" name="add_email_one" type="text" value="<?=$address['add_email_one'];?>" >
                        </span>
	               </p>
				   
				   <p>
                        <label>Address line 1</label>
                        <span class="field">
                        <input class="mediuminput" name="add_one" type="text" value="<?=$address['add_one'];?>" >
                        </span>
	               </p>
				   
				   <p>
                        <label>Address line 2</label>
                        <span class="field">
                        <input class="mediuminput" name="add_two" type="text" value="<?=$address['add_two'];?>" >
                        </span>
	               </p>
				   
				   <p>
                        <label>Address line 3</label>
                        <span class="field">
                        <input class="mediuminput" name="add_three" type="text" value="<?=$address['add_three'];?>" >
                        </span>
	               </p>
                   
                    <p>
                        <label>Address line 4</label>
                        <span class="field">
                        <input class="mediuminput" name="add_four" type="text" value="<?=$address['add_four'];?>" >
                        </span>
	               </p>
 </div>
</div> 

<div class="two_third dashboard_left">                    
 <div id="email" class="subcontent" style="display: none">
 		
        <p>
            <label>Email</label>
            <span class="field">
          <select name="email_status">
          <option <? if($eSetup['status'] == 'enable')echo 'selected';?> value="enable">Enable</option>
       	<option <? if($eSetup['status'] == 'disable')echo 'selected';?> value="disable">Disable</option>
        </select>
            </span>
        </p>
				   
        <p>
            <label>Type</label>
            <span class="field">
            <input <? if($eSetup['type'] == 'php')echo 'checked';?> name="email_type" type="radio" value="php" onclick="return chk(this.value)" /> PHP Mailer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input <? if($eSetup['type'] == 'smtp')echo 'checked';?> name="email_type" type="radio" value="smtp" onclick="return chk(this.value)" /> SMTP
            </span>
        </p>
        <span id="hemail" <?=$hemail?> >
         <p>
            <label>SMTP</label>
            <span class="field">
             <input class="mediuminput" name="email_smtp" type="text" value="<?=$eSetup['smtp']?>" >
            </span>
        </p>
        
         <p>
            <label>Port</label>
            <span class="field">
            <input class="mediuminput" name="email_port" type="text" value="<?=$eSetup['port']?>" >
            </span>
        </p>
        
         <p>
            <label>Username</label>
            <span class="field">
            <input class="mediuminput" name="email_user" type="text" value="<?=$eSetup['username']?>" >
            </span>
        </p>
        
         <p>
            <label>Password</label>
            <span class="field">
            <input class="mediuminput" name="email_pass" type="text" value="<?=$eSetup['password']?>" >
            </span>
        </p>
		</span>
        
</div>
</div>


<div class="two_third dashboard_left">
	<div id="gateway" class="subcontent" style="display: none">

<br />
         <h3>CCAvenue:: Merchant Accounts</h3>
			<p></p>
          
        <p>
            <label>Merchant Id</label>
            <span class="field"><input class="mediuminput" name="cc1" type="text" value="<?=$CCAvenue[0]?>" /></span>
           
        </p>
        
                           
        <p>
            <label>32 Bit Working Key</label>
            <span class="field"><input class="mediuminput" name="cc2" type="text" value="<?=$CCAvenue[1]?>" /></span>
           
        </p>


<br /> <br /> 

    <h3>Paypal Standard Payment</h3>
			<p></p> 
    
<p>
	<label>type</label>
	<span class="field"><select name="paypal1" class="chzn-select" style="width:210px;" tabindex="2"> 
<option <? if($paypal_standard[0]=='sandbox')echo selected;?> value="sandbox">Sandbox</option> 
<option <? if($paypal_standard[0]=='live')echo selected;?> value="live">Live</option> 
</select>
</span>
</p>

                  
<p>
 	<label>currency Code</label>
	<span class="field"><select data-placeholder="Choose Currency" name="paypal3" class="chzn-select" style="width:210px;" tabindex="2"> 
<option <? if($paypal_standard[2]=='USD')echo selected;?> value="USD">USD</option> 
<option <? if($paypal_standard[2]=='GBP')echo selected;?> value="GBP">GBP</option> 
<option <? if($paypal_standard[2]=='EUR')echo selected;?> value="EUR">EUR</option>
<option <? if($paypal_standard[2]=='JPY')echo selected;?> value="JPY">JPY</option>
<option <? if($paypal_standard[2]=='CAD')echo selected;?> value="CAD">CAD</option>
<option <? if($paypal_standard[2]=='AUD')echo selected;?> value="AUD">AUD</option>
</select>
</span>
</p>

<p>
	<label>business email</label>
	<span class="field"><input class="mediuminput" name="paypal2" type="text" value="<?=$paypal_standard[2];?>" /></span>
   
</p>

<!--<br />
<strong>Eway Process Payment</strong>
    
<p>
	<label>type</label>
	<span class="field"><select name="eway1" class="chzn-select" style="width:210px;" tabindex="2"> 
<option <? if($eway[0]=='https://api.sandbox.ewaypayments.com')echo selected;?> value="https://api.sandbox.ewaypayments.com">Sandbox</option> 
<option <? if($eway[0]=='https://api.ewaypayments.com')echo selected;?> value="https://api.ewaypayments.com">Live</option> 
</select>
</span>
</p>

<p>
	<label>username</label>
	<span class="field"><input class="mediuminput" name="eway2" type="text" value="<?=$eway[1];?>" /></span>
   
</p>
                   
<p>
 	<label>password</label>
	<span class="field"><input class="mediuminput" name="eway3" type="text" value="<?=$eway[2];?>" /></span>
</p>
<input name="eway-chk" type="hidden" value="<?=$eway[0].'|'.$eway[1].'|'.$eway[2];?>" />-->
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
