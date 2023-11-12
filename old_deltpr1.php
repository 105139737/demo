<?php

$reqlevel = 1;

include("membersonly.inc.php");
$a=$_REQUEST[sl];
$query2 = "DELETE FROM main_old_ptemp WHERE sl='$a'";

$result2 = mysqli_query($conn,$query2);



?>

<script>

tmppr1();



</script>