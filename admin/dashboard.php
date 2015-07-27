<? include'header.php';?>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.slimscroll.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/dashboard.js"></script>        
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script>
function overview(input) {
	
}
</script>
   <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Dashboard</h1>
            <span class="pagedesc"></span>
     </div>
        
     <div id="contentwrapper" class="contentwrapper">
        
        	<div id="updates" class="subcontent">
 <? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>

<? } if(admin_announcement!='x'){?>
                    <div class="notibar announcement">
                        <a class="close"></a>
                        <h3>Announcement</h3>
                        <p><?=admin_announcement;?></p>
                    </div>
<? } if(admin_notification!='x'){?>
<div class="notibar msginfo">
<a class="close"></a>
<p><?=admin_notification;?></p>
</div>
<? }?>
                    
                    
                    <div class="two_third dashboard_left">
                    
                    	<ul class="shortcuts">
                     <!--  	  <li><a href="associate.php" class="users"><span>Users</span></a></li>
                            <li><a href="manage-pages.php" class="events"><span>Pages</span></a></li>
                        	<li><a href="contactus.php" class="gallery"><span>Contact us</span></a></li>
                            <li><a href="settings.php" class="settings"><span>Settings</span></a></li>-->
                         </ul>
                        
                        <br clear="all" />
                    
                 <?php /*?>    <div class="contenttitle2 nomargintop">
                            <h3>Visit Overview</h3>
                        </div><?php */?>
                        
                        <?php /*?><div class="overviewhead">
                        	<div class="overviewselect">
                                <select id="overviewselect" onchange="overview(this.value)">
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="t-week">This Week</option>
                                    <option value="l-week">Last Week</option>
                                    <option value="t-month">This Month</option>
                                    <option value="l-month">Last Month</option>
                                </select>
                            </div>
                            
From: &nbsp;<input type="text" id="datepickfrom" value="<?=date('d-m-Y')?>" readonly="readonly" /> &nbsp; &nbsp; 
To: &nbsp;<input type="text" id="datepickto" value="<?=date('d-m-Y')?>" readonly="readonly" />
                        </div><?php */?>
                        
                        <br clear="all" />
                  <?php /*?><table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
                            <colgroup>
                                <col class="con0" width="20%" />
                                <col class="con1" width="20%" />
                                <col class="con0" width="20%" />
                                <col class="con1" width="20%" />
                                <col class="con0" width="20%" />
                            </colgroup>
                            <thead>
                                <tr>
                                  <th class="head1">users</th>
                                   <!-- <th class="head0">Travelers</th>
                                    <th class="head1">Unique Visits</th>
                                    <th class="head0">Packages</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td>0</td>
                                 <!--   <td>0</td>
                                    <td class="center">0</td>
                                    <td class="center">0</td>-->
                                </tr>
                            </tbody>
                        </table><?php */?>
                      <br clear="all" />
              </div>
                    
	
    <?php /*?><div class="one_third last dashboard_right">
                    
     
                 <div class="contenttitle2 nomargintop">
                            <h3>Site Overview</h3>
                        </div>                    
                    
                    	<ul class="toplist">
                        	
                        	<li>
                            	<div>
                                	<span class="three_fourth">
                                    	<span class="left">
                                    		<span class="title"><a href="#">user</a></span>
                                        	<span class="desc">total user</span>
                                    	</span>
                                    </span>
                                    <span class="one_fourth last">
                                    	<span class="right">
                                        	<span class="h3"><?=$tot_associate+0?></span>
                                        </span>
                                    </span>
                                    <br clear="all" />
                                </div>
                            </li>
                        	<li>
                            	<div>
                                	<span class="three_fourth">
                                    	<span class="left">
                                    		<span class="title"><a href="#"></a></span>
                                        	<span class="desc">total </span>
                                    	</span>
                                    </span>
                                    <span class="one_fourth last">
                                    	<span class="right">
                                        	<span class="h3"><?=$tot_traveler+0?></span>
                                        </span>
                                    </span>
                                    <br clear="all" />
                                </div>
                            </li>
                            <li>
                            	<div>
                                	<span class="three_fourth">
                                    	<span class="left">
                                    		<span class="title"><a href="#"></a></span>
                                        	<span class="desc">total </span>
                                    	</span>
                                    </span>
                                    <span class="one_fourth last">
                                    	<span class="right">
                                        	<span class="h3">0</span>
                                        </span>
                                    </span>
                                    <br clear="all" />
                                </div>
                            </li>
                        </ul>
              </div><?php */?>
                    
                    
            </div>
            
            <div id="activities" class="subcontent" style="display: none;">
            	&nbsp;
            </div>
        
        </div>
        
      <br clear="all" />
       <p>&nbsp;</p>
       <p>&nbsp;</p>
       <p>&nbsp;</p>
      
   </div>
</div>
</body>
</html>
