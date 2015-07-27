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
<div style="padding-left:25px;"> <br />
  <div style=" font-size: 12px;"> <span id=" " style="font-weight:bold;">
    <h3>BOM Manager</h3>
    <br />
  </div>
  <div>
    <table class="displayMode tblborder" cellspacing="0" cellpadding="3" style="border-color:#C0C0C0;border-width:2px;border-style:solid;width:255px;border-collapse:collapse;">
      <tr class="tblhead">
        <th class="tblborder" style="color:Black;border-width:1px;border-style:solid;">Quote / Ordering </th>
      </tr>
      <tr>
        <td><a href="<?=site_url?>/bom-manager-part-list/" style="color:Blue;">Create New Parts List (Manually)</a></td>
      </tr>
      <tr>
        <td><a href="#" style="color:Blue;">Create New Parts List (Upload File)</a></td>
      </tr>
     </table>
	 
	 &nbsp;&nbsp;&nbsp;
	 
    <table class="displayMode tblborder" cellspacing="0" cellpadding="3" style="border-color:#C0C0C0;border-width:2px;border-style:solid;width:255px;border-collapse:collapse;">
      <tr class="tblhead">
        <th class="tblborder" style="color:Black;border-width:1px;border-style:solid;">BOMs / Kits</th>
      </tr>
      <tr>
        <td><a href="<?=site_url?>/bom-manager-part-list/BomName/" style="color:Blue;">Create New BOM (Manually)</a></td>
      </tr>
      <tr>
        <td><a href="<?=site_url?>/my-profile/" style="color:Blue;">Create New BOM (Upload File)</a></td>
      </tr>
	    <tr>
        <td><a href="<?=site_url?>/bom-list/" style="color:Blue;">View List of Saved BOMs</a></td>
      </tr>
     </table>
    </div>
  <br />
  <br />
  <br />
  <br />
  <br />
</div>
