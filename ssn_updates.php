<?
$reqlevel = 3;
include("membersonly.inc.php");

$fdt=$_POST['fdt'];
$tdt=$_POST['tdt'];

if($fdt=="" and $tdt=="")
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
	$fdt=date("Y-m-d", strtotime($fdt));
	$tdt=date("Y-m-d", strtotime($tdt));

	$data=mysqli_query($conn,"UPDATE main_ssn SET fdt='$fdt', tdt='$tdt' where sl='1'")or die(mysqli_error($conn));
	?>
	<script>
	alert("Update Successfully.....");
	window.location="ssn_update.php";
	</script>
	<?
}