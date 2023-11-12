<?php
$reqlevel = 1;
include("membersonly.inc.php");
		date_default_timezone_set('Asia/Kolkata');
$dt1 = date('Y-m-d h:i:s a', time());
$dt=date('h:i:s a', time());
$dt3=date('Y-m-d ', time());

$lid=$_REQUEST[lid];


  $query13 = "UPDATE  main_tracklead set stat='1' where lid='$lid'";
$result13 = mysqli_query($conn,$query13); 

  $query13 = "UPDATE  main_lead set stat='6',laccess='$user_currently_loged',laccesstm='$dt' where lid='$lid'";
$result13 = mysqli_query($conn,$query13); 


?>
<script language="javascript">
alert('Update Successfully. Thank You.');
document.location = "attend.php";
</script>
<?
