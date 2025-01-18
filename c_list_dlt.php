<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
$eby=$user_currently_loged;

$sl=$_REQUEST['sl'];

$err="";

$qr=mysqli_query($conn,"select * from main_billing where cid='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="Delete this customer is not possible.";}

$qr=mysqli_query($conn,"select * from main_billing where invto='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="Delete this customer is not possible.";}

$qr=mysqli_query($conn,"select * from main_drcr where cid='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="Delete this customer is not possible.";}

$qr=mysqli_query($conn,"select * from main_order where cid='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="Delete this customer is not possible.";}

$qr=mysqli_query($conn,"select * from main_cust_asgn where FIND_IN_SET(sl, '$sl')") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="Delete this customer is not possible.";}

if($err=="")
{
$query_log1 = "insert into  main_cust_dlt_log (prv_sl,typ,brncd,nmp,brand,nm,addr,cont,pin,town,distn,mail,vat_no,dob,doa,stat,gstin,pan,gstdt,fst,sale_per,lat,lng,lot,drcr,eby,edt,edtm)
select '$sl',typ,brncd,nmp,brand,nm,addr,cont,pin,town,distn,mail,vat_no,dob,doa,stat,gstin,pan,gstdt,fst,sale_per,lat,lng,lot,drcr,'$eby','$edt','$edtm' from main_cust where sl = '$sl'";
$result_log1 = mysqli_query($conn,$query_log1)or die (mysqli_error($conn)); 

$qr2=mysqli_query($conn,"delete from main_cust where sl='$sl'") or die (mysqli_error($conn)); 

?>
<script>
show();	
</script>
<?php  
}
else
{
?>
<script>
alert("<?php  echo $err; ?>");
show();	
</script>
<?php  
}	
?>
