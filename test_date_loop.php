<?php 
$day=$_REQUEST['day'];
$day="sunday";
date_default_timezone_set("Asia/kolkata");
$cdt=date('Y-m-d');
$dd=strtolower(date('l'));
if($dd==$day)
{
	$cdtt=date("Y-m-d",strtotime($cdt));
}
else
{
	$cdtt=date("Y-m-d", strtotime("next $day", strtotime($cdt)));
}
$ldtt='2019-12-31';

$diff = (strtotime($ldtt) - strtotime($cdtt));
$diff = floor($diff / (60*60*24));
$ddig=floor($diff/7);
for($i=0;$i<$ddig;$i++)
{
	
	$cdtt=date('Y-m-d', strtotime($cdtt. ' + 7 days'));
	echo $cdtt."<br>";
}
