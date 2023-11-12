<?php
$reqlevel = 3;
include("membersonly.inc.php");

$sl=0;
?>
<table border="0" width="100%" class="advancedtable">
<?
$result100=mysqli_query($conn,"SELECT * FROM main_tech_trntemp where eby='$user_currently_loged' order by sl");
$cnt=mysqli_num_rows($result100);
while($R100=mysqli_fetch_array($result100))
{
	$tsl=$R100['sl'];
	$pnm=$R100['pnm'];
	$pcd=$R100['pcd'];
	$qnty=$R100['qnty'];

	$result56 = mysqli_query($conn,"Select * from ".$DBprefix."parts where sl='$pcd'");
	while ($R56 = mysqli_fetch_array ($result56))
	{
		$pnm1=$R56['pnm'];
		$bnm1=$R56['bnm'];
		$cat1=$R56['cat'];
		$cnm="";
	}
	
	$data1= mysqli_query($conn,"select * from main_catg where sl='$cat1'")or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data1))
	{
		$cnm=$row1['cnm'];
	}

	$brand="";
	$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm1'")or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data2))
	{
		$brand=$row1['brand'];
	}
?>
<tr class="odd">
<td align="center" width="30%"><b><?=$pnm;?> - <?=$cnm;?> - <?=$brand;?></b></td>
<td align="center" width="20%"><b><?=$qnty;?></b></td>
<td align="center" width="10%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?=$tsl;?>')}"><font color="red">Delete</font></a></b></td>
</tr>
<?
}

	$query1="SELECT sum(qnty) as qtyttl FROM main_tech_trntemp where eby='$user_currently_loged'";
	$result1=mysqli_query($conn,$query1);
	while($R1=mysqli_fetch_array ($result1))
	{
		$qtyttl=$R1['qtyttl'];
	}
	
	if($cnt>0)
	{
		?>
<tr class="even">
<td colspan="" align="right" ><b>Total : </b></td>
<td align="center"><b><?=$qtyttl;?></b></td><td colspan=""></td>
</tr>
<?
	}
?>
</table>