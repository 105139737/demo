<?php
$reqlevel = 3;
include "membersonly.inc.php";
include "functions.php";
include('QR_BarCode.php');
$dttm = date('d-m-Y H:i:s');
$dt = date('Y-m-d');
$blno = $_POST['blno'];


$result5 = mysqli_query($conn,"select * from main_billing where  blno='$blno' ");
while ($row1 = mysqli_fetch_array($result5))
{
	$bill_sl=$row1['sl'];
	$refsl=$row1['refsl'];
	$bill_typ=$row1['bill_typ'];
	$als=$row1['als'];
	$tp=$row1['tp'];
	$adrs=$row1['adrs'];
	$ssn=$row1['ssn'];
	$start_no=$row1['start_no'];
	$blno=$row1['blno'];
	$bill_no=$row1['bill_no'];



$path="einvjson";
if (!file_exists($path)) {
mkdir($path);
}

$target_dir="einvjson/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$path="einvjson/".$bill_sl.".".$ext;
if (file_exists($_FILES['fileToUpload']['tmp_name'])) {
move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path);

$json = file_get_contents($path);
$data = json_decode($json, TRUE);

$AckNo=$data['AckNo'];
$AckDt=$data['AckDt'];
$Irn=$data['Irn'];
$SignedInvoice=$data['SignedInvoice'];
$SignedQRCode=$data['SignedQRCode'];
$Status=$data['Status'];
$EwbNo=$data['EwbNo'];
$EwbDt=$data['EwbDt'];
$EwbValidTill=$data['EwbValidTill'];
$Remarks=$data['Remarks'];


$qrupdt =mysqli_query($conn, "UPDATE main_billing set colorStatus=0,einv_path='$path',einv_stat='1',AckNo='$AckNo',AckDt='$AckDt',Irn='$Irn'
,SignedInvoice='$SignedInvoice',SignedQRCode='$SignedQRCode',Status='$Status',EwbNo='$EwbNo',EwbDt='$EwbDt',EwbValidTill='$EwbValidTill',Remarks='$Remarks' where sl='$bill_sl'")or die (mysqli_error($conn));
$qr = new QR_BarCode();
//create text QR code
$qr->text($SignedQRCode);
//Save QR in image
$qr->qrCode(120,'einvjson/'.$bill_sl.'.png');
}
}
?>
<script>
alert("Upload Successfully.....");
window.close();
</script>
