<?
$reqlevel = 3; 
include("membersonly.inc.php");
$get1=mysqli_query($conn,"select * from bills_receivable order by sl") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
	$SALES_PERSON=strtoupper($row1['SALES_PERSON']);
	$sl=$row1['sl'];
	$dt=$row1['Date'];
	$Ref_No=$row1['Ref_No'];
	$Party_Name=$row1['Party_Name'];
	$Pending=$row1['Pending'];
	
	$custnm="";
$get6=mysqli_query($conn,"select * from main_cust where nm='$Party_Name'") or die(mysqli_error($conn));
while($row5=mysqli_fetch_array($get6))
{
$custnm=$row5['sl'];
}

$get61=mysqli_query($conn,"select * from main_drcr where cbill='$Ref_No' and cid='$custnm' and amm='$Pending' and nrtn='Sale' and dt='$dt' and dldgr='4' and cldgr='-2' and sman='$SALES_PERSON' and eby='onsadmin' order by sl limit 0,1") or die(mysqli_error($conn));
while($row5=mysqli_fetch_array($get61))
{
$dsl=$row5['sl'];
}

echo "update bills_receivable set dsl='$dsl' where sl='$sl'";
$sql=mysqli_query($conn,"update bills_receivable set dsl='$dsl' where sl='$sl'") or die (mysqli_error($conn));
echo $str."<br>";
}

?>