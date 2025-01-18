<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=0;
$uid=$_REQUEST['uid'];
?>
<table class="advancedtable" border="1" width="100%">
<tr bgcolor="#fff09f"> 
<td style="font-size:16px;" width="20%"><b>Menu Name</b></td>
<!---<td style="font-size:16px;" width="5%"><b>Entry</b></td>
<td style="font-size:16px;" width="5%"><b>View</b></td>
<td style="font-size:16px;" width="70%"><b>Edit</b></td>--->
</tr>
<?php  
$sql1 = mysqli_query($conn,"select * from main_mmenu where sl>0 order by sl") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
$mmsl = $row['sl'];
$nm = $row['nm'];
$sql2 = mysqli_query($conn,"select * from main_mroll where uid='$uid' and mmsl='$mmsl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($sql2);
$main_chk="";
if($count>0)
{
$main_chk="checked";
}
?>
<tr bgcolor="#e8e8ff">
<td colspan="4" ><font size="5"><b><input type="checkbox" value="<?php  echo $mmsl?>"  <?php  echo $main_chk;?> id="mm<?php  echo $sl?>" name="mm[]"> <?php  echo $nm;?></b></font></td>
</tr>
<?php 
$sql11 = mysqli_query($conn,"select * from main_menu where msl='$mmsl' order by sl") or die(mysqli_error($conn));
while($row1 = mysqli_fetch_array($sql11))
{
$sl = $row1['sl'];
$mnm = $row1['mnm'];
$fnm = $row1['fnm'];

$sql3 = mysqli_query($conn,"select * from main_mroll where uid='$uid' and mmsl='$mmsl' and msl='$sl'") or die(mysqli_error($conn));
$count3=mysqli_num_rows($sql3);
$main_chk1="";
if($count3>0)
{
$main_chk1="checked";
}
$ent="";
$vw="";
 $et="";
while($row1 = mysqli_fetch_array($sql3))
{
$ent = $row1['ent'];
$vw = $row1['vw'];
$et = $row1['et'];
}
if($ent==1){$ent="checked";}
if($vw==1){$vw="checked";}
if($et==1){$et="checked";}
?>
<tr>
<td><b><input type="checkbox" value="<?php  echo $sl?>" <?php  echo $main_chk1;?>  id="m<?php  echo $sl?>" name="m[]"> <font size="3"><?php  echo $mnm;?></font></b></td>
<!---<td><b><input type="checkbox" value="1" <?php  echo $ent;?> id="ent<?php  echo $sl?>" name="ent<?php  echo $sl?>"></b></td>
<td><b><input type="checkbox" value="1" <?php  echo $vw;?> id="vw<?php  echo $sl?>" name="vw<?php  echo $sl?>"></b></td>
<td><b><input type="checkbox" value="1" <?php  echo $et;?> id="et<?php  echo $sl?>" name="et<?php  echo $sl?>"></b></td>--->
</tr>
<?php 
}
}
?>
</table>