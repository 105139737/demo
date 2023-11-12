<?php
$reqlevel = 1;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$query2 = "DELETE FROM main_quo_details_edt WHERE sl='$sl'";
$result2 = mysqli_query($conn,$query2);
?>
<script>
temp();
</script>