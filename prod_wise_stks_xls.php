<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
 
$cy=date('Y');
$pnm=$_REQUEST['pnm'] ?? "";
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$dt=$_REQUEST['dt'];
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$cat1="";
if($catsl!=""){$cat1=" and cat='$catsl'";}
$scat1="";
if($scatsl!=""){$scat1=" and scat='$scatsl'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}

$dt=date('Y-m-d', strtotime($dt));	

$querys="Select * from ".$DBprefix."branch where sl='$brncd'";
$results = mysqli_query($conn,$querys);
while ($Rs = mysqli_fetch_array ($results))
{
$branchnm=$Rs['bnm'];
}
$jobLink=CreateNewJob('jobs/prod_wise_stks_xls.php',$user_currently_loged,'Model Wise Stock Statement',$conn);
?>
<script language="javascript">
alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
window.history.go(-1);
</script>
<?php 
die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');

$file="Product Wise Stock Details As on ".$dt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?> 
<table  class="table table-hover table-striped table-bordered" border="1">
<tr>
<td  align="center" colspan="7">
<b>Model Wise Stock Statement </b><br>
<font style="font-size:18px;font-family:Century"><b><?php  echo $comp_nm;?> - <?php  echo $branchnm;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><?php  echo $comp_addr;?><br>
Phone : <?php  echo $cont;?>
</font><br/>
<font style="font-size:13px;">GSTIN NO. : <?php  echo $gstin?></font><br>
<font style="font-size:14px;"><b>Statement As On : <?php  echo $dt;?></b></font>
</td>
</tr>
 
<tr>
<td align="left"><b>Sl</b></td>
<td align="left"><b>Brand</b></td>
<td align="left"><b>Category</b></td>
<td align="left"><b>HSN</b></td>
<td align="left"><b>Model Name</b></td>
<td align="left"><b>Model Code</b></td>
<td align="left"><b>Current Stock</b></td>

</tr>
<?php 
$stk_val=0;
$stk_val_gst=0;
$Tot_stk_val=0;
$Tot_stk_val_gst=0;

$sl=$start;
$sln=0;

$data=mysqli_query($conn,"select * from main_product where sl>0 and typ='0' $cat1  $scat1  $all1 order by pnm")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
$sl++;
$pcd=$row['sl'];
$unit=$row['unit'];
$nm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];
$hsn=$row['hsn'];
$pcode=$row['pcd'];
$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
$sun=$roww['sun'];
}
$stk_rate=0;
$rate=0;

$sln++;
$stck=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd'  and dt<='$dt'".$brncd1." group by pcd  ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}


$stkf=$stck;
if($stkf==""){$stkf=0;}
$stock_close=$stkf." ".$sun;
$stk_val=$rate*$stkf;
$stk_val_gst=$stk_rate*$stkf;

?>
<tr title="<?php  echo $pcd;?>, Stocksl :<?php  echo $ssl;?>">
<td  align="center" ><?php  echo $sln;?></td>
<td  align="left" ><?php  echo $cnm;?></td>
<td  align="left"><?php  echo $scat_nm;?></td>
<td  align="left"><?php  echo $hsn;?></td>
<td  align="left"><?php  echo $nm;?></td>
<td  align="left"><?php  echo $pcode;?></td>
<td  align="left" ><?php  echo $stock_close;?></td>


</tr>	 
<?php 
$stkf=0;
$Tot_stk_val+=$stk_val;
$Tot_stk_val_gst+=$stk_val_gst;
}
?>

</table>
