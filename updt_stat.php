<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$stat=$_REQUEST[stat];
$sql =mysqli_query($conn,"UPDATE  main_suppl set stat='$stat' where sl='$sl'")or die(mysqli_error($conn));
?>
<script>
show();
</script>