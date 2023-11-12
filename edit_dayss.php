<?php
$reqlevel = 1;
include("membersonly.inc.php");
$err="";

$puser=implode(",",$_POST['puser']);

$result=mysqli_query($conn,"update main_edit_days set puser='$puser' where sl='1'");
?>
<script>
alert("Update Successfully....");
window.history.go(-1);
</script>
