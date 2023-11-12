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

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['snm'];

$brncd=$_REQUEST[brncd];



if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$todt="";
if($fdt!='' and $tdt!='')
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
}

if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}



echo '<markers>';

$sln=0;
$TBasic=0;
$TDiscount=0;
$TTaxable=0;
$Tcgst=0;
$Tsgst=0;
$Tigst=0;
$Tnet_am=0;

$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$todt.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$sid=$row1['cid'];
$amm=$row1['amm'];
$gstin=$row1['gstin'];
$dt=date('d-m-Y', strtotime($dt));
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}

   echo '<marker ';
  echo 'invno="' . parseToXML($blno) . '" ';
  echo 'invdt="' . parseToXML($dt) . '" ';
  echo 'snm="' . parseToXML($nm) . '" ';
  echo 'gstin="' . parseToXML($gstin) . '" ';
  echo 'net_am="' . parseToXML($amm) . '" ';
  echo '/>';

}



echo '</markers>';




mysqli_close($conn);
