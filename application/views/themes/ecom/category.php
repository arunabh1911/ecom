<? //print_r($data);
$cat= $this->db->getQuery($this->db->runQuery("Select * from ".CAT." where id=".$pageDetail->parentId."")); 
$par = explode(',',$pageDetail->parameter);
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($url);parse_str($parts['query'], $query);
?>
<div class="main2-wrapper">
	<div class="container">
	<form action="" name="frm2" method="post">
    	<div class="row-fluid-main2">
        	
            <div class="kyeword">
			
            	<p>Keywords: <img src="<?=temp_path?>/img/help.png"></p>
                <input type="text" name="text" class="keyword_input">
                <!--<p class="keyword_p">
				 <img src="<?=temp_path?>/img/fb.png">
				 <img src="<?=temp_path?>/img/twitter.png"> 
				 <img src="<?=temp_path?>/img/linkedin.png"> 
				 <img src="<?=temp_path?>/img/google-+.png"> 
				 <img src="<?=temp_path?>/img/email.png"> | 
				 <img src="<?=temp_path?>/img/link.png"></p>-->
                <div class="clear"></div>
                <div class="checkbox_keyword">
                	<p><input type="checkbox"> <b>In stock</b></p>
                	<p><input type="checkbox"> <b>Lead free</b></p>
                	<p><input type="checkbox"> <b>RoHS Compliant</b></p>
                    <input type="submit" value="Search Again" class="search_again">
					<input name="stype"type="hidden" value="part" />
					<input name="<?=frontend?>" id="act" type="hidden" value="user/search" />
            </form>
                </div>
            </div>
            <form name="myfrm" action="" method="get">
            <div class="add_to_cart">
<h5><a href="<?=site_url?>/product-search/?>">Product Index</a> >
<a href="<?=site_url?>/product-search/<?=$cat['slug']?>"><?=$cat['category_title']?></a> > 
 <?=$pageDetail->name?> </h5>
                <p>Results matching criteria: <?=$this->site_function->numPro($pageDetail->id)?></p>
                <p>To select multiple values within a box, hold down 'Ctrl' while selecting values within the box.</p>
            </div>
            
            <div class="manufacturer">



                <div class="span2 fix audio_span">
                	<h6>Manufacturer</h6>
					
                    <div class="audio_scroll_box">
<?
$_POST['manufacturer'] = $query['manufacturer'];
$this->site_function->clas = 'size="10"';
$this->site_function->setFirstRow = false;
$this->site_function->dropDown(MANU, 'manufacturer', "status = 'active'  order by name" );
?>
</div>
 <input type="button" onclick="$('#manufacturer').val(0);" value="Reset" class="reset_button">
 </div>

<? 
$cnd='';
for($i=0; $i< count($par); $i++) { 
		if($query[$par[$i]]) {
			$cnd .= " AND `".$par[$i]."` = '".$query[$par[$i]]."' ";
			$_POST[$par[$i]] = $query[$par[$i]];
			}
		}

		
$qry=$this->db->runQuery("select * from ".PAR." ");
if(mysqli_num_rows($qry) > 0){ 
while($data= $this->db->getQuery($qry)){

if(@in_array($data['slug'], $par)){ ?>       	

               <div class="span1 audio_span">
                	<h6><?=$data['name']?></h6>
                    <div class="audio_scroll_box">
<? 
$this->site_function->clas = 'size="10" ';
$this->site_function->setFirstRow = false;
$this->site_function->dropDown(MASTERS, $data['slug'], "type = '".$data['slug']."' AND status = 'active'  order by name" );
?>
                    </div>
                    <input type="button" onclick="$('#<?=$data['slug']?>').val(0);"  value="Reset" class="reset_button r1">
                </div>
                
<? }}}?>
</div>    
            </div>
			
            <div class="clear"></div>
            
            <div class="kyeword">
                <div class="checkbox_keyword">
                	<p><input type="checkbox"> <b>In stock</b></p>
                	<p><input type="checkbox"> <b>Lead free</b></p>
                	<p><input type="checkbox"> <b>RoHS Compliant</b></p>
                    <input type="reset" value="Reset All" class="search_again">
                    <input type="submit" value="Apply Filters" class="search_again">
                </div>
            </div>
</form>
            <div class="audio_pruduct_detail">
            	<b>To see real-time pricing, click either the <?=title?> part number or unit price link.</b>
                <p>Enter the quantity that you are interested in and press submit. The unit price for the quantity will display for all products in the table. Any products that cannot be purchased at the entered quantity due to minimum order quantities will be pushed to the bottom of the results. </p>
            </div>
            <form name="frm3" method="post">
			<div align="right">
			
			<input  type="submit" value="Download Table" class="search_again">
<input name="query" id="act" type="hidden" value="<?="select * from ".PRODUCT." where catId = '".$pageDetail->id."' $cnd "?>" />
			<input name="par"type="hidden" value="<?=$pageDetail->parameter?>" />
			<input name="<?=frontend?>" id="act" type="hidden" value="ecommerce/tablecsv" />
			
			</div>
			</form>
    			<table cellpadding="2" cellspacing="1" border="1" class="audio_table">
                
                	<tr>
                        <th>Compare Parts</th>
                        <th><img src="<?=temp_path?>/img/datasheet.png" width="25" height="40"></th>
                        <th>Image</th>
                        <th><?=title?> Part Number</th>
                        <th>Manufacturer Part Number</th>
                        <th>Manufacturer</th>
                        <th>Description</th>
                        <th>Quantity Available <img src="<?=temp_path?>/img/help.png"></th>
                        <th>Unit Price <img src="<?=temp_path?>/img/help.png"> USD</th>
                        <th>Minimum Quantity <img src="<?=temp_path?>/img/help.png"></th>
                      <? 
					  	for($i=0; $i< count($par); $i++) {?>
						<th><?=$this->site_function->parameters($par[$i])?></th>
						<? }?>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

<? 
if($_POST['manufacturer'])	$cnd = " AND manufacturer = '".$_POST['manufacturer']."' ";

$sql = $this->db->runQuery("select * from ".PRODUCT." where catId = '".$pageDetail->id."' AND status = 'active' $cnd ");
while($data= $this->db->getQuery($sql))
{?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>
<? if($data['datasheet']){?>
<a href="<?=$data['datasheet']?>" target="_blank">view</a>
<? }?></td>
                        <td><img src="<?=img_path.$data['productPhoto']?>" width="100px" /></td>
                        <td><a href="<?=site_url?>/product-details/<?=$data['slug']?>"><?=@$data['partNum']?> <img src="<?=temp_path?>/img/leaf.png">?</a></td>
                        <td><a href="<?=site_url?>/product-details/<?=$data['slug']?>"><?=@$data['mPartNum']?></a></td>
                        <td><?=$this->site_function->manufacturer($data['manufacturer'])?></td>
                        <td><?=@$data['description']?></td>
                        <td><?=@$data['quantity']?> - Immediate</td>
                        <td><?=@number_format($data['price'])?> </td>
                        <td><?=@$data['minQty']?></td>
						 <? 
					  	for($i=0; $i< count($par); $i++) {?>
						   <td><?=@$this->site_function->masters($data[$par[$i]])?></td>
						<? }?>
                      
                        
                    </tr>
<? }?>                  
                
                </table>
            <br />  <br />  <br />
        </div>
    </div>
</div>




