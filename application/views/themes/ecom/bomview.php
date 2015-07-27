<? $slug = explode('/', $_REQUEST['slug']);
$data = $this->db->getQuery($this->db->runQuery("select * from ".BOM." where uniqueId = '".$slug[1]."' "));  ?>
	  
<div style="padding-left:25px;">	  
     <div style="width:950px">
            <h4>Bill of Materials</h4>                        
        </div>
		
	  <div id=""]*" style="width:900px;">
        
        <div id="" title="Click here to show or hide the help text for this page" style="background-color:Silver;cursor: pointer">
			
            <a id="" class="aspNetDisabled padLeft3" style="color:Blue;">Need Help Creating your BOM</a>
            <img id="" src="<?=temp_path?>/img/dn.gif" />
        
		</div>
        
        <div id="" class="pop" style="z-index: 100; position: absolute; display: none" width="900">
            <div id="" style="background-color:#F0F0F0;width:900px;">
			
                <span id="" style="padding: 0px 3px 0px 3px;"><span style="font-weight: bold;">Add Items Manually</span>
<ul>
  <li>
Enter valid data in at least one of the "<span style="font-style: italic;">DK Part #</span>" OR "<span style="font-style: italic;">Mfg Part #</span>" fields</li>
  <li>
Enter a quantity or quantities in the appropriate fields</li>
  <li>
Click the "<span style="font-weight: bold;">Add</span>"
button</li>
</ul>
<span style="font-weight: bold;">Use the In-table Icons</span><br>
<ul>
  <li>
Click the refresh icon <img alt="" src="<?=temp_path?>/img/update.gif"> to update pricing and availability for the line
items where quantities have been changed</li>
  <li>
Click the delete icon <img alt="" src="<?=temp_path?>/img/delete.gif"> to delete the associated line item</li>
  <li>
Click the part search information icon&nbsp;<img alt="" src="<?=temp_path?>/img/mag.gif"> to launch the Digi-Key part
search for the specific line item</li>
</ul>
<span style="font-weight: bold;">Use the Buttons on the
Page to Perform the Desired Tasks</span><br>
<ul>
  <li>
Click the "<span style="font-weight: bold;">Refresh This
Page</span>" button to update pricing and availability for the
line items where quantities have been changed. &nbsp;This will also
resort the page based on the original sort criteria.</li>
  <li>
Click the "<span style="font-weight: bold;">Create Order</span>"
button to order the parts that have their "Order Qty" box checked in
the parts list. &nbsp;The selected checkbox determines the quantity
of parts added to the order. &nbsp;All of the "Quantity 1"
quantities are selected by default.</li>
  <li>
Click the "<span style="font-weight: bold;">Create BOM</span>"
button to turn your parts list into a Bill of Materials.
&nbsp;Please note that this operation will only use those
quantities that have their "Order Qty" box checked during creation of
the BOM.</li>
  <li>
Click the "<span style="font-weight: bold;">Create Quote</span>"
button to generate a quote based on all three "Quantity" columns.
&nbsp;The pricing displayed will take into account the various
discounts available for all of the quantities in the parts list.
  </li>
</ul></span>
                &nbsp;
            
		</div>
        </div>
    
	</div>
	  
	  
	  
	  
	  <div id="" style="background-color:#F0F0F0;width:900px;">
			
                <a id="" title="Open Digi-Key Part Search in a new window" class="padLeft3" onClick="" href="http://www.digikey.com/product-search/en"><img title="Open Digi-Key Part Search in a new window" src="<?=temp_path?>/img/mag.gif" alt="" /></a>
                <span id="">Click this icon to view an item’s part details.</span><br />
                <img id="" class="padLeft3" src="<?=temp_path?>/img/datasheet.gif" />
                <span id="">Click this icon to view a part’s Data Sheet</span><br />
                <img id="" class="padLeft3" src="<?=temp_path?>/img/red_a.gif" />
                <span id="">Duplicate part numbers will be listed in red text below.</span><br />
                <img id="" class="padLeft3" src="<?=temp_path?>/img/update.gif" />
                <span id="">Click this icon in the table to update all pending changes.</span><br />
                <img id="" class="padLeft3" src="<?=temp_path?>/img/delete.gif" />
                <span id="">Click this icon next to any part to delete it from the table.</span><br />
                <img id="" class="padLeft3" src="<?=temp_path?>/img/rohs.gif" />
                <span id="">Indicates RoHS Compliance.  Click on this icon for more information about the part's RoHS status.</span><br />
                <img id="" class="padLeft3" src="<?=temp_path?>/img/rohs_nc.gif" />
                <span id="">Indicates RoHS non-compliance.  Click on this icon for more information about the part's RoHS status.</span><br />
                
                <br />
                <table border='0'>
                    <tr>
                        <td>
                            <img id="" class="padLeft3" src="<?=temp_path?>/img/reach_unaffected.gif" /></td>
                        <td>
                            <span id="">&nbsp;Jun-2011 Indicates REACH Unaffected</span></td>
                    </tr>
                </table>
                <table border='0'>
                    <tr>
                        <td>
                            <img id="" class="padLeft3" src="<?=temp_path?>/img/reach_affected.gif" /></td>
                        <td>
                            <span id="">&nbsp;Jun-2011 Indicates REACH Affected</span></td>
                    </tr>
                </table>
                <table border='0'>
                    <tr>
                        <td>
                            <img id="" class="padLeft3" src="<?=temp_path?>/img/reach_na.gif" /></td>
                        <td>
                            <span id="">&nbsp;Indicates REACH Not Applicable</span></td>
                    </tr>
                </table>
            
		</div>
		
		
		
		<div id="">
			
                <span id="" style="color:Red;"></span>
                <ul id="">
                </ul>
                
                <br />
                <br />
            
		</div>
		
		
		
		<input type="submit" name="ctl00$ctl00$mainContentPlaceHolder$mainContentPlaceHolder$btnHiddenAddSelected" value="" onClick="" id="" style="display: none" />

            
            <div id="" style="color:Red;display:none;">

		</div>
            <div id="" onKeyPress="javascript:return WebForm_FireDefaultButton(event, &#39;ctl00_ctl00_mainContentPlaceHolder_mainContentPlaceHolder_btnSearch&#39;)">
              <table width="400" border="0">
                <tr>
                  <td width="94"><strong>BOM Name: </strong></td>
                  <td width="76"><a href="#"><?=$data['name'];?></a></td>
                  <td><strong>BOM ID: <?=$data['uniqueId'];?></strong></td>
                </tr>
              </table>
              <br>
				<form method="post" >
                <input type="hidden" name=""  />
                <input name="qty" type="text" placeholder="Quantity" style="width:75px;" />              
                <input name="product_nameb" type="text" placeholder="Part Number/Search Entry" style="width:175px;" />               
                <input name="" type="text" placeholder="Customer Reference"  style="width:113px;" />         
               	<input type="submit" name=" " value="Add to BOM"/>
				<input type="hidden" name="id" value="<?=$data['id']?>"  />
				<input type="hidden" name="cnd" value="add" />
            	<input name="<?=frontend?>" type="hidden" value="ecommerce/editBom" />              
				</form>
		</div>
		<p>&nbsp;</p>
		
	<!--	<table width="500" border="0">
                <tr>
                  <td width="92">Part Par Page:</td>
                  <td width="74"></td>
                  <td width="152">Displaying 1-2 of 2 parts. </td>
                  <td width="64"> <input type="submit" name=" " value="Refresh This Page" onClick="" id="" /></td>
                </tr>
              </table>-->
			  
			  
			  <P>&nbsp;</P>
		<form action="" id="frm" method="post">
		<table width="930" align="center" border="0" style="border:#CCCCCC solid 2px;"  cellpadding="0" cellspacing="0">
  <tr bgcolor="#E0E0E0" style="font-weight:bold;">
    <td colspan="3" align="center"  style="border-right:#CCCCCC solid 1px;">Part Number</td>
    <td width="113" align="center" style="border-right:#CCCCCC solid 1px;">Description</td>
    <td colspan="2"  align="center" style="border-right:#CCCCCC solid 1px;">Quantity 1</td>
    <td width="50"  align="center" style="border-right:#CCCCCC solid 1px;">Price 1</td>
    
    <td width="60"  align="center" style="border-right:#CCCCCC solid 1px;">Stock Status</td>
    <td width="67"  align="center" style="border-right:#CCCCCC solid 1px;">Comments</td>
    <td width="28">&nbsp;</td>
  </tr>
  <tr bgcolor="#E0E0E0" align="center">
    <td width="18"></td>
    <td width="65">&nbsp;</td>
    <td width="101" style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td width="18">    </td>
    <td width="90" class="qty" style="border-right:#CCCCCC solid 1px;">Order All </td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>


<?
/*$_SESSION['product_namep'] = $data['partNum'];
$_SESSION['qty1'] = $data['qty1'];
$_SESSION['qty2'] = $data['qty2'];
$_SESSION['qty3'] = $data['qty3'];*/

$name=array_filter(explode(",", $data['partNum']));
$qty1=explode(",", $data['qty1']);
$qty2=explode(",", $data['qty2']);
$qty3=explode(",", $data['qty3']);
for($i=0; $i< count($name); $i++){
$pro= $this->db->getQuery($this->db->runQuery("Select * from ".PRODUCT." where partNum = '".$name[$i]."'  "));
?>
  
  <!-- 1st row start-->
  
  <tr align="center">
    <td><img src="<?=temp_path?>/img/mag.gif" ></td>
    <td>DK Part #:</td>
    <td  style="border-right:#CCCCCC solid 1px;"><label>
      <input type="text" value="<?=$name[$i]?>" style="width:75px; height:13px; margin-top:10px;" />
	  <input type="hidden" name="name[]" value="<?=$name[$i]?>" style="width:75px; height:13px; margin-top:10px;" />
    </label></td>
    <td class="qty" style="border-right:#CCCCCC solid 1px;"><?=$pro['description']?></td>
    <td>&nbsp;</td>
   <td style="border-right:#CCCCCC solid 1px;"><label>
      <input type="text" name="qty1[]" value="<?=$qty1[$i]?>"  style="width:75px; height:13px;" />
	    <input type="hidden" name="qty2[]" value="<?=$qty2[$i]?>"  style="width:75px; height:13px;" />
		  <input type="hidden" name="qty3[]" value="<?=$qty3[$i]?>"  style="width:75px; height:13px;" />
    </label></td>
    <td style="border-right:#CCCCCC solid 1px;"><?=$this->site_function->price($qty1[$i],$pro['id'])?></td>
    <td class="qty" style="border-right:#CCCCCC solid 1px;">IN STOCK</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td><!--<img src="<?=temp_path?>/img/update.gif" >--></td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td>Mfg Part #:	</td>
    <td  style="border-right:#CCCCCC solid 1px;"><label>
      <input type="text" value="<?=$pro['mPartNum']?>" style="width:75px; height:13px;" />
    </label></td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td>&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  
  <tr align="center">
    <td><img src="<?=temp_path?>/img/datasheet.gif" ></td>
    <td>Mfg Name:</td>
    <td class="qty" style="border-right:#CCCCCC solid 1px;"><?=$this->site_function->manufacturer($pro['manufacturer'])?></td>
    <td rowspan="2" style="border-right:#CCCCCC solid 1px;"><img src="<?=temp_path?>/img/rohs.gif" ><br><img src="<?=temp_path?>/img/reach_unaffected.gif" ><br>Dec-2013</td>
    <td>&nbsp;</td>
    <td class="qty" style="border-right:#CCCCCC solid 1px;">Order   Qty 1</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
     <td><img src="<?=temp_path?>/img/delete.gif"  onclick="$('#del').val('<?=$i?>');$('#cnd').val('del');$('#frm').submit(); " style="cursor: pointer" ></td>
  </tr>
  <tr align="center" style="border-bottom:#CCCCCC solid 1px;">
    <td>&nbsp;</td>
    <td>Cust Ref:</td>
     <td  style="border-right:#CCCCCC solid 1px;"><label>
      <input type="text" value=" " name=" " style="width:75px; height:13px; margin-top:10px;" />
    </label></td>
    <td>&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;"><a href="#"><!--Alternate Packaging--></a></td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? }?>  
  
  <!-- 1st row end-->
  
 <!-- 2nd row start-->
 
  
<!--  <tr align="center" bgcolor="#F0F0F0">
    <td><img src="<?=temp_path?>/img/datasheet.gif" ></td>
    <td>Mfg Name:</td>
    <td class="qty" style="border-right:#CCCCCC solid 1px;">FAIRCHILD SEMICONDUCTOR (VA)</td>
    <td rowspan="2" style="border-right:#CCCCCC solid 1px;"><img src="<?=temp_path?>/img/rohs.gif" ><br><img src="<?=temp_path?>/img/reach_unaffected.gif" ><br>Dec-2013</td>
    <td>&nbsp;</td>
    <td class="qty" style="border-right:#CCCCCC solid 1px;">Order   Qty 1</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
     <td><img src="<?=temp_path?>/img/delete.gif" ></td>
  </tr>
  <tr align="center" bgcolor="#F0F0F0" style="border-bottom:#CCCCCC solid 1px;">
    <td>&nbsp;</td>
    <td>Cust Ref:</td>
     <td  style="border-right:#CCCCCC solid 1px;"><label>
     <input type="text" value=" " name=" " style="width:75px; height:13px; margin-top:10px;" />
    </label></td>
    <td>&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;"><a href="#">Alternate Packaging</a></td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td style="border-right:#CCCCCC solid 1px;">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
  
  
  
  <!-- 2nd row end-->
</table>
		<p>&nbsp;</p>
		<input type="hidden" name="del" id="del" />
		<input type="hidden" name="id" value="<?=$data['id']?>"  />
		<input type="hidden" name="cnd" id="cnd" />
		<input name="<?=frontend?>" type="hidden" value="ecommerce/editBom" />
		
		<input type="submit" value="Add to Current Cart" onclick="$('#cnd').val('cart');" />
		<input type="submit" value="Create Kit"  />
		<input type="submit" value="Save Changes" onclick="$('#cnd').val('save');" />
		</form>
		
		<p>&nbsp;</p>
		
		
		</div>