<?php
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s');

$custid=$_POST['custid'];
$days=$_POST['days'];
$prefnd=$_POST['prefnd'];
$sl=$_POST['sl'];

$err="";
$query = "SELECT * FROM main_discount where custid='$custid' and days='$days' and sl!='$sl'";
$result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0)
{
?>
<script language="javascript">
alert('Data Already Exists. Thank You.....');
window.history.go(-1);
</script>
<?php
}
else
{ 
$q3=mysqli_query($conn,"Update main_discount set custid='$custid',days='$days',prefnd='$prefnd' where sl='$sl'")or die (mysqli_error($conn));
?>
	<script language="javascript">
	alert('Data Update Successfully. Thank You.....');
	document.location="discount_setup.php";
	</script>
<?php
}
?>