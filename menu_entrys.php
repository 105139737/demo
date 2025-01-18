<?php 
include("membersonly.inc.php");
    
	$mm = $_POST['mm'];
	$mnm = $_POST['mnm'];	
	$fnm = $_POST['fnm'];
	$ntb = $_POST['ntb'];

		
$data1= mysqli_query($conn,"SELECT * FROM main_menu where mnm='$mnm' and fnm='$fnm'") or die(mysqli_error($conn));
$sql2 = mysqli_num_rows($data1);
if($sql2 == 0)
{
$sql3 = mysqli_query($conn,"insert into main_menu(msl,mnm,fnm,ntb) values('$mm','$mnm','$fnm','$ntb')") or die(mysqli_error($conn));
?>
<script language="javascript">
alert('Data Inserted Successfully. Thank You...');
document.location = "menu_entry.php";
</script>
<?php 

}
else{
	?>
<script language="javascript">
alert('Already Exists');
 window.history.go(-1);
</script>
<?php 
}
?>