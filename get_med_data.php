<?php 
include "config.php";
$mnm=rawurldecode($_REQUEST['mnm']??"");
$response = array();
$response1 = array();

	
	$mnm="%".$mnm."%";
	
	
	
$data1 = mysqli_query($conn,"Select * from  main_cust where nm LIKE '$mnm' or cont LIKE '$mnm' LIMIT 0,50");
while ($row1 = mysqli_fetch_array($data1))
	{
	$name=$row1['nm']." ( ".$row1['cont']." )";
	$sl=$row1['sl'];
	$addr=$row1['addr'];
	$response['name']=$name;
	$response['id']=$sl;
	$response['manufacturer']=$addr;
	$response1[]=$response;
	}

$myObj = new StdClass;
	$myObj= $response1;
	$myJSON = json_encode($myObj);
	echo $myJSON;
	mysqli_close($conn);

?>
