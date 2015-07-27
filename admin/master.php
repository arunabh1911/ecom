<?
//img-> single/muliple-1/0 | img,video,img/vido-1/2/3 | title-1/0 |
include('header.php');
$htitle='style="display:none;"';
$hdate='style="display:none;"';
$htextbox='style="display:none;"';
$heditor='style="display:none;"';
$himg='style="display:none;"';
if($_REQUEST['id']){
	$qry=$db->runQuery("select * from ".CATEGORY." where page_id='$_REQUEST[id]' ");
	$d= $db->getQuery($qry);
	@$option=explode(",",$d['options']);
	if(@in_array('title',$option)){$htitle='';}
	if(@in_array('date',$option)){$hdate='';}
	if(@in_array('textbox',$option)){$htextbox='';}
	if(@in_array('editor',$option)){$heditor='';}
	if(@in_array('img',$option)){$himg='';}
	@$setting = json_decode(stripslashes($d['setting']), TRUE);
}
function RecursiveCat($pid,$sel)
{
$db = new myDBC();
static $level=0;
static $strid="";
static $strname="";

$sql=$db->runQuery("select * from ".CATEGORY." where parent_id =".$pid." ");
	while($row=$db->getQuery($sql))
	{
		$id=$row['page_id'];
		$level--;
		$pad="";
	
		for($p=1;$p<($level*-1);$p++) $pad.="&nbsp;&nbsp;&nbsp;> ";
		$ys=''; if($sel==$row['page_id']){ $ys='selected';}
		$strname.='<option '.$ys.' value="'.$row['page_id'].'">'.$pad.ucwords($row['page_name']).'</option>';
		$rid=RecursiveCat($id,$sel);
		$strid[]=$row['page_id'];
		$level++;
	}
return $strname;
}
?>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<script>
var http = false;
if(navigator.appName == "Microsoft Internet Explorer"){
http = new ActiveXObject("Microsoft.XMLHTTP");
}else{http = new XMLHttpRequest();}
	
function add_box(name,val)
{
	http.abort();
	http.open("GET", "adm-action.php?act=ajax_create&name="+name+"&val="+val, true);		
	http.onreadystatechange=function()
	{
		if(http.readyState == 4)
		{
			document.getElementById(name).innerHTML= http.responseText;
			jQuery('input:checkbox, input:radio, select.uniformselect, input:file').uniform();
		}
	}
	 http.send(null);
}
function chk(nm)
{
	if(nm=='gallery')
	{
		$('.hdd').hide();
	}
	else
	{
		$('.hdd').show();
	}
}
window.onload = function()
{
	jQuery('input:checkbox, input:radio, select.uniformselect, input:file').uniform();
	<? if(@in_array('gallery',$option)){?> $('.hdd').hide(); <? }?>
}
</script>
    <div class="centercontent">
        <div class="pageheader notab">
            <h1 class="pagetitle">Create</h1>
            <span class="pagedesc"></span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>


            <form class="stdform stdform2" action="adm-action.php" method="post" enctype="multipart/form-data">

	    <div class="two_third dashboard_left"> 
	
	<p>
		<label>Select <small></small></label>		
		<span class="field">
        <? if($_REQUEST['id']){ echo ucwords($d['type']); } else {?>
		<select name="selection" id="selection" class="mediuminput" required onchange="chk(this.value)" >
		<option value="">Select</option>
		<option value="single page">Single Page</option>
		<option value="multiple page">Multiple Page</option>
        <option value="gallery">Gallery</option>
		</select>
        <? }?>
		</span>					
	</p>
    
    
    <p>
		<label>Page Name </label>		
		<span class="field"><input type="text" name="page_name" class="mediuminput" value="<?=$d['page_name']?>" required="required" /></span>					
	</p>
    
    
    <p>
		<label>Category <small></small></label>		
		<span class="field">
        <select name="category">
        <option value="0">None</option>
        <?=RecursiveCat('0',$d['parent_id']);?>
        </select>
		</span>					
	</p>
					               	
	<p>
		<label>Go To</label>
		<span class="field"><input type="text" name="goto" class="mediuminput" value="<?=$d['goto']?>" required="required" /></span> 						
	</p>
	
						               	
	<p>
		<label>Folder</label>
		<span class="field"><input type="text" name="folder" class="mediuminput" value="<?=$d['folder']?>" /></span> 						
	</p>
	
	
   <? if($_REQUEST['id']){?>
   <p>
		<label>Slug</label>
		<span class="field"><input type="text" name="slug" class="mediuminput" value="<?=$d['slug']?>" required="required" /></span> 						
	</p>
   <? }?> 
    
        
     <p>
		<label>Add-ons</label>
		<span class="field">
<input type="checkbox" <? if(@in_array('header',$option))echo 'checked';?> name="header" value="header" /> headerpage
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" <? if(@in_array('footer',$option))echo 'checked';?> name="footer" value="footer" /> footerpage
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" <? if(@in_array('seo',$option))echo checked;?> name="seo" value="seo" /> seo
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" <? if(@in_array('subpage',$option))echo checked;?> name="subpage" value="subpage" /> sub pages
        </span> 
      		
	</p>


<p>
    <label>Session</label>
    <span class="field">
<input type="checkbox" <? if(@in_array('session',$option))echo checked;?> name="sess" value="session" /> check session
<? $userType = unserialize( userType ); 
?>
&nbsp;&nbsp;
<select name="tpe" style="width:100px;">
  <option value="0">Select</option>
<? for($y=0; $y < count($userType); $y++ ){?>
  <option <? if($setting['userType'] == key($userType))echo 'selected';?> value="<?=key($userType)?>"><?=ucwords(key($userType))?></option>
<? next($userType); }?>
</select>
    </span> 
</p>


<? if($_REQUEST['id']) {?>
     <p>
		<label>Email</label>
		<span class="field">
<?
$sql = $db->runQuery("select * from ".EMAILTEMP." where pageId = '$d[page_id]' ");
while($qry=$db->getQuery($sql)){?> <?="".ucwords($qry['title'])." - ".ucwords($qry['type']);?> &nbsp;
<a href="javascript:void(0)" onclick="var r=confirm('Are You Sure'); if(r){document.getElementById('duser').value='<?=$qry['id']?>'; document.delmail.submit() } "  ><img style="cursor: pointer" src="images/del.png" width="10px" /></a>
<br /> 
<? }?>        
&nbsp;
       </span> 
      		
	</p>
<? }?>   			                                                
	<p>
		<label>Page Title</label>
		<span class="field">
		<input <? if(!$htitle) echo checked;?> type="radio" name="title" onclick="$('#title1').show()" value="title" /> Yes &nbsp; &nbsp;
		<input <? if($htitle) echo checked;?> type="radio" name="title" onclick="$('#title1').hide()" value="0" /> No &nbsp; &nbsp;
		<span <?=$htitle?> id="title1"><br /><br />
<?
$qry1=$db->runQuery("select id,category_id,forms,title,options from ".FORM." where category_id='$_REQUEST[id]' and forms='title' and sub_id='0' ");
@$forms=$db->getQuery($qry1);?>
<input type="text" name="title1" class="mediuminput" value="<?=$forms['title']?>"/>
<input type="hidden" name="titleid" value="<?=$forms['id']?>" />

		</span>
		</span>
	</p>
	
    
	<p class="hdd">    
		<label>Date</label>
		<span class="field">
		<input <? if(!$hdate) echo checked;?> type="radio" name="date" onclick="$('#date1').show()" value="date" /> Yes &nbsp; &nbsp;
		<input <? if($hdate) echo checked;?> type="radio" name="date" onclick="$('#date1').hide()" value="0" /> No &nbsp; &nbsp;
		<span <?=$hdate?> id="date1"><br /><br />        
<?
if(!$hdate){
$qry1=$db->runQuery("select id,category_id,forms,title,options from ".FORM." where category_id='$_REQUEST[id]' and forms='date' and sub_id='0' ");
while($forms=$db->getQuery($qry1)){?>
		<input type="text" name="edate[]" class="smallinput" value="<?=$forms['title']?>" />
        <input type="hidden" name="dateid[]" value="<?=$forms['id']?>" /><br />
<? } echo "<br />"; }?>

		<input type="text" name="date1" class="smallinput" placeholder="no of dates" style="width:80px;" onkeyup="add_box('sdate',this.value)" /><br /><br />
		<span id="sdate"></span>
		
		</span>
		</span>
	</p>
	
	<p class="hdd">
		<label>Textbox</label>
		<span class="field">
		<input <? if(!$htextbox) echo checked;?> type="radio" name="text" onclick="$('#text1').show()" value="textbox" /> Yes &nbsp; &nbsp;
		<input <? if($htextbox) echo checked;?> type="radio" name="text" onclick="$('#text1').hide()" value="0" /> No &nbsp; &nbsp;
		<span <?=$htextbox;?> id="text1"><br /><br />
		
<?
if(!$htextbox){
$qry1=$db->runQuery("select id,category_id,forms,title,options from ".FORM." where category_id='$_REQUEST[id]' and forms='textbox' and sub_id='0' order by id ");
while($forms=$db->getQuery($qry1)){$idd=$forms['id'];?>
		<input type="text" name="etextbox[]" class="smallinput" value="<?=$forms['title']?>" />
         <input type="hidden" name="textboxid[]" value="<?=$forms['id']?>" />
		&nbsp;&nbsp;&nbsp;
		<input <? if($forms['options']=='1') echo checked; ?> type="radio" name="ftextbox<?=$idd?>" value="1" /> Single &nbsp; &nbsp;
		<input <? if($forms['options']=='0') echo checked; ?> type="radio" name="ftextbox<?=$idd?>" value="0" /> Multiple &nbsp; &nbsp;<br />
<? } echo "<br />"; }?>

		<input type="text" name="text1" class="smallinput" placeholder="no of textbox" style="width:80px;" onkeyup="add_box('stextbox',this.value)" /><br /><br />
		<span id="stextbox"></span>
		
		</span>
		</span>
	</p>
	
	<p class="hdd">
		<label>Texteditor</label>
		<span class="field">
		<input <? if(!$heditor) echo checked;?> type="radio" name="editor" onclick="$('#editor1').show()" value="editor" /> Yes &nbsp; &nbsp;
		<input <? if($heditor) echo checked;?> type="radio" name="editor" onclick="$('#editor1').hide()" value="0" /> No &nbsp; &nbsp;
		<span <?=$heditor?> id="editor1"><br /><br />
		
<?
if(!$heditor){
$qry1=$db->runQuery("select id,category_id,forms,title,options from ".FORM." where category_id='$_REQUEST[id]' and forms='editor' and sub_id='0' ");
while($forms=$db->getQuery($qry1)){?>
		<input type="text" name="eeditor[]" class="smallinput" value="<?=$forms['title']?>" />
        <input type="hidden" name="editorid[]" value="<?=$forms['id']?>" /><br />
<? } echo "<br />"; }?>

		<input type="text" name="editor1" class="smallinput" placeholder="no of editor" style="width:80px;" onkeyup="add_box('seditor',this.value)" /><br /><br />
		<span id="seditor"></span>
		<br />
		<input <? if(@in_array('ajax_upload',$option)) echo checked; ?> type="checkbox" name="ajax_upload" value="ajax_upload" /> &nbsp; Ajax Upload Image
		</span>
		</span>
	</p>
 
		  
    <p class="hdd">
		<label>Images/Videos</label>
		<span class="field">
		<input <? if(!$himg) echo checked;?> type="radio" name="img" onclick="$('#img1').show()" value="img" /> Yes &nbsp; &nbsp;
		<input <? if($himg) echo checked;?> type="radio" name="img" onclick="$('#img1').hide()" value="0" /> No &nbsp; &nbsp;		
		<span <?=$himg?> id="img1"><br /><br />
		
<?
if(!$himg){
$qry1=$db->runQuery("select id,category_id,forms,title,options from ".FORM." where category_id='$_REQUEST[id]' and forms='img' and sub_id='0' ");
while($forms=$db->getQuery($qry1)){ $opt=explode('|',$forms['options']);$idd=$forms['id'];?>
<input type="text" name="eimg[]" class="smallinput" value="<?=$forms['title']?>" />
<input type="hidden" name="imgid[]" value="<?=$forms['id']?>" />&nbsp;&nbsp;&nbsp;

<input <? if($opt[0]=='1') echo checked; ?> type="radio" name="fimg<?=$idd?>" value="1" /> Single &nbsp; &nbsp;
<input <? if($opt[0]=='0') echo checked; ?> type="radio" name="fimg<?=$idd?>" value="0" /> Multiple &nbsp; &nbsp;
<br /><br />
<input <? if($opt[1]=='1') echo checked; ?> type="radio" name="gimg<?=$idd?>" value="1" /> Image &nbsp; &nbsp;
<input <? if($opt[1]=='2') echo checked; ?> type="radio" name="gimg<?=$idd?>" value="2" /> Video &nbsp; &nbsp;
<input <? if($opt[1]=='3') echo checked; ?> type="radio" name="gimg<?=$idd?>" value="3" /> Img/Video &nbsp; &nbsp;  
<input <? if($opt[2]=='1') echo checked; ?> name="timg<?=$idd?>" type="checkbox" value="1" />&nbsp; Title
<br /><br /><br />
<? } echo "<br />"; }?>

		<input type="text" name="editor1" class="smallinput" placeholder="no of images" style="width:80px;"onkeyup="add_box('simg',this.value)" /><br /><br />
		<span id="simg"></span>
		
		</span>
		</span> 						
	</p>                                     
                 
                    <p class="stdformbutton">
                        <button class="submit radius2">Publish Page</button>
						<input type="hidden" name="admin" value="add_master" />
                        <input name="id" type="hidden" value="<?=$d['page_id']?>" />
                    </p>
                        </form> 
                        
                        <form action="adm-action.php" method="post" name="delmail">
                        <input name="user" id="duser" type="hidden" />
                        <input type="hidden" name="admin" value="del-mail" />
                        </form>

                     <br /><br /><br /><br />
                </div>          
              
			  
			 
        </div>
	</div>   
</div>
<!--<script src="ckeditor/ckeditor.js" type="text/javascript"></script>-->
</body>
</html>
