<?php 
$reqlevel=1;
include("membersonly.inc.php");
$frm=$_POST['frm'];
$too=$_POST['too'];
if($frm==$too)
{
die('From - To Same');	
}

$data=mysqli_query($conn,"select * from main_purchase where blno='$frm'");
$num=mysqli_num_rows($data);

$data1=mysqli_query($conn,"select * from main_purchase where blno='$too'");
$num1=mysqli_num_rows($data1);

if($num>0 && $num1>0)
{
	mysqli_query($conn,"UPDATE main_purchasedet SET blno='$too' WHERE  blno='$frm'");
	mysqli_query($conn,"DELETE FROM main_stock WHERE pbill='$frm' and refno='$frm'");
	mysqli_query($conn,"DELETE FROM main_drcr WHERE sbill='$frm'");
	mysqli_query($conn,"DELETE FROM main_purchase WHERE blno='$frm'");

?>
<script>
alert("Purchase Bill Swaping Successfully..");
window.location="purchase_edit.php?blno=<?php  echo $too;?>";
</script>
<?php 	
}			
else
{
?>
<script>
alert("From or To - Bill Number Not Found");
history.go(-1);
</script><?php 	
}
