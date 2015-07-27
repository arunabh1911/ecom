<?php
$baseurl = getcwd().'/../';
require $baseurl.'index.php';
require 'global-setting.php';
$load = new loader();
$load->model('site_function');
?>
<body class="withvernav">
<form action="adm-action.php" method="post" name="logout">
<input name="admin" value="logout" type="hidden" />
</form>
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo"><?=title?><span> Admin</span></h1>
            <span class="slogan">Site admin</span>
            
            <br clear="all" />
         </div>
         
        <div class="right">
        
        	<!--<div class="notification">
                <a class="<?=$noticls?>" onClick="setTimeout(function(){unread();},500);" href="ajax/notifications.php"><span><?=$numNoti?></span></a>
        	</div>-->
           
           
            <div class="userinfo">
            <? if($admin[image1]){?>
            	<img src="<?=img_path.$admin['image1']?>" height="25" alt="" />
                <? }else{?>
                <img src="images/admin.jpg" height="25" alt="" />
                <? }?>
                <span><?=ucwords($admin['companyName']);?></span>
            </div>
            
            <div class="userinfodrop">
            	<div class="avatar"><a href="#">
         <? if($admin[image1]){?>
         <img src="<?=img_path.$admin['image1']?>" width="95" alt="" />
         <? }else{?>
             <img src="images/admin.jpg" height="95" alt="" />
         <? }?>
         </a>
         
                </div>
                <div class="userdata">
                	<h4><?=ucwords($admin['companyName']);?></h4> <br />
                    <span class="email"><?=$admin['email'];?></span>
                    <ul>
                    	<li><a href="editprofile.php">Edit Profile</a></li>
                        <li><a href="change-password.php">Change Password</a></li>
                        <li><a href="javascript:void(0)" onClick="document.logout.submit();">Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="header">
    	<ul class="headermenu">
        	<li class="current"><a href="dashboard.php"><span class="icon icon-flatscreen"></span>Dashboard</a></li>
          	<li><a href="<?=site_url?>"><span class="icon icon-home"></span><?=title?></a></li>
            
        </ul>
        <div class="headerwidget">
        	<div class="earnings">
            	<div class="one_half">
                	
                </div>
                <div class="one_half last alignright">
                	<h4>Today's date</h4>
                    <h2><?=date('d/m/Y')?></h2>
                </div>
            </div>
        </div>
       
        
    </div>

    <div class="vernav2 iconmenu">
    	<ul>

<? if($_SERVER[HTTP_HOST]=='localhost'){?>
<li <? if($url=='master.php' || $url=='master_manage.php'){?>class="current"<? }?>><a href="#formsub" class="editor">Master</a>
<span class="arrow"></span>
<ul id="formsub">
    <li <? if($url=='master.php' && $_REQUEST['id']==''){?>class="current"<? }?>><a href="master.php">Create</a></li>
    <li <? if($url=='master_manage.php' && $_REQUEST['id']=='' && $_REQUEST['act']==''){?>class="current"<? }?>><a href="master_manage.php">Manage</a></li>
      <li <? if($url=='master_manage.php' && $_REQUEST['act']=='settings'){?>class="current"<? }?>><a href="master_manage.php?act=settings">Settings</a></li>
</ul>
</li>	
<? }?>


<li <? if($url=='parameters.php' || $url=='parameters-add.php'){?> class="current"<? }?>><a href="parameters.php" class="tables">Parameters</a></li>	


<li <? if($url=="masters.php" || $url=="masters-add.php"){?>class="current"<? }?>><a href="#admin" class="gallery">Mater</a>
            	<span class="arrow"></span>
            	<ul id="admin">
<?
$qry=$db->runQuery("select * from ".PAR." ");
if(mysqli_num_rows($qry) > 0){ 
while($data= $db->getQuery($qry)){?>
<li <? if($_REQUEST['name'] == $data['slug']){?>class="current"<? }?>><a href="masters.php?name=<?=$data['slug'];?>"><?=$data['name'];?></a></li>
<? }}?>
</ul>
</li>
			
<li <? if($url=="category.php" || $url=="manage-category.php"){?> class="current"<? }?>><a href="manage-category.php" class="tables">Category</a></li>	

			
			


<li <? if($url=="product.php" || $url=="manage-product.php"){?>class="current"<? }?>><a href="#photo" class="gallery">Products</a>
            	<span class="arrow"></span>
            	<ul id="photo">
               		<li <? if($url=="product.php"){?>class="current"<? }?>><a href="product.php">Add Products</a></li>
                    <li <? if($url=="manage-product.php"){?>class="current"<? }?>><a href="manage-product.php">Manage Products</a></li>
                </ul>
            </li>

<!--
<li <? if($url=="discount.php" || $url=="manage-discount.php"){?>class="current"<? }?>><a href="#Coupons" class="gallery">Promo Code</a>
            	<span class="arrow"></span>
            	<ul id="Coupons">
               		<li <? if($url=="discount.php"){?>class="current"<? }?>><a href="discount.php">Add</a></li>
<li <? if($url=="manage-discount.php" && $_REQUEST['act']=='single'){?>class="current"<? }?>><a href="manage-discount.php?act=single">View One Time Code</a></li>
<li <? if($url=="manage-discount.php" && $_REQUEST['act']=='multiple'){?>class="current"<? }?>><a href="manage-discount.php?act=multiple">View Multiple Time Code</a></li>
                </ul>
            </li>-->
			
			
<li <? if($url=='associate.php' || $url=='associate-view.php' ){?> class="current"<? }?>><a href="associate.php" class="widgets">Users Management</a></li>

<li <? if($url=='suppliers.php' || $url=='suppliers-view.php' ){?> class="current"<? }?>><a href="suppliers.php" class="widgets">Suppliers Management</a></li>

<li <? if($url=='manufacturer.php' || $url=='manufacturer-add.php' ){?> class="current"<? }?>><a href="manufacturer.php" class="widgets">Manufacturer</a></li>

<!--<li <? if($url=='associate.php' || $url=='associate-view.php' ){?> class="current"<? }?>><a href="associate.php" class="widgets">Users</a></li>

<li <? if($url=='suppliers.php' || $url=='suppliers-view.php' ){?> class="current"<? }?>><a href="suppliers.php" class="widgets">Suppliers</a></li>	-->		
						
<?
//subform
$qry=$db->runQuery("select * from ".CATEGORY." where type='multiple page' or type='gallery'");
if(mysqli_num_rows($qry) > 0){ 
while($data= $db->getQuery($qry)){$pg1='add-pages.php';$pg2='manage-sub-pages.php';
if($data['type']=='gallery'){ $pg1='add-gallery.php'; $pg2='manage-gallery.php'; }
?>            
	<li <? if($_REQUEST['forms']==$data['id']){?> class="current"<? }?>><a href="#formsub<?=$data['id']?>" class="editor"><?=ucwords($data['page_name']);?></a>
<span class="arrow"></span>

<ul id="formsub<?=$data['id']?>">
	<li <? if($url==$pg1 && $_REQUEST['forms']==$data['id']){?> class="current"<? }?>><a href="<?=$pg1?>?tbl=site_category&forms=<?=$data['id']?>">Add <?=ucwords($data['page_name']);?></a></li>

	<li <? if($url==$pg2 && $_REQUEST['forms']==$data['id']){?> class="current"<? }?>><a href="<?=$pg2?>?tbl=site_category&forms=<?=$data['id']?>">Manage <?=ucwords($data['page_name']);?></a></li>

</ul>
</li>	
<? }}?>


<li <? if($url=='manage-pages.php' || $url=='add-pages.php'){?> class="current"<? }?>><a href="manage-pages.php?tbl=<?=CATEGORY;?>" class="tables">Pages</a></li>	   


	




<li <? if($url=='email-template.php' || $url=='email-templateView.php'){?> class="current"<? }?>><a href="email-template.php" class="tables">Mail Templates</a></li>

<!--<li <? if($url=='notification.php'){?> class="current"<? }?>><a href="notification.php" class="error">Notification</a></li>-->

<li <? if($url=="settings.php"){?>class="current"<? }?>><a href="settings.php" class="support">Settings</a></li>
            
        	
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div>

<!--
<span class="label label-suspended">Default</span>
<span class="label label-primary">Primary</span>
<span class="label label-active">Success</span>
<span class="label label-pending">Info</span>
<span class="label label-inactive">Warning</span>
<span class="label label-danger">Danger</span>
-->