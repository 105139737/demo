<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$bill_typ=$_REQUEST['bill_typ'];
$query1 = "SELECT sum(ttl) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM main_ser_slt where eby='$user_currently_loged' and bill_typ='$bill_typ'";
$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}
$gst=round($cgst+$sgst+$igst,2);


?>

<input type="text" name="gst" id="gst" class="form-control" value="<?php  echo $gst;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
