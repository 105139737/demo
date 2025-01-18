<?php 
include "config.php";
	$q=$_GET['q'];
	$manu=$_REQUEST[mu];
	$my_data=mysqli_real_escape_string($q);
	if($my_data!='')
	{
		$my="and cnm LIKE '%$my_data%'";
	}
	else
	{
		$my="";
	}
	$sql="SELECT cnm FROM main_catg WHERE sl>0 $my group BY cnm";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			echo $row['cnm']."\n";
		}
	}
?>