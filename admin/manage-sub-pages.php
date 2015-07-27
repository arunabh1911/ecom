<? include'header.php';
$cat=mysql_fetch_assoc(mysql_query("select * from $_REQUEST[tbl] where id='$_REQUEST[forms]' "));
?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
  <span id="test"></span>  
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage <?=ucwords($cat['page_name'])?></h1>
            
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
                            <th class="head0">Name</th>
                            <th class="head1">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="20" class="head1 aligncenter"><input type="checkbox" class="checkall" /></th>
                         	<th class="head0">Name</th>
                            <th class="head1">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
$qry=mysql_query("select * from site_form where category_id='$_REQUEST[forms]' and sub_id!='0' group by sub_id "); 
if(@mysql_num_rows($qry) > 0){
while($view= mysql_fetch_array($qry)){
?>						 
                        <tr>
                            <td class="aligncenter"><input type="checkbox" name="" /></td>
                            <td class="con0"><?=ucwords($view['forms'])?></td>
                            <td class="actions aligncenter">
<a href="add-pages.php?tbl=<?=$_REQUEST['tbl']?>&forms=<?=$_REQUEST['forms']?>&sub_id=<?=$view['sub_id']?>" class="btn btn4 btn_search" 
title="view record"></a>

<a href="javascript:void(0)" id="<?=$view['sub_id']?>" tbl="<?=$_REQUEST['tbl']?>" class="btn btn4 btn_trash delete" title="delete record"></a>

                            </td>
                        </tr>
  <? }}?> 

                      
                    </tbody>
                </table>
        
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

<!-- Mirrored from themepixels.com/themes/demo/webpage/amanda/tables.html by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 14 Feb 2013 07:07:09 GMT -->
</html>
