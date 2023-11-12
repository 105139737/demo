<?php
$reqlevel=0;
include("membersonly.inc.php");

$sl=$_REQUEST[sl];

$data=mysqli_query($conn,"SELECT * FROM main_drcr where sl='$sl'");
while($row=mysqli_fetch_array($data))
{
	$pno=$row['pno'];
	$vno=$row['vno'];
	$cldgr=$row['cldgr'];
	$dldgr=$row['dldgr'];
	$amm=$row['amm'];
	$nrtn=$row['nrtn'];
	$sid=$row['sid'];
	$cid=$row['cid'];
	$brncd=$row['brncd'];
}

if($cldgr==-1)
{$ldgr=$dldgr;
$drcr="1";
}
else
{$ldgr=$cldgr;
$drcr="-1";
}

?>
<div class="box box-success">
<div class="box-header">
<div class="form-group col-md-12">
<label><font color="red">*</font>Branch:</td></label> 
<select name="brncd" id="brncd" class="form-control">
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result3 = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result3))
{
$bbsl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $bbsl;?>"<?=$R['sl'] == $brncd ? 'selected' : '' ?>><? echo $bnm;?></option>
<?
}
?>
</select>
</div>
<input type="hidden" id="ldgr" name="ldgr" value="4">
<input type="hidden" id="proj" name="proj" value="0">
<div class="form-group col-md-12">
<label>
Customer :
</label><br>
<select id="cust" name="cust" tabindex="1" class="form-control">
<option value="">---Select---</option>
<?
$query6="select * from  main_cust order by nm ";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
?>
<option value="<?=$row['sl'];?>"<?=$row['sl'] == $cid ? 'selected' : '' ?>><?=$row['nm'];?> ( <?=$row['cont']?> ) - <?=$row['addr']?></option>
<?
}
?>
</select>
</div>
<div class="form-group col-md-12">
<label><font color="#FFF">*</font>Amount :</label>
<font color="red">Rs.</font><br>
<input type="text" name="amm" class="sc" id="amm" value="<?echo $amm;?>" style="width:95px;">
	<select name="drcr" class="sc" style="width:90px;">
	<option value="">-- Select --</option>
	<option value="1" <?=$drcr==1 ? 'selected' : ''?>>Dr.</option>
	<option value="-1" <?=$drcr==-1 ? 'selected' : ''?>>Cr.</option>
	</select>
</div>
<div class="form-group col-md-12">
<label><font color="#FFF">*</font>Narration :</label>
<input type="text" name="nrtn" id="nrtn" value="<?echo $nrtn;?>" class="form-control">
</div>
<div class="form-group col-md-12" style="text-align:center;">
<label></label>
<input type="submit" value="Update" class="btn btn-primary">
</div>
<input type="hidden" name="updt" id="updt" value="<?echo $sl;?>">
</div>
</div>