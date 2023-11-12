<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$sid=$_POST['cust'];
$amm=$_POST['amm'];
$rmk=$_POST['rmk'];
$pmd=$_POST['pmd'];
$bnm=$_POST['bnm'];
$rfno=$_POST['rfno'];
$idt=$_POST['idt'];
$iby=$_POST['iby'];
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

if($pmd=='1')
{
$cldgr=1;
}  
else
{
$cldgr=$bnm;
} 

  $vid1=0;
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vno=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vcno="SV".$vno;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

}
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','','','','$sid','$edt','Payment By Customer','$idt','$pmd','$rfno','$cldgr','19','$amm','$branch_code','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21);

?>
<script language="javascript">
alert('Submit Sucessfully.');
document.location='pay.php';
</script>
<?

