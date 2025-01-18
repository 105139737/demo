<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');
ini_set("memory_limit","80M");

$tp=$_POST['tp'];

if($tp=="")
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
	$q=mysqli_query($conn,"select * from main_cus_typ where tp='$tp'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($q);
	if($cnt==0)
	{
	
		$qr=mysqli_query($conn,"insert into main_cus_typ(tp) values('$tp')")or die(mysqli_error($conn));
		
	?>
	<script>
	alert("Submit Successfully.....");
	window.location='cus_typ.php';
	</script>
	<?php 

}
else
{
	?>
	<script>
	alert("Duplicate Entry.....");
	window.history.go(-1);
	</script>
	<?php 
	
}
 } 
	

?>