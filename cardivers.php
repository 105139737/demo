<?php  $reqlevel = 3; 
include("membersonly.inc.php");

$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$cno=$_POST['cno'];
$cdet=$_POST['cdet'];
$dnm=$_POST['dnm'];
$addr=$_POST['addr'];
$mob1=$_POST['mob1'];
$mob2=$_POST['mob2'];
$lno=$_POST['lno'];
$ltyp=$_POST['ltyp'];
$err=="";


$queryx="select * from main_dirver where lno='$lno' and cno='$cno' and dnm='$dnm'";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx>0){
    $err="Data Already Exist";
}

if($err==""){
$query6 = "INSERT INTO main_dirver (cno,cdet,dnm,addr,mob1,mob2,lno,ltyp,edtm,eby) VALUES ('$cno','$cdet','$dnm','$addr','$mob1','$mob2','$lno','$ltyp','$dttm','$user_currently_loged')";
$result6 = mysqli_query($conn,$query6) or die(mysqli_error($conn));


?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
document.location="cardiver.php";
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