<?php 
$reqlevel = 1;
include("membersonly.inc.php");$a=$_REQUEST['sl'];$query2 = "DELETE FROM ".$DBprefix."ptemp WHERE sl='$a'";
$result2 = mysqli_query($conn,$query2);

?>
 <script>
tmppr1();

</script>