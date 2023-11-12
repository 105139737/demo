<?
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and edt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}

$dis1=0;
?>
 <table  width="100%" class="advancedtable"  >
		
		     <tr bgcolor="#e8ecf6">
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
			<b>Rate</b>
			</td>
			<td  align="center" >
			<b>Amount</b>
			</td>
		
		<td  align="center" >
			<b>Grand Total</b>
			
			</td>

			
		
		     </tr>
			 <?
		$sln=0;
		$tota=0;
$tq=0;
$tamm1=0;	
$car1=0;	
$vatamm1=0;

$gttlpnt=0;
$data1= mysqli_query($conn,"select * from  main_billing_oth where sl>0".$todts.$snm1)or die(mysqli_error($conn));
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
$tamm=$row1['tamm'];
$tpoint=$row1['tpoint'];
	
if($car==""){$car=0;}
if($dis==""){$dis=0;}
$dt=date('d-m-Y', strtotime($dt));
$sln++;
$qtyt=0;
$asd=0;

$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}

$ttlpnt=0;
$data= mysqli_query($conn,"select * from  main_bildtls_oth where sl>0 and bilno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['prnm'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$pty1=$row['qty'];
$blno1=$row['bilno'];
$pslno=$row['pslno'];
$point=$row['point'];

$ttlpnt=$ttlpnt+$point;



	if($blno==$blno1)
	{
		$asd++;
	}
 ?>
		   <tr title="<?=$pcd." S Sl".$sl;?>">
		   <?if($asd==1){?>
		    <td  align="center"  >
			<?=$sln;?>
			</td>
			 <td  align="center" >
			<?=$dt;?>
			</td>
			<td  align="center" >
				<a href="#" onclick="view('<?=$blno;?>')" title="Print"><?=$blno;?></a>
			</td>
            <td  align="left" >
			<?=$nm;?>
			</td>
		   <?}
		   else
		   {
			?>
			   <td  align="center"  >
		
			</td>
			 <td  align="center" >
			
			</td>
			<td  align="center" >
			
			</td>
            <td  align="left" >
		
			</td> 
			
		   <?
		   }
		   ?>
		   
			<td  align="left" title="<?=$pcd;?>" >
			<?=$pcd;?>
			</td>
			<td  align="center" >
			<b><?=$point;?></b>
			</td>
			<td  align="center" >
			<b><?=$pty1;?></b>
			</td>
			<td  align="center" >
			<?=$prc;?>
			</td>
			<td  align="center" >
			<?=$ttl;?>
			</td>
			<td  align="center" >
			
			</td>
	
	
			
		
		     </tr>	 
			 
<?
$qtyt=$pty1+$qtyt;
$tamm=$ttl+$tamm;
$tq=$pty1+$tq;

}
if($qtyt!=0)
{
?>
<tr bgcolor="#e8ecf6">
<td colspan="5" align="right">
<b>Total</b>
</td><td colspan="" align="center">
<b><?=$ttlpnt;?></b>
</td>
<td align="center">
<font size="3">
<b>
<?=$qtyt;?>
</b>
</font>
</td>
<td>
</td>
<td align="center">
<font size="3">
<b><?=$tamm;?></b>
</font>
</td>


<td align="right">
<font size="3" color="red">
<b>
<?=sprintf('%0.2f', $tamm+$car+$vatamm-$dis);?>

</b>
</font>
</td>

</tr>
<?


}
$dis1=$dis+$dis1;
$vatamm1=$vatamm+$vatamm1;
$tamm1=$tamm+$tamm1;
$car1=$car1+$car;

$gttlpnt=$gttlpnt+$ttlpnt;
}?>
<tr>
<td colspan="5" align="right">
<b>Total</b>
</td>
<td  align="center">
<b><?=$gttlpnt;?></b>
</td>

<td align="center">
<b>
<?=$tq;?>
</b>
</td>
<td>
</td>
<td align="center">
<b>
<?=$tamm1;?>
</b>
</td>
<td  align="right" >
		<font size="3" color="red">
<b>
<?=sprintf('%0.2f', $tamm1+$car1+$vatamm1-$dis1);?>

</b>
</font>
</td>


</tr>

	  </table>