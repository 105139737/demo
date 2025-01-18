<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$a=$_REQUEST['sl'];


$query100 = "SELECT * FROM main_recv_reg_temp where sl='$a'";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{

$blno=$R100['blno'];
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	

}
$query2 = "DELETE FROM main_recv_reg_temp WHERE sl='$a'";
$result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
?>
<script>
get_blno().then(
  function(value) {
    recallRamm();
}
);
</script>