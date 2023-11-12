<?php
$reqlevel = 1;
include("membersonly.inc.php");
$pid=$_REQUEST[prnm];
$qnt=$_REQUEST[qty];
$brncd=$_REQUEST[brncd];


$err="";


if($pid=='' or $qnt=='' or $qnt=='0')
{
$err="Please Fill All Fields....";
}
else
{
$query6="Select * from main_product where sl='$pid'";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$prnm=$R6['pnm'];
}

$tot=0;
/*
$queryq = "SELECT sum(qty) as qty1 FROM ".$DBprefix."ordertmp where eby='$user_currently_loged' and prsl='$pid'";
$resultq = mysqli_query($conn,$queryq);
while ($Rq = mysqli_fetch_array ($resultq))
{
$qty1=$Rq['qty1'];
}

$tot=$qty1+$qnt;

$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pid' and bcd='$brncd'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}*/

$query7="Select * from main_ordertmp where prsl='$pid' and eby='$user_currently_loged'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount==0)
{	
$query21 = "INSERT INTO ".$DBprefix."ordertmp (prsl,prnm,qty,eby,rmk,pslno)
 VALUES ('$pid','$prnm','$qnt','$user_currently_loged','Customer Order','$pslno')";
$result21 = mysqli_query($conn,$query21); 
}
else
{
$err="Product Already Exists....";		
}



}
if($err=="")
{
?>

<script>
temp();
$('#prnm').trigger('chosen:open');

</script>

<?

}
else
{
?>
<script>
alert('<?=$err;?>');
temp();

  $('#prnm').trigger('chosen:open');

</script>
<?
}

?>