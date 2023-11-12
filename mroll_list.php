<?php
$reqlevel = 3;
include("membersonly.inc.php");
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
<td colspan="4" ><font size="5"><b><input type="checkbox" value="<?=$mmsl?>"  <?=$main_chk;?> id="mm<?=$sl?>" name="mm[]"> <?php echo $nm;?></b></font></td>
</tr>
<?
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
<td><b><input type="checkbox" value="<?=$sl?>" <?=$main_chk1;?>  id="m<?=$sl?>" name="m[]"> <font size="3"><?php echo $mnm;?></font></b></td>
<!---<td><b><input type="checkbox" value="1" <?=$ent;?> id="ent<?=$sl?>" name="ent<?=$sl?>"></b></td>
<td><b><input type="checkbox" value="1" <?=$vw;?> id="vw<?=$sl?>" name="vw<?=$sl?>"></b></td>
<td><b><input type="checkbox" value="1" <?=$et;?> id="et<?=$sl?>" name="et<?=$sl?>"></b></td>--->
</tr>
<?
}
}
?>
</table>