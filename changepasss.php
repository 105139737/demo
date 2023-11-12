<?php
$reqlevel = 1;
include("membersonly.inc.php");
//catch the sent data
	$sl=0;
	
	$pass = $_REQUEST['oldpass'];
	$npass1 = $_REQUEST['password'];
	$npass2 = $_REQUEST['password2'];
	
	
	if($pass=='' or $npass1=='' or $npass2=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.location.assign('profile.php');
</script>
<?	}
	else
	{
	$c=0;
	$data= mysqli_query($conn,"SELECT * FROM main_signup where username='$user_currently_loged' and password='$pass'");
		while ($row = mysqli_fetch_array($data))
		{
		$c++;
		}
	if($c==0)
	{
	?>
<script language="javascript">
alert('Old Password Is Incorrect.');
window.location.assign('profile.php');
</script>
<?}
	else
	{
	if($npass1!=$npass2)
{
	?>
<script language="javascript">
alert('New Password Mismatched.');
window.location.assign('profile.php');
</script>
<?}
else
{
$sql = "UPDATE main_signup set password='$npass1' where username='$user_currently_loged'";
$result = mysqli_query($conn,$sql);
?>
<script language="javascript">
alert('Password Change Successfully. Thank You...');
document.location = "logoff.php";
</script>
<?
}}}
?>

