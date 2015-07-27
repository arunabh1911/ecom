<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		
		FB.init({
			appId      : '<?=facebookappId?>', // App ID
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true,  // parse XFBML
			version    : 'v2.0'
			});
		
		FB.Event.subscribe('auth.authResponseChange', function(response) {
			if (response.status === 'connected')  { //SUCCESS
			document.getElementById("message").innerHTML +=  "";
			}
			else if (response.status === 'not_authorized') { //FAILED
				document.getElementById("message").innerHTML +=  "<br>Failed to Connect";
				} 
			else  { //UNKNOWN ERROR
				document.getElementById("message").innerHTML +=  "<br>Logged Out";
			}
		});	
	};
    
   	function fbLogin(type) {
		
		FB.login(function(response) {
				
		   if (response.authResponse) {
			    $("#form_two #submit").after( loader() );
			   	$('#status').html('');
				getUserInfo(type);
  			} 
			else {
  	    	 console.log('User cancelled login or did not fully authorize.');
   			}
		},{scope: 'email,user_photos,user_videos'});
	}

	function getUserInfo(type) {
		
		/*		FB.login(function(){
		 FB.api('/me/feed', 'post', {message: 'Hello, world!'});
		}, {scope: 'publish_actions'});*/
		
		//FB.api('/me', function(response) {
		FB.api('/me',{fields: "id,name,email,gender,timezone,picture"},  function(response) {
 		//$('#sstest').html(JSON.stringify(response));return false;
			
				$.ajax({
					type: 'POST',
					url: '',
					data: { '<?=frontend?>': 'user/socialLogin', field: 'facebookId', Id: response.id, firstname: response.name, c_email: response.email, gender: response.gender, timezone:response.timezone,  image1: response.picture.data.url, ajx: 'ajx', type: type },
					success: function (data) {
						$('#'+$("#form_two #notification").val()+'').html(data);
					},
				 complete: function () {
					$('.load').remove();
					 },
				});
		});
    }
	
	function fbLogout() {
		FB.logout(function(){window.location='index.php?r=logout';});
	}

	(function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
</script>
<!--
onClick="fbLogin()" 
id="login" //for loader
-->