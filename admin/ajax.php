<?php
$baseurl = getcwd().'/../';
require $baseurl.'index.php';
$db = new myDBC();
$load = new loader();
$load->model('site_function');

$i = $_POST['id']; //print_r($_POST);

/* sort form */



if ($_POST['update'] == "update"){
	//print_r($_REQUEST);die;
	//print_r(implode(',',$_REQUEST['arrayorder']));die;
	//$array	= $_POST['arrayorder'];
	//$count = 1;
	//echo  "UPDATE wkends_workorder SET formId = '" . implode(',',$_REQUEST['arrayorder']) . "' WHERE uniqueId = '" . $_REQUEST['form']."'";die;
		//if($query = "UPDATE wkends_workorder SET formId = '" . implode(',',$_REQUEST['arrayorder']) . "' WHERE uniqueId = '" . $_REQUEST['form']."'")
		
		
		if($_REQUEST['re_form'])
		{
			
				if($db->runQuery("UPDATE wkends_workorder SET reassign_formid = '" . implode(',',$_REQUEST['arrayorder']) . "' WHERE id = '" . $_REQUEST['re_form']."'")){
				echo 'All saved! refresh the page to see the changes';}
				else
				{
				mysql_query($query) or die('Error, in form saving');	
				}
		}
		else
		{
			
				if($db->runQuery("UPDATE wkends_workorder SET formId = '" . implode(',',$_REQUEST['arrayorder']) . "' WHERE id = '" . $_REQUEST['form']."'")){
				echo 'All saved! refresh the page to see the changes';}
				else
				{
				mysql_query($query) or die('Error, in form saving');	
				}
		}
	
	
}



if($_POST['acts'] == 'table' ){ echo '||'; ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:0px;" class="stdtable stdtablecb">
<?
if($_POST['idd'] && $i == 0){
$data = $db->getQuery($db->runQuery("select * from ".JOBSUB." where id = '".$_POST['idd']."' "));
$type = explode(',',$data['type']);
$eqp = explode(',',$data['equip']);
$qty = explode(',',$data['qty']);
$rate = explode(',',$data['rate']);
for($i=0; $i< count($type); $i++){
?>
<tr>
<td width="200px">
<select name="eq[]" id="eq<?=$i?>" onchange="eqi(this.value,'<?=$i?>')" >
<option value="">Select Equipment Type</option>
<option <? if($type[$i] == 'equ')echo 'selected';?> value="equ">Equipment</option>
<option <? if($type[$i] == 'bil')echo 'selected';?> value="bil">Billable Item</option></select>
</td>

<td width="200px"><span id="ans<?=$i?>">
<?
$_POST['ans'] = $eqp[$i];
if($type[$i] == 'equ')
	$load->site_function->dropDown(ASSTYPE, 'ans[]', "status = 'active'  order by name" );
if($type[$i] == 'bil')
	$load->site_function->dropDown(BILL, 'ans[]', "status = 'active'  order by name" );
?>
</span></div></td>
<td width="80px"><input name="qty[]" value="1" readonly="readonly" class="smallinput" type="text" value="<?=$qty[$i]?>" ></td>
<td width="200px"><input name="rate[]" type="text" placeholder="$" value="<?=$rate[$i]?>" ></td>
</tr>
<? }}?>
<tr>
<td width="200px">
<select name="eq[]" id="eq<?=$i?>" onchange="eqi(this.value,'<?=$i?>')" >
<option value="">Select Equipment Type</option>
<option value="equ">Equipment</option>
<option value="bil">Billable Item</option></select>
</td>

<td width="200px"><span id="ans<?=$i?>"><input type="text"></span></div></td>
<td width="80px"><input name="qty[]" class="smallinput" value="1" readonly="readonly" type="text" ></td>
<td width="200px"><input name="rate[]" type="text" placeholder="$"></td>
</tr></table>

<? echo "||"; echo $i+1; }


if($_POST['acts'] == 'drop' ){ //print_r($_POST);
if($_POST['val'] == 'equ')
	$load->site_function->dropDown(ASSTYPE, 'ans[]', "status = 'active'  order by name" );
if($_POST['val'] == 'bil')
	$load->site_function->dropDown(BILL, 'ans[]', "status = 'active'  order by name" );
}

if($_POST['acts'] == 'getcity' ){
	$load->site_function->clas = 'style="width:248px;" ';
	$load->site_function->setName = 'name';
	$load->site_function->dropDown(COUNTRY, 'country', "stateId = '".$_POST['id']."' AND status = 'active'  order by name" ); 
}

if($_POST['acts'] == 'getWell' ){
	
	$data = $db->getQuery($db->runQuery("select * from ".WELL." where id = '".$_POST['id']."' "));
	$client = $load->site_function->getName($data['client']);
	$state = $load->site_function->state($data['state']);

	$country = $load->site_function->country($data['country']);
	echo "|$data[name]|$client|$data[afe]|$data[pn]|$data[weldDir]|$state|$country";
	die;
}

if($_POST['acts'] == 'getsubType' ){ if($i == ''){ echo "$i||"; $l=1; } ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:0px;width:100%;" class="stdtable stdtablecb">
<?
if($_POST['idd'] && $i == 0){
$data = $db->getQuery($db->runQuery("select * from ".JOBSUB." where id = '".$_POST['idd']."' "));
$type = explode(',',$data['type']);
$eqp = explode(',',$data['equip']);
$qty = explode(',',$data['qty']);
$rate = explode(',',$data['rate']);
$kk = count($type);
for($i=0; $i< count($type); $i++){
?>
<tr>
<td width="200px">
<!--<select name="eq[]" id="eq<?=$i?>" onchange="eqi(this.value,'<?=$i?>')" >
<option value="">Select Equipment Type</option>
<option <? if($type[$i] == 'equ')echo 'selected';?> value="equ">Equipment</option>
<option <? if($type[$i] == 'bil')echo 'selected';?> value="bil">Billable Item</option></select>-->
<? if($type[$i] == 'equ')echo 'Equipment'; if($type[$i] == 'bil')echo 'Billable'; ?>
<input name="eq[]" type="hidden" value="<?=$type[$i]?>" />
</td>

<td width="200px"><span id="ans<?=$i?>">
<?
if($type[$i] == 'equ') {
	$view = $db->getQuery($db->runQuery("select * from ".ASSTYPE." where id='".$eqp[$i]."' "));
	echo $view['name'];
	}
if($type[$i] == 'bil') {
	$view = $db->getQuery($db->runQuery("select * from ".BILL." where id='".$eqp[$i]."' "));
	echo $view['name'];
	}
?>
<input name="ans[]" type="hidden" value="<?=$eqp[$i]?>" />
</span></div></td>
<td width="80px"><input name="qty[]" readonly="readonly" class="smallinput" type="text" value="<?=$qty[$i]?>" ></td>
<!--<td width="200px"><input name="rate[]" type="text" placeholder="$" value="<?=$rate[$i]?>" ></td>-->
<input name="rate[]" type="hidden" value="<?=$rate[$i]?>" >
</tr>
<? }}?>
<tr>
<td width="200px">
<select name="eq[]" id="eq<?=$i?>" onchange="eqi(this.value,'<?=$i?>')" >
<option value="">Select Equipment Type</option>
<option value="equ">Equipment</option>
<option value="bil">Billable Item</option></select>
</td>

<td width="200px"><span id="ans<?=$i?>"><select></select></span></div></td>
<td width="80px"><input name="qty[]" class="smallinput" value="1" readonly="readonly" type="text" ></td>
<!--<td width="200px"><input name="rate[]" type="text" placeholder="$"></td>-->
</tr></table>

<? if($l == '1') { echo '||'; echo $i+1; }  } 


if($_POST['acts'] == 'getSub' ) {?>
	<i><input name="i<?=$_POST['id']?>[]" type="text" class="mediuminput" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
<? die; }

if($_POST['acts'] == 'getField' ) {
	
	if($_POST['fld'] == 'textfield')
		getTextfiels();
	if($_POST['fld'] == 'textarea')
		getTextarea();
	if($_POST['fld'] == 'images')
		getImage();
	if($_POST['fld'] == 'checkbox')
		getCheckbox();
	if($_POST['fld'] == 'radio')
		getRadio();
	if($_POST['fld'] == 'list')
		getList();
}


function getTextfiels() { $nm = substr(number_format(time() * rand(),0,'',''),0,4); ?>
<p>
	<label>Text Field &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="textfield" />
	<input name="lbl[]" type="text" placeholder="Label" /> <br />
	<input type="checkbox" onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="no" /> Required
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	</span>
</p>
<? }

function getTextarea() { $nm = substr(number_format(time() * rand(),0,'',''),0,4); ?>
<p>
	<label>Textarea Field &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="textarea" />
	<input name="lbl[]" type="text" placeholder="Label" /> <br />
	<input type="checkbox" onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="no" /> Required
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	</span>
</p>
<? }


function getImage() { $nm = substr(number_format(time() * rand(),0,'',''),0,4); ?>
<p>
	<label>Image &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="image" />
	<input name="lbl[]" type="text" placeholder="Label" /> <br />
	<input type="checkbox" onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="no" /> Required
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	</span>
</p>
<? }


function getCheckbox() { $nm = substr(number_format(time() * rand(),0,'',''),0,4); ?>
<p>
	<label>Checkbox Group &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="checkbox" />
	<input type="checkbox" onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="no" /> Required
	<input name="lbl[]" type="text" placeholder="Title" /> <br /><br />
	
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	
	<i><input name="i<?=$nm?>[]" type="text" class="mediuminput" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
	
	<span id="<?=$nm?>"></span>
	<span style="cursor: pointer;" onclick="getSub('<?=$nm?>')"><strong><font size="+2">+</font></strong></span>
	

	</span>
</p>
<? }

function getRadio() { $nm = substr(number_format(time() * rand(),0,'',''),0,4); ?>
<p>
	<label>Radio Group &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="radio" />
	<input type="checkbox" onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="no" /> Required
	<input name="lbl[]" type="text" placeholder="Title" /> <br /><br />
	
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	
	<i><input name="i<?=$nm?>[]" type="text" class="mediuminput" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
	
	<span id="<?=$nm?>"></span>
	<span style="cursor: pointer;" onclick="getSub('<?=$nm?>')"><strong><font size="+2">+</font></strong></span>
	

	</span>
</p>
<? }

function getList() { $nm = substr(number_format(time() * rand(),0,'',''),0,4); ?>
<p>
	<label>Select Group &nbsp;&nbsp; <span onclick="$(this).closest('p').remove()" style="cursor: pointer; color:#AB144D"><strong>X</strong></span> </label>
	<span class="field">
	<input name="typ[]" type="hidden" value="list" />
	<input type="checkbox" onclick="document.getElementById('r<?=$nm?>').value = this.checked ? 'yes' : 'no' " />
	<input name="req[]" type="hidden" id="r<?=$nm?>" value="no" /> Required
	<input name="lbl[]" type="text" placeholder="Title" /> <br /><br />
	
	<input name="naam[]" type="hidden" value="i<?=$nm?>" />
	
	<i><input name="i<?=$nm?>[]" type="text" class="mediuminput" /> <strong style="cursor: pointer;" onclick="$(this).closest('i').remove()">x</strong> <br /> </i> 
	
	<span id="<?=$nm?>"></span>
	<span style="cursor: pointer;" onclick="getSub('<?=$nm?>')"><strong><font size="+2">+</font></strong></span>
	

	</span>
</p>
<? }
?>