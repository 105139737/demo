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
$ale="";
if($fdt=="" or $tdt=="" or $snm=="")
{
$ale="Invalid";


}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$todt="";
if($fdt!='' and $tdt!='')
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
}

if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}

if($ale=="")
{

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
  
  
  $data= mysqli_query($conn,"select * from  main_purchasedet where sl>0 and blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$qty=$row['qty'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$dis=$row['dis'];
$mrp=$row['mrp'];
$blno1=$row['blno'];
$pck=$row['pck'];
$unit=$row['unit'];
$amm=$row['amm'];
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$net_am=$row['net_am'];
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

$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$hsn="";	
$data12= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$hsn=$row1['hsn'];
}
  
   echo '<item ';
   echo 'Product_Name="' . parseToXML($pnm) . '" ';
   echo 'HSN="' . parseToXML($hsn) . '" ';
   echo 'Quantity="' . parseToXML($qty) . '" ';
   echo 'Unit="' . parseToXML($unit_nm) . '" ';
   echo 'Rate="' . parseToXML($mrp) . '" ';
   echo 'Total="' . parseToXML($ttl) . '" ';
   echo 'Dis_am="' . parseToXML($dis) . '" ';
   echo 'Taxable_Amount="' . parseToXML($amm) . '" ';
   echo 'CGST="' . parseToXML($cgst_rt) . '" ';
   echo 'CGST_Amount="' . parseToXML($cgst_am) . '" ';
   echo 'SGST="' . parseToXML($sgst_rt) . '" ';
   echo 'SGST_Amount="' . parseToXML($sgst_am) . '" ';
   echo 'IGST="' . parseToXML($igst_rt) . '" ';
   echo 'IGST_Amount="' . parseToXML($igst_am) . '" ';
   echo 'Net_Amount="' . parseToXML($net_am) . '" ';
   
     echo '/>';

  
  

	 
} 


  echo '/>';

}



echo '</markers>';
}

else{
echo '<markers>';
   echo '<inv ';
   echo parseToXML('Invalid') . '" ';
    echo '/>';
echo '</markers>';	
	
}

mysqli_close($conn);
