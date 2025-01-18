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

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['snm'];

$brncd=$_REQUEST['brncd'] ?? "";



if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$todt="";
if($fdt!='' and $tdt!='')
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
}

if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}



echo '<markers>';

$sln=0;
$TBasic=0;
$TDiscount=0;
$TTaxable=0;
$Tcgst=0;
$Tsgst=0;
$Tigst=0;
$Tnet_am=0;

$data1= mysqli_query($conn,"select * from main_purchase where sl>0 ".$todt.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$edt=$row1['dt'];
$pbill=$row1['inv'];
$sid=$row1['sid'];
$lfr=$row1['lfr'];
$lcd=$row1['lcd'];
$vatamm=$row1['vatamm'];
$sdis=$row1['sdis'];
$tamm=$row1['tamm'];
$paddr=$row1['addr'];
$edt=date('d-m-Y', strtotime($edt));
$sln++;
$sgstin="";
$datadrt= mysqli_query($conn,"select * from main_suppl_gst where sl='$paddr'")or die(mysqli_error($conn));
while ($rowdrt = mysqli_fetch_array($datadrt))
{

$sgstin=$rowdrt['gstin'];
$suaddr=$rowdrt['addr'];
}

$datad= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['spn'];
}
$Basic=0;
$Discount=0;
$Taxable=0;
$cgst=0;
$sgst=0;
$igst=0;
$net_am=0;
$query1 = "SELECT sum(ttl) as Basic,sum(dis) as Discount,sum(amm) as Taxable,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst,sum(net_am) as net_am FROM main_purchasedet where blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$Basic=$R1['Basic'];
$Discount=$R1['Discount'];
$Taxable=$R1['Taxable'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
$net_am=$R1['net_am'];
}
$TBasic+=$Basic;
$TDiscount+=$Discount;
$TTaxable+=$Taxable;
$Tcgst+=$cgst;
$Tsgst+=$sgst;
$Tigst+=$igst;
$Tnet_am+=$net_am;

   echo '<marker ';
  echo 'refno="' . parseToXML($blno) . '" ';
  echo 'invdt="' . parseToXML($edt) . '" ';
  echo 'invno="' . parseToXML($pbill) . '" ';
  echo 'snm="' . parseToXML($spn) . '" ';
  echo 'gstin="' . parseToXML($sgstin) . '" ';
  echo 'basic="' . parseToXML($Basic) . '" ';
  echo 'discount="' . parseToXML(round($Discount,2)) . '" ';
  echo 'taxable="' . parseToXML(round($Taxable,2)) . '" ';
  echo 'cgst="' . parseToXML(round($cgst,2)) . '" ';
  echo 'sgst="' . parseToXML(round($sgst,2)) . '" ';
  echo 'igst="' . parseToXML(round($igst,2)) . '" ';
  echo 'net_am="' . parseToXML(round($net_am,2)) . '" ';
  echo '/>';

}



echo '</markers>';




mysqli_close($conn);
