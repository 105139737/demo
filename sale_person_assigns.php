<?php 
$reqlevel = 3; 
include("membersonly.inc.php");


$spid=$_POST['spid'];
$array=$_POST['assign_spid'];
$brand=$_POST['brand'];

$assign_spid = implode(',', $array);

if($assign_spid=="")
	
{
	?>
	<script>
	alert("Blank Entry.....");
	window.history.go(-1);
	</script>
	<?php 
}
else
{
	$q=mysqli_query($conn,"select * from main_signup where username='$spid'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($q);
	if($cnt==1)
	{
	
		$qr=mysqli_query($conn,"update main_signup set assign_spid='$assign_spid',brand='$brand' where username='$spid'")or die(mysqli_error($conn));
		
	?>
	<script>
	alert("Update Successfully.....");
	window.location='sale_person_assign.php';
	</script>
	<?php 

}
else
{
	?>
	<script>
	alert("No Sales Person Found.....");
	window.history.go(-1);
	</script>
	<?php 
	
}
 } 
	

?>