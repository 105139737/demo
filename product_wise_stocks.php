<?php 
set_time_limit(0);
$reqlevel = 3;
include("membersonly.inc.php");
$start=0;
$todt="";
$TIN=0;
$TOUT=0;
$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$pr_nm=$_REQUEST['prnm'];
//$gst_no=$_REQUEST['gstin'];
$godown=$_REQUEST['godown'];
$brncd=$_REQUEST['brncd'] ?? "";

$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];


if($scat==""){$scat1="";}else{$scat1=" and scat='$scat'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}
if($pr_nm!=""){$pr_nm1=" and sl='$pr_nm'";}else{$pr_nm1="";}

if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

$gnm="";
$query="Select * from main_godown where sl='$godown'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$gnm=$R['gnm'];
}

?>
<table  width="100%" class="advancedtable"  >
<tr bgcolor="#e8ecf6">
<td  align="center"><b>Sl</b></td>
<td  align="left"><b>Brand</b></td>
<td  align="left"><b>Category</b></td>
<td  align="left"><b>Model</b></td>

<td  align="left"><b>Barcode </b></td>
<td  align="center"><b>Godown</b></td>
<td  align="center"><b>Opening</b></td>
<td  align="center"><b>In</b></td>
<td  align="center"><b>Out</b></td>
<td  align="center"><b>Transfer IN</b></td>
<td  align="center"><b>In Transit</b></td>
<td  align="center"><b>Transfer OUT</b></td>

<td  align="center"><b>Balance</b></td>

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
$it=0;
$to=0;
$total=0;
$OP=0;
$IN=0;
$OUT=0;
$IT=0;
$CUR=0;
$data11= mysqli_query($conn,"select * from  main_product where sl>0 $cat1 $scat1  $pr_nm1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data11))	
{
$pcd=$row['sl'];
$cat=$row['cat'];
$scat=$row['scat'];
$pnm=$row['pnm'];

$cat1="";
$get1=mysqli_query($conn,"select * from main_catg where sl='$cat'") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
$cat1=$row1['cnm'];
}
$scat1="";
$get2=mysqli_query($conn,"select * from main_scat where sl='$scat'") or die(mysqli_error($conn));
while($row2=mysqli_fetch_array($get2))
{
$scat1=$row2['nm'];
}

$data1="Select * from ".$DBprefix."stock where sl>0 and pcd='$pcd' $godown1 group by betno ";
$c=0;
$data = mysqli_query($conn,$data1);
$ccn=mysqli_num_rows($data);
while ($R6 = mysqli_fetch_array ($data))
{
$c++;

$betno=$R6['betno'];
$ret=$R6['ret'];
$bcd=$R6['bcd'];

$open_stk=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and  main_stock.dt<'$fdt' and betno='$betno'  $godown1 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$open_stk=$R4['stck1'];
}
$in_stk=0;
$query4="Select sum(main_stock.stin) as stck1 from main_stock where pcd='$pcd'  and (main_stock.nrtn='Purchase' or main_stock.nrtn='Sale Return')  and betno='$betno' $todt  $godown1 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$in_stk=$R4['stck1'];
}

$out_stk=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Sale' or main_stock.nrtn='Purchase Return')  and betno='$betno' $todt  $godown1 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$out_stk=$R4['stck1'];
}


$tin_stk=0;
$query4="Select sum(main_stock.stin+main_stock.opst) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Receive' or main_stock.nrtn='Opening' or main_stock.nrtn='Adjustment') and betno='$betno'  $todt  $godown1 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tin_stk=$R4['stck1'];
}

$tout_stk=0;
$query4="Select sum(main_stock.stout) as stck1 from main_stock where pcd='$pcd' and (main_stock.nrtn='Transfer' or main_stock.nrtn='Opening Out' or main_stock.nrtn='Adjustment') and betno='$betno' $todt  $godown1 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$tout_stk=$R4['stck1'];
}

$close_stk=0;
$query4="Select sum(main_stock.opst+main_stock.stin-main_stock.stout) as stck1 from main_stock where pcd='$pcd' and main_stock.dt<='$tdt' and betno='$betno'  $godown1 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_stk=$R4['stck1'];
}
$it=0;
$query8="Select sum(stout) as it from ".$DBprefix."stock where pcd='$pcd' and stat='0' and betno='$betno' $godown1  group by betno";
$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$it=$R8['it'];
}
if($it=="")
{
	$it=0;
}
$to=0;
	
$to=$stkf*1;
$OP+=$open_stk;
$IN+=$in_stk;
$OUT+=$out_stk;
$TIN+=$tin_stk;
$IT+=$it;
$TOUT+=$tout_stk;
$CUR+=$close_stk;
?>

<tr onclick="hist('<?php  echo $pcd;?>','<?php  echo $betno;?>')" style="cursor:pointer;">
<td  align="center" ><?php  echo $c;?></td>   
<td  align="left" ><?php  echo $cat1;?></td>
<td  align="left" ><?php  echo $scat1;?></td>
<td  align="left" ><?php  echo $pnm;?></td>

<td  align="left"><?php  echo $betno;?></td>
<td  align="center" ><b><?php  echo $gnm;?></b></td>
<td  align="center" ><?php  echo $open_stk;?></td>
<td  align="center" ><?php  echo $in_stk;?></td>
<td  align="center" ><?php  echo $out_stk;?></td>
<td  align="center" ><?php  echo $tin_stk;?></td>
<td  align="center" ><?php  echo $it;?></td>
<td  align="center" ><?php  echo $tout_stk;?></td>
<td  align="center" ><b><?php  echo $close_stk;?></b></td>

</tr>	 
<?php 
}
}

?>
<tr style="background-color:black;">
<td colspan="6" align="right"><font color="#fff" size="3"><b>Grand Value </b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="op"><?php  echo $OP;?></span></b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="IN"><?php  echo $IN;?></span></b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="OUT"><?php  echo $OUT;?></span></b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="OUT"><?php  echo $TIN;?></span></b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="IT"><?php  echo $IT;?></span></b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="IT"><?php  echo $TOUT;?></span></b></font></td>
<td align="center"><font color="#fff" size="3"><b><span id="CUR"><?php  echo $CUR;?></span></b></font></td>
<td align="center"></td>
<td align="center"></td>
</tr>
</table>