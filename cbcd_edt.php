<?php
include("membersonly.inc.php");
$fbcd=$_REQUEST[fbcd];
$tbcd=$_REQUEST[tbcd];
?>
    <select name="tbcd" class="form-control" size="1" id="tbcd" style="width:300px"  >
	<option value="">---Select---</option>
<?
$query="Select * from main_godown where stat=1";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['gnm'];
?>
<option value="<? echo $sl;?>"<?=$sl==$tbcd ? 'selected' : ''?>><? echo $bnm;?></option>
<?
}
?>
</select>
