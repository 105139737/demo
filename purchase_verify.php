<?php 
$_REQUEST['blno'] ?? "";
$reqlevel = 1;
include("membersonly.inc.php");
$blno=$_REQUEST['blno'];

$queryx = "update  main_purchase set vstat='1'  where blno='$blno'";
$resultx = mysqli_query($conn,$queryx)or die(mysqli_error($conn));
?>
<script>
show1();
</script>
