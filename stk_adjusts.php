<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');


$brncd=$_POST['brncd'];
$cat=$_POST['cat'];
$scat=$_POST['scat'];
$prnm=$_POST['prnm'];
$rate=$_POST['rate'];
$stk_rate=$_POST['stk_rate'];
$sih=$_POST['sih'];
$qty=$_POST['qty'];
$unit=$_POST['unit'];
$betno=$_POST['betno'];
$adj_typ=$_POST['adj_typ'];
$dt=$_POST['dt'];

	
	$val=date_chk($dt);
	if($val==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. Please Go Back Previous Page....</font></center></b>');
	}

$err="";
if($brncd=="" or  $prnm=="" or $rate=="" or $stk_rate=="" or $qty=="" or $adj_typ=="" or $dt=="")
{
	$err="Please All Fields..!!";
}
if($err=="")
{
$dt=date('Y-m-d', strtotime($dt));
	
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

if($unit=='sun'){$stock_in=$qty*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$qty*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$qty*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;}
/*
if($unit=='sun'){$stock_in=$qty*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='mun'){$stock_in=$qty*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='bun'){$stock_in=$qty*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;$stk_rate=$stk_rate1/$smvlu;}
*/


if($adj_typ=='1')
{
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stin,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate)
VALUES ('$prnm','$brncd','$dt','$unit','$stock_in','Adjustment','$user_currently_loged','$dttm','1','$rate','Adjustment','$usl','$uval','$betno','$rate','$stk_rate')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
else if($adj_typ=='0')
{
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stout,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate,sbill)
VALUES ('$prnm','$brncd','$dt','$unit','$stock_in','Adjustment','$user_currently_loged','$dttm','1','$rate','Adjustment','$usl','$uval','$betno','$rate','$stk_rate','Adjustment')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}

?>
<Script language="JavaScript">
alert('Submitted Successfully. Thank You...');
window.close();
</script>
<?php 
}
else
{
?>
<Script language="JavaScript">
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>
<?php 
}
?>
