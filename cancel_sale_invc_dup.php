<?php 
include("membersonly.inc.php");
$billno=rawurldecode($_REQUEST['billno']);
$edtm = date('d-m-Y h:i:s a', time());
$dt=date('Y-m-d');	
mysqli_query($conn,"UPDATE main_billing_dup SET cstat='1' WHERE blno1='$billno'") or die (mysqli_error($conn));



?>
<script>
alert("Canceled Successfully.Thank You....");
show1();
</script>