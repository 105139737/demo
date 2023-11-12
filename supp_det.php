<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sid=$_REQUEST[sl];

date_default_timezone_set('Asia/Kolkata');
$datad= mysqli_query($conn,"select * from main_suppl where sid='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{

$sid=$rowd['sid'];
$spn=$rowd['spn'];
$nm=$rowd['nm'];
$addr=$rowd['addr'];
$mob1=$rowd['mob1'];
}

?>

 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
            <td  align="right" width="50%" ><font size="3"><b>Company :</b></font></td>
            <td  align="left">
			
<font size="3"><b><?echo $spn;?></b></font>
            </td>
          </tr>
	  </table>
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
			<b>Co</b>
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
			 <?
		$sln=0;
		$tota=0;
			 $data1= mysqli_query($conn,"select * from main_purchase where sid='$sid'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$ddt=$row1['ddt'];
$vat=$row1['vat'];
$inv=$row1['inv'];

$sln++;
$ddt=date('d-m-Y', strtotime($ddt));

$data= mysqli_query($conn,"select * from  main_purchasedet where blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$pcd=$row['prsl'];
$pprc=$row['pprc'];
$prc=$row['prc'];
$ppt=$row['ppt'];
$ttl=$row['ttl'];
$pty1=$row['qty'];


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

if($pty1!=0 and $ptu!=0)
{
$stkf=$pty1/$ptu;
$prc1=$prc/$ptu;
$vat1=($ttl*$vat)/100;
$ppt1=$ppt+$vat1;			 
}			 
			 ?>
		   <tr>
		    <td  align="center" >
			<?=$sln;?>
			</td>
			 <td  align="center" >
			<?=$ddt;?>
			</td>
			<td  align="center" >
			<?=$inv;?>
			</td>
            
			<td  align="center" >
			<?=$co;?>
			</td>
			<td  align="center" >
			<?=$pname;?>
			</td>
			<td  align="center" >
			<b><?=$pty1;?></b>/<?=$punt;?>
			</td>
			<td  align="center" >
			<?=$prc;?>
			</td>
			<td  align="center" >
			<?=$pprc;?>
			</td>
			<td  align="center" >
			<?=$vat;?>
			</td>
			<td  align="right" >
			<?=number_format($ppt1,2);?>
			</td>
		     </tr>	 
			 
<?
$tota=$ppt1+$tota;

}}?>
<tr>
<td colspan="9" align="right">
<b>Total</b>
</td>
<td align="right">
<b><?=number_format($tota,2);?></b>
</td>

	  </table>

