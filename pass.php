<?php 
include "config.php";
$sl=$_REQUEST['sl'];
$pass=$_REQUEST['pass']??"";
$fld=$_REQUEST['fld']??"";

$up="update main_signup set $fld='$pass' where sl='$sl'";
$re=mysqli_query($conn,$up);

?>


  









