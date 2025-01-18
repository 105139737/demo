<?php 
$reqlevel = 0;
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

$filename = "GSTR_1_B2C(Small)_Report $fdt to $tdt.csv";
$fp = fopen('php://output', 'w');

$tiamm=0;
$tttamm=0;
$tigst=0;
$tcess=0;
$ttcgst=0;
$ttsgst=0;

$header = array("Type", "Place Of Supply", "Rate", "Taxable Value", "Cess Amount", "E-Commerce GSTIN");	

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
$header = str_replace('"', '', $header);

fputs($fp, implode(',',$header)."\n");

$num_column = count($header);



$inv_ret="and ( blno='a'";
$query9 = "SELECT * FROM main_billing_ret where gstin='' and (fst=tst or (amm<250000 and fst!=tst)) and  dt between '$fdt' and '$tdt' and cstat='0'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));
while ($R9 = mysqli_fetch_array ($result9))
{
$invno=$R9['blno'];
if($inv_ret=="( blno='a'")
{
$inv_ret="( or blno='$invno'";	
}
else
{
$inv_ret.=" or blno='$invno'"; 
}
}

$inv_ret.=")";
$invno="";


$tcgst=0;
$tsgst=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$log=0;
$inv="and ( blno='a'";
$query9 = "SELECT * FROM main_billing where gstin='' and (fst=tst or (amm<250000 and fst!=tst)) and  dt between '$fdt' and '$tdt' and cstat='0'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));
while ($R9 = mysqli_fetch_array ($result9))
{
$invno=$R9['blno'];
if($inv=="( blno='a'")
{
$inv="( or blno='$invno'";	
}
else 
{
$inv.=" or blno='$invno'";
}
}
$inv.=")";
$data= mysqli_query($conn,"select cgst_rt,sgst_rt,igst_rt,sum(tamm) as amm,tst from main_billdtls where sl>0 $inv group by cgst_rt,igst_rt,tst order by cgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=$row['amm'];
$cgst_rt=$row['cgst_rt'];   
$sgst_rt=$row['sgst_rt'];    
$igst_rt=$row['igst_rt'];
$tst=$row['tst'];
$gbit4=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi4=mysqli_fetch_array($gbit4))
{
$statnm=$GBi4['sn'];
$statcd=$GBi4['cd'];
}

$amm_ret=0;
$data_ret= mysqli_query($conn,"select cgst_rt,sgst_rt,igst_rt,sum(tamm) as amm,tst from main_billdtls_ret where sl>0 and cgst_rt='$cgst_rt' and sgst_rt='$sgst_rt' and igst_rt='$igst_rt' $inv_ret order by cgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data_ret))
{
$amm_ret+=$row['amm'];

}
		
$data1[0]='OE';
$data1[1]=$statcd.'-'.$statnm;
$data1[2]=$cgst_rt+$sgst_rt+$igst_rt;
$data1[3]=round($amm-$amm_ret,2);
$data1[4]='';
$data1[5]='';

fputcsv($fp, $data1);

}
	
	
exit;
?>
