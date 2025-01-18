<?php 
$reqlevel = 0;
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$ndoc=rawurldecode($_REQUEST['ndoc']);
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

$filename = "GSTR-1_DOCS_Report $fdt to $tdt.csv";
$fp = fopen('php://output', 'w');



$header = array("Nature of Document", "Sr. No. From", "Sr. No. To", "Total Number", "Cancelled");	

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
fputcsv($fp, $datas);
}
fputs($fp, implode(',',$header)."\n");

$num_column = count($header);

$sln=0;
$get= mysqli_query($conn,"select * from main_billtype where inv_typ='0' or inv_typ='2' or inv_typ='1' order by sl")or die(mysqli_error($conn));
while ($PP=mysqli_fetch_array($get))
{
	
	$bill_typ_sl=$PP['sl'];

$fblno="";
$data1= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no limit 0,1")or die(mysqli_error($conn));
$fcount=mysqli_num_rows($data1);
while ($row1=mysqli_fetch_array($data1))
{
 $fblno=$row1['blno'];
}
$toblno="";
$data2= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no desc limit 0,1")or die(mysqli_error($conn));
$lcount=mysqli_num_rows($data2);
while ($row2=mysqli_fetch_array($data2))
{
 $toblno=$row2['blno'];
}

$SM= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt'")or die(mysqli_error($conn));
$TOT=mysqli_num_rows($SM);


$SK= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' and cstat='1'")or die(mysqli_error($conn));
$Cancel=mysqli_num_rows($SK);

/*Service bill*/

$fblno_sr="";
$data1_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no limit 0,1")or die(mysqli_error($conn));
$fcount_sr=mysqli_num_rows($data1_sr);
while ($row1_sr=mysqli_fetch_array($data1_sr))
{
 $fblno_sr=$row1_sr['blno'];
}
$toblno_sr="";
$data2_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no desc limit 0,1")or die(mysqli_error($conn));
$lcount_sr=mysqli_num_rows($data2_sr);
while ($row2_sr=mysqli_fetch_array($data2_sr))
{
 $toblno_sr=$row2_sr['blno'];
}

$SM_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt'")or die(mysqli_error($conn));
$TOT_sr=mysqli_num_rows($SM_sr);


$SK_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' and cstat='1'")or die(mysqli_error($conn));
$Cancel_sr=mysqli_num_rows($SK_sr);

/*Credit Note*/

$fblno_sr_cr="";
$data1_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no limit 0,1")or die(mysqli_error($conn));
$fcount_sr_cr=mysqli_num_rows($data1_sr_cr);
while ($row1_sr_cr=mysqli_fetch_array($data1_sr_cr))
{
 $fblno_sr_cr=$row1_sr_cr['blno'];
}
$toblno_sr_cr="";
$data2_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no desc limit 0,1")or die(mysqli_error($conn));
$lcount_sr_cr=mysqli_num_rows($data2_sr_cr);
while ($row2_sr_cr=mysqli_fetch_array($data2_sr_cr))
{
 $toblno_sr_cr=$row2_sr_cr['blno'];
}

$SM_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt'")or die(mysqli_error($conn));
$TOT_sr_cr=mysqli_num_rows($SM_sr_cr);


$SK_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' and cstat='1'")or die(mysqli_error($conn));
$Cancel_sr_cr=mysqli_num_rows($SK_sr_cr);

if($fblno!="")
{
$sln++;
$datas[0]='Invoices for outward supply';
$datas[1]=$fblno;
$datas[2]=$toblno;
$datas[3]=$TOT;
$datas[4]=$Cancel;

fputcsv($fp, $datas);

}
if($fblno_sr!="")
{
	$sln++;
		
$datas[0]='Invoices for outward supply';
$datas[1]=$fblno_sr;
$datas[2]=$toblno_sr;
$datas[3]=$TOT_sr;
$datas[4]=$Cancel_sr;

fputcsv($fp, $datas);

}
if($fblno_sr_cr!="")
{
	$sln++;
	$datas[0]='Credit Note';
$datas[1]=$fblno_sr_cr;
$datas[2]=$toblno_sr_cr;
$datas[3]=$TOT_sr_cr;
$datas[4]=$Cancel_sr_cr;

fputcsv($fp, $datas);


}
}

exit;
?>

