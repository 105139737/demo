<?php 
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pnm=rawurldecode($_REQUEST['pnm']);
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and edt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}

if($pnm!="")
{
	$pnm1=" and prsl='$pnm'";
}
else
{
$pnm1="";	
}
$dis1=0;
?>
 <table  width="100%" class="advancedtable"  >
		
		     <tr bgcolor="#e8ecf6">
			  <td  align="center" >
			<b>Sl</b>
			</td>
			  <td  align="center" >
			<b>Action</b>
			</td>			
			 <td  align="center" >
			<b>Date</b>
			</td>
			 <td  align="center" >
		<b>Invoice</b>
			</td>
          <td  align="center" >
			<b>Customer Name</b>
			</td>
			
			<td  align="center" >
			<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Point</b>
			</td>
			<td  align="center" >
			<b>Quantity</b>
			</td>
			<td  align="center" >
			<b>Sale Rate</b>
			</td>
			<td  align="center" >
			<b>P.Discount</b>
			</td>
			<td  align="center" >
			<b>Rate</b>
			</td>
			<td  align="center" >
			<b>Amount</b>
			</td>
			<td  align="center" >
			<b>Freight</b>
			</td>
			<td  align="center" >
			<b>Discount</b>
			</td>
			<td  align="center" >
			<b>VAT</b>
			</td>
		<td  align="center" >
			<b>Grand Total</b>
			
			</td>

			
		
		     </tr>
			 <?php 
		$sln=0;
		$tota=0;
$tq=0;
$tamm1=0;	
$car1=0;	
$vatamm1=0;
$ttpoint=0;

$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$todts.$snm1.$brncd1)or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$dt=$row1['dt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$vatamm=$row1['vatamm'];
$car=$row1['car'];
$sid=$row1['cid'];
$pdts=$row1['pdts'];
$dis=$row1['dis'];

if($car==""){$car=0;}
if($dis==""){$dis=0;}
$dt=date('d-m-Y', strtotime($dt));
$sln++;
$qtyt=0;
$asd=0;
$tamm=0;
$tpoint=0;
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}

$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'".$pnm1)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$pty1=$row['qty'];
$blno1=$row['blno'];
$point=$row['plttl'];
$pdis=$row['pdis'];
$fprc=$row['fprc'];



		$query6="select * from  ".$DBprefix."product where sl='$pcd'";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
				}
$cnm="";				
$data4= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data4))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}

	if($blno==$blno1)
	{
		$asd++;
	}
 ?>
		   <tr title="<?php  echo $pcd." S Sl".$sl;?>">
		   <?php if($asd==1){?>
		    <td  align="center"  >
			<?php  echo $sln;?>
			</td>
			<td  align="center"  >
		<a href="#" onclick="retn('<?php  echo $blno;?>')" title="Return"><i class="fa fa-times"></i> <font color="red">Return</font></a>

			</td>
			 <td  align="center" >
			<?php  echo $dt;?>
			</td>
			<td  align="center" >
				<a href="#" onclick="view('<?php  echo $blno;?>')" title="Print"><?php  echo $blno;?></a>
			</td>
            <td  align="left" >
			<?php  echo $nm;?>
			</td>
		   <?php }
		   else
		   {
			?>
			   <td  align="center"  >
		
			</td>
			 <td  align="center"  >
		
			</td>
			 <td  align="center" >
			
			</td>
			<td  align="center" >
			
			</td>
            <td  align="left" >
		
			</td> 
			
		   <?php 
		   }
		   ?>
		   
			<td  align="left" title="<?php  echo $pcd;?>" >
			<?php  echo $pnm;?> - <?php  echo $cnm;?> - <?php  echo $brand;?>
			</td>
			<td  align="center" >
			<b><?php  echo $point;?></b>
			</td>
			<td  align="center" >
			<b><?php  echo $pty1;?></b>
			</td>
			<td  align="right" >
			<?php echo sprintf('%0.2f',$prc);?>
			</td>
			<td  align="center" >
			<?php  echo $pdis;?> %
			</td>
			<td  align="right" >
			<?php echo sprintf('%0.2f',$fprc);?>
			</td>
			<td  align="right" >
			<?php echo sprintf('%0.2f',$ttl);?>
			</td>
			<td  align="center" >
			
			</td>
			<td  align="center" >
		
			</td>
			<td  align="center" >
		
			</td>
			<td  align="center" >
		
			</td>
			
		
		     </tr>	 
			 
<?php 
$qtyt=$pty1+$qtyt;
$tpoint=$tpoint+$point;
$tamm=$ttl+$tamm;
$tq=$pty1+$tq;

}
if($qtyt!=0)
{
?>
<tr bgcolor="#e8ecf6">
<td colspan="6" align="right">
<b>Total</b>
</td>
<td align="center">
<font size="3">
<b>
<?php  echo $tpoint;?>
</b>
</font>
</td>
<td align="center">
<font size="3">
<b>
<?php  echo $qtyt;?>
</b>
</font>
</td>
<td>
</td>
<td>
</td>
<td>
</td>

<td align="right">
<font size="3">
<b><?php echo sprintf('%0.2f',$tamm);?></b>
</font>
</td>
<td align="right">
<font size="3">
<b><?php  echo $car;?></b>
</font>
</td>
<td align="right">
<font size="3">
<b><?php  echo $dis;?></b>
</font>
</td>
<td align="right">
<font size="3">
<b><?php  echo $vatamm;?></b>
</font>
</td>
<td align="right">
<font size="3" color="red">
<b>
<?php echo sprintf('%0.2f', $tamm+$car+$vatamm-$dis);?>

</b>
</font>
</td>

</tr>
<?php 


}
$dis1=$dis+$dis1;
$vatamm1=$vatamm+$vatamm1;
$tamm1=$tamm+$tamm1;
$car1=$car1+$car;
$ttpoint=$tpoint+$ttpoint;
}?>
<tr>
<td colspan="6" align="right">
<b>Total</b>
</td>
<td align="right">
<b>
<?php  echo $ttpoint;?>
</b>
<td align="right">
<b>
<?php  echo $tq;?>
</b>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td align="right">
<b>
<?php  echo $tamm1;?>
</b>
</td>
<td align="right">
<b>
<?php  echo $car1;?>
</b>
</td>
<td align="right">
<b>
<?php  echo $dis1;?>
</b>
</td>
<td align="right">
<b>

<?php  echo $vatamm1;?>
</b>
</td>
<td  align="right" >
		<font size="3" color="red">
<b>
<?php echo sprintf('%0.2f', $tamm1+$car1+$vatamm1-$dis1);?>

</b>
</font>
</td>


</tr>

	  </table>