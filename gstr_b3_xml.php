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
$mnth=$_REQUEST['mnth'];
$yr=$_REQUEST['yr'];
$fdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-01"));
$tdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-".date('t',strtotime($fdt))));
$query9 = "SELECT * FROM main_billing where dt between '$fdt' and '$tdt' order by gstin, dt";
$result9 = mysqli_query($conn,$query9)or die(mysqli_error($conn));
$ttcgst=0;
$ttsgst=0;
$ttigst=0;
$tval=0;
while ($R9 = mysqli_fetch_array ($result9))
{
$gstin_cu=$R9['gstin'];
$invno=$R9['blno'];
$invdt=$R9['dt'];	

$amm=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$igst_am=0; 
$log=0;
$data1= mysqli_query($conn,"select sum(net_am) as net_am,sum(ttl) as amm1,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data1))
{
$amm=$row['amm1'];
$net_am=$row['net_am'];
$cgst_rt=$row['cgst_rt'];   
$tcgst=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$tsgst=$row['sgst_am'];   
$tigst=$row['igst_am'];   
	
$tiamm+=$net_am;
$tttamm+=$amm;
$ttcgst+=$tcgst;
$ttsgst+=$tsgst;
$ttigst+=$tigst;
$tval+=$amm;
}

}
$query91 = "SELECT * FROM main_purchase where dt between '$fdt' and '$tdt' order by sid, dt";
$result91 = mysqli_query($conn,$query91)or die(mysqli_error($conn));
$tcgst1=0;   
$tsgst1=0;   
$tigst1=0; 
$tttamm1=0;
$tiamm1=0;
while ($R91 = mysqli_fetch_array ($result91))
{
$cgst=0;
$sgst=0;
$igst=0;
$blno=$R91['blno'];
$invdt=$R91['dt'];	

$amm1=0;
$net_am1=0;
$cgst_rt1=0;   
$cgst_am1=0;   
$sgst_rt1=0;   
$sgst_am1=0; 
$data= mysqli_query($conn,"select sum(net_am) as net_am,sum(ttl) as amm1,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_purchasedet where blno='$blno' group by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm1=$row['amm1'];
$net_am1=$row['net_am'];
$cgst_rt1=$row['cgst_rt'];   
$sgst_rt1=$row['sgst_rt'];   
$igst_rt1=$row['igst_rt'];  
$cgst1=$row['cgst_am'];    
$sgst1=$row['sgst_am'];   
$igst1=$row['igst_am'];   
$tcgst1+=$cgst1;    
$tsgst1+=$sgst1;   
$tigst1+=$igst1;
$ttamm1=$amm1;		
$tiamm1+=$net_am1;
$tttamm1+=$ttamm1;
}

}
echo '<markers>';
  echo '<marker ';
  echo 'Outward_taxable_supplies_Total_Taxable_Value="' . parseToXML(round($tval,2)) . '" ';
  echo 'Outward_taxable_supplies_Integrated_Tax="' . parseToXML(round($ttigst,2)) . '" ';
  echo 'Outward_taxable_supplies_Central_Tax="' . parseToXML(round($ttcgst,2)) . '" ';
  echo 'Outward_taxable_supplies_State_UT_Tax="' . parseToXML(round($ttsgst,2)) . '" ';
  echo 'Net_ITC_Available_Integrated_Tax="' . parseToXML(round($tigst1,2)) . '" ';
  echo 'Net_ITC_Available_Central_Tax="' . parseToXML(round($tcgst1,2)) . '" ';
  echo 'Net_ITC_Available_State_UT_Tax="' . parseToXML(round($tsgst1,2)) . '" ';
  echo '/>';
echo '</markers>';
mysqli_close($conn);