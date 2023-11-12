<?
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$brncd=$_REQUEST[brncd];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}
?>
 <table  class="advancedtable" width="100%" >
		
		<tr bgcolor="#e8ecf6">

			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Date</b></td>
			<td  align="center" ><b>Invoice</b></td>
			<td  align="center" ><b>Company Name</b></td>
			<td  align="center" ><b>GSTIN</b></td>
			<td  align="center" ><b>Basic Am.</b></td>
			<td  align="center" ><b>Discount Am.</b></td>
			<td  align="center" ><b>Taxable Am.</b></td>
			<td  align="center" ><b>CGST Am.</b></td>
			<td  align="center" ><b>SGST Am.</b></td>
			<td  align="center" ><b>IGST Am.</b></td>
			<td  align="center" ><b>Net Amount</b></td>
			</tr>
			 <?
$sln=0;
$TBasic=0;
$TDiscount=0;
$TTaxable=0;
$Tcgst=0;
$Tsgst=0;
$Tigst=0;
$Tnet_am=0;
if($user_current_level<0)
{
$data1= mysqli_query($conn,"select * from main_purchase where sl>0".$todt.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
}
else
{
$data1= mysqli_query($conn,"select * from main_purchase where sl>0 ".$todt.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
}
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$edt=$row1['dt'];
$pbill=$row1['inv'];
$sid=$row1['sid'];
$lfr=$row1['lfr'];
$lcd=$row1['lcd'];
$vatamm=$row1['vatamm'];
$sdis=$row1['sdis'];
$tamm=$row1['tamm'];
$paddr=$row1['addr'];
$edt=date('d-m-Y', strtotime($edt));
$sln++;
$sgstin="";
$datadrt= mysqli_query($conn,"select * from main_suppl_gst where sl='$paddr'")or die(mysqli_error($conn));
while ($rowdrt = mysqli_fetch_array($datadrt))
{

$sgstin=$rowdrt['gstin'];
$suaddr=$rowdrt['addr'];
}

$datad= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['spn'];
}
$Basic=0;
$Discount=0;
$Taxable=0;
$cgst=0;
$sgst=0;
$igst=0;
$net_am=0;
$query1 = "SELECT sum(ttl) as Basic,sum(dis) as Discount,sum(amm) as Taxable,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst,sum(net_am) as net_am FROM main_purchasedet where blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$Basic=$R1['Basic'];
$Discount=$R1['Discount'];
$Taxable=$R1['Taxable'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
$net_am=$R1['net_am'];
}
$TBasic+=$Basic;
$TDiscount+=$Discount;
$TTaxable+=$Taxable;
$Tcgst+=$cgst;
$Tsgst+=$sgst;
$Tigst+=$igst;
$Tnet_am+=$net_am;
			 ?>
		   <tr>
		<td  align="center" ><?=$sln;?></td>
		<td  align="center" ><?=$edt;?></td>
		<td  align="left" ><?=$pbill;?></td>
		<td  align="left" ><?=$spn;?></td>
		<td  align="left" ><?=$sgstin;?></td>
		<td  align="right" ><b><?=$Basic;?></b></td>
		<td  align="right" ><b><?=round($Discount,3);?></b></td>
		<td  align="right" ><b><?=round($Taxable,3);?></b></td>
		<td  align="right" ><b><?=round($cgst,3);?></b></td>
		<td  align="right" ><b><?=round($sgst,3);?></b></td>
		<td  align="right" ><b><?=round($igst,3);?></b></td>
		<td  align="right" ><b><?=round($net_am,3);?></b></td>		
	    </tr>	 
<?
}
?>
   <tr bgcolor="#e8ecf6">
		<td  align="right" colspan="5" ><b> Total</b></td>
	
		<td  align="right" ><b><?=$TBasic;?></b></td>
		<td  align="right" ><b><?=$TDiscount;?></b></td>
		<td  align="right" ><b><?=$TTaxable;?></b></td>
		<td  align="right" ><b><?=$Tcgst;?></b></td>
		<td  align="right" ><b><?=$Tsgst;?></b></td>
		<td  align="right" ><b><?=$Tigst;?></b></td>
		<td  align="right" ><b><?=$Tnet_am;?></b></td>		
	    </tr>
</table>