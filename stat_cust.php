<?php 
include("config.php");
$sl=$_REQUEST['sl'];
$val=$_REQUEST['val'];


$query21 = "update main_cust set tcs='$val' where sl='$sl' ";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));


?>