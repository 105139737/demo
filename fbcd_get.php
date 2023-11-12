<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=1;
?>
<?
$query100 = "SELECT * FROM ".$DBprefix."trntemp where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$fbcd=$R100['fbcd'];
}
if($fbcd!="")
{
?>
<select name="fbcd" class="form-control" size="1" id="fbcd" tabindex="1" onchange="cbcd(),product()" >
<?
$query="Select * from main_godown where sl='$fbcd'";
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
<?	
}
else
{
?>
<select name="fbcd" class="form-control" size="1" tabindex="1" id="fbcd" onchange="cbcd();product()" >
<?
$query="Select * from main_godown ";
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
<?}?>