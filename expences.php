<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$dt=$_POST['dt'];
$nm=$_POST['nm'];
$addr=$_POST['addr'];
$nrtn=$_POST['nrtn'];
$pmode=$_POST['pmode'];
$amm=$_POST['amm'];
$crid=$_POST['crid'];
$bill=$_POST['bill'];
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$dt=date('Y-m-d', strtotime($dt));

$drid=$pmode;



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

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,bill,dt,nrtn,dldgr,mtd,mtddtl,idt,cldgr,amm,eby,edt,pnm,paddr,cont,brncd) VALUES ('$vcno','$bill','$dt','$nrtn','$drid','','','$idt','$crid','$amm','$user_currently_loged','$edt','$nm','$addr','','$branch_code')";
$result21 = mysqli_query($conn,$query21);
?>
<script language="javascript">
alert('Submit Sucessfully.');
document.location='expence.php';
</script>
<?php 

