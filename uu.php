<?php 
include "config.php";


$c1=mysqli_query($conn,"SELECT * FROM main_drcr");
$count=mysqli_num_rows($c1);
while($row=mysqli_fetch_array($c1))
{
$sid=$row['sid'];
$sl=$row['sl'];
echo $sid;
$c2=mysqli_query($conn,"SELECT * FROM main_comp where cnm='$sid'");
while($row1=mysqli_fetch_array($c2))
{
$ssl=$row1['sl'];
$up="update main_drcr set sid='$ssl' where sl='$sl'";
$re=mysqli_query($conn,$up);
}

}
?>

  




