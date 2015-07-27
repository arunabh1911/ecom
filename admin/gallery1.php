<? 
include'header.php';
$load = new loader();
$load->model('site_function');
$gal=$db->getQuery($db->runQuery("select * from ".GALLERY." where id='$_REQUEST[id]' "));
?>
<script src="js/plugins/jquery.form.js"></script> 
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>


<script>     
window.onload = function()
{
	jQuery('input:checkbox, input:radio, select.uniformselect, input:file').uniform();
}
 
$(document).ready(function()
{
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');

	$('#htmlForm').ajaxForm({    
		
		beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
   		uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
	},
		success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
		$('#htmlExampleTarget').fadeIn('slow'); 
    },
		complete: function(xhr) {
		status.html(xhr.responseText);
        } 
    }); 
});
    </script>
<style>
.progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: red; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
    <div class="centercontent">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Add Banner</h1>
            <span class="pagedesc"></span>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
 
            <form class="stdform" id="htmlForm" method="post" action="adm-action.php">

 

<p>
	 <span class="field"> <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>
    
    
</p>
  
 <div id="status">    
<p>
	<label>Image</label>
	<span class="field">
    <input type="file" name="imgaes[]" id="img" multiple="multiple"/></span>
	</p>              
              <p class="stdformbutton">
                    <button class="submit radius2" onclick="return chk(this)" >Upload Images</button>
                    <input type="hidden" name="img" value="<?=$gal['img']?>" />
                    <input type="hidden" name="tit" value="<?=$gal['title']?>" />
                    <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
                    <input type="hidden" name="stp" value="1" />
                    <input type="hidden" name="admin"value="gallery1" />
              </p>
              
</div>
            </form>        
        </div>
	</div>   
</div>
<script>
function chk(id)
{
	if(document.getElementById('img').value=='')
	{
		alert('!! Select Images !!');
		document.getElementById('img').focus();
		return false;
	}
	id.attr('disabled', 'disabled');
}
</script>
<script src="js/jquery.filedrop.js"></script>
<script src="js/script.js"></script>
</body>
</html>
