<?php 

$reqlevel = 0;
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
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
$file="GSTR_1_B2B_Report.xls";

$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Sheet1");
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle("b2b");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, 'GSTIN/UIN of Recipient');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, 'Invoice date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,1, 'E-Commerce GSTIN');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,1, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,1, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,1, 'Cess Amount');
$rw=1;
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
$amm=$row1['amm'];
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
			
		$tiamm+=$net_am;
		$tttamm+=$amm;
		$ttcgst+=$tcgst;
		$ttsgst+=$tsgst;
		$ttto+=$net_am;
$z=0;
	$rw++;

if($rcnt>0)
{
	
$data1[0]=$gstin;
$data1[1]=$blno;
$data1[2]=$dt;
$data1[3]=round($net_am,2);
$data1[4]=$statcd.'-'.$statnm;
$data1[5]='N';
$data1[6]='Regular';
$data1[7]='';
$data1[8]=$cgst_rt+$sgst_rt;
$data1[9]=round($amm,2);
$data1[10]='';

	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$rw, $gstin);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$rw, $blno);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$rw, $dt);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$rw, round($net_am,2));
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
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, 'GSTIN/UIN of Recipient');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, 'Invoice Number');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, 'Invoice date');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, 'Invoice Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, 'Place Of Supply');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, 'Invoice Type');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,1, 'E-Commerce GSTIN');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,1, 'Rate');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,1, 'Taxable Value');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,1, 'Cess Amount');


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$file.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>