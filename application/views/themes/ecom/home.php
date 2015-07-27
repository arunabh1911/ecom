<?php
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

<script src="<?=temp_path?>/js/bootstrap.js"></script>
<script src="<?=temp_path?>/js/bootstrap.min.js"></script>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="<?=temp_path?>/js/script.js"></script>


</head>

<body>

<!-------- header-start --------->

<div class="header-wrapper">
	<div class="container">
    	<div class="row-fliud-header">
        	
            <div class="span4 fix header_sp4">
            	<img src="<?=temp_path?>/img/logo_black.jpg">
            </div>
            
            <div class="span4 header_sp4">
            	<p><a href="<?=site_url?>/login/">Login</a></p>
                <p><a href="<?=site_url?>/register/">Register</a> | <a href="<?=site_url?>/why-register/">Why Register?</a></p>
                <h4>India | <?=$phone[0]?></h4>
               <!-- <p><b>USD | Change Country</b></p>-->
            </div>
           
            <div class="span4 header_sp4">
           	  <div class="search_header">
               	<h3>Search <img src="<?=temp_path?>/img/search-box-triangle.png"></h3>
                <div class="radio_button">
				 <form action="" name="frm" method="post">
                      	<input checked="checked" type="radio" name="stype" value="part" class="header_sp4_radio"><b>Parts</b>
                        <input type="radio" name="stype" value="content" class="header_sp4_radio"><b>Content</b>
                </div>
                <div class="clear"></div>
                <input type="text" name="text" class="header_input">
				<input name="<?=frontend?>" id="act" type="hidden" value="user/search" />
                <img onClick="document.frm.submit();" src="<?=temp_path?>/img/search-box-go.png">
                <div class="clear"></div>
                <div class="checkbox_button">
                	<input type="checkbox" class="header_checkbox"><b>In Stock</b>
                	<input type="checkbox" class="header_checkbox"><b>Lead Free</b>
                	<input type="checkbox" class="header_checkbox"><b>RoHS Compliant</b>
                </div>
                <div class="clear"></div>
              </div>
          </div>
		  </form>
            
        </div>
    </div>
</div>

<!-------- header-finish --------->

<!-------- main-start --------->

<div class="main-wrapper">
	<div class="container">
    	<div class="row-fluid-main">
        	
           <!-- <p>English | <b>Español</b></p>-->
            
            <div class="span4 fix main_sp4">
            	
                
                <div id='cssmenu'>
                    <ul>
                       <li><a href='<?=site_url;?>/mycart/'><span>Online Ordering</span></a></li>
                       <li><a href='<?=site_url?>/order-status/'><span>Order Status</span></a></li>
                       <li><a href='#'><span>Newest Products</span></a></li>
                       <li><a href='<?=site_url?>/product-search'><span>Product Index</span></a></li>
                       <li><a href='<?=site_url?>/supplier/'><span>Supplier Index</span></a></li>
                       <li><a href='<?=site_url?>/bom-manager/'><span>BOM Manager</span></a></li>
                       <li class='has-sub'><a href='#'><span>EDA & Design Tools</span></a>
                          <ul>
                             <li><a href='<?=site_url?>/eda-design-tool/'><span>Design Tools Home</span></a></li>
                             <li><a href='<?=site_url?>/mentor-graphics-designe/'><span>Mentor Graphics® Designer Tools</span></a></li>
                             <li><a href='<?=site_url?>/schematic-drawing/'><span>Scheme-it® Diagramming Tool</span></a></li>
                             <li><a href='<?=site_url?>/part-sim/'><span>PartSim Simulation Tool</span></a></li>
                             <li class='last'><a href='<?=site_url?>/pcb-web/'><span>PCBweb PCB Design Tool</span></a></li>
                          </ul>
                       </li>
                       <li class='has-sub'><a href='#'><span>Resources</span></a>
                          <ul>
                             <li><a href='#'><span>Article Library</span></a></li>
                             <li><a href='#'><span>Browser Resources</span></a></li>
                             <li><a href='#'><span>Conversion Calculators</span></a></li>
                             <li><a href='#'><span>Design Services Providers</span></a></li>
                             <li><a href='#'><span>Digi-Key Academic Program</span></a></li>
                             <li><a href='#'><span>Newsroom</span></a></li>
                             <li><a href='#'><span>Online Catalog</span></a></li>
                             <li><a href='#'><span>Product Training Modules</span></a></li>
                             <li><a href='#'><span>Reference Design Library</span></a></li>
                             <li class='last'><a href='#'><span>Video Library</span></a></li>
                          </ul>
                       </li>
                       <li class='has-sub'><a href='#'><span>TechZoneSM</span></a>
                          <ul>
                             <li><a href='#'><span>TechZoneSM Home</span></a></li>
                             <li><a href='#'><span>Energy Harvesting Solutions</span></a></li>
                             <li><a href='#'><span>Lighting Solutions</span></a></li>
                             <li><a href='#'><span>Microcontroller Solutions</span></a></li>
                             <li><a href='#'><span>Power Solutions</span></a></li>
                             <li><a href='#'><span>Sensor Solutions</span></a></li>
                             <li><a href='#'><span>ToolsXpressSM</span></a></li>
                             <li class='last'><a href='#'><span>Wireless Solutions</span></a></li>
                          </ul>
                       </li>
                       <li class='has-sub'><a href='#'><span>TechXchangeSM Community</span></a>
                          <ul>
                             <li><a href='#'><span>TechXchangeSM Community Home</span></a></li>
                             <li><a href='#'><span>General Discussion</span></a></li>
                             <li><a href='#'><span>Component Discussions and Reviews</span></a></li>
                             <li><a href='#'><span>Projects and Designs</span></a></li>
                             <li class='last'><a href='#'><span>Industry News and Events</span></a></li>
                          </ul>
                       </li>
                       <li class='has-sub'><a href='#'><span>Need Help?</span></a>
                          <ul>
                             <li><a href='#'><span>Learn About Our Homepage</span></a></li>
                             <li class='last'><a href='#'><span>How To Order</span></a></li>
                          </ul>
                       </li>
                    
                    </ul>
				</div>

            </div>
            
            <div class="span8 main_sp8">
            	<img src="<?=temp_path?>/img/largest-selection.jpg">
            	<img src="<?=temp_path?>/img/mentorgraphics-banner-en.jpg">
                <img src="<?=temp_path?>/img/nxp_rf_banner.jpg">
            </div>
            <div class="clear"></div>
            
            <div class="span4 fix main_sp4_a">
            	<img onClick="window.location='<?=$social['youtube']?>'" src="<?=temp_path?>/img/youtube_61.png"></a>
                <img onClick="window.location='<?=$social['facbook']?>'" src="<?=temp_path?>/img/facebook_61.png">
                <img onClick="window.location='<?=$social['twitter']?>'" src="<?=temp_path?>/img/twitter_61.png">
                <img onClick="window.location='<?=$social['linkedin']?>'" src="<?=temp_path?>/img/linkedin_61.png">
                <img onClick="window.location='<?=$social['google']?>'" src="<?=temp_path?>/img/googleplus_61.png">
            </div>
            
            <div class="span8 main_sp8_a">
            	<p>
				<a href="<?=site_url?>/about-us/">About <?=title?></a> | 
				<a href="<?=site_url?>/newsroom/">Newsroom</a> | 
				<a href="#">Site Map</a> | 
				<a href="<?=site_url?>/contact-us/">Contact Us</a> | 
				<a href="<?=site_url?>/privacy-statement/">Careers Privacy Statement</a> | 
				<a href="<?=site_url?>/terms-and-conditions/">Terms & Conditions</a> | 
				<a href="<?=site_url?>/ordering/">Ordering</a> | 
				<a href="<?=site_url?>/faqs/">FAQ </a> | 
				<a href="<?=site_url?>/browser-support/">Browser Support</a>
				</p>
                <h6><?=title?> Electronics – Electronic Components Distributor Since 1972</h6>
            </div>
            
        </div>
    </div>
</div>

<!-------- main-finish --------->

<!-------- footer-start --------->

<div class="footer-wrapper">
	<div class="container">
    	<div class="row-fluid-footer">
        	
            <p><?=site_copyright?></p>
            <p><?=$address['add_one'];?>, <?=$address['add_two'];?>, <?=$address['add_three'];?> | Phone: <?=$phone[0]?> or <?=$phone[1]?> | <?=$email[0];?></p>
            <img src="<?=temp_path?>/img/homepage-associations.jpg">
            <img src="<?=temp_path?>/img/seal_image.png">
            
        </div>
    </div>
</div>

<!-------- footer-finish --------->

</body>
</html>
