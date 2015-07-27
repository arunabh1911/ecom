<?php 
$slug = array_filter(explode('/',$_REQUEST['slug']));
$sub= $this->db->getQuery($this->db->runQuery("Select * from ".CAT." where id=".$pageDetail->catId."")); 
$cat= $this->db->getQuery($this->db->runQuery("Select * from ".CAT." where id=".$sub['category_parent']."")); 
$data = $this->db->getQuery($this->db->runQuery("select * from ".PRODUCT." where slug = '".end($slug)."' "));
$par = explode(',',$sub['parameter']);
//print_r($par);?>
<style type="text/css" media="screen">

#content {
  margin: 0;
  padding: 20px;
}

.pszoomie {
	position: fixed;
	border: solid black 1px;
}

.psshadow {
	-moz-box-shadow: 3px 3px 5px 6px #ccc;
	-webkit-box-shadow: 3px 3px 5px 6px #ccc;
	box-shadow: 3px 3px 5px 6px #ccc;
	/* For IE 8 */
/*	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=8, Direction=135, Color='#C0C0C0')";*/
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=16, Direction=135, Color='#C0C0C0');
}

.ps-same-values {
	background: #F0F0F0;
}

.ps-sortButtons {
    width:50%;
    height:100%;
    float:left;
    border-width: 1px;
    border-color:ButtonShadow;
    background-color:#E0E0E0;
    margin:0px;
    cursor: pointer;
}

#productTable thead
{
    background-color:#E0E0E0;
}

.ps-headerColumn
{
    min-width:60px;
}

.ps-sortingCell
{
    padding:0px;
}




/* GLOBAL */

body, span, div, p, pre, blockquote, a, b, ol, ul, dl, li, dt, dd, th, td, table, input, select, option, h1, h2, h3, h4, h5, h6, code {
	font-size: 12px;
}

h1 {
	font-size: 18px;
}

h2 {
	font-size: 14px;
}

body {
	margin: 0px;
	background: white;
}

div#content {
	margin-left: 10px;
	margin-right: 10px;
}

div.weaz {
	width: 660px;
}


.alert, 
.qtynote {
	color: red;
}	

tr.evenrow {
	background: #F0F0F0;
}

input.button {
	background: #F0F0F0;
}

table.border {
	border: 1.5pt solid #F0F0F0;
}

th.tablehead {
	background: #F0F0F0;
}

th.groupheader {
	background: #F0F0F0;
	font-size: medium;
}

a.attributename {
	color: black;
	font-weight: bold;
	text-decoration:none;
}

td.comparerow {
	background: #F0F0F0;
}

/* INTERNET CATALOG */

a.CatIpg:link {
	color: #003399;
	text-decoration: none;
	font-weight: 500;
}

a.CatIpg:visited {
	color: #CC0000;
	text-decoration: none;
	font-weight: 500;
}

a.CatIpg:hover {
	color: #FF0000;
	text-decoration: underline;
	font-weight: 500
}

a.CatIpg:active {
	color: #003399;
	text-decoration: none;
	font-weight: 500
}

/* TABLE DISPLAY */

table.tblborder {
	border-bottom: solid 1.5px #C0C0C0;
	border-left: solid 1.5px #C0C0C0;
}

table.tbladdressformat {
	border-bottom: solid 1.5px #C0C0C0;
	border-left: solid 1.5px #C0C0C0;
	height: 10em;
}

table.tblshippingmethodformat {
	border-bottom: solid 1.5px #C0C0C0;
	border-left: solid 1.5px #C0C0C0;
	width: 40em;
}

table.tblrumenucolumn {
	border-bottom: solid 1.5px #C0C0C0;
	border-left: solid 1.5px #C0C0C0;
	width: 250px;
	height: 10em;
}

th.tbltablehead {
	background: #F0F0F0;
	border-right: solid 1.5px #C0C0C0;
	border-top: solid 1.5px #C0C0C0;
	padding-right: 12px;
	padding-left: 12px;
}

th.tbltableheadred {
	background: #FF0000;
	border-right: solid 1.5px #C0C0C0;
	border-top: solid 1.5px #C0C0C0;
}

th.tbltableheadwhite {
	background: #FFFFFF;
	border-right: solid 1.5px #C0C0C0;
	border-top: solid 1.5px #C0C0C0;
}

td.tblborder {
	border-right: solid 1.5px #C0C0C0;
	border-top: solid 1.5px #C0C0C0;

	padding-right: 12px;
	padding-left: 12px;
}

tr.tblevenrow {
	background: #F0F0F0;
	border-right: solid 1.5px #C0C0C0;
}

tr.tbloddrow {
	background: #FFFFFF;
	border-right: solid 1.5px #C0C0C0;
}




/* partsearch */

.catfiltertopitem { 
	font: large bold; 
	text-decoration: none;
    font-family:Arial,Helvetica,sans-serif;
}

.catfiltertopitem > a { 
	font: large bold; 
	text-decoration: none;
    font-family:Arial,Helvetica,sans-serif;
}

.catfiltertopitem > :link { 
	color: black; 
}
.catfiltertopitem > :visited { 
	color: black; 
}
.seohtag { 
	font-size: small; 
	margin: 0; 
	font-weight: normal; 
}
.seohtagbold { 
	font-size: small; 
	margin: 0; 
	font-weight: bold; 
}
/*.catfiltersub { font-weight: bold; }*/
.catfilterlink { 
	 
}
.sectiontitle { 
	font-weight: bold; 
	font-size: larger; 
	background: #E0E0E0; 
}


/* part detail gray theme for beablocks */
.beablock-image, .beablock-notice p {
	border: solid #999 1px;
	background-color:#eeeeee;
}
.beablock {
	border: solid #999 1px;
	margin-bottom: 10px;
	max-width:1100px;
}

.beablock-image {
	padding:5px;
	width:210px;
	text-align: center;
	margin-left: 10px;
}

	.rtl .beablock-image {
		margin-left:0;
		margin-right:10px;
	}

.beablock-image img {
	border:solid 1px #999999;
	margin-top:5px;
}

.image-disclaimer {
	font-size:11px;
}

.beablock-notice p {
	font-weight: bold;
	padding:10px;
	margin-bottom:10px;
}

.beablocktitle { 
	background-color:#eee; 
	padding:5px; 
    font-weight:bold;
	border-bottom:solid 1px #999;
	width:auto !important;
}

.beablocktitle img {
	margin-right:10px;
}

	.rtl .beablocktitle img {
		margin-right:0;
		margin-left:10px;
	}

.beablock-title /* subtext for beablock title sets */ {
	font-weight:normal;
}

.beablock table td {
	border:none;
}

/* right side tables */
.product-details, .product-additional-info table, .product-details-reel-pricing, .product-details-discount-pricing {
	border-collapse: collapse;
}

.product-details-alternate-packaging, .product-details-also-evaluated, .product-details-suggested-subs, .product-details-rohs-subs, .product-details-video table {
	width:100%
}
.rd-extra-option p {
	padding:5px;
	margin:5px 0;
}

.rd-extra-option tr td {
	vertical-align:middle !important;	
}

 .product-details-reel-pricing th, .product-details-reel-pricing td, .product-details-reel-pricing tr, 
.attributes-table-main table, .attributes-table-main td, .attributes-table-main th, 
.product-details, .product-details tr, .product-details td, .product-details th, .product-details-discount-pricing td, .product-details-discount-pricing th {
	border:#999 solid 1px;
}

.product-details th, .product-details td, 
.attributes-table-main th, .attributes-table-main td,
.product-details-discount-pricing th, .product-details-discount-pricing td {
	padding:3px 5px;
}

.product-details-alternate-packaging th, .product-details-alternate-packaging td, 
.product-details-suggested-subs th, .product-details-suggested-subs td, 
.product-details-rohs-subs th, .product-details-rohs-subs td  {
	text-align: left;
	padding:5px;
}

	.rtl .product-details-alternate-packaging th, .rtl .product-details-alternate-packaging td, 
	.rtl .product-details-suggested-subs th, .rtl .product-details-suggested-subs td, 
	.rtl .product-details-rohs-subs th, .rtl .product-details-rohs-subs td  {
		text-align: right;
	}

.product-details-video th {
    text-align: left;
}
        .rtl .product-details-video th {
            text-align: right;
        }

.product-details-alternate-packaging th, 
.product-details-suggested-subs  th, 
.product-details-rohs-subs th {
	background-color:#333; 
	color:#fff; 
	border:none;
}

.product-details-alternate-packaging tr:nth-child(odd), 
.product-details-suggested-subs tr:nth-child(odd), 
.product-details-rohs-subs tr:nth-child(odd) {
	background-color:#eee;
}

.product-details-alternate-packaging a img, 
.product-details-suggested-subs a img, 
.product-details-rohs-subs a img, 
.product-details-also-evaluated {
	vertical-align: middle;
}

.product-details th, 
.attributes-table-main th, 
.product-details-reel-pricing th,
.product-details-discount-pricing tr:first-of-type th {
	background-color:#eee; 
	padding:3px 5px;
	color:#000;
  border:#999 solid 1px;
}

.update-quantity a img,
.attributes-table-main table a img {
	vertical-align: middle;
}

.product-details-also-evaluated{
    overflow:hidden;
}

.also-eval-list-div {
	display:table-cell;
	width:20%;
	padding:10px 5px;
}

.also-eval-list-div ul {
	margin:0px;
	padding:0px;
}

.product-details-also-evaluated ul{
    list-style-type: none;
    text-align:center;
}

.more-expander img {
	border-color:#999;
}

/* space out the tables and form button */
.attributes-table-main table {
    margin-right: 5px;
	margin-bottom: 5px;
}

	.rtl .attributes-table-main table {
		margin-right: 0;
		margin-left:5px;
	}

.attributes-table-main form input {
	margin-right:5px;
}

	.rtl .attributes-table-main form input {
		margin-right:0;
		margin-left:5px;
	}

/* product detail pricing table */
.pricing-description  {
	background-color:#eee; 
	font-weight:bold; 
	padding:3px !important;
}

.catalog-pricing {
	padding:0 !important;
}

#pricing {
	width:100%
}

.product-details-reel-pricing td {
	padding:0;
}

.content-digireelPricing-form td {
	padding:3px 5px
}

#pricing th, .content-digireelPricing-form th, .product-details-discount-pricing th {	
	background-color:#333; 
	color:#fff; 
	padding:3px 5px;
	border:none;
}

#pricing td {
	padding:2px 5px;
	/*border-color:#000;*/
}


/* misc */
.list-item-vendor{
    font-weight:bold;
}                                  
 
.list-item-descript{
    word-wrap:break-word;
}     

.list-item-unitprice{
    font-weight:bold;
}  

.relatedpartslist { 
	list-style: inside; 
	margin: 0; 
	padding: .5em; 
}

list.relatedparts { 
	list-style: inside; 
	margin: 0; 
	padding: .5em; 
}

.altpkglink { 
	color: blue; 
}

.roundCorners {
	border:solid 1px black;
	padding:1em;
	-moz-border-radius:20px;
	-webkit-border-radius:20px;
	-khtml-border-radius:20px;
	border-radius:20px;
}

.digiGray {
	background:#E0E0E0;
}

#mask {
    position: absolute;
    background-color: black;
    top: 0px;
    left: 0px;
    display: none;
    width: 3200px;
    height: 3200px;
    opacity: 0.8;
    -moz-opacity: 0.8;
    filter: alpha(opacity=80);
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    z-index: 10000;
}

</style>
<div class="main2-wrapper">
<div class="container">
  <div class="row-fluid-main2">
    <form action="" name="frm2" method="post">
      <div class="kyeword">
        <p>Keywords: <img src="<?=temp_path?>/img/help.png"></p>
        <input type="text" name="text" class="keyword_input">
        <!--<p class="keyword_p"><img src="<?=temp_path?>/img/fb.png"> 
				<img src="<?=temp_path?>/img/twitter.png"> 
				<img src="<?=temp_path?>/img/linkedin.png"> 
				<img src="<?=temp_path?>/img/google-+.png"> 
				<img src="<?=temp_path?>/img/email.png"> | 
				<img src="<?=temp_path?>/img/link.png"></p>-->
        <div class="clear"></div>
        <div class="checkbox_keyword">
          <p>
            <input type="checkbox">
            <b>In stock</b></p>
          <p>
            <input type="checkbox">
            <b>Lead free</b></p>
          <p>
            <input type="checkbox">
            <b>RoHS Compliant</b></p>
          <input type="submit" value="Search Again" class="search_again">
          <input name="stype"type="hidden" value="part" />
          <input name="<?=frontend?>" id="act" type="hidden" value="user/search" />
        </div>
      </div>
    </form>
    <div class="add_to_cart">
      <h5><a href="<?=site_url?>/product-search/">Product Index</a> > <a href="<?=site_url?>/product-search/<?=$cat['slug']?>">
        <?=$cat['category_title']?>
        </a> > <a href="<?=site_url?>/category/<?=$sub['slug']?>">
        <?=$sub['category_title']?>
        </a> >
        <?=$pageDetail->name?>
      </h5>
      <table class="product-details-table" cellspacing=1 border=0 itemscope itemtype="#">
        <tr class="product-details-basic">
          <td class="product-details-main" valign=top><table class="product-details" border=1 cellspacing=1 cellpadding=2>
              <tr class="product-details-top"></tr>
              <tr class="product-details-bottom">
                <td class="pricing-description" colspan=3 align=right><!--All prices are in US dollars-->.</td>
              </tr>
              <tr>
                <th align=right><?=title?> Part Number</th>
                <td id=reportpartnumber><meta itemprop="productID" content="sku:102-1126-ND" />
                  <?=@$data['partNum']?></td>
                <td class="catalog-pricing" rowspan=6 align=center valign=top><table id=pricing frame=void rules=all border=1 cellspacing=0 cellpadding=1>
                    <tr>
                      <th>Price Break</th>
                      <th>Unit Price</th>
                      <th>Extended Price </th>
                    </tr>
                    <tr>
                      <td align=center >1</td>
                      <td align="right" ><?=$data['price']?></td>
                      <td align="right" ><?=number_format((float)$data['price'], 2, '.', '');?></td>
                    </tr>
                    <!--<tr>
                      <td align=center >10</td>
                      <td align="right" >1.25700</td>
                      <td align="right" >12.57</td>
                    </tr>
                    <tr>
                      <td align=center >100</td>
                      <td align="right" >0.95850</td>
                      <td align="right" >95.85</td>
                    </tr>
                    <tr>
                      <td align=center >500</td>
                      <td align="right" >0.76680</td>
                      <td align="right" >383.40</td>
                    </tr>
                    <tr>
                      <td align=center >1,000</td>
                      <td align="right" >0.68160</td>
                      <td align="right" >681.60</td>
                    </tr>
                    <tr>
                      <td align=center >2,500</td>
                      <td align="right" >0.56658</td>
                      <td align="right" >1,416.45</td>
                    </tr>-->
                  </table></td>
              </tr>
                 <tr>
                <th align="right"> Quantity Available </th>
                <td class="col"><?=title?>
                  Stock:
                  <?=@$data['quantity']?>
                  Can ship immediately</td>
              </tr>
              <tr>
                <th align="right"> Manufacturer </th>
                <td class="col"><?=$this->site_function->manufacturer($data['manufacturer'])?></td>
              </tr>
              <tr>
                <th align="right"> Manufacturer Part Number </th>
                <td class="col"><?=@$data['mPartNum']?></td>
              </tr>
              <tr>
                <th align="right"> Description </th>
                <td class="col"><?=@$data['description']?></td>
              </tr>
              <tr>
                <th align="right"> Lead Free Status / RoHS Status </th>
                <td class="col"><?=@$data['leadStatus']?></td>
              </tr>
            </table>
            <div id='mask'>&nbsp;</div>
            <p>
            <table class="update-quantity" width="98%">
              <tr>
                <th class="quantity" valign=top>Quantity</th>
                <th class="item-number" valign=top>Item Number
                  &nbsp;<a href="javascript:dlgHelp('Item%20Number%20Help');"><img src="<?=temp_path?>/img/help.png" alt="?" border="0"></a>&nbsp;</th>
                <th class="customer-reference" valign=top>Customer Reference</th>
              </tr>
              <tr>
                <form name="addform" method="post" action="">
                 
                  <td class="quantity"><input type="text" name="product_qty" size=9 maxlength=9 value="1"></td>
                  <td class="item-number"><select>
                      <option value="102-1126-ND">102-1126-ND
                      <option value="CEB-20D64">CEB-20D64
                    </select></td>
                  <td class="customer-reference"><input type=text id='cref' name=cref size=20 maxlength=48 value=""></td>
                  <td class="add-to-order">
				  <input type="submit" value="Add to Cart" >
                  </td>
                 

<input name="product_name" type="hidden" value="<?=@$data['mPartNum']?>">
<input name="product_id" type="hidden" value="<?=@$data['id']?>">
<input name="product_price" type="hidden" value="<?=$data['price']?>" >
<input name="product_img" type="hidden" value="<?=$data['productPhoto']?>" />
<input name="product_col" type="hidden" value="nocol<?=@$data['id']?>"  />
<input name="product_siz" type="hidden" />
<input name="<?=frontend?>" type="hidden" value="ecommerce/addToCart" />              
</form>

              </tr>
            </table></td>
          <td class="image-table" valign=top><div class="beablock-image"> <a href="#"><img border=0 width=200 itemprop="image" src="<?=img_path.$data['productPhoto']?>" alt="CEB-20D64 CUI Inc | 102-1126-ND DigiKey Electronics" title="CEB-20D64 CUI Inc | 102-1126-ND DigiKey Electronics"></a> <br />
              <p class="image-disclaimer">Image shown is a representation only.  Exact specifications should be obtained from the product data sheet.</p>
            </div></td>
        </tr>
      </table>
      <div class="banner">
        <p>When requested quantity exceeds displayed pricing table quantities, a lesser unit price may appear on your order.<br>
          You may submit a request for quotation on quantities which are greater than those displayed in the pricing table.</p>
        <table cellpadding="2" cellspacing="1" border="1" class="table_2">
          <tr>
            <th align="right">Datasheets</th>
            <td><a href="<?=img_path.$data['datasheet']?>" target="_blank">
              <?=@$data['mPartNum']?>
              </a></td>
          </tr>
          <tr>
            <th align="right">Product Photos</th>
            <td><a href="<?=img_path.$data['productPhoto']?>" target="_blank">
              <?=@$data['mPartNum']?>
              </a></td>
          </tr>
          <tr>
            <th align="right">Catalog Drawings</th>
            <td><a href="<?=img_path.$data['drawing']?>" target="_blank">
              <?=@$data['mPartNum']?>
              _Drawing</a></td>
          </tr>
          <tr>
            <th align="right">Standard Package <img src="<?=temp_path?>/img/help.png"></th>
            <td><?=@$data['minQty']?></td>
          </tr>
          <tr>
            <th align="right">Category</th>
            <td><?=$cat['category_title']?>
            </td>
          </tr>
          <tr>
            <th align="right">Family</th>
            <td><?=$sub['category_title']?>
            </td>
          </tr>
          <?  for($i=0; $i< count($par); $i++) {?>
          <tr>
            <th align="right"><?=$this->site_function->parameters($par[$i])?></th>
            <td><?=$this->site_function->masters($data[$par[$i]])?></td>
          </tr>
          <? }?>
          <tr>
            <th align="right">Operating Temperature</th>
            <td>MCA117-2-ND - CABLE ASSY 36POS MDR-MDR <br>
              PLUG 2M<br>
              MCA116-1-ND - CABLE ASSY 36POS MDR-MDR <br>
              PLUG 1M</td>
          </tr>
          <tr>
            <th align="right">Other Names</th>
            <td><?=$data['other']?></td>
          </tr>
        </table>
        <!--<table cellpadding="2" cellspacing="1" border="1" class="table_3">
                	
                    <tr>
                        <th colspan="7" class="col-7">Customers Who Purchased This Product are also Interested In:</th>
                    </tr>
                    
                	<tr>
                        <th class="col-4">Digi-Key Part Number</th>
                        <th class="col-4">Manufacturer Part Number</th>
                        <th class="col-3">Manufacturer</th>
                        <th>Packaging</th>
                        <th class="col-6">Quantity Available</th>
                        <th>Unit Price</th>
                        <th class="col-5">Minimum Quantity</th>
                    </tr>
                    
                    <tr>
                    	<td align="center">WM4200-ND</td>
                        <td align="center">0022232021</td>
                        <td align="center">Molex Inc</td>
                        <td align="center">Bulk <img src="<?=temp_path?>/img/help.png"></td>
                        <td align="center">42,154 - Immediate</td>
                        <td align="center">0.20000</td>
                        <td align="center">1</td>
                    </tr>
                    
                    <tr>
                    	<td align="center">A1921-ND</td>
                        <td align="center">640456-2</td>
                        <td align="center">TE Connectivity</td>
                        <td align="center">Bulk <img src="<?=temp_path?>/img/help.png"></td>
                        <td align="center">15,173 - Immediate</td>
                        <td align="center">0.14000</td>
                        <td align="center">1</td>
                    </tr>
                    
                    <tr>
                    	<td align="center">455-1704-ND</td>
                        <td align="center">B2B-PH-K-S(LF)(SN)</td>
                        <td align="center">JST Sales America Inc</td>
                        <td align="center">Bulk <img src="<?=temp_path?>/img/help.png"></td>
                        <td align="center">58,719 - Immediate</td>
                        <td align="center">0.16000</td>
                        <td align="center">1</td>
                    </tr>
                    
                    <tr>
                    	<td align="center">WM4201-ND</td>
                        <td align="center">0022232031</td>
                        <td align="center">Molex Inc</td>
                        <td align="center">Bulk <img src="<?=temp_path?>/img/help.png"></td>
                        <td align="center">33,162 - Immediate</td>
                        <td align="center">0.30000</td>
                        <td align="center">1</td>
                    </tr>
                    
                    <tr>
                    	<td align="center">WM4202-ND</td>
                        <td align="center">0022232041</td>
                        <td align="center">Molex Inc</td>
                        <td align="center">Bulk <img src="<?=temp_path?>/img/help.png"></td>
                        <td align="center">29,964 - Immediate</td>
                        <td align="center">0.37000</td>
                        <td align="center">1</td>
                    </tr>
                
                </table>-->
        <div class="clear"></div>
        <p>
          <?=date('H:i:s d/m/Y');?>
        </p>
      </div>
    </div>
  </div>
</div>
