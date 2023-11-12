<?php
$reqlevel = 1;
include("membersonly.inc.php");
$username=$_REQUEST['username'];
if($username!=""){$username1=" and username='$username'";}
?>
<table class="table table-hover table-striped table-bordered">	
<tr>
<td class="hdng" align="center">SL</td>
<td class="hdng" align="center">Username</td>
<td class="hdng" align="center">Menu Name</td>
<td class="hdng"  align="center">Action</td>
</tr>
<?php 

$data=mysqli_query($conn,"select * from main_approll where sl>0 $username1")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($data);
while($row=mysqli_fetch_array($data))
{
	$sln++;
	$sl=$row['sl'];
	$username=$row['username'];
	$msl=$row['msl'];

	$nm2="";
	$msl1=explode(",",$msl);
	for($i=0; $i<count($msl1); $i++)
	{
		$get1=mysqli_query($conn,"SELECT * FROM main_appmenu where sl='$msl1[$i]'") or die(mysqli_error($conn));
		while($row1=mysqli_fetch_array($get1))
		{
			$nm=$row1['nm'];
		}
		if($nm2==""){$nm2="$nm";}else{$nm2="$nm2, $nm";}
	}
$select=mysqli_query($conn,"SELECT * FROM main_signup where username='$username'") or die(mysqli_error($conn));;
while($r1=mysqli_fetch_array($select))   
{
$name=$r1['name'];
}
	

?>
<tr>
<td align="center" class="hdng"><?php echo $sln;?></td>
<td align="left" class="hdng"><?php echo $username;?> (<?=$name;?>)</td>
<td align="left" class="hdng"><?php echo $nm2?></td>
<td align="center" style="cursor:pointer;" class="hdng">
<a href="menu_assign_edit.php?sl=<?=$sl;?>"><i class="fa fa-pencil-square-o" title="Click to Update"></i></a>
</td>
</tr>	 
<?php
}
?>
</table>					