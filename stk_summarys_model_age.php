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
$prnm=$_REQUEST['prnm'];
$typ=$_REQUEST['typ'];
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and main_stock.bcd='$brncd'";}
$cat1="";
if($catsl!=""){$cat1=" and cat='$catsl'";}
$scat1="";
if($scatsl!=""){$scat1=" and sl='$scatsl'";}
$prnm1="";
if($prnm!=""){$prnm1=" and sl='$prnm'";}


if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));	
$todt=" and main_stock.dt between '$fdt' and '$tdt'";}else{$todt="";}

if($val=='1')
{
    $jobLink=CreateNewJob('jobs/stk_summarys_model_age.php',$user_currently_loged,'Ageing',$conn);
    ?>
    <script language="javascript">
    alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
    window.history.go(-1);
    </script>
    <?php
    die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
       
$file="Stock_ageing.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
}

?>
<table  width="100%" class="advancedtable" <?if($val=='1'){?> border="1"<?}?>  >
<tr>

<td align="left" bgcolor="#99ffcc" ><b>Particulars</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Code</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Quantity</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Rate</b></td>
<td align="left" bgcolor="#99ffcc" ><b>Value</b></td>
<td align="center" bgcolor="#99ffcc" ><b>Last Purchase Refno</b></td>
<td align="center" bgcolor="#99ffcc" ><b>Last Purchase Date</b></td>
<td align="center" bgcolor="#99ffcc" ><b>Ageing</b></td>
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
<td colspan="8" bgcolor="#FFFFE0">
<font color="red"><b><?=$cat_nm;?></b></font>
</td>
</tr>
<?
$data2= mysqli_query($conn,"select * from main_product where sl>0 and typ='0' and scat='$cat_sl' and stat='0' $prnm1")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$pnm=$row1['pnm'];
$pcd=$row1['sl'];
$pcode=$row1['pcd'];
$open_val=0;
$open_stk=0;
$open_rt=0;

$colse_val=0;
$close_stk=0;
$close_rt=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and main_stock.dt<='$tdt'  $brncd1 group by pcd";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_stk=$R4['stck1'];
}
$pdt="";
$ageing="0";
$blno="";
$query4="Select * from main_purchasedet where prsl='$pcd' and  dt<='$tdt'  order by sl desc limit 1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$fsl=$R4['sl'];
$pdt=$R4['dt'];
$blno=$R4['blno'];

$diff = (strtotime($pdt) - strtotime($dt));
$ageing = (abs(floor($diff / (60*60*24))));

$pdt=date('d-m-Y', strtotime($pdt));
}


$close_rt=0;


$query4="Select * from main_purchasedet where prsl='$pcd' and  dt<='$tdt' order by sl desc limit 1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_rt=round($R4[$rt],2);
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
if($typ=='1')
{
if($close_stk!=0)
{

?>
<tr title="<?php echo $pcd;?>">
<td align="left" ><b><?=$pnm;?></b></td>
<td align="left" ><b><?=$pcode;?></b></td>
<td align="center" ><b><?=$close_stk;?></b></td>
<td align="right" ><b><?=$close_rt;?></b></td>
<td align="right" ><b><?=$colse_val;?></b></td>
<td align="center" ><b><?=$blno;?></b></td>
<td align="center" ><b><?=$pdt;?></b></td>
<td align="center" ><b><?=$ageing;?></b></td>
</tr> 
<?
}
}
else
{
    ?>
    <tr title="<?php echo $pcd;?>">
    <td align="left" ><b><?=$pnm;?></b></td>
    <td align="left" ><b><?=$pcode;?></b></td>
    <td align="center" ><b><?=$close_stk;?></b></td>
    <td align="right" ><b><?=$close_rt;?></b></td>
    <td align="right" ><b><?=$colse_val;?></b></td>
    <td align="center" ><b><?=$blno;?></b></td>
    <td align="center" ><b><?=$pdt;?></b></td>
    <td align="center" ><b><?=$ageing;?></b></td>
    </tr> 
    <?   
}


}
}
?>
<tr bgcolor="#a2cee6">
<td align="left" colspan="2" ><font size="3"><b>Total</b></font></td>



<td align="center" ><font size="3"><b><?=$tclose_stk;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b><?=$tcolse_val;?></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
<td align="right" ><font size="3"><b></b></font></td>
</tr> 
</table>
