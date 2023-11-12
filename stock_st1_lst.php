<?
$reqlevel = 1;
include("membersonly.inc.php");

$pnm=$_REQUEST['pnm'];
$fdt1=$_REQUEST['fdt'];
$tdt1=$_REQUEST['tdt'];
$fdt=date('Y-m-d',strtotime($fdt1));
$tdt=date('Y-m-d',strtotime($tdt1));
$brncd=$_REQUEST['brncd'];

$t="";
if($pnm!='')
{
	$t=" where sl='$pnm'";
}
$qt="";
if($brncd!='')
{
	$qt=" and bcd='$brncd'";
}

$c=0;

	?>
	 <table class="table table-hover table-striped table-bordered" >
	 <tr>
	 <td style="text-align:right;font-weight:bold;">Sl. No.</td>
	 <td style="text-align:right;font-weight:bold;">Product Name</td>
	 <td style="text-align:right;font-weight:bold;">Opening Stock</td>
	 <td style="text-align:right;font-weight:bold;">IN</td>
	 <td style="text-align:right;font-weight:bold;">OUT</td>
	 <td style="text-align:right;font-weight:bold;">Closing Stock</td>
	 <td style="text-align:right;font-weight:bold;">Opening Value (Rs.)</td>
	 <td style="text-align:right;font-weight:bold;">OUT Value(Rs.)</td>
	 <td style="text-align:right;font-weight:bold;">Closing Value (Rs.)</td>
	 </tr>

<?
$TOT=0;
$TOT2=0;
$TOT1=0;
$TOT4=0;
$TOT5=0;
$TOT6=0;
$TOT7=0;
$qr1=mysqli_query($conn,"select * from main_product $t order by pnm")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($qr1))
{
$c++;
$pnm1=$row1['pnm'];
$mnm=$row1['mnm'];

$psl=$row1['sl'];
$opst=0;
$q=mysqli_query($conn,"select sum(opst+stin-stout) as opst2 from main_stock where pcd='$psl' and dt<'$fdt' $qt")or die(mysqli_error($conn));
while($rr=mysqli_fetch_array($q))
{	
	$opst=$rr['opst2'];

}


$qr=mysqli_query($conn,"select pcd, sum(stin) as amm2, sum(stout) as amm3 from main_stock where pcd='$psl' and (dt between '$fdt' and '$tdt') $qt")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($qr))
{
	$pcd=$row['pcd'];
	$stin=$row['amm2'];
	$stout=$row['amm3'];	
}
$ret="";
 $query3="Select * from ".$DBprefix."stock where pcd='$pcd' order by ret";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$ret=$R3['ret'];
}	






if($opst=='')
{
	$opst=0;
}
if($stin=='')
{
	$stin=0;
}
if($stout=='')
{
	$stout=0;
}
$clsstk=($opst+$stin)-$stout;
$opval=($opst*$ret);
$slval=($stout*$ret);
$clsval=(($opst+$stin)-$stout)*$ret;

$TOT=$TOT+$stin;
$TOT1=$TOT1+$stout;
$TOT2=$TOT2+$opst;
$TOT4=$TOT4+$clsstk;
$TOT5=$TOT5+$opval;
$TOT6=$TOT6+$slval;
$TOT7=$TOT7+$clsval;
?>
	 <tr>
	 <td style="text-align:right;"><?=$c;?></td>
	 <td style="text-align:right;" title="<?=$psl;?>"><?=$pnm1;?></td>
	 <td style="text-align:right;"><?=$opst;?></td>
	 <td style="text-align:right;"><?=$stin;?></td>
	 <td style="text-align:right;"><?=$stout;?></td>
	 <td style="text-align:right;"><?=$clsstk;?></td>
	 <td style="text-align:right;"><?=sprintf("%.2f",$opval);?></td>
	 <td style="text-align:right;"><?=sprintf("%.2f",$slval);?></td>
	 <td style="text-align:right;"><?=sprintf("%.2f",$clsval);?></td>
	 </tr>

<?	

}
?>
	 <tr>
	 <td style="text-align:right;font-weight:bold;color:red;" colspan="2"><font size="4">Total :</font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=$TOT2;?></font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=$TOT;?></font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=$TOT1;?></font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=$TOT4;?></font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=sprintf("%.2f",$TOT5);?></font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=sprintf("%.2f",$TOT6);?></font></td>
	 <td style="text-align:right;color:red;"><font size="3"><?=sprintf("%.2f",$TOT7);?></font></td>
	 </tr>
</table>	 
