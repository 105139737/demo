<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$pid=$_REQUEST[pid];
$pid=$_REQUEST[prnm];
$qnt=$_REQUEST[qty];
$prc=$_REQUEST[prc];
$fbcd=$_REQUEST[fbcd];
$tbcd=$_REQUEST[tbcd];
$tsl=$_REQUEST[tsl];
$dt=$_REQUEST[dt];
$blno=$_REQUEST['blno'] ?? "";


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
 $queryq = "SELECT sum(qty) as qty1 FROM main_trndtl where blno='$blno' and prsl='$pid' and fbcd='$fbcd'";
   $resultq = mysqli_query($conn,$queryq);
while ($Rq = mysqli_fetch_array ($resultq))
{
$qty1=$Rq['qty1'];
}
$tot=$qnt;
 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pid' and bcd='$fbcd'";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}

if($stck>=$tot)
{
$query100 = "SELECT * FROM main_trndtl where sl='$tsl'";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$uqnty=$R100['qty'];
}
$query21 = "update main_trndtl set qty='$qnt' where sl='$tsl' ";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$query21 = "update main_stock set stout='$qnt' where pcd='$pid' and bcd='$fbcd' and dt='$dt' and nrtn='Transfer' and stout='$uqnty'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

//echo $query21;   
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
echo $err;	

}
?>