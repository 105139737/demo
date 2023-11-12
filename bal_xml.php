<?php
require("config.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
header("Content-type: text/xml");

$T=0;
$t1=0;
$t2=0;

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and dldgr='4'");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}	
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cldgr='4'");
while ($row1 = mysqli_fetch_array($data1))
{
	$t2 = $row1['t2'];
}
$recv=$t1-$t2;



$data3= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and dldgr='12'");
while ($row = mysqli_fetch_array($data3))
{
	$t1 = $row['t1'];
}
		

$data4= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where stat='1' and cldgr='12'");
while ($row1 = mysqli_fetch_array($data4))
	{
		$t2 = $row1['t2'];
	}
$pay=$t2-$t1;	

echo '<markers>';
				


   echo '<marker ';
  echo 'recv="' . parseToXML($recv) . '" ';
  echo 'pay="' . parseToXML($pay) . '" ';
  echo '/>';


// End XML file
echo '</markers>';

mysqli_close($conn);



?>