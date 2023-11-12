<?php
$reqlevel = 0;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');

$sl=$_POST['sl0'];
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
	$q=mysqli_query($conn,"select * from main_reorder where bcd='$gdn' and pcd='$prd' and sl!='$sl'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($q);
	if($cnt==0)
	{
	
		$qr=mysqli_query($conn,"update main_reorder set bcd='$gdn',pcd='$prd',re='$reord' where sl='$sl'")or die(mysqli_error($conn));
		
		?>
		<script>
		alert("Update Successfully.....");
		window.location='reord_vw.php';
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