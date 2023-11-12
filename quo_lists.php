<?
$reqlevel = 3; 

include("membersonly.inc.php");
include("function.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pr_nm=$_REQUEST['prnm'];
$brncd=$_REQUEST['brncd'];
$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
$val=$_REQUEST['val'];

if($val==1)
{
$file="Quotation Details (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
}

if($scat==""){$scat1="";}else{$scat1=" and scat='$scat'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
if($pr_nm!=""){$pr_nm1=" and prsl='$pr_nm'";}else{$pr_nm1="";}

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

?>

<table  width="100%" class="advancedtable"  <?php if($val==1){?>border="1" <?php }?>>
<tr bgcolor="000">
<td colspan="23"><font size="5" color="#fff">Quotation Details</font></td>
</tr>		
	<tr bgcolor="#e8ecf6">
	<td  align="center"  valign="top"><b>Sl</b></td>
	<td  align="center" valign="top"><b>Date</b></td>
	<td  align="center"  valign="top"><b>Quotation No.</b></td>
	<td  align="center"  valign="top"><b>Customer Name</b></td>
	<td  align="center"  valign="top"><b>Address</b></td>
	<td  align="center"  valign="top"><b>Contact No.</b></td>
	<td  align="center"  valign="top"><b>GSTIN</b></td>
	<td  align="center"  valign="top"><b>Product Name</b></td>
	<td  align="center"  valign="top"><b>HSN</b></td>
	<td  align="center"  valign="top"><b>Quantity</b></td>
	<td  align="center"  valign="top"><b>S.Rate</b></td>
	<td  align="center"  valign="top"><b>Total</b></td>
	<td  align="center"  valign="top"><b>Disc.%</b></td>
	<td  align="center"  valign="top"><b>Disc.Am</b></td>
	<td  align="center"  valign="top"><b>Taxable Amt.</b></td>
	<td  align="center"  valign="top"><b>CGST%</b></td>
	<td  align="center"  valign="top"><b>CGST </b></td>
	<td  align="center"  valign="top"><b>SGST%</b></td>
	<td  align="center"  valign="top"><b>SGST </b></td>
	<td  align="center"  valign="top"><b>IGST%</b></td>
	<td  align="center"  valign="top"><b>IGST </b></td>
	<td  align="center"  valign="top"><b>Rate(After GST)</b></td>
	<td  align="center" ><b>Net Payable</b></td>
	</tr>
<?
$sln=0;
$total_am1=0;
$disa_am1=0;
$tamm1=0;
$cgst1=0;
$sgst1=0;
$igst1=0;
$wgamm1=0;
$data1= mysqli_query($conn,"select * from  main_quo where sl>0".$todts.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$edt1=$row1['edt'];
$nm=$row1['cust_nm'];
$cont=$row1['cont'];
$adrs=$row1['adrs'];
$dttm=$row1['dttm'];
$payam=$row1['payam'];
$gstin=$row1['gstin'];
$gstam=$row1['gstam'];
//$tamm=$row1['tamm'];
$amm=$row1['amm'];
$dt=date('d-m-Y', strtotime($dt));
$sln++;

$asd=0;
$total_am=0;
$disa_am=0;
$tamm=0;
$wgamm=0;
$igst=0;
$cgst=0;
$sgst=0;
$data= mysqli_query($conn,"select * from  main_quo_details where sl>0 and blno='$blno'".$scat1.$cat1.$pr_nm1)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$rate=$row['rate'];
$blno1=$row['blno'];
$pcs=$row['pcs'];
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$total=$row['total'];
//$net_am=round($row['net_am']);

/*
$ttl=$row['ttl'];
*/
$disp=$row['disp'];
$disa=$row['disa'];
if($disp==0)
{
if($disa>0)
{
    $disp=round(($disa*100)/$total,2);
}
}




$pgst=$cgst_am+$sgst_am+$igst_am;

$igst=$igst+$igst_am;
$cgst=$cgst+$cgst_am;
$sgst=$sgst+$sgst_am;
$gst_rate=round($prc/($gst+100),4);
$rate=round($gst_rate*100,2);
$gst=$cgst_rt+$sgst_rt+$igst_rt;

$totals=round($prc*$pcs,2);
$disa=round(($totals*$disp)/100,2);
$ttl=round($totals-$disa,2);


$net_am=round($ttl+$pgst,0);


$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
$hsn=$row1['hsn'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$hsn=$row['hsn'];
}


	if($blno==$blno1)
	{
		$asd++;
	}
		 ?>
		<tr title="<?=$pcd." Sl - ".$sl;?>">
		<?if($asd==1)
		{
		?>
		<td  align="center" valign="top" ><?=$sln;?><br/>
		<a href="quotation_edt.php?blno=<?=$blno;?>" target="_blank"><i class="fa fa-edit"></i>
		</td>
		<td  align="center"  valign="top" ><?=$dt;?></td>
		<td  align="center"  valign="top" ><a href="#" onclick="view('<?=$blno;?>')" title="Print"><?=$blno;?></a></td>
		<td  align="left"  valign="top" ><b><?=$nm;?></b></td>
		<td  align="left"  valign="top" ><?php echo $adrs;?></td>
		<td  align="center"  valign="top" ><?php echo $cont;?></td>
		<td  align="center"  valign="top" ><?=$gstin;?></td>
		<?
		}
		else
		{
		?>
		<td  align="center"  ></td>
		<td  align="center" ></td>
		<td  align="center" ></td>
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<?
		}
		?>

			<td  align="left" title="<?=$pcd;?>"  valign="top" ><?=$pnm;?></td>
			<td  align="center"  valign="top" ><?=$hsn;?></td>
			<td  align="center"  valign="top" ><?=$pcs;?></td>
			<td  align="right"  valign="top" ><?=number_format($prc,2);?></td>
			<td  align="right"  valign="top" ><?=number_format($total,2);?></td>
			<td  align="center" valign="top" ><?=$disp;?></td>
			<td  align="right"  valign="top" ><?=number_format($disa,2);?></td>
			<td  align="right"  valign="top" ><?=number_format($ttl,2);?></td>
			<td  align="center"  valign="top" ><?=$cgst_rt;?></td>
			<td  align="center"  valign="top" ><?=number_format($cgst_am,2);?></td>
			<td  align="center"  valign="top" ><?=$sgst_rt;?></td>
			<td  align="center"  valign="top" ><?=number_format($sgst_am,2);?></td>
			<td  align="center"  valign="top" ><?=$igst_rt;?></td>
			<td  align="center"  valign="top" ><?=number_format($igst_am,2);?></td>
			<td  align="center"  valign="top" ><?=number_format($rate,2);?></td>
			<td  align="right"  valign="top" ><?=number_format($net_am,2);?></td>
			</tr>	 

	<?


$tamm=$ttl+$tamm;
$wgamm=$net_am+$wgamm;
$total_am+=$total;
$disa_am+=$disa;
$tpcs+=$pcs;
}
	if($total_am>0)
	{
	
	?>
	<tr bgcolor="#e8ecf6">
	<td colspan="11" align="right" valign="top" ><b>Total </b></td>
	<td  align="right"  valign="top" ><b><?=number_format($total_am,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right"  valign="top" ><b><?=number_format($disa_am,2);?></b></td>
	<td  align="right"  valign="top" ><b><?=number_format($tamm,2);?></b></td>
	<td align="right"  valign="top" colspan="2"><b><?=number_format($cgst,2);?></b></td>
	<td align="right"  valign="top" colspan="2"><b><?=number_format($sgst,2);?></b></td>
	<td align="right" valign="top"  colspan="2"><b><?=number_format($igst,2);?></b></td>
	<td  align="right" valign="top"  ><b></b></td>
	<td  align="right" valign="top"  ><b><?=number_format($wgamm,2);?></b></td>
	
	</tr>
	<?
	}
	
		$total_am1=$total_am1+$total_am;
		$disa_am1=$disa_am+$disa_am1;
		$tamm1=$tamm+$tamm1;
		$car1=$car1+$car;
		$paid1=$paid1+$paid;
		$wgamm1=$wgamm1+$wgamm;
		
		$igst1=$igst+$igst1;
		$cgst1=$cgst+$cgst1;
		$sgst1=$sgst+$sgst1;
		$ttpcs=$ttpcs+$tpcs;
		}
		?>
<tr>
		<td colspan="11"  valign="top" align="right"><b>Total</b></td>

		<td align="right" valign="top" ><b><?=sprintf('%0.2f',$total_am1);?></b></td>
		<td></td>
		<td align="right" valign="top" ><b><?=sprintf('%0.2f',$disa_am1);?></b></td>
		<td align="right" valign="top" ><b><?=sprintf('%0.2f',$tamm1);?></b></td>
		<td align="right" valign="top"  colspan="2"><b><?=number_format($cgst1,2);?></b></td>
		<td align="right" valign="top" colspan="2"><b><?=number_format($sgst1,2);?></b></td>
		<td align="right" valign="top"  colspan="2"><b><?=number_format($igst1,2);?></b></td>
		<td  align="right" ><b></b></td>
		<td align="right" valign="top" ><b><?=number_format($wgamm1,2);?></b></td>
</tr>
</table>

