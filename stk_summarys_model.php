<?php
$reqlevel = 3;
set_time_limit(0);
include("membersonly.inc.php");
include "function.php";
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$catsl=$_REQUEST['cat']; 
$scatsl=$_REQUEST['scat'];
$rt=$_REQUEST['rt'];
$val=$_REQUEST['val'];
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and main_stock.bcd='$brncd'";}
$cat1="";
if($catsl!=""){$cat1=" and cat='$catsl'";}
$scat1="";
if($scatsl!=""){$scat1=" and sl='$scatsl'";}


if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));	
$todt=" and main_stock.dt between '$fdt' and '$tdt'";}else{$todt="";}

if($val=='1')
{
$jobLink=CreateNewJob('jobs/stk_summarys_model.php',$user_currently_loged,'Stock Summary Model Wise',$conn);
?>
<script language="javascript">
alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
window.history.go(-1);
</script>
<?php
die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
    
$file="Stock_Summary_model.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
}

?>
<table  width="100%" class="advancedtable" <?if($val=='1'){?> border="1"<?}?>  >
<tr bgcolor="#a2cee6">
<td align="left" rowspan="2"><b>Particulars</b></td>
<td align="center" colspan="3"><b>Opening Balance</b></td>
<td align="center" colspan="3"><b>Inwards</b></td>
<td align="center" colspan="3"><b>Outwards</b></td>
<td align="center" colspan="3"><b>Transfer IN</b></td>
<td align="center" colspan="3"><b>Transfer OUT</b></td>
<td align="center" colspan="3"><b>Closing Balance</b></td>
</tr>
<tr>
<td align="left" bgcolor="#66ffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#66ffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#66ffcc" ><b>Value</b></td>

<td align="left" bgcolor="#ccffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#ccffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#ccffcc" ><b>Value</b></td>

<td align="left" bgcolor="#66ccff" ><b>Quantity</b></td>
<td align="left" bgcolor="#66ccff" ><b>Rate</b></td>
<td align="left" bgcolor="#66ccff" ><b>Value</b></td>

<td align="left" bgcolor="#cccc00" ><b>Quantity</b></td>
<td align="left" bgcolor="#cccc00" ><b>Rate</b></td>
<td align="left" bgcolor="#cccc00" ><b>Value</b></td>

<td align="left" bgcolor="#cc99ff" ><b>Quantity</b></td>
<td align="left" bgcolor="#cc99ff" ><b>Rate</b></td>
<td align="left" bgcolor="#cc99ff" ><b>Value</b></td>


<td align="left" bgcolor="#99ffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Value</b></td>
</tr>

<?


$sln=0;
$topen_stk=0;
$topen_val=0;
$data21= mysqli_query($conn,"select * from main_scat where sl>0 $cat1 $scat1 order by nm")or die(mysqli_error($conn));
while ($row11 = mysqli_fetch_array($data21))
{
$cat_nm=$row11['nm'];
$cat_sl=$row11['sl'];
?>
<tr >
<td colspan="19" bgcolor="#FFFFE0">
<font color="red"><b><?=$cat_nm;?></b></font>
</td>
</tr>
<?
$data2= mysqli_query($conn,"select * from main_product where sl>0 and typ='0' and scat='$cat_sl'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$pnm=$row1['pnm'];
$pcd=$row1['sl'];

$open_val=0;
$open_stk=0;
$open_rt=0;
/*
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and  main_stock.dt<'$fdt'  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$open_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and  main_stock.dt<'$fdt'and (main_stock.opst>0 or main_stock.stin>0)   $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$open_rt=round($R4['stck1'],2);
}
$open_val=$open_stk*$open_rt;
$topen_stk+=$open_stk;
$topen_val+=$open_val;

$in_val=0;
$in_stk=0;
$in_rt=0;
$query4="Select sum(main_stock.stin) as stck1 from main_stock where pcd='$pcd'  and (main_stock.nrtn='Purchase' or main_stock.nrtn='Sale Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$in_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and main_stock.stin>0  and (main_stock.nrtn='Purchase' or main_stock.nrtn='Sale Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$in_rt=round($R4['stck1'],2);
}
$in_val=$in_stk*$in_rt;

$tpin_val+=$in_val;
$tpin_stk+=$in_stk;

$out_val=0;
$out_stk=0;
$out_rt=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Sale' or main_stock.nrtn='Purchase Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$out_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and main_stock.stout>0 and (main_stock.nrtn='Sale' or main_stock.nrtn='Purchase Return') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$out_rt=round($R4['stck1'],2);
}
$out_val=$out_stk*$out_rt;

$tsout_val+=$out_val;
$tsout_stk+=$out_stk;

$tin_val=0;
$tin_stk=0;
$tin_rt=0;
$query4="Select sum(main_stock.stin+main_stock.opst) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Receive' or main_stock.nrtn='Opening' or main_stock.nrtn='Adjustment')  $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Receive' or main_stock.nrtn='Opening' or main_stock.nrtn='Adjustment') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_rt=round($R4['stck1'],2);
}
$tin_val=$tin_stk*$tin_rt;

$ttin_val+=$tin_val;
$ttin_stk+=$tin_stk;

$tout_val=0;
$tout_stk=0;
$tout_rt=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Transfer' or main_stock.nrtn='Opening Out' or main_stock.nrtn='Adjustment') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tout_stk=$R4['stck1'];
}
$query4="Select avg($rt) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Transfer' or main_stock.nrtn='Opening Out' or main_stock.nrtn='Adjustment') $todt  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tout_rt=round($R4['stck1'],2);
}
$tout_val=$tout_stk*$tout_rt;
$ttout_val+=$tout_val;
$ttout_stk+=$tout_stk;
*/
$colse_val=0;
$close_stk=0;
$close_rt=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and main_stock.dt<='$tdt'  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_stk=$R4['stck1'];
}

$query4="Select * from main_purchasedet where prsl='$pcd' and  dt<='$tdt'  order by sl desc limit 1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$fsl=$R4['sl'];
}

$query4="Select * from main_purchasedet where prsl='$pcd' and  dt<='$tdt'  order by sl desc  limit 2";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$lsl=$R4['sl'];
}
$close_rt=0;


$query4="Select sum(amm)/sum(qty) as stck1 from main_purchasedet where prsl='$pcd' and  dt<='$tdt' and sl between '$lsl' and '$fsl' order by sl";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_rt=round($R4['stck1'],2);
}

if($close_rt<.000001)
{
$query4="Select $rt as stck1 from main_stock where pcd='$pcd' and main_stock.nrtn='Opening' and $rt>0 limit 1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_rt=round($R4['stck1'],2);
}
}
$colse_val=$close_stk*$close_rt;

$tcolse_val+=$colse_val;
$tclose_stk+=$close_stk;

?>
<tr title="<?php echo $pcd;?>">
<td align="left" ><b><?=$pnm;?></b></td>

<td align="center" ><b><?=$open_stk;?></b></td>
<td align="right" ><b><?=$open_rt;?></b></td>
<td align="right" ><b><?=$open_val;?></b></td>

<td align="center" ><b><?=$in_stk;?></b></td>
<td align="right" ><b><?=$in_rt;?></b></td>
<td align="right" ><b><?=$in_val;?></b></td>

<td align="center" ><b><?=$out_stk;?></b></td>
<td align="right" ><b><?=$out_rt;?></b></td>
<td align="right" ><b><?=$out_val;?></b></td>

<td align="center" ><b><?=$tin_stk;?></b></td>
<td align="right" ><b><?=$tin_rt;?></b></td>
<td align="right" ><b><?=$tin_val;?></b></td>

<td align="center" ><b><?=$tout_stk;?></b></td>
<td align="right" ><b><?=$tout_rt;?></b></td>
<td align="right" ><b><?=$tout_val;?></b></td>

<td align="center" ><b><?=$close_stk;?></b></td>
<td align="right" ><b><?=$close_rt;?></b></td>
<td align="right" ><b><?=$colse_val;?></b></td>
</tr> 

<?
}
}
?>
<tr bgcolor="#a2cee6">
<td align="left" ><font size="3"><b>Total</b></font></td>

<td align="center" ><font size="3"><b><?=$topen_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$topen_val;?></b></font></td>

<td align="center" ><font size="3"><b><?=$tpin_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$tpin_val;?></b></font></td>

<td align="center" ><font size="3"><b><?=$tsout_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$tsout_val;?></b></font></td>

<td align="center" ><font size="3"><b><?=$ttin_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$ttin_val;?></b></font></td>

<td align="center" ><font size="3"><b><?=$ttout_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$ttout_val;?></b></font></td>

<td align="center" ><font size="3"><b><?=$tclose_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$tcolse_val;?></b></font></td>
</tr> 
</table>
