<?php
$reqlevel = 1;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$query2 = "DELETE FROM main_product_to WHERE sl='$sl'";
$result2 = mysqli_query($conn,$query2);
?>
<script>
get_list();
</script>