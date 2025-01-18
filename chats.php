<?php 

/**
 * @author Nirmal
 * @copyright 2014
 */
$reqlevel = 1;
include("membersonly.inc.php");
$msg=rawurldecode($_REQUEST[msg]);
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$tm=date('H:i:s a');
if($msg!="")
{
$dataa= mysqli_query($conn,"INSERT INTO  main_chat(user, msg, dt,dttm,tm) VALUES ('$user_currently_loged','$msg','$dt','$dttm','$tm')") or die(mysqli_error($conn));
}
//echo $msg;
?>