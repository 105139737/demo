<?
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST[pcd];

$point=0;
 $query3="Select * from main_point where pcd='$pcd'";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$point=$R3['point'];
}

?>

<input type="text" class="sc"  id="point" name="point" style="text-align:center" onblur="cal()"  value="<?=$point;?>"  tabindex="9" size="15"  >