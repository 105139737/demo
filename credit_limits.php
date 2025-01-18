<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$cust_sl=$_REQUEST['cust_sl'];
$credit_limit=$_REQUEST['credit_limit'];
$sql=mysqli_query($conn,"Update main_cust set credit_limit='$credit_limit' where sl='$cust_sl'") or die(mysqli_error($conn));	
?>
<script>
$('#myModal').modal('hide');
show();
</script>