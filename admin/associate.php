<? include'header.php'; $name = 'user';
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
            <!--<input name="likes" value="<?=$_POST['likes']?>" class="largeinput" type="text" placeholder="name, Mobile and Email" />-->
            </td>
            
        
            
        	<td><select name="status" style="width:150px;" >
            <option <? if($_POST['status']=='all')echo'selected';?> value="all">All</option> 
            <option <? if($_POST['status']=='active')echo'selected';?> value="active">Active</option> 
           <!-- <option <? if($_POST['status']=='inactive')echo'selected';?> value="inactive">Inactive</option> -->
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
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                           <th class="head1">Id</th>
                         
                            <th class="head1">Contact Person</th>
                            <th class="head1">Reg. Date</th>
                           <th class="head1">Tabs</th>
                             <th class="head1">Status</th>
                           	<th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head1">Id</th>
      						
                          	<th class="head1"><?=ucwords($name);?> Name</th>
                            <th class="head1">Reg. Date</th>
                           <th class="head1">Tabs</th>
                             <th class="head1">Status</th>
                           	<th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
# VALIDATION #
if($_POST['likes'])
	$cnd = " AND ( `u.name` like '%$_POST[likes]%' OR `u.companyName` like '%$_POST[likes]%' OR `u.email` like '%$_POST[likes]%' ) ";
if($_POST['country'])
	$cnd .= " AND country = '$_POST[country]' ";
if($_POST['state'])
	$cnd .= " AND state = '$_POST[state]' ";	
if($_POST['city'])
	$cnd .= " AND city = '$_POST[city]' ";
if($_POST['status'])
	$cnd .= ($_POST['status'] == 'all') ? '' : "AND u.status = '$_POST[status]' ";
if($_POST['service']) {
	//$cnd .= " AND ";
	//$ser = $_POST['service'];
	//for($i=0; $i<count($ser); $i++)
	//	$cnd .= " FIND_IN_SET( '$ser[$i]', service) AND";
	//$cnd = rtrim($cnd, 'AND');
}
# VALIDATION #

$qry=$db->runQuery("select *, u.status as status from ".USERS." as u join ".ADDRESS." as a on u.userId = a.userId
where type = 'user' ".$cnd." group by u.userId "); 
if(@mysqli_num_rows($qry) > 0){
	while($view= $db->getQuery($qry)){

	$tmp = '';
	//$srv = explode(',', $view['service']);
	//for($i=0; $i<count($srv); $i++)
		//$tmp .= ucwords($service[search_array($srv[$i], 'id', $service)]['name']).', ';
?>
                  
<tr>
		<td class="con0"><?=$view['uniqueId']?></td>
		<td class="con0"><?=ucwords($view['name'])?></td>
        <td class="con0"><?=date('d M Y',strtotime($view['date'])); ?></td>
       <!-- <td class="con0"><?=trim($tmp, ', ');?></td>-->
        <td align="center" class="con0"><a href='viewform.php?formid=<?=$view['userId']?>'>View Tabs</a></td>
          <td align="center" class="con0"><span class="label label-<?=$view['status']?>"><?=ucwords($view['status'])?></span></td>
        <td class="actions aligncenter">
        <div class="hidden-sm hidden-xs action-buttons">
                <a class="blue" href="<?=$name;?>-view.php?userId=<?=$view['userId']?>" title="view record" >
               <!-- <i class="ace-icon fa fa-search bigger-150"></i>--> Edit
                </a>
                  <? if($view['status']!='active'){?>                
                    <a class="green" href="javascript:void(0)" onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$view['userId']?>,'active')" title="active record">&nbsp;
                    <!--<i class="ace-icon fa fa-check-square bigger-150"></i>--> unsuspend
                    </a><? }else {?>
                <a class="dark suspend" href="javascript:void(0)"  onclick="var r=confirm('continue suspend?'); if(r) dStatus(<?=$view['userId']?>,'suspended')" title="suspend user" >
                <!--<i class="ace-icon fa fa-power-off bigger-150"></i>--> suspend?
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