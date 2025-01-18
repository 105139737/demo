<?php 
$day=$_REQUEST['day'];
$cdt=date('Y-m-d');
$dd=strtolower(date('l'));
if($dd==$day)
{
	echo date("d-m-Y",strtotime($cdt));
}
else
{
	echo date("d-m-Y", strtotime("next $day", strtotime($cdt)));
}

?>