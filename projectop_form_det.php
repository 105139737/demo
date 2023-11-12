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
<div class="form-group col-md-6">
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
<div class="form-group col-md-6">
<label><font color="#FFF">*</font>Project :</label>
<select name="proj" id="proj" class="form-control">
<option value="">-- Select --</option>
<option value="0" <?=$pno == 0 ? 'selected' : '' ?>>NA</option>
<?php
$get = mysqli_query($conn,"SELECT * FROM main_project") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>" <?=$row['sl'] == $pno ? 'selected' : '' ?>><?=$row['nm']?></option>
<?php
}
?>
</select>
</div>
<div class="form-group col-md-6">
<label><font color="#FFF">*</font>Ledger Head :</label>
<select name="ldgr" id="ldgr" class="form-control" onchange="si1(this.value)">
<option value="">-- Select --</option>
<?php 
$get=mysqli_query($conn,"SELECT * FROM main_ledg where sl!='-1' and sl!='4'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>" <?=$row['sl'] == $ldgr ? 'selected' : '' ?>><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</div>
<div class="form-group col-md-6">
<label>
<div id="c1">
<?
if($ldgr==4)
{
?>Customer:<?
}
elseif($ldgr==12)
{
?>Supplier:<?
}
?>
</div>
</label>
<div id="cs1">
<?
if($ldgr==4)
{
?>
<select id="cust" name="cust" tabindex="1" style="width:220px" class="sc">
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
<script type="text/javascript">
$('#cust').chosen({no_results_text: "Oops, nothing found!",});
</script>
<?
}
elseif($ldgr==12)
{
?>
<select id="sup" name="sup" class="sc">
<option value="">---Select---</option>
<?
$query6="select * from  main_suppl order by spn ";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
?>
<option value="<?=$row['sl'];?>"<?=$row['sl'] == $sid ? 'selected' : '' ?>><?=$row['spn'];?></option>
<?
}
?>
</select>
<script type="text/javascript">
$('#sup').chosen({no_results_text: "Oops, nothing found!",});
</script>
<?
}
?>
</div>
</div>
<div class="form-group col-md-12">
<label><font color="#FFF">*</font>Amount :</label>
<font color="red">Rs.</font><input type="text" name="amm" class="sc" id="amm" value="<?echo $amm;?>" style="width:95px;">
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