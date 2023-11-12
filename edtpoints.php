<?php
include "config.php";
$sl=$_REQUEST[sl];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
if($fv=="")
{
?>
<script>
alert('Please Fill Up!!');
location.reload();
</script>
<?
}
else
{	
$sql =mysqli_query($conn,"UPDATE main_point set $fn='$fv' where sl='$sl'")or die(mysqli_error($conn));
}
?>
<a href="#" onclick="sedt('<?echo $sl;?>','<?=$fn;?>','<?echo $fv;?>','<?=$div;?>')"><?=$fv;?></a>
