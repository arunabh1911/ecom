<? include'header.php'; 
function tym($startdate) {
	
	$enddate = date("Y-m-d H:i:s");
	$diff=strtotime($enddate)-strtotime($startdate);
	$temp=$diff/86400; 
	$days=floor($temp);  $temp=24*($temp-$days);
	$hours=floor($temp);  $temp=60*($temp-$hours);
	$minutes=floor($temp);  $temp=60*($temp-$minutes);
	
	if($days == '1' && $hours == '0')
		return 'Yesterday at '.date('H A',strtotime($startdate));
	elseif($days >= '1')	
		return date('F',strtotime($startdate)).' '.date('d',strtotime($startdate));
	elseif($hours > '1' && $hours < '24')
		return $hours.' hours ago';
	elseif($hours == '1')
		return 'About an hour ago';
	else
		return $minutes.' minutes ago';
}
$noti = $db->getRecord(NOTI,''," `by` != 'admin' order by id DESC ");
$users = $db->getRecord(USERS);?>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/messages.js"></script>

    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Activities</h1>
        </div>
        
        <div id="contentwrapper" class="contentwrapper">
             
             <div id="inbox" class="subcontent">
             
             <!--   <div class="msghead">
                    <ul class="msghead_menu">
                       
                        <li class="marginleft5 dropdown" id="actions">
                            <a class="dropdown_label" href="#actions">
                            Actions
                            <span class="arrow"></span>
                            </a>
                            <ul>
                                <li><a href="#">Mark as Read</a></li>
                                <li><a href="#">Mark as Unread</a></li>
                            </ul>
                        </li>
                      
                    	<li class="right"><a class="next"></a></li>
                        <li class="right"><a class="prev prev_disabled"></a></li>
                        <li class="right"><span class="pageinfo">1-10 of 2,139</span></li>
                    </ul>
                    <span class="clearall"></span>
                </div>-->
              
                <table cellpadding="0" cellspacing="0" border="0" class="stdtable mailinbox">
                    <colgroup>
                        <col class="con1" />
                        <col class="con1"  />
                        <col class="con1" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                    <tr>
                       <!-- <th width="20" class="head1 aligncenter"><input type="checkbox" name="checkall" class="checkall" /></th>-->
                        <th class="head1">&nbsp;</th>
                        <th class="head1">Date</th>
                        <th class="head1">#</th>
                        <th class="head1">Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <!--<th width="20" class="head1 aligncenter"><input type="checkbox" name="checkall" class="checkall" /></th>-->
                        <th class="head1">&nbsp;</th>
                        <th class="head1">Date</th>
                        <th class="head1">#</th>
                        <th class="head1">Status</th>
                      </tr>
                    </tfoot>
                    <tbody>  
                      
<? if($noti){
	foreach($noti as $key => $value){	
	$usrId = search_array($value['userId'], 'userId', $users);
	$us = $users[$usrId][companyName];
	if($value['type'] == 'service') {
		$cnt = count(explode(',',$value['remark']));
		$img = 'service.png';
		$page = 'associate-view.php?userId='.$value['userId'].'&address='.$value['typeId'].'&notiId='.$value['id'];
		$msg = $value['remark'].' '.ucwords($us);
	}
	
	if($value['type'] == 'address' || $value['type'] == 'hotel' || $value['type'] == 'roomrate') {		
		$username = $users[$userId]['companyName'];
		$img = 'address.png';
		$page = 'activities-view.php?notiId='.$value['id'];
		$msg = $value['remark'].' '.ucwords($us);
	}
?>                   <tr>
                            <!--<td class="aligncenter"><input type="checkbox" name="" /></td>-->
                            <td class="star"><a onclick="unread('<?=$value['id']?>')" class="msgstar <?=$value['star']?>"></a>
                            <input id="<?=$value['id']?>" type="hidden" value="<?=$value['star']?>" />
                            </td>
                            <td><?=tym($value['date'])?></td>
                            <td><a href="<?=$page?>" class="title"><?=$msg?></a></td>
                            <td><span class="label label-<?=$value['cnd']?>"><?=ucwords($value['cnd'])?></span> </td>
                        </tr>
<? }} ?>
                    </tbody>
                </table>             
             </div>
        </div>
    
    </div>
</div>
</body>
</html>
