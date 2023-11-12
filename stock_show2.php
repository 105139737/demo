<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
?>
<ul id="red" class="treeview-red">
<?
$data= mysqli_query($conn,"select * from  main_stock where sl>0 and bcd='$branch_code' group by pcd")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$c3++;
$pcd=$row['pcd'];

          $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$b=$R['pname'];
$c=$R['pkgunt'];
}
$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
if($user_current_level<0)
{
  $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd'";
  }
  else
  {
    $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code'";
  }
  
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck/$ptu;
  
if($c1=='odd')
{
$c1='even';
}
elseif($c1=='even')
{
$c1='odd';
}
  $sl++; 
?>
<li><?=$b;?></li>
<ul>

<?
$query3="Select * from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' group by betno order by expdt";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$sl=$R3['sl'];
$betno=$R3['betno'];
$ret=$R3['ret'];
$expdt=$R3['expdt'];

 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' and bcd='$branch_code' group by betno";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
?>
<li><?=$stck?></li>

<?	
}
?>
</ul>
<?
}
?>	

</ul>
<?

							