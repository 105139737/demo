<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$yr=$_REQUEST['yr'];
$fdt=$yr.'-01-01';
$tdt=$yr.'-12-31';
$data= mysqli_query($conn,"select * from main_task where sl IN 
( SELECT MAX(sl) FROM main_task group by spid,day ) and `dt` BETWEEN '$fdt' AND '$tdt' ORDER BY `main_task`.`spid` ASC")or die(mysqli_error($conn));
$file="task_assign_list.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>
<table  border="1"  >

<tr>
<th style="text-align:left">Brand</font></th>
<th style="text-align:left">Customer Name</font></th>
<th style="text-align:left">Current Sales Person ID</font></th>
<th style="text-align:left">Current Sales Person Name</font></th>
<th style="text-align:left">Sales Person ID</font></th>
<th style="text-align:left">Sales Person Name</font></th>
<th style="text-align:left">Days</font></th>

</tr>
<?php 
while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$spid=$row['spid'];
$cust=$row['cust'];
$day=$row['day'];
$dt=$row['dt'];

$sln++;
$sl++; 

$spid2="";
$spid_name="";
$data1 = mysqli_query($conn,"Select * from main_sale_per where spid='$spid'");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$spid2=$row1['spid'];
	$spid_name=$row1['nm'];
	}
	
	$cnt=0;
	$csl="";
	$cnm="";

	$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust')");
	while ($row13 = mysqli_fetch_array($data13))
	{
		
	$cnt++;	
	$cust_sl=$row13['sl'];
	$color="";
	if($custm==$cust_sl){$color="red";}
	$cnm="<font color='$color'>".$row13['nm']."</font>";
	if($csl=="")
	{
	 $csl=$cnt.") ".$cnm;	
	}
	else
	{
	$csl=$csl." <br/> ".$cnt.") ".$cnm;
	}
	
$brand=$row13['brand'];
$cnm="";
$data15 = mysqli_query($conn,"Select * from main_catg where sl='$brand'");
while ($row135 = mysqli_fetch_array($data15))
{
	$cnm=$row135['cnm'];
}
$current_spid="";
$current_spid_name="";
$data155 = mysqli_query($conn,"Select * from main_cust_asgn where FIND_IN_SET('$cust_sl',cust) and typ='0' order by sl desc limit 0,1");
while ($row135 = mysqli_fetch_array($data155))
{
	$current_spid=$row135['spid'];
	$data122 = mysqli_query($conn,"Select * from main_sale_per where spid='$current_spid'");
    while ($row12 = mysqli_fetch_array($data122))
	{
	$current_spid_name=$row12['nm'];
	}
}
?>
	<tr>
	 <td align="left" style="valign:top"><?php  echo $cnm; ?></td>   	
	<td align="left" style="valign:top"><?php  echo $row13['nm']; ?></td>
	<td align="left" style="valign:top"><?php  echo $current_spid;?></td>
	<td align="left" style="valign:top"><?php  echo $current_spid_name;?></td>
	<td align="left" style="valign:top"><?php  echo $spid2;?></td>
	<td align="left" style="valign:top"><?php  echo $spid_name;?></td>   
	<td align="left" style="valign:top"><?php  echo $day;?></td>
	</tr>	 
<?php 
}
}
?>
</table>
