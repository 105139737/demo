<?
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$pdt=date('Y-m-d', strtotime($dt));
$pdt1=date('Y-m-d', strtotime($dt1));

if($pno!='0')
{
$data22= mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'");
while ($row22 = mysqli_fetch_array($data22))
	{
	$wrknm = $row22['nm'];
	}
$qry1=" pno='$pno' and dt between '$pdt' and '$pdt1' order by dt";

}


$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where  pcd='8'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
		

$gtot2=0;		
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where dldgr='$ldgr' and".$qry1."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
		
}

$gtot2=$gtot2+$gtot3;



if($ldgr=='-3')
{
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where sl='-5'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
			
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where cldgr='$ldgr' and".$qry1."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
		
}

$gtot2=$gtot2-$gtot3;

}}
$gtot1=$gtot1+$gtot2;
}}
$pET=$gtot1;
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where  pcd='7'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
		

$gtot2=0;		
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where cldgr='$ldgr' and".$qry1."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
		
}

$gtot2=$gtot2+$gtot3;



if($ldgr=='-2')
{
$data331= mysqli_query($conn,"SELECT * FROM main_ledg where sl='-4'");
while ($row33 = mysqli_fetch_array($data331))
{


$cnt7++;
$ldgr = $row33['sl'];
$gnm = $row33['nm'];
				
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where dldgr='$ldgr' and".$qry1."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
}

$gtot2=$gtot2-$gtot3;	
}}
$gtot1=$gtot1+$gtot2;
}}
$pIT=$gtot1;
$T=$pIT-$pET;
?>

  