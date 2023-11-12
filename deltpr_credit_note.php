<?php
$reqlevel = 1;
include("membersonly.inc.php");
$a=$_REQUEST['sl'];
$query2 = "DELETE FROM main_credit_note_temp WHERE sl='$a'";
$result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
?>
<script>
temp();
</script>