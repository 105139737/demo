<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$uid=$_POST['uid'];
$mm1=$_POST['mm'];
 if($mm1!='')
 {
 $mm=implode(',',$mm1);
 }

$sql3 = mysqli_query($conn,"DELETE FROM main_app_mroll where uid='$uid' ") or die(mysqli_error($conn));	
$sql1 = mysqli_query($conn,"select * from main_appmenu where sl>0 and find_in_set(sl,'$mm')>0 order by sl") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
$mmsl = $row['sl'];
$nm = $row['nm'];

$ent=$_POST['ent'.$mmsl];
$vw=$_POST['vw'.$mmsl];
$et=$_POST['et'.$mmsl];
 mysqli_query($conn,"insert into main_app_mroll(uid,mmsl,ent,vw,et) values('$uid','$mmsl','$ent','$vw','$et')") or die(mysqli_error($conn));
}

?>
<script>
alert('Updated Successfully. Thank You...');
document.location="roll_assign.php";
</script>