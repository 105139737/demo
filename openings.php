<?PHP
$reqlevel = 3; 
include("membersonly.inc.php");
$edtm=date('y-m-d H:i:s a');
$fy=date('Y');
$fm=date('m');
if($fm<4)
{$fy--;
}
$dt=$fy."-04-01";


$dttm=date('d-m-Y H:i:s');
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

$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,unit,usl,dt,opst,nrtn,eby,dtm,stat,refno,pbill,uval,pret)
 VALUES ('$prnm','$branch_code','$unt','$usl','$dt','$stock_in','Open Stock','$user_currently_loged','$dttm','1','Open Stock','Open Stock','$uval','$pret')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));



?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
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