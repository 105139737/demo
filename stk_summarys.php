<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$rt=$_REQUEST['rt'];
$val=$_REQUEST['val'];
$rts=$_REQUEST['rts'];
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
    $jobLink=CreateNewJob('jobs/stk_summarys.php',$user_currently_loged,'Stock Summary',$conn);
    ?>
    <script language="javascript">
    alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
    window.history.go(-1);
    </script>
    <?php 
    die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
    
$file="Stock_Summarys.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
}
set_time_limit(0);

$data21= mysqli_query($conn,"select * from main_stock where sl>0  and scat='' group by pcd")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data21))
{
$pcd_u=$row1['pcd'];

$data211= mysqli_query($conn,"select * from main_product where sl='$pcd_u' ")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data211))
{
$scat_u=$row1['scat'];
}
if($scat_u=='')
{
$scat_u="NA";	
}
$data2111= mysqli_query($conn,"update main_stock set scat='$scat_u' where pcd='$pcd_u' ")or die(mysqli_error($conn));
}

?>
<table  width="100%" <?php if($val=='1'){?> border="1"<?php }?> class="advancedtable" >
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

<?php 

$sln=0;
$topen_stk=0;
$topen_val=0;

$data2= mysqli_query($conn,"select * from main_scat where sl>0 $cat1 $scat1 order by nm")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$cat_nm=$row1['nm'];
$cat_sl=$row1['sl'];

$open_val=0;
$open_stk=0;
$open_rt=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock  where scat='$cat_sl'  and  dt<'$fdt'  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$open_stk=$R4['stck1'];
}
if($open_stk>0 and $rts=='1')
{
	
$open_rt=get_avg_rate_op($rt,$cat_sl,$fdt,$conn);
}

$open_val=$open_stk*$open_rt;
$topen_stk+=$open_stk;
$topen_val+=$open_val;

$in_val=0;
$in_stk=0;
$in_rt=0;
$query4="Select sum(main_stock.stin) as stck1 from main_stock where scat='$cat_sl' and (nrtn='Purchase' or nrtn='Sale Return') $todt  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$in_stk=$R4['stck1'];
}
if($in_stk>0 and $rts=='1')
{
$in_rt=get_avg_rate_in($rt,$cat_sl,$todt,$conn);
}
$in_val=$in_stk*$in_rt;

$tpin_val+=$in_val;
$tpin_stk+=$in_stk;

$out_val=0;
$out_stk=0;
$out_rt=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where scat='$cat_sl' and (nrtn='Sale' or nrtn='Purchase Return') $todt  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$out_stk=$R4['stck1'];
}
if($out_stk>0 and $rts=='1')
{
$out_rt=get_avg_rate_out($rt,$cat_sl,$todt,$conn);
}
$out_val=$out_stk*$out_rt;

$tsout_val+=$out_val;
$tsout_stk+=$out_stk;

$tin_val=0;
$tin_stk=0;
$tin_rt=0;
$query4="Select sum(main_stock.stin+main_stock.opst) as stck1 from main_stock where scat='$cat_sl' and (nrtn='Receive' or nrtn='Opening' or nrtn='Adjustment') $todt  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_stk=$R4['stck1'];
}
/*
$query4="Select avg($rt) as stck1 from main_stock where scat='$cat_sl' and (nrtn='Receive' or nrtn='Opening' or nrtn='Adjustment') $todt  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_rt=round($R4['stck1'],2);
}
*/
$tin_val=$tin_stk*$tin_rt;

$ttin_val+=$tin_val;
$ttin_stk+=$tin_stk;

$tout_val=0;
$tout_stk=0;
$tout_rt=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock  where scat='$cat_sl' and (nrtn='Transfer' or nrtn='Opening Out' or nrtn='Adjustment') $todt  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tout_stk=$R4['stck1'];
}

$tout_val=$tout_stk*$tout_rt;
$ttout_val+=$tout_val;
$ttout_stk+=$tout_stk;

$colse_val=0;
$close_stk=0;
$close_rt=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where scat='$cat_sl' and  dt<='$tdt'  $brncd1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_stk=$R4['stck1'];
}
if($close_stk>0 and $rts=='1')
{
$close_rt=get_avg_rate_op($rt,$cat_sl,date("Y-m-d", strtotime(date("Y-m-d", strtotime($tdt)) . " + 1 day")),$conn);
}
$colse_val=$close_stk*$close_rt;

$tcolse_val+=$colse_val;
$tclose_stk+=$close_stk;

?>
<tr >
<td align="left" ><a href="javascript:product_wise('<?php  echo $cat_sl;?>')"><font color="red"><b><?php  echo $cat_nm;?></font></b></a></td>

<td align="center" ><b><?php  echo $open_stk;?></b></td>
<td align="right" ><b><?php  echo $open_rt;?></b></td>
<td align="right" ><b><?php  echo $open_val;?></b></td>

<td align="center" ><b><?php  echo $in_stk;?></b></td>
<td align="right" ><b><?php  echo $in_rt;?></b></td>
<td align="right" ><b><?php  echo $in_val;?></b></td>

<td align="center" ><b><?php  echo $out_stk;?></b></td>
<td align="right" ><b><?php  echo $out_rt;?></b></td>
<td align="right" ><b><?php  echo $out_val;?></b></td>

<td align="center" ><b><?php  echo $tin_stk;?></b></td>
<td align="right" ><b><?php  echo $tin_rt;?></b></td>
<td align="right" ><b><?php  echo $tin_val;?></b></td>

<td align="center" ><b><?php  echo $tout_stk;?></b></td>
<td align="right" ><b><?php  echo $tout_rt;?></b></td>
<td align="right" ><b><?php  echo $tout_val;?></b></td>

<td align="center" ><b><?php  echo $close_stk;?></b></td>
<td align="right" ><b><?php  echo $close_rt;?></b></td>
<td align="right" ><b><?php  echo $colse_val;?></b></td>
</tr> 

<?php 
}
?>
<tr bgcolor="#a2cee6">
<td align="left" ><font size="3"><b>Total</b></font></td>

<td align="center" ><font size="3"><b><?php  echo $topen_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $topen_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $tpin_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $tpin_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $tsout_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $tsout_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $ttin_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $ttin_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $ttout_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $ttout_val;?></b></font></td>

<td align="center" ><font size="3"><b><?php  echo $tclose_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?php  echo $tcolse_val;?></b></font></td>
</tr> 
</table>
