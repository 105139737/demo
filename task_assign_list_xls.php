<?php
$reqlevel = 3;
include("membersonly.inc.php");
$file="task_assign_list.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

$data= mysqli_query($conn,"select * from  main_task where sl IN (
    SELECT MAX(sl)
    FROM main_task
	group by spid,day
)  order by spid")or die(mysqli_error($conn));
?>
<table  border="1"  >

<tr>
<th style="text-align:left">Customer Name</font></th>
<th style="text-align:left">Sales Person ID</font></th>
<th style="text-align:left">Sales Person Name</font></th>
<th style="text-align:left">Days</font></th>

</tr>
<?
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
	


?>
	<tr>	
	<td align="left" style="valign:top"><? echo $row13['nm']; ?></td>
	<td align="left" style="valign:top"><? echo $spid2;?></td>
	<td align="left" style="valign:top"><? echo $spid_name;?></td>   
	<td align="left" style="valign:top"><? echo $day;?></td>
	</tr>	 
<?
}
}
?>
</table>
