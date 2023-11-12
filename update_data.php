<?
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$val=$_REQUEST['val'];
$invdt=date('Y-m-d',strtotime($val));
$z=mysqli_query($conn,"update main_billing_ret set invdt='$invdt' where sl='$sl'" ) or die (mysqli_error($conn));
?>
<script>
show1();
</script>