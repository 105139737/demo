<?PHP $reqlevel = 3; 
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
$sl=$_POST['sl'];
$err=="";


if($err==""){
$query6 = "update main_dirver set cdet='$cdet',dnm='$dnm',addr='$addr',mob1='$mob1',mob2='$mob2',ltyp='$ltyp' where sl='$sl'";
$result6 = mysqli_query($conn,$query6) or die(mysqli_error($conn));


?>
<Script language="JavaScript">
alert('Update Successfully. Thank You...');
document.location="cardiver_show.php";
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