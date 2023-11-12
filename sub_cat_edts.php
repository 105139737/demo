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
$ssl=$_POST['ssl'];

	
if($nm=="" or $igst=="")
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?
}
else
{
	

$s=mysqli_query($conn,"select * from main_scat where nm='$nm' and igst='$igst' and sl!='$ssl'") or die (mysqli_error($conn));
		$c=mysqli_num_rows($s);
		if($c==0)
		{
			$sql=mysqli_query($conn,"update main_scat set cat='$brand',nm='$nm',igst='$igst',cgst='$cgst',sgst='$cgst',hsn='$hsn' where sl='$ssl'") or die (mysqli_error($conn));
			
			//echo "update main_product set hsn='$hsn' where scat='$ssl'";
			
			$sql2=mysqli_query($conn,"update main_product set hsn='$hsn' where scat='$ssl'") or die (mysqli_error($conn));

			
			?>
			<script>
			alert('Category & Category Wise Model HSN Update Successfully.');
			document.location="sub_cat.php";
			</script>
			<?
		}
		else
		{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?
		}
}
?>