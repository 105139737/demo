<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$uid=$_REQUEST['uid'];
?>
<table class="advancedtable" border="1" width="100%">
<tr bgcolor="#fff09f"> 
<td style="font-size:16px;" width="20%"><b>Menu Name</b></td>
<td style="font-size:16px;" width="20%"><b>Entry</b></td>
<td style="font-size:16px;" width="20%"><b>View</b></td>
<td style="font-size:16px;" width="20%"><b>Edit</b></td>
</tr>
<?php 
$sql1 = mysqli_query($conn,"select * from main_appmenu where sl>0 order by sl") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
$mmsl = $row['sl'];
$nm = $row['nm'];

$sql3 = mysqli_query($conn,"select * from main_app_mroll where uid='$uid' and mmsl='$mmsl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($sql3);
$main_chk=""; 

if($count>0)
{
$main_chk="checked";
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
<td><b><input type="checkbox" value="<?php  echo $mmsl?>"  <?php  echo $main_chk;?> id="mm<?php  echo $sl?>" name="mm[]"><font size="3"><?php  echo $nm;?></font></b></td>
<td><b><input type="checkbox" value="1" <?php  echo $ent;?> id="ent<?php  echo $mmsl?>" name="ent<?php  echo $mmsl?>"></b></td>
<td><b><input type="checkbox" value="1" <?php  echo $vw;?> id="vw<?php  echo $mmsl?>" name="vw<?php  echo $mmsl?>"></b></td>
<td><b><input type="checkbox" value="1" <?php  echo $et;?> id="et<?php  echo $mmsl?>" name="et<?php  echo $mmsl?>"></b></td>
</tr>
<?php 

}
?>
</table>