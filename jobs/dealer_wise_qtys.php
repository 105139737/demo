<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("memory_limit", "-1");
set_time_limit(0);
include("../config.php");
include("../function.php");
date_default_timezone_set('Asia/Kolkata');
$sper="";
$brand=$_REQUEST['brand'];
$scat=$_REQUEST['scat'];
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
if(isset($_REQUEST['sper']))
{
$sper=$_REQUEST['sper'];
}
$xls=$_REQUEST['xls'];
$cust=$_REQUEST['cust'];
$prnm=$_REQUEST['prnm'];


if($fdt=="" or $tdt=="")
{ 
echo 'Please Enter Valid Date Range.';
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$qry1=" and (main_billdtls.dt between '$fdt' and '$tdt')";
}
set_time_limit(0);

if($xls=='1'){
ob_start();
/*
$file="dealer_wise_qty.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	*/
}
$cust1="";
$netamm1t=0;
if($cust!=""){$cust1=" and  FIND_IN_SET(cont, '$cust')>0";}
?>
<div style="overflow-x:auto;">
<table <?php if($xls=='1'){?> border="1" <?}else{?> width="100%" <?php }?> class="table table-bordered">
<tr>
<th>Customer</th>
<th>Mobile No.</th>

<?php 
$table_name="main_scat";
$field="nm";
$query_field="main_billdtls.scat";
if($prnm!='')
{
$table_name="main_product";
$field="pnm";
$query_field="main_billdtls.prsl";
$scat=$prnm;
}
$data13= mysqli_query($conn,"SELECT * FROM $table_name where sl>0 and FIND_IN_SET(sl, '$scat')>0  order by $field ") or die(mysqli_error($conn));
while ($row13 = mysqli_fetch_array($data13))
{
$catnm=$row13[$field];
?>
<th style="text-align:center;"><b><?php echo $catnm;?></b></th>
<?php }?>
<th>Total Qty</th>
<th>Taxable Am.</th>
<th>Net Am.</th>
</tr>


<?php 
// ---------------------Retail Sale Detils------------------
$data12= mysqli_query($conn,"SELECT * FROM main_branch where sl>0  order by bnm ") or die(mysqli_error($conn));
while ($row12 = mysqli_fetch_array($data12))
{
$nm=$row12['bnm'];
$cont=$row12['bcnt'];
$bcd=$row12['sl'];
?>
<tr>
<td><b><?php echo $nm;?></b></td>
<td><b><?php echo $cont;?></b></td>
<?php 
$netamm1=0;
$tamm1=0;
$pcs1=0;
$blno1="";

$catsl="";
$netamm=0;
$data15= mysqli_query($conn,"SELECT * FROM $table_name where sl>0 and FIND_IN_SET(sl, '$scat')>0   order by $field  ") or die(mysqli_error($conn));
while ($row15 = mysqli_fetch_array($data15))
{
$catsl=$row15['sl'];		
$pcs=0;
$netamm=0;
$tamm=0;
$data18= mysqli_query($conn,"SELECT sum(main_billdtls.pcs) as pcs, sum(main_billdtls.net_am) as netamm, sum(main_billdtls.tamm) as tamm FROM main_billdtls  INNER JOIN main_billing ON main_billing.blno=main_billdtls.blno where main_billdtls.sl>0 and $query_field='$catsl' and main_billing.tp='1' and main_billing.cstat='0' and main_billing.bcd='$bcd' $qry1") or die(mysqli_error($conn));
while ($row18 = mysqli_fetch_array($data18))
{
$pcs=$row18['pcs'];
$netamm=$row18['netamm'];
$tamm=$row18['tamm'];
}
	
	
?>
<td><?php echo $pcs;?></td>
<?php 
$netamm1+=$netamm;
$tamm1+=$tamm;
$pcs1+=$pcs;
}
?>
<td align="right"><?php echo $pcs1;?></td>
<td align="right"><?php echo $tamm1;?></td>
<td align="right"><?php echo $netamm1;?></td>
</tr>
<?php 

}
// ---------------------Whole Sale Detils------------------
$data12= mysqli_query($conn,"SELECT * FROM main_cust where sl>0  and brncd='1' and  FIND_IN_SET(brand, '$brand')>0 $cust1 group by cont order by nm ") or die(mysqli_error($conn));
while ($row12 = mysqli_fetch_array($data12))
{
$nm=$row12['nm'];
$cont=$row12['cont'];
?>
<tr>
<td><b><?php echo $nm;?></b></td>
<td><b><?php echo $cont;?></b></td>
<?php 
$netamm1=0;
$tamm1=0;
$pcs1=0;
$blno1="";
$cust=array();
$data17= mysqli_query($conn,"SELECT * FROM main_cust where sl>0 and cont='$cont' and FIND_IN_SET(brand, '$brand')>0  ") or die(mysqli_error($conn));
while ($row17 = mysqli_fetch_array($data17))
{
$cust[]=$row17['sl'];
}
$cust=implode(",",$cust);

$catsl="";
$netamm=0;
$data15= mysqli_query($conn,"SELECT * FROM $table_name where sl>0 and FIND_IN_SET(sl, '$scat')>0   order by $field  ") or die(mysqli_error($conn));
while ($row15 = mysqli_fetch_array($data15))
{
$catsl=$row15['sl'];		
$pcs=0;
$netamm=0;
$tamm=0;
$data18= mysqli_query($conn,"SELECT sum(main_billdtls.pcs) as pcs, sum(main_billdtls.net_am) as netamm, sum(main_billdtls.tamm) as tamm FROM main_billdtls  INNER JOIN main_billing ON main_billing.blno=main_billdtls.blno where main_billdtls.sl>0 and $query_field='$catsl' and main_billing.tp='2' and main_billing.cstat='0' and find_in_set(main_billdtls.cust,'$cust')>0 $qry1") or die(mysqli_error($conn));
while ($row18 = mysqli_fetch_array($data18))
{
$pcs=$row18['pcs'];
$netamm=$row18['netamm'];
$tamm=$row18['tamm'];
}
	
	
?>
<td><?php echo $pcs;?></td>
<?php 
$netamm1+=$netamm;
$tamm1+=$tamm;
$pcs1+=$pcs;
}
?>
<td align="right"><?php echo $pcs1;?></td>
<td align="right"><?php echo $tamm1;?></td>
<td align="right"><?php echo $netamm1;?></td>
</tr>
<?php 
$netamm1t+=$netamm;
}?>



</table>
</div>
<?php
if($xls=='1')
{
$imgbinary = ob_get_clean();
$filename="jobs_report/".$_GET['file_name'].".xls";
file_put_contents($filename, $imgbinary);
}
?>

