<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$betno1="";
$opst1=0;
$stin1=0;
$stout1=0;
$brncd=$_REQUEST['brncd'];
$betno=rawurldecode($_REQUEST['betno']);
$blno=rawurldecode($_REQUEST['blno']);
$stat=$_REQUEST['stat'];
$cat=$_REQUEST['cat'];
$todts="";
if($_REQUEST['fdt']!='' and $_REQUEST['tdt']!='' and empty($betno) and empty($blno))
{
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and sdt between '$fdt' and '$tdt'";}else{$todts="";}
}

if($brncd=="")
{
	$bcd="";
}
else
{
	$bcd=" and main_billing.bcd='$brncd'";
}
$stat1="";
if($betno!=""){$betno1=" and main_billdtls.betno like '%$betno%'";}
if($blno!=""){$blno1=" and main_billdtls.blno like '%$blno%'";}
if($stat!=""){$stat1=" and main_billdtls.sync_stat='$stat'";}
date_default_timezone_set('Asia/Kolkata');
$file="Sync".date('Ymdis').".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>
<table border="1" >
			<tr >
			<td  align="center" >Distributor Code</td>
			<td  align="center" >Sales Order Number</td>
			<td  align="center" >Customer Code</td>
			<td  align="center" >Salesman Code</td>
			<td  align="center" >Order Date</td>
			<td  align="center">Item Name</td>
			<td  align="center">Item Code</td>
			<td  align="center">Qty</td>
			<td  align="center">Price</td>
			<td  align="center" >Total Amount</td>
			<td  align="center" >Total Discount</td>
			<td  align="center" >Total Tax</td>
			<td  align="center" >Net Amount</td>
			<td  align="center" >Serial Number</td>
			</tr>
<?php 
$cnt=0;
$data= mysqli_query($conn,"select main_billdtls.* from main_billdtls INNER JOIN main_billing ON main_billdtls.blno=main_billing.blno where main_billdtls.sl>0 and main_billdtls.cat='$cat' and main_billdtls.betno is not null and main_billdtls.betno!='' $bcd  $stat1 $todts $betno1 $blno1 order by main_billdtls.sdt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$tsl=$row['sl'];
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$afgst=$row['rate'];
$blno=$row['blno'];
$unit=$row['unit'];
$kg=$row['kg'];
$grm=$row['grm'];
$qty=$row['pcs'];
//$pcs="TEST".$qty;
$pcs=$qty;
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$total=$row['total'];
$dt=$row['dt'];
$sdt=$row['sdt'];
$cust=$row['cust'];
/*
$ttl=$row['ttl'];
*/
$net_am=$row['net_am'];
$disp=$row['disp'];
$disa=$row['disa'];
$betno=$row['betno'];
$sync_stat=$row['sync_stat'];
if($sync_stat==1){$sync_stat="Done";}
if($sync_stat==0){$sync_stat="Pending";}
$bcd="";
$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$bcd=$row1['bcd'];
}
$gtm="";
$result6 = mysqli_query($conn,"select * from  main_cust where sl='$cust'");
while($row=mysqli_fetch_array($result6))
{
$gtm=$row['gtm'];
}

if($bcd=='2')//MBO KGR
{
$gtm='B70000001';   
}
if($bcd=='3')//RANAGHAT
{
$gtm='HD00021057';   
}
if($bcd=='4')//SHOPPE
{
$gtm='DUR0986';   
}

if($bcd=='5')//BURDWAN
{
$gtm='HD00021096';   

}
if($bcd=='6')//BETHUA
{
$gtm='B70000011';  
}
if($bcd=='7')//KARIMPUR
{
$gtm='B70000002';   
}
if($bcd=='8')//BARASAT
{
$gtm='B70000012';   
}
if($bcd=='9')//BERHAMPORE
{
$gtm='B70000013';   
}
if($bcd=='10')//KANCHRAPARA
{
$gtm='B70000022';   
$stcode="HIND";
}
$pnm="";
$ean="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$ean=$row['ean'];
}
$betno_sync=$betno;
if($cat==2){
$betno_sync=lgBetnoModify($betno);
}


if($disp==0)
{
 if($disa1>0)  
{
$disp=round(($disa1*100)/$total,2);
}
}
$pgst=$cgst_am+$sgst_am+$igst_am;

$gst=$cgst_rt+$sgst_rt+$igst_rt;
$gst_rate=round($prc/($gst+100),4);
$rate=round($gst_rate*100,2);
$total=round($rate*$pcs,2);
$disa=round(($total*$disp)/100,2);
$ttl=round($total-$disa,2);
$net_am=$ttl+$pgst;

$cnt++;
?>
	<tr >
			<td  align="center" >6900102952</td>
			<td  align="center" ><?php echo $blno;?></td>
			<td  align="left" ><?php echo $gtm;?></td>
			<td  align="left" ></td>
			<td  align="center" ><?php echo !empty($sdt) && $sdt!="0000-00-00" ? date('d-m-Y',strtotime($sdt)):"";?></td>
			<td  align="left" ><?php echo $pnm;?></td>
			<td  align="left" ><?php echo $ean;?></td>
			<td  align="center" ><?php echo $qty;?></td>
			<td  align="center" ><?php echo $rate;?></td>
			<td  align="center" ><?php echo $total;?></td>
			<td  align="center" ><?php echo $disa;?></td>
			<td  align="center" ><?php echo $pgst;?></td>
			<td  align="center" ><?php echo $net_am;?></td>
			<td  align="center" ><?php echo $betno_sync;?></td>

			</tr>
<?php
if($cat==1){
$query21 = "UPDATE main_billdtls SET sync_stat=1 WHERE sl='$tsl'";
$result2 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
$sync= mysqli_query($conn,"insert into lg_sync(blno,prsl,betno,sync_betno,dt,edtm) values('$blno','$pcd','$betno','$betno_sync','$edt','$edtm')")or die(mysqli_error($conn));
}
}
?>
</table>
			