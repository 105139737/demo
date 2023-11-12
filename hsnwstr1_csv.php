<?
$reqlevel = 0;
include("membersonly.inc.php");
$typ=$_REQUEST['typ'];
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($typ==1)
{
	$gval="Sale";
}
if($typ==2)
{
	$gval="Purchase";
}
$filename = "$gval GST_Report_HSN $yr-$mnth.csv";
$fp = fopen('php://output', 'w');


$header = array("HSN", "Description", "UQC", "Total Quantity", "Total Value", "Taxable Value", "Integrated Tax Amount", "Central Tax Amount", "State/UT Tax Amount", "Cess Amount");	
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
$header = str_replace('"', '', $header);

fputs($fp, implode($header, ',')."\n");

$num_column = count($header);


$tttamm=0;

$ttcgst_am=0;

$ttsgst_am=0;

$ttigst_am=0;

$ttnet_am=0;

$ttpcs=0;

$a=0;
$bqr="";


if($typ==1)
{
$query9 = "SELECT blno FROM main_billing where dt between '$fdt' and '$tdt' and cstat='0'";
}
//echo $query9;
$bqr=" and (blno='a'";
$result9 = mysqli_query($conn,$query9) or die (mysqli_error($conn) );
while($X=mysqli_fetch_array($result9))
{
$blno=$X[blno];	
//echo $blno;
if($bqr=="")
{
$bqr.=" or blno='$blno'";
}
else
{
$bqr.=" or blno='$blno'";
}
}
if($bqr!='')
{
$bqr.=")";
}
$bqr_ret="";
$bqr_ret=" and (blno='a'";
if($typ==1)
{
$query9_ret = "SELECT blno FROM main_billing_ret where dt between '$fdt' and '$tdt' and cstat='0'";
}
$result9_ret = mysqli_query($conn,$query9_ret) or die (mysqli_error($conn) );
while($X=mysqli_fetch_array($result9_ret))
{
$blno=$X[blno];	
if($bqr_ret=="")
{
$bqr_ret.=" or blno='$blno'";
}
else
{
$bqr_ret.=" or blno='$blno'";
}
}
if($bqr_ret!='')
{
$bqr_ret.=")";
}


$bqr1="";
$bqr1=" and (blno='a'";
if($typ==1)
{
$query91 = "SELECT blno FROM main_ser_billing where dt between '$fdt' and '$tdt' ";
}
$result91 = mysqli_query($conn,$query91) or die (mysqli_error($conn) );
while($X=mysqli_fetch_array($result91))
{
$blno=$X[blno];	
if($bqr1=="")
{
$bqr1.=" or blno='$blno'";
}
else
{
$bqr1.=" or blno='$blno'";
}
}
if($bqr1!='')
{
$bqr1.=")";
}



$eqr="";
$res=mysqli_query($conn,"select * from main_product where hsn!='' group by hsn");
while($R=mysqli_fetch_array($res))
{
	$eqr=" and ( prsl='a'";
$hsn=$R['hsn'];
$qr="(sl='0'";
$res0=mysqli_query($conn,"select * from main_product where hsn='$hsn'") or die(mysqli_error($conn));
while($R0=mysqli_fetch_array($res0))
{
$sl1=$R0['sl'];
$snm=$R0['pnm'];
$scat=$R0['scat'];
if($scat!='')
{
$res0s=mysqli_query($conn,"select * from main_scat where sl='$scat'") or die(mysqli_error($conn));
while($R0=mysqli_fetch_array($res0s))
{
$snm=$R0['nm'];
}	
}
$qr.=" or sl='$sl1'";

}
$qr.=")";
//$sl."select * from main_product where $qr";
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
//echo $eqr;
//echo "select sum(ttl) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(qty) as tpcs from main_billdtls where sl>0 $eqr $bqr";
$ttamm=0;
$tcgst_am=0;
$tsgst_am=0;
$tigst_am=0;
$tnet_am=0;
$tpcs=0;

if($typ==1)
{
$res1=mysqli_query($conn,"select sum(tamm) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(pcs) as tpcs from main_billdtls where sl>0 $eqr $bqr") or die (mysqli_error($conn));
}

while($R1=mysqli_fetch_array($res1))
{
$ttamm=$R1[ttamm];
$tcgst_am=$R1[tcgst_am];
$tsgst_am=$R1[tsgst_am];
$tigst_am=$R1[tigst_am];
$tnet_am=$R1[tnet_am];
$tpcs=$R1[tpcs];
}

$ttamm_ret=0;
$tcgst_am_ret=0;
$tsgst_am_ret=0;
$tigst_am_ret=0;
$tnet_am_ret=0;
$tpcs_ret=0;

if($typ==1)
{
$res1_ret=mysqli_query($conn,"select sum(tamm) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(pcs) as tpcs from main_billdtls_ret where sl>0 $eqr $bqr_ret") or die (mysqli_error($conn));
}
while($R1=mysqli_fetch_array($res1_ret))
{
$ttamm_ret=$R1[ttamm];
$tcgst_am_ret=$R1[tcgst_am];
$tsgst_am_ret=$R1[tsgst_am];
$tigst_am_ret=$R1[tigst_am];
$tnet_am_ret=$R1[tnet_am];
$tpcs_ret=$R1[tpcs];
}
$ttamm=$ttamm-$ttamm_ret;
$tcgst_am=$tcgst_am-$tcgst_am_ret;
$tsgst_am=$tsgst_am-$tsgst_am_ret;
$tigst_am=$tigst_am-$tigst_am_ret;
$tnet_am=$tnet_am-$tnet_am_ret;
$tpcs=$tpcs-$tpcs_ret;





if($tnet_am!=0)
{
$avv=str_replace('/', ' ', $snm);
$avv=str_replace('&', ' ', $avv);
$data1[0]=$hsn;
$data1[1]=substr($avv,0,30);
$data1[2]='PCS-PIECE';
$data1[3]=$tpcs;
$data1[4]=round($tnet_am,2);
$data1[5]=round($ttamm,2);
$data1[6]=round($tigst_am,2);
$data1[7]=round($tcgst_am,2);
$data1[8]=round($tsgst_am,2);
$data1[9]='0.00';
fputcsv($fp, $data1);
	}
$ttamm1=0;
$tcgst_am1=0;
$tsgst_am1=0;
$tigst_am1=0;
$tnet_am1=0;
$tpcs1=0;
if($typ==1)
{
$res11=mysqli_query($conn,"select sum(tamm) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(pcs) as tpcs from main_ser_billdtls where sl>0 $eqr $bqr1") or die (mysqli_error($conn));
}
while($R1=mysqli_fetch_array($res11))
{
$ttamm1=$R1[ttamm];
$tcgst_am1=$R1[tcgst_am];
$tsgst_am1=$R1[tsgst_am];
$tigst_am1=$R1[tigst_am];
$tnet_am1=$R1[tnet_am];
$tpcs1=$R1[tpcs];
}	
if($tnet_am1!=0)
{
$avv=str_replace('/', ' ', $snm);
$avv=str_replace('&', ' ', $avv);
$data2[0]=$hsn;
$data2[1]=substr($avv,0,30);
$data2[2]='PCS-PIECE';
$data2[3]=$tpcs1;
$data2[4]=round($tnet_am1,2);
$data2[5]=round($ttamm1,2);
$data2[6]=round($tigst_am1,2);
$data2[7]=round($tcgst_am1,2);
$data2[8]=round($tsgst_am1,2);
$data2[9]='0.00';
fputcsv($fp, $data2);
	}	
	
	}
//fputcsv($fp, $data1);
exit;
?>
