<?
$url = rtrim("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",'/');
$parts = parse_url($url);parse_str($parts['query'], $query);
?>

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
.link{ font-size:12px; color:#333333; }
.link ul { float:left;}
.color { color:#003399;}
</style>


	<div style="padding-left:25px;">
            <div class="kyeword" >
            	<p>Keywords: <img src="<?=temp_path?>/img/help.png"></p>
                <input type="text" class="keyword_input">
               <!-- <p class="keyword_p"><img src="img/fb.png"> <img src="img/twitter.png"> <img src="img/linkedin.png"> <img src="img/google-+.png"> <img src="img/email.png"> | <img src="img/link.png"></p>-->
                <div class="clear"></div>
                <div class="checkbox_keyword">
                	<p><input type="checkbox"> <b>In stock</b></p>
                	<p><input type="checkbox"> <b>Lead free</b></p>
                	<p><input type="checkbox"> <b>RoHS Compliant</b></p>
                    <input type="button" value="Search Again" class="search_again">
                </div>
            </div>

           
         <!--   <p class="matching-records" style="white-space:nowrap;">Results matching criteria:  4,190,281</p>-->
<h1 style="white-space:nowrap;">Electronic Components</h1>
<br />
<? 
if($query[searchquery] == 'no result found' )
	echo $query[searchquery];

else  {
$cnd='';
if($query['searchquery']) $cnd = " AND id IN ($query[searchquery]) ";

$cat =  $this->db->getRecord( CAT, '', "category_parent ='0' " ); 
foreach($cat as $key => $category){ ?>

<h2 style="font-size:11px;" class=catfiltertopitem><a href="/product-search/en/audio-products"><?=$category['category_title']?></a></h2>


<ul>
<? $sub =  $this->db->getRecord( CAT, '', "category_parent ='".$category['id']."' $cnd " ); 
if($sub){ foreach($sub as $key => $subcat){
?>
<li class="link"><a href="<?=site_url?>/category/<?=$subcat['slug']?>" style="color:#003366;"><?=$subcat['category_title']?> (<?=$this->site_function->numPro($subcat['id'])?>) </a></li>
<? }}?>

</ul>
<? }}?>

</div>

<br /><br /><br />

