<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$brand2="";
$find_in_cat="";
$var="";
$brand=$_REQUEST['brand'];
ini_set('max_execution_time', 0);
if($brand==""){$brand1="";}else{$brand1=" and cat='$brand'"; $brand2=" and brand='$brand'"; $find_in_cat=" and find_in_set('$brand',brand)>0";}


$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$sper=$_REQUEST['sper'] ?? "";

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
$data161= mysqli_query($conn,"SELECT * FROM main_sptarget where sl>0 and tgt>0 $brand2 ") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data161))
{
$cat_array[]=$row161['cat'];
$spid_array[]=$row161['spid'];
}
$cat_array1=implode(',',$cat_array);
$spid_array1=implode(',',$spid_array);

?>
<div style="overflow-x:auto;">
<b><span style="float:left"><h5>SECONDARY TGT VS ACH-MTD (<?php  echo date('d-M-Y', strtotime($fdt))?> To <?php  echo date('d-M-Y', strtotime($tdt))?>)</h5></span></b>
<table width="100%"  class="table table-bordered">
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
$no_of_scat=mysqli_num_rows($data13);
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
$s=0;
$array_target=array();
$array_ach=array();
$array_achper=array();
$target=0;
$starget1=0;
$netamm1t=0;
$sachp1=0;
$data12= mysqli_query($conn,"SELECT * FROM main_sale_per where sl>0 and FIND_IN_SET(spid, '$spid_array1')>0 order by sl ") or die(mysqli_error($conn));
$no_of_salesperson=mysqli_num_rows($data12);
while ($row12 = mysqli_fetch_array($data12))
{
$spid=$row12['spid'];
$nm=$row12['nm'];
?>
<tr>
<td><b><?php  echo $nm;?></b></td>
<?php  

$blno1="";
$blno=array();
$data17= mysqli_query($conn,"SELECT * FROM main_billing where sl>0 and sale_per='$spid' and cstat='0' $qry1 ") or die(mysqli_error($conn));
while ($row17 = mysqli_fetch_array($data17))
{
$blno[]=$row17['blno'];
}
$blno1=implode(",",$blno);

$catsl="";
$netamm=0;
$k=0;
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
		$data18= mysqli_query($conn,"SELECT sum(pcs) as ach, sum(net_am) as netamm  FROM main_billdtls where sl>0 and scat='$catsl' and can='0' and find_in_set(blno,'$blno1')>0") or die(mysqli_error($conn));
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
$array_target[$s][$k]=$tgt;
$array_ach[$s][$k]=$ach;
$array_achper[$s][$k]=$achper;
$k++;
}

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

$s++;
$starget1+=$starget;
$netamm1t+=$netamm;
$sachp1+=$sachp;
}?>
<tr>
<td  align="right">
<b>Total : </b>

</td>
<?php 
$array_target_final=array();
$array_ach_final=array();
$array_achper_final=array();
for($y=0;$y<$no_of_scat;$y++)
{
$val_target=0;
$val_ach=0;
$val_achper=0;
for($x=0;$x<$no_of_salesperson;$x++)
{
	$val_target+=$array_target[$x][$y];
	$val_ach+=$array_ach[$x][$y];
	$val_achper+=$array_achper[$x][$y];	
}

$array_target_final[$y]=$val_target;
$array_ach_final[$y]=$val_ach;
$array_achper_final[$y]=round((($val_ach*100)/$val_target),2);
}

for($j=0;$j<$no_of_scat;$j++)
{
?>
<td>
<b><?php  echo $array_target_final[$j];?></b>
</td>
<td>
<b><?php  echo $array_ach_final[$j];?></b>
</td>
<td>
<b><?php  echo $array_achper_final[$j];?></b>
</td>

<?php 
}
?>

<td>
<b><?php  echo $starget1;?></b>
</td>
<td align="right">
<b><?php  echo $netamm1t;?></b>
</td>
<td>
<b><?php  echo round($netamm1t*100/$starget1,2);?></b>
</td>
</tr>
</table>
</div>

<?php 

$da1= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='77' and tp='2'  and stat='0' $find_in_cat ");
while ($rw1 = mysqli_fetch_array($da1))
{	
$bsl1=$rw1['sl'];
$bslar[]=$bsl1;
}
$ld=implode(",",$bslar);

$spid_array=array('');
$data161= mysqli_query($conn,"SELECT * FROM main_sp_target where sl>0 and target>0 ") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data161))
{
$spid_array[]=$row161['spid'];
}

$spid_array1=implode(',',$spid_array);
if($brand!=""){
$spid_array_b=array('');
$data1611= mysqli_query($conn,"SELECT * FROM main_slp_brnd where sl>0 and FIND_IN_SET('$brand', catsl)>0") or die(mysqli_error($conn));
while ($row161 = mysqli_fetch_array($data1611))
{
$spid_array_b[]=$row161['spsl'];
}
$spid_array2=implode(',',$spid_array_b);
$var=" and FIND_IN_SET(spid, '$spid_array2')";
}
?>
<b><span style="float:left"><h4>COLLECTION TGT VS ACH-MTD</h4></span></b><br>
<div>

<table  class="table table-bordered" style="width:60%;" align="left">
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
$nm=$row12['nm'];
?>
<tr>
<td><b><?php  echo $nm;?></b></td>
<?php  


		$target=0;
		$data21= mysqli_query($conn,"SELECT * FROM main_sp_target where sl>0 and spid='$spid' ") or die(mysqli_error($conn));
		while ($row21 = mysqli_fetch_array($data21))
		{
			$target=$row21['target'];
		}
		if($target==''){ $target=0;}	
		

		$netamm1=0;
		$data18= mysqli_query($conn,"SELECT sum(amm) as tamm FROM main_drcr where sl>0 and (typ='77' or typ='ADV77') and (cldgr='4' or cldgr='7') and dldgr!='5' and dldgr!='7' and sman='$spid'  and find_in_set(bill_typ,'$ld')>0  $qry1") or die(mysqli_error($conn));
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