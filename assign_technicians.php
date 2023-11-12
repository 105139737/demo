<?php
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=date('d-M-Y');
$cy=date('Y');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');

$sl=$_POST['sl'];
$tech_id=$_POST['tech_id'];
$branch=$_POST['branch'];
$dt3=$_POST['dt'];
$rmk=$_POST['rmk'];
$dt=date('Y-m-d',strtotime($dt3));
$get=mysqli_query($conn,"select * from main_tech order by refno") or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($get))
		{
			$vnos=$row['refno'];
		}
		$vid1=substr($vnos,2,4);
		$rcnt=5;
		while($rcnt>0)
		{
			$vid1=$vid1+1;
			$vnoc=str_pad($vid1, 4, '0', STR_PAD_LEFT);
			$vcno="REF".$vnoc;
			$get1=mysqli_query($conn,"select * from main_tech where refno='$vcno'") or die(mysqli_error($conn));
			$rcnt=mysqli_num_rows($get1);
		}
		$refno=$vcno;
$y=mysqli_query($conn,"insert into main_tech(tid,bcd,dt,remk,refno) values('$tech_id','$branch','$dt','$rmk','$refno')") or die(mysqli_error($conn));
$sql1=mysqli_query($conn,"select * from main_tech_trntemp where eby='$user_currently_loged'")  or die(mysqli_error($conn));
while($r=mysqli_fetch_array($sql1))
{
	$pcd=$r['pcd'];
	$qnty=$r['qnty'];
	$a=mysqli_query($conn,"insert into main_tech_det(pcd,qty,refno) values('$pcd','$qnty','$refno')") or die(mysqli_error($conn));
	$b=mysqli_query($conn,"insert into main_pstock(pcd,bcd,dt,stout,nrtn,dtm,eby,stat,refno) values('$pcd','$branch','$dt','$qnty','Stock Out','$dtm','$user_currently_loged','1','$refno')") or die(mysqli_error($conn));
	$c=mysqli_query($conn,"insert into main_pstock(tid,pcd,bcd,dt,stin,nrtn,dtm,eby,stat,refno) values('$tech_id','$pcd','$branch','$dt','$qnty','Stock In','$dtm','$user_currently_loged','1','$refno')") or die(mysqli_error($conn));
}
$sql=mysqli_query($conn,"update main_call set tech_id='$tech_id',parts='$parts',refno='$refno',stat='2' where sl='$sl'") or die(mysqli_error($conn));

$get2=mysqli_query($conn,"select * from main_call where sl='$sl'") or die(mysqli_error($conn));
while($row2=mysqli_fetch_array($get2))
{
	$call_id=$row2['call_id'];
}

$sql2=mysqli_query($conn,"insert into main_call_dtls(callid,techid,stat,remark,parts,edt,edtm,eby) values('$call_id','$tech_id','2','$rmk','$parts','$edt','$edtm','$user_currently_loged')") or die (mysqli_error($conn));
$gh=mysqli_query($conn,"delete from main_tech_trntemp where eby='$user_currently_loged'")or die(mysqli_error($conn));
?>
<script>
alert('Submitted Successfully. Thank You');
document.location="dktcl_pnding_list.php";
</script>
<?