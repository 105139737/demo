<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$betno=rawurldecode($_REQUEST['betno']);
$blno=rawurldecode($_REQUEST['blno']);

$betno1=" and main_billdtls.betno like '%$betno%'";
$blno1=" and main_billdtls.blno like '%$blno%'";

$data= mysqli_query($conn,"select main_billdtls.* from main_billdtls where main_billdtls.sl>0  $betno1 $blno1 order by main_billdtls.sdt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$tsl=$row['sl'];
$pcd=$row['prsl'];
$blno=$row['blno'];
$betno=$row['betno'];

$query21 = "UPDATE main_billdtls SET sync_stat=0 WHERE sl='$tsl'";
$result2 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

$datasy= mysqli_query($conn,"UPDATE lg_sync set stat=1 where blno='$blno' and prsl='$pcd' and betno='$betno'")or die(mysqli_error($conn));
}
?>
<script>
show();
</script>
			