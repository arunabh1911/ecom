<link rel="stylesheet" type="text/css" href="<?=temp_path?>/css/global.css" />
<script>
function cart_del(e,id) {
	
	$(e).hide();
	$.ajax({
		url: '',
		type: 'POST',
		data: { <?=frontend?>: "ecommerce/cartDel", product_col: id,  ship: '0' },
  	
		success: function(data) {
		//
		var sid = (data.split("|"));
		$(e).parents('tr').find("td").css({
        'color': '#fff',
        'font-weight':'bold',
        'background-color': 'skyblue'
    	}).fadeOut('slow', function () {
        $(this).parent().remove();
   		});
		//
		document.getElementById('grand1').innerHTML = parseFloat(sid[1])+parseFloat(sid[0]);
		document.getElementById('sub1').innerHTML = parseFloat(sid[1]);
		}
	});
}

function chck() {
if(document.getElementById('nos').checked==true)
	{
		document.getElementById('bill').style.display="none";
		//val_add(add,'test');
	}
else
	{
		document.getElementById('bill').style.display="";
	}
}

function val_add(add,gg){

	var chk=0;
	if(document.getElementById('nos').checked==true) {
		var chk=1;
	}
	
		$.ajax({
		url: '',
		type: 'POST',
		data: { <?=frontend?>: "ecommerce/ShipBill", add: add,  chk: chk, acts: gg },
  	
		success: function(data) {
			sid = (data.split("|"));
			
			if(gg!='test1') {
				document.getElementById('del').innerHTML = sid[0];
				document.getElementById('ship_add').value = add;
			
			} if(sid[1]) {
				document.getElementById('bil').innerHTML = sid[1];
				document.getElementById('bill_add').value = add;
			}
		}
	});
}

function promoCode(val,typ){

	$.ajax({
		url: '',
		type: 'POST',
		data: { <?=frontend?>: "ecommerce/promoCode", val: val,  type: typ },
  	
		success: function(data) {
		alert(data);
			//sid = (data.split("|"));
			
		
		}
	});
}

function inv() {
	
	if(document.getElementById('firstname').value=='')
	{
		alert('!! Please Enter First Name !!');
		document.getElementById('firstname').focus();
		return false;
	}
	else if(document.getElementById('lastname').value=='')
	{
		alert('!! Please Enter Last Name !!');
		document.getElementById('lastname').focus();		
		return false;
	}
	else if(document.getElementById('address').value=='')
	{
		alert('!! Please Enter Address !!');
		document.getElementById('address').focus();		
		return false;
	}
	else if(document.getElementById('city').value=='')
	{
		alert('!! Please Enter City !!');
		document.getElementById('city').focus();		
		return false;
	}
	else if(document.getElementById('pincode').value=='')
	{
		alert('!! Please Enter Pincode !!');
		document.getElementById('pincode').focus();		
		return false;
	}
	else if(document.getElementById('state').value=='')
	{
		alert('!! Please Enter State !!');
		document.getElementById('state').focus();		
		return false;
	}
	else if(document.getElementById('country').value=='')
	{
		alert('!!Please Enter Country !!');
		document.getElementById('country').focus();		
		return false;
	}
	else if(document.getElementById('mobileNo').value=='')
	{
		alert('!! Please Enter Contact No.  !!');
		document.getElementById('mobileNo').focus();		
		return false;
	}
	
}
</script>

<div style="padding-left:25px;">
  <div id="">
    <div id="" > <br>
    </div>
  </div>
  <p class="p-class-2" />
  <div id=""></div>
  <span id=""></span>
  <div id="" style="color:Red;display:none;"> </div>
  <br />
  <span id=""></span> <br />
  <div id=""> <span id=""></span> <span id="" class="categoryHeading">102-1126-ND added to order.</span>
    <p class="pricing-value-hint"> <span id="" class="categoryHeading">Pricing is valid for this Web ID until 3/6/2015 if you place your order online </span> </p>
    <span id=""> </span>
    <p class="help-info"> <span id=""><B>Quantities are not reserved until the order has been submitted.</B> You will be reminded of backorder quantities at submit time. Available quantities may have changed due to real time inventory.  To check current availability, click the "Update Stock Status" button below.</span> </p>
    <span id=""></span> <br />
    <div id="">
      <table id="">
        <tr>
          <td>&nbsp; <span id="" style="font-weight:bold;">Add to Cart:</span>&nbsp;&nbsp; </td>
          <td id="" style="border-right-width:1px;border-right-style:solid;border-right-color:black;">&nbsp; <span id="" class="lblClass" style="font-weight:bold;">Manually</span><a onClick="" id="" class="lnkClass" href="#" style="display: none">Manually</a>&nbsp;&nbsp; </td>
        
        </tr>
      </table>
      <br />
    </div>
    <div id="" class="pnlClass">
	<? //session_start; session_destroy(); ?>
	<form name="addform" method="post" action="">
      <table id="" class="tblborder" cellspacing="0" cellpadding="3" style="border-width:2px;border-style:solid;border-collapse:collapse;">
        <tr class="tblhead">
          <th class="tblborder" align="center" style="border-width:1px;border-style:solid;"><span id="" class="categoryHeading">Quantity</span></th>
          <th class="tblborder" align="center" style="border-width:1px;border-style:solid;"><span id="" class="categoryHeading">Part Number</span></th>
          <th class="tblborder" align="center" style="border-width:1px;border-style:solid;"><span id="" class="categoryHeading"><a target="_blank" href="#" >Customer Reference</a></span></th>
          <th class="tblborder" style="border-width:1px;border-style:solid;">&nbsp; </th>
        </tr>
        <tr style="border-width:1px;border-style:solid;">
          <td style="border-width:1px;border-style:solid;white-space:nowrap;">
		  <input name="product_qty" type="text" maxlength="9" style="width:65px;" />
            </td>
          <td style="border-width:1px;border-style:solid;white-space:nowrap;">
		  <input name="product_name" type="text" maxlength="48" id="" style="width:290px;" />
            </td>
          <td style="border-width:1px;border-style:solid;"><input name="" type="text" maxlength="48" id="" style="width:145px;" /></td>
          <td align="center" style="border-width:1px;border-style:solid;">
		  <input type="submit" name="" value="Add to Cart" />
		<input name="chk" type="hidden" value="yes">
		<input name="<?=frontend?>" type="hidden" value="ecommerce/addToCart" />              


</td>
        </tr>
      </table>
	  </form>
    </div>

    <br />
    <p class="p-class-4" />
    <table id="" class="tblborder sodisplay" cellspacing="0" cellpadding="3" style="border-width:2px;border-style:solid;border-collapse:collapse;">
      <tr data-rowtype="OuterRow" style="border-bottom: solid 2px #C0C0C0; border-right: solid 2px white; border-left: solid 2px white; border-top: solid 2px white;">
        <th align="right" colspan="10"><span><!--All prices are in US dollars.--></span></th>
      </tr>
      <tr id="" class="tblhead" data-rowtype="HeaderRow">
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><img id="" class="pszoomie psshadow" src="" style="border-width:0px;display:none;" /><span id="">Index</span></th>
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><span id="">Quantity</span></th>
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><span id="">Image</span></th>
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><span id="">Part Number</span></th>
        <th id="" class="tblborder" align="center" style="border-width:1px;border-style:solid;"><span id="">Description</span></th>
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><span id="">Customer Reference</span></th>
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><span id="">Available Quantity</span></th>
        <th id="" class="tblborder" style="border-width:1px;border-style:solid;"><span id="">Backorder Quantity</span></th>
        <th id="" class="tblborder" align="center" style="border-width:1px;border-style:solid;"><span id="">Unit Price</span></th>
        <th id="" class="tblborder" align="center" style="border-width:1px;border-style:solid;"><span id="">Extended Price</span></th>
      </tr>

<? 
//session_destroy();
//echo '<pre>'; print_r($_SESSION);
$product=explode(",", $_SESSION['product_id']);
$qty=explode(",", $_SESSION['product_qty']);
$price=explode(",", $_SESSION['product_price']);
$img=explode(",", $_SESSION['product_img']);
$col=explode(",", $_SESSION['product_col']);
$siz=explode(",", $_SESSION['product_siz']);
for($i=0; $i< count($img); $i++){
$qry = $this->db->runQuery("select * from ".PRODUCT." where id='$product[$i]'"); 
$data = $this->db->getQuery($qry);
if ($data){
?>  	  
	  
      <tr style="border-width:1px;border-style:solid;">
        
		<td style="border-width:1px;border-style:solid;"><a href="#" onClick="return cart_del(this,'<?=$col[$i]?>')" ><img id="" src="<?=temp_path?>/img/close-x.png" style="height:10px;width:10px;" /></a> 1</td>
		
        <td align="center" > <?=$qty[$i]?>  </td>
        
		<td style="border-width:1px;border-style:solid;"><img src="<?=img_path.$img[$i];?>" style="height:64px;width:64px;" /></td>
		
        <td style="border-width:1px;border-style:solid;"><a id="" href="#"><?=ucwords($data['partNum'])?></a></td>
		
		<td align="center" style="border-width:1px;border-style:solid;"><?=ucwords($data['description'])?></td>
		
        <td style="border-width:1px;border-style:solid;"><input name="" type="text" style="width:145px;" /></td>
        
		<td align="center" style="border-width:1px;border-style:solid;"><?=$qty[$i]?><br/>Immediate</td>
		
        <td align="center" style="border-width:1px;border-style:solid;"> 0 <br /></td>
		
        <td align="right" style="border-width:1px;border-style:solid;"><?=siteCurrency?><?=$tot=$price[$i];?> &nbsp;  </td>
		
        <td align="right" style="border-width:1px;border-style:solid;white-space:nowrap;"><?=siteCurrency?><?=$tot=$price[$i]*$qty[$i];?> &nbsp;</td>
      </tr>
	  
 <?  $_SESSION['totalamount'] = $tot1+=$tot; } else{?>
<tr>
	<td colspan="7">There are no items in your shopping cart yet.</td>
</tr>
<? } 
}//coupon
$cpn=0;
if(@$_SESSION['coupon']['per'])
{
	$cpn=$tot1*$_SESSION['coupon']['per']/100;
}?>	  
	  
      <tr >
        <td colspan="8"></td>
        <td style="white-space:nowrap;">Subtotal</td>
        <td id="" align="right"><?=siteCurrency?><?=$tot1-$cpn?> &nbsp;</td>
      </tr>
      <tr>
        <td id="" colspan="8"></td>
        <td id="" style="white-space:nowrap;"><span id="" class="categoryHeading">Shipping</span></td>
        <td id="" align="right"><a id="" class="categoryHeading" onClick="" href="#">Estimate</a> &nbsp; </td>
      </tr>
      <tr>
        <td id="" colspan="8"></td>
        <td id="" style="white-space:nowrap;"><span id="" class="categoryHeading">Total</span></td>
        <td id="" align="right">unknown &nbsp; </td>
      </tr>
    </table>
	
    <p class="p-class-5" />
   <!-- <p class="update-stock-status-wrapper">
      <input type="submit" name="" value="Update Stock Status" id="" />
    </p>-->
  <!--  <p class="shipping-outside-hint"> <a id="" onClick="" href="#">Are you shipping outside the United States?<br>-->
      <br>
      </a> <span id="">Fields marked as unknown cannot be determined at this time.<br>
      Applicable taxes will be added to your order at submit time unless you have a tax exempt certificate on file with us.<br>
      All duties and taxes are the responsibility of the customer.<br>
      These commodities, technology or software will be exported from the United States in accordance with the Export Administration regulation.  Diversion contrary to U.S. law prohibited.</span> </p>
    <table width="40%" id="">
      <tr>
        <td><input type="submit" name="" value="Checkout" style="width:250px;" onclick="window.location='<?=site_url?>/checkout/'" /></td>
        <!--<td id=""><input type="submit" name="" value="Fast Add" id="" /></td>
        <td id=""><input type="submit" name="" value="New Cart" id="" /></td>
        <td id=""><input type="submit" name="" value="Resume Cart" id="" /></td>
        <td><input type="submit" name="" value="Share Cart" onClick="" id="" /></td>-->
      </tr>
    </table>
    <div id=""></div>
    <div id="">
      <script type="text/javascript">
            $.ajaxSetup({ cache: false });
            CurrencySetter.refresh = function () {
                $.get("../Ordering/CurrencySmall.aspx?cscur=" + CurrencySetter.currency, function (data) {
                    var contents = $(data);
                    var redirectText = contents.find("#redirect");
                    if (redirectText.length != 0) {
                        window.location = redirectText.html();
                    }
                    else {
                        var titleText = contents.find("#title").detach().html();
                        var dialogHeight = contents.find("#height").detach().html();
                        if (!dialogHeight) {
                            dialogHeight = 500;
                        }
                        contents.dialog({
                            height: dialogHeight,
                            width: 450,
                            title: titleText,
                            close: function (event, ui) { javascript: document.getElementById('btnOld').click(); },
                            modal: true
                        });
                    }
                });
            }

            function GetCartShareDialogOpts() {
                var btns = {};
                btns[window.CartShareData.attr("close")] = function () { $(this).dialog("destroy"); };
                return {
                    open: function (event, ui) { $("#tbxShortUrl").focus(); },
                    resizable: false,
                    modal: true,
                    closeOnEscape: true,
                    close: function (e) { $(this).dialog('destroy'); },
                    buttons: btns,
                    title: window.CartShareData.attr("title")
                };
            }

            function dlgCartShare() {
                if (!window.CartShareDialog || !window.CartShareData) {
                    var url = "/Classic/Ordering/Dialog/CartShareDialog.aspx";
                    $.get(url, function (data) {
                        window.CartShareData = $(data);
                        window.CartShareDialog = $("#divCartShare");
                        window.CartShareDialog.html(window.CartShareData);
                        window.CartShareDialog.dialog(GetCartShareDialogOpts());
                    });
                }
                else {
                    window.CartShareDialog.dialog(GetCartShareDialogOpts())
                }
            }
        </script>
    </div>
  </div>
   <br />
 <!-- <a id="" class="categoryHeading" onClick="" href="#">Contact our Internet Ordering Department if you have any questions</a> &nbsp;<br />-->
  &nbsp;<br />
</div>
