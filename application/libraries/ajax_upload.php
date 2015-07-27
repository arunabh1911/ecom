<?php  
class ajax_upload {
	
	public function __construct() {
	}	
	
	public function image_upload( $idx = '' ){ ?>
        <form id="htmlForm" name="plm" method="post" action="adm-action.php" enctype="multipart/form-data" >
        <input name="media[]" id="images" type="file" multiple="multiple" /></td>
        <br /><br />
        <input name="idx" type="hidden" value="<?=$idx?>" />
        <input name="admin" type="hidden" value="images-upload" />
        <input name="images-upload" type="submit" value="Upload" id="loadng" />
       	</form> 
        <span id="htmlExampleTarget"><? $this->show_db($idx); ?></span>
	<? }
	
	
	public function show_db( $idx = '0' ){	
		$this->db = new myDBC();	
		$rt=1;
		$qry = $this->db->runQuery("select * from ".IMG." where page_id='$idx' order by id DESC"); 
		while($data= $this->db->getQuery($qry)){?>
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td style="vertical-align: middle; padding: 10px 0;"><img id="x<?=$data['id']?>" src="<?=img_path.$data['img'];?>" width="75" /></td>
		<td align="center" valign="middle">&nbsp;
        	<a href="javascript:void(0)" onclick="$('.yaall').hide(); $('#z<?=$data['id']?>').show()">edit</a>
            <span class="yaall" id="z<?=$data['id']?>" >	
                <form id="htmlForm<?=$rt?>" method="post" action="adm-action.php">	
                <input name="name" type="hidden" value="<?=$data['img']?>" />
                <input name="slug" type="hidden" value="<?=$data['slug']?>" />
              	<input name="idx" type="hidden" value="<?=$idx?>" />	
                <input name="images[]" id="images" type="file" />	
                <input name="admin" type="hidden" value="images-upload" />
                <input type="submit" value="Edit" />	
                </form>
                <script>
                $('#htmlForm<?=$rt?>').ajaxForm({	
                    target: '#htmlExampleTarget', 	
                    success: function() { 	
                    $('#htmlExampleTarget').fadeIn('slow'); 	
                    $("#htmlForm<?=$rt?>").trigger('reset');
                    } 
                }); 
                </script>	
            </span>

&nbsp;<a href="javascript:void(0)" onclick="dell_imgg('<?=$data['img']?>','<?=$idx?>')">X</a><br /> <?=$data['slug']?></td>
	</tr>
	<? $rt++; }?>
	</table>
<? }

} ?>
<script>      
//$(document).ready(function() { 	
		$('#htmlForm').ajaxForm({ 
			clearForm: true,
			resetForm: true,
			beforeSend: function() { 
				//$('#loadng').after( loader() );
			},
			target: '#htmlExampleTarget', 			
			success: function() {
				$('#htmlExampleTarget').fadeIn('slow');
				$('#ajax_load').html('');
				} ,
			complete: function () {
			$('.load').remove();
			}
		}); 
//});

function dell_imgg(img,idx) {
	var r=confirm("Are you sure want to delete?")
	if (r==true) {
		$.ajax({
			type: "POST",
			url: "adm-action.php",
			data: { "del": img, idx: idx, admin: 'images-upload' },
			success: function (response) {
			$('#htmlExampleTarget').html(response);
			}
		});
	}
}
</script>
<style> 
span.yaall {display:none;}
</style>