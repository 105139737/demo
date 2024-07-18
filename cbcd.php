<?php
include("membersonly.inc.php");
$fbcd=$_REQUEST['fbcd'];
$tbcd="";
$query100 = "SELECT * FROM ".$DBprefix."trntemp where eby='$user_currently_loged' order by sl limit 0,1";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tbcd=$R100['tbcd'];
}
?>
<select name="tbcd" class="form-control" tabindex="1" size="1" id="tbcd">
<?
if($tbcd!=""){$tbcdq=" and sl='$tbcd'";}
$query="Select * from main_godown where stat=1 $tbcdq";
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
