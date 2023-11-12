<?php
include "config.php";
	$q=$_GET['q'];
	$my_data=mysqli_real_escape_string($q);
	if($my_data!='')
	{
		$my="and (nm LIKE '%$my_data%' or mob1 LIKE '%$my_data%' or spn LIKE '%$my_data%')";
		
	}
	else
	{
		$my="";
	}
	$sql="SELECT spn FROM main_suppl WHERE sl>0 and (tp='Debtors' or tp='Both') $my ORDER BY spn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			
			
			echo $row['spn']."\n";
		}
	}
?>