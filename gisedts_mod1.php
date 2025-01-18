<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set("Asia/Kolkata");
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s a');
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$tblnm=$_REQUEST['tblnm'];
$sql =mysqli_query($conn,"UPDATE  $tblnm set $fn='$fv' where sl='$sl'")or die(mysqli_error($conn));
?>
<script>
get_list();
</script>
