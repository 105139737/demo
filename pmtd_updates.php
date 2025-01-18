<?php  
$reqlevel = 3; 
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$mtd=$_POST['mtd'];
$sl=$_POST['sl'];

$queryx=mysqli_query($conn,"select * from ac_paymtd where mtd='$mtd' and sl!='$sl'")or die(mysqli_error($conn));
$cntx=mysqli_num_rows($queryx);
if($cntx>0)
{
?>
<Script language="JavaScript">
alert('Data Already Exist');
window.history.go(-1);
</script>
<?php 	
}
else
{
$query6 = "Update ac_paymtd set mtd='$mtd' where sl='$sl'";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));
?>
<Script language="JavaScript">
alert('Update Successfully. Thank You...');
document.location="pmtd_show.php";
</script>
<?php 
}
?>