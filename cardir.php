<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$cno=$_REQUEST[cno];
$dnm=$_REQUEST[dnm];

 $data= mysqli_query($conn,"select * from main_dirver where  cno='$cno' and dnm='$dnm'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{

$addr=$row['addr'];
$mob1=$row['mob1'];
$lno=$row['lno'];
$ltyp=$row['ltyp'];
}
$val=$addr."@".$mob1."@".$lno."@".$ltyp;
echo $val;
?>