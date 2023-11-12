<?
include "config.php";
$sl=$_REQUEST[sl];$val=$_REQUEST[val];$up="update main_signup set actnum='$val' where sl='$sl'";$re=mysqli_query($conn,$up);?><script>show();</script>
  




