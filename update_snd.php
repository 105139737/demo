<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$val=$_REQUEST[val];
$sql =mysqli_query($conn,"UPDATE  main_menu set snd='$val' where sl='$sl'")or die(mysqli_error($conn));
?>
<font color="green" ><b>Update Successfully</b></font>