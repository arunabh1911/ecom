<? $slug = explode('/',$_REQUEST['slug']);
$dob = explode('-',dateFormt($user->dob));
$name = explode(' ',$user->name);
$this->load->controller('ecommerce');
$msg = $this->ecommerce->paymentResponse($slug);
?>
<style type="text/css">
	.displayMode
	{
		display:inline-table;				
	}

</style>

<div style="padding-left:25px;">
<br />

 <div style=" font-size: 12px;">
                    <span id=" " style="font-weight:bold;">Welcome <?=$user->name;?><br/><br/><b>Customer Number:</b> <?=$user->uniqueId;?></span>
                    <br />
                    
                    
                    <a href="#">Logout</a>
                    <br />
                    <p><span id=" "></span></p>
                </div>                
                <div id="techxchange_banner" style="margin:30px 0px; width:510px; border:solid 1px #999999; padding:5px;"><img src="<?=temp_path?>/img/tx_logo.jpg" width="173" height="26" style="float:left; margin:0px 10px 5px 0px" />
<p>Check out <a href="#">TechXchange</a><sup style="font-size:9px;">SM</sup>,  <?=title?>&rsquo;s online community, to participate in engineering-focused discussions  and ask questions.</p></div>
                <div style="text-align: center; font-size: 18px; width: 712px;">
                    <br /><span id=" " style="font-weight:bold;">My <?=title?></span>
                    <br /><br />
                </div>
                
                <div ><table class="displayMode tblborder" cellspacing="0" cellpadding="3" style="border-color:#C0C0C0;border-width:2px;border-style:solid;width:255px;border-collapse:collapse;">
		<tr class="tblhead">
			<th class="tblborder" style="color:Black;border-width:1px;border-style:solid;">Quote / Ordering
</th>
		</tr><tr>
			<td><a href="#" style="color:Blue;">Create New Order</a></td>
		</tr><tr>
			<td><a href="#" style="color:Blue;">Part Search</a></td>
		</tr><tr>
			<td><a style="color:Blue;">&nbsp;</a></td>
		</tr><tr>
			<td><a href="<?=site_url?>/bom-manager-list/" style="color:Blue;">Parts List / BOM Manager
</a></td>
		</tr><tr>
			<td>&nbsp;</td>
		</tr><tr>
			<td>&nbsp;</td>
		</tr>
	</table>&nbsp;&nbsp;&nbsp;&nbsp;<table class="displayMode tblborder" cellspacing="0" cellpadding="3" style="border-color:#C0C0C0;border-width:2px;border-style:solid;width:255px;border-collapse:collapse;">
		<tr class="tblhead">
			<th class="tblborder" style="color:Black;border-width:1px;border-style:solid;">Miscellaneous</th>
		</tr><tr>
			<td><a href="<?=site_url?>/contact-us/" style="color:Blue;">Contact <?=title?></a></td>
		</tr><tr>
			<td><a href="<?=site_url?>/my-profile/" style="color:Blue;">My Profile</a></td>
		</tr><tr>
			<td><a href="#" style="color:Blue;">RoHS Compliance</a></td>
		</tr>
	</table>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <br /><br />
                <div id="#"><table class="displayMode tblborder" cellspacing="0" cellpadding="3" style="border-color:#C0C0C0;border-width:2px;border-style:solid;width:255px;border-collapse:collapse;">
		<tr class="tblhead">
			<th class="tblborder" style="color:Black;border-width:1px;border-style:solid;">Existing Orders</th>
		</tr><tr>
			<td><a href="#" style="color:Blue;">Delete Previous Orders</a></td>
		</tr><tr>
			<td><a href="#" style="color:Blue;">Order History By Part</a></td>
		</tr><tr>
			<td><a href="#" style="color:Blue;">Order Status</a></td>
		</tr><tr>
			<td><a href="#" style="color:Blue;">Web Order History</a></td>
		</tr><tr>
			<td>&nbsp;</td>
		</tr><tr>
			<td>&nbsp;</td>
		</tr>
	</table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div id="">
                    <a id="">&nbsp;</a>
                </div>
                
            
    </div>

