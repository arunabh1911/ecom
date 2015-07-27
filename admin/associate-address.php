<? include'header.php'; $name = 'address'; 
$aso=$db->getQuery($db->runQuery("select * from ".USERS." where userId='$_REQUEST[userId]' "));?>
<script type="text/javascript" src="<?=$admin_folder?>js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=$admin_folder?>js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?=$admin_folder?>js/custom/general.js"></script>
<script type="text/javascript" src="<?=$admin_folder?>js/custom/tables.js"></script>
        
    <div class="centercontent tables">
        <div class="pageheader notab">
            <h1 class="pagetitle"><?=ucwords($name);?> List - <?=ucwords($aso['companyName'])?> 
            	<div style="float:right">
                    <button class="stdbtn btn_black" onclick="window.location='associate-view.php?userId=<?=$aso['userId']?>'; return false;">Back </button>&nbsp;&nbsp;
                </div>
             </h1>
        </div>
        
         <div id="contentwrapper" class="contentwrapper">

<? if($_SESSION['succ']){?>
<div class="notibar msgsuccess"><a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>
 
 
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
                         	<th class="head1">Name</th>
                            <th class="head1">Email</th>
                            <th class="head1">Mobile No</th>
                            <th class="head1">City</th>
                            <th class="head1">State</th>
                            <th class="head1">Servive</th>
                            <th class="head1">Status</th>
                            <th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
   							<th class="head1">Name</th>
                            <th class="head1">Email</th>
                            <th class="head1">Mobile No</th>
                            <th class="head1">City</th>
                            <th class="head1">State</th>
                            <th class="head1">Servive</th>
                             <th class="head1">Status</th>
                            <th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
$service = $db->getRecord( SERVICE );
$state = $db->getRecord( REGION );
$city = $db->getRecord( CITY  );
	
$qry=$db->runQuery("select * from ".ADDRESS." where userId = '".$_REQUEST['userId']."'  order by id DESC "); 
if(@mysqli_num_rows($qry) > 0){
while($view= $db->getQuery($qry)){
	
	$cityId = search_array($view['city'], 'pk_i_id', $city);
	$stateId = search_array($view['state'], 'pk_i_id', $state);
	
	$tmp = '';
	$srv = explode(',', $view['service']);
	for($i=0; $i<count($srv); $i++)
		$tmp .= ucwords($service[search_array($srv[$i], 'id', $service)]['name']).', ';
?>
     <tr>
            <td class="con0"><?=ucwords($view['name'])?></td>
			<td class="con0"><?=$view['email'];?></td>
         	<td class="con0"><?=$view['mobileNo']?></td>
     		<td class="con0"><?=@$city[$cityId]['s_name']?></td>
       		<td class="con0"><?=@$state[$stateId]['s_name']?></td>
            <td class="con0"><?=trim($tmp, ', ');?></td>
            <td align="center" class="con0"><span class="label label-<?=$view['status']?>"><?=ucwords($view['status'])?></span></td>
           	<td class="actions aligncenter">
                <div class="hidden-sm hidden-xs action-buttons">
                    <a class="blue" href="associate-view.php?userId=<?=$_REQUEST['userId']?>&address=<?=$view['id']?>" title="view record">
                    <i class="ace-icon fa fa-search bigger-150"></i>
                    </a>
                     <? if($view['status']!='pending'){if($view['status']!='active'){?>
                    <a class="green" href="javascript:void(0)" onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$view['id']?>,'active')" title="active record">&nbsp;
                    <i class="ace-icon fa fa-check-square bigger-150"></i>
                    </a><? }else {?>
                    <a class="orange" href="javascript:void(0)"  onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$view['id']?>,'inactive')" title="inactive record">&nbsp;
                    <i class="ace-icon fa fa-dot-circle-o bigger-150"></i>
                    </a><? }}?>
                 </div>
            </td>
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
	document.getElementById('tbl').value='<?=ADDRESS;?>';
	document.status.submit() 
}
</script>
<form action="adm-action.php" method="post" name="status">
<input name="id" id="id" type="hidden" />
<input name="cnd" id="cnd" type="hidden" />
<input name="tbl" id="tbl" type="hidden" />
<input name="userId" type="hidden" value="<?=$_REQUEST['userId']?>" />
<input type="hidden" name="admin" value="default-status" />
</form>
</body>
</html>