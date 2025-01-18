<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cgst=$_POST['cgst'];
$sgst=$_POST['sgst'];
$igst=$_POST['igst'];
$cat=$_POST['cat'];
$fdt=$_POST['fdt'];
$tdt=$_POST['tdt'];
$sl=$_POST['sl'];
$msg="";

if($cgst=="" or $sgst=="" or $igst=="" or $cat=="")
{
?>
<script>
alert('Please Fill All The Fields.');
history.go(-1);
</script>
<?php 	
}
else
{
	
$cr=mysqli_query($conn,"select * from main_gst where cat='$cat' and ((fdt<='$fdt' and tdt>='$fdt') or (fdt<='$tdt' and tdt>='$tdt') or (fdt between '$fdt' and '$tdt') or (tdt between '$fdt' and '$tdt')) and sl!='$sl'")or die(mysqli_error($conn));

/*
$cr=mysqli_query($conn,"select * from main_gst where cat='$cat' and sl!='$sl'")or die(mysqli_error($conn));
*/
$rcnt=mysqli_num_rows($cr);
if($rcnt==0)
{
if($sl=="")
{	
$result=mysqli_query($conn,"INSERT INTO main_gst(cgst,sgst,igst,cat,fdt,tdt) VALUES ('$cgst','$sgst','$igst','$cat','$fdt','$tdt')") or die(mysqli_error($conn));
$msg="Submitted Successfully.";
$pag="gst.php";
}
else
{
$upresult=mysqli_query($conn,"UPDATE main_gst set cgst='$cgst',sgst='$sgst',igst='$igst',cat='$cat',fdt='$fdt',tdt='$tdt' where sl='$sl'") or die(mysqli_error($conn));	
$msg="Updated Successfully.";
$pag="gst_show.php";
}
?>
<script>
alert('<?php  echo $msg;?>');
window.location.assign('<?php  echo $pag;?>');
</script>
<?php 
}
else
{
?>
<script>
alert('Duplicate Entry');
history.go(-1);
</script>
<?php 
}
}
?>