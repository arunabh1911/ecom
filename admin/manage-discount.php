<? include'header.php';?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
  <span id="test"></span>  
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage <?=ucwords($_REQUEST['act']);?> Promo Code</h1>
            
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
                <table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb" id="dyntable2">
                    <colgroup>
                        <col class="con0" style="width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th width="20" class="head1 aligncenter"><input type="checkbox" class="checkall" /></th>
                            <th class="head0">Created Date</th>
                            <th class="head1"><span class="head0">Coupons Code</span></th>
                            <th class="head1">Valid</th>
                             <th class="head1">Discount</th>
                             <th class="head1">Status</th>
                              <th class="head1">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="20" class="head1 aligncenter"><input type="checkbox" class="checkall" /></th>
                         	   <th class="head0">Created Date</th>
                            <th class="head1"><span class="head0">Coupons Code</span></th>
                            <th class="head1">Valid</th>
                             <th class="head1">Discount</th>
                              <th class="head1">Status</th>
                              <th class="head1">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
$qry=$db->runQuery("select * from ".COUP." where type='$_REQUEST[act]' "); 
while($view= $db->getQuery($qry)){
?>						 
                        <tr>
                            <td class="aligncenter"><input type="checkbox" name="" /></td>
                            <td class="con0"><?=ucwords($view['date'])?></td>                            
                            <td class="con1"><?=ucwords($view['name'])?></td>
                       		<td class="con1"><?=$view['valid']?></td>
                            <td class="con1"><?=ucwords($view['discount'])?>%</td>
                            <td class="con1"><?=$view['status']?>
<? if($view['status']=='used' && $_REQUEST['act']=='single')
{
	$d=mysql_fetch_array(mysql_query("select * from ordermaster where discount_id='$view[id]'"));
	?>&nbsp;&nbsp; <span style="cursor: pointer" title="<?=$d['user_email'];?>">[∇]</span>
<? }
?></td>
  <td class="center"><a href="discount.php?id=<?=$view['id']?>">Edit</a> 
    <a id="<?=$view['id']?>" href="javascript:void(0)" tbl="<?=COUP?>" class="delete">Delete</a></td>
                        </tr>
  <? }?> 

                      
                    </tbody>
                </table>
        
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

<!-- Mirrored from themepixels.com/themes/demo/webpage/amanda/tables.html by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 14 Feb 2013 07:07:09 GMT -->
</html>
