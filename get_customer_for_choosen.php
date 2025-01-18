<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$val=rawurldecode($_REQUEST['val']);
	$qury2=" and (nm like '%$val%' or cont like '%$val%')";
	//$qury2
		$query="select sl,nm,cont from main_cust WHERE sl>0  and stat='0' $qury2  order by nm limit 20";
		 $result=mysqli_query($conn,$query);
		 $json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
		 echo json_encode($json );
	?>

