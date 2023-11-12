<?php
$reqlevel = 3;
include("membersonly.inc.php");

$spid=$_REQUEST['spid'];


if($spid==""){$spid1="";}else{$spid1=" and sl='$spid'";}

?>
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;">Sl</th>
<th style="text-align:left;">Sales Person ID (Name)</th>
<th style="text-align:center;">Collection Target</th>
<th style="text-align:center;">Sales Target</th>
</tr>
<?
//echo "select * from main_sale_per where sl>0 $spid1 order by nm";
$get=mysqli_query($conn,"select * from main_sale_per where sl>0 $spid1 order by nm") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
while($row=mysqli_fetch_array($get))
{
  $cnt++;
  $sl=$row['sl'];
  $spid=$row['spid'];
  $nm=$row['nm'];
  $mob=$row['mob'];
  $addr=$row['addr'];

$get1=mysqli_query($conn,"select * from main_sp_target where spid='$spid'") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
$target=$row1['target'];
$starget=$row1['starget'];
}
?>
<tr>
<td style="text-align:center;"><?=$cnt;?></td>
<td style="text-align:left;"><?=$spid;?> (<?=$nm;?>)</td>
<td style="text-align:center;"><input type="text" name="<?php echo $sl;?>" id="<?php echo $sl;?>" value="<?php echo $target;?>"></td>
<td style="text-align:center;"><input type="text" name="s<?php echo $sl;?>" id="s<?php echo $sl;?>" value="<?php echo $starget;?>"></td>

</tr>
<?                              
}
?>
<tr>
  <td colspan="4" align="right" >
    <input type="submit" name="submit" value="Update" class="btn btn-warning" >
  </td>
</tr>
</table>