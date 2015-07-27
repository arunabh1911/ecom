<div style="padding-left:25px;">
  <div style="width:950px">
    <h4>Bom List</h4>
    </span> </div>
  <div id="">
    <p>&nbsp;</p>
  </div>


  <table width="638" border="0" cellpadding="0" cellspacing="0" style="border:#D7D7D7 solid 2px;">
    <tr bgcolor="#E0E0E0" align="center">
      <td width="100" style="border-right:#D7D7D7 solid 1px;">Bom Id.</td>
      <td width="103" style="border-right:#D7D7D7 solid 1px;">Bom Name</td>
      <td width="102" style="border-right:#D7D7D7 solid 1px;">Date Created</td>
      <td style="border-right:#D7D7D7 solid 1px;">Owner</td>
      <td width="64" style="border-right:#D7D7D7 solid 1px;">Delete</td>
     </tr>


<?
$sql = $this->db->runQuery("select * from ".BOM." where userId = '".$user->userId."' ");
while($data= $this->db->getQuery($sql))
{?>
    <tr align="center" style="border-top:#D7D7D7 solid 1px;">
      <td style="border-right:#D7D7D7 solid 1px;"><a href="<?=site_url?>/bom-view/<?=$data['uniqueId']?>"><?=$data['uniqueId']?></a></td>
      <td style="border-right:#D7D7D7 solid 1px;"><?=$data['name']?></td>
      <td style="border-right:#D7D7D7 solid 1px;"><?=$data['date']?></td>
      <td style="border-right:#D7D7D7 solid 1px;"><?=ucwords($user->name)?></td>
     <td><img src="<?=temp_path?>/img/delete.gif" onclick="$('#id').val('<?=$data['id']?>');$('#del').submit(); "  style="cursor: pointer"  ></td>
    </tr>
<? }?>
	
<!--    <tr align="center" bgcolor="#EBEBEB" style="border-top:#D7D7D7 solid 1px;">
      <td style="border-right:#D7D7D7 solid 1px;"><img src="<?=temp_path?>/img/mag.gif" ></td>
      <td style="border-right:#D7D7D7 solid 1px;">DK 11043</td>
      <td style="border-right:#D7D7D7 solid 1px;">Tsmims</td>
      <td style="border-right:#D7D7D7 solid 1px;">13</td>
      <td style="border-right:#D7D7D7 solid 1px;">1600</td>
      <td style="border-right:#D7D7D7 solid 1px;">&nbsp;</td>
      <td style="border-right:#D7D7D7 solid 1px;">Rnodbn mko ig </td>
      <td><img src="<?=temp_path?>/img/delete.gif" ></td>
    </tr>-->
	
  </table>
  <p>&nbsp;</p>
  <P><a href="<?=site_url?>/bom-manager-list/">Return to main menu </a></P>
</div>

<form action="" id="del" method="post">
<input name="id" id="id" type="hidden"  />
<input name="<?=frontend?>" type="hidden" value="ecommerce/delBom" />
</form>