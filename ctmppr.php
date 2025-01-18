<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$eby=$user_currently_loged;

$cid=$_REQUEST['cid'];
$tamm=$_REQUEST['tamm'];

?>
<table border="0" width="100%" class="advancedtable">
<?php 
$total_am=0;
$qr=mysqli_query($conn,"select * from main_credit where eby='$eby' and cid='$cid' order by sl") or die(mysqli_error($conn));
while($r=mysqli_fetch_array($qr))
{
	$sl=$r['sl'];
	$blno=$r['blno'];
	$amm=$r['amm'];
	$nrtn=$r['nrtn'];
	
$total_am+=$amm;
	
	?>
<tr class="odd">
<td align="left" width="34%"><?php  echo $blno;?></td>
<td align="left" width="14%"></td>
<td align="left" width="13%" ><?php  echo $amm;?></td>
<td align="left" width="22%" ><?php  echo $nrtn;?></td>
<td align="center" width="5%"><a style="cusor:pointer" onclick="if(confirm('Are You Sure to Delete ...')){dlt('<?php  echo $sl;?>')}">Delete</td>
</tr>
	
<?php 
}
$ramm=0;
if($tamm>0)
{
$ramm=$tamm-$total_am;
}
?>
</table>

<script>
document.getElementById('ramm').value='<?php  echo $ramm;?>';

console.log("temp load 111111111111");
//get_blno();
</script>
