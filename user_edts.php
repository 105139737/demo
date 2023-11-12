<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$nm=$_POST['nm'];
$mob=$_POST['mob'];
$email=$_POST['email'];
$addr=$_POST['addr'];
$brncd=$_POST['brncd'];
$userlevel=$_POST['userlevel'];$sid=$_POST['sid'];
$sl=$_POST['sl'];$edtm=date('d-m-Y h:i:s a ');
$err="";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$dt=date('Y-m-d', strtotime($dt));
   $result = mysqli_query($conn,"Select * from main_signup where name='$nm' and mob='$mob' and brncd='$brncd' and sl!='$sl'");
	$cont=mysqli_num_rows($result);
	if($cont>0)
	{
		$err="User Already Exists...";
	}
	if($err=="")
	{
$query21 = "Update main_signup set name='$nm',brncd='$brncd',mob='$mob',addr='$addr',mailadres='$email',userlevel='$userlevel' where sl='$sl'";
$result21 = mysqli_query($conn,$query21);$data22= mysqli_query($conn,"SELECT * FROM main_deg where sl>'0' and lvl='$userlevel'");			while ($row22 = mysqli_fetch_array($data22))			{						$desig = $row22['deg'];			$desigsl = $row22['sl'];							}$query251 = "Update main_staf set dig='$desigsl',nm='$nm',brncd='$brncd',phno='$mob',addr='$addr',email='$email',lvl='$userlevel' where sid='$sid'";
$result251 = mysqli_query($conn,$query251);
$err="Update Sucessfully. Thank You...";
	}
?>
<script language="javascript">
alert('<?=$err;?>');
document.location='user_show.php';
</script>


