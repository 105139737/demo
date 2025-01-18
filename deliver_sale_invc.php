<?php  
include("membersonly.inc.php");
$billno=rawurldecode($_REQUEST['billno']);
$edtm = date('d-m-Y h:i:s a', time());
$dt=date('Y-m-d');	


mysqli_query($conn,"UPDATE main_billing SET dstat='1' WHERE blno='$billno'") or die (mysqli_error($conn));


?>
<font color="green" size="3"><b>Delivered</b></font>
<script>
//alert("Delivered Successfully.Thank You....");

</script>