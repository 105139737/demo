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


$data= mysqli_query($conn,"select * from  main_purchasedet where blno='$blno'")or die(mysqli_error($conn));
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
  
   echo '<marker ';
  
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

echo '</markers>';




mysqli_close($conn);
