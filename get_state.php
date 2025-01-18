<?php 
$reqlevel = 1;
include("membersonly.inc.php");

$addr=$_REQUEST['addr'];

$query1="Select * from main_suppl_gst where sl='$addr'";
$result1=mysqli_query($conn,$query1);
while($row=mysqli_fetch_array ($result1))
{
$gstin=$row['gstin'];
$st=$row['st'];
}

$pan=substr($gstin,2,10);	
$state=substr($gstin,0,2);	

	$sql="SELECT * FROM main_state WHERE cd='$state'";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	$sl=$row['sl'];	
	}

echo $st;
?>