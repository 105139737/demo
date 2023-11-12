<?
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_POST['psl'];

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
	<?
}
else
{
	$qr=mysqli_query($conn,"select * from main_point where pcd='$pcd' and sl!='$sl'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($qr);
	if($cnt!=0)
	{
	?>
	<script>
	alert("Duplicate Product Entry.....");
	window.history.go(-1);
	</script>
	<?
	}
	else
	{
		$data=mysqli_query($conn,"update  main_point set pcd='$pcd',point='$point' where sl='$sl'")or die(mysqli_error($conn));
	?>
	<script>
	alert("Update Successfully.....");
	window.location="prd_point_show.php";
	</script>
	<?
	
	}
}