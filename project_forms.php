<?php 
include("config.php");
//catch the sent data
	$sl=0;
	$pnm = $_POST['pnm'];
	
	
	$sl = $_POST['updt'];
	
	if($sl!=0)
	{
	if($pnm=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?php 	}
	else
	{
	
$sql = "UPDATE main_project set nm='$pnm' where sl='$sl'";
$result = mysqli_query($conn,$sql);
?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location = "project_form.php";
</script>
<?php 
	
	}
	}
	else
	{
	

if($pnm=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?php 	}
	else
	{	

$query4 = "SELECT * FROM main_project where nm='$pnm'";
		$result4 = mysqli_query($conn,$query4);
		$cnt=0;
		while ($R = mysqli_fetch_array ($result4))
		{
		$cnt++;
	
		}
if($cnt>0)
{
?>
<script language="javascript">
alert('Sorry!! Project Already Exist.');
window.history.go(-1);
</script>
<?php 
}
else
{

$query2 = "INSERT INTO main_project (nm) VALUES ('$pnm')";
$result2 = mysqli_query($conn,$query2);

?>
<script language="javascript">
alert('Project Added Successfully, Thank You.');
document.location = "project_form.php";
</script>
<?php 

}}}
?>

