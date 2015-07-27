<style>h3 {display:none;} div#mainContentDigiKey {padding:0px; margin:0px;} div#content {padding:0px; margin:0px;} body {background-color: #ffffff; font-family: Arial, Verdana, sans-serif, Helvetica; font-size: 12px;}
#bulletTable ul {padding-left:10px; margin-left:10px;}
#bulletTable th {padding:8px; background-color:#eee; border:solid 1px #ccc;}
#bulletTable td {padding:5px;}</style>


   <div id="second_logo">
<a style=" width:0px;"><img src="<?=temp_path?>/img/header_logo_bommanager_en.jpg" alt="BOM Manager" title="BOM Manager" style="border-width:0; "></a>
</div>
       <div class="mkt" style="width:850px; margin:20px">
<h1 style="font-size:18px; border-bottom:solid 1px #999; padding-bottom:5px;"><?=$this->site_function->getData('title',$pageDetail->id);?></h1>
<div style="float:right; margin-left:20px; margin-bottom:20px;">  

</div>
  
  
<?=$this->site_function->getData('content1',$pageDetail->id);?>

  
  <img src="<?=temp_path?>/img/bom-icons.jpg" width="100" style="float:left; margin-right:10px; margin-bottom:20px;"/>
    <p style="font-size:14px; padding-top:15px;"><strong>Access the BOM Manager now!</strong></p>
    <p style="font-size:14px;"><a href="<?=site_url?>/login/">Login</a> or <a href="<?=site_url?>/register/">register</a> now to<br />try it for yourself.</p>
<div style="clear:both; height:25px;">&nbsp;</div> 


<?=$this->site_function->getData('content2',$pageDetail->id);?>

<!--<p><strong>Need help with this tool?</strong></p>
<p>Click <a onClick="popUpTall(this.href); return false;" href="#">here</a> for help or contact <a href="#">demo.com</a> for more information.</p>-->
</div>