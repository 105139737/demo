<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$prnm=$_REQUEST['prnm'];
$unit_nm=$_REQUEST['unit_nm']??"";
	$sl="";
	$sun="";
	$mun="";
	$bun="";
$geti=mysqli_query($conn,"select * from main_unit where cat='$prnm'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
	//sun	mun	bun	smvlu	mdvlu	bgvlu	
	$sl=$rowi['sl'];
	$sun=$rowi['sun'];
	$mun=$rowi['mun'];
	$bun=$rowi['bun'];
	$smvlu=$rowi['smvlu'];
	$mdvlu=$rowi['mdvlu'];
	$bgvlu=$rowi['bgvlu'];
}
?>
<select id="unit" name="unit" class="sc" tabindex="11" style="padding:3px;width:100%">
<?php if($sun!=''){?><option value="sun" <?php if($unit_nm=="sun"){ echo "selected";}?>><?php  echo $sun;?></option><?php }?>
<?php if($mun!=''){?><option value="mun" <?php if($unit_nm=="mun"){ echo "selected";}?>><?php  echo $mun;?></option><?php }?>
<?php if($bun!=''){?><option value="bun" <?php if($unit_nm=="bun"){ echo "selected";}?>><?php  echo $bun;?></option><?php }?>
</select>
<input type="hidden" value="<?php  echo $sl?>" name="usl" id="usl">