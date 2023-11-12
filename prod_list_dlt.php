<?php
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
$eby=$user_currently_loged;

$sl=$_REQUEST['sl'];
//main_product_dlt_log
//main_stock pcd

$err="";

$qr=mysqli_query($conn,"select * from main_stock where pcd='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0){$err="This model allready used.";}

if($err=="")
{
$query_log1 = "insert into  main_product_dlt_log (prv_sl,cat,scat,pnm,unit,mrp,smvlu,mdvlu,bgvlu,hsn,typ,stat,eby,edt,edtm)
select '$sl',cat,scat,pnm,unit,mrp,smvlu,mdvlu,bgvlu,hsn,typ,stat,'$eby','$edt','$edtm' from main_product where sl = '$sl'";
$result_log1 = mysqli_query($conn,$query_log1)or die (mysqli_error($conn)); 

$qr2=mysqli_query($conn,"delete from main_product where sl='$sl'") or die (mysqli_error($conn)); 

?>
<script>
get_list();	
</script>
<? 
}
else
{
?>
<script>
alert("<?php echo $err; ?>");
get_list();	
</script>
<? 
}	
?>