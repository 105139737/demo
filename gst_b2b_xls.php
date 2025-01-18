<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
set_time_limit(0);

if($fdt!="" and $tdt!=""){$todt=" and rdt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

$file="GSTR-1 B2B Report Details (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>

 <table  border="1" >
		
		<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Receiver GSTIN/UIN</b></td>
			<td  align="center" ><b>Receiver Name</b></td>
			<td  align="center" ><b>Invoice No.</b></td>
			<td  align="center" ><b>Invoice Date</b></td>
			<td  align="center" ><b>POS</b></td>
			<td  align="center" ><b>Total Invoice Value</b></td>
			<td  align="center" ><b>Supply Type</b></td>
			

		</tr>
			 <?php 
		$sln=0;
		$tamm1=0;


$data1= mysqli_query($conn,"select * from  main_billing where sl>0 and gstin!=''".$todts.$snm1."order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$dt=$row1['dt'];
$gstin=$row1['gstin'];
$sid=$row1['cid'];
$amm=$row1['amm'];
$tst=$row1['tst'];
$dt=date('d-m-Y', strtotime($dt));
$sln++;

$query4="Select sum(net_am) as tamm from ".$DBprefix."billdtls where blno='$blno'";
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

 ?>
<tr>
<td  align="center"  ><?php  echo $sln;?></td>
<td  align="center" ><?php  echo $gstin;?></td>
<td  align="center" ><?php  echo $nm;?></td>
<td  align="center" ><?php  echo $blno;?></td>
<td  align="center" ><?php  echo $dt;?></td>
<td  align="center" ><?php  echo $statcd.'-'.$statnm;?></td>
<td  align="right" style="padding-right: 2%;" ><?php echo sprintf('%0.2f',$tamm);?></td>
<td  align="center" ></td>


</tr>
<?php }?>
	<tr bgcolor="#e8ecf6">
			<td  align="right" colspan="6" ><b>Total : </b></td>
			<td  align="right" style="padding-right: 2%;" ><b><?php echo sprintf('%0.2f',$tamm1);?></b></td>
			<td  align="center" ></td>


</tr>
</table>