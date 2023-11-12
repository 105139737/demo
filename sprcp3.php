<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
/*
note:
this is just a static test version using a hard-coded countries array.
normally you would be populating the array out of a database

the returned xml has the following structure
<results>
	<rs>foo</rs>
	<rs>bar</rs>
</results>
*/
?>
<table width="100%">

<?
$a=$_REQUEST[prnm];
$a1="%".$a."%";
     $query = "SELECT * FROM main_catg where cnm like '$a1' limit 0,10";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$cnm=$R['cnm'];
$tnm=$R['tnm'];
$sl=$R['sl'];


?>

<tr>

<td onclick="get('<?=$cnm?>','<?=$tnm?>','<?=$sl?>')" style="cursor:pointer;">
<font size="3"> <?=$cnm;?> </font><br>
<font size="1"> <?=$tnm;?> </font>
<hr>
</td>


</tr>

<?

}

?>
<tr>
<td onclick="clr()" align="center" style="cursor:pointer">
<font size="3" ><a><b>Close</b></a></font>
</td>
</tr>
</table>