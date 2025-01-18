<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$a=$_REQUEST['tsl'];
$query2 = "DELETE FROM ".$DBprefix."ser_billdtls_edt WHERE sl='$a'";
$result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
?>
<script>
temp();
</script>