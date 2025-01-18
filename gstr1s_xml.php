<?php 
require("config.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$val=$_REQUEST['val'];
$typ=1;
set_time_limit(0);
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and rdt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
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
$c=0;
if($val=='b2b')
{
$sln=0;
$tamm1=0;
$data12= mysqli_query($conn,"select * from  main_billing where sl>0 and gstin!=''".$todts.$snm1."order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{

$blno=$row1['blno'];
$invno=$row1['blno'];
$dt=$row1['dt'];
$gstin=$row1['gstin'];
$sid=$row1['cid'];
$tamm=$row1['amm'];
$tst=$row1['tst'];
$dt=date('d-M-Y', strtotime($dt));
$sln++;

$query4="Select sum(net_am) as tamm from ".$DBprefix."billdtls where blno='$blno'";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$tamm=$R4['tamm'];
}
$tamm1=$tamm1+$tamm;

$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}


$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}

	$amm=0;
	$net_am=0;
	$cgst_rt=0;   
	$cgst_am=0;   
	$sgst_rt=0;   
	$sgst_am=0; 
	$log=0;
	$ttto=0;

	$data=mysqli_query($conn,"select *,sum(net_am) as net_am,sum(ttl) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
	$rcnt=mysqli_num_rows($data);
	while($row=mysqli_fetch_array($data))
	{
		$amm=$row['amm'];
		$net_am=$row['net_am'];
		$cgst_rt=$row['cgst_rt'];   
		$tcgst=$row['cgst_am'];   
		$sgst_rt=$row['sgst_rt'];   
		$tsgst=$row['sgst_am'];   
		
		$z=0;
  echo '<marker ';
  echo 'GSTIN_UIN_of_Recipient="' . parseToXML($gstin) . '" ';
  echo 'Invoice_Number="' . parseToXML($blno) . '" ';
  echo 'Invoice_date="' . parseToXML($dt) . '" ';
  echo 'Invoice_Value="' . parseToXML( round($tamm,2)) . '" ';
  echo 'Place_Of_Supply="' . parseToXML( $statcd.'-'.$statnm) . '" ';
  echo 'Reverse_Charge="' . parseToXML('N') . '" ';
  echo 'Invoice_Type="' . parseToXML('Regular') . '" ';
	echo 'E_Commerce_GSTIN="' . parseToXML('') . '" ';
	echo 'Rate="' . parseToXML( $cgst_rt+$sgst_rt) . '" ';
	echo 'Taxable_Value="' . parseToXML( round($amm,2)) . '" ';
	echo 'CGST_Am="' . parseToXML( round($tcgst,2)) . '" ';
	echo 'SGST_Am="' . parseToXML( round($tsgst,2)) . '" ';
	echo 'Cess_Amount="0" ';
 echo '/>';

	

}
}
}

if($val=='b2cs')
{
$data0= mysqli_query($conn,"select main_billdtls.cgst_rt,main_billdtls.sgst_rt,sum(main_billdtls.net_am) as net_am,sum(main_billdtls.ttl) as amm,sum(main_billdtls.cgst_am) as cgst_am,sum(main_billdtls.sgst_am) as sgst_am from main_billdtls INNER JOIN main_billing ON main_billdtls.blno=main_billing.blno where main_billing.gstin='' and main_billing.amm<250000 and main_billing.dt between '$fdt' and '$tdt' group by sgst_rt order by sgst_rt")or die(mysqli_error($conn));
$mnc1=mysqli_num_rows($data0);
while ($rowt = mysqli_fetch_array($data0))
{
$amm2=$rowt['amm'];
$net_am=$rowt['net_am'];
$cgst_rt2=$rowt['cgst_rt'];  
$sgst_rt2=$rowt['sgst_rt'];   
$tcgst=($amm2*$cgst_rt2)/100;
$tsgst=($amm2*$sgst_rt2)/100;
$rw2++;
$z=0;

  echo '<marker ';
  echo 'Type="' . parseToXML('OE') . '" ';
  echo 'Place_Of_Supply="' . parseToXML('19-West Bengal') . '" ';
  echo 'Rate="' . parseToXML($cgst_rt2+$sgst_rt2) . '" ';
  echo 'Taxable_Value="' . parseToXML(round($amm2,2)) . '" ';
  echo 'CGST_Am="' . parseToXML( round($tcgst,2)) . '" ';
  echo 'SGST_Am="' . parseToXML( round($tsgst,2)) . '" ';
  echo 'Cess_Amount="0" ';
  echo 'E-Commerce_GSTIN="NA" ';

  echo '/>';
  
}
}




echo '</markers>';
?>