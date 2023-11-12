<?
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$brncd=$_REQUEST['brncd'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$prnm=$_REQUEST['prnm'];
$godown=$_REQUEST['godown'];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($catsl==""){$catsl1="";}else{$catsl1=" and cat='$catsl'";}
if($scatsl==""){$scatsl1="";}else{$scatsl1=" and scat='$scatsl'";}
if($prnm==""){$prnm1="";}else{$prnm1=" and prsl='$prnm'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}
$file="Service Purchase Details (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>
<table  class="advancedtable" width="100%" border="1">
	<tr bgcolor="#e8ecf6">
	<td  align="center" ><b>Sl</b></td>
	<td  align="center" ><b>Date</b></td>
	<td  align="center" ><b>Invoice</b></td>
	<td  align="center" ><b>Company Name</b></td>
	<td  align="center" ><b>Model Name</b></td>
	<td  align="center" ><b>HSN</b></td>
	<td  align="center" ><b>Serial No.</b></td>
	<td  align="center" ><b>Quantity</b></td>
	<td  align="center" ><b>Unit</b></td>
	<td  align="center" ><b>Rate</b></td>
	<td  align="center" ><b>Total</b></td>				
	<td  align="center" ><b>Dis%</b></td>				
	<td  align="center" ><b>Dis.Am.</b></td>				
	<td  align="center" hidden><b>L.Dis.%</b></td>				
	<td  align="center" hidden><b>L.Dis.Am.</b></td>				
	<td  align="center" ><b>Taxable Am.</b></td>				
	<td  align="center" ><b>CGST%</b></td>
	<td  align="center" ><b>CGST </b></td>
	<td  align="center" ><b>SGST%</b></td>
	<td  align="center" ><b>SGST </b></td>
	<td  align="center" ><b>IGST%</b></td>
	<td  align="center" ><b>IGST </b></td>
	<td  align="center" ><b>Total-Amount</b></td>
	<td  align="center" ><b>Remark</b></td>
	<td  align="center" ><b>A/L Amount</b></td>
	<td  align="center" ><b>Net Amount</b></td>
	<td  align="center" ><b>Rate</b></td>
	
	</tr>
	<?
	$sln=0;
	$tota1=0;
	$fttl1=0;
	$wgamm1=0;
$log=0;
$ttcgst_am=0;
$ttsgst_am=0;
$ttigst_am=0;
$ttgst=0;
$amm1=0;
$Ttamm2=0;
$ADls=0;
	$dis11=0;
	$ldisa11=0;
if($user_current_level<0)
{
$data1= mysqli_query($conn,"select * from main_ser_purchase where sl>0".$todt.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
}
else
{
$data1= mysqli_query($conn,"select * from main_ser_purchase where sl>0 ".$todt.$snm1.$brncd1." order by dt,sl")or die(mysqli_error($conn));
}
while ($row1 = mysqli_fetch_array($data1))
{
$asd=0;
$log=1;
$tota=0;
$wgamm=0;
$pptotal=0;
$prctotal=0;
$ppt1=0;
$amm1=0;
$dis1=0;
$ldisa1=0;
$blno=$row1['blno'];
$edt=$row1['dt'];
$pbill=$row1['inv'];
$sid=$row1['sid'];
$lfr=$row1['lfr'];
$lcd=$row1['lcd'];
$vatamm=$row1['vatamm'];
$sdis=$row1['sdis'];
$tamm=$row1['tamm'];
$roff=$row1['roff'];
$remk=$row1['remk'];
$adl=$row1['adl'];
$adlv=$row1['adlv'];
$tamm2=$row1['tamm'];

$edt=date('d-m-Y', strtotime($edt));
$sln++;
$spn="";
$nm="";
$mob1="";
$addr="";
$datad= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['spn'];
$nm=$rowd['nm'];
$addr=$rowd['addr'];
$mob1=$rowd['mob1'];
}
$al_ledg="";
$datad1= mysqli_query($conn,"select * from main_ledg where sl='$remk'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$al_ledg=$rowd1['nm'];
}
$tcgst_am=0;
$tsgst_am=0;
$tigst_am=0;
$tgst=0;
$data= mysqli_query($conn,"select * from  main_ser_purchasedet where sl>0 and blno='$blno' $prnm1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$qty=$row['qty'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$total=$row['total'];
$mrp=$row['mrp'];
$blno1=$row['blno'];
$pck=$row['pck'];
$unit=$row['unit'];
$amm=$row['amm'];

$disp=$row['disp'];
$dis=$row['disa'];
$ldis=$row['ldis'];
$ldisa=$row['ldisa'];


$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$net_am=$row['net_am'];
$betno=$row['betno'];
$rate=$row['rate'];

if($net_am<=0)
{
$net_am=$ttl;	
}

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$unit_nm=$sun;}
if($unit=='mun'){$unit_nm=$mun;}
if($unit=='bun'){$unit_nm=$bun;}

$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
}
$scat_nm="";				
$data12= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$scat_nm=$row1['nm'];
$hsn=$row1['hsn'];
}

if($blno1==$blno)	
{
	$asd++;
}	
	?>
	<tr>
	<?
	if($log==1)
	{
	?>
	<td  align="center" ><?=$sln;?></td>
	<td  align="center" ><?=$edt;?></td>
	<td  align="center" ><?=$pbill;?></td>
	<td  align="left" ><font color="red"><b><?=$spn;?></b></font></td>
	<?
	}
	else
	{
	?>
	<td  align="center" ></td>
	<td  align="center" ><?=$edt;?></td>
	<td  align="center" ><?=$pbill;?></td>
	<td  align="left" ><font color="red"><b><?=$spn;?></b></font></td>
	<?				
	}
	?>
	
	<td  align="left" ><b><?=$pnm;?></b> </td>
	<td  align="center" ><?=$hsn;?></td>
	<td  align="center" ><?=$betno;?></td>
	<td  align="center" ><?=$qty;?></td>
	<td  align="left" ><?=$unit_nm;?></td>
	<td  align="right" ><?=round($mrp,2);?></td>
	<td  align="right" ><?=round($total,2);?></td>

	<td  align="center" ><?=$disp?></td>				
	<td  align="right" ><?=round($dis,2);?></td>
	<td  align="center" hidden><?=$ldis?></td>				
	<td  align="center"hidden ><?=$ldisa?></td>				

	<td  align="center" ><?=$amm;?></td>
	<td  align="center" ><?=$cgst_rt;?></td>
	<td  align="center" ><?=round($cgst_am,2);?></td>
	<td  align="center" ><?=$sgst_rt;?></td>
	<td  align="center" ><?=round($sgst_am,2);?></td>
	<td  align="center" ><?=$igst_rt;?></td>
	<td  align="center" ><?=$igst_am;?></td>
	<td  align="right" ><?=round($net_am,2);?></td>
	<td  align="right" ></td>
	<td  align="right" ></td>
	<td  align="right" ></td>
	<td  align="right" ><?=round($rate,2);?></td>
	</tr>	 
			 
<?
$tota=$total+$tota;
$wgamm=$net_am+$wgamm;
$fttl=$wgamm;
$tcgst_am+=$cgst_am;
$tsgst_am+=$sgst_am;
$tigst_am+=$igst_am;
$tgst+=$cgst_am+$sgst_am+$igst_am;
$dis1=$dis+$dis1;
$ldisa1=$ldisa+$ldisa1;
$amm1=$amm+$amm1;
$log=0;
}
if($tota>0)
{
$tota1=$tota1+$tota;
$fttl1=$fttl1+$fttl;
$wgamm1=$wgamm1+$wgamm;
$ttcgst_am+=$tcgst_am;
$ttsgst_am+=$tsgst_am;
$ttigst_am+=$tigst_am;
$ttgst+=$tcgst_am+$tsgst_am+$tigst_am;	
$dis11=$dis11+$dis1;
$dis111=$dis111+$ldisa1;
	$amm2=$amm1+$amm2;
	$wgamm=$wgamm+$roff;
	if($tamm2>0)
	{
		
	}
	else
	{
		$tamm2=$wgamm;
	}
	
	if($adl=="+")
	{
		$with_adl_tamm2=$tamm2+$adlv;
	}
	if($adl=="-")
	{
		$with_adl_tamm2=$tamm2-$adlv;
	}
	if($adl=="")
	{
		$with_adl_tamm2=$tamm2;
	}
	
/*
?>
	<tr bgcolor="#e8ecf6">
	<td colspan="7" align="right"><b>Total :</b></td>
	<td  align="center" ></td>
	<td  align="center" ></td>
	<td  align="center" ></td>
	<td  align="right" ><font color="blue"><b><?=number_format($tota,2);?></b></font></td>
	<td  align="center" ></td>				
	<td  align="right" ><font color="blue"><b><?=$dis1;?></b></font></td>
	<td  align="center" hidden></td>				
	<td  align="center" hidden><b><?=$ldisa1?></b></td>				
	<td  align="right" ><font color="blue"><b><?=$amm1;?></b></font></td>
	<td  align="center" ></td>
	<td  align="right" ><font color="blue"><b><?=$tcgst_am?></b></font></td>
	<td  align="center" ></td>
	<td  align="right" ><font color="blue"><b><?=$tsgst_am?></b></font></td>
	<td  align="center" ></td>
	<td  align="right" ><font color="blue"><b><?=$tigst_am?></b></font></td>
	<td  align="right" ><span style="float:left;color:red" ><?=$roff;?></span><font color="blue"><b><?=number_format($wgamm,2);?></b></font></td>
	<td  align="left" ><?=$al_ledg?></td>
	<td  align="right" ><?=$adl.$adlv;?></td>
	<td  align="right" ><b><?=$with_adl_tamm2;?></b></td>
	<td  align="right" ><b></b></td>
	</tr>
<?
*/
$Ttamm2+=$with_adl_tamm2;
$ADls+=$adl.$adlv;

}
}?>
<tr>
<td colspan="7" align="right"><b>Grand Total :</b></td>

<td align="right"></td>
<td align="right"></td>
<td align="right"></td>
<td align="right"><font color="red"><b><?=number_format($tota1,2);?></b></font></td>

	<td  align="right" ><font color="red"><b></b></font></td>
	<td  align="right" ><font color="red"><b><?=$dis11;?></b></font></td>
	<td  align="right" hidden><font color="red"><b></b></font></td>
	<td  align="right" hidden ><font color="red"><b><?=$dis111;?></b></font></td>
	
		<td  align="right" ><font color="red"><b><?=$amm2;?></b></font></font></td>
		<td  align="center" ></td>
		<td  align="right" ><font color="red"><b><?=$ttcgst_am?></b></font></td>
		<td  align="center" ></td>
		<td  align="right" ><font color="red"><b><?=$ttsgst_am?></b></font></td>
		<td  align="center" ></td>
		<td  align="right" ><font color="red"><b><?=$ttigst_am?></b></font></td>
<td align="right"><font color="red"><b><?=number_format($wgamm1,2);?></b></font></td>
<td  align="right" ></td>
<td  align="right" ><font color="red"><b><?=number_format($ADls,2);?></b></font></td>
<td  align="right" ><font color="red"><b><?=number_format($Ttamm2,2);?></b></font></td>
<td  align="right" ><font color="red"><b></b></font></td>
</tr>
	  </table>