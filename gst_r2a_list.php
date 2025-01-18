<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$tiamm=0;
$tttamm=0;
$ttcgst=0;
$ttsgst=0;
$ttigst=0;
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}


if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

?>

 <table  width="100%" class="advancedtable">
		
		<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>GSTIN/UIN of Recipient</b></td>
			<td  align="center" ><b>Supplyer Name</b></td>
			<td  align="center" ><b>Invoice No.</b></td>
			<td  align="center" ><b>Invoice Date</b></td>
			<td  align="center" ><b>Invoice Value</b></td>
			<td  align="center" ><b>Place Of Supply</b></td>
			<td  align="center" ><b>Reverse Charge</b></td>
			<td  align="center" ><b>Invoice Type</b></td>
			<td  align="center" ><b>E-Commerce GSTIN</b></td>
			<td  align="center" ><b>Rate(%)</b></td>
			<td  align="center" ><b>CGST Amount</b></td>
			<td  align="center" ><b>SGST Amount</b></td>
			<td  align="center" ><b>IGST Amount</b></td>
			<td  align="center" ><b>Applicable % of Tax Rate</b></td>
			<td  align="center" ><b>Taxable Value</b></td>
			<td  align="center" ><b>Cess Amount</b></td>
		</tr>
			 <?php 
		$sln=0;
		$tamm1=0;

$data1= mysqli_query($conn,"select * from  main_purchase where sl>0 ".$todts.$snm1." order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'] ?? 0;
$invno=$row1['blno'] ?? 0;
$dt=$row1['dt'] ?? 0;
$gstin=$row1['gstin'] ?? 0;
$sid=$row1['sid'] ?? "";
$tamm=$row1['amm'] ??0;
$tst=$row1['tst'] ?? "";
$invto=$row1['inv'] ?? "";
$addr=$row1['addr'] ?? "";
$dt=date('d-m-Y', strtotime($dt));
$sln++;

$query4="Select sum(net_am) as tamm from ".$DBprefix."purchasedet where blno='$blno'";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$tamm=$R4['tamm'];
}
//taging not found//
$nm="";
$query41="Select * from ".$DBprefix."suppl where sl='$sid'";
$result41 = mysqli_query($conn,$query41) or die(mysqli_error($conn));
  while ($R41 = mysqli_fetch_array ($result41))
{
$nm=$R41['spn'];
}
$gstin="";
$query42="Select * from ".$DBprefix."suppl_gst where sl='$addr'";
$result42 = mysqli_query($conn,$query42) or die(mysqli_error($conn));
  while ($R42 = mysqli_fetch_array ($result42))
{
$gstin=$R42['gstin'];
}

$tamm1=$tamm1+$tamm;


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
	$tigst=0;

	$data=mysqli_query($conn,"select *,sum(net_am) as net_am,sum(amm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from   main_purchasedet where  blno='$invno' group by sgst_rt,igst_rt")or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($data))
	{
		$amm=$row['amm'];
		$net_am=$row['net_am'];
		$cgst_rt=$row['cgst_rt'];   
		$tcgst=$row['cgst_am'];   
		$sgst_rt=$row['sgst_rt'];   
		$tsgst=$row['sgst_am'];   
		$igst_rt=$row['igst_rt'];   
		$tigst=$row['igst_am'];   
			
		$tiamm+=$net_am;
		$tttamm+=$amm;
		$ttcgst+=$tcgst;
		$ttsgst+=$tsgst; 
		$ttigst+=$tigst; 
		$ttto+=$net_am;
		

 ?>
<tr>


<td  align="center"  ><?php  echo $sln;?></td>
<td  align="left"  ><?php  echo $gstin;?></td>
<td  align="left"  ><?php  echo $nm;?></td>
<td  align="left"  ><?php  echo $invto;?></td>
<td  align="center"  ><?php  echo $dt;?></td>
<td  align="right"  ><?php echo sprintf('%0.2f',$tamm);?></td>
<td  align="left"  ><?php  echo $statcd.'-'.$statnm;?></td>
<td  align="center"  ><?php echo 'N';?></td>
<td  align="center"  ><?php echo 'Regular';?></td>
<td  align="center"  ></td>
<td  align="center"  ><?php  echo $cgst_rt+$sgst_rt+$igst_rt;?></td>
<td  align="right"  ><?php echo round($tcgst,2);?></td>
<td  align="right"  ><?php echo round($tsgst,2);?></td>
<td  align="right"  ><?php echo round($tigst,2);?></td>
<td  align="center"  ></td>
<td  align="right"  ><?php echo round($amm,2);?></td>
<td  align="center"  ></td>
</tr>
<?php 
}
}

//--part 2--//


$tamm1=0;
$tamm2=0;
//echo "select * from  main_ser_purchase where sl>0 ".$todts.$snm1." order by dt";
$data12= mysqli_query($conn,"select * from  main_ser_purchase where sl>0 ".$todts.$snm1." order by dt")or die(mysqli_error($conn));
while ($row12 = mysqli_fetch_array($data12))
{
$blno1=$row12['blno'];
$invno1=$row12['blno'];
$dt1=$row12['dt'];
$gstin=$row12['gstin'];
$sid1=$row12['sid'];
$tamm=$row12['amm'];
$tst1=$row12['tst'];
$invto1=$row12['inv'];
$addr1=$row12['addr'];
$dt1=date('d-m-Y', strtotime($dt1));
$sln1++;


$query41="Select sum(net_am) as tamm from main_ser_purchasedet where blno='$blno1'";
$result41 = mysqli_query($conn,$query41) or die (mysqli_error($conn));
  while ($R4 = mysqli_fetch_array ($result41))
{
$tamm2=$R4['tamm'];
}
//taging not found//
$nm1="";
$query412="Select * from ".$DBprefix."suppl where sl='$sid1'";
$result412 = mysqli_query($conn,$query412) or die(mysqli_error($conn));
  while ($R412 = mysqli_fetch_array ($result412))
{
$nm1=$R412['spn'];
}
$gstin1="";
$query421="Select * from ".$DBprefix."suppl_gst where sl='$addr1'";
$result421 = mysqli_query($conn,$query421) or die(mysqli_error($conn));
  while ($R421 = mysqli_fetch_array ($result421))
{
$gstin1=$R421['gstin'];
}

$tamm1=$tamm1+$tamm2;


$gbit1=mysqli_query($conn,"select * from main_state where sl='$tst1'") or die (mysqli_error($conn));
while($GBi1=mysqli_fetch_array($gbit1))
{
$statnm1=$GBi1['sn'];
$statcd1=$GBi1['cd'];
}


$amm=0;
	$net_am1=0;
	$cgst_rt1=0;   
	$cgst_am=0;   
	$sgst_rt1=0;   
	$igst_rt=0;   
	$sgst_am=0; 
	$log=0;
	$ttto=0;
	$tigst=0;

	$data=mysqli_query($conn,"select *,sum(net_am) as net_am,sum(amm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from   main_ser_purchasedet where  blno='$invno1' group by sgst_rt,igst_rt")or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($data))
	{
		$sln++;
		$amm1=$row['amm'];
		$net_am1=$row['net_am'];
		$cgst_rt1=$row['cgst_rt'];   
		$tcgst1=$row['cgst_am'];   
		$sgst_rt1=$row['sgst_rt'];   
		$tsgst1=$row['sgst_am'];   
		$igst_rt1=$row['igst_rt'];   
		$tigst1=$row['igst_am'];   
			
		$tiamm+=$net_am1;
		$tttamm+=$amm1;
		$ttcgst+=$tcgst1;
		$ttsgst+=$tsgst1; 
		$ttigst+=$tigst1; 
		$ttto+=$net_am;
		

 ?>
<tr>


<td  align="center"  ><?php  echo $sln;?></td>
<td  align="left"  ><?php  echo $gstin1;?></td>
<td  align="left"  ><?php  echo $nm1;?></td>
<td  align="left"  ><?php  echo $invto1;?></td>
<td  align="center"  ><?php  echo $dt1;?></td>
<td  align="right"  ><?php echo sprintf('%0.2f',$tamm2);?></td>
<td  align="left"  ><?php  echo $statcd1.'-'.$statnm1;?></td>
<td  align="center"  ><?php echo 'N';?></td>
<td  align="center"  ><?php echo 'Regular';?></td>
<td  align="center"  ></td>
<td  align="center"  ><?php  echo $cgst_rt1+$sgst_rt1+$igst_rt1;?></td>
<td  align="right"  ><?php echo round($tcgst1,2);?></td>
<td  align="right"  ><?php echo round($tsgst1,2);?></td>
<td  align="right"  ><?php echo round($tigst1,2);?></td>
<td  align="center"  ></td>
<td  align="right"  ><?php echo round($amm1,2);?></td>
<td  align="center"  ></td>
</tr>
<?php 
}
}
?>
</table>
