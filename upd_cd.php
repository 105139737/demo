<?php 
include("config.php");

$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s');
$data=mysqli_query($conn,"select * from main_cust where sl>0 and typ='2' and brncd='1'")or die(mysqli_error($conn));
$sl=1;
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$nm=$row['nm'];
	echo $sl."--".$x."--".$nm."<br />";
	$result = mysqli_query($conn,"SELECT * FROM main_discount where custid='$x' and days=20 and prefnd=2");
	if(mysqli_num_rows($result)==0)
	{
	   $q3=mysqli_query($conn,"insert into  main_discount (custid,days,prefnd,edt,edtm,eby,stat) values ('$x','20','2','$edt','$edtm','admin','0')")or die (mysqli_error($conn)); 
	}
	
	$result1 = mysqli_query($conn,"SELECT * FROM main_discount where custid='$x' and days=30 and prefnd=1");
	if(mysqli_num_rows($result1)==0)
	{
	   $q4=mysqli_query($conn,"insert into  main_discount (custid,days,prefnd,edt,edtm,eby,stat) values ('$x','30','1','$edt','$edtm','admin','0')")or die (mysqli_error($conn)); 
	}
	
}






?>