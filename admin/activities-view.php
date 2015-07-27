<? include'header.php';
$load = new loader();
$load->model('site_function');

## Notification ##
if($_REQUEST['notiId']){
	$noti = $db->getRecord( NOTI, '', "id = '".$_REQUEST['notiId']."' " );
	$rAdd = json_decode(stripslashes($noti[0]['data']), TRUE);
	
	## User ##
	$aso=$db->getQuery($db->runQuery("select * from ".USERS." where userId='".$noti[0]['userId']."' "));


	if($noti[0]['type'] == 'hotel'){
		$tbl = HOTEL;
		$not = $noti[0]['remark']." ".ucwords($aso['companyName'])."";
		$cAdd=$db->getQuery($db->runQuery("select * from ".HOTEL." where id='".$noti[0]['typeId']."' "));
	}
	
	elseif($noti[0]['type'] == 'address'){
		$tbl = ADDRESS;
		$not = $noti[0]['remark']." ".ucwords($aso['companyName'])."";
		$cAdd=$db->getQuery($db->runQuery("select * from ".ADDRESS." where id='".$noti[0]['typeId']."' "));
		
		## Service ##
		$service = $db->getRecord( SERVICE );
		$srv = explode(',', $cAdd['service']);
	}
	
	else if($noti[0]['type'] == 'roomrate'){
		$tbl = ROOMRATE;
		$cAdd=$db->getQuery($db->runQuery("select * from ".ROOMRATE." where id='".$noti[0]['typeId']."' "));
		$hotel = $db->getRecord( HOTEL,'', "id = '".$cAdd['hotelId']."' " );
		$not = $noti[0]['remark'].' '.ucwords($aso['companyName']).' ('.$hotel[0]['name'].')';
		
		## Service ##
		$service = $db->getRecord( AMENITIES );
		$srv = explode(',', $cAdd['amenities']);
	}
}
?>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.effects.core.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.effects.explode.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/gallery.js"></script>
<script>
function Statuss (id,act) {
		jPrompt('Comment:', '', 'Cancellation Dialog', function(r) {
		if(r)
			dStatus(id,act,r);
	});
}
</script>

    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle"><?=ucwords($not)?>
                <div style="float:right">
                        <button class="stdbtn btn_black" onclick="window.location='activities.php'; return false;">Back </button>&nbsp;&nbsp;
                    </div>
            </h1>
        </div>
        
        <div id="contentwrapper" class="contentwrapper">
<div class="two_third">
         		
          <div align="right">
            	<strong> <?=dateFormt($noti[0]['sdate'])?></strong>&nbsp;&nbsp;
                <span class="label label-<?=$noti[0]['cnd']?>"><?=ucwords($noti[0]['cnd'])?></span> 
              
                <? if($noti[0]['cnd'] == 'pending'){?>
                <a class="green" href="javascript:void(0)" onclick="var r=confirm('Continue Approved?'); if(r) dStatus(<?=$cAdd['id']?>,'approved')" title="approve">&nbsp;
                <i class="ace-icon fa fa-check-square bigger-150"></i></a>
                
                <a class="brown" href="javascript:void(0)"  onclick="Statuss(<?=$cAdd['id']?>,'cancelled')" title="cancell">&nbsp;
                <i class="ace-icon fa fa-times-circle-o bigger-150"></i></a>
                <? }?>
            </div>

<p></p>   
<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>

    <table cellpadding="0" cellspacing="0" border="0" class="stdtable mailinbox">                   
        <thead>
            <tr>
             	<th class="head1">#</th>
             	<th class="head1"><strong> Current</strong></th>
              	<? if($noti[0]['record'] != 'new'){?><th class="head1"><strong> Requested</strong></th> <? }?>
            </tr> 
			
            <tr>
         		<th class="head1">Date</th>
          		<th class="head0"><? if($noti[0]['record'] == 'new') echo dateFormt($noti[0]['date']); ?></th>
          		<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=dateFormt($noti[0]['date'])?></th><? }?>
         	</tr>
                             
<? if($noti[0]['type'] == 'address'){?>
             <tr>
         		<th class="head1">Contact Person</th>
          		<th class="head0"><?=ucwords($cAdd['name'])?></th>
          		<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['name'])?></th><? }?>
         	</tr>
            
            <tr>
                <th class="head1">Current Service</th>
                <th class="head0"><? $tmp = ''; for($i=0; $i<count($srv); $i++){$id = search_array($srv[$i], 'id', $service); $tmp .= ucwords($service[$id]['name']).', ';} echo trim($tmp, ', '); ?></th>
             	
				<? if($noti[0]['record'] != 'new'){?><th class="head0"><? $tmp = ''; for($i=0; $i<count($srv); $i++){$id = search_array($srv[$i], 'id', $service); $tmp .= ucwords($service[$id]['name']).', ';} echo trim($tmp, ', '); ?></th><? }?>
        	</tr>
        
        	 <tr>
        		<th class="head1">Address</th>
            	<th class="head0"><?=ucwords($cAdd['address'])?><br />
                            <?=$load->site_function->getCity($cAdd['city']);?> - <?=ucwords($cAdd['pincode'])?><br />
                            <?=$load->site_function->getState($cAdd['state']);?><br />
                            <?=ucwords($cAdd['country'])?></th>
                            
             	<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['address'])?><br />
                            <?=$load->site_function->getCity($rAdd['city']);?> - <?=ucwords($rAdd['pincode'])?><br />
                            <?=$load->site_function->getState($rAdd['state']);?><br />
                            <?=ucwords($rAdd['country'])?></th><? }?>
          	</tr> 
         	
            <tr>             
         		<th class="head1">Contact No</th>
            	<th class="head0"><? if($cAdd['landlineNo'])echo ucwords($cAdd['landlineNo'].',')?> 
				<?=ucwords($cAdd['mobileNo'])?> &nbsp;</th>
              	
				<? if($noti[0]['record'] != 'new'){?><th class="head0"> <? if($rAdd['landlineNo'])echo ucwords($rAdd['landlineNo'].',')?> <?=ucwords($rAdd['mobileNo'])?> &nbsp;</th><? }?>
        	</tr>  
      		
            <tr>
        		<th class="head1">Fax No</th>
				<th class="head0">  <?=$cAdd['faxNo']?> &nbsp;</th>
             	<? if($noti[0]['record'] != 'new'){?><th class="head0">  <?=$rAdd['faxNo']?> &nbsp;</th><? }?>
			</tr>  
       
         <tr>
         <th class="head1">Email</th>
            <th class="head0"><?=$cAdd['email']?> &nbsp;</th>
           <? if($noti[0]['record'] != 'new'){?><th class="head0"><?=$rAdd['email']?> &nbsp;</th><? }?>
        </tr>  
<? }?>

<? if($noti[0]['type'] == 'hotel'){?>
			<tr>
         		<th class="head1">Hotel Name</th>
          		<th class="head0"><?=ucwords($cAdd['name'])?></th>
          		<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['name'])?></th><? }?>
         	</tr>
            
             <tr>
         		<th class="head1">Contact Person</th>
          		<th class="head0"><?=ucwords($cAdd['contactPerson'])?></th>
          		<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['contactPerson'])?></th><? }?>
         	</tr>
            
        	 <tr>
        		<th class="head1">Address</th>
            	<th class="head0"><?=ucwords($cAdd['address'])?><br />
                            <?=$load->site_function->getCity($cAdd['city']);?> - <?=ucwords($cAdd['pincode'])?><br />
                            <?=$load->site_function->getState($cAdd['state']);?><br />
                            <?=ucwords($cAdd['country'])?></th>
                            
             	<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['address'])?><br />
                            <?=$load->site_function->getCity($rAdd['city']);?> - <?=ucwords($rAdd['pincode'])?><br />
                            <?=$load->site_function->getState($rAdd['state']);?><br />
                            <?=ucwords($rAdd['country'])?></th><? }?>
          	</tr> 
         	
            <tr>             
         		<th class="head1">Contact No</th>
            	<th class="head0"><? if($cAdd['landlineNo'])echo ucwords($cAdd['landlineNo'].',')?> 
				<?=ucwords($cAdd['mobileNo'])?> &nbsp;</th>
              	
				<? if($noti[0]['record'] != 'new'){?><th class="head0"> <? if($rAdd['landlineNo'])echo ucwords($rAdd['landlineNo'].',')?> <?=ucwords($rAdd['mobileNo'])?> &nbsp;</th><? }?>
        	</tr>  
      		
            <tr>
        		<th class="head1">Fax No</th>
				<th class="head0">  <?=$cAdd['faxNo']?> &nbsp;</th>
             	<? if($noti[0]['record'] != 'new'){?><th class="head0">  <?=$rAdd['faxNo']?> &nbsp;</th><? }?>
			</tr>  
       
         <tr>
         <th class="head1">Email</th>
            <th class="head0"><?=$cAdd['email']?> &nbsp;</th>
           <? if($noti[0]['record'] != 'new'){?><th class="head0"><?=$rAdd['email']?> &nbsp;</th><? }?>
        </tr>  
<? }?>

<? if($noti[0]['type'] == 'roomrate'){?>
			<tr>
         		<th class="head1">Room Type</th>
          		<th class="head0"><?=ucwords($cAdd['roomType'])?></th>
          		<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['roomType'])?></th><? }?>
         	</tr>
            
             <tr>
         		<th class="head1">Room Rate</th>
          		<th class="head0"><?=ucwords($cAdd['roomRate'])?></th>
          		<? if($noti[0]['record'] != 'new'){?><th class="head0"><?=ucwords($rAdd['roomRate'])?></th><? }?>
         	</tr>
            
        	 <tr>
                <th class="head1">Amenities</th>
                <th class="head0"><? $tmp = ''; for($i=0; $i<count($srv); $i++){$id = search_array($srv[$i], 'id', $service); $tmp .= ucwords($service[$id]['name']).', ';} echo trim($tmp, ', '); ?></th>
             	
				<? if($noti[0]['record'] != 'new'){?><th class="head0"><? $tmp = ''; for($i=0; $i<count($srv); $i++){$id = search_array($srv[$i], 'id', $service); $tmp .= ucwords($service[$id]['name']).', ';} echo trim($tmp, ', '); ?></th><? }?>
        	</tr> 
<? }?>
        </thead>
       </tbody>
    </table>  
<br />
<br />
<br />
</div> 

<div class="one_third last">
<div class="gallerywrapper">
    <ul class="imagelist">
<? $i=1;
if($rAdd['image1']){ $chk = explode(',',$cAdd['image1']);
$image = explode(',',$rAdd['image1']);
foreach($image as $key => $value){ if(!in_array($value, $chk) ){if(file_exists($baseurl.image_folder.'/'.$value) ){?>
        <li>
        	<img src="<?=img_path.$value?>" alt="" />
            <a href="javascript:void(0)" class="name">image <?=$i;?></a><a href="<?=img_path.$value?>" class="view"></a>
		</li>
<? $i++; }}}}?>
    </ul>
</div>
</div>


</div>
</div>
</div>
<script>
function dStatus(id,status,input){
	document.getElementById('ids').value = id;
	document.getElementById('cnd').value = status;
	document.getElementById('input').value = input;
	document.getElementById('tbl').value='<?=$tbl;?>';
	document.status.submit() 
}
</script>
<form action="adm-action.php" method="post" name="status">
<input name="id" id="ids" type="hidden" />
<input name="cnd" id="cnd" type="hidden" />
<input name="tbl" id="tbl" type="hidden" />
<input name="input" id="input" type="hidden" />
<input name="notiId" type="hidden" value="<?=$_REQUEST['notiId']?>" />
<input type="hidden" name="admin" value="approve" />
</form>
</body>
</html>