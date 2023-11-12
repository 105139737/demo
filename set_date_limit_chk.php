<?php
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=$_REQUEST['dt'];
$current_dt=date('Y-m-d');
$dt=date('Y-m-d', strtotime($dt));
$query="Select * from main_dt";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$dt_limit=$R['dt'];
}
	$limit_dt = strtotime ( "- ".$dt_limit." day" , strtotime ( $current_dt) ) ;
		$limit_dt = date ( 'Y-m-d' , $limit_dt );
if($user_current_level>0)
{
		if(strtotime($dt)>=strtotime($limit_dt))
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
}
else
{
echo '1';	
}
?>
