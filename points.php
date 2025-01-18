<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');


$pcd=$_POST['pcd'];
$point=$_POST['point'];

if($point=="" and $pcd=="")
{
	?>
	<script>
	alert("Please fill all Field.....");
	window.history.go(-1);
	</script>
	<?php 
}
else
{
	$qr=mysqli_query($conn,"select * from main_point where pcd='$pcd'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($qr);
	if($cnt!=0)
	{
	?>
	<script>
	alert("Duplicate Product Entry.....");
	window.history.go(-1);
	</script>
	<?php 
	}
	else
	{
		$data=mysqli_query($conn,"insert into main_point(pcd,point,edtm,dt,eby) values('$pcd','$point','$dttm','$dt','$user_currently_loged')")or die(mysqli_error($conn));
	?>
	<script>
	alert("Submit Successfully.....");
	window.location="point.php";
	</script>
	<?php 
	
	}
}