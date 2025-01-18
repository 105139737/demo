<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$bill_typ=$_REQUEST['bill_typ'];
?>
<table border="0" width="100%" class="advancedtable">
 <?php 
$query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' and bill_typ='$bill_typ' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
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
$unit_nm="";
// $geti=mysqli_query($conn,"select * from main_unit where cat='$prsl'") or die(mysqli_error($conn));
// while($rowi=mysqli_fetch_array($geti))
// {
// //$unit_nm=$rowi[$unit];
// }
$bcdnm="";
$geti=mysqli_query($conn,"select * from main_godown where sl='$bcd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];
$bnm=$rowi['bnm'];
}

?>

<tr class="even">
<td  align="left" width="15%" onclick="get_data('<?php  echo $tsl;?>','<?php  echo $bcd;?>','<?php  echo $prsl;?>','<?php  echo $betno;?>','<?php  echo $unit;?>','<?php  echo $refno;?>','<?php  echo $pcs;?>','<?php  echo $prc;?>','<?php  echo $total;?>','<?php  echo $disp;?>','<?php  echo $disa;?>','<?php  echo $ttl;?>','<?php  echo $cgst_rt;?>','<?php  echo $cgst_am;?>','<?php  echo $sgst_rt;?>','<?php  echo $sgst_am;?>','<?php  echo $igst_rt;?>','<?php  echo $igst_am;?>','<?php  echo $net_am;?>','<?php  echo $cat;?>','<?php  echo $scat;?>','<?php  echo $pnm;?>')" style="cursor:pointer;" title="Click Here To Edit" >
<b><font color="blue"><?php  echo $pnm;?></font></b>
</td>
<td  align="left" width="12%"><b><a href="javascript:break_product('<?php  echo $tsl;?>')"><font color="red"><?php  echo $gnm;?></font></a></b></td>
<td align="center" width="11%"><b></b><?php  echo $betno;?></td>

<td  align="center" hidden width="5%"><b><?php  echo $unit_nm;?></b></td>
<td align="center" hidden width="6%"><b></b><?php  echo $refno;?></td>
<td align="center" width="3%" ><b><?php  echo $pcs;?></b></td>
<td align="right" width="4%" ><b><?php echo round((float)$prc??0,2);?></b></td>

<td align="right" width="6%"><b><?php echo round((float)$total??0,2);?></b></td>
<td align="center" width="4%"><b><?php  echo $disp;?></b></td>
<td align="right" width="5%"><b><?php  echo $disa;?></b></td>

<td align="right" width="5%"><b><?php echo round((float)$ttl,2);?></b></td>
<td align="center" width="3%" ><b><?php  echo $cgst_rt;?></b></td>
<td align="right" width="5%" ><b><?php echo round((float)$cgst_am??0,2);?></b></td>
<td align="center" width="3%" ><b><?php  echo $sgst_rt;?></b></td>
<td align="right" width="5%" ><b><?php echo round((float)$sgst_am??0,2);?></b></td>
<td align="center" width="3%" ><b><?php  echo $igst_rt;?></b></td>
<td align="right" width="5%" ><b><?php echo round((float)$igst_am??0,2);?></b></td>
<td align="right" width="7%" ><b><?php echo round((float)$net_am??0,2);?></b></td>
<td align="center" width="4%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?php  echo $tsl;?>')}"><font color="red">Delete</font></a> </b></td>

</tr>

<?php }?>

</table>
<?php 
mysqli_close($conn)
?>
<script>
t();
</script>