<?php 
$reqlevel=3; 
include("membersonly.inc.php");
$blno9=rawurldecode($_REQUEST['blno']);
$val9=$_REQUEST['val'];

mysqli_query($conn,"Update main_order set vstat='$val9' where blno='$blno9'") or die(mysqli_error($conn));
?>
<script>
alert("Verify Sucsessfuly..");
show1();
</script>