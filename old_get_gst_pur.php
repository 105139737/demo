<?
$reqlevel = 1;
include("membersonly.inc.php");

$dt=$_REQUEST[dt];
$prnm=$_REQUEST[prnm];
$dt=date('Y-m-d', strtotime($dt));

if($cat=='')
{
$data1 = mysqli_query($conn,"Select * from main_product where sl='$prnm'");
while ($row1 = mysqli_fetch_array($data1))
{
$cat=$row1['scat'];	
}	
}
$data1 = mysqli_query($conn,"Select * from main_gst where cat='$prnm' and '$dt' between fdt and tdt") or die (mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cgst=$row1['cgst'];
$sgst=$row1['sgst'];	
$igst=$row1['igst'];	
}
if($cgst==''){$cgst=0;}
if($sgst==''){$sgst=0;}
if($igst==''){$igst=0;}
echo $cgst."@".$sgst."@".$igst;
