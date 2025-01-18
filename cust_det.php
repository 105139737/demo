<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$sid=$_REQUEST['sl'];
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}

 $data4= mysqli_query($conn,"select * from  main_suppl where sid='$sid' and (tp='Debtors' or tp='Both')")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data4))
{

$spn=$row['spn'];
}
if($spn=="")
{

}
?>

 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
            <td  align="right" width="50%" ><font size="3"><b>Shop Name :</b></font></td>
            <td  align="left">
			
<font size="3"><b><?php echo $spn;?></b></font>
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
			<b>Bill No.</b>
			</td>
           <td  align="center" >
			<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Quantity/Unit</b>
			</td>
			<td  align="center" >
			<b>Sale Rate</b>
			</td>
			     </tr>
			 <?php 
		$sln=0;
		$tota=0;
			

 $data1= mysqli_query($conn,"select * from main_billing where cid='$sid'".$brncd1)or die(mysqli_error($conn));
	 
			 
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$edt=$row1['edt'];
$vat=$row1['vat'];
$dis=$row1['dis'];
$car=$row1['car'];
$sln++;

$data= mysqli_query($conn,"select * from  main_billdtls where blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];


          $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd' group by sl";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$tech=$R['tech'];
$co=$R['co'];
$pname=$R['pname'];
$c=$R['pkgunt'];
}


$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
 $query4="Select sum(qty) as pty1 from ".$DBprefix."billdtls where prsl='$pcd' and blno='$blno' group by prsl";
  $result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$pty1=$R4['pty1'];
}
if($pty1!=0 and $ptu!=0)
{
$stkf=$pty1/$ptu;
$prc1=$prc/$ptu;
		 
}	

			 ?>
		   <tr>
		    <td  align="center" >
			<?php  echo $sln;?>
			</td>
			 <td  align="center" >
			<?php  echo $edt;?>
			</td>
            <td  align="center" >
			<?php  echo $blno;?>
			</td>
		
			<td  align="center" >
			<?php  echo $pname;?>
			</td>
			<td  align="center" >
			<?php  echo $stkf;?>/<?php  echo $punt;?>
			</td>
			<td  align="right" >
			<b><?php echo  number_format($ttl,2);?></b>
			</td>
            </tr>	 
			 
<?php 
$tota=$ttl+$tota;

}}?>
<tr>
<td colspan="5" align="right">
<b>Total</b>
</td>
<td align="right">
<b><?php echo number_format($tota,2);?></b>
</td>

	  </table>

