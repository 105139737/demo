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
$gsdo=mysqli_query($conn,"select * from  main_cust order by nm");
while($SDO=mysqli_fetch_array($gsdo))
{
    $spn=$SDO['nm'];
    $sl=$SDO['sl'];
   echo '<marker ';
  echo 'sl="' . $sl . '" ';
  echo 'name="' . parseToXML($spn) . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

mysqli_close($conn);



?>