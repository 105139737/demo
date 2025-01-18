<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$str=rawurldecode($_REQUEST['str']);
$fld=$_REQUEST['fld'];

	$responce=array();
	//$responce->fld = $fld;
	//$ret='%'.$str.'%';
	$ret=$str.'%';
	$query2="select * from main_cust WHERE nm LIKE '$ret' order by nm";
	$result2=mysqli_query($conn,$query2);
	while($rw2=mysqli_fetch_array($result2))
	{	
		$responce1=array();
		$responce1['sl']=$rw2['sl'];
		$responce1['name']=$rw2['nm'];
		$responce1['addr']=$rw2['addr'];
		$responce1['cont']=$rw2['cont'];
		$responce1['fld']=$fld;
		$responce[]=$responce1;
	}
	$myJSON = json_encode($responce);
	echo $myJSON;
?>
