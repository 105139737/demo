<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];

$qrr=mysqli_query($conn,"delete from main_credit where sl='$sl'")or die(mysqli_error($conn));
?>
<script>
get_blno().then(
  function(value) {
    recallRamm();
}
);
</script>