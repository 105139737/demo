<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s');

$custid=$_POST['custid'];
$days=$_POST['days'];
$prefnd=$_POST['prefnd'];

$err="";
$query = "SELECT * FROM main_discount where custid='$custid' and days='$days'";
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
$q3=mysqli_query($conn,"insert into  main_discount (custid,days,prefnd,edt,edtm,eby,stat) values ('$custid','$days','$prefnd','$edt','$edtm','$user_currently_loged','0')")or die (mysqli_error($conn));
?>
	<script language="javascript">
	alert('Data Submit Successfully. Thank You.....');
	document.location="discount_setup.php?custid=<?php  echo $custid?>";
	</script>
<?php 
}
?>