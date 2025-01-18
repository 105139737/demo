<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$blno=$_REQUEST['blno'];
$sl=1;
?>
<table border="0" width="100%" class="advancedtable">
<?php 
$query100 = "SELECT * FROM main_trndtl where blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$qnty=$R100['qty'];
$remk=$R100['remk'];
$refno=$R100['refno'];
$betno=$R100['betno'];
$unit=$R100['unit'];
$fbcd=$R100['fbcd'];
$usl=$R100['usl'];
$pnm="";
	$query6="select * from  ".$DBprefix."product where sl='$prsl'";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$pnm=$row['pnm'];
	}
$unt="";
	$query6="select * from  ".$DBprefix."unit where cat='$prsl'";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$unt=$row['sun'];
	}
$bcdnm="";
$getii=mysqli_query($conn,"select * from main_godown where sl='$fbcd'") or die(mysqli_error($conn));
while($rowii=mysqli_fetch_array($getii))
{
$bcdnm=$rowii['gnm'];
}
?>
<tr class="even">
<td  align="left" width="25%" style="cursor:pointer" onclick="get_data('<?php  echo $tsl?>','<?php  echo $prsl?>','<?php  echo $pnm?>','<?php  echo $fbcd?>','<?php  echo $unt?>','<?php  echo $betno?>','<?php  echo $qnty?>','<?php  echo $remk?>','<?php  echo $usl?>')">
<font color="red"><b><?php  echo $pnm;?></b></font>
</b></td>
<td  align="left" width="18%"><b><?php  echo $bcdnm;?></b></td>
<td  align="center" width="8%"><b><?php  echo $unt;?></b></td>
<td align="center" hidden width="15%"><b><?php  echo $refno;?></b></td>
<td align="center" width="23%"><b><?php  echo $betno;?></b></td>
<td align="center" width="7%"><b><?php  echo $qnty;?></b></td>
<td align="center" width="12%"><b><?php  echo $remk;?></b></td>
<td align="center" width="5%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?php  echo $tsl;?>','<?php  echo $blno;?>')}"><font color="red">Delete</font></a> </b></td>


</tr>
<?php }?>
</table>
<script>
gtt_unt();cbcd();get_betno();
</script>
