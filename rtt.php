<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$pcd=$_REQUEST['pcd'];
$wtyp=$_REQUEST['wty'];
$tid=$_REQUEST['tid'];
$y=mysqli_query($conn,"select * from main_parts where sl='$pcd'") or die (mysqli_error($conn));
while($r=mysqli_fetch_array($y))
{
	$wiamm=$r['wiamm'];
	$woamm=$r['woamm'];
	
}

$y=mysqli_query($conn,"select (sum(stin)-sum(stout)) as new4 from main_pstock where pcd='$pcd' and tid='$tid'")or die(mysqli_error($conn));
while($vb=mysqli_fetch_array($y))
{
	$qty=$vb['new4'];
}
if($wtyp=='1')
{
	echo $wiamm."@".$qty;
}
elseif($wtyp=='2')
{
	echo $woamm."@".$qty;
}
?>