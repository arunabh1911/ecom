<script>
        var OAUTHURL    =   'https://accounts.google.com/o/oauth2/auth?';
        var VALIDURL    =   'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=';
        var SCOPE       =   'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';
        var CLIENTID    =   '<?=googleclientId?>';
        var REDIRECT    =   'http://<?=$_SERVER['HTTP_HOST']?>/oauth2callback'
        var LOGOUT      =   'http://accounts.google.com/Logout';
        var TYPE        =   'token';
        var _url        =   OAUTHURL + 'scope=' + SCOPE + '&client_id=' + CLIENTID + '&redirect_uri=' + REDIRECT + '&response_type=' + TYPE;
        var acToken;
        var tokenType;
        var expiresIn;
        var user;
        var loggedIn    =   false;

        function gmlogin(type) {
            var win         =   window.open(_url, "windowname1", 'width=600, height=450'); 

            var pollTimer   =   window.setInterval(function() { 
                try {
                    console.log(win.document.URL);
                    if (win.document.URL.indexOf(REDIRECT) != -1) {
                        window.clearInterval(pollTimer);
                        var url =   win.document.URL;
                        acToken =   gup(url, 'access_token');
                        tokenType = gup(url, 'token_type');
                        expiresIn = gup(url, 'expires_in');
                        win.close();

                        validateToken(acToken,type);
                    }
                } catch(e) {
                }
            }, 500);
        }

        function validateToken(token,type) {
            $.ajax({
                url: VALIDURL + token,
                data: null,
                success: function(responseText){  
                    gmUserInfo(type);
                    loggedIn = true;
                },  
				beforeSend: function () {
								$("#form_two #submit").after( loader() );
								},
                dataType: "jsonp"  
            });
        }

        function gmUserInfo(type) {
            $.ajax({
                url: 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' + acToken,
                data: null,
                success: function(resp) {
                    response    =   resp;
                    console.log(response);
				//$('#sstest').html(JSON.stringify(response));return false;
							$.ajax({
								type: 'POST',
								url: '',
								data: { '<?=frontend?>': 'user/socialLogin', field: 'googleId', Id: response.id, firstname: response.name, c_email: response.email, gender:  response.gender, image1: response.picture, ajx: 'ajx', type: type },
								success: function (data) {
									$('#'+$("#form_two #notification").val()+'').html(data);
								},
							
							 complete: function () {
								$('.load').remove();
								 },
							});
				 },
                dataType: "jsonp"
            });
        }

      	function gup(url, name) {
            name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\#&]"+name+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec( url );
            if( results == null )
                return "";
            else
                return results[1];
        }

        function startLogoutPolling() {
            $('#loginText').show();
            $('#logoutText').hide();
            loggedIn = false;
            $('#uName').text('Welcome ');
            $('#imgHolder').attr('src', 'none.jpg');
        }
</script>
<!--
onClick="gmlogin()" 
id="login" //for loader
require jquerylib*
https://console.developers.google.com/project/apps~affable-case-578/apiui/credential?authuser=0
-->