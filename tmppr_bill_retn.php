<?php
$reqlevel = 3;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
?>
<table border="0" width="100%" class="advancedtable">
 <?
 $tax_am=0;
 $gstam=0;
 $tnet_am=0;
$query100 = "SELECT * FROM main_billdtls where blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$unit=$R100['unit'];
$pcs=$R100['pcs'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$cgst_rt=$R100['cgst_rt'];
$cgst_am=$R100['cgst_am'];
$sgst_rt=$R100['sgst_rt'];
$sgst_am=$R100['sgst_am'];
$igst_rt=$R100['igst_rt'];
$igst_am=$R100['igst_am'];
$net_am=$R100['net_am'];
$adp=$R100['adp'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$total=$R100['total'];
$refno=$R100['refno'];
$bcd=$R100['bcd'];
$betno=$R100['betno'];
$rqty=$R100['rqty'];
$tamm=$R100['tamm'];
 $tax_am+=$tamm;
 $gstam+=$cgst_am+$sgst_am+$igst_am;
 $tnet_am+=$net_am;
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$prsl'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$geti=mysqli_query($conn,"select * from main_unit where cat='$prsl'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$unit_nm=$rowi[$unit];
}
$bcdnm="";
$geti=mysqli_query($conn,"select * from main_godown where sl='$bcd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];
$bnm=$rowi['bnm'];
$bnm1="";
}
$stck=$pcs-$rqty;
?>

<tr class="even">
<td  align="left" width="11%"><b><?=$pnm;?></b></td>
<td  align="left" width="6%"><b><?=$gnm;?></b></td>
<td align="left" width="10%"><b></b><?=$betno;?></td>

<td  align="center" width="5%"><b><?=$unit_nm;?></b></td>
<td align="center" width="6%"><b></b><?=$refno;?></td>
<td align="center" width="7%" ><b><?=$pcs;?>-<font color="red"><?=$rqty;?></font> = <?=$stck;?></b>
<input type="text" name="q<?=$tsl;?>" id="q<?=$tsl;?>" onblur="if(this.value><?=$stck;?>){$('.upb'+<?=$tsl?>).html('<br><font color=\'red\'>Please Check  Quantity. Your Current Stock Is <?=$stck?>/pcs</font>');this.focus();document.getElementById('chk').value=1;}else{$('.upb'+<?=$tsl?>).html('');document.getElementById('chk').value=0;}" size="5" style="padding:1px;" />
<span class="upb<?=$tsl?>"></span>
</td>
<td align="right" width="4%" ><b><?=round($prc,2);?></b></td>

<td align="right" width="6%"><b><?=round($total,2);?></b></td>
<td align="center" width="4%"><b><?=$disp;?></b></td>
<td align="right" width="5%"><b><?=$disa;?></b></td>

<td align="right" width="5%"><b><?=round($ttl,2);?></b></td>
<td align="center" width="3%" ><b><?=$cgst_rt;?></b></td>
<td align="right" width="5%" ><b><?=round($cgst_am,2);?></b></td>
<td align="center" width="3%" ><b><?=$sgst_rt;?></b></td>
<td align="right" width="5%" ><b><?=round($sgst_am,2);?></b></td>
<td align="center" width="3%" ><b><?=$igst_rt;?></b></td>
<td align="right" width="5%" ><b><?=round($igst_am,2);?></b></td>
<td align="right" width="7%" ><b><?=round($net_am,2);?></b></td>
</tr>

<?}?>

</table>

<script>
document.getElementById('tamm').value='<?=$tax_am;?>';
document.getElementById('gst').value='<?=$gstam;?>';
document.getElementById('pay').value='<?=$tnet_am;?>';
</script>