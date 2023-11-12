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
$unt=$_REQUEST[unt];
$prc=$_REQUEST[prc];
$lttl=$_REQUEST[lttl];
$runt=$_REQUEST[runt];
$betno1=$_REQUEST[betno];
$expdt=$_REQUEST[expdt];
$usl=$_REQUEST[usl];
$fbcd=$_REQUEST[fbcd];
$tbcd=$_REQUEST[tbcd];
$blno=$_REQUEST[blno];

$err="";
if($expdt!="0000-00-00")
{
$expdt=date('Y-m-d', strtotime($expdt));
}
if($betno1=='' or $pid=='' or $qnt=='' or $qnt=='0')
{
	$err="Please Fill All Fields....";
}
else
{

 $query6="Select * from main_product where sl='$pid'";
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{

$prnm=$R6['pname'];
}

 $query3="Select * from ".$DBprefix."stock where sl='$betno1'";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{

$betno=$R3['betno'];
}

$log="";


$unit=mysqli_query($conn,"select * from main_unit where sl='$usl'");
while($pr=mysqli_fetch_array($unit))
{
$punt=$pr['pkgunt'];
$upkg=$pr['untpkg'];
$ptu1=$pr['tunt'];	
}


	
	
	
if($punt==$unt)
{	
$log=0;

$qnt1=$qnt*$ptu1;
}
else
{
$qnt1=$qnt;		
$log=1;
}




$tot=0;
 $queryq = "SELECT sum(qty) as qty1 FROM main_trndtl where blno='$blno' and prsl='$pid' and betno='$betno' and fbcd='$fbcd'";
   $resultq = mysqli_query($conn,$queryq);
while ($Rq = mysqli_fetch_array ($resultq))
{
$qty1=$Rq['qty1'];
}
$tot=$qty1+$qnt1;
 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pid' and betno='$betno' and bcd='$fbcd' group by betno";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}

if($stck>=$tot)
{
$query21 = "INSERT INTO main_trndtl(prsl,prnm,qty,unt,prc,ttl,rmk,betno,expdt,usl,fbcd,blno) VALUES ('$pid','$prnm','$qnt1','$unt','$prc','$lttl','$rmk','$betno','$expdt','$usl','$fbcd','$blno')";
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
<?
}
else
{
echo $err;	

}
?>