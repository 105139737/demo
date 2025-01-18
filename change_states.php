<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$state = $_POST['state'];
$blno = $_POST['blno'];

$update_pur = mysqli_query($conn,"UPDATE main_purchase set fst='$state' where blno='$blno'");

$query="SELECT * FROM main_purchase where blno='$blno'";
$result = mysqli_query($conn,$query);
while($rows=mysqli_fetch_array($result))
{
$fst=$rows['fst'];
$tst=$rows['tst'];
}


$query51="SELECT * FROM main_purchasedet where blno='$blno'";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
$sl=$rows['sl'];
$igst_rt=$rows['igst_rt'];
$igst_am=$rows['igst_am'];
$cgst_rt=$rows['cgst_rt'];
$cgst_am=$rows['cgst_am'];
$sgst_rt=$rows['sgst_rt'];
$sgst_am=$rows['sgst_am'];

if($fst!=$tst)
{
$igst_rt=$cgst_rt+$sgst_rt;
$igst_am=$sgst_am+$cgst_am;	
$cgst_rt=0;
$cgst_am=0;
$sgst_rt=0;
$sgst_am=0;
}
else
{
$cgst_rt=($igst_rt/2);
$cgst_am=($igst_am/2);
$sgst_rt=($igst_rt/2);
$sgst_am=($igst_am/2);
$igst_rt=0;
$igst_am=0;
}



$update_pur_det = mysqli_query($conn,"UPDATE main_purchasedet set cgst_rt='$cgst_rt',cgst_am='$cgst_am',sgst_rt='$sgst_rt',sgst_am='$sgst_am',igst_rt='$igst_rt',igst_am='$igst_am',fst='$state' where sl='$sl'");


}

	?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location = "purchase_edit.php?blno=<?php  echo $blno;?>";
</script>