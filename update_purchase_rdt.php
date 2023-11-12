<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
set_time_limit(0);
 $query111 = "SELECT * FROM main_purchasedet where qty<0";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$blno=$R111['blno'];
$sl=$R111['sl'];
$ddt="";
$query6="select * from main_purchase where blno='$blno'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$ddt=$row['rdt'];
								}
$up="update main_purchasedet set rdt='$ddt' where sl='$sl'";
$result=mysqli_query($conn,$up);
$up="update main_purchase set rstat='1' where blno='$blno'";
$result=mysqli_query($conn,$up);
								
echo $blno." : ".$sl." : ".$ddt."<br>";
}
?> 
