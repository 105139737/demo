<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$stk_dt=$_REQUEST['stk_dt'];
$dt=$_REQUEST['dt'];
$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
set_time_limit(0);
//$stk_dt="2020-09-13";
//$dt="2020-09-14"; 

$dt=date('Y-m-d',strtotime($dt));
$stk_dt=date('Y-m-d',strtotime($stk_dt));

if($stk_dt>$dt)
{
echo "Please Check Stock Clear Date";
die();
}

$data= mysqli_query($conn,"select * from  main_product where sl>0 and cat='$cat' and scat='$scat' ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$unit='sun';
$prnm=$row['sl'];






$get=mysqli_query($conn,"update main_openingdtl set rqty='1' where prsl='$prnm'") or die(mysqli_error($conn));

$query="Select * from main_godown";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$brncd=$R['sl'];

$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$prnm' and bcd='$brncd'  and dt between '$stk_dt' and '$dt' and stout>0 and nrtn='Sale'  order by sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];

$stk_dt=date('Y-m-d',strtotime($stk_dt));
$dtu=date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $stk_dt) ) ));
echo "update main_stock set dt='$dtu' where sl='$sl'";
$get=mysqli_query($conn,"update main_stock set dt='$dtu' where sl='$sl'") or die(mysqli_error($conn));
}

$stk_rate=0;
$rate=0;
$query41="Select sum(stk_rate) as stk_rate,sum(rate) as rate,count(*) as total from main_stock where pcd='$prnm' and stk_rate>0 and rate>0 and (stin+opst)>0";
$result41 = mysqli_query($conn,$query41);
while ($R4 = mysqli_fetch_array ($result41))
{
$stk_rate=$R4['stk_rate'];	
$rate=$R4['rate'];	
$total=$R4['total'];	
if($total>0)
{
$stk_rate=round($stk_rate/$total,4);	
$rate=round($rate/$total,4);	
}
}
/*
$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$prnm' and bcd='$brncd'  and dt<='$stk_dt' group by betno order by sl");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$betno=$row1['betno'];
*/
//and betno='$betno'
$qty=0;
 $query4="Select sum(opst+stin-stout) as stck1 from main_stock where pcd='$prnm' and bcd='$brncd'  and dt<='$stk_dt'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$qty=$R4['stck1'];
}	
if($qty!=0)
{


$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prnm'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
	$usl=$roww['sl'];
}

$refno="Adjustment-".$cat."-".$scat;
if($qty>0)	
{
if($unit=='sun'){$stock_in=$qty*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$qty*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$qty*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;}
	
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stout,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate,sbill,lot)
VALUES ('$prnm','$brncd','$dt','$unit','$stock_in','Adjustment','$user_currently_loged','$dttm','1','$rate','$refno','$usl','$uval','$betno','$rate','$stk_rate','Adjustment','$prnm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
else
{
$qty=($qty*(-1));
if($unit=='sun'){$stock_in=$qty*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$qty*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$qty*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;}
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stin,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate,lot)
VALUES ('$prnm','$brncd','$dt','$unit','$stock_in','Adjustment','$user_currently_loged','$dttm','1','$rate','$refno','$usl','$uval','$betno','$rate','$stk_rate','$prnm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 	
}

echo "<br>";
}
}
}

