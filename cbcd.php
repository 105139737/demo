<?php
include("membersonly.inc.php");
$fbcd=$_REQUEST['fbcd'];
?>
<select name="tbcd" class="form-control" tabindex="1" size="1" id="tbcd">
<?
$query="Select * from main_godown where stat=1";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
$gnm=$R['gnm'];

?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>
