<?php 
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

 <table  width="100%" class="advancedtable">
		
		<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>GSTIN/UIN of Recipient</b></td>
			<td  align="center" ><b>Receiver Name</b></td>
			<td  align="center" ><b>Invoice No.</b></td>
			<td  align="center" ><b>Invoice Date</b></td>
			<td  align="center" ><b>Invoice Value</b></td>
			<td  align="center" ><b>Place Of Supply</b></td>
			<td  align="center" ><b>Reverse Charge</b></td>
			<td  align="center" ><b>Invoice Type</b></td>
			<td  align="center" ><b>E-Commerce GSTIN</b></td>
			<td  align="center" ><b>Rate</b></td>
			<td  align="center" ><b>CGST Rate</b></td>
			<td  align="center" ><b>SGST Rate</b></td>
			<td  align="center" ><b>IGST Rate</b></td>
			<td  align="center" ><b>Applicable % of Tax Rate</b></td>
			<td  align="center" ><b>Taxable Value</b></td>
			<td  align="center" ><b>Cess Amount</b></td>
			


		</tr>
			 <?php 
		$sln=0;
		$tamm1=0;


$data1= mysqli_query($conn,"select * from  main_billing where sl>0 and gstin!='' and cstat='0'".$todts.$snm1."order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$invno=$row1['blno'];
$dt=$row1['dt'];
$gstin=$row1['gstin'];
$cid=$row1['cid'];
$tamm=$row1['amm'];
$tst=$row1['tst'];
$invto=$row1['invto'];
$dt=date('d-m-Y', strtotime($dt));
$sln++;

$query4="Select sum(net_am) as tamm from ".$DBprefix."billdtls where blno='$blno'";
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
	$tiamm=0;
	$tttamm=0;
	$ttcgst=0;
	$ttsgst=0;

	$data=mysqli_query($conn,"select *,sum(net_am) as net_am,sum(tamm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
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
		

 ?>
<tr>


<td  align="center"  ><?php  echo $sln;?></td>
<td  align="left"  ><?php  echo $gstin;?></td>
<td  align="left"  ><?php  echo $nm;?></td>
<td  align="left"  ><?php  echo $blno;?></td>
<td  align="center"  ><?php  echo $dt;?></td>
<td  align="center"  ><?php echo sprintf('%0.2f',$tamm);?></td>
<td  align="left"  ><?php  echo $statcd.'-'.$statnm;?></td>
<td  align="center"  ><?php echo 'N';?></td>
<td  align="center"  ><?php echo 'Regular';?></td>
<td  align="center"  ></td>
<td  align="center"  ><?php  echo $cgst_rt+$sgst_rt+$igst_rt;?></td>
<td  align="center"  ><?php  echo $cgst_rt;?></td>
<td  align="center"  ><?php  echo $sgst_rt;?></td>
<td  align="center"  ><?php  echo $igst_rt;?></td>
<td  align="center"  ></td>
<td  align="center"  ><?php echo round($amm,2);?></td>
<td  align="center"  ></td>








</tr>
<?php 
}
}




$tamm1=0;
$data11= mysqli_query($conn,"select * from  main_ser_billing where sl>0 and gstin!=''".$todts.$snm1."order by dt")or die(mysqli_error($conn));
while ($row11 = mysqli_fetch_array($data11))
{

$blno=$row11['blno'];
$invno=$row11['blno'];
$dt=$row11['dt'];
$gstin=$row11['gstin'];
$sid=$row11['cid'];
$tamm=$row11['amm'];
$tst=$row11['tst'];
$dt=date('d-m-Y', strtotime($dt));


$query4="Select sum(net_am) as tamm from ".$DBprefix."ser_billdtls where blno='$blno'";
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
	$igst_rt=0;   
	$sgst_am=0; 
	$log=0;
	$ttto=0;

	$data=mysqli_query($conn,"select *,sum(net_am) as net_am,sum(tamm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_ser_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($data))
	{
		$sln++;
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
		

 ?>
<tr>


<td  align="center"  ><?php  echo $sln;?></td>
<td  align="left"  ><?php  echo $gstin;?></td>
<td  align="left"  ><?php  echo $nm;?></td>
<td  align="left"  ><?php  echo $blno;?></td>
<td  align="center"  ><?php  echo $dt;?></td>
<td  align="center"  ><?php echo sprintf('%0.2f',$tamm);?></td>
<td  align="left"  ><?php  echo $statcd.'-'.$statnm;?></td>
<td  align="center"  ><?php echo 'N';?></td>
<td  align="center"  ><?php echo 'Regular';?></td>
<td  align="center"  ></td>
<td  align="center"  ><?php  echo $cgst_rt+$sgst_rt+$igst_rt;?></td>
<td  align="center"  ><?php  echo $cgst_rt;?></td>
<td  align="center"  ><?php  echo $sgst_rt;?></td>
<td  align="center"  ><?php  echo $igst_rt;?></td>
<td  align="center"  ></td>
<td  align="center"  ><?php echo round($amm,2);?></td>
<td  align="center"  ></td>
</tr>
<?php }}?>
</table>
