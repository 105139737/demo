<?php $_REQUEST['brncd'] ?? ""
$reqlevel = 1;
include("membersonly.inc.php");
$pid=$_REQUEST[prnm];
$qnt=$_REQUEST[qty];
$prc=$_REQUEST[prc];
$pslno=$_REQUEST[pslno];
$brncd=$_REQUEST[brncd];



$err="";
$lttl=$qnt*$prc;

if($pid=='' or $qnt=='' or $qnt=='0' or $prc=='' or $prc=='0')
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

$queryq = "SELECT sum(qty) as qty1 FROM ".$DBprefix."slt where eby='$user_currently_loged' and prsl='$pid'";
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
}
if($stck>=$tot)
{
$query7="Select * from main_slt where prsl='$pid' and eby='$user_currently_loged'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount==0)
{	
$query21 = "INSERT INTO ".$DBprefix."slt (prsl,prnm,qty,prc,ttl,eby,rmk,pslno) VALUES ('$pid','$prnm','$qnt','$prc','$lttl','$user_currently_loged','$rmk','$pslno')";
$result21 = mysqli_query($conn,$query21); 
}
else
{
$err="Product Already Exists....";		
}
}
else
{
$err="Please Check  Quantity....";	
}
}
if($err=="")
{
?>

<script>
temp();
$('#prnm').trigger('chosen:open');

</script>

<?php 

}
else
{
?>
<script>
alert('<?php  echo $err;?>');
temp();

  $('#prnm').trigger('chosen:open');

</script>
<?php 
}

?>