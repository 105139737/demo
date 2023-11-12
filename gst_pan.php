<?
$reqlevel = 1;
include("membersonly.inc.php");

$gstin=$_REQUEST['gstin'];

$pan=substr($gstin,2,10);	
$state=substr($gstin,0,2);	

	$sql="SELECT * FROM main_state WHERE cd='$state'";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	$sl=$row['sl'];	
	}

echo $pan."@".$sl;
?>