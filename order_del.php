<?php 
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
$edtm = date('d-m-Y h:i:s a', time());
$dt=date('Y-m-d');	

mysqli_query($conn,"DELETE FROM main_stock WHERE sbill='$blno'");
mysqli_query($conn,"UPDATE main_order SET cstat='2' WHERE blno='$blno'");

?>
<script>
alert("Canceled Successfully.Thank You....");
show1();
</script>