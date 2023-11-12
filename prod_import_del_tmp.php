<?php
$reqlevel = 3;
include("membersonly.inc.php");

$sql1=mysqli_query($conn,"DELETE FROM main_product_prc_temp WHERE eby='$user_currently_loged'") or die(mysqli_error($conn));
?>
<script>
showw();
</script> 