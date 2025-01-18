<?php 
include("membersonly.inc.php");

	$sls = $_POST['sls'];
	$mnm = $_POST['mnm'];
	$fnm = $_POST['fnm'];
	$ntb = $_POST['ntb'];
	$mm = $_POST['mm'];


 $sql3 = mysqli_query($conn,"update main_menu set mnm='$mnm',fnm='$fnm',ntb='$ntb',msl='$mm' where sl='$sls'") or die(mysqli_error($conn));
?>
<script language="javascript">
alert('Data Updated Successfully. Thank You...');
document.location = "menu_entry.php";
</script>
<?php 
?>