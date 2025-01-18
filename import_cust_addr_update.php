<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$result = mysqli_query($conn,"SELECT * FROM sheet1 ");
while ($R = mysqli_fetch_array ($result))
{
$SALES_PERSON=strtoupper($R['SALES_PERSON']);
$Particulars=$R['Particulars'];
$Address=$R['Address'];
$cont=$R['cont'];
$State=$R['State'];
$GSTIN_UIN=$R['GSTIN_UIN'];
$catg=$R['catg'];
$pan=substr($GSTIN_UIN,2,10);
$gstdt="2017-07-01";
$state=substr($GSTIN_UIN,0,2);	
$fst="1";
$sql="SELECT * FROM main_state WHERE cd='$state'";
$result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while($row=mysqli_fetch_array($result1))
{
$fst=$row['sl'];	
}

$Address=str_replace("'","",$Address);


$dsql=mysqli_query($conn,"select * from main_cust where nm='$Particulars'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt==0)
{	
$Particulars=str_replace("'","",$Particulars);
//$sql=mysqli_query($conn,"insert into main_cust(typ,nm,addr,cont,edt,edtm,eby,gstin,pan,gstdt,fst,brand,nmp,sale_per,pin,town,distn)
//values('2','$Particulars','$Address','$cont','$edt','$dttm','$user_currently_loged','$GSTIN_UIN','$pan','$gstdt','$fst','$brndsl','$nmp','$SALES_PERSON','$pin','$town','$distn')") or die (mysqli_error($conn));


//echo "insert into main_cust(typ,nm,addr,cont,edt,edtm,eby,gstin,pan,gstdt,fst,brand,nmp,sale_per,pin,town,distn)values('2','$Particulars','$Address','$cont','$edt','$dttm','$user_currently_loged','$GSTIN_UIN','$pan','$gstdt','$fst','$brndsl','$nmp','$SALES_PERSON','$pin','$town','$distn')<br>";
}
else
{
if($Address!="")
{
$Particulars=str_replace("'","",$Particulars);
$sql=mysqli_query($conn,"update main_cust set addr='$Address',cont='$cont',fst='$fst',pan='$pan',gstin='$GSTIN_UIN',lot='1' where nm='$Particulars'") or die (mysqli_error($conn));
echo "update main_cust set addr='$Address',cont='$cont',fst='$fst',pan='$pan',gstin='$GSTIN_UIN' where nm='$Particulars' and addr=''"."<br>";
}	
}
}

?>