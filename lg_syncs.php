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
?>
<table  width="100%" class="advancedtable"  >
<tr bgcolor="000">
<td colspan="26"><font size="5" color="#fff">Product Details</font></td>
            </tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Customer Code</b></td>
			<td  align="center"><b>Item Code</b></td>
			<td  align="center" ><b>Bill No.</b></td>
			<td  align="center" ><b>Billing Date</b></td>
			<td  align="center" ><b>Serial Date</b></td>
			<td  align="center" ><b>Product Name</b></td>
			<td  align="center"><b>Serial No</b></td>
			<td  align="center"><b>Sync Serial No</b></td>
			<td  align="center"><b>Qty</b></td>
			<td  align="center" ><b>Sync Status</b></td>
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
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$ean=$row['ean'];
}
if($cat==2){
$betno_sync=lgBetnoModify($betno);
}
$cnt++;
?>
	<tr bgcolor="">
			<td  align="center" ><b><?php echo $cnt;?></b></td>
			<td  align="left" ><b><?php echo $gtm;?></b></td>
			<td  align="left" ><b><?php echo $ean;?></b></td>
			<td  align="center" ><a href="billing_edit.php?blno=<?php echo $blno;?>" target="_blank"><b><?php echo $blno;?></b></a></td>
			<td  align="center" ><b><?php echo date('d-m-Y',strtotime($dt));?></b></td>
			<td  align="center" ><b><?php echo !empty($sdt) && $sdt!="0000-00-00" ? date('d-m-Y',strtotime($sdt)):"";?></b></td>
			<td  align="left" ><b><?php echo $pnm;?></b></td>
			<td  align="left"><b><?php echo $betno;?></b></td>
			<td  align="left"><b><?php echo $betno_sync;?></b></td>
			<td  align="center" ><b><?php echo $qty;?></b></td>
			<td  align="center" ><b><?php echo $sync_stat;?></b></td>

			</tr>
<?php 
}
?>
</table>
			