<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$brand=$_REQUEST['brand'];
set_time_limit(0);
if($brand==""){$brand1="";}else{$brand1=" and cat='$brand'"; $brand2=" and brand='$brand'"; $find_in_cat=" and find_in_set('$brand',brand)>0";}



$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$sper=$_REQUEST['sper'] ?? "";
$spid=$_REQUEST['spid'];
$yr=$_REQUEST['yr'];
$mnth=$_REQUEST['mnth'];
$mnth=str_pad($mnth, 2, '0', STR_PAD_LEFT);	
if($spid!=''){$spid1=" and spid='$spid'";}

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
$qry1=" and (dt between '$fdt' and '$tdt')";
}
$cat_array=array('');
$spid_array=array('');
$data161= mysqli_query($conn,"SELECT * FROM main_sptarget where sl>0 $brand2 $spid1") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data161))
{
$cat_array[]=$row161['cat'];
$spid_array[]=$row161['spid'];
}
$cat_array1=implode(',',$cat_array);
$spid_array1=implode(',',$spid_array);

$pmonth=date('M(y)', strtotime(($yr-1)."-".$mnth."-01"));
$month=date('M(y)', strtotime($yr."-".$mnth."-01"));

$pdt=($yr-1)."-".$mnth;
$ccdt=$yr."-".$mnth;

$data17= mysqli_query($conn,"SELECT * FROM main_billing where sl>0 and cstat='1' and cu='0' and ( dt like '$pdt%' or  dt like '$ccdt%') ") or die(mysqli_error($conn));
while ($row17 = mysqli_fetch_array($data17))
{
$blno=$row17['blno'];
$data13= mysqli_query($conn,"update main_billdtls set can='1' where blno='$blno'  ") or die(mysqli_error($conn));
$data13= mysqli_query($conn,"update main_billing set cu='1' where blno='$blno'  ") or die(mysqli_error($conn));
}


$file="Target_".$pmonth."_To_".$month.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file");
?>
<div style="overflow-x:auto;">
<table border="1"  class="table table-bordered">
<tr>
<th rowspan="2">SALESMAN</th>
<th rowspan="2">SUBDEALERS NAME</th>

<?php  
$data13= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and FIND_IN_SET(sl, '$cat_array1')>0 $brand1 order by sl ") or die(mysqli_error($conn));
while ($row13 = mysqli_fetch_array($data13))
{
$catnm=$row13['nm'];
?>
<th colspan="3" style="text-align:center;"><b><?php  echo $catnm;?></b></th>
<?php  }?>
<th colspan="3" style="text-align:center;"><b>TOT BILL VALUE</b></th>
<th colspan="3" style="text-align:center;"><b>TOT COLLECTION</b></th>
</tr>
<tr>
<?php  
$i=0;
$data13= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and FIND_IN_SET(sl, '$cat_array1')>0 $brand1 order by sl") or die(mysqli_error($conn));
while ($row13 = mysqli_fetch_array($data13))
{
	
?>
<td><b><?php  echo $pmonth;?></b></td>
<td><b><?php  echo $month;?></b></td>
<td><b>ACH</b></td>
<?php  
$i=$i+3;
}?>
<td><b><?php  echo $pmonth;?></b></td>
<td><b><?php  echo $month;?></b></td>
<td><b>ACH</b></td>

<td><b><?php  echo $pmonth;?></b></td>
<td><b><?php  echo $month;?></b></td>
<td><b>ACH</b></td>

</tr>
<?php 

$data12= mysqli_query($conn,"SELECT * FROM main_cust_asgn where sl>0 and FIND_IN_SET(spid, '$spid_array1')>0 and spid!='' order by spid ") or die(mysqli_error($conn));
while ($row12 = mysqli_fetch_array($data12))
{
$spid=$row12['spid'];
$cust=$row12['cust'];

$data13= mysqli_query($conn,"SELECT * FROM main_cust where sl>0 and FIND_IN_SET(sl, '$cust')>0 $brand2 order by nm ") or die(mysqli_error($conn));
while ($row13 = mysqli_fetch_array($data13))
{
$cust_nm=$row13['nm'];
$cust_sl=$row13['sl'];

?>
<tr>
<td><?php  echo $spid;?></td>
<td><?php  echo $cust_nm;?></td>
<?php  
$i=0;
$this_netamm1=0;
$pnetamm1=0;
$data131= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and FIND_IN_SET(sl, '$cat_array1')>0 $brand1 order by sl") or die(mysqli_error($conn));
while ($row131 = mysqli_fetch_array($data131))
{
$catsl=$row131['sl'];	

$pqty=0;
$pnetamm=0;
$this_netamm=0;
$this_month=0;
$pdt=($yr-1)."-".$mnth;
$ccdt=$yr."-".$mnth;
$data18= mysqli_query($conn,"SELECT sum(pcs) as pqty, sum(net_am) as netamm  FROM main_billdtls where sl>0 and scat='$catsl' and cust='$cust_sl' and dt like '$pdt%'  and can='0'") or die(mysqli_error($conn));
while ($row18 = mysqli_fetch_array($data18))
{
$pqty=$row18['pqty'];
$pnetamm=$row18['netamm'];
}
$qty=0;
$data181= mysqli_query($conn,"SELECT sum(pcs) as pqty, sum(net_am) as netamm  FROM main_billdtls where sl>0 and scat='$catsl' and cust='$cust_sl' and dt like '$ccdt%'  and can='0'") or die(mysqli_error($conn));
while ($row181 = mysqli_fetch_array($data181))
{
$qty=$row181['pqty'];
$this_netamm=$row181['netamm'];
}
$data16= mysqli_query($conn,"SELECT * FROM main_sptarget where sl>0 and cat='$catsl' and spid='$spid'") or die(mysqli_error($conn));
while ($row16 = mysqli_fetch_array($data16))
{
$target_per=$row16['target_per'];
}
$this_month=$pqty+(($pqty*$target_per)/100);
?>
<td><b><?php  echo $pqty;?></b></td>
<td><b><?php  echo $this_month;?></b></td>
<td><b><?php  echo $qty;?></b></td>
<?php  
$pnetamm1+=$pnetamm;
$this_netamm1+=$this_netamm;
$i=$i+3;
}
$this_val=$pnetamm1+(($pnetamm1*$target_per)/100);
?>
<td><b><?php  echo $pnetamm1;?></b></td>
<td><b><?php  echo $this_val;?></b></td>
<td><b><?php  echo $this_netamm1;?></b></td>
<?php 
$p_coll=0;
$data184= mysqli_query($conn,"SELECT sum(amm) as tamm FROM main_drcr where sl>0 and typ='77' and (cldgr='4' or cldgr='7') and dldgr!='5' and dldgr!='7' and cid='$cust_sl' and  dt like '$pdt%'") or die(mysqli_error($conn));
while ($row18 = mysqli_fetch_array($data184))
{
$p_coll=$row18['tamm'];
}
$coll=0;
$data185= mysqli_query($conn,"SELECT sum(amm) as tamm FROM main_drcr where sl>0 and typ='77' and (cldgr='4' or cldgr='7') and dldgr!='5' and dldgr!='7' and cid='$cust_sl' and  dt like '$ccdt%'") or die(mysqli_error($conn));
while ($row18 = mysqli_fetch_array($data185))
{
$coll=$row18['tamm'];
}
$this_col=$p_coll+(($p_coll*$target_per)/100);
?>
<td><b><?php  echo $p_coll;?></b></td>
<td><b><?php  echo $this_col;?></b></td>
<td><b><?php  echo $coll;?></b></td>

</tr>

<?php 
}
}
?>
</table>
</div>