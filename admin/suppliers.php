<? include'header.php'; $name = 'Supplier';
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
            <form  method="post" >
&nbsp;&nbsp;&nbsp;&nbsp;
<button class="submit radius2" onclick="window.location='supplier-add.php'; return false;">Add Supplier</button>
</form>
      </div>
        
<div id="contentwrapper" class="contentwrapper">
<form action="" method="post">
<div class="tableoptions">
    <table width="100%" border="1">
        <tr>
            
            <td>
          <!--  <input name="likes" value="<?=$_POST['likes']?>" class="largeinput" type="text" placeholder="name" />-->
            </td>
            
        
            
        	
        	
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
                         
                           	<th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head1">Id</th>
      						
                          	<th class="head1"><?=ucwords($name);?> Name</th>
                            <th class="head1">Reg. Date</th>
                           <th class="head1">Tabs</th>
                           
                           	<th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
# VALIDATION #
if($_POST['likes'])
	$cnd = " AND ( `supplier_name` like '%$_POST[likes]%' ";

if($_POST['service']) {
	//$cnd .= " AND ";
	//$ser = $_POST['service'];
	//for($i=0; $i<count($ser); $i++)
	//	$cnd .= " FIND_IN_SET( '$ser[$i]', service) AND";
	//$cnd = rtrim($cnd, 'AND');
}
# VALIDATION #

$qry=$db->runQuery("select * from ".SUPPLIER." order by supp_id desc "); 
if(@mysqli_num_rows($qry) > 0){
	while($view= $db->getQuery($qry)){

	$tmp = '';
	//$srv = explode(',', $view['service']);
	//for($i=0; $i<count($srv); $i++)
		//$tmp .= ucwords($service[search_array($srv[$i], 'id', $service)]['name']).', ';
?>
                  
<tr>
		<td class="con0"><?=$view['supp_id']?></td>
		<td class="con0"><?=ucwords($view['supplier_name'])?></td>
        <td class="con0"><?=date('d M Y',strtotime($view['date_of_reg'])); ?></td>
       <!-- <td class="con0"><?=trim($tmp, ', ');?></td>-->
        <td align="center" class="con0"><a href='viewsuppliersform.php?formid=<?=$view['supp_id']?>'>View Tabs</a></td>
          
        <td class="actions aligncenter">
        <div class="hidden-sm hidden-xs action-buttons">
                <a class="blue" href="suppliers-view.php?userId=<?=$view['supp_id']?>" title="view record" >
               <!-- <i class="ace-icon fa fa-search bigger-150"></i>--> view form
                </a>
               <a href="supplier-add.php?id=<?=$view['supp_id']?>" class="" title="view record">edit</a>
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