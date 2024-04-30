<?php
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
$eby=$user_currently_loged;

$sl=$_REQUEST['sl'];

$err="";

$qr=mysqli_query($conn,"select * from main_ledg where gcd='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="This group allready used.";}

if($err=="")
{
$query_log1 = "insert into  main_group_dlt_log (prv_sl,pcd,nm,stat,eby,edt,edtm)
select '$sl',pcd,nm,stat,'$eby','$edt','$edtm' from main_group where sl = '$sl'";
$result_log1 = mysqli_query($conn,$query_log1)or die (mysqli_error($conn)); 

$qr2=mysqli_query($conn,"delete from main_group where sl='$sl'") or die (mysqli_error($conn)); 
$err="Data Delete Successfully.";
}

?>
<script>
alert("<?php echo $err; ?>");
window.history.go(-1);
</script>
