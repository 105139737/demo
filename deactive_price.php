<?php 
include "config.php";

$up="UPDATE main_product_prc,main_product set main_product_prc.status='1' WHERE main_product_prc.psl=main_product.sl and main_product.stat='1';";
$re=mysqli_query($conn,$up);
?>

<h1><font color="green">Deactivated Product's Price will aslo be Deactivated Is Done</font></h1>
  









