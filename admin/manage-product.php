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
<script>
var http = false;
if(navigator.appName == "Microsoft Internet Explorer"){
  http = new ActiveXObject("Microsoft.XMLHTTP");
} else {
  http = new XMLHttpRequest();
}
function ftr(name,id)
{	
	http.abort();
	http.open("GET", "adm-action.php?act=featured&name="+name+"&id="+id, true);
	http.onreadystatechange=function(){
    if(http.readyState == 4) {
	document.getElementById(name+id).innerHTML= http.responseText;		
	}
  }
  http.send(null);
}
</script>       
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage Products</h1>
            
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
                             <th class="head0">Part Number</th>
                            <th class="head1">Manufacture</th>
							<th class="head1">Manufacturer Part Number</th>
                            <th class="head0">Category</th>
                             <th class="head0">Quanity </th>
                            <th class="head0">Status</th>
                            <th class="head0"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th class="head0 nosort"><input type="checkbox" /></th>
                            <th class="head0">Part Number</th>
                            <th class="head1">Manufacture</th>
							<th class="head1">Manufacturer Part Number</th>
                            <th class="head0">Category</th>
                             <th class="head0">Quanity </th>
                            <th class="head0">Status</th>
                            <th class="head0"></th>
                        </tr>
                    </tfoot>
                    <tbody>
<? 
$sql = $db->runQuery("select * from ".PRODUCT." where id !='0' order by id DESC");
while($data= $db->getQuery($sql))
{?>


<tr class="gradeX">
    <td align="center"><span class="center"><input type="checkbox" /></span></td>
    <td><?=$data['partNum']?></td>
	 <td><?=ucwords(strtolower($data['manufacturer']))?></td>
	  <td><?=$data['mPartNum']?></td>
	  <td class="center"><?=ucwords(str_replace('/',' <br /> ',category_url($data['catId'])));?></td>
	   <td><?=ucwords(strtolower($data['quantity']))?></td>
	<td align="center" class="con0"><span class="label label-<?=$data['status']?>"><?=ucwords($data['status'])?></span></td> 
	
    <td class="center"><a href="product.php?id=<?=$data['id']?>">Edit</a> 
    <!--<a id="<?=$data['id']?>" href="javascript:void(0)" tbl="<?=PRODUCT?>" class="delete">Delete</a>--></td>
</tr>
<? }?>
                    </tbody>
                </table>
        
        </div>
        
	</div>
    
    
</div>
</body>
</html>