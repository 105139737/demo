<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
 
$cy=date('Y');
$pnm=$_REQUEST[pnm];
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];
$cat=$_REQUEST[cat];
$scat=$_REQUEST[scat];
$brncd=$_REQUEST[brncd];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$tdt=date('Y-m-d',strtotime($tdt));
$fdt=date('Y-m-d',strtotime($fdt));

$cat1="";
if($brncd!=""){$cat1=" and cat='$brncd'";}
$scat1="";
if($scat!=""){$scat1=" and scat='$scat'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}
$querys="Select * from ".$DBprefix."branch where sl='$brncd'";
$results = mysqli_query($conn,$querys);
while ($Rs = mysqli_fetch_array ($results))
{
$branchnm=$Rs['bnm'];
}
$file="Day Wise Stock(PCS Wise) (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?> 

<table width="100%" class="advancedtable" border="2">
<tr>
<td align="center" colspan="8"><b>
<b>Day Wise Stock(PCS Wise)</b><br>
<font style="font-size:18px;font-family:Century"><b><?=$comp_nm;?> - <?=$branchnm;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><?=$comp_addr;?><br>
Phone : <?=$cont;?>
</font><br/>
<font style="font-size:13px;">GSTIN NO. : <?=$gstin?></font><br>
<font style="font-size:14px;"><b>Statement From : <?=date('d-m-Y', strtotime($fdt));?></b> To <b><?=date('d-m-Y', strtotime($tdt));?></b></font>

</b></td>
</tr>
<tr bgcolor="#e8ecf6">
<td  align="center" ><b>Sl</b></td>
<td  align="left"><b>Company</b></td>
<td  align="left"><b>Category</b></td>
<td  align="left"><b>Product Name</b></td>
<td  align="center" ><b>Opening </b></td>
<td  align="center" ><b>Purchase</b></td>
<td  align="center" ><b>Sale</b></td>
<td  align="center" ><b>Closing Stcok</b></td>
</tr>
<?
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
$data= mysqli_query($conn,"select * from main_product where sl>0  $scat1 $all1 ")or die(mysqli_error($conn));
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

 $clval=0;    
$opval=0; 
$inval=0;
$outval=0;
$stck=0;
$clval=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$tdt'".$brncd1." group by pcd ";
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
$query6="Select sum(opst+stin-stout) as open from ".$DBprefix."stock where pcd='$pcd' and dt<'$fdt'".$brncd1."  group by pcd";
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
$query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd' and (dt between '$fdt' and '$tdt' ) ".$brncd1."  group by pcd";
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
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and (dt between '$fdt' and '$tdt' ) and stout>0".$brncd1."  group by pcd";

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
			 ?>
<tr>
<td  align="center" ><?=$sln;?></td>
<td align="left"><?=$cnm;?></td>
<td align="left"><?=$snm;?></td>
<td  align="left" title="<?=$pcd?>"><?=$nm;?></td>
<td  align="center"><?echo $stock_op;?></td>
<td  align="center"><?=$stock_in;?></td>
<td  align="center"><?=$stock_out;?></td>
<td  align="center"><?=$stock_close;?></td>
</tr>	 
<?

}
?>
</table>
