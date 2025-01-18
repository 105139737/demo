<?php 
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];

$data= mysqli_query($conn,"delete FROM main_ledg  where sl='$sl'") or die(mysqli_error($conn));

?>
<script>
alert("Delete Successfully.....");
sh();
</script>