<?php 
$reqlevel = 3;
include("membersonly.inc.php");
    $id = $_REQUEST['cid'];
    $brand = $_REQUEST['brand']??"";
	
$sale_per="";		
$result = mysqli_query($conn,"SELECT * from main_cust_asgn where sl>0 and typ='0' and FIND_IN_SET('$id', cust)>0 ");
while($row = mysqli_fetch_array($result))
{
$sale_per=$row['spid'];
}
echo $sale_per;
?>