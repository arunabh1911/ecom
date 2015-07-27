<? include'header.php';
$act=$_REQUEST['act'];?>


<? if($act==''){?>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/tables.js"></script>
 <div class="centercontent tables">
  <span id="test"></span>  
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage</h1>
            
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
                            <th class="head0">Page Name</th>
                            <th class="head0">Category</th>
                            <th class="head0">Type</th>
                            <th class="head1">GoTo</th>
                            <th class="head1">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="20" class="head1 aligncenter"><input type="checkbox" class="checkall" /></th>
                         <th class="head0">Page Name</th>
                         <th class="head0">Category</th>
                          <th class="head0">Type</th>
                            <th class="head1">GoTo</th>
                            <th class="head1">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
<?
$qry=$db->runQuery("select * from ".CATEGORY." order by type DESC"); 
if(@mysqli_num_rows($qry) > 0){
while($view= $db->getQuery($qry)){

?>						 
                        <tr>
                            <td class="aligncenter"><input type="checkbox" name="" /></td>
                            <td class="con0"><?=ucwords($view['page_name'])?></td>
                              <td class="con0"></td>
                                <td class="con0"><?=ucwords($view['type'])?></td>
                              <td class="con0"><?=$view['goto']?></td>
                       		<td class="actions aligncenter">
<a href="master.php?id=<?=$view['page_id']?>" class="btn btn4 btn_search" 
title="view record"></a>

<a href="#" id="<?=$view['page_id']?>" tbl="<?=CATEGORY?>" class="btn btn4 btn_trash delete" title="delete record"></a>

                            </td>
                        </tr>
  <? }}?> 

                      
                    </tbody>
                </table>
        
        </div><!--contentwrapper-->
        
	</div>

<? }else{
$qry=$db->runQuery("select * from site_settings"); 
while($view= $db->getQuery($qry))
{
	$setting=$view['setting'];
	$$setting=$view['value'];
}
@$add=explode("|",$address);?>
  
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/charCount.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>    
    <div class="centercontent">
    
         <div class="pageheader">
            <h1 class="pagetitle">Settings</h1>
            <span class="pagedesc">admin site settings</span>
            
            <ul class="hornav">
                <li class="current"><a href="#general ">General </a></li>
                <li><a href="#addons">Add-ons</a></li>
                
            </ul>
        </div>
        
        
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div class="widgetcontent">
                <form class="stdform" action="adm-action.php" method="post" enctype="multipart/form-data">

<? if($_SESSION['succ']){?>				
<div class="notibar msgsuccess">
<a class="close"></a><p><?=$_SESSION['succ']; $_SESSION['succ']='';?></p></div>
<? }?>
					
					
<div id="general" class="subcontent">  
    <p>
    <strong>Site URL</strong><br />
    <input class="mediuminput" name="URL" value="<?=$URL;?>" type="text" />
    </p>
                    
    <p>
    <strong>Site  Logo </strong><br />
    <input class="mediuminput" name="logo[]" type="file" />
    <img src="../site-content/uploads/<?=$logo;?>" width="40px" />
    <input type="hidden" name="unlink" value="<?="../".$IMAGE_FOLDER.'/'.$logo?>" />
    </p>
    
    <p>
    <strong>Site  Theme</strong><br />
    <input class="mediuminput" name="theme" value="<?=$theme;?>" type="text" />
    </p>
    
    <p>
    <strong>Auto Logout</strong><br />
    <input class="mediuminput" name="logout" value="<?=$logout;?>" type="text" /> min
    </p>    
    
    <p>
    <strong>Image Folder</strong><br />
    <input class="mediuminput" name="IMAGE_FOLDER" value="<?=$IMAGE_FOLDER;?>" type="text" />
    </p>
    
    <p>
    <strong>404 Not Found Page</strong><br />
    <input class="mediuminput" name="NOTFOUND" value="<?=$NOTFOUND;?>" type="text" />
    </p>     
    
    <p>
    <strong>Copyright text</strong><br />
    <input class="mediuminput" name="copyright" value="<?=$copyright;?>" type="text" />
    </p>
    
            
    <p>
    <strong>Image Extension</strong><br />
    <input class="mediuminput" name="img_ext" value="<?=$img_ext;?>" type="text" />
    </p>
     
    <p>
    <strong>File Extension</strong><br />
    <input class="mediuminput" name="file_ext" value="<?=$file_ext;?>" type="text" />
    </p>
    
                         
     <p>
        <strong>Site Currency</strong><br />
       
                            
        <select name="currency" class="chzn-select" tabindex="2"> 
        <option <? if($currency=='Rs')echo selected;?> value="Rs">(Rs) Rupee</option> 
        <option <? if($currency=='€')echo selected;?> value="&euro;"> (&euro;) Euro</option>
        <option <? if($currency=='$')echo selected;?> value="$"> ($) Dollar</option> 
        <option <? if($currency=='£')echo selected;?> value="&pound;"> (&pound;) Pound </option> 
        </select>
       
    </p>
                                       				
     </div>		
     
<div id="addons" class="subcontent" style="display:none;">  
     
    <p>
    	<strong>Add-ons</strong><br />
        <label>Pages</label>
        <span class="formwrapper">
        <input type="checkbox" name="addon[]" value="banner" /> Add Pages<br />
        <input type="checkbox" name="addon[]" value="banner" /> Sort Pages<br />
        <input type="checkbox" name="addon[]" value="banner" /> Add Sub-Pages<br />
        </span>
        
        <br />
        <label>E-commerce</label>
		<span class="formwrapper">
       	<input type="checkbox" name="addon[]" value="banner"  /> Category<br />
        <input type="checkbox" name="addon[]" value="banner" /> Products <br />
        <input type="checkbox" name="addon[]" value="banner"  /> Brands <br />
        <input type="checkbox" name="addon[]" value="banner"  /> Promo Code <br />
        <input type="checkbox" name="addon[]" value="shipping" /> Shipping <br />
        <input type="checkbox" name="addon[]" value="banner"  /> Orders <br />
        </span>
        
        <br />
        <label>Mail Template</label>
        <span class="formwrapper">
        <input type="checkbox" name="addon[]" value="user"  /> Registration <br />
        <input type="checkbox" name="addon[]" value="contact" /> Forget Password <br />
        <input type="checkbox" name="addon[]" value="contact" /> Order Confirmation <br />
        </span>
        
        <br />
        <label>Others</label>
        <span class="formwrapper">
        <input type="checkbox" name="addon[]" value="user"  /> Registerd User <br />
        <input type="checkbox" name="addon[]" value="contact" /> Contact us <br />
        </span>
    </p>
    
    <p>
    	<strong>Site Settings</strong><br />
        <label>General</label>
        <span class="formwrapper">
        <input type="checkbox" name="addon[]" value="banner" /> Site Title<br />
        <input type="checkbox" name="addon[]" value="banner" /> Meta Keywords<br />
        <input type="checkbox" name="addon[]" value="banner" /> Meta Description<br />
        </span>
        
        <br />
        <label>Social</label>
		<span class="formwrapper">
       	<input type="checkbox" name="addon[]" value="facebook"  /> facebook<br />
        <input type="checkbox" name="addon[]" value="facebook"  /> twitter<br />
        <input type="checkbox" name="addon[]" value="facebook"  /> youtube<br />
        </span>
   
    <p>
        <strong>Shipping Method</strong><br />
            <select data-placeholder="Choose Currency" name="shipping" class="chzn-select" style="width:350px;" tabindex="2"> 
        <option  <? if($shipping=='0')echo selected;?> value="0">Disabled</option> 
        <option <? if($shipping=='1')echo selected;?> value="1">Select Multiple Options</option> 
        <option <? if($shipping=='2')echo selected;?> value="2"> On Minimum Amount</option>
        </select>
	</p>
</div>			
				     <!--                     <p>
                        <strong>Website Font</strong><br />

                        <select name="font">
                        <? for ($i=0; $i< count($a); $i++){?>
                          <option <? if($a[$i]==$font) echo selected; ?> value="<?=$a[$i]?>"><?=$a[$i]?></option>
                          <? }?>
                        </select>
                    </p>	-->

					
                    <p>
                        <button class="submit radius2" style="width:150px;">SAVE</button>
                        <input type="hidden" name="admin" value="setting" />
                    </p>
                </form>
            </div>
        
        </div>
        
        <br clear="all" />
        
	</div>    
        
        
        
<? }?>   	
</body>
</html>
