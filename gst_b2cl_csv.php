<?
$reqlevel = 0;
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}

$filename = "GSTR_1_B2C(Large)_Report.csv";
$fp = fopen('php://output', 'w');

$query9 = "SELECT * FROM main_billing where gstin='' and amm>=250000 and gst='1' and fst!=tst $snm1 and  dt between '$fdt' and '$tdt' and cstat='0'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));



$header = array("Invoice Number", "Invoice date", "Invoice Value", "Place Of Supply", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");	

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
$header = str_replace('"', '', $header);

fputs($fp, implode($header, ',')."\n");

$num_column = count($header);
$ttcgst=0;
$ttsgst=0;
while ($R9 = mysqli_fetch_array ($result9))
{
$gstin_cu=$R9['gstin'];
$invno=$R9['blno'];
$invdt1=$R9['dt'];
$invdt=date('d-M-Y', strtotime($invdt1));	
$tst=$R9['tst'];
$amm=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
$data= mysqli_query($conn,"select *,sum(net_am) as net_am,sum(tamm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
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
		
$data1[0]=$invno;
$data1[1]=$invdt;
$data1[2]=round($net_am,2);
$data1[3]=$statcd.'-'.$statnm;
$data1[4]=$cgst_rt+$sgst_rt;
$data1[5]=round($amm,2);
$data1[6]='';




fputcsv($fp, $data1);


}
	
}
	
	

	
exit;
?>
