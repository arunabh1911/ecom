<? include'header.php'; $name = 'travaler';
$load = new loader();
$load->model('site_function');
?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
     
    <div class="centercontent tables">
  <span id="test"></span>  
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=ucwords($name);?> List</h1>
      </div>
        
<div id="contentwrapper" class="contentwrapper">
<form action="" method="post">
<div class="tableoptions">
    <table width="100%" border="1">
        <tr>
            
            <td>
            <input name="likes" value="<?=$_POST['likes']?>" class="largeinput" type="text" placeholder="Name, Email" />
            </td>
           	<td><select name="country" id="country" style="width:150px;"  >
           	<option <? if($_POST['country']=='in')echo'selected';?> value="in">India</option>
            <option <? if($_POST['country']=='np')echo'selected';?> value="np">Nepal</option></select>
            </select></td>
            
             <td>
             <? if($_POST['state']) { 
			 	$load->site_function->setId = 'pk_i_id';
			 	$load->site_function->setName = 's_name';
			 	$load->site_function->dropDown(REGION, 'state', "fk_c_country_code = '$_POST[country]'  order by s_name" );
           		}else{?>
            <select name="state" id="state" style="width:150px;"  >
            <option value="">State</option>
            </select><? }?></td>
            
            <td>
             <? if($_POST['state']) { 
			 	$load->site_function->setId = 'pk_i_id';
			 	$load->site_function->setName = 's_name';
			 	$load->site_function->dropDown(CITY, 'city', "fk_i_region_id = '$_POST[state]' order by s_name" );
           		}else{?><select name="city" id="city" style="width:150px;" >
            <option value="">City</option> 
			</select><? }?></td>
            
        	<td><select name="status" style="width:150px;" >
            <option <? if($_POST['status']=='all')echo'selected';?> value="all">All</option> 
            <option <? if($_POST['status']=='active')echo'selected';?> value="active">Active</option> 
            <option <? if($_POST['status']=='inactive')echo'selected';?> value="inactive">Inactive</option> 
            <option <? if($_POST['status']=='suspended')echo'selected';?> value="suspended">Suspend</option> 
            </select></td>
        	
            <td><button class="radius3">Apply Filter</button></td>
        </tr>
    </table>
</div>
</form>
              <table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable">
                    <colgroup>
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                          	<th class="head1">Reg. Date</th>
                       		<th class="head1">Name</th>
                            <th class="head1">Email</th>
                          	<th class="head1">Status</th>
                           	<th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
      						<th class="head1">Reg. Date</th>
                       		<th class="head1">Name</th>
                            <th class="head1">Email</th>
                          	<th class="head1">Status</th>
                           	<th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
# VALIDATION #
if($_POST['likes'])
	$cnd = " AND ( `name` like '%$_POST[likes]%' OR `email` like '%$_POST[likes]%' ) ";
if($_POST['country'])
	$cnd .= " AND country = '$_POST[country]' ";
if($_POST['state'])
	$cnd .= " AND state = '$_POST[state]' ";	
if($_POST['city'])
	$cnd .= " AND city = '$_POST[city]' ";
if($_POST['status'])
	$cnd .= ($_POST['status'] == 'all') ? '' : "AND u.status = '$_POST[status]' ";

# VALIDATION #
$qry=$db->runQuery("select *, u.status as status from ".USERS." as u join ".ADDRESS." as a on u.userId = a.userId
where u.type = 'traveler' ".$cnd." group by u.userId "); 
if(@mysqli_num_rows($qry) > 0){
	while($view= $db->getQuery($qry)){
?>
                  
<tr>
		<td class="con0"><?=date('d M Y',strtotime($view['date'])); ?></td>
        <td class="con0"><?=ucwords($view['name'])?></td>
       <td class="con0"><?=$view['email']?></td>
        <td align="center" class="con0"><span class="label label-<?=$view['status']?>"><?=ucwords($view['status'])?></span></td>
        <td class="actions aligncenter">
        <div class="hidden-sm hidden-xs action-buttons">
               
                <? if($view['status']!='active'){?>                
                    <a class="green" href="javascript:void(0)" onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$view['userId']?>,'active')" title="active record">&nbsp;
                    <i class="ace-icon fa fa-check-square bigger-150"></i>
                    </a><? }else {?>
                <a class="dark suspend" href="javascript:void(0)" onclick="var r=confirm('continue suspend?'); if(r) dStatus(<?=$view['userId']?>,'suspended')" title="suspend user" >
                <i class="ace-icon fa fa-power-off bigger-150"></i>
                </a>
               	<? }?>
        </div>
</td>
</tr>
<? }}?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
<script>
function dStatus(id,status){
	document.getElementById('id').value = id;
	document.getElementById('cnd').value = status;
	document.getElementById('tbl').value='<?=USERS;?>';
	document.status.submit() 
}
</script>
<form action="adm-action.php" method="post" name="status">
<input name="id" id="id" type="hidden" />
<input name="cnd" id="cnd" type="hidden" />
<input name="tbl" id="tbl" type="hidden" />
<input type="hidden" name="admin" value="default-status" />
</form>

<form action="adm-action.php" method="post" name="undouser">
<input name="id" id="id1" type="hidden" />
<input name="userStatus" type="hidden" value="active" />
<input type="hidden" name="admin" value="user-status" />
</form>
</body>

<script type="text/javascript">

	jQuery(document).ready(function() {
		jQuery(".chzn-select").chosen();
	
	});
	
	$('#country, #state').on("change", function(e){
		
		var id = $(this).attr("id");
		
		if ( id == 'country'){
			var typ = 'state';
			$("#city").empty();
		}
		if ( id == 'state')
			var typ = 'city';
		
		 $.ajax({
			type: "POST",
			url: "<?=site_url;?>/ajax",
			data: { "getState": $(this).val(), type: typ },
			success: function (response) {
				$('#'+typ+'').html(response);
			},
		beforeSend: function () {
			$('#'+typ+'').after( loader() );
			},
		 complete: function () {
          	$('.load').remove();
			},
		});
	 });
	 <? if(!$_POST['state']){?>
	$( "#country" ).trigger( "change" );
	<? }?>
</script>
</html>