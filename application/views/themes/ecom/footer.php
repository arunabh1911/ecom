<!-------- footer-start --------->

<div class="footer2-wrapper">
	<div class="container">
    	<div class="row-fluid-footer2">
        	
            <div class="span2 fix footer2_sp2">
	           	  <h6>Information</h6>
                  <p><a href="<?=site_url?>/terms-and-conditions/">Terms & Conditions</a></p>
                  <p><a href="<?=site_url?>/about-us/">About <?=title?></a></p>
                  <p><a href="<?=site_url?>/contact-us/">Contact Us</a></p>
                  <p><a href="#">Site Map</a></p>
                  <p><a href="<?=site_url?>/privacy-statement/">Privacy Statement</a></p>
            </div>
            
            <div class="span3 footer2_sp3">
              	<h6>India</h6>
              	<p><a href="#"><?=$email[0];?></a></p>
              	<p><b>Phone: <?=$phone[0]?><br>
              	Phone: <?=$phone[1]?><br>
				</p>
              	<p class="footer_p"><b><img src="<?=temp_path?>/img/chat-white.png">  Live Chat</b></p>
              	<img src="<?=temp_path?>/img/seal_image.png" width="50" height="54">
            </div>
            
            <div class="span4 footer2_sp4">
            	<h6>Information</h6>
              	<p><a hre <p><a href="<?=site_url?>/terms-and-conditions/">Terms & Conditions</a></p>
                  <p><a href="<?=site_url?>/about-us/">About <?=title?></a></p>
                  <p><a href="<?=site_url?>/contact-us/">Contact Us</a></p>
                  <p><a href="#">Site Map</a></p>
                  <p><a href="<?=site_url?>/privacy-statement/">Privacy Statement</a></p>
            </div>
            
            <div class="span3 footer2_sp3a">
            
                <img onClick="window.location='<?=$social['facebook']?>'" src="<?=temp_path?>/img/facebook_32.png">
                <img onClick="window.location='<?=$social['google']?>'" src="<?=temp_path?>/img/googleplus_32.png">
                <img onClick="window.location='<?=$social['linkidin']?>'" src="<?=temp_path?>/img/linkedin_32.png">
                <img onClick="window.location='<?=$social['twitter']?>'" src="<?=temp_path?>/img/twitter_32.png">
                <img onClick="window.location='<?=$social['youtube']?>'" src="<?=temp_path?>/img/youtube_32.png">
                <p><?=site_copyright?><br>
             	 <?=$address['add_one'];?>,<br>
                <?=$address['add_two'];?>, <?=$address['add_three'];?></p>
                <img src="<?=temp_path?>/img/homepageassociations.jpg">
            </div>
        
        </div>
    </div>
</div>

<!-------- footer-finish --------->

<form action="" method="post" name="logout">
<input name="<?=frontend?>" type="hidden" value="user/logout" />
</form>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
<script src="http://malsup.github.io/jquery.form.js"></script>

<script>
function loader (){
	return '<span class="load" ><img src="<?=site_url?>/admin/images/loaders/loader2.gif" >';
}

	$.validate({ //top error without ajax  //one: profile	|	one2: passwordchange
		form : '#form_one, #form_one2',
		modules : 'location, date, security, file',
		errorMessagePosition : 'top', 
		scrollToTopOnError : true ,
		onModulesLoaded : function() {
		}
	});
	
	$.validate({ //inline error without ajax  //one: profile
		form : '#form_inline',
		modules : 'location, date, security, file',
		onSuccess : function() {
			forumid = event.target.id; //set forum id
			$("#"+forumid+" #submit").after( loader() );
			$("#"+forumid+" #submit").attr('disabled', 'disabled');
			$("#"+forumid+" #submit").val('please wait');
		},
	});
	
	$.validate({ //inline error with ajax //two: login(default)	|	form_three: contactus2, forgot, register | four: contactus1
		form : '#form_two, #form_three, #form_four', 
		modules : 'location, date, security, file',
		onModulesLoaded : function() {
		},
		onSuccess : function() {
			 myValue = event.target.id; //set forum id
		},
	});
	
	$('#form_two').ajaxForm({
		
		clearForm: true,
        resetForm: true,
		beforeSend: function() {
			$("#form_two #submit").after( loader() );
		},
		data: { ajx: 'ajx'},
	   	success: function(data){
			$('#'+$("#form_two #notification").val()+'').html(data);
		},
		complete: function () {
            $('.load').remove();
            }
    }); 
	
	$('#form_three, #form_four').ajaxForm({	
		clearForm: true,
        resetForm: true,
		beforeSend: function() {
			var formId = event.target.id //get forum id
			$("#"+formId+" #submit").attr('disabled', 'disabled');
			$("#"+formId+" #submit").html('please wait');$("#"+formId+" #submit").val('please wait');
			$("#"+formId+" #submit").after( loader() );
		},
		data: { ajx: 'ajx'},
	   	success: function(data){
			formId = window.myValue;
			var noti = $('#'+formId+' #notification').fieldValue()[0]; // forum textbox by id
			$('#'+noti+'').html(data); // echo notification 	//$('#sstest').html(data);
		},
		complete: function () {
			formId = window.myValue;
            $('.load').remove();
			$("#"+formId+" #submit").removeAttr('disabled');$("#"+formId+" #submit").html($("#"+formId+" #submit").val());
            }
	});
</script>
</body>
</html>