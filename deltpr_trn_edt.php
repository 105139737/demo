<?php
$reqlevel = 1;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$blno=$_REQUEST['blno'];



$query100 = "SELECT * FROM main_trndtl where sl='$sl' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$qnty=$R100['qty'];
$remk=$R100['remk'];
$refno=$R100['refno'];
$betno=$R100['betno'];
}
if($blno!='')
{
echo $query2 = "DELETE FROM main_stock WHERE pcd='$prsl' and tout='$blno' and betno='$betno' and stout='$qnty' and stout>0 and nrtn='Transfer' and trn_sl='$sl'";
$result2 = mysqli_query($conn,$query2);
}
$query2 = "DELETE FROM main_trndtl WHERE sl='$sl'";
$result2 = mysqli_query($conn,$query2);
?>
<script>
temp();
</script>