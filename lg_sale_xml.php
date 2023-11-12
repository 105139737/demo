<?php
$reqlevel = 3; 
include("config.php");
include("function.php");
date_default_timezone_set('Asia/Kolkata');
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
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s A');
$crnjob= mysqli_query($conn,"insert into main_cornjob(fnm,fdt,tdt,dt,dttm) values('lg_sale_xml','$fdt','$tdt','$edt','$edtm')")or die(mysqli_error($conn));
$dt=date('Ymd', strtotime($tdt));
$file_name="Sale-".$dt;
//header('Content-disposition: attachment; filename='.$file_name.'.xml');
//header('Content-type: application/xml');
ob_start();
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
$dis1=0;
set_time_limit(0);

header("Content-type: text/xml");


echo '<?xml version="1.0" encoding="UTF-8"?>';


echo '<root>';

$tslrt=0;
$igst=0;
$cgst=0;
$sgst=0;
$total_am=0;
$disa_am=0;
$tpcs=0;
$data= mysqli_query($conn,"select *,sum(pcs) as qty from  main_billdtls where sl>0 and cat='2' $todts group by prsl,blno ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$afgst=$row['rate'];
$blno=$row['blno'];
$unit=$row['unit'];
$kg=$row['kg'];
$grm=$row['grm'];
$qty=$row['qty'];
//$pcs="TEST".$qty;
$pcs=$qty;
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$total=$row['total'];
$dt=$row['dt'];
/*
$ttl=$row['ttl'];
*/
$net_am=$row['net_am'];
$disp=$row['disp'];
$disa=$row['disa'];
$betno=$row['betno'];


$dt=date('Ymd', strtotime($dt));



$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
$hsn=$row1['hsn'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$ean=$row['ean'];
}
$tp="";
$bcd="";
$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$tp=$row1['tp'];
$bcd=$row1['bcd'];
$cid=$row1['cid'];
}
if($tp==1){$SELLOUTTYPE="RETAIL";$SITECODETYPE="STORE";}elseif($tp==2){$SELLOUTTYPE="FRANCHISE SALE";$SITECODETYPE="WAREHOUSE";}
$nm='';
$gtm=''; 
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$gtm=$rowd['gtm'];
}
if($bcd=='2')//MBO KGR
{
$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR1598';   
}
if($bcd=='3')//RANAGHAT
{
$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR1796';   
}
if($bcd=='4')//SHOPPE
{
$nm='HINDUSTAN DISTRIBUTOR';
$gtm='DUR0986';   
}

if($bcd=='5')//BURDWAN
{
$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR2910';   
}
if($bcd=='6')//BETHUA
{
$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR2960';   
}
if($bcd=='7')//KARIMPUR
{
$nm='HINDUSTAN DISTRIBUTORS-MBO';
$gtm='DUR2987';   
}
echo '<entry>';
echo '<SELLOUT></SELLOUT>';
echo '<BATCHNO>'.parseToXML($dt).'</BATCHNO>';
echo '<SELLOUTDATE>'.parseToXML($dt).'</SELLOUTDATE>';
echo '<SITECODE>HIN</SITECODE>';
echo '<MTCUST>HDLG</MTCUST>';
echo '<SITECODETYPE>'.$SITECODETYPE.'</SITECODETYPE>';
echo '<SITECODEINFO>16 L.K. MOITRA ROAD, Krishnanagar, WB, 741101</SITECODEINFO>';
echo '<ITEMCODE>'.parseToXML($pnm).'</ITEMCODE>';
echo '<EAN>'.parseToXML($ean).'</EAN>';
echo '<ITEMDESC>'.parseToXML($pnm).'</ITEMDESC>';
echo '<LGMODEL>'.parseToXML($pnm).'</LGMODEL>';
echo '<FAMILYDESC>'.parseToXML($scat_nm).'</FAMILYDESC>';
echo '<SELLOUTTYPE>'.parseToXML($SELLOUTTYPE).'</SELLOUTTYPE>';
echo '<SELLOUTQTY>'.parseToXML($pcs).'</SELLOUTQTY>';
echo '<REGULARITY>Daily</REGULARITY>';
echo '<InvoiceNo>'.parseToXML($blno).'</InvoiceNo>';
echo '<CustomerName>'.parseToXML($nm).'</CustomerName>';
echo '<GTMCODE>'.parseToXML($gtm).'</GTMCODE>';
echo '<InvoiceAmount>'.parseToXML($net_am).'</InvoiceAmount>';
echo '</entry>';

}

echo '</root>';

echo $output = ob_get_clean();


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

?>
