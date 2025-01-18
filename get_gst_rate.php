<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$sgst=0;
$cgst=0;
$igst=0;
$hsn="";

$dt=$_REQUEST['dt'] ?? "";
$prnm=$_REQUEST['prnm'] ?? "";
$dt=date('Y-m-d', strtotime($dt));

$cat="";
if($cat=='')
{
$data1 = mysqli_query($conn,"Select * from main_product where sl='$prnm'");
while ($row1 = mysqli_fetch_array($data1))
{
$cat=$row1['scat'];	
$hsn=$row1['hsn'];	
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
$mrp=0;
$disp=0;
$disa=0;
$query67="select * from main_purchasedet where prsl='$prnm' order by sl desc limit 0,1";
$result57 = mysqli_query($conn,$query67) or die (mysqli_error($conn));
while($row7=mysqli_fetch_array($result57))
{
$mrp=$row7['mrp'];
$disp=$row7['disp'];
$disa=$row7['disa'];
}
echo $cgst."@".$sgst."@".$igst."@".$mrp."@".$disp."@".$hsn;
