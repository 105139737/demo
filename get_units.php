<?
$reqlevel = 3;
include("membersonly.inc.php");
$cat=$_REQUEST['cid'];
$get=mysqli_query($conn,"select * from main_unit where cat='$cat'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	//sun	mun	bun	smvlu	mdvlu	bgvlu	
	$sun=$row['sun'];
	$mun=$row['mun'];
	$bun=$row['bun'];
	$smvlu=$row['smvlu'];
	$mdvlu=$row['mdvlu'];
	$bgvlu=$row['bgvlu'];
}
echo $mun.'@@'.$bun.'@@'.$sun;