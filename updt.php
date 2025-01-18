<?php 
include("config.php");

$query21 = "update ".$DBprefix."drcr set dt='2018-10-10' where typ='11' and (dldgr='-1' or cldgr='-1')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

echo 'Update Successfully...';
?>