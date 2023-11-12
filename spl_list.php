<?php 
$reqlevel = 1;
include("membersonly.inc.php");
set_time_limit(0);
$brncd=rawurldecode($_REQUEST['brncd']);
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}


?>

<table width="100%"  class="table table-bordered">
<tr>
<th width="3%"><b>Action</b></th>
<th width="3%"><b>SL.</b></th>
<th ><b>Branch </b></th>
<th><b>Barnd</b></th>
</tr>
<?php
$cnt=0;
$data11= mysqli_query($conn,"SELECT * FROM main_spl where sl>0 $brncd1 ");
while ($row11= mysqli_fetch_array($data11))
{	
$cnt++;
$tsl=$row11['sl'];
$brncd=$row11['brncd'];
$brand=$row11['brand'];
	$query="Select * from main_branch where sl='$brncd'";
   $result = mysqli_query($conn,$query);
	while ($R = mysqli_fetch_array ($result))
	{
	$bnm=$R['bnm'];
	}


$data13 = mysqli_query($conn,"Select * from main_catg  where sl='$brand' ");
while ($row13 = mysqli_fetch_array($data13))
{
$cnm=$row13['cnm'];
}

?>
<tr>
<td><a href="spl_edt.php?sl=<?php echo $tsl;?>">Edit</a></td>   
<td><?php echo $cnt;?></td>
<td><?php echo $bnm;?></td>
<td><?php echo $cnm;?></td>
</tr>
<?php }?>
</table>


