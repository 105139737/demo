<?php
$reqlevel = 3;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$cdt=date('Y-m-d');
$edtm=date('Y-m-d h:i:s a');
set_time_limit(0);
$lot='na';


$get1=mysqli_query($conn,"select * from bills_receivable where lot='$lot' order by Date") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
$SALES_PERSON=strtoupper($row1['SALES_PERSON']);
$dt=$row1['Date'];
$Ref_No=$row1['Ref_No'];
$Party_Name=$row1['Party_Name'];
$Pending=$row1['Pending'];
$brncd=$row1['brncd'];	
$sl=$row1['sl'];	
$query51="select * from ".$DBprefix."drcr order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
while($count6>0)
{
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
$vcno="SV".$vnoc;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}
$custnm="";
$get6=mysqli_query($conn,"select * from main_cust where nm='$Party_Name'") or die(mysqli_error($conn));
while($row5=mysqli_fetch_array($get6))
{
$custnm=$row5['sl'];
} 

echo $query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$Ref_No','$custnm','$dt','Sale','4','-2','$Pending','$brncd','$user_currently_loged','$edtm','0','$SALES_PERSON')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));


$data191= mysqli_query($conn,"select * from ".$DBprefix."drcr order by sl desc limit 0,1")or die(mysqli_error($conn));
while ($row19 = mysqli_fetch_array($data191))
{
$dsl=$row19['sl'];
}
$sql = mysqli_query($conn,"update bills_receivable set dsl='$dsl' where sl='$sl'") or die(mysqli_error($conn));	

echo "<br>";
}



