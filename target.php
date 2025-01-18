<?php 
require("../config.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$unm=$_REQUEST['unm'];
$brand=$_REQUEST['brand'];

if($brand==""){$brand1="";}else{$brand1=" and cat='$brand'"; $brand2=" and brand='$brand'";}


$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$sper=$_REQUEST['sper'];

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
$data161= mysqli_query($conn,"SELECT * FROM main_sptarget where sl>0 and spid='$unm' $brand2 ") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data161))
{
$cat_array[]=$row161['cat'];
$spid_array[]=$row161['spid'];
}
$cat_array1=implode(',',$cat_array);
$spid_array1=implode(',',$spid_array);

?>

<div style="overflow-x:auto;">
<b><h5>SECONDARY TGT VS ACH-MTD (<?php  echo date('d-M-Y', strtotime($fdt))?> To <?php  echo date('d-M-Y', strtotime($tdt))?>)</h5></b>
<table width="100%" border="1" style="border-collapse:collapse; border: 1px solid black;font-size:.600em">
<tr>
<th>Sales Person</th>

<?php  
$data13= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and FIND_IN_SET(sl, '$cat_array1')>0 $brand1 order by sl ") or die(mysqli_error($conn));
while ($row13 = mysqli_fetch_array($data13))
{
$catnm=$row13['nm'];
?>
<th colspan="3" style="text-align:center;"><b><?php  echo $catnm;?></b></th>
<?php  }?>
<th></th>
<th></th>
<th></th>
</tr>

<tr>
<td></td>
<?php  
$i=0;
$data13= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and FIND_IN_SET(sl, '$cat_array1')>0 $brand1 order by sl") or die(mysqli_error($conn));
while ($row13 = mysqli_fetch_array($data13))
{
?>
<td><b>TGT</b></td>
<td><b>ACH</b></td>
<td><b>ACH%</b></td>
<?php  
$i=$i+3;
}?>
<td><b>TGT</b></td>
<td><b>ACH (Rs.)</b></td>

<td><b>ACH%</b></td>
</tr>


<?php  

$data12= mysqli_query($conn,"SELECT * FROM main_sale_per where sl>0 and FIND_IN_SET(spid, '$spid_array1')>0 order by sl ") or die(mysqli_error($conn));
while ($row12 = mysqli_fetch_array($data12))
{
$spid=$row12['spid'];
?>
<tr>
<td><b><?php  echo $spid;?></b></td>
<?php  
$netamm1t=0;
$blno1="";
$blno=array();
$data17= mysqli_query($conn,"SELECT * FROM main_billing where sl>0 and sale_per='$spid'  and cstat='0' $qry1 ") or die(mysqli_error($conn));
while ($row17 = mysqli_fetch_array($data17))
{
$blno[]=$row17['blno'];
}
$blno1=implode(",",$blno);

$catsl="";
$netamm=0;
$data15= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and FIND_IN_SET(sl, '$cat_array1')>0 $brand1 order by sl ") or die(mysqli_error($conn));
while ($row15 = mysqli_fetch_array($data15))
{
		$catsl=$row15['sl'];
		$tgt=0;
		$data16= mysqli_query($conn,"SELECT * FROM main_sptarget where sl>0 and cat='$catsl' and spid='$spid'") or die(mysqli_error($conn));
		while ($row16 = mysqli_fetch_array($data16))
		{
			$tgt=$row16['tgt'];
		}
			
	$ach=0;
		$netamm1=0;
		$data18= mysqli_query($conn,"SELECT sum(pcs) as ach, sum(net_am) as netamm  FROM main_billdtls where sl>0 and scat='$catsl' and find_in_set(blno,'$blno1')>0") or die(mysqli_error($conn));
		while ($row18 = mysqli_fetch_array($data18))
		{
			$ach=$row18['ach'];
			$netamm1=$row18['netamm'];
		}
		if($ach==''){ $ach=0;}
		
		if($tgt>0){
			$achper=round($ach*100/$tgt,2);
		}else{
			$achper=0;
		}
		
		
	
?>
<td><?php  echo $tgt;?></td>
<td><?php  echo $ach;?></td>
<td><?php  echo $achper;?> %</td>
<?php  
$netamm=$netamm+$netamm1;
}
$target=0;
$data21s= mysqli_query($conn,"SELECT * FROM main_sp_target where sl>0 and spid='$spid' ") or die(mysqli_error($conn));
while ($row21 = mysqli_fetch_array($data21s))
{
$starget=$row21['starget'];
}
if($starget>0){
$sachp=round($netamm*100/$starget,2);
}else{
$sachp=0;
}
?>
<td align="right"><?php  echo $starget;?></td>
<td align="right"><?php  echo $netamm;?></td>
<td align="right"><?php  echo $sachp;?></td>
</tr>
<?php 
$netamm1t+=$netamm;
 }?>
<tr>
<td colspan="<?php  echo $i+1;?>" align="right">
<b>Total : </b>

</td>
<td>
</td>
<td align="right">
<b><?php  echo $netamm1t;?></b>
</td>
<td>
</td>
</tr>
</table>
</div>

<?php 
$spid_array=array('');
$data161= mysqli_query($conn,"SELECT * FROM main_sp_target where sl>0 and target>0  and spid='$unm'") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data161))
{
$spid_array[]=$row161['spid'];
}

$spid_array1=implode(',',$spid_array);
if($brand!=""){
$spid_array_b=array('');
$data1611= mysqli_query($conn,"SELECT * FROM main_slp_brnd where sl>0 and FIND_IN_SET('$brand', catsl)>0 and spsl='$unm'") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data1611))
{
$spid_array_b[]=$row161['spsl'];
}
$spid_array2=implode(',',$spid_array_b);
$var=" and FIND_IN_SET(spid, '$spid_array2')";
}
?>
<br>
<br>
<br>
<div>
<b><h5>COLLECTION TGT VS ACH-MTD</h5></b>
<table   border="1" style="border-collapse:collapse; border: 1px solid black;font-size:.700em;" align="left">
<tr>
<th><b>Sales Person</b></th>
<th><b>TGT</b></th>
<th ><b>ACH</b></th>
<th><b>ACH%</b></th>
</tr>
<?php  

$netamm=0;
$data121= mysqli_query($conn,"SELECT * FROM main_sale_per where sl>0 and FIND_IN_SET(spid, '$spid_array1')>0 $var order by sl") or die(mysqli_error($conn));
while ($row12 = mysqli_fetch_array($data121))
{
$spid=$row12['spid'];
?>
<tr>
<td><b><?php  echo $spid;?></b></td>
<?php  


		$target=0;
		$data21= mysqli_query($conn,"SELECT * FROM main_sp_target where sl>0 and spid='$spid' ") or die(mysqli_error($conn));
		while ($row21 = mysqli_fetch_array($data21))
		{
			$target=$row21['target'];
		}
		if($target==''){ $target=0;}	
		

		$netamm1=0;
		$data18= mysqli_query($conn,"SELECT sum(amm) as tamm FROM main_drcr where sl>0 and typ='77' and (cldgr='4' or cldgr='7') and dldgr!='5' and dldgr!='7' and sman='$spid'  $qry1") or die(mysqli_error($conn));
		while ($row18 = mysqli_fetch_array($data18))
		{
		
			$netamm1=$row18['tamm'];
		}
		if($netamm1==''){ $netamm1=0;}
		
		if($target>0){
			$achper1=round($netamm1*100/$target,2);
		}else{
			$achper1=0;
		}
		
		
	
?>
<td><?php  echo $target;?></td>
<td align="right"><?php  echo $netamm1;?></td>
<td><?php  echo $achper1;?> %</td>
</tr>
<?php  
$netamm+=$netamm1;
}?>
<tr>
<td colspan="2" align="right">
<b>Total : </b>

</td>
<td align="right">
<b><?php  echo $netamm;?></b>
</td>
<td >

</td>
</tr>
</table>
</div>
