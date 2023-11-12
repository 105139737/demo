<?php 
include("membersonly.inc.php");
$billno=rawurldecode($_REQUEST['billno']);
$edtm = date('d-m-Y h:i:s a', time());
$dt=date('Y-m-d');	


mysqli_query($conn,"UPDATE main_billing SET bfl_bst='1' WHERE blno='$billno'") or die (mysqli_error($conn));


?>
<script>
alert("Bill Verified Successfully.Thank You....");
show1();
</script>