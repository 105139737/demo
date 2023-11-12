<?php
$reqlevel = 1;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];
$stat=$_REQUEST['val'];
//echo "update main_product set stat='$stat' where sl='$sl'";
$datatt= mysqli_query($conn,"update main_bank set stat='$stat' where sl='$sl'")or die(mysqli_error($conn));

?>
<script>
show();
</script>