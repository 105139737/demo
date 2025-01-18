<?php 
$reqlevel = 3;
include("membersonly.inc.php");
//include("Numbers/Words.php");
?>
<table border="0" width="100%" class="advancedtable">
<?php 
$total_am=0;
$total_cgst=0;
$total_sgst=0;
$total_igst=0;
$total_gst=0;
$total_tax=0;

$total_net=0;

$total_dis=0;
$query100 = "SELECT * FROM ".$DBprefix."ptemp where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$unit=$R100['unit'];
$dis=$R100['dis'];
$prsl=$R100['prsl'];
$qty=$R100['qty'];
$mrp=$R100['mrp'];
$ttl=$R100['ttl'];
$cgst_rt=$R100['cgst_rt'];
$cgst_am=$R100['cgst_am'];
$sgst_rt=$R100['sgst_rt'];
$sgst_am=$R100['sgst_am'];
$igst_rt=$R100['igst_rt'];
$igst_am=$R100['igst_am'];
$net_am=$R100['net_am'];

$total=$R100['total'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$ldis=$R100['ldis'];
$ldisa=$R100['ldisa'];
$bcd=$R100['bcd'];
$rate=$R100['rate'];
$betno=$R100['betno'];
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
$getii=mysqli_query($conn,"select * from main_godown where sl='$bcd'") or die(mysqli_error($conn));
while($rowii=mysqli_fetch_array($getii))
{
$bcdnm=$rowii['gnm'];
}
?>
<tr class="even">
<td align="left" width="15%" onclick="get_data('<?php  echo $tsl;?>','<?php  echo $prsl;?>','<?php  echo $unit;?>','<?php  echo $qty;?>','<?php  echo $mrp;?>','<?php  echo $total;?>','<?php  echo $disp;?>','<?php  echo $disa;?>','<?php  echo $ttl;?>','<?php  echo $cgst_rt;?>','<?php  echo $cgst_am;?>','<?php  echo $sgst_rt;?>','<?php  echo $sgst_am;?>','<?php  echo $igst_rt;?>','<?php  echo $igst_am;?>','<?php  echo $rate;?>','<?php  echo $net_am;?>','<?php  echo $unit;?>','<?php  echo $betno;?>','<?php  echo $bcd;?>','<?php  echo $cat;?>','<?php  echo $scat;?>','<?php  echo $pnm;?>')" style="cursor:pointer;">
<b><?php  echo $pnm;?></b>
</td>
<td align="left" width="10%" ><b><?php  echo $bcdnm;?></b></td>
<td align="center" width="5%" hidden ><b><?php  echo $unit_nm;?></b></td>
<td align="center" width="7%" ><b><?php  echo $betno;?></b></td>
<td align="center" width="5%" ><b><?php  echo $qty;?></b></td>
<td align="right" width="5%" ><b><?php echo round($mrp,2);?></b></td>			
<td align="right" width="6%" ><b><?php  echo $total;?></b></td>
<td align="center" width="5%" ><b><?php  echo $disp;?></b></td>
<td align="right" width="5%" ><b><?php  echo $disa;?></b></td>
<td align="center" hidden ><b><?php  echo $ldis;?></b></td>
<td align="right" hidden ><b><?php  echo $ldisa;?></b></td>
<td align="right" width="5%" ><b><?php echo round($ttl,2);?></b></td>
<td align="center" width="3%" ><b><?php  echo $cgst_rt;?></b></td>
<td align="right" width="5%" ><b><?php echo round($cgst_am,2);?></b></td>
<td align="center" width="3%" ><b><?php  echo $sgst_rt;?></b></td>
<td align="right" width="5%" ><b><?php echo round($sgst_am,2);?></b></td>
<td align="center" width="3%" ><b><?php  echo $igst_rt;?></b></td>
<td align="right" width="5%" ><b><?php echo round($igst_am,2);?></b></td>
<td align="right" width="5%" ><b><?php echo round($net_am,2);?></b></td>
<td align="right" width="5%" ><b><?php echo round($rate,2);?></b></td>

<td align="center" width="3%"><b><a onclick="if(confirm('Are you Sure?')){deltpr1('<?php  echo $tsl;?>')}"><font color="red">Delete</font></a> </b></td>
</tr>
<?php 
$total_am+=$total;
$total_cgst+=$cgst_am;
$total_sgst+=$sgst_am;
$total_igst+=$igst_am;
$total_gst+=$cgst_am+$sgst_am+$igst_am;
$total_tax+=$ttl;
$total_net+=$net_am;
$total_dis+=$disa+$ldisa;
}
$bilamm=$total_net;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);
?>
</table>
<script>
document.getElementById('ttl_amm').value="<?php  echo $total_am;?>";
document.getElementById('cgst_amm').value="<?php  echo $total_cgst;?>";
document.getElementById('sgst_amm').value="<?php  echo $total_sgst;?>";
document.getElementById('igst_amm').value="<?php  echo $total_igst;?>";
document.getElementById('gst').value="<?php  echo $total_gst;?>";
document.getElementById('sttl').value="<?php  echo $total_net;?>";
document.getElementById('roff').value="<?php  echo $roff;?>";
document.getElementById('tamm').value="<?php  echo $rgttl;?>";
document.getElementById('tamm1').value="<?php  echo $bilamm;?>";
document.getElementById('tddis').value="<?php  echo $total_dis;?>";
document.getElementById('taxable_amm').value="<?php  echo $total_tax;?>";
$('#hsn_update').val('');
$('#hsn_upsdates').html('');
t2();
</script>