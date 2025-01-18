<?php 
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];

$query33 = "SELECT sum(amm) as tot1 FROM main_drcr where cldgr='19' and cid='$sl'";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{
	$ttl=$R['tot1'];
}
$query = "SELECT sum(amm) as tot FROM main_drcr where dldgr='19' and cid='$sl'";
$result = mysqli_query($conn,$query);
while ($R1 = mysqli_fetch_array ($result))
{
	$ttl1=$R1['tot'];
}

echo $ttl-$ttl1;
?>