<?php 
$reqlevel = 3;
include("membersonly.inc.php");
 $query = "SELECT count(*) as tot FROM  main_trns where stat='0' and tbcd='$branch_code'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
	$sl=$R['sl'];
$tot=$R['tot'];
}

?>

You Have <?php  echo $tot;?> Messege
            
