<?php include('header.php');
if(@$_REQUEST['id'])
{
	$data = $db->getQuery($db->runQuery("select * from ".BUILDER." where formId = '".$_REQUEST['id']."' "));
}

############################################################################
function getTextfiels($label,$req) { $nm = substr(number_format(time() * rand(),0,'',''),0,4);
$ns = ($req == 'yes') ? 'yes' : 'no' ;
 ?>
<p>
	<label>Text Field &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="textfield" />
	<input name="lbl[]" type="text" placeholder="Label" value="<?=$label?>" /> <br />
	<input type="checkbox" <? if($req == 'yes')echo 'checked'; ?> onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="<?=$ns?>" /> Required
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	</span>
</p>
<? }
############################################################################
function getTextarea($label,$req) { $nm = substr(number_format(time() * rand(),0,'',''),0,4);
$ns = ($req == 'yes') ? 'yes' : 'no' ;  ?>
<p>
	<label>Textarea Field &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="textarea" />
	<input name="lbl[]" type="text" placeholder="Label" value="<?=$label?>" /> <br />
	<input type="checkbox" <? if($req == 'yes')echo 'checked'; ?> onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="<?=$ns?>" /> Required
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	</span>
</p>
<? }
############################################################################
function getImage($label,$req) { $nm = substr(number_format(time() * rand(),0,'',''),0,4);
$ns = ($req == 'yes') ? 'yes' : 'no' ;  ?>
<p>
	<label>Image &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="image" />
	<input name="lbl[]" type="text" placeholder="Label" value="<?=$label?>" /> <br />
	<input type="checkbox" <? if($req == 'yes')echo 'checked'; ?> onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="<?=$ns?>" /> Required
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	</span>
</p>
<? }
############################################################################
function getCheckbox($label,$req, $sub1) { $nm = substr(number_format(time() * rand(),0,'',''),0,4); 
$ns = ($req == 'yes') ? 'yes' : 'no' ; $sub = explode(',',$sub1); ?>
<p>
	<label>Checkbox Group &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="checkbox" />
	<input type="checkbox" <? if($req == 'yes')echo 'checked'; ?> onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="<?=$ns?>" /> Required
	<input name="lbl[]" type="text" placeholder="Title" value="<?=$label?>" /> <br /><br />
	
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	
	<? for($i=0; $i<count($sub); $i++ ){?>
	<i><input name="i<?=$nm?>[]" type="text" class="mediuminput" value="<?=$sub[$i];?>" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
	<? }?>
	
	<span id="<?=$nm?>"></span>
	<span style="cursor: pointer;" onclick="getSub('<?=$nm?>')"><strong><font size="+2">+</font></strong></span>
	

	</span>
</p>
<? }
############################################################################
function getRadio($label,$req, $sub1) { $nm = substr(number_format(time() * rand(),0,'',''),0,4); 
$ns = ($req == 'yes') ? 'yes' : 'no' ; $sub = explode(',',$sub1); ?>
<p>
	<label>Radio Group &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="radio" />
	<input type="checkbox" <? if($req == 'yes')echo 'checked'; ?> onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="<?=$ns?>" /> Required
	<input name="lbl[]" type="text" placeholder="Title" value="<?=$label?>" /> <br /><br />
	
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	
	<? for($i=0; $i<count($sub); $i++ ){?>
	<i><input name="i<?=$nm?>[]" type="text" class="mediuminput" value="<?=$sub[$i];?>" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
	<? }?>
	
	<span id="<?=$nm?>"></span>
	<span style="cursor: pointer;" onclick="getSub('<?=$nm?>')"><strong><font size="+2">+</font></strong></span>
	

	</span>
</p>
<? }
############################################################################
function getList($label,$req, $sub1) { $nm = substr(number_format(time() * rand(),0,'',''),0,4); 
$ns = ($req == 'yes') ? 'yes' : 'no' ; $sub = explode(',',$sub1); ?>
<p>
	<label>Radio Group &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="list" />
	<input type="checkbox" <? if($req == 'yes')echo 'checked'; ?> onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="<?=$ns?>" /> Required
	<input name="lbl[]" type="text" placeholder="Title" value="<?=$label?>" /> <br /><br />
	
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	
	<? for($i=0; $i<count($sub); $i++ ){?>
	<i><input name="i<?=$nm?>[]" type="text" class="mediuminput" value="<?=$sub[$i];?>" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
	<? }?>
	
	<span id="<?=$nm?>"></span>
	<span style="cursor: pointer;" onclick="getSub('<?=$nm?>')"><strong><font size="+2">+</font></strong></span>
	

	</span>
</p>
<? }?>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/charCount.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>
<script type="text/javascript" src="js/custom/editor.js"></script>

<script>
function val()
{
	if(document.getElementById('name').value=='')
	{
		alert('!! Enter  Name !!');
		document.getElementById('name').focus();
		return false;
	}
	
	if(document.getElementById('report').value=='')
	{
		alert('!! Select Report !!');
		document.getElementById('report').focus();
		return false;
	}
}

function getField(fld) {
	
		$.ajax({
		url: 'ajax.php',
		type: 'POST',
		data: { fld: fld, acts: 'getField' },
		success: function(data) {
			//sid = (data.split("||"));
			$('#dat').append(data);
			$('#field').val(0);
			
			
		}
	});
}
function getSub(id) {
	
		$.ajax({
		url: 'ajax.php',
		type: 'POST',
		data: { id: id, acts: 'getSub' },
		success: function(data) {
			$('#'+id+'').append(data);
		}
	});
}
</script>
      
    <div class="centercontent">
    <span id="ttst"></span>
        <div class="pageheader notab">
            <h1 class="pagetitle">
              <? if(@$_REQUEST['id']) echo 'Edit'; else echo 'Add'; ?> Builder</h1>
            <span class="pagedesc"></span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">


<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>

 <form class="stdform stdform2" action="adm-action.php" method="post" onsubmit="return val()">
                <div class="two_third dashboard_left">                    	
<p>
<label>Form Name</label>
<span class="field">
<input type="text" name="name" id="name" value="<?=@ucwords($data['name'])?>" class="mediuminput" />
</span>
</p>




<p>
<label>Add New Field</label>
<span class="field">
<select name="field" id="field" onchange="getField(this.value)">
  <option value="">Select</option>
   <option value="textfield">Text Field</option>
   <option value="textarea">Textarea</option>
   <option value="images">Images</option>
   <option value="checkbox">Checkbox</option>
   <option value="radio">Radio</option>
   <option value="list">Select List</option>
</select>
</span></p>


<p></p>
<br />

<? if($_REQUEST['id']){
$bl1 = $db->runQuery("select * from ".BUILDER." where formId = '".$_REQUEST['id']."' ");
while($buil= $db->getQuery($bl1)){
	echo '<p></p>';
	if($buil['type'] == 'textfield')
		getTextfiels( $buil['label'] , $buil['require'] );
	
	if($buil['type'] == 'textarea')
		getTextarea( $buil['label'] , $buil['require'] ); 
	
	if($buil['type'] == 'image')
		getImage( $buil['label'] , $buil['require'] );
		
	if($buil['type'] == 'checkbox')
		getCheckbox( $buil['label'] , $buil['require'], $buil['subLabel']  );
	
	if($buil['type'] == 'radio')
		getRadio( $buil['label'] , $buil['require'], $buil['subLabel']  );
		
	if($buil['type'] == 'list')
		getList( $buil['label'] , $buil['require'], $buil['subLabel']  );
		
		?>
<? }}?>

<span id="dat"></span>

                  <p class="stdformbutton">                     
						<? if(@$_REQUEST['id']=='' && $_REQUEST['userId']!=""){?>
                        <button class="submit radius2">&nbsp;&nbsp; Save &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="builder-form" />
                        <input name="userid" type="hidden" value="<?=$_REQUEST['userId']?>" />
                        <? }else{?>
                         <button class="submit radius2">&nbsp;&nbsp;Update &nbsp;&nbsp;</button>
                        <input type="hidden" name="admin" value="builder-edit" />
                        <input name="id" type="hidden" value="<?=$_REQUEST['id']?>" />
                         <input name="userid" type="hidden" value="<?=$data['userId']?>" />
                        <? }?>
				  </p>                      

                </div>
            </form>        
        </div>
	</div>   
</div>
</body>
</html>
