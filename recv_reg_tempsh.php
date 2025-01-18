<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cid=$_REQUEST['cid'];
$brncd=$_REQUEST['brncd'];
$tamm=$_REQUEST['tamm'];
$ramm=0;
$blno_ref ="";
?>
<table border="0" width="100%" class="advancedtable">
<?php 
$total_am=0;
$sln=0;
$query100 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' and brncd='$brncd' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$sln++;
$tsl=$R100['sl'];
$blno=$R100['blno'];
$dldgr=$R100['dldgr'];
$paymtd=$R100['paymtd'];
$refno=$R100['refno'];
$amm=$R100['amm'];
$sman=$R100['sman'];
$cldgr=$R100['cldgr'];
$disl=$R100['disl'];
$damm=$R100['damm'];
$remk=$R100['remk'];
$dislam="";				
$data1= mysqli_query($conn,"select * from main_ledg where sl='$disl'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$dislam=$row1['nm'];
}
$mtd="";				
$data2= mysqli_query($conn,"select * from ac_paymtd where sl='$paymtd'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$mtd=$row2['mtd'];
}
$spnm="";
$query6="select * from main_sale_per where spid='$sman'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$spnm=$row['nm'];
}
$total_am+=$amm;
?>

<tr class="even">
<td  align="left" width="3%" ><b><?php  echo $sln;?>.</b></td>
<td  align="left" width="19%" ><b><?php  echo $blno;?></b></td>
<td  align="left" width="7%" ><b></b></td>
<td align="left" width="10%"><b><?php echo round($amm,2);?></b></td>
<td align="left" width="20%"><b><?php  echo $dislam;?></b></td>
<td align="left" width="6%"><b><?php echo round($damm,2);?></b></td>
<td align="left" width="8%"><b><?php  echo $remk;?></b></td>
<?php  if($brncd=='1')
{?>
<td align="left" width="5%"></td>
<td align="left" width="5%"></td>
<td align="left" width="5%"></td>
<?php  }?>
<td align="center" width="5%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?php  echo $tsl;?>')}"><font color="red">Delete</font></a> </b></td>
</tr>
<?php }
if($tamm>0)
{
$ramm=$tamm-$total_am;
}
$query1001 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' and brncd='$brncd' and app_ref!='' order by sl";
$result1001 = mysqli_query($conn,$query1001) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result1001))
{
$blno_ref=$R100['app_ref'];
}
?>
</table>
<script>
document.getElementById('ramm').value='<?php  echo $ramm;?>';
//document.getElementById('amm').value='<?php  echo $ramm;?>';

//document.getElementById('blno_ref').value="<?php  echo $blno_ref;?>";
//get_blno();

</script>

