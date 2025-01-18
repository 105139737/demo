<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');
ini_set("memory_limit","80M");

$sl=$_POST['sl'];
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
	$q=mysqli_query($conn,"select * from main_cus_typ where tp='$tp' and sl!='$sl'")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($q);
	if($cnt==0)
	{
	
		$qr=mysqli_query($conn,"update main_cus_typ set tp='$tp' where sl='$sl'")or die(mysqli_error($conn));
		
	?>
	<script>
	alert("Update Successfully.....");
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