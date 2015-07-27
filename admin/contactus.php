<? include'header.php'; $name = 'contactus'; ?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
        
    <div class="centercontent tables">
        <div class="pageheader notab">
            <h1 class="pagetitle"> Contact us</h1>
       </div>
         <div id="contentwrapper" class="contentwrapper">

               <table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable">
                    <colgroup>
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                         	<th class="head1">Date</th>
                            <th class="head1">Feedback</th>
                            <th class="head1">Subject</th>
                            <th class="head1">Name</th>
                            <th class="head1">Email</th>
                             <th class="head1">Contact No</th>
                             <th class="head1">Comment</th>
                           	<th class="head1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
   							<th class="head1">Date</th>
                            <th class="head1">Feedback</th>
                            <th class="head1">Subject</th>
                            <th class="head1">Name</th>
                            <th class="head1">Email</th>
                            <th class="head1">Contact No</th>
                             <th class="head1">Comment</th>
                             <th class="head1"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
$qry=$db->runQuery("select * from ".CONTACT." order by id DESC "); 
if(@mysqli_num_rows($qry) > 0){
while($view= $db->getQuery($qry)){?>

        <tr>
        	<td class="con0"><?=dateFormt($view['date']); ?></td>
             <td class="con0"><?=ucwords($view['feedback'])?></td>
            <td class="con0"><?=ucwords($view['subject'])?></td>
            <td class="con0"><?=ucwords($view['name'])?></td>
           <td class="con0"><?=$view['email']?></td>
            <td class="con0"><?=ucwords($view['contactNo'])?></td>
            <td class="con0"><?=ucwords($view['comment'])?></td>       
            <td class="actions aligncenter">
                <div class="hidden-sm hidden-xs action-buttons">
                  	<a class="red delete" href="#" field="id" id="<?=$view['id']?>" tbl="<?=CONTACT;?>" title="delete record" >
                    <i class="ace-icon fa fa-times bigger-150"></i>
                    </a>
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
</body>
</html>