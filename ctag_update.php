<?php
include("config.php");
$sl=$_REQUEST['sl'];
$val=$_REQUEST['val'];
$fld=$_REQUEST['fld'];


$query21 = "update main_branch set $fld='$val' where sl='$sl' ";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));


?>