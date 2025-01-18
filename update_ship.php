<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$blno=$_REQUEST['blno'];
$val=$_REQUEST['val'];
$data=mysqli_query($conn,"update  main_billing set ship='$val' where blno='$blno'")or die(mysqli_error($conn));
?>
<center><font color="success">Shipping Address Update Successfull</font></center>
