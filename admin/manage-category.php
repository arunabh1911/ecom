<? include'header.php';
function category_url($id,$url="",$rpt='')
{
	$db = new myDBC();
	if($id!='' && $id!=$rpt)
	{
		$data= $db->getQuery($db->runQuery("select id,category_parent,slug from ".CAT." where id='$id'"));
		$url[]=$data['slug'];
		return category_url($data['category_parent'],$url,$id);
	}
	else
		return @trim(implode(" / ", array_reverse($url, true)), ' / ');
}
?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Category List</h1>
          
<form  method="post" >
&nbsp;&nbsp;&nbsp;&nbsp;
<button class="submit radius2" onclick="window.location='category.php'; return false;">Add Category</button>
</form>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
                <table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablequick" id="dyntable2">
                    <colgroup>
                        <col class="con0" style="width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                          <th class="head0 nosort"><input type="checkbox" /></th>
                            <th class="head0">Category</th>
                            <th class="head1">Parameters</th>
						<th class="head0"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th class="head0 nosort"><input type="checkbox" /></th>
                            <th class="head0">Category</th>
                            <th class="head1">Parameters</th>
							 <th class="head0"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                            <? 
							$sql= $db->runQuery("select * from ".CAT." where id !='0' order by id DESC ");
							
							while($data= $db->getQuery($sql))
								{
								$par = explode(',',$data['parameter']);
                            ?>
                        <tr class="gradeX">
                          <td align="center"><span class="center">
                            <input type="checkbox" />
                          </span></td>
                            <td><?=ucwords(category_url($data['id']));?></td>
                            <td><?=ucwords(implode(', ',$par))?></td>
							
 <td class="center"><a href="category.php?id=<?=$data['id']?>" class="btn btn4 btn_search" title="view record"></a> 
<!--<a id="<?=$data['id']?>" href="javascript:void(0)" tbl="<?=CAT?>" class="delete">Delete</a></td>-->

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
