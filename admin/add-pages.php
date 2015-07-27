<?
include('header.php');
$load = new loader();
$act=$_REQUEST['act'];

if($_REQUEST['tbl']) {
	
	$qry=$db->runQuery("select * from $_REQUEST[tbl] where page_id=$_REQUEST[forms]"); 
	$d= $db->getQuery($qry);
	$status = $d['status'];
	@$seo=explode("||", $d['seo']);
	$option=explode(",", $d['options']);
	$type=$d['type'];
	$cnd='';
	if($type=='multiple page')
		$cnd="and sub_id='0'";
	if($_REQUEST['sub_id']!='')
		$cnd="and sub_id='$_REQUEST[sub_id]'";
}
if(in_array('ajax_upload',$option)){
	$load->third_party('js','jquery.form.js' );
	$load->library('ajax_upload');
}

$load->third_party('ckeditor','ckeditor.js' );?>

<script type="text/javascript" src="js/custom/forms.js"></script>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script> $(function(){ $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }); });</script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script>
var http = false;
if(navigator.appName == "Microsoft Internet Explorer"){
http = new ActiveXObject("Microsoft.XMLHTTP");
}else{http = new XMLHttpRequest();}
function add_button(name,id,opt)
{
	$('#load'+id+'').html('<img src="images/loaders/loader2.gif" border="0" alt="Loading, please wait..." />');
	http.abort();
	http.open("GET", "adm-action.php?act=add_button&name="+name+"&id="+id+"&opt="+opt, true);		
	http.onreadystatechange=function()
	{
		if(http.readyState == 4)
		{
			$('#'+name+id+'').append(http.responseText);
			$('#load'+id+'').html('');
			jQuery('input:checkbox, input:radio, select.uniformselect, input:file').uniform();
		}
	}
	 http.send(null);
}
function dsbl(val,id)
{
	if(val!='')
	{
		$('#'+id+'').attr('disabled', 'disabled');
	}
	else
	{
		$('#'+id+'').removeAttr('disabled');
	}
}

<? if($act=='subpage'){?>
function inv()
{
	if(document.getElementById('page_name').value=='')
	{
		alert('!! Enter Page Name !!');
		document.getElementById('page_name').focus();
		return false;
	}
		$('#pbl').html('please wait....')
}
<? }?>
</script> 

    <div class="centercontent">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=ucwords($d['page_name'])?> </h1>
            <span class="pagedesc"></span>
        </div>
        
        <div id="contentwrapper" class="contentwrapper">

<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>

            <form class="stdform" action="adm-action.php" method="post" enctype="multipart/form-data">
                <div class="two_third dashboard_left"> 
                

<? if($act=='subpage'){?>
    <p>
        <label>Sub Page Name</label>
        <span class="field">
        <input type="text" name="page_name" id="page_name" class="longinput" />
        </span>
    </p>
<? } else {?>
                          	
<? if(@in_array('title',$option)){
$qry1=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='title' $cnd "); 
$s= $db->getQuery($qry1);
$opt=$db->getQuery($db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='title' and sub_id='0' "));
?>
<p>
    <label><?=ucwords($opt['title'])?></label>
    <span class="field">
    <input type="text" name="l<?=$s['id']?>[]" value="<?=ucwords($s['content'])?>" class="longinput" />
    </span>
</p>
<? }?>

<? if(@in_array('date',$option)){?>
<div class="contenttitle2">
<h3>Date</h3>
</div>
                    
<div>   
<div>
<?
$r='';$i=0;
$ttl=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='date' and sub_id='0' order by id ASC ");
while($opt=$db->getQuery($ttl)){ $r[]=$opt['title']; }

$qry1=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='date' $cnd order by id ASC "); 
while($s= $db->getQuery($qry1)){
@$date= explode('-',$s['content']);@krsort($date);@$int=implode("-",$date);?>
<p>
<label><?=ucwords($r[$i])?></label>
<span class="field">
<input type="text" class="datepicker" name="d<?=$s['id']?>[]" value="<?=$int?>" readonly="readonly" />
</span>
</p>                        
<? $i++; }?>

</div>
</div>             
<? }?>

<? if(@in_array('textbox',$option)){
$r='';$j=0;
$ttl=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='textbox' and sub_id='0' order by id ASC ");
while($opt=$db->getQuery($ttl)){ $r[]=$opt['title']; $q[]=$opt['options']; }

$qry1=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='textbox' $cnd order by id ASC ");
while($s= $db->getQuery($qry1)){$s['options']=$q[$j];?>
<div class="contenttitle2">
<h3><?=ucwords($r[$j])?></h3>
</div>
            
<div>   
<div>
<span class="field">
<?
$cnt=explode('||',$s['content']);
for($i=0; $i< count($cnt); $i++){
?>
<input type="text" name="t<?=$s['id']?>[]" value="<?=ucwords($cnt[$i])?>" />
<? }?>
<span id="textbox<?=$s['id']?>"></span>
<br /><br />
<? if($s['options']=='0'){?>
<button onClick="add_button('textbox','<?=$s['id']?>',''); return false;">Add</button>
<span id="load<?=$s['id']?>"></span><br /><br />
<? }?>
</span>
</div>
</div>   
<? $j++; }}?>

<? if(@in_array('editor',$option)){
$r='';$j=0;
$ttl=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='editor' and sub_id='0' order by id ASC ");
while($opt=$db->getQuery($ttl)){ $r[]=$opt['title'];}
$qry1=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='editor' $cnd order by id ASC"); 
while($s= $db->getQuery($qry1)){?>
<div class="contenttitle2">
<h3><?=$r[$j]?></h3>
</div>
                    
<div>
<div>
<textarea  name="e<?=$s['id']?>[]" class="ckeditor"><?=stripslashes($s['content'])?></textarea>
</div>
</div> <br /><br />
<? $j++; }}?>

<? if(@in_array('img',$option)){
$r='';$j=0; $q='';
$ttl=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='img' and sub_id='0' order by id ASC ");
while($opt=$db->getQuery($ttl)){ $r[]=$opt['title']; $q[]=$opt['options']; }

$qry1=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' and forms='img' $cnd order by id ASC "); 
while($s= $db->getQuery($qry1)){ $options=explode('|',$q[$j]);?>
<div class="contenttitle2">
<h3><?=ucwords($r[$j])?></h3>
</div>
<div>   
<div>

<table width="100%" border="0">
<tr>
<td>&nbsp;</td>
<? if($options[1]=='2' || $options[1]=='3'){?><td >Video ID</td><? }?>
<? if($options[1]=='1' || $options[1]=='3'){?><td >Image</td><? }?>
<td><? if($options[2]=='1'){?>Title<? }?></td>
<!--<td>Hide</td>-->
</tr>

<?
$cnt=array_filter(explode('||',$s['content']));
$cnt2=array_filter(explode('||',$s['content2']));
for($i=0; $i< count($cnt); $i++){
$ext=explode('.',$cnt[$i]);
$vid='';$img='';$tit='text'; 
if(!in_array($ext[1],explode(',',img_ext))){ $vid=$cnt[$i]; } else { $img=$cnt[$i]; }?>
<tr>
<td width="10%">&nbsp;</td>

<!--video-->
<? if($options[1]=='2' || $options[1]=='3'){?><td>
<input name="v<?=$s['id']?>[]" type="text" style="width:100px;" value="<?=$vid?>" onkeyup="dsbl(this.value,'h<?=$s['id'].$i?>')" /></td><? } else {?>
<input name="v<?=$s['id']?>[]" type="hidden" style="width:100px;" value="<?=$vid?>" /><? }?>

<!--img-->
<? if($options[1]=='1' || $options[1]=='3'){?>
<td>
<input name="im<?=$s['id']?>[]" type="file" />
<? if($img!=''){?><img src="<?=img_path.$img?>" width="20px;" />
<input name="v<?=$s['id']?>[]" type="hidden" id="h<?=$s['id'].$i?>" value="<?=$img?>" />
<? }?>
</td>
<? }?>

<!--title-->
<? if($options[2]!='1'){$tit='hidden';}?>
<td><input name="it<?=$s['id']?>[]" type="<?=$tit?>" style="width:180px;" value="<?=ucwords($cnt2[$i])?>"  /></td>
<!--<td><input type="checkbox" name="hide" value="1" /></td>-->
</tr>

<? } if($s['content']==''){?>
<tr>
<td width="10%">&nbsp;</td>

<!--video-->
<? if($options[1]=='2' || $options[1]=='3'){?><td>
<input name="v<?=$s['id']?>[]" type="text" style="width:100px;"/></td><? }else{ ?>
<input name="v<?=$s['id']?>[]" type="hidden" style="width:100px;"/><? }?>

<!--img-->
<? if($options[1]=='1' || $options[1]=='3'){?><td>
<input name="im<?=$s['id']?>[]" type="file" /></td><? }?>

<!--title-->
<td>
<? $tit='text'; if($options[2]!='1'){$tit='hidden';}?>
<input name="it<?=$s['id']?>[]" type="<?=$tit?>" style="width:180px;"  />
</td>
</tr>
<? }?>
</table>
<span id="img<?=$s['id']?>"></span>
<? if($options[0]=='0'){?>
<table width="100%" border="0">
<tr>
<td width="10%">&nbsp;</td>
<td><button onClick="add_button('img','<?=$s['id']?>','<?=$q[$j]?>'); return false;">Add</button><span id="load<?=$s['id']?>"></span></td>
</tr>
</table>
<? }?>
</div>
</div> 
<? $j++; }}?>

<? if(@in_array('seo',$option)){?><br  />	
<div class="contenttitle2">
<h3>SEO Content</h3>
</div> 
<p>
<label>Page Meta Title</label>
<span class="field"><input type="text" name="meta_title" value="<?=$seo[2]?>" class="longinput" /></span>
</p>                         
<p>
<label>Page Meta Keywords</label>
<span class="field"><input type="text" name="meta_keywords" id="tags" value="<?=$seo[0]?>" class="longinput" /></span>
</p>                        
<p>
<label>Page Meta Description</label>
<span class="field"><textarea name="meta_description" cols="80" rows="5" class="longinput"><?=$seo[1];?></textarea></span>
</p>
<? }?>                    
                    
</div>
<br /><br /><br />
                
                <div class="one_third last dashboard_right">            
                    <div class="contenttitle2 nomargintop">
                        <h3>Publish</h3>
                    </div>
                    <ul class="toplist">
                        
						<li>
                            <div>
							 <?php $staTus=$db->runQuery("select * from ".FORM." where category_id='$_REQUEST[forms]' ");
                                   $daTa=$db->getQuery($staTus);?>

                                <span class="three_fourth">
                                    <span class="left">
                                        <span class="title">Status</span>
                                        <select class="longinput" style="width:100%;" name="status">
										  <option <?php if($status=='active')echo 'selected';?> value="active">Active</option>
										  <option <?php if($status=='inactive')echo 'selected';?> value="inactive">Inactive</option>
										  </select>
                                    </span><!--left-->
                                </span>
                                <br clear="all" />
                            </div>
                        </li>
						
						
                       
                        <li>
                            <div>
                                <span class="three_fourth">
                                    <span class="left">
                                        <span class="title">Modified Date</span>
                                        <span class="desc"><?=$view['page_modified']?></span>
                                    </span><!--left-->
                                </span>
                                <br clear="all" />
                            </div>
                        </li>
                    </ul>
<? }//subpages?>
	<p class="stdformbutton">
		<button  class="submit radius2" onclick="return inv()"><span id="pbl">Publish Page</span></button>
		<span id="publish1"></span>
		<input name="type" type="hidden" value="<?=$d['type']?>" />
		<input name="id" type="hidden" value="<?=$_REQUEST['forms']?>" />
        <input name="sub_id" type="hidden" value="<?=$_REQUEST['sub_id']?>" />
       
        <? if($act){?>
        <input type="hidden" name="admin"value="add-subpage" />
        <? }else{?>
        <input type="hidden" name="admin"value="update_pages" />
        <? }?> 
        <input name="goto" type="hidden" value="<?=$d['goto']?>" />
        <input name="options1" type="hidden" value="<?=$d['options']?>" />
	 </p>
                        </form>  
<? if(in_array('ajax_upload',$option)){?>

                    <div class="widgetbox">
                        <div class="title"><h3>Image Upload</h3></div>
                        <p>
							<?  $load->ajax_upload->image_upload($_REQUEST['forms'].$_REQUEST['sub_id']); ?>
						</p>
                        <!--<p>
                            <strong>Menu Order</strong><br />
                            <input class="longinput" name="menu_order" value="<?=$view['menu_order']?>" type="text" />
                        </p>-->
                    </div>
                    <? }?>
                    
                </div>            
              
        </div>
	</div>   
</div>

</body>
</html>
