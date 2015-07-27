<? include'header.php';?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
    
    <div class="centercontent">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Mail Templates</h1>
          
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">         
            
             <table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable">
                    <colgroup>
                   		<col class="con1" />
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                         <th class="head1">Name</th>
                             <th class="head1">For</th>
                            <th class="head1">Email</th>
                            <th class="head1">Modify Date</th>
                            <th class="head1">Status</th>
                            <th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th class="head1">Name</th>
                             <th class="head1">For</th>
                            <th class="head1">Email</th>
                            <th class="head1">Modify Date</th>
                            <th class="head1">Status</th>
                            <th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<? $qry=$db->runQuery("select * from ".EMAILTEMP." where type != '' "); 
if(@mysqli_num_rows($qry) > 0){
while($view= $db->getQuery($qry)){
?>
    <tr>
        <td><?=ucwords($view['title'])?></td>
		<td><?=ucwords($view['type'])?></td>
        <td><?=$view['email']?></td>
        <td><?=$view['dateModify']?></td>
        <td align="center" class="con0"><span class="label label-<?=$view['status']?>"><?=ucwords($view['status'])?></span></td>
       <td class="actions aligncenter">
            <div class="hidden-sm hidden-xs action-buttons">
			<a class="blue"  href="email-templateView.php?form=<?=$view['id']?>" title="edit record">
				<i class="ace-icon fa fa-pencil bigger-150"></i></a>
                
                 <? if($view['status']!='active'){?>                
                    <a class="green" href="javascript:void(0)" onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$view['id']?>,'active')" title="active record">&nbsp;
                    <i class="ace-icon fa fa-check-square bigger-150"></i>
                    </a><? }else {?>
                    <a class="orange" href="javascript:void(0)"  onclick="var r=confirm('continue activate?'); if(r) dStatus(<?=$view['id']?>,'inactive')" title="inactive record">&nbsp;
                    <i class="ace-icon fa fa-dot-circle-o bigger-150"></i>
                    </a><? }?>
            </div>
   		</td>
	</tr>
<? }}?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</body>
<script>
function dStatus(id,status){
	document.getElementById('id').value = id;
	document.getElementById('cnd').value = status;
	document.getElementById('tbl').value='<?=EMAILTEMP;?>';
	document.status.submit() 
}
</script>
<form action="adm-action.php" method="post" name="status">
<input name="id" id="id" type="hidden" />
<input name="cnd" id="cnd" type="hidden" />
<input name="tbl" id="tbl" type="hidden" />
<input type="hidden" name="admin" value="default-status" />
</form>
</html>
