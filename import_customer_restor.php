<?php
include "config.php";
$edt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$result1 = mysqli_query($conn,"SELECT * FROM main_billing where invto!='' order by sl");
while ($R = mysqli_fetch_array ($result1))
{
$invto=$R['invto'];

$dsql3=mysqli_query($conn,"select * from main_cust where sl='$invto'") or die (mysqli_error($conn));
$drcnt3=mysqli_num_rows($dsql3);
if($drcnt3==0)
{
	
$result=mysqli_query($conn,"insert into main_cust(sl,typ,brncd,nmp,brand,nm,addr,cont,pin,town,distn,mail,vat_no,dob,doa,edt,edtm,eby,stat,gstin,pan,gstdt,fst,sale_per,lat,lng,lot,drcr)
select sl,typ,brncd,nmp,brand,nm,addr,cont,pin,town,distn,mail,vat_no,dob,doa,edt,edtm,eby,stat,gstin,pan,gstdt,fst,sale_per,lat,lng,lot,drcr from main_cust_del where sl = '$invto'");	

echo "insert into main_cust(sl,typ,brncd,nmp,brand,nm,addr,cont,pin,town,distn,mail,vat_no,dob,doa,edt,edtm,eby,stat,gstin,pan,gstdt,fst,sale_per,lat,lng,lot,drcr)
select sl,typ,brncd,nmp,brand,nm,addr,cont,pin,town,distn,mail,vat_no,dob,doa,edt,edtm,eby,stat,gstin,pan,gstdt,fst,sale_per,lat,lng,lot,drcr from main_cust_del where sl = '$invto'<br>";

}
}