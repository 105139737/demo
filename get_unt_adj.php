<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$prnm=$_REQUEST['prnm'];
$geti=mysqli_query($conn,"select * from main_unit where cat='$prnm'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
	$sl=$rowi['sl'];
	$sun=$rowi['sun'];
	$mun=$rowi['mun'];
	$bun=$rowi['bun'];
	$smvlu=$rowi['smvlu'];
	$mdvlu=$rowi['mdvlu'];
	$bgvlu=$rowi['bgvlu'];
}
?>
<select id="unit" name="unit" class="form-control" tabindex="1">
<?php if($sun!=''){?><option value="sun"><?php  echo $sun;?></option><?php }?>
<?php if($mun!=''){?><option value="mun"><?php  echo $mun;?></option><?php }?>
<?php if($bun!=''){?><option value="bun"><?php  echo $bun;?></option><?php }?>
</select>
<input type="hidden" value="<?php  echo $sl?>" name="usl" id="usl">