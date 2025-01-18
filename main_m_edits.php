<?php 
include("membersonly.inc.php");

	$sls = $_POST['sls'];
	$nm = $_POST['nm'];


		

$sql3 = mysqli_query($conn,"update main_mmenu set nm='$nm' where sl='$sls'") or die(mysqli_error($conn));
?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location = "main_m_entry.php";
</script>
<?php 
?> 