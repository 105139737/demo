<?PHP
$reqlevel = 3; 
include("membersonly.inc.php");
include('SimpleImage.php');
$fy=date('Y');
$fm=date('m');
if($fm<4)
{$fy--;
}
$dt=$fy."-04-01";
$dttm=date('d-m-Y H:i:s');
$sl=$_POST['sl'];
$prnm=$_POST['prnm'];
$unt=$_POST['unit'];
$usl=$_POST['usl'];
$qnty=$_POST['qnty'];
$pret=$_POST['pret'];



$err="";
//ctyp	nm	id	mob	addr	email	adhr	pan	gstin	lcn	frt_id	bnk_ifsc	bnk_brnc	bnk_nm	bnk_acno	path	edt	eby	stat
if($prnm=="" or $unit=="" or $qnty=="")
{
$err=="Please Fill All The Fields ";
}


if($err==""){
	
	
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prnm'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unt=='sun'){$stock_in=$qnty*$smvlu;$uval=$smvlu;}
if($unt=='mun'){$stock_in=$qnty*$mdvlu;$uval=$mdvlu;}
if($unt=='bun'){$stock_in=$qnty*$bgvlu;$uval=$bgvlu;}

	
	
	
	


$query6 = "Update ".$DBprefix."stock set pcd='$prnm',unit='$unt',usl='$usl',opst='$stock_in',pret='$pret',uval='$uval' where sl='$sl'";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));

/*
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,unt,usl,mfg,expdt,betno,dt,opst,nrtn,eby,dtm,stat,refno,pbill)
 VALUES ('$prnm','$brncd','$unt','$usl','$mfg','$expdt','$betno','$dt','$qnty','Open Stock','$user_currently_loged','$dttm','1','Open Stock','Open Stock')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
*/


?>
<Script language="JavaScript">
alert('Update Successfully. Thank You...');
document.location="opening.php";
</script>
<?
}
else
{
?>
<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
}
?>