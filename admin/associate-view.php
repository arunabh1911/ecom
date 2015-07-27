<? include'header.php';
$load = new loader();
$load->model('site_function');

## User ##
$aso=$db->getQuery($db->runQuery("select * from ".USERS." where userId='$_REQUEST[userId]' "));
$asoAdd = explode(',',$aso['address']);

$cndadd = empty($_REQUEST['address']) ? current($asoAdd) : $_REQUEST['address'];

## Address ##
$add=$db->getQuery($db->runQuery("select * from ".ADDRESS." where id='".$cndadd."' "));

## Count Address ##
$address = $db->getNumRow( ADDRESS,'id', "userId = '".$_REQUEST['userId']."' " );

## Service ##
$service = $db->getRecord( SERVICE );
$srv = explode(',', $add['service']);

## Notification ##
if($_REQUEST['notiId']){
	$noti = $db->getRecord( NOTI, '', "id = '".$_REQUEST['notiId']."' " );
	if($noti[0]['type'] == 'service'){
		$cnt = explode(',',$noti[0]['data']);
		$not = "below ".count($cnt)." service requested by ".ucwords($aso['companyName'])." <br />";
	}
}
?>
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.bxSlider.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script>
function chk() {	
		var group = document.getElementsByName('cnd')
		for (var i=0; i<group.length; i++){if(group[i].checked) break;}
		if (i==group.length)
		{
			alert('Please Select Status');
			return false;
		}
}
function statuss (e) {
	
	jConfirm('Continue Status change to <strong>'+$(e).attr('id')+'</strong>?', 'Confirmation Status', function(r) {
		if(r) {
			
			if($(e).attr('id') != 'active')
				userStatus (e);
			else
				jConfirm('<strong>Send Mail to Associate?</strong>', 'Confirmation Status', function(s) {
				userStatus(e,s);
			});
		}
	});
}

function userStatus (e,s) {

		$.ajax({
			type: "POST",
			url: "adm-action.php",
			data: { "userStatus": $(e).attr('id'), id: $('#id').val(), admin: 'user-status', ajax: '1', sendMail: s },
			success: function (response) {
				$('#test').html(response); //<li>
				$("#btn").html($(e).attr('id')) //heading
				//$("#btn,#btn1").toggleClass("btn-"+$(e).attr('current')+"").toggleClass("btn-"+$(e).attr('id')+"");// green/yellow
			},
		beforeSend: function () {
			$('#btn').after( loader() );
			},
		 complete: function () {
			$('.load').remove();
			 },
		});
}

jQuery(document).ready(function(){
		
			///// DROP DOWN BUTTON /////
			jQuery('.dropdown').each(function(){
				var t = jQuery(this);
				t.find('a.dropdown_label').click(function(){
					if(!t.hasClass('open')) {
						var h = t.height();
						t.find('ul').show().css({top: h+2+'px'});	
						t.addClass('open');
					} else {
						t.find('ul').hide();	
						t.removeClass('open');				   
					}
					return false;
				});
			});
});
</script>    

    <div class="centercontent">

        <div class="pageheader">
        	<span class="profilepic">   <?=$load->site_function->img($aso['image1'],'admin','');?> </span>
            <div class="profiletitle">
            <h1 class="pagetitle"><?=ucwords($aso['companyName'])?>
            
                <div style="float:right">
                    <button class="stdbtn btn_black" onclick="window.location='associate.php'; return false;">Back </button>&nbsp;&nbsp;
                </div>
            </h1>
           
            </div>
            <ul class="hornav">
                <li class="current"><a href="#profile">Profile</a></li>
               <!-- <li><a href="#editprofile">Edit Profile</a></li>-->
            </ul>
        </div>
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div class="two_third last profile_wrapper">
                <div id="profile" class="subcontent">
<input id="id" type="hidden" value="<?=$aso['userId']?>" />

    <span class="followbtn" >
        <ul  class="photosharing_menu ">                  
            <li class="marginleft5 dropdown" id="actions">
                <a id="btn" class="dropdown_label" href="#actions"><?=ucwords($aso['status'])?></a><span class="arrow"></span>
                <ul id="test">
                 
                  <? if($aso['status'] != 'active'){?><li><a href="javascript:void(0)" current="<?=$aso['status']?>" id="active" onclick="statuss(this)">Active</a></li><? }?>
			
			<? if($aso['status'] != 'inactive'){?><li><a href="javascript:void(0)" current="<?=$aso['status']?>" id="inactive" onclick="statuss(this)">Inactive</a></li><? }?>
                   
            <? if($aso['status'] != 'suspended'){?><li><a href="javascript:void(0)" current="<?=$aso['status']?>" id="suspended"  onclick="statuss(this)" >Suspend</a></li><? }?>
                </ul>
            </li>
        </ul>
    </span>      
                    <ul class="profile_summary">
                        <li><a href="#" id="following"><span><?=count($srv);?></span> Services </a></li>
                        <li><a href="#"><span>0</span> Packages</a></li>
                        <li><a href="associate-address.php?userId=<?=$_REQUEST['userId']?>"><span><?=$address?></span> Address </a></li>
                    </ul>

            
                     
<blockquote class="bq2 currentstatus marginbottom0">
    <table width="80%" border="0" cellpadding="10" cellspacing="10">
     <tr>
        <td> <strong>Id</strong></td>
        <td><?=$aso['uniqueId']?></td>
      </tr>
      <tr>
        <td> <strong>Company Name</strong></td>
        <td><?=ucwords($aso['companyName'])?></td>
      </tr>
      <tr>
        <td><strong>Contact Person</strong></td>
        <td><?=ucwords($aso['name'])?></td>
      </tr>
       <tr>
        <td><strong>Email</strong></td>
        <td><?=$aso['email']?></td>
      </tr>
      <tr>
        <td><strong>About Company</strong></td>
        <td><?=ucwords(strtolower($aso['about']))?> </td>
      </tr>
      <tr>
        <td><strong>Documents:</strong></td>
        <td> <? $tmp=''; $img = explode(',', $aso['image2']);
            for($i=0; $i<count($img); $i++){$tmp .= '<a target="_blank" href="'.img_path.$img[$i].'">'.$img[$i].'</a><br />';}
            echo trim($tmp, ', ');?></td>
      </tr>
    </table>
</blockquote>


<? if($_SESSION['succ']){?>
<div class="notibar msgsuccess"><a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>


<? if($noti[0]['type'] == 'service' && $noti[0]['cnd'] == 'pending'){?>
<div class="notibar msginfo"><a class="close"></a><p><?=$not?></p></div>  
<form class="stdform stdform2" action="adm-action.php" method="post" onsubmit="return chk()">
<div class="two dashboard_left">  
    <p>
    <label>New Service</label>
        <span class="field">
    		<? foreach($cnt as $key => $value){$id = search_array($value, 'id', $service); ?>
					<input name="service[]" type="checkbox" value="<?=$value?>" /> <?=ucwords($service[$id]['name']);?> <br />
			<? } ?>
        </span>
    </p> 
     <p>
    <label>Status</label>
        <span class="field">
    		<input name="cnd" type="radio" value="approved" />  <strong>Approve</strong> &nbsp;&nbsp;&nbsp;&nbsp;
            <input name="cnd" type="radio" value="cancelled" /> <strong>Cancel</strong>
        </span>
    </p>    
    <p>
    	<span class="field">              
            <button class="submit radius2">&nbsp;&nbsp; Submit &nbsp;&nbsp;</button>
			<input name="tbl" type="hidden" value="<?=ADDRESS?>" />
           	<input name="type" type="hidden" value="service" />
            <input name="notiId" type="hidden" value="<?=$_REQUEST['notiId']?>" />
            <input name="admin" type="hidden" value="approve" />
            <input name="id" type="hidden" value="<?=$add['id']?>" />
        </span>
	</p>                   
</div>
</form>
<? }?>


&nbsp; <h3>Address</h3>
<form class="stdform stdform2" action="adm-action.php" method="post" onsubmit="return val()">
<div class="two dashboard_left">                    	
    
     <p>
    	<label>Status</label>
    	<span class="field">
        <span class="label label-<?=$add['status']?>"><?=ucwords($add['status'])?></span> 
        
		  	<? if($add['status']!='pending'){ if($add['status']!='active'){?>                
            <a class="green" href="javascript:void(0)" onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$add['id']?>,'active')" title="active record">&nbsp;
            <i class="ace-icon fa fa-check-square bigger-150"></i></a>
            
			<? }else{?>            
            <a class="orange" href="javascript:void(0)"  onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$add['id']?>,'inactive')" title="inactive record">&nbsp;
            <i class="ace-icon fa fa-dot-circle-o bigger-150"></i>
            </a><? }}?> &nbsp;</span>
    </p>
    
    <p>
    	<label>Contact Person</label>
    	<span class="field"> <?=ucwords($add['name'])?> &nbsp; </span>
    </p>
    
     <p>
    	<label>Current Service</label>
    	<span class="field"> <? $tmp = ''; for($i=0; $i<count($srv); $i++){$id = search_array($srv[$i], 'id', $service);
		$tmp .= ucwords($service[$id]['name']).', ';} echo trim($tmp, ', '); ?>
        </span>
    </p>  
      
    <p>
    	<label>Address</label>
    	<span class="field"> <?=ucwords($add['address'])?><br />
        <?=$load->site_function->getCity($add['city']);?> - <?=ucwords($add['pincode'])?><br />
        <?=$load->site_function->getState($add['state']);?><br />
        <?=ucwords($add['country'])?>
        </span>
    </p>
    
  	<p>
    	<label>Contact No</label>
    	<span class="field"> <? if($add['landlineNo'])echo ucwords($add['landlineNo'].',')?> <?=ucwords($add['mobileNo'])?> &nbsp; </span>
    </p>
   
   <? if($add['faxNo']){?>
   <p>
    	<label>Fax No</label>
    	<span class="field"> <?=ucwords($add['faxNo'])?> &nbsp; </span>
    </p>
    <? }?>
    
     <p>
    	<label>Email</label>
    	<span class="field"> <?=$aso['email']?> </span>
    </p>
</div>
</form>

</div>
      <div id="editprofile" class="subcontent" style="display: none">
                    Edit profile form goes here...
                </div>
                <br /><br />
            </div>
            
             <div class="one_third last">
             
           <?=$load->site_function->img($aso['image1'],'admin','120');?>
            </div>
            
            <br /><br />
            
        </div>
    </div>
</div>
<script>
function dStatus(id,status){
	document.getElementById('ids').value = id;
	document.getElementById('cnd').value = status;
	document.getElementById('tbl').value='<?=ADDRESS;?>';
	document.status.submit() 
}
</script>
<form action="adm-action.php" method="post" name="status">
<input name="id" id="ids" type="hidden" />
<input name="cnds" id="cnd" type="hidden" />
<input name="tbl" id="tbl" type="hidden" />
<input name="userId" type="hidden" value="<?=$aso['userId']?>" />
<input type="hidden" name="admin" value="default-status" />
</form>
</body>
</html>