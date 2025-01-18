<?php 
include("membersonly.inc.php");

	$nm = $_POST['nm'];

		
$data1= mysqli_query($conn,"SELECT * FROM main_mmenu where nm='$nm'") or die(mysqli_error($conn));
$sql2 = mysqli_num_rows($data1);
if($sql2 == 0)
{
$sql3 = mysqli_query($conn,"insert into main_mmenu(nm) values('$nm')") or die(mysqli_error($conn));
?>
<script language="javascript">
alert('Menu Inserted Successfully. Thank You...');
document.location = "main_m_entry.php";
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