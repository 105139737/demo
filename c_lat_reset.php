<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("function.php");

$sl=$_REQUEST['sl'];
$updt=mysqli_query($conn,"update main_cust set lat='',lng='' where sl='$sl'") or die(mysqli_error($conn));
?>
<script>
show();
</script>