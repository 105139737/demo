<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$psl=$_REQUEST['psl'];
$sql=mysqli_query($conn,"SELECT * FROM main_pack where psl='$psl'") or die(mysqli_error($conn));
while($R=mysqli_fetch_array($sql))
{
	$pack=$R['pack'];
}
echo $pack;
?>