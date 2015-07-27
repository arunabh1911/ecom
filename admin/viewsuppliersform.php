<?php include'header.php';?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
  <span id="test"></span>  
        <div class="pageheader notab">
            <h1 class="pagetitle">Tab List</h1>
          
    <? if($_REQUEST['formid']!=""){?>
            <form  method="post" action="builder-add.php">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="userId" value="<?=$_REQUEST['formid']?>" />
<button class="submit radius2" type="submit" >Add Form </button>
</form>
<? } ?>
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
                            <th width="20" class="head1 aligncenter"><input type="checkbox" name="checkall" class="checkall" /></th>
                            <th class="head0">Form Name</th>
                           
                            <th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
     <th width="20" class="head1 aligncenter"><input type="checkbox" name="checkall" class="checkall" /></th>
                          <th class="head0">Form Name</th>
                           
                            <th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
//echo "SELECT * FROM ".BUILDER."  where userId='".$_REQUEST['formid']."' ORDER BY id DESC";die;
@$sql = $db->runQuery("SELECT * FROM ".BUILDER."  where userId='".$_REQUEST['formid']."' group by name ORDER BY id DESC");
while(@$view = $db->getQuery($sql)) {
?> <tr>
                            <td align="center"><span class="center"><input type="checkbox" name="" /></span></td>
                            <td class="con0"><?=ucwords($view['name'])?></td>
                           
                                               
                            <td class="actions aligncenter">
<a href="builder-add.php?id=<?=$view['formId']?>" class="btn btn4 btn_search" title="view record"></a>
<a href="#" id="<?=$view['id']?>" tbl="<?=BUILDER;?>" class="btn btn4 btn_trash delete" title="delete record"></a>

                            </td>
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
