<?
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}


if($fdt!="" and $tdt!=""){$todt=" and rdt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

?>

 <table  width="100%" class="advancedtable"  >
		
		<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>GSTIN/UIN of Recipient</b></td>
			<td  align="center" ><b>Invoice/Advance Receipt Number</b></td>
			<td  align="center" ><b>Invoice/Advance Receipt date</b></td>
			<td  align="center" ><b>Note/Refund Voucher Number</b></td>
			<td  align="center" ><b>Note/Refund Voucher date</b></td>
			<td  align="center" ><b>Document Type</b></td>
			<td  align="center" ><b>Place Of Supply</b></td>
			<td  align="center" ><b>Note/Refund Voucher Value</b></td>
			<td  align="center" ><b>Applicable % of Tax Rate</b></td>
			<td  align="center" ><b>Rate</b></td>
			<td  align="center" ><b>Taxable Value</b></td>
			<td  align="center" ><b>Cess Amount</b></td>
			<td  align="center" ><b>Pre GST</b></td>
			
			


		</tr>
			 <?
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
 ?>
<tr>


<td  align="center"  ><?=$sln;?></td>
<td  align="center"  ><?=$gstin;?></td>
<td  align="left"  ><?=$refno;?></td>
<td  align="left"  ><?=$invdt;?></td>
<td  align="left"  ><?=$blno;?></td>
<td  align="center"  ><?=$dt;?></td>
<td  align="center"  >C</td>


<td  align="left"  ><?=$statcd.'-'.$statnm;?></td>
<td  align="left"  ><?=$ttto;?></td>
<td  align="center"  ></td>
<td  align="center"  ><?=$cgst_rt+$sgst_rt+$igst_rt;?></td>
<td  align="center"  ><?=$tttamm;?></td>
<td  align="center"  ></td>

<td  align="center"  >N</td>










</tr>
<?
}


?>
</table>
