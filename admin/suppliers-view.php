<? 
include'header.php';
$user = $db->getQuery($db->runQuery("select * from ".SUPPLIER." where supp_id = '".$_REQUEST['userId']."' "));

@$sql = $db->runQuery("SELECT * FROM ".BUILDER."  where userId='".$_REQUEST['userId']."' group by formId ORDER BY id DESC");

@$sql1 = $db->runQuery("SELECT * FROM ".BUILDER."  where userId='".$_REQUEST['userId']."' group by formId  ORDER BY id DESC");


function getTextfiels($label,$req,   $txtfname  , $value) {?>

<p>
	<label><?=ucwords($label)?></label>
	<span class="field">
	<input type="text"  value="<?=$value?>" name="<?=$txtfname?>" class="largeinput" />
	</span>
</p>
<? }
function getTextarea($label,$req, $txtareaname , $value) { ?>

<p>
	<label><?=ucwords($label)?></label>
	<span class="field">
	<textarea  cols="" name="<?=$txtareaname?>" rows="" ><?=$value?></textarea>
	</span>
</p>
<? } 
function getImage($label,$req, $imgname ,$value) { ?>

<p>
	<label><?=ucwords($label)?></label>
	<span class="field">
	<input type="file" name="<?=$imgname?>" />
    <? if($value){ ?>
     <a href="<?=img_path.$value;?>" target="_blank">View Image </a>
     <input type="hidden" name="<?='pre_'.$imgname?>" value="<?=$value;?>" />
     <? }?>
	</span>
    
   
</p>
<? }
function getCheckbox($label,$req,$sub, $checkname ,$value) { $sub = explode(',',$sub);
$getvalue=explode(',',$value);
//print_r($getvalue);
 ?>

<p>
	<label><?=ucwords($label)?></label>
	<span class="field">
	<? for($i=0; $i<count($sub); $i++ ) { ?>
    
	<input <? if(in_array($sub[$i],$getvalue)) echo "checked";?> type="checkbox" value="<?=$sub[$i]; ?>" name="<?=$checkname?>" /> <?=$sub[$i]; ?> &nbsp;&nbsp;
	<? }?>
	</span>
</p>
<? }
function getRadio($label,$req,$sub, $radioname ,$value) { $sub = explode(',',$sub);
 $getvalue=explode(',',$value);
 ?>

<p>
	<label><?=ucwords($label)?></label>
	<span class="field">
	<? for($i=0; $i<count($sub); $i++ ) { ?>
	<input <? if(in_array($sub[$i],$getvalue)) echo "checked";?> type="radio" value="<?=$sub[$i]; ?>" name="<?=$radioname?>" /> <?=$sub[$i]; ?> &nbsp;&nbsp;
	<? }?>
	</span>
</p>
<? }
function getList($label,$req,$sub, $listname ,$value) { $sub = explode(',',$sub); ?>

<p>
	<label><?=ucwords($label)?></label>
	<span class="field">
	<select name="<?=$listname?>" >
	  <option value="">no selection</option>
	<? for($i=0; $i<count($sub); $i++ ) { ?>
	  <option <? if($value == $sub[$i]) echo "selected";?> value="<?=$sub[$i]; ?>"><?=ucwords($sub[$i]); ?></option>
	 <? }?>
	</select>
	
	</span>
</p>
<? }
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
            <h1 class="pagetitle">User From</h1>
           <!-- <span class="pagedesc">your site settings</span>-->
       
            <ul class="hornav">
                <li class="current"><a href="#general ">General</a></li>
                <? while(@$view = $db->getQuery($sql)) {
					?>
               <li ><a href="#<?=ucwords($view['formId'])?>"><?=ucwords($view['name'])?></a></li> 
               <? }?> 
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
            <label>User  Id</label>
            <span class="field">
            <span><?=$user['supp_id'];?></span>
            </span>
        </p>
        
         <p>
            <label>Contact Person</label>
             <span class="field">
            <span><?=$user['supplier_name'];?> </span>
            </span>
         </p>
        
        <p>
            <label>Registration Date</label>
             <span class="field">
             <span><?=date('d M Y',strtotime($user['date_of_reg']));?></span>
            </span>
        </p>          
			
            		
<!-- <p>
<span class="field">
<input type="hidden" name="admin" value="setting" />

<input id="submit" type="submit" style="display:none;" />
<button class="submit radius2" id="pry" onClick="document.getElementById('submit').click();return false;" 
style="width:200px;"> SAVE  </button>
</span>
</p>-->	   
			                       
    </div>
</div>

	                       
  

</form>

 <? while(@$view1 = $db->getQuery($sql1)) {?>
 
  <form class="stdform stdform2" action="adm-action.php" method="post" enctype="multipart/form-data">
 
<div class="two_third dashboard_left"> 		
  <div id="<?=ucwords($view1['formId'])?>" class="subcontent" style="display: none">	
     <? 

@$fieldlist = $db->runQuery("SELECT * FROM ".BUILDER."  where formId='".$view1['formId']."' ");
  while(@$fields = $db->getQuery($fieldlist))
 //print_r($fields);
   {
	   
if($fields['type'] == 'textfield')
		getTextfiels( $fields['label'] , $fields['require'] , str_replace(' ', '', $fields['label'].'_'.$fields['id']) , $fields['field_answer'] );
		

if($fields['type'] == 'textarea')
{
		getTextarea( $fields['label'] , $fields['require'] , str_replace(' ', '', $fields['label'].'_'.$fields['id']) , $fields['field_answer'] ); 
		
}

if($fields['type'] == 'image')
getImage( $fields['label'] , $fields['require'] , str_replace(' ', '', $fields['label'].'_'.$fields['id'].'[]') , $fields['field_answer'] );

if($fields['type'] == 'checkbox')
getCheckbox( $fields['label'] , $fields['require'], $fields['subLabel'] , str_replace(' ', '', $fields['label'].'_'.$fields['id'].'[]') , $fields['field_answer'] );

if($fields['type'] == 'radio')
		getRadio( $fields['label'] , $fields['require'], $fields['subLabel'] , str_replace(' ', '', $fields['label'].'_'.$fields['id']) , $fields['field_answer'] );

if($fields['type'] == 'list')
		getList( $fields['label'] , $fields['require'], $fields['subLabel'] , str_replace(' ', '', $fields['label'].'_'.$fields['id']) , $fields['field_answer'] );
 
  }
			   
	?>
    
    <p>
<span class="field">
<input type="hidden" name="admin" value="updateform-answer" />
<input type="hidden" name="userId" value="<?=$_REQUEST['userId']?>" />
<input type="hidden" name="formId" value="<?=$view1['formId']?>" />
<input id="<?=$view1['name']?>" type="submit" style="display:none;" />

<button class="submit radius2" id="pry" onClick="document.getElementById('<?=$view1['name']?>').click();return false;" 
style="width:200px;"> SAVE  </button>
</span>
</p>		                       
    </div>
</div>

</form>
 <? }?>  
 







            </div>
        
        </div>
        
        <br clear="all" />
        
	</div>
    
    
</div>
</body>
</html>
