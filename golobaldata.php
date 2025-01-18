<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$val=$_REQUEST['val'];
if($val!="A"){
$sql =mysqli_query($conn,"UPDATE  global set sms='$val' where sl='1'")or die(mysqli_error($conn));
}
else
{
    $id=uniqid();
    $sql =mysqli_query($conn,"UPDATE  global set linkGen='$id' where sl='1'")or die(mysqli_error($conn));
}										
?>
<h2><center>Action Successfully, Thank you....</center></h2>
