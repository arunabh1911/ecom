<? include'header.php';
$view=$db->getQuery($db->runQuery("select * from ".EMAILTEMP." where id='$_REQUEST[form]' "));
$load = new loader();
$load->third_party('ckeditor','ckeditor.js' );
?>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="js/plugins/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/forms.js"></script>

    <div class="centercontent">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Edit Mail Template</h1>
            <span class="pagedesc"></span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
            <form class="stdform" action="adm-action.php" method="post" enctype="multipart/form-data">
                <div class="two_third dashboard_left">
                    <div class="widgetbox">
                        <div class="title">
                         
<select style="width:300px;" onchange="window.location='?form='+this.value+'' ">
	<?
    $sql = $db->runQuery("select * from ".EMAILTEMP." where type!= '' group by type ");
    while($qry=$db->getQuery($sql)) {?>
    <optgroup label="<?=ucwords($qry['type'])?>">
		<? $sql1 = $db->runQuery("select * from ".EMAILTEMP." where type = '$qry[type]' ");
        while($data=$db->getQuery($sql1)) {?>
        <option <? if($_REQUEST['form'] == $data['id'] )echo 'selected';?> value="<?=$data['id']?>"><?=ucwords($data['title'])?></option>
		<? }?>
    </optgroup>
    <? }?>
</select>
      
<!--<h3><?=ucwords($view['title']);?></h3>-->
                         </div>
<p>
    <strong><? if($view['type'] == 'admin')echo 'Send To'; else echo 'Send From' ?></strong><br />
    <input type="text" name="email" value="<?=$view['email']?>" class="longinput" />
</p>

<p>
    <strong>Subject</strong><br />
    <input type="text" name="subject" value="<?=$view['subject']?>" class="longinput" />
</p>

<p>
    <strong>Status</strong><br />
    <select name="status">
      <option <? if($view['status'] == 'active')echo 'selected';?> value="active">active</option>
      <option <? if($view['status'] == 'inactive')echo 'selected';?> value="inactive">inactive</option>
    </select>
</p>

<p>
    <strong>Content</strong><br />
   <textarea name="content" class="ckeditor" ><?=stripslashes($view['content']);?></textarea>
</p>

<div>

                        </div>
                    </div>
                </div>
                <div class="one_third last dashboard_right">
                	<div class="contenttitle2" style="margin-top: 0">
                        <h3>Legends</h3>                        
                    </div>
                    <p>
                        <strong>Site Logo</strong> : {siteLogo}
                    </p>
                    <p>
                        <strong>Site Name</strong> : {siteName}
                    </p>
                     <p>
                        <strong>Site Url</strong> : {siteUrl}
                    </p>
                    <p>
                        <strong>Site Mail</strong> : {siteMail}
                    </p>
                   
                    <p>
                        <strong>Date</strong> : {DATE}
                    </p>
                    <p>
                        <strong>User Name</strong> : {userName}
                    </p>
                    <p>
                        <strong>User Email</strong> : {userEmail}
                    </p>
                    <p>
                        <strong>User Password</strong> : {userPass}
                    </p>
                    <p>
                        <strong>Mail Activation Link</strong> : {activationLink}
                    </p>
                    <p>
                        <strong>Reset Password Link</strong> : {resetLink}
                    </p>
                     <p>
                        <strong>Contact us Form</strong> : {contactusForm}
                    </p>
                    
                        <p>
<button class="submit radius2">Publish Template</button>
<input type="hidden" name="admin" value="email-template" />
<input name="id" type="hidden" value="<?=$view['id']?>" />

                        </p>
                </div>           
            </form>        
        </div>
	</div>   
</div>
</body>
</html>
