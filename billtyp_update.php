<?
include "config.php";
$sl=$_REQUEST[sl];$val=$_REQUEST[val];$up="update main_billtype set stat='$val' where sl='$sl'";$re=mysqli_query($conn,$up);?><script>get_list();</script>
  




