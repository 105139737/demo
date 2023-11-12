<?php
include "config.php";
$sl=$_REQUEST[sl];
$val=$_REQUEST[val];
$up="update main_discountdtls set stat='$val' where sl='$sl'";
$re=mysqli_query($conn,$up);
?>
<script>
show();
</script>