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

$blno=$_REQUEST['blno'];



echo '<markers>';

$sln=0;
$TBasic=0;
$TDiscount=0;
$TTaxable=0;
$Tcgst=0;
$Tsgst=0;
$Tigst=0;
$Tnet_am=0;

$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$blno1=$row['blno'];
$unit=$row['unit'];
$kg=$row['kg'];
$grm=$row['grm'];
$pcs=$row['pcs'];
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$net_am=round($row['net_am']);
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$cat'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$unit_nm=$sun;}
if($unit=='mun'){$unit_nm=$mun;}
if($unit=='bun'){$unit_nm=$bun;}
  echo '<marker ';
  echo 'pnm="' . parseToXML($pnm) . '" ';
  echo 'pcs="' . parseToXML($pcs.$unit_nm) . '" ';
  echo 'prc="' . parseToXML($prc) . '" ';
  echo 'taxamm="' . parseToXML($ttl) . '" ';
  echo 'cgst_rt="' . parseToXML($cgst_rt) . '" ';
  echo 'cgst_am="' . parseToXML($cgst_am) . '" ';
  echo 'sgst_rt="' . parseToXML($sgst_rt) . '" ';
  echo 'sgst_am="' . parseToXML($sgst_am) . '" ';
  echo 'igst_rt="' . parseToXML($igst_rt) . '" ';
  echo 'igst_am="' . parseToXML($igst_am) . '" ';
  echo 'net_am="' . parseToXML($net_am) . '" ';
  echo '/>';

}



echo '</markers>';




mysqli_close($conn);
