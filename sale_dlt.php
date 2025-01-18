<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');

$blno=$_REQUEST['blno'];

 $query21 = "insert into  dell_log (blno,fst,tst,gst,cid,amm,tpoint,paid,due,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,tmod,psup,vno,lpd,gstin,eby,rstat,edt1,edtm1,eby1)
select blno,fst,tst,gst,cid,amm,tpoint,paid,due,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,tmod,psup,vno,lpd,gstin,eby,rstat,'$edt','$edtm','$user_currently_loged'
from main_billing where blno = '$blno'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 



 $query214 = "insert into  dell_log1 (cat,scat,prsl,imei,unit,usl,kg,grm,pcs,srt,adp,prc,ttl,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,refno,retno,rdt,edt1,edtm1,eby1)
select cat,scat,prsl,imei,unit,usl,kg,grm,pcs,srt,adp,prc,ttl,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,refno,retno,rdt,'$edt','$edtm','$user_currently_loged'
from main_billdtls where blno = '$blno'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn)); 


$qr=mysqli_query($conn,"delete from  main_stock where sbill='$blno'")or die(mysqli_error($conn));
$qr1=mysqli_query($conn,"delete from  main_drcr where cbill='$blno'")or die(mysqli_error($conn));
$qr2=mysqli_query($conn,"delete from main_billing where blno='$blno'")or die(mysqli_error($conn));
$qr3=mysqli_query($conn,"delete from main_billdtls where blno='$blno'")or die(mysqli_error($conn));


?>
<script>
alert("Delete Successfully . Thank You....");
show1();
</script>
