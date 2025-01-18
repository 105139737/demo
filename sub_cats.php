<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');

$nm=$_POST['nm'];
$brand=$_POST['brand'];
$igst=$_POST['igst'];
$hsn=$_POST['hsn'];
$cgst=($igst/2);
$fdt=$edt;
$tdt="2030-12-31";
if($nm=="" or $igst=="" or $brand=="")
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?php 
}
else
{
	$dsql=mysqli_query($conn,"select * from main_scat where nm='$nm' and igst='$igst'") or die (mysqli_error($conn));
	$drcnt=mysqli_num_rows($dsql);
	if($drcnt==0)
	{
			$sql=mysqli_query($conn,"insert into main_scat(cat,nm,igst,hsn,cgst,sgst,fdt,tdt) values('$brand','$nm','$igst','$hsn','$cgst','$cgst','$fdt','$tdt')") or die (mysqli_error($conn));
	
			?>
			<script>
			alert('Submitted Successfully. Thank You');
			document.location="sub_cat.php";
			</script>
			<?php 
	}
	else
	{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?php 
	}
}
?>