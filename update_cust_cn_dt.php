<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$data=mysqli_query($conn,"SELECT * FROM  main_drcr where brncd='' ") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($data))
{
$sl=$erow['sl'];
$cbill=$erow['cbill'];
$brncd='';
$data2=mysqli_query($conn,"SELECT * FROM  main_billing_ret where blno='$cbill' ") or die(mysqli_error($conn));
while($erow=mysqli_fetch_array($data2))
{
$brncd=$erow['bcd'];
}
if($brncd!='')
{
$z=mysqli_query($conn,"update main_drcr set brncd='$brncd' where sl='$sl'" ) or die (mysqli_error($conn));

echo "update main_drcr set brncd='-1' where sl='$sl' <br>";
}
}
?>
