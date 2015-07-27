<? include'header.php'; ?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage Brand</h1>
            
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
                            <th class="head0">Brand Name</th>
                            <th class="head0">Img</th>
                            <th class="head1">Mod. Date</th>
                            <th class="head0"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th class="head0 nosort"><input type="checkbox" /></th>
                            <th class="head0">Brand Name</th>
                               <th class="head0">Img</th>
                            <th class="head1">Mod. Date</th>
                            <th class="head0"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<? 
$sql= $db->runQuery("select * from ".BRAND." where id !='0' order by id DESC ");
while($data= $db->getQuery($sql)) {
?>
                        <tr class="gradeX">
                          <td align="center"><span class="center">
                            <input type="checkbox" />
                          </span></td>
                            <td><?=ucwords($data['name']);?></td>
                              <td><? if($data['img']){?><img src="<?=img_path.$data['img'];?>" width="100px" /><? }?></td>

                            <td><?=date('d M Y',strtotime($data['date'])); ?></td>
 <td class="center"><a href="brand.php?id=<?=$data['id']?>">Edit</a> 

<a id="<?=$data['id']?>" href="javascript:void(0)" tbl="<?=BRAND?>" class="delete">Delete</a></td>

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
