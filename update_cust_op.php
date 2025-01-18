<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$data=mysqli_query($conn,"SELECT * FROM  bills_receivable ") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($data))
{
$dsl=$erow['dsl'];

$z=mysqli_query($conn,"update main_drcr set cldgr='-1' where sl='$dsl'" ) or die (mysqli_error($conn));

echo "update main_drcr set cldgr='-1' where sl='$dsl' <br>";
}
?>
