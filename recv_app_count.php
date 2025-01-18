<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cid=$_REQUEST['cid'];
$brncd=$_REQUEST['brncd'];

$sln=0;
$ttotal_am=0;
$data1=mysqli_query($conn,"SELECT * FROM main_recv_app where sl>0 and cid='$cid' and bcd='$brncd' and stat='0'")or die(mysqli_error($conn));
echo $count=mysqli_num_rows($data1);


