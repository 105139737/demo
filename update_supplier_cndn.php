<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$data=mysqli_query($conn,"SELECT * FROM  main_cdnr ") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($data))
{
$dsl=$erow['dsl'];
$note_typ=$erow['note_typ'];

if($note_typ=='C')
{
$dldgr='12';	
$cldgr='-3';	
}
elseif($note_typ=='D')
{
$dldgr='-3';	
$cldgr='12';	
}


$z=mysqli_query($conn,"update main_drcr set dldgr='$dldgr',cldgr='$cldgr' where sl='$dsl'" ) or die (mysqli_error($conn));

echo "update main_drcr set dldgr='$dldgr',cldgr='$cldgr' where sl='$dsl' <br>";
}
?>
