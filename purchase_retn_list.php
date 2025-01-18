<?php 
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pnm=rawurldecode($_REQUEST['pnm']);

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and ddt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}

if($pnm!="")
{
	$pnm1=" and prsl='$pnm'";
}
else
{
$pnm1="";	
}
?>
 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
		
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Date</b>
			</td>
			 <td  align="center" >
			<b>Invoice</b>
			</td>
          <td  align="center" >
			<b>Company Name</b>
			</td>
		
			<td  align="center" >
			<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Quantity/Unit</b>
			</td>
			<td  align="center" >
			<b>MRP Rs.</b>
			</td>
			<td  align="center" >
			<b>Purchase Rs.</b>
			</td>
			<td  align="center" >
			<b>Vat.(%)</b>
			</td>
			<td  align="center" >
			<b>Amount</b>
			</td>
		     </tr>
			 <?php 
		$sln=0;
		$tota=0;
$log=0;
		
$data1= mysqli_query($conn,"select * from main_purchase where sl>0 and rstat='1'".$todt.$snm1)or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$log=1;
$blno=$row1['blno'];
$edt=$row1['ddt'];
$vat=$row1['vat'];
$pbill=$row1['inv'];
$sid=$row1['sid'];
$lfr=$row1['lfr'];
$edt=date('d-m-Y', strtotime($edt));
$sln++;

$datad= mysqli_query($conn,"select * from main_suppl where sid='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{


$spn=$rowd['spn'];
$nm=$rowd['nm'];
$addr=$rowd['addr'];
$mob1=$rowd['mob1'];
}

$data= mysqli_query($conn,"select * from  main_purchasedet where sl>0 and blno='$blno' and qty<0".$pnm1)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$pcd=$row['prsl'];
$pprc=$row['pprc'];
$prc=$row['prc'];
/*$ppt=$row['ppt'];*/
$ttl=$row['ttl'];
$pty1=$row['qty'];

$ppt=$pprc*$pty1;
          $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd' group by sl";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$csl=$R['csl'];
$co=$R['co'];
$pname=$R['pname'];
$c=$R['pkgunt'];
}

$data4= mysqli_query($conn,"select * from main_catg where sl='$csl'")or die(mysqli_error($conn));
while ($row4 = mysqli_fetch_array($data4))
{
$tech=$row4['tnm'];
}





$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
 $query4="Select sum(qty) as pty1 from ".$DBprefix."purchasedet where prsl='$pcd' and blno='$blno'  group by prsl";
  $result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
//$pty1=$R4['pty1'];
}
$ppt1=0;
if($pty1!=0 and $ptu!=0)
{
$stkf=$pty1/$ptu;
$prc1=$prc/$ptu;
$vat1=($ttl*$vat)/100;
$ppt1=$ppt;			 
}			 
			 ?>
		   <tr>
		     
		    <td  align="center" title="<?php  echo $blno;?>" >
			<?php  echo $sln;?>
			</td>
			 <td  align="center" >
			<?php  echo $edt;?>
			</td>
			<td  align="center" >
			<?php  echo $pbill;?>
			</td>
            <td  align="center" >
			<?php  echo $spn;?>
			</td>
		
			<td  align="center" >
			<?php  echo $pname;?>
			</td>
			<td  align="center" >
			<b><?php  echo $pty1;?></b>/<?php  echo $punt;?>
			</td>
			<td  align="center" >
			<?php  echo $prc;?>
			</td>
			<td  align="center" >
			<?php  echo $pprc;?>
			</td>
			<td  align="center" >
			<?php  echo $vat;?>
			</td>
			<td  align="right" >
			<?php echo number_format($ppt1,2);?>
			</td>
		     </tr>	 
			 
<?php 
$tota=$ppt1+$tota;
$log=0;
$ppt1=0;

}}?>
<tr>
<td colspan="9" align="right">
<b>Total</b>
</td>
<td align="right">
<b><?php echo number_format($tota-$lfr,2);?></b>
</td>

	  </table>