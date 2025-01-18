<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$sl=$_REQUEST['tsl'];
$query2 = "DELETE FROM main_tech_trntemp_close WHERE sl='$sl'";
echo $query2;
$result2 = mysqli_query($conn,$query2) or die (mysqli_error($conn));
?>
<script>
tmppr1();
</script>