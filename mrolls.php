<?php
$reqlevel = 3;
include("membersonly.inc.php");
$uid=$_POST['uid'];
$mm1=$_POST['mm'];
$m1=$_POST['m'];
 if($mm1!='')
 {
 $mm=implode(',',$mm1);
 }
 if($m1!='')
 {
 $m=implode(',',$m1);
 }
 $sql3 = mysqli_query($conn,"DELETE FROM main_mroll where uid='$uid' ") or die(mysqli_error($conn));	
$sql1 = mysqli_query($conn,"select * from main_mmenu where sl>0 and find_in_set(sl,'$mm')>0 order by sl") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
 $mmsl = $row['sl'];
$nm = $row['nm'];

$sql11 = mysqli_query($conn,"select * from main_menu where msl='$mmsl' and find_in_set(sl,'$m')>0  order by sl") or die(mysqli_error($conn));
while($row1 = mysqli_fetch_array($sql11))
{
 $msl = $row1['sl'];
$mnm = $row1['mnm'];
$fnm = $row1['fnm'];

$ent=$_POST['ent'.$msl];
$vw=$_POST['vw'.$msl];
$et=$_POST['et'.$msl];


$sql3 = mysqli_query($conn,"insert into main_mroll(uid,mmsl,msl,ent,vw,et) values('$uid','$mmsl','$msl','$ent','$vw','$et')") or die(mysqli_error($conn));

}
}
?>
<script>
alert('Updated Successfully. Thank You...');
document.location="mroll.php";
</script>