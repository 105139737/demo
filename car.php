<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$cno=$_REQUEST[cno];

 $data= mysqli_query($conn,"select * from main_dirver where  cno='$cno'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{

$cdet=$row['cdet'];

}
echo $cdet;
?>