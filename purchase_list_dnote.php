<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['sup'];

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
?>
<table  class="advancedtable" width="100%" >
	<tr bgcolor="#000000">
	<td  align="center" colspan="3"><font color="#fff"><b>Date</b></font></td>
	<td  align="center" colspan="3"><font color="#fff"><b>Invoice</b></font></td>
	<td  align="center" colspan="4"><font color="#fff"><b>Company Name</b></font></td>
	<td  align="center" ><font color="#fff"><b>Taxable Amount</b></font></td>
	<td  align="center" hidden><font color="#fff"><b>GST(%)</b></font></td>
	<td  align="center" colspan="6"><font color="#fff"><b>Total GST Amount </b></font></td>
	<td  align="center" ><font color="#fff"><b>Net Amount </b></font></td>
	<td  align="center" ><font color="#fff"><b>ADD/LESS Value</b></font></td>
	<td  align="center" ><font color="#fff"><b>Pay Amount</b></font></td>
	</tr>
<?php 
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
$data1= mysqli_query($conn,"select * from main_purchase where sl>0 and sid='$snm'".$todt." order by dt,sl")or die(mysqli_error($conn));
}
else
{
$data1= mysqli_query($conn,"select * from main_purchase where sl>0 and sid='$snm'".$todt." order by dt,sl")or die(mysqli_error($conn));
}
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$pbill=$row1['inv'];
$sid=$row1['sid'];
$tmm2=$row1['tmm2'];
$roff=$row1['roff'];
$remk=$row1['remk'];
$adl=$row1['adl'];
$adlv=$row1['adlv'];
$sttl=$row1['sttl'];
/*$tot_tamm=$row1['amm'];*/
if($pbill==""){$pbill="NA";}
$edt=date('d-m-Y', strtotime($dt));
$sln++;


$datad= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['spn'];
$mob1=$rowd['mob1'];
}
$totgst=0;
$totgstam=0;
$QQ=mysqli_query($conn,"SELECT sum(cgst_rt+sgst_rt+igst_rt) as totgst,sum(cgst_am+sgst_am+igst_am) as totgstam FROM main_purchasedet where blno='$blno'");
$catsl1="";
$scatsl1="";
$prnm1="";
$godown1="";
$ssln="";
while ($SS = mysqli_fetch_array($QQ))
{
$totgst=$SS['totgst'];
$totgstam=$SS['totgstam'];
}
?>
<tr  style="cursor:pointer;" onclick="document.getElementById('inv').value='<?php  echo $pbill;?>';document.getElementById('invdt').value='<?php  echo $edt;?>';">
<td  align="center" colspan="3"><b><?php  echo $edt;?></b></td>
<td  align="center" colspan="3" title="<?php  echo $blno;?>"><span class="badge bg-green"><font size="3"><b><?php  echo $pbill;?></b></font></span></td>
<td  align="left" colspan="4"><b><?php  echo $spn;?> </b></td>
<td  align="center"><b><span id="tot_tamm"></span></b></td>
<td  align="center" hidden><b><?php  echo $totgst;?> %</b></td>
<td  align="right" colspan="6"><b><?php  echo $totgstam;?></b></td>
<td  align="right" ><b><?php  echo $sttl;?></b></td>
<td  align="right" ><b><font color="red" size="4"><?php  echo $adl;?></font>  <?php  echo $adlv;?></b></td>
<td  align="right" ><b><?php  echo $tmm2;?></b></td>
</tr>
	<tr bgcolor="#e8ecf6">
	<td  align="center" ><b>Sl</b></td>
	<td  align="center" ><b>Model Name</b></td>
	<td  align="center" ><b>HSN</b></td>
	<td  align="center" ><b>Serial No.</b></td>
	<td  align="center" ><b>Quantity</b></td>
	<td  align="center" ><b>Unit</b></td>
	<td  align="center" ><b>Rate</b></td>
	<td  align="center" ><b>Total</b></td>				
	<td  align="center" ><b>Dis%</b></td>				
	<td  align="center" ><b>Dis.Am.</b></td>				
	<td  align="center" ><b>Taxable Am.</b></td>				
	<td  align="center" ><b>CGST%</b></td>
	<td  align="center" ><b>CGST </b></td>
	<td  align="center" ><b>SGST%</b></td>
	<td  align="center" ><b>SGST </b></td>
	<td  align="center" ><b>IGST%</b></td>
	<td  align="center" ><b>IGST </b></td>
	<td  align="center" ><b>Total-Amount</b></td>
	<td  align="center" ><b>A/L Amount</b></td>
	<td  align="center" ><b>Net Amount</b></td>
	</tr>
<?php 
$tcgst_am=0;
$tsgst_am=0;
$tigst_am=0;
$tot_tamm=0;
$tgst=0;
$data= mysqli_query($conn,"select * from  main_purchasedet where sl>0 and blno='$blno' $catsl1 $scatsl1 $prnm1 $godown1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$ssln++;
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

if($net_am<=0)
{
$net_am=$ttl;	
}

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$cat'") or die(mysqli_error($conn));
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
$asd="";
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

	<td  align="left" ><b><?php  echo $ssln;?></b></td>
	<td  align="left" ><b><?php  echo $pnm;?></b></td>
	<td  align="center" ><?php  echo $hsn;?></td>
	<td  align="center" ><?php  echo $betno;?></td>
	<td  align="center" ><?php  echo $qty;?></td>
	<td  align="left" ><?php  echo $unit_nm;?></td>
	<td  align="right" ><?php echo round($mrp,2);?></td>
	<td  align="right" ><?php echo round($total,2);?></td>

	<td  align="center" ><?php  echo $disp?></td>				
	<td  align="right" ><?php echo round($dis,2);?></td>
	<td  align="center" ><?php  echo $amm;?></td>
	<td  align="center" ><?php  echo $cgst_rt;?></td>
	<td  align="center" ><?php echo round($cgst_am,2);?></td>
	<td  align="center" ><?php  echo $sgst_rt;?></td>
	<td  align="center" ><?php echo round($sgst_am,2);?></td>
	<td  align="center" ><?php  echo $igst_rt;?></td>
	<td  align="center" ><?php  echo $igst_am;?></td>
	<td  align="right" ><?php echo round($net_am,2);?></td>
	<td  align="right" ></td>
	<td  align="right" ></td>
	</tr>	 
			 
<?php 
$tot_tamm+=$amm;
}

}
?>
</table>
<script>
 $('#tot_tamm').html(<?php echo $tot_tamm;?>);
 </script>