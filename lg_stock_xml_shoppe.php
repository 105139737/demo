<?php 
$reqlevel = 3; 
include("config.php");
include("function.php");
$dt="";
$sl=0;
date_default_timezone_set('Asia/Kolkata');
set_time_limit(0);
$file_name="Stock-".$dt;

header('Content-disposition: attachment; filename='.$file_name.'.xml');
header('Content-type: application/xml');
ob_start();
if($_REQUEST['fdt']!='' and $_REQUEST['tdt']!='')
{
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
}
else
{
$fdt=date('Y-m-d');
$tdt=date('Y-m-d');  
}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$dt=date('Ymd', strtotime($tdt));

$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s A');
$tstck=0;
$ftstck=0;

if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
$dis1=0;
set_time_limit(0);

$dt=date('Ymd', strtotime($tdt));

echo '<root>';


$data=mysqli_query($conn,"select * from main_product where sl>0 and typ='0' and cat='2'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
$sl++;
$pcd=$row['sl'];
$unit=$row['unit'];
$nm=$row['pnm'];
$ean=$row['ean'];
$scat=$row['scat'];
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$stck=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$tdt' and bcd='7'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$ftstck+=$stck;
if($stck>0)
{
    $tstck+=$stck;
echo '<entry>';
echo '<STOCK>'.parseToXML($stck).'</STOCK>';
echo '<BATCHNO>'.parseToXML($dt).'</BATCHNO>';
echo '<STOCKDATE>'.parseToXML($dt).'</STOCKDATE>';
echo '<SITECODE>HIN</SITECODE>';
echo '<MTCUST>HDLG</MTCUST>';
echo '<SITECODETYPE>WH</SITECODETYPE>';
echo '<SITECODEINFO>102 D L ROY ROAD, KRISHNAGAR, NADIA</SITECODEINFO>';
echo '<ITEMCODE>'.parseToXML($nm).'</ITEMCODE>';
echo '<EAN>'.parseToXML($ean).'</EAN>';
echo '<ITEMDESC>'.parseToXML($nm).'</ITEMDESC>';
echo '<FAMILYNAME>'.parseToXML($scat_nm).'</FAMILYNAME>';
echo '<PARTNO></PARTNO>';
echo '<SERIALNO></SERIALNO>';
echo '<SALEABLE>'.parseToXML($stck).'</SALEABLE>';
echo '<DEFECT>'.parseToXML('0').'</DEFECT>';
echo '<DISPLAY>'.parseToXML('0').'</DISPLAY>';
echo '<TRANSITQTY>'.parseToXML('0').'</TRANSITQTY>';
echo '</entry>';
}

//echo $sl."----".$stck."----".$ftstck."-----".$tstck."<br>";
}
echo '</root>';

$output = ob_get_clean();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://gateway.b2be.com/http/incoming/hindustan-in.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $output,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic aGluZHVzdGFuLWluOmU1SShrRTdAJHg=",
    "Content-Type: application/xml"
  ),
));

$response = curl_exec($curl);
if(curl_errno($curl))
	echo 'curl error : '. curl_error($curl);

curl_close($curl);
echo $response;

$crnjob= mysqli_query($conn,"insert into main_cornjob(fnm,fdt,tdt,dt,dttm,response) values('lg_stock_xml_shoppe','$fdt','$tdt','$edt','$edtm','$response')")or die(mysqli_error($conn));
?>