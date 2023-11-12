<?php
include("config.php");

$typ=1;
set_time_limit(0);
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}


if($fdt!="" and $tdt!=""){$todt=" and rdt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
require_once 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/CSV.php';
date_default_timezone_set('Asia/Kolkata');
$dttm=date('d-m-Y H:i:s a');
$file="GSTR_1_Report.xls";

$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Sheet1");
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle("b2b");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'GSTIN/UIN of Recipient');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Invoice date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'Reverse Charge');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,4, 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,4, 'E-Commerce GSTIN');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,4, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,4, 'Cess Amount');
$rw=4;
$c=0;
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
	$rw++;

if($rcnt>0)
{

	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$rw, $gstin);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$rw, $blno);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$rw, $dt);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$rw, round($tamm,2));
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$rw, $statcd.'-'.$statnm);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$rw, 'N');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,$rw, 'Regular');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,$rw, '');
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,$rw, $cgst_rt+$sgst_rt);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,$rw, round($amm,2));
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,$rw, '');
}
else
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($z,$rw, "0");
}

}
}
$objPHPExcel->createSheet(2);
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setTitle("b2cl");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Invoice date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,4, 'Cess Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,4, 'E-Commerce GSTIN');
$rw1=4;
$dddi = mysqli_query($conn,"SELECT * FROM main_billing where gstin='' and amm>=250000 and gst='1' $snm1 and  dt between '$fdt' and '$tdt'") or die(mysqli_error($conn));
while ($R9i = mysqli_fetch_array ($dddi))
{
$invno1=$R9i['blno'];
$invdt1=$R9i['dt'];
$invdt1=date('d-M-Y', strtotime($invdt1));	
$tst1=$R9i['tst'];
$amm=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$gbit1=mysqli_query($conn,"select * from main_state where sl='$tst1'") or die (mysqli_error($conn));
while($GBi1=mysqli_fetch_array($gbit1))
{
$statnm1=$GBi1['sn'];
$statcd1=$GBi1['cd'];
}
$datai= mysqli_query($conn,"select *,sum(net_am) as net_am,sum(ttl) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls where  blno='$invno1' group by sgst_rt")or die(mysqli_error($conn));
$mnc=mysqli_num_rows($datai);
while ($rowi = mysqli_fetch_array($datai))
{
$amm1=$rowi['amm'];
$net_am1=$rowi['net_am'];
$cgst_rt1=$rowi['cgst_rt'];  
$sgst_rt1=$rowi['sgst_rt'];   
$rw1++;
$z=0;
if($mnc>0)
{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$rw1, $invno1);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$rw1, $invdt1);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$rw1, round($net_am1,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$rw1, $statcd1.'-'.$statnm1);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$rw1, $cgst_rt1+$sgst_rt1);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$rw1, round($amm1,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,$rw1, '');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,$rw1, '');
}
else
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($z,$rw1, "0");
}
}
}
$objPHPExcel->createSheet(3);
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->setTitle("b2cs");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Cess Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'E-Commerce GSTIN');
$rw2=4;
$data0= mysqli_query($conn,"select main_billdtls.cgst_rt,main_billdtls.sgst_rt,sum(main_billdtls.net_am) as net_am,sum(main_billdtls.ttl) as amm,sum(main_billdtls.cgst_am) as cgst_am,sum(main_billdtls.sgst_am) as sgst_am from main_billdtls INNER JOIN main_billing ON main_billdtls.blno=main_billing.blno where main_billing.gstin='' and main_billing.amm<250000 and main_billing.dt between '$fdt' and '$tdt' group by sgst_rt order by sgst_rt")or die(mysqli_error($conn));
$mnc1=mysqli_num_rows($data0);
while ($rowt = mysqli_fetch_array($data0))
{
$amm2=$rowt['amm'];
$net_am=$rowt['net_am'];
$cgst_rt2=$rowt['cgst_rt'];  
$sgst_rt2=$rowt['sgst_rt'];   
$rw2++;
$z=0;
if($mnc1>0)
{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$rw2, 'OE');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$rw2, '19-West Bengal');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$rw2, $cgst_rt2+$sgst_rt2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$rw2, round($amm2,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$rw2, '');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$rw2, '');
}
else
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($z,$rw2, "0");
}
}
$objPHPExcel->createSheet(4);
$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->setTitle("cdnr");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'GSTIN/UIN of Recipient');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Invoice/Advance Receipt Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Invoice/Advance Receipt date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Note/Refund Voucher Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Note/Refund Voucher date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'Document Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,4, 'Reason For Issuing document');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,4, 'Note/Refund Voucher Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,4, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,4, 'Cess Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12,4, 'Pre GST');
$objPHPExcel->createSheet(5);
$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->setTitle("cdnur");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'UR Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Note/Refund Voucher Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Note/Refund Voucher date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Document Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Invoice/Advance Receipt Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'Invoice/Advance Receipt date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,4, 'Reason For Issuing document');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,4, 'Note/Refund Voucher Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,4, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,4, 'Cess Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12,4, 'Pre GST');
$objPHPExcel->createSheet(6);
$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->setTitle("exp");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Export Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Invoice date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Port Code');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'Shipping Bill Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,4, 'Shipping Bill Date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,4, 'Taxable Value');
$objPHPExcel->createSheet(7);
$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet()->setTitle("at");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Gross Advance Received');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Cess Amount');
$objPHPExcel->createSheet(8);
$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet()->setTitle("atadj");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Gross Advance Adjusted');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Cess Amount');
$objPHPExcel->createSheet(9);
$objPHPExcel->setActiveSheetIndex(9);
$objPHPExcel->getActiveSheet()->setTitle("exemp");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Description');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Nil Rated Supplies');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Exempted (other than nil rated/non GST supply )');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Non-GST supplies');
$objPHPExcel->createSheet(10);
$objPHPExcel->setActiveSheetIndex(10);
$objPHPExcel->getActiveSheet()->setTitle("hsn");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'HSN');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Description');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'UQC');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Total Quantity');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Total Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,4, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,4, 'Integrated Tax Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,4, 'Central Tax Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,4, 'State/UT Tax Amount');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,4, 'Cess Amount');
$rw3=4;
$bqr="";

if($typ==1)
{
$query90 = "SELECT blno FROM main_billing where dt between '$fdt' and '$tdt'";
}
if($typ==2)
{
$query90 = "SELECT blno FROM main_purchase where dt between '$fdt' and '$tdt'";
}
$result90 = mysqli_query($conn,$query90) or die (mysqli_error($conn) );
$mnc5=mysqli_num_rows($result90);
while($X0=mysqli_fetch_array($result90))
{
$blno=$X0['blno'];	
if($bqr=="")
{
$bqr.=" and ( blno='$blno'";
}
else
{
$bqr.=" or blno='$blno'";
}
}
$bqr.=")";
$eqr="";
$res=mysqli_query($conn,"select * from main_scat where hsn!='' group by hsn")or die(mysqli_error($conn));
while($R5=mysqli_fetch_array($res))
{
$eqr=" and ( prsl='a'";
$hsn=$R5['hsn'];
$qr="(scat='0'";
$res0=mysqli_query($conn,"select * from main_scat where hsn='$hsn'") or die(mysqli_error($conn));
while($R0=mysqli_fetch_array($res0))
{
$sl1=$R0['sl'];
$cat=$R0['cnm'];
$snm=$R0['nm'];
$qr.=" or scat='$sl1'";
}
$qr.=")";
$res1=mysqli_query($conn,"select * from main_product where $qr")or die(mysqli_error($conn));
while($R1=mysqli_fetch_array($res1))
{
$psl=$R1['sl'];
$eqr.=" or prsl='$psl'";
}
$eqr.=")";
$xqr=mysqli_query($conn,"select (cgst+sgst) as tigst from main_gst where cat='$sl1'")or die(mysqli_error($conn));
while($R000=mysqli_fetch_array($xqr))
{
	$igst=$R000[tigst];
}
$ttamm=0;
$tcgst_am=0;
$tsgst_am=0;
$tigst_am=0;
$tnet_am=0;
$tpcs=0;

if($typ==1)
{
$res15=mysqli_query($conn,"select sum(ttl) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(pcs) as tpcs from main_billdtls where sl>0 $eqr $bqr") or die (mysqli_error($conn));
}
if($typ==2)
{
$res15=mysqli_query($conn,"select sum(amm) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(qty) as tpcs from main_purchasedet where sl>0 $eqr $bqr") or die (mysqli_error($conn));
}
while($R16=mysqli_fetch_array($res15))
{
$ttamm=$R16['ttamm'];
$tcgst_am=$R16['tcgst_am'];
$tsgst_am=$R16['tsgst_am'];
$tigst_am=$R16['tigst_am'];
$tnet_am=$R16['tnet_am'];
$tpcs=$R16['tpcs'];
}
	$avv=str_replace('/', ' ', $snm);
	$avv=str_replace('&', ' ', $avv);
$rw3++;
$z=0;
if($mnc5>0)
{
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$rw3, $hsn);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$rw3, substr($avv,0,30));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$rw3, 'PCS-PIECE');
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$rw3, $tpcs);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$rw3, round($tnet_am,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$rw3, round($ttamm,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,$rw3, round($tigst_am,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,$rw3, round($tcgst_am,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,$rw3, round($tsgst_am,2));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,$rw3, '');
}
else
{
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($z,$rw3, "0");
}
}
$objPHPExcel->createSheet(11);
$objPHPExcel->setActiveSheetIndex(11);
$objPHPExcel->getActiveSheet()->setTitle("docs");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4, 'Nature  of Document');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4, 'Sr. No. From');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4, 'Sr. No. To');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4, 'Total Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,4, 'Cancelled');
$objPHPExcel->removeSheetByIndex(12);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($file);
exit;
?>