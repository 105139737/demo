<?
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$val=$_REQUEST['val'];
$data=mysqli_query($conn,"update  main_trns set vno='$val' where sl='$sl'")or die(mysqli_error($conn));
?>
<center><font color="success">Vehicle Number Update Successfull</font></center>
