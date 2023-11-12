<?php
$reqlevel = 0;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');

$gdn=$_POST['gdn'];
$prd=$_POST['prd'];
$reord=$_POST['reord'];

if($gdn==""||$prd==""||$reord=="")
{
	?>
	<script>
	alert("Please fill all fields..");
	window.history.go(-1);
	</script>
	<?
}
else
{
	$q=mysqli_query($conn,"select * from main_reorder where bcd='$gdn' and pcd='$prd'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($q);
	if($cnt==0)
	{
	
		$qr=mysqli_query($conn,"insert into main_reorder(bcd,pcd,re,edt,eby) values('$gdn','$prd','$reord','$dt','$user_currently_loged')")or die(mysqli_error($conn));
		
		?>
		<script>
		alert("Submited Successfully.....");
		window.location='reord_entr.php';
		</script>
		<?
	}
	else
	{
		?>
		<script>
		alert("Duplicate Entry.....");
		window.history.go(-1);
		</script>
		<?
	}
}
?>