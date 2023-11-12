<?php 
$reqlevel = 1;
include("membersonly.inc.php");
set_time_limit(0);
$brncd=rawurldecode($_REQUEST['brncd']);
$brand=rawurldecode($_REQUEST['cat']);


$cnt=0;
$data11= mysqli_query($conn,"SELECT * FROM main_godown_tag where sl>0 and brncd='$brncd' and brand='$brand'");
while ($row11= mysqli_fetch_array($data11))
{	
$tsl=$row11['bcd'];
}
echo $tsl;