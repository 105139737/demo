<?
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

$scat=$_REQUEST['scat'];



echo '<markers>';

$sln=0;
$scat_nm="";
$data12= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$scat_nm=$row1['nm'];
}
$data= mysqli_query($conn,"select * from main_product where sl>0 and scat='$scat' order by pnm")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
$unit=$row['unit'];
$nm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
$sun=$roww['sun'];
}
$stck1=0;
$stock_close=0;
$query4="Select sum(opst+stin-stout) as stck1 from main_stock where pcd='$pcd' ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck1=$R4['stck1'];
}
$stkf=$stck1;
if($stkf==""){$stkf=0;}
$stock_close=$stkf." ".$sun;
$stock_in=0;
$stin=0;
$query7="Select sum(opst+stin) as stin from ".$DBprefix."stock where pcd='$pcd'  order by pcd";
$result7 = mysqli_query($conn,$query7);
while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
$stin1=$stin;
if($stin1==""){$stin1=0;}
$stock_in=$stin1." ".$sun;
$stout=0;
$stock_out="";
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and stout>0 order by pcd";
$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
$stout1=$stout;
if($stout1==""){$stout1=0;}
$stock_out=$stout1." ".$sun;

  echo '<marker ';
  echo 'scat_nm="' . parseToXML($nm) . '" ';
  echo 'pnm="' . parseToXML($scat_nm) . '" ';
  echo 'stock_in="' . parseToXML($stock_in) . '" ';
  echo 'stock_out="' . parseToXML($stock_out) . '" ';
  echo 'stock_close="' . parseToXML($stock_close) . '" ';
  echo '/>';

}



echo '</markers>';




mysqli_close($conn);
