<? include'header.php'; ?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
  <span id="test"></span>  
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage Pages</h1>
            
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
                            <th class="head1" width="20" class="head1 aligncenter"><input type="checkbox" class="checkall" /></th>
                            <th class="head1">Page Name</th>
                            <th class="head1"><span class="head0">Title</span></th>
                            <th class="head1">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="head1" width="20" class="head1 aligncenter"><input type="checkbox" class="checkall" /></th>
                         	<th class="head1">Page Name</th>
                            <th class="head1"><span class="head0">Title</span></th>
                          	<th class="head1">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
$qry=$db->runQuery("select * from ".CATEGORY." where type='single page' "); 
if(@mysqli_num_rows($qry) > 0){
while($view= $db->getQuery($qry)){
$opt=array_filter(explode(',',$view['options']));
if(($key = array_search('header', $opt)) !== false) {
    unset($opt[$key]);
}
if(($key = array_search('footer', $opt)) !== false) {
    unset($opt[$key]);
}
sort($opt);
if($opt[0]!=''){
$title=$db->getQuery($db->runQuery("select category_id,forms,content from ".FORM." where category_id='$view[page_id]' and forms='title' "));
?>						 
    <tr>
        <td class="aligncenter"><input type="checkbox" name="" /></td>
        <td class="con0"><?=ucwords($view['page_name'])?></td>
        <td class="con1"><?=ucwords($title['content'])?></td>
        <td class="actions aligncenter">
            <div class="hidden-sm hidden-xs action-buttons">
                <? if(@in_array('subpage',$opt)){?>
                <a href="add-pages.php?tbl=<?=$_REQUEST['tbl']?>&forms=<?=$view['id']?>&act=subpage" class="btn btn4 btn_link" title="Add SubPage"></a>
                <? }?>
                <a class="blue" href="add-pages.php?tbl=<?=$_REQUEST['tbl']?>&forms=<?=$view['page_id']?>" title="edit" >
                <i class="ace-icon fa fa-pencil bigger-150" alt="edit" ></i>
                </a>
             </div>
		</td>
    </tr>
  <? }}}?> 
  		</tbody>
                </table>
        
        </div>
    </div>
</div>
</body>
</html>