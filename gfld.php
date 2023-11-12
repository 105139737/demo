<?php

/**
 * @author Nirmal
 * @copyright 2014
 */
$reqlevel = 1;
include("membersonly.inc.php");
$tnm=$_REQUEST[tnm];
if($tnm==""){
    echo "Please select a Table";
}
else
{
if ($tnm=="company")
{
 $result = mysqli_query($conn,"Select * FROM ".$DBprefix.$tnm);   
}else
{
$result = mysqli_query($conn,"SHOW COLUMNS FROM ".$DBprefix.$tnm);
}
?>
<select name="fld" id="fld" size="1" style="font-family: Times New Roman; font-size: 18pt">
<?

while ($R = mysqli_fetch_array ($result))
{
    if ($tnm=="company")
{
    $x=$R['fnm'];
    }
    else
    {
$x=$R['Field'];
}
?>
<option value="<? echo $x;?>"><? echo $x;?></option>
<?
}
?>
</select>
<?
}
?>
