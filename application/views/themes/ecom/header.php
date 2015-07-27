<?php
$this->load->cls = $this;
$this->load->model('site_function');
$address = json_decode(stripslashes(site_address), TRUE);
$social = json_decode(stripslashes(social), TRUE);
$phone = explode(',',$address['add_phone_one']);
$email = explode(',',$address['add_email_one']);
?>
<!doctype html>
<html>
<head>
<title><?=$pageDetail->seo->meta_title;?></title>
<meta name="description" content="<?=$pageDetail->seo->meta_des;?>"> 
<meta name="keywords" content="<?=$pageDetail->seo->meta_key;?>">
<meta charset="utf-8">

<link href="<?=temp_path?>/css/style.css" rel="stylesheet" type="text/css">
<link href="<?=temp_path?>/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?=temp_path?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?=temp_path?>/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="<?=temp_path?>/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="<?=temp_path?>/css/val.css">

<link href="<?=temp_path?>/css/common.css" rel="stylesheet" type="text/css">
<link href="<?=temp_path?>/css/jquery-ui.css" rel="stylesheet" type="text/css">


<script src="<?=temp_path?>/js/bootstrap.js"></script>
<script src="<?=temp_path?>/js/bootstrap.min.js"></script>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="<?=temp_path?>/js/script.js"></script>


<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {pageLanguage: 'en'},
            'google_translate_element'
        );

        /*
            To remove the "powered by google",
            uncomment one of the following code blocks.
            NB: This breaks Google's Attribution Requirements:
            https://developers.google.com/translate/v2/attribution#attribution-and-logos
        */

        // Native (but only works in browsers that support query selector)
       if(typeof(document.querySelector) == 'function') {
            document.querySelector('.goog-logo-link').setAttribute('style', 'display: none');
           document.querySelector('.goog-te-gadget').setAttribute('style', 'font-size: 0');
        }

      // If you have jQuery - works cross-browser - uncomment this
        //jQuery('.goog-logo-link').css('display', 'none');
        //jQuery('.goog-te-gadget').css('font-size', '0');
    }
</script>
<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
.goog-te-banner-frame.skiptranslate {  visibility:hidden !important; }
body { top:0 !important; }
#google_translate_element .goog-te-gadget .goog-te-combo {
margin: 0px 0 !important;
height: 27px !important;
}
</style>



</head>

<body>

<!-------- header-start --------->

<div class="header2_top-wrapper">
	<div class="container">
    	<div class="row-fluid-header2_top">
            
            <div class="span3 fix header2_top_sp3">
            	<img onClick="window.location='<?=site_url?>'" src="<?=temp_path?>/img/product logo.png">
            </div>
            <form action="" name="frm" method="post">
            <div class="span6 header2_top_sp6">
            	<select class="header2_top_select" name="stype">
                	<option value="part">PARTS</option>
                    <option value="content">CONTANT</option>
                </select>
                <input type="text" name="text" class="header2_input">
                <img onClick="document.frm.submit();"  src="<?=temp_path?>/img/button_background.png" width="56" height="22">
            </div>
            <input name="<?=frontend?>" id="act" type="hidden" value="user/search" />
            </form>
            <div class="span3 header2_top_sp3">
			
<div id="google_translate_element" style="height:25px; float:right;"></div>
           <!-- 	<p><img src="<?=temp_path?>/img/US_Flag.png">
				
				<a href="#">English</a> <b>|</b> <a href="#">USD</a></p>-->>
          </div>
            
        </div>
    </div>
</div>

<div class="header2_bottom-wrapper">
	<div class="container">
    	<div class="row-fluid-header2_bottom">
        	
            <div class="span3 fix header2_bottom_sp3"></div>
            
            <div class="span6 header2_bottom_sp6">
            	<ul>
                	<li><a href="<?=site_url?>/product-search">Products</a></li>
                    <li><a href="<?=site_url?>/supplier/">SUPPLIERS</a></li>
                    <li><a href="#">RESOURCES <img src="<?=temp_path?>/img/triangle-white.png"></a>
                    
                    	<ul class="col">
                       <!--  
                            <p><strong>Research</strong></p>
                           <li><a href="#">Article Library</a></li>
                            <li><a href="#">Conversion Calculators</a></li>
                            <li><a href="#">Digi-Key Academic Program</a></li>
                            <li><a href="#">Newsroom</a></li>
                            <li><a href="#">Online Catalog</a></li>
                            <li><a href="#">Product Training Modules</a></li>
                            <li><a href="#">TechXchange℠</a></li>
                            <li><a href="#">TechZones℠</a></li>
                            <li><a href="#">Video Library</a></li>
                          
                            <p><strong>Design</strong></p>
                            <li><a href="#">Design Services Providers</a></li>
                            <li><a href="#">EDA &amp; Design Tools</a></li>
                            <li><a href="#">Reference Design Library</a></li>
                            <li><a href="../$"> Scheme-it&reg; Design Tool</a></li>
                            
                            
                            
                            <p><strong>Search / Ordering</strong></p>
                            <li><a href="#">BOM Manager</a></li>
                            <li><a href="#">Browser Resources</a></li>
                            <li><a href="#">Order Status</a></li>-->
                          
                        </ul>
                      </li>
                      
                    <<!--li><a href="#"><img src="<?=temp_path?>/img/chat-white.png"> LIVE CHAT</a></li>-->
                </ul>
            </div>
            
            <div class="span3 header2_bottom_sp3">
            	<ul>
				<? if($user){ ?>
                	<li class="login_li"><a href="#"><font size="-2"><strong>Hello <br /><?=$user->name;?></strong></font> <img src="<?=temp_path?>/img/triangle-white.png"></a>
                    	
                        <ul class="col-1">
                            <li><a href="<?=site_url?>/account/">My Account</a></li>
                            <li><a href="javascript:void(0)" onClick="document.logout.submit()">Logout</a></li>
                        </ul>
                    
                    </li>
				<? }else { ?>	
					<li class="login_li"><a href="#">Login or<br> Register <img src="<?=temp_path?>/img/triangle-white.png"></a>
							
							<ul class="col-1">
								<li><a href="<?=site_url?>/login/">Login</a></li>
								<li><a href="<?=site_url?>/register/">Register</a></li>
							</ul>
						
						</li>
				<? }?>
					
                    <li><a href="#"><img src="<?=temp_path?>/img/cart-white.png"> <?=array_sum(explode(',',$_SESSION[product_qty]));?> item(s) <img src="<?=temp_path?>/img/triangle-white.png"></a>
                    
                    	<ul class="col-2">
                            <li class="tt"><a href="#">All prices are in US dollars.</a></li>
                            <li><a href="<?=site_url;?>/mycart/">View Cart (<?=array_sum(explode(',',$_SESSION[product_qty]));?> Items)</a></li>
                        </ul>
                    
                    </li>

                </ul>
            </div>
            
        </div>
     </div>
</div>

<!-------- header-finish --------->

<!-------- main-start --------->

<div class="main2-wrapper">
	<div class="container">
    	<div class="row-fluid-main2">
        	
             
            
            
    </div>
    </div>
</div>



