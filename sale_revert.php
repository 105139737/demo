<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');

$blno=$_REQUEST['blno'];

$qr2=mysqli_query($conn,"update main_billing set cstat='0' where blno='$blno'")or die(mysqli_error($conn));



?>
<script>
alert("Revert Successfully . Thank You....");
edit('<?php  echo $blno?>');
</script>
