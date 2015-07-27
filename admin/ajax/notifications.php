<?php
$baseurl = getcwd().'/../../';
require $baseurl.'index.php';
$db = new myDBC();
function search_array($value, $key, $array) {
   foreach ($array as $k => $val) {
       if ($val[$key] == $value) {
           return $ar[]=$k;
       }
   }
   return $ar;
}
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
$noti = $db->getRecord(NOTI,''," `by` = 'associate' AND `status` = 'unread' order by id DESC  limit 5");
$users = $db->getRecord(USERS);?>
<ul class="notitab">
	<li class="current"><a href="#messages">Activities</a></li>
</ul>

<div id="messages">
    <ul class="msglist">
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
	else if($value['type'] == 'address') {		
		$username = $users[$userId]['companyName'];
		$img = 'address.png';
		$page = 'associate-view.php?userId='.$value['userId'].'&address='.$value['typeId'].'&notiId='.$value['id'];
		$msg = $value['remark'].' '.ucwords($us);
	}
?>
        <li>
            <a href="<?=$page?>">
            	<span class="thumb"><img src="images/<?=$img?>" alt="" /></span>
                <span class="msgdetails">
                    <span class="name"><?=ucwords($value['type'])?></span>
                    <span class="msg"><?=$msg?></span>
                    <span class="time"><?=tym($value['date'])?></span>
                </span>
            </a>
        </li>
<? }}else echo ' <li><div style="height:30px;line-height:30px;text-align: center;"><strong>no activities</strong></div></li>'; ?>
       
    </ul>
	<div class="msgbutton">
    	<a href="activities.php">View All Activities</a>
    </div>
</div>

