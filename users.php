<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$username=$_POST['username'];
$mob=$_POST['mob'];
$email=$_POST['email'];
$addr=$_POST['addr'];
$brncd=$_POST['brncd'];
$userlevel=$_POST['userlevel'];
$err="";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$dt=date('Y-m-d', strtotime($dt));

   $result = mysqli_query($conn,"Select * from main_signup where username='$username'");
	$cont=mysqli_num_rows($result);
	if($cont>0)
	{
		$err="User Already Exists...";
	}
if($err=="")

?>
<script language="javascript">
alert('<?=$err;?>');
document.location='user.php';
</script>
