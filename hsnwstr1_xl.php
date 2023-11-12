<?

set_time_limit(0);

$reqlevel = 1;

include("membersonly.inc.php");

$typ=$_REQUEST[typ];
$mnth=$_REQUEST[mnth];

$yr=$_REQUEST[yr];

$fdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-01"));

$tdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-".date('t',strtotime($fdt))));
$file="GST HSN Report $yr $mnth.xls";
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); 
header("Content-Disposition: attachment; filename=$file"); 

?>

<table class="table table-bordered dataTables-example" border="1">

<thead>

<tr style="background-color:#1EB4FE;color:#ffffff;"> 

<th style="text-align:center;" width="4%"><b>HSN Code</b></th>

<th style="text-align:left;"><b>Percentage</b></th>

<th style="text-align:left;"><b>UQC</b></th>

<th style="text-align:left;"><b>Total Quantity</b></th>

<th style="text-align:left;"><b>Total Value</b></th>

<th style="text-align:left;"><b>Total Taxable Value</b></th>

<th style="text-align:left;"><b>Integrated Tax</b></th>

<th style="text-align:left;"><b>Central Tax</b></th>

<th style="text-align:left;"><b>State/UT Tax</b></th>

<th style="text-align:left;"><b>Cess</b></th>

</tr>

<?




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
$query9 = "SELECT blno FROM main_billing where dt between '$fdt' and '$tdt'";
}
if($typ==2)
{
$query9 = "SELECT blno FROM main_purchase where dt between '$fdt' and '$tdt'";
}


//echo $query9;

$result9 = mysqli_query($conn,$query9);

while($X=mysqli_fetch_array($result9))

{

$blno=$X[blno];	

//echo $blno;

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
$res=mysqli_query($conn,"select * from main_scat where hsn!='' group by hsn");
while($R=mysqli_fetch_array($res))
{
	$eqr=" and ( prsl='a'";
	

$hsn=$R[hsn];
$qr="(scat='0'";
$res0=mysqli_query($conn,"select * from main_scat where hsn='$hsn'") or die(mysqli_error($conn));
while($R0=mysqli_fetch_array($res0))
{
$sl1=$R0['sl'];
$cat=$R0['cnm'];
$qr.=" or scat='$sl1'";
}
$qr.=")";
//$sl."select * from main_product where $qr";
$res1=mysqli_query($conn,"select * from main_product where  $qr")or die(mysqli_error($conn));
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
?>	

<?

//echo "select sum(ttl) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(qty) as tpcs from main_billdtls where sl>0 $eqr $bqr";
$ttamm=0;
$tcgst_am=0;
$tsgst_am=0;
$tigst_am=0;
$tnet_am=0;
$tpcs=0;

if($typ==1)
{
$res1=mysqli_query($conn,"select sum(ttl) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(pcs) as tpcs from main_billdtls where sl>0 $eqr $bqr") or die (mysqli_error($conn));
}
if($typ==2)
{
$res1=mysqli_query($conn,"select sum(amm) as ttamm, sum(cgst_am) as tcgst_am, sum(sgst_am) as tsgst_am,sum(igst_am) as tigst_am, sum(net_am) as tnet_am,sum(qty) as tpcs from main_purchasedet where sl>0 $eqr $bqr") or die (mysqli_error($conn));
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



if($tnet_am>0)

{

	?>

<tr>

<td><?=$hsn;?></td>

<td align="center"><?echo $igst;?>% </td>

<td><?echo "PIECE-PCS";?></td>



<td><?=$tpcs;?></td>	

<td><?=round($tnet_am,2);?></td>

<td><?=round($ttamm,2);?></td>

<td><?=round($tigst_am,2);?></td>

<td><?=round($tcgst_am,2);?></td>

<td><?=round($tsgst_am,2);?></td>

<td>0.00</td>

	

</tr>	

	

	

<?	

}

$tttamm+=round($ttamm,2);

$ttcgst_am+=round($tcgst_am,2);

$ttsgst_am+=round($tsgst_am,2);

$ttigst_am+=round($tigst_am,2);

$ttnet_am+=round($tnet_am,2);

$ttpcs+=$tpcs;

}









?>

<tr>

<td colspan="3">TOTAL</td>

<td><?=$ttpcs;?></td>	

<td><?=round($ttnet_am,2);?></td>

<td><?=round($tttamm,2);?></td>

<td><?=round($ttigst_am,2);?></td>

<td><?=round($ttcgst_am,2);?></td>

<td><?=round($ttsgst_am,2);?></td>

<td>0.00</td>

	

</tr>	