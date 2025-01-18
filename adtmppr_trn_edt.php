<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$pid=$_REQUEST['prnm'];
$qnt=$_REQUEST['qty'];
$fbcd=$_REQUEST['fbcd'];
$tbcd=$_REQUEST['tbcd'];
$refno=$_REQUEST['sih'];
$unit=$_REQUEST['unit'];
$usl=$_REQUEST['usl'];
$remk=rawurldecode($_REQUEST['remk']);
$blno=rawurldecode($_REQUEST['blno']);
$dt=rawurldecode($_REQUEST['dt']);
$betno=$_REQUEST['betno'];

$edtm=date('d-m-Y H:i:s a');
$err="";
if($pid=='' or $qnt=='' or $qnt=='0' or $fbcd=='')
{
	$err="Please Fill All Fields....";
}
if($betno!="")
{
$betno1=" and betno='$betno'";	
}
$query6="Select * from main_product where sl='$pid'";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$prnm=$R6['pnm'];
}
$tot=0;
$queryq = "SELECT sum(qty) as qty1 FROM main_trndtl where fbcd='$fbcd'  and prsl='$pid' and blno='$blno' $betno1";
$resultq = mysqli_query($conn,$queryq);
while ($Rq = mysqli_fetch_array ($resultq))
{
$qty1=$Rq['qty1'];
}
$tot=$qty1+$qnt;
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pid' and bcd='$fbcd' $betno1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($tot>$stck)
{
//$err="Please Check  Quantity....";	
}
	
$query7="Select * from main_trndtl where prsl='$pid' and  blno='$blno'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount>0)
{
//$err="Product Already Exists....";		
}
if($err=="")
{
for($i=0;$i<$qnt;$i++)
{


/*
$stk_rate=0;
$rate=0;
$query41="Select sum(stk_rate) as stk_rate,sum(rate) as rate,count(*) as total from main_stock where pcd='$prsl' and stk_rate>0 and rate>0 and (stin+opst)>0";
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
*/
$avg_rate=avg_rate($pid);
$rate_array=explode("@@",$avg_rate);
$stk_rate=$rate_array[0];
$rate=$rate_array[1];



$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pid'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
$qnty=1;
if($unit=='sun'){$stock_in=$qnty*$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$qnty*$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$qnty*$bgvlu;$uval=$bgvlu;}

$ret=0;
$query21 = "INSERT INTO ".$DBprefix."trndtl (fbcd,prsl,prnm,qty,blno,remk,refno,unit,usl,ret,rate,stk_rate,betno,uval) VALUES 
('$fbcd','$pid','$prnm','$qnty','$blno','$remk','$refno','$unit','$usl','$ret','$rate','$stk_rate','$betno','$uval')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$query1 = "SELECT * FROM ".$DBprefix."trndtl where blno='$blno' order by sl desc limit 0,1";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$trn_sl=$R1['sl'];
}

$query21 = "INSERT INTO ".$DBprefix."stock(pcd,bcd,dt,stout,nrtn,eby,dtm,stat,refno,tout,ret,rate,stk_rate,unit,usl,betno,uval,trn_sl) VALUES 
('$pid','$fbcd','$dt','$stock_in','Transfer','$user_currently_loged','$edtm','0','$refno','$blno','$ret','$rate','$stk_rate','$unit','$usl','$betno','$uval','$trn_sl')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

}
?>
<script>
temp();
reset();
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