<?php 
$reqlevel = 3; 
include("config.php");
set_time_limit(0);
$blon=$_REQUEST['blno'];

$result = mysqli_query($conn,"SELECT * FROM main_billing where blno='$blon'");
while ($R = mysqli_fetch_array ($result))
{
$blno=$R['blno'];

$qr=mysqli_query($conn,"update main_billing set tst='1' where blno='$blno'") or die(mysqli_error($conn));

$result1 = mysqli_query($conn,"SELECT * FROM main_billdtls where  blno='$blno'");
while ($R = mysqli_fetch_array ($result1))
{
$sl=$R['sl'];
$igst_rt=$R['igst_rt'];
$igst_am=$R['igst_am'];
$cgst_rt=$igst_rt/2;
$sgst_rt=$igst_rt/2;
$cgst_am=round($igst_am/2,2);
$sgst_am=round($igst_am/2,2);
if($igst_rt>0){
$qr=mysqli_query($conn,"update main_billdtls set tst='1',igst_rt='0',igst_am='0',cgst_rt='$cgst_rt',sgst_rt='$sgst_rt',cgst_am='$cgst_am',sgst_am='$sgst_am' where sl='$sl'") or die(mysqli_error($conn));
}
}
?>
<script>
document.location='billing_edit.php?blno=<?php  echo $blon;?>';
</script>
<?php 
}