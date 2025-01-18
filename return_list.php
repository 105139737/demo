<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pnm=$_REQUEST[pnm];
$cat=$_REQUEST['cat'] ?? "";
$bnm=$_REQUEST[bnm];

$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and edt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and rdt between '$fdt' and '$tdt'";}else{$todts="";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
$cat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
$bnm1="";
if($bnm!=""){$bnm1=" and bnm='$bnm'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}


$pqq=" and prsl in (select sl from main_product where sl>0 $cat1 $bnm1 $all1)";
$dis1=0;
?>
 <table  width="100%" class="advancedtable"  >
		
		<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Date</b></td>
			<td  align="center" ><b>Invoice</b></td>
			<td  align="center" ><b>Customer Name</b></td>
			<td  align="center" ><b>Product</b></td>
			<td  align="center" ><b>Quantity</b></td>

			<td  align="center" ><b>Rate</b></td>
			<td  align="center" ><b>Amount</b></td>
			<td  align="center" ><b>Return Date</b></td>
			<td  align="center" ><b>Reference No.</b></td>
			
			<td  align="center" ><b>Grand Total</b></td>

		</tr>
			 <?php 
		$sln=0;
		$tota=0;
$tq=0;
$tamm1=0;	
$vatamm1=0;

$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$snm1.$brncd1)or die(mysqli_error($conn));
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
$rblno=$row1['rblno'];
$adamm=$row1['adamm'];
$pamm=$row1['pamm'];
$rfamm=$row1['rfamm'];

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

$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'  and retno!=''".$pqq.$todts)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$pty1=$row['qty'];
$blno1=$row['blno'];
$point=$row['point'];
$pdis=$row['pdis'];
$fprc=$row['fprc'];
$pvat=$row['pvat'];
$retno=$row['retno'];
$rdt=$row['rdt'];
$rdt=date('d-m-Y', strtotime($rdt));



			$query6="select * from  ".$DBprefix."product where sl='$pcd'";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$variant=$row['variant'];
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
			<td  align="center"  ><?php  echo $sln;?></td>
			<td  align="center" ><?php  echo $dt;?></td>
			<td  align="center" ><?php  echo $blno;?></td>
			<td  align="left" ><?php  echo $nm;?></td>
			<?php }
			else
			{
			?>
			
			<td  align="center" ></td>
			<td  align="center" ></td>
            <td  align="left" ></td> 
            <td  align="left" ></td> 
			
		   <?php 
		   }
		   ?>
		   
			<td  align="left" title="<?php  echo $pcd;?>" ><?php  echo $cnm;?> - <?php  echo $brand;?> - <?php  echo $variant;?></td>
			<td  align="center" ><b><?php  echo $pty1;?></b></td>
	
			<td  align="center" ><?php echo sprintf('%0.2f',$fprc)?></td>
			<td  align="center" ><?php echo sprintf('%0.2f',$ttl)?></td>
			<td  align="center" ><?php  echo $rdt;?></td>
			<td  align="center" ><a href="#" onclick="view('<?php  echo $blno;?>','<?php  echo $retno;?>')" title="Print"><?php  echo $retno;?></a></td>
		
			<td  align="center" ></td>
			</tr>	 
			 
<?php 
$qtyt=$pty1+$qtyt;
$tamm=$ttl+$tamm;
$tq=$pty1+$tq;
}
if($qtyt!=0)
{
?>
<tr bgcolor="#e8ecf6">
<td colspan="5" align="right"><b>Total</b></td>
<td align="center"><font size="3"><b><?php  echo $qtyt;?></b></font></td>
<td></td>

<td align="center"><font size="3"><b><?php echo sprintf('%0.2f',$tamm);?></b></font></td>
<td align="center"><font size="3"><b></b></font></td>
<td align="center"><font size="3"></font></td>

<td align="right"><font size="3" color="red"><b><?php echo sprintf('%0.2f',$tamm-$dis);?></b></font></td>
</tr>
<?php 


}
$dis1=$dis+$dis1;
$tamm1=$tamm+$tamm1;


}?>
<tr>
<td colspan="5" align="right"><b>Total</b></td>
<td align="center"><b><?php  echo $tq;?></b></td>
<td></td>

<td align="center"><b><?php echo sprintf('%0.2f',$tamm1);?></b></td>
<td align="center"><b></b></td>
<td align="center"><b></b></td>

<td  align="right" ><font size="3" color="red"><b><?php echo sprintf('%0.2f',$tamm1);?></b></font></td>
</tr>

	  </table>