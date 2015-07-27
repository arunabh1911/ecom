<? include'header.php';
$gal=$db->getQuery($db->runQuery("select * from ".GALLERY." where id='$_REQUEST[id]' "));
$img=explode(",", $gal['img']);
$ti=explode(",", $gal['title']);
?>
<script type="text/javascript" src="js/plugins/jquery.effects.core.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.effects.explode.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.alerts.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/gallery.js"></script>
<script>
var http = false;
if(navigator.appName == "Microsoft Internet Explorer"){
http = new ActiveXObject("Microsoft.XMLHTTP");
}else{http = new XMLHttpRequest();}
function title1(img)
{
	document.getElementById('s'+img+'').style.display='block';
	document.getElementById('s'+img+'').innerHTML='<img src="images/loaders/loader2.gif" border="0" width="10px" />';
	http.abort();
	http.open("GET", "adm-action.php?act=gallery1&id=<?=$_REQUEST[id]?>&stp=2&"+img+"="+document.getElementById(img).value, true);		
	http.onreadystatechange=function()
	{
		if(http.readyState == 4)
		{
			document.getElementById('h'+img+'').style.display='none';
			document.getElementById('s'+img+'').innerHTML=document.getElementById(img).value;
		}
	}
	 http.send(null);
}
function hide1(img)
{
	document.getElementById('h'+img+'').style.display='block';
	document.getElementById('s'+img+'').style.display='none';
	document.getElementById('e'+img+'').style.display='none';
}
</script>
        
    <div class="centercontent">
   <span id="stest" ></span>
        <div class="pageheader notab">
            <h1 class="pagetitle">Manage Banner</h1>
           
           
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper nopadding">
<form class="stdform" >     
<? if($img[0]){?>
<div class="gallerywrapper">				
<ul class="imagelist">  
<? for($i=0; $i< count($img); $i++){?>
<li>
<img src="<?=img_path.$img[$i]?>" alt="" width="100px;" />
<span><span style="float:left;" id="s<?=$img[$i]?>"><?=$ti[$i];?></span> 

<div  id="h<?=$img[$i]?>" style="display:none;float:left;">
<input name="<?=$img[$i]?>" id="<?=$img[$i]?>"  type="text" value="<?=$ti[$i];?>" class="mediuminput" onclick="this.select()" />
<a style="cursor: pointer" onclick="title1('<?=$img[$i]?>')">SAVE</a>
</div> 
</a>
<a id="e<?=$img[$i]?>" style="cursor: pointer" onclick="hide1('<?=$img[$i]?>')">Edit</a> 


<a href="<?=img_path.$img[$i]?>" class="view"></a> 
<a id="<?=$_REQUEST[id]?>" img="<?=$img[$i]?>" tbl="<?=GALLERY?>" class="delete"></a></span>
</li>
<? }?>
</ul>
</div>
</form>
<? }?>           
            <!--gallerywrapper-->
                                        
            <br clear="all" /><br />
                                                
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

<!-- Mirrored from themepixels.com/themes/demo/webpage/amanda/gallery.html by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 14 Feb 2013 07:11:13 GMT -->
</html>
