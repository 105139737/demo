<?php 
include "config.php";
$edt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a'); 
$eby=$user_currently_loged;

$result = mysqli_query($conn,"SELECT * FROM main_cust where sale_per!='' group by sale_per");
while ($R = mysqli_fetch_array ($result))
{
$sale_per=strtoupper($R['sale_per']);
$val="";
$result1 = mysqli_query($conn,"SELECT * FROM main_cust where sale_per='$sale_per'");
while ($R1= mysqli_fetch_array ($result1))
{
$sl=$R1['sl'];
if($val=="")
{
	$val=$sl;
}
else
{
$val.=",".$sl;	
}
}
	$sql=mysqli_query($conn,"insert into main_cust_asgn(spid,cust,edt,eby) values('$sale_per','$val','$edt','$eby')") or die (mysqli_error($conn));

}