<?php 
$reqlevel = 3; 

include("membersonly.inc.php");
include("function.php");
$total_damm=0;
$total_net=0;
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pr_nm=$_REQUEST['prnm'] ?? "";
$tp1=$_REQUEST['tp1'] ?? "";
$gst_no=$_REQUEST['gstin'] ?? "";
$godown=$_REQUEST['godown'] ?? "";
$stat=$_REQUEST['stat'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";
$val=$_REQUEST['val'] ?? "";

$cat=$_REQUEST['cat'] ?? "";
$scat=$_REQUEST['scat'] ?? "";
$sale_per=$_REQUEST['sale_per'] ?? "";
$btyp=rawurldecode($_REQUEST['btyp'] ?? "");
$btyp=str_replace("@","'",$btyp);

if($btyp==""){$btyp1="";}else{$btyp1=" and ($btyp)";}

if($sale_per==""){$sale_per1="";}else{$sale_per1=" and sale_per='$sale_per'";}
if($scat==""){$scat1="";}else{$scat1=" and scat='$scat'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
if($gst_no=="1"){$gst_no1=" and gstin!=''";}if($gst_no=="2"){$gst_no1=" and gstin=''";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
if($pr_nm!=""){$pr_nm1=" and prsl='$pr_nm'";}else{$pr_nm1="";}
if($tp1!=""){$tp11=" and cust_typ='$tp1'";}else{$tp11="";}
if($stat!=""){$cstat1=" and cstat='$stat'";}else{$cstat1="";}

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

$dis1=0;
$gst_no1="";
if($val=='1')
{
$file="Sale_Summary.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
$broder="border='1'";
}





?>

 <table  <?php if($val==1){?>width="70%"<?php }else{?>width="100%"<?php }?> class="advancedtable"  border="1">
<tr bgcolor="000">
<td colspan="12" align="center">

<font size="5" color="#fff">Sale Details</font>

</td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>ALS</b></td>
			<td  align="center" ><b>Date</b></td>
			<td  align="center"><b>Branch</b></td>
			<td  align="center"><b>Sales Person</b></td>
			<td  align="center" ><b>Invoice</b></td>
			<td  align="center" ><b>Customer Name</b></td>
			<td  align="center" ><b>Type</b></td>
			<td  align="center" ><b>GSTIN</b></td>
			<td  align="center" ><b>BILL VALUE</b></td>
			<td  align="center" ><b>Discount</b></td>
			<td  align="center" ><b>Net Value</b></td>
			</tr>
			 <?php 
$sln=0;
$total=0;
$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$todts.$snm1.$brncd1.$gst_no1.$tp11.$cstat1.$sale_per1.$btyp1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$vatamm=$row1['vatamm'];
$car=$row1['car'];
$sid=$row1['cid'];
$invto=$row1['invto'];
$pdts=$row1['pdts'];
$dis=$row1['dis'];
$paid=$row1['paid'];
$gstin=$row1['gstin'];
$cust_typ=$row1['cust_typ'];
$cstat=$row1['cstat'];
$als=$row1['als'];
$bcd=$row1['bcd'];
$sale_per=$row1['sale_per'];
$damm=$row1['damm'];

$amm=round($row1['amm'],0);
$cust_typp=get_typ($cust_typ);
if($car==""){$car=0;}
if($dis==""){$dis=0;}
$dt=date('d-m-Y', strtotime($dt));
$sln++;
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}
$invnm="";
$datad1= mysqli_query($conn,"select * from main_cust where sl='$invto'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$invnm="(".$rowd['nm'].")";
}
$total+=$amm;
$total_damm+=$damm;
$net=$amm-$damm;
$total_net+=$net;
$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'")or die(mysqli_error($conn));
$count=mysqli_num_rows($data);
$color="";
if($count==0){$color="red";}
?>		
<tr bgcolor="<?php  echo $color;?>">
<td  align="center" ><?php  echo $sln;?></td>
<td  align="left" ><?php  echo $als;?></td>
<td  align="center" ><?php  echo $dt;?></td>
<td  align="left" ><?php echo get_branch_name($bcd);?></td>
<td  align="left" ><?php  echo $sale_per;?></td>
<td  align="left" ><a href="bill_new_gst.php?blno=<?php  echo $blno;?>" target="_blank"><?php  echo $blno;?></td>
<td  align="left" ><a href="bill_new_gst.php?blno=<?php  echo $blno;?>&typ=1" target="_blank"><?php  echo $nm;?> <b><?php  echo $invnm;?></b></a></td>
<td  align="left" ><a href="#" onclick="edit('<?php  echo $blno;?>')"<?php  echo $cust_typp;?></a></td>
<td  align="left" ><?php  echo $gstin;?></td>
<td  align="right" ><?php echo number_format($amm,2);?></td>
<td  align="right" ><?php echo number_format($damm,2);?></td>
<td  align="right" ><?php echo number_format($net,2);?></td>
</tr>	 
<?php 
}
?>
<tr>

<td  align="right" COlspan="9" ><b>Total:</b></td>
<td  align="right" ><b><?php echo number_format($total,2);?></b></td>
<td  align="right" ><b><?php echo number_format($total_damm,2);?></b></td>
<td  align="right" ><b><?php echo number_format($total_net,2);?></b></td>
</tr>
</table>

