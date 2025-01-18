<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
include "function.php";

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$brncd=$_REQUEST['brncd'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$prnm=$_REQUEST['prnm'];
$godown=$_REQUEST['godown'];
$vstat=$_REQUEST['vstat'];
$ptyp=$_REQUEST['ptyp'];
$val=$_REQUEST['val'] ?? "";

if($vstat==""){$vstat1="";}else{$vstat1=" and vstat='$vstat'";}
if($ptyp==""){$ptyp1="";}else{$ptyp1=" and app='$ptyp'";}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($catsl==""){$catsl1="";}else{$catsl1=" and cat='$catsl'";}
if($scatsl==""){$scatsl1="";}else{$scatsl1=" and scat='$scatsl'";}
if($prnm==""){$prnm1="";}else{$prnm1=" and prsl='$prnm'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}

if($val=='1')
{
$file="Purchase_Summary.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
$broder="border='1'";
}

?>
<table  class="advancedtable"  border="1" <?php if($val==1){?>width="70%"<?php }else{?>width="100%"<?php }?>>
<tr bgcolor="#e8ecf6">
<td  align="center" ><b>Sl</b></td>
<td  align="center" ><b>Date</b></td>
<td  align="center" ><b>Branch</b></td>
<td  align="center" ><b>Invoice</b></td>
<td  align="center" ><b>SUPPLIER</b></td>
<td  align="center" ><b>GSTIN</b></td>
<td  align="center" ><b>PAN</b></td>
<td  align="center" ><b>TAXABLE VALUE</b></td>
<td  align="center" ><b>TDS</b></td>
<td  align="center" ><b>BILL VALUE</b></td>
</tr>
<?php 
$sln=0;
$total=0;
$totalta=0;
$ttds=0;
$data1= mysqli_query($conn,"select * from main_purchase where sl>0".$todt.$snm1.$brncd1.$ptyp1.$vstat1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$inv=$row1['inv'];
$sid=$row1['sid'];
$lfr=$row1['lfr'];
$lcd=$row1['lcd'];
$vatamm=$row1['vatamm'];
$sdis=$row1['sdis'];
$roff=$row1['roff'];
$remk=$row1['remk'];
$adl=$row1['adl'];
$adlv=$row1['adlv'];
$amm=$row1['amm'];
$tmm2=$row1['tmm2'];
$addr_gst=$row1['addr'];
$bcd=$row1['bcd'];

$dt=date('d-m-Y', strtotime($dt));
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
$gstinn="";
$datad111= mysqli_query($conn,"select * from main_suppl_gst where sl='$addr_gst'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad111))
{
$gstinn=$rowd['gstin'];
$span=$rowd['pan'];
}
$tds=($amm*.001);
$total+=$tmm2;

$totalta+=$amm;
$ttds+=$tds;
	?>
	<tr>
	<td  align="center" ><?php  echo $sln?></td>
	<td  align="center" ><?php  echo $dt?></td>
	<td  align="left" ><?php echo get_branch_name($bcd);?></td>
	<td  align="left" ><?php  echo $inv?></td>
	<td  align="left" ><?php  echo $spn?></td>
	<td  align="left" ><?php  echo $gstinn?></td>
	<td  align="left" ><?php  echo $span?></td>
	<td  align="right" ><?php echo number_format($amm,2)?></td>
	<td  align="right" ><?php echo number_format($tds,2)?></td>
	<td  align="right" ><?php echo number_format($tmm2,2)?></td>
	</tr>	 
			 

<?php 
}
?>	<tr>
	
	<td  align="center" colspan="7" ><b>Total</b></td>
	<td  align="right" ><b><?php echo number_format($totalta,2)?></b></td>
	<td  align="right" ><b><?php echo number_format($ttds,2)?></b></td>
	<td  align="right" ><b><?php echo number_format($total,2)?></b></td>
	</tr>

	  </table>