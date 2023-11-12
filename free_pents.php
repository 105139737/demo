<?php

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 3;
include("membersonly.inc.php");
$fy=date('Y');
$fm=date('m');
if($fm<4)
{$fy--;
}
$dt=$fy."-04-01";
$dttm=date('d-m-Y H:i:s');

$aa='1';
$cat=$_POST['cat'];
$bnm=$_POST['bnm'];
//*$mnm=$_POST['mnm'];*/
$pnm=$_POST['pnm'];

$c4=mysqli_query($conn,"SELECT * FROM ".$DBprefix."free_product where cat='$cat' and bnm='$bnm' and pnm='$pnm'");
$count4=mysqli_num_rows($c4);
if($count4>0)
{
$err="Product Name Already Exists...";	
}
if($err=="")
{
$query2 = "INSERT INTO ".$DBprefix."free_product (cat,bnm,pnm) VALUES ('$cat','$bnm','$pnm')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));	




?>
<script language="javascript">
alert('Product Entry Completed. Thank You.....');
document.location="pent.php";
</script>
<?  
    
    }
    else
    {
    ?>
<script language="javascript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
    }
?>