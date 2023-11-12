<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
 
$cy=date('Y');
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}

$pnmsl=$_REQUEST['pnm'];
$scat_sl=$_REQUEST['scat'];
$brncd=$_REQUEST['brncd'];
if($brncd==""){$brncd1="";}else{$brncd1=" and cat='$brncd'";}
if($brncd!=""){$cat1=" and cat='$brncd'";}else{$cat1="";}
if($pnmsl!=""){$pnm1=" and sl='$pnmsl'";}else{$pnm1="";	}
if($scat_sl!=""){$scat_sl1=" and scat='$scat_sl'";}else{$scat_sl1="";	}
?> 
<table width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>Sl</b></td>
<td  align="left"><b>Company</b></td>
<td  align="left"><b>Category</b></td>
<td  align="left"><b>Product Name</b></td>
<td  align="center"><b>Opening Qty</b></td>
<td  align="center"><b>Rate</b></td>
<td  align="center"><b>Opening Amount</b></td>

<td  align="center"><b>Purchase Qty</b></td>
<td  align="center"><b>P. Rate</b></td>
<td  align="center"><b>Purchase Amount</b></td>
<td  align="center"><b>Sale Qty</b></td>
<td  align="center"><b>S. Rate</b></td>
<td  align="center"><b>Sale Amount</b></td>
<td  align="center"><b>Closing Qty</b></td>
<td  align="center"><b>Rate</b></td>
<td  align="center"><b>Closing Amount</b></td>
</tr>
<?
$cntt=0;
$pt=0;
$st=0;
$ct=0;
$plt=0;
$ot=0;
$data= mysqli_query($conn,"select * from main_product where sl>0 $pnm1 $scat_sl1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{

$pcd=$row['sl'];
$pnm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];

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

$resttt = mysqli_query($conn,"select * from  main_stock where pcd='$pcd'");
$ccnt=mysqli_num_rows($resttt);
if($ccnt>0)
{
$pur=0;
$ptotal=0;
$unit=0;
$prate=0;	
$data1 = mysqli_query($conn,"SELECT sum(opst+stin) as pur,((sum((opst+stin)*stk_rate))/sum(stin+opst)) as prate,sum((opst+stin)*stk_rate) as ptotal FROM main_stock WHERE pcd='$pcd' and (stin>0 or opst>0) $todt group by pcd order by sl");
while ($row1 = mysqli_fetch_array($data1))
{
$pur=$row1['pur'];
$ptotal=$row1['ptotal'];
$unit=$row1['unit'];
$prate=$row1['prate'];
}
if($pur==""){$pur=0;}
$sale=0;
$stotal=0;
$unit=0;
$srate=0;
$data2 = mysqli_query($conn,"SELECT sum(stout) as sale,((sum(stout*stk_rate))/sum(stout)) as srate,sum(stout*stk_rate) as stotal FROM main_stock WHERE pcd='$pcd' and stout>0 $todt group by pcd order by sl");
while ($row2 = mysqli_fetch_array($data2))
{
$sale=$row2['sale'];
$stotal=$row2['stotal'];
$srate=$row2['srate'];
}
$opst=0;
$optotal=0;
$orate=0;
$data12 = mysqli_query($conn,"SELECT ((sum((opst+stin)*stk_rate))/sum(stin+opst)) as prate FROM main_stock WHERE pcd='$pcd' and (stin>0 or opst>0) and dt<'$fdt' group by pcd order by sl");
while ($row1 = mysqli_fetch_array($data12))
{
$orate=$row1['prate'];
}
$crate=0;
$data13 = mysqli_query($conn,"SELECT ((sum((opst+stin)*stk_rate))/sum(stin+opst)) as prate FROM main_stock WHERE pcd='$pcd' and (stin>0 or opst>0) and dt<'$tdt' group by pcd order by sl");
while ($row1 = mysqli_fetch_array($data13))
{
$crate=$row1['prate'];
}

$data2 = mysqli_query($conn,"SELECT sum(opst+stin-stout) as opst FROM main_stock WHERE pcd='$pcd'  and dt<'$fdt' group by pcd order by sl");
while ($row2 = mysqli_fetch_array($data2))
{
$opst=$row2['opst'];
}
$optotal=$opst*$orate;
$close_stk=($opst+$pur)-$sale;
$ttoal=$close_stk*$crate;
$PL=(($stotal+$ttoal)-($ptotal+$optotal));
$cntt++;
?>
<tr  title="<?=$pcd;?>">
<td  align="center" ><?=$cntt;?></td>
<td align="left"><?=$cnm;?></td>
<td align="left"><?=$snm;?></td>
<td align="left"><?=$pnm;?></td>
<td align="center"><?=$opst;?> PCS</td>
<td align="right" ><?=number_format(round($orate,4),4);?></td>
<td align="right" ><?=number_format(round($optotal,2),2);?></td>

<td align="center"><?=$pur;?> PCS</td>
<td align="right" ><?=number_format(round($prate,4),4);?></td>
<td align="right" ><?=number_format(round($ptotal,2),2);?></td>
<td align="center" ><?=$sale;?> PCS</td>
<td align="right" ><?=number_format(round($srate,4),4);?></td>
<td align="right" ><?=number_format(round($stotal,2),2);?></td>
<td align="center" ><?=$close_stk;?> PCS</td>
<td align="right" ><?=number_format(round($crate,4),4);?></td>
<td align="right" ><?=number_format(round($ttoal,2),2);?></td>
</tr>
	<?
$pt+=$ptotal;
$st+=$stotal;
$ct+=$ttoal;
$plt+=$PL;	
$ot+=$optotal;
}
}
	?>
<tr  title="<?=$pcd;?>">
<td  align="right" colspan="5"><b>Total : </b></td>

<td align="right" ></td>
<td align="right" ><b><?=number_format(round($ot,2),2);?></b></td>
<td align="right" ></td>
<td align="center" ></td>
<td align="right" ><b><?=number_format(round($pt,2),2);?></b></td>
<td align="right" ></td>
<td align="center" ></td>
<td align="right" ><b><?=number_format(round($st,2),2);?></b></td>

<td align="right" ></td>
<td align="right" ></td>
<td align="right" ><b><?=round($ct,2);?></b></td>
</tr>
</table>
