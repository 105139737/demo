<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$result = mysqli_query($conn,"SELECT * FROM main_cust order by sl");
while ($R = mysqli_fetch_array ($result))
{
$nm=$R['nm'];
$sl=$R['sl'];
$addr=$R['addr'];




$dsql=mysqli_query($conn,"select * from main_drcr where cid='$sl'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt==0)
{
$dsql1=mysqli_query($conn,"select * from main_order where cid='$sl'") or die (mysqli_error($conn));
$drcnt1=mysqli_num_rows($dsql1);
if($drcnt1==0)
{
$dsql2=mysqli_query($conn,"select * from main_billing where cid='$sl'") or die (mysqli_error($conn));
$drcnt2=mysqli_num_rows($dsql2);
if($drcnt2==0)
{
$dsql3=mysqli_query($conn,"select * from main_billing where invto='$sl'") or die (mysqli_error($conn));
$drcnt3=mysqli_num_rows($dsql3);
if($drcnt3==0)
{	
$dsql4 = mysqli_query($conn,"SELECT * from main_cust_asgn where sl>0 and FIND_IN_SET('$sl', cust)>0 ");
$drcnt4=mysqli_num_rows($dsql4);
if($drcnt4==0)
{	
echo $sl." --- ".$nm." -- ".$addr."<br>";
$dsql=mysqli_query($conn,"delete from main_cust  where sl='$sl' ") or die (mysqli_error($conn));	
}
}
}
}
}


/*
$dsql=mysqli_query($conn,"select * from main_drcr where cid='$sl'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt==0)
{	


}
else
{
$dsql=mysqli_query($conn,"update main_cust set drcr='yes' where sl='$sl'") or die (mysqli_error($conn));	
}
*/
}
$result = mysqli_query($conn,"SELECT * FROM main_drcr where cid!=''");
while ($R = mysqli_fetch_array ($result))
{
$cid=$R['cid'];

$nm1='';
$sl1='';
$addr1='';
$result1 = mysqli_query($conn,"SELECT * FROM main_cust where sl='$cid'");
while ($R = mysqli_fetch_array ($result1))
{
$nm1=$R['nm'];
$sl1=$R['sl'];
$addr1=$R['addr'];

}
echo $cid."---DRCR---".$sl1." --- ".$nm1." -- ".$addr1."<br>";
}

?>