<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
$eby=$user_currently_loged;

$sl=$_REQUEST['sl'];

$err="";

$qr=mysqli_query($conn,"select * from main_drcr where cldgr='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="This ledger allready used.";}

$qr=mysqli_query($conn,"select * from main_drcr where dldgr='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="This ledger allready used.";}

if($err=="")
{
$query_log1 = "insert into  main_ledg_dlt_log (prv_sl,gcd,nm,stat,eby,edt,edtm)
select '$sl',gcd,nm,stat,'$eby','$edt','$edtm' from main_ledg where sl = '$sl'";
$result_log1 = mysqli_query($conn,$query_log1)or die (mysqli_error($conn)); 

$qr2=mysqli_query($conn,"delete from main_ledg where sl='$sl'") or die (mysqli_error($conn)); 

?>
<script>
sh();	
</script>
<?php  
}
else
{
?>
<script>
alert("<?php  echo $err; ?>");
sh();	
</script>
<?php  
}	
?>