<?
$reqlevel = 3;
include("membersonly.inc.php");

$sl=$_POST['sl'];
$pcd=$_POST['pcd'];
$qnty=$_POST['qnty'];
$amm=$_POST['amm'];
$rmk=$_POST['rmk'];
$calltyp=$_POST['calltyp'];
$tid=$_POST['tid'];
$callid=$_POST['callid'];
$refno=$_POST['refno'];
$cid=$_POST['cid'];
date_default_timezone_set("Asia/kolkata");
$dt=date('Y-m-d');
$dtm=date('Y-m-d h:i:s a');
if($calltyp==1)
{
	
}
elseif($calltyp==2)
{
	$y=mysqli_query($conn,"select * from main_tech_trntemp_close where eby='$user_currently_loged'") or die (mysqli_error($conn));
	while($ar=mysqli_fetch_array($y))
	{
		$pcd=$ar['pcd'];
		$qnty=$ar['qnty'];
		$tid=$ar['tid'];	
		$q=mysqli_query($conn,"insert into main_pstock(pcd,tid,stout,nrtn,dt,dtm,refno,pbill,eby) values('$pcd','$tid','$qnty','Stock Out','$dt','$dtm','$refno','$refno','$user_currently_loged')")or die (mysqli_error($conn));
		$q=mysqli_query($conn,"insert into main_cus_parts(pcd,tid,cid,qnty,dt,dtm,refno,eby) values('$pcd','$tid','$cid','$qnty','$dt','$dtm','$refno','$user_currently_loged')")or die (mysqli_error($conn));
	}
}
elseif($calltyp==3)
{
	
}
elseif($calltyp==4)
{
	
}
$sql=mysqli_query($conn,"update main_call set stat='3' where sl='$sl'") or die(mysqli_error($conn));
$y=mysqli_query($conn,"insert into main_call_dtls(callid,techid,stat,remark) values('$callid','$tid','3','$rmk')")or die(mysqli_error($conn));
?>

<script>
alert('Call Close Successfully. Thank You');
document.location="dktcl_assign_list.php";
</script>