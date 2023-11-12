<?
include "config.php";
$up="update main_signup set imei='',devid='',numloginfail='0' where imei!=''";
$re=mysqli_query($conn,$up);
printf("Records Updated: %d\n", mysqli_affected_rows());