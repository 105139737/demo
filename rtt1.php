<?php
$reqlevel = 3;
include("membersonly.inc.php");
$pcd=$_REQUEST['pcd'];


$y=mysqli_query($conn,"select (sum(stin)-sum(stout)) as new4 from main_pstock where pcd='$pcd' and tid=''")or die(mysqli_error($conn));
while($vb=mysqli_fetch_array($y))
{
	$qty=$vb['new4'];
}

	echo $qty;

?>