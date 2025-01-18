<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
 
$cy=date('Y');
$pnm=$_REQUEST[pnm];
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$cat=$_REQUEST['cat'] ?? "";
$scat=$_REQUEST['scat'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";
$xls=$_REQUEST[xls];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$tdt=date('Y-m-d',strtotime($tdt));
$fdt=date('Y-m-d',strtotime($fdt));

$cat1="";
if($brncd!=""){$cat1=" and cat='$brncd'";}
$scat1="";
if($scat!=""){$scat1=" and scat='$scat'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}


?> 

<table class="advancedtable" width="100%" border='1'>

<tr bgcolor="#e8ecf6">
<td  align="center" ><b>Sl</b></td>
<td  align="left"><b>Company</b></td>
<td  align="left"><b>Category</b></td>
<td  align="left" ><b>Product Name</b></td>
<td  align="center" ><b>Opening Qty</b></td>
<td  align="center" ><b>Rate</b></td>
<td  align="center" ><b>Opening Amount</b></td>
<td  align="center" ><b>Purchase Qty</b></td>
<td  align="center" ><b>Rate</b></td>
<td  align="center" ><b>Purchase Amount</b></td>
<td  align="center" ><b>Sale Qty</b></td>
<td  align="center" ><b>Rate</b></td>
<td  align="center" ><b>Sale Amount</b></td>
<td  align="center" ><b>Closing Qty</b></td>
<td  align="center" ><b>Rate</b></td>
<td  align="center" ><b>Closing Amount</b></td>
</tr>
<?php 
$sl=$start;
$c1='odd';
$c3=0;
$sln=0;
$open1=0;
$stkf=0;
$stin1=0;
$stout1=0;
$Top=0;
$Tin=0;
$Tout=0;
$Tout1=0;
$Toutr1=0;
$Tcl=0;
$tval=0;

$T_op_val=0;
$T_pur_val=0;
$T_s_val=0;
$T_cls_val=0;

$data= mysqli_query($conn,"select * from main_product where sl>0 $cat1 $scat1 $all1 ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
$unit=$row['unit'];
$nm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];
$rate=$row['smvlu'];

$reslt5 = mysqli_query($conn,"select * from  main_branch where sl='$cat'");
while($trow=mysqli_fetch_array($reslt5))
{
$cnm=$trow['bnm'];
}
$rest5 = mysqli_query($conn,"select * from  main_scat where sl='$scat'");
while($trw=mysqli_fetch_array($rest5))
{
$snm=$trw['nm'];
}

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
}
$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$pcd' $brncd1  group by rate order by sl");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$rtmm=$row1['rtmm'];
$refno=$row1['refno'];
$nrtn=$row1['nrtn'];
$rate=$row1['rate'];
$pret=$rate;
	
 $clval=0;    
$opval=0; 
$inval=0;
$outval=0;
$stck=0;
$clval=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$tdt' and rate='$pret'".$brncd1." group by pcd ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck;
if($stkf==""){$stkf=0;}
$stock_close=$stkf." ".$sun;

$stock_op="";
$open=0;
$opval=0;
$query6="Select sum(opst+stin-stout) as open from ".$DBprefix."stock where pcd='$pcd' and dt<'$fdt'  and rate='$pret'".$brncd1."  group by pcd";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
$open1=$open;
if($open1==""){$open1=0;}
$stock_op=$open1." ".$sun;

$stin=0;
$inval=0;
$stock_in="";
$query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd' and (dt between '$fdt' and '$tdt' ) and rate='$pret'".$brncd1."  group by pcd";
$result7 = mysqli_query($conn,$query7);
while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
$stin1=$stin;
if($stin1==""){$stin1=0;}
$stock_in=$stin1." ".$sun;


$tots=0;
$stout=0;
$outval=0;
$stock_out="";
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and (dt between '$fdt' and '$tdt' ) and stout>0  and rate='$pret'".$brncd1."  group by pcd";

$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
$stout1=$stout;
if($stout1==""){$stout1=0;}

$stock_out=$stout1." ".$sun;

$sln++;
$value=$stck*$rate;
$tval+=$value;


$op_val=$stock_op*$rate;
$pur_val=$stock_in*$rate;
$s_val=$stock_out*$rate;
$cls_val=$stock_close*$rate;
			 ?>
<tr>
<td  align="center" ><?php  echo $sln;?></td>
<td align="left"><?php  echo $cnm;?></td>
<td align="left"><?php  echo $snm;?></td>
<td  align="left" title="<?php  echo $pcd?>"><?php  echo $nm;?></td>
<td  align="center" ><?php  echo $stock_op;?></td>
<td  align="right"><?php  echo number_format($rate,2);?></td>
<td  align="right" ><?php  echo number_format($op_val,2);?></td>
<td  align="center" ><?php  echo $stock_in;?></td>
<td  align="right"><?php  echo number_format($rate,2);?></td>
<td  align="right" ><?php  echo number_format($pur_val,2);?></td>
<td  align="center" ><?php  echo $stock_out;?></td>
<td  align="right"><?php  echo number_format($rate,2);?></td>
<td  align="right" ><?php  echo number_format($s_val,2);?></td>
<td  align="center" ><?php  echo $stock_close;?></td>
<td  align="right"><?php  echo number_format($rate,2);?></td>
<td  align="right" ><?php echo number_format($cls_val,2);?></td>
</tr>	 
<?php 
$T_op_val=$op_val+$T_op_val;
$T_pur_val=$pur_val+$T_pur_val;
$T_s_val=$s_val+$T_s_val;
$T_cls_val=$cls_val+$T_cls_val;

}


}
?>
<tr>
<td colspan="6" align="right" ><b>Total : </b></td>
<td  align="right" ><b><?php  echo $T_op_val;?></b></td>
<td  align="right" ></td>
<td  align="right" ></td>
<td  align="right" ><b><?php  echo $T_pur_val;?></b></td>
<td  align="right" ></td>
<td  align="right" ></td>
<td  align="right" ><b><?php  echo $T_s_val;?></b></td>
<td  align="right" ></td>
<td  align="right" ></td>
<td  align="right" ><b><?php  echo $T_cls_val;?></b></td>

</tr>	
	  </table>
