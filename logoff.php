<?php 
include("membersonly.inc.php");
//tell we want to work with sessions

session_start();
date_default_timezone_set('Asia/Kolkata');
$lastactivetime=date("Y-m-d h:i:s");
$query = "UPDATE ".$DBprefix."signup Set logstat='0',lastactivetime='$lastactivetime' where username='".$_SESSION['id']."'";
$result = mysqli_query($conn,$query);
// set the cookie vars to zero

setcookie("rememberCookieUname","session expired",(time()+604800));

setcookie("rememberCookiePassword","X@X",(time()+604800));

//remove al the data from the session

session_unset();

//remove the session itself

session_destroy();

//redirect to the login page

header("Location: login.php");

?>