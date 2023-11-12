<?php
$reqlevel = 1;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$hsn_update=$_REQUEST['hsn_update'];
if($hsn_update!='' && $prnm!='')
{
$get=mysqli_query($conn,"UPDATE main_product set hsn='$hsn_update' where sl='$prnm'");
echo "<font color='green' size='2'>Update success</font>";
}
else
{
	echo "<font color='red' size='2'>Somthing happen</font>";
}
?>