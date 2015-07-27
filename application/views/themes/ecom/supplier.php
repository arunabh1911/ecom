<link href="<?=temp_path?>/css/SP.css" rel="stylesheet" type="text/css">
<style type="text/css">
body
{
  margin:0;
  
}

.spacerTable
{
  display:inline;
  float:left;
}

.clearFloating
{
  clear:both;
  line-height:0;
}

.centerComponents
{
  margin:auto;
  text-align:left;
}

#element1
{
  height:0px;
}

#element2
{
  width:0px;
  height:1px;
}

</style>
<div id="content">
  <div style="width:900px; padding-top:15px" id="featured_suppliers">
    <div style="height:16px;">
      <div style="float:left;" scs_exclude="true" class="fsTitle">New Suppliers</div>
      <div style="display:inline-block; float:right;">
        <div style="text-decoration:underline; white-space:nowrap; color:blue; font-size:smaller; float:right; right:2%; cursor:pointer;">
          <!--<a target="_blank" style="margin-right:4px" class="excelLink" href="#">Download To Excel</a>-->
        </div>
        <div style="white-space:nowrap; color:black; font-size:smaller; float:right; right:2%;"> &nbsp; | &nbsp; </div>
        <div style="text-decoration:underline; white-space:nowrap; color:blue; font-size:smaller; float:right; right:2%; cursor:pointer;">

        </div>
      </div>
    </div>
    <hr>
    <table border="0" cellspacing="0" cellpadding="2" width="900">
      <tbody>
        <tr>
          <td colspan="4" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td><div><br />
            </div></td>
          <td><div style="text-align: center;"><a class="null" href="#" target="_blank"><img class="img" title=" " src="<?=temp_path?>/img/logo/dave-150.jpg" border="0" alt=" " hspace="0" /></a></div></td>
          <td><div><a class="null" href="#" target="_blank"><img class="img" title=" " src="<?=temp_path?>/img/logo/electronic-assembly-150.jpg" border="0" alt=" " hspace="0" /></a></div></td>
          <td><div><a class="null" href="#" target="_blank"><img class="img" title=" " src="<?=temp_path?>/img/logo/inventek-150.jpg" border="0" alt=" " hspace="0" /></a></div></td>
          <td><div><a class="null" href="#" target="_blank"><img class="img" title=" " src="<?=temp_path?>/img/logo/maestro-wireless-150.jpg" border="0" alt=" " hspace="0" /></a></div></td>
          <td><div><a class="null" href="#" target="_blank"><img class="img" title=" " src="<?=temp_path?>/img/logo/mentor-graphics-150.jpg" border="0" alt=" " hspace="0" /></a></div></td>
          <td><div><a class="null" href="#" target="_blank"><img class="img" title=" " src="<?=temp_path?>/img/logo/american-portwell-technology-150.jpg" border="0" alt=" " hspace="0" /></a></div></td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <hr>
  </div>
  <table scs_exclude="true" border="0" width="900">
    <tr>
      <td colspan="2"><strong>
        <h1>Supplier Index</h1>
        </strong></td>
    </tr>
    <tr>
      <td valign="top" ><div class="supplier_index" id="navigation">
          <ul class="indexFont">
            <li> <a href="##" class="link">#</a> </li>
            <li> <a href="#A" class="link">A</a> </li>
            <li> <a href="#B" class="link">B</a> </li>
            <li> <a href="#C" class="link">C</a> </li>
            <li> <a href="#D" class="link">D</a> </li>
            <li> <a href="#E" class="link">E</a> </li>
            <li> <a href="#F" class="link">F</a> </li>
            <li> <a href="#G" class="link">G</a> </li>
            <li> <a href="#H" class="link">H</a> </li>
            <li> <a href="#I" class="link">I</a> </li>
            <li> <a href="#J" class="link">J</a> </li>
            <li> <a href="#K" class="link">K</a> </li>
            <li> <a href="#L" class="link">L</a> </li>
            <li> <a href="#M" class="link">M</a> </li>
            <li> <a href="#N" class="link">N</a> </li>
            <li> <a href="#O" class="link">O</a> </li>
            <li> <a href="#P" class="link">P</a> </li>
            <li> <a href="#Q" class="link">Q</a> </li>
            <li> <a href="#R" class="link">R</a> </li>
            <li> <a href="#S" class="link">S</a> </li>
            <li> <a href="#T" class="link">T</a> </li>
            <li> <a href="#U" class="link">U</a> </li>
            <li> <a href="#V" class="link">V</a> </li>
            <li> <a href="#W" class="link">W</a> </li>
            <li> <a href="#X" class="link">X</a> </li>
            <li><a href="#Y" class="link">Y</a></li>
            <li><a href="#Z" class="link">Z</a></li>
          </ul>
          <p class="indexFont">&nbsp;</p>
        </div></td>
      <td width="100%"><div id="supplier_listing">
          
<?
$char = explode(',','A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z'); //
for( $j=0; $j<count($char); $j++ ){
?>		  
	  
<table cellpadding="0" cellspacing="0" border="0" width="90%" id="supplier_names">
<tr>
  <td colspan="2"><a name="<?=$char[$j]?>"><strong><?=$char[$j]?></strong></a></td>
</tr>
<tr>
  <td valign="top" colspan="2"><hr align="left" width="95%">
  </td>
</tr>

<? 
$colums=2; 
if( $pdata =  $this->db->getRecord( MANU, '', " name LIKE '".$char[$j]."%' " ) ) {
for( $i=0; $i<count($pdata); $i++ ){
if($i % $colums == 0){ ?>
<tr>
<td valign="top" width="400">			  
<a target="_blank" set="yes" href="#" linkindex="33"><?=ucwords($pdata[$i]['name'])?></a> <br>
</td>
<? }else{?>			  
<td valign="top" width="400">
<a target="_blank" set="yes" href="#" linkindex="33"><?=ucwords($pdata[$i]['name'])?></a> <br>
</td>
<? }?>
<? }}?>            
</tr>
</table>
	<br />
 <? }?>
		  
		  
          
        </div>
        <span style="font-size:10px"> <br>
        &bull; RoHS & Lead (Pb)-Free information available from the manufacturer's Web site.<br>
        &ordm; Includes RoHS & Lead (Pb)-Free information and Certificate of Compliance link.</span></td>
    </tr>
  </table>
</div>
