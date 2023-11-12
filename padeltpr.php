<?php
$reqlevel = 1;
include("membersonly.inc.php");


$sl=$_REQUEST['tsl'];

$query2 = "DELETE FROM main_partemp WHERE sl='$sl'";
$result2 = mysqli_query($conn,$query2);

?>
 <script>
tmppr1();

</script>