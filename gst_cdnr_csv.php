<?php
$reqlevel = 0;
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$ndoc=rawurldecode($_REQUEST['ndoc']);
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

$filename = "GSTR-1_cdnr_Report $fdt to $tdt.csv";
$fp = fopen('php://output', 'w');

if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}


if($fdt!="" and $tdt!=""){$todt=" and rdt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

$header = array("GSTIN/UIN of Recipient", "Receiver Name", "Note Number", "Note Date" ,"Note Type" ,"Place Of Supply", "Reverse Charge", "Note Supply Type", "Note Value", "Applicable % of Tax Rate" ,"Rate" ,"Taxable Value" ,"Cess Amount");	

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
$header = str_replace('"', '', $header);
for($xxx=0;$xxx<3;$xxx++)
{
$datas[0]='';
$datas[1]="";
$datas[2]="";
$datas[3]="";
$datas[4]="";
$datas[5]="";
$datas[6]="";
$datas[7]="";
$datas[8]="";
$datas[9]="";
$datas[10]="";
$datas[11]="";
fputcsv($fp, $datas);
}
fputs($fp, implode($header, ',')."\n");

$num_column = count($header);

$sln=0;
		$tamm1=0;


$data1= mysqli_query($conn,"select * from  main_billing_ret where sl>0 and gstin!='' and cstat='0'".$todts.$snm1."order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$invno=$row1['blno'];
$dt=$row1['dt'];
$gstin=$row1['gstin'];
$cid=$row1['cid'];
$tamm=$row1['amm'];
$tst=$row1['tst'];
	$invdt=$row1['invdt'];
$refno=$row1['refno'];

$invto=$row1['invto'];
$dt=date('d-M-Y', strtotime($dt));
$invdt=date('d-M-Y', strtotime($invdt));
$sln++;

$query4="Select sum(net_am) as tamm from ".$DBprefix."billdtls_ret where blno='$blno'";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$tamm=$R4['tamm'];
}
$tamm1=$tamm1+$tamm;
if($invto!='')
{
$cid=$invto;	
}
else
{
$cid=$cid;	
}
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nmp=$rowd['nmp'];
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}
if($nmp!="")
{
$nm=$nmp;	
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
	$igst_rt=0;   
	$sgst_am=0; 
	$log=0;
	$ttto=0;
$tttamm=0;
	$data=mysqli_query($conn,"select *,sum(net_am) as net_am,sum(tamm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls_ret where  blno='$invno' group by sgst_rt,igst_rt")or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($data))
	{
		$amm=$row['amm'];
		$net_am=$row['net_am'];
		$cgst_rt=$row['cgst_rt'];   
		$tcgst=$row['cgst_am'];   
		$sgst_rt=$row['sgst_rt'];   
		$tsgst=$row['sgst_am'];   
		$igst_rt=$row['igst_rt'];   
			
		$tiamm+=$net_am;
		$tttamm+=$amm;
		$ttcgst+=$tcgst;
		$ttsgst+=$tsgst; 
		$ttto+=$net_am;
	}

	$datas[0]=$gstin;
	$datas[1]=$nm;
	$datas[2]=$blno;
	$datas[3]=$dt;	
	$datas[4]='C';	
	$datas[5]=$statcd.'-'.$statnm;	
	$datas[6]="N";	
	$datas[7]="Regular";
	$datas[8]=$ttto;	
	$datas[9]="";	
	$datas[10]=$cgst_rt+$sgst_rt+$igst_rt;	
	$datas[11]=$tttamm;	
	$datas[12]="";	

		
	fputcsv($fp, $datas);	


}

exit;
?>

