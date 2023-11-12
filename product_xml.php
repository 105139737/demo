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

echo '<markers>';
				
$data12= mysqli_query($conn,"select * from main_scat order by nm")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$scat_nm=$row1['nm'];
$sl=$row1['sl'];

   echo '<marker ';
  echo 'sl="' . $sl . '" ';
  echo 'name="' . parseToXML($scat_nm) . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

mysqli_close($conn);



?>