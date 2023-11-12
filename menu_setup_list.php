<?php
$reqlevel = 1;
include("membersonly.inc.php");
?>
<table class="table table-hover table-striped table-bordered">	 
<tr>
<td class="hdng" align="center">SL</td>
<td class="hdng" align="center">Menu</td>
<td class="hdng"  align="center">Action</td>
</tr>
<?php
$sl=$start;
$sln=0;
$data=mysqli_query($conn,"select * from main_appmenu where sl>0  order by sl")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($data);
while($row=mysqli_fetch_array($data))
{
	$sl++;
$sl=$row['sl'];
$nm=$row['nm'];

?>
<tr>
<td align="center" class="hdng"><?php echo $sl;?></td>
<td align="left" class="hdng"><?php echo $nm;?></td>
<td align="center" style="cursor:pointer;" class="hdng">
<a href="menu_setup_edit.php?sl=<?=$sl;?>"><i class="fa fa-pencil-square-o" title="Click to Update"></i></a>
</td>
</tr>	 
<?php
}
?>
</table>					