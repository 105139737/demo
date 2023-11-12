<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];	

$query214 = "insert into main_drcr_log (vno,blno,sbill,cbill,sman,sid,cid,dt,nrtn,typ,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm,pno,it,stat,pay,ttyp,btyp,als,ssn,bill_typ,blnon,adj_blno,retn_stat,dsl)
select vno,blno,sbill,cbill,sman,sid,cid,dt,nrtn,typ,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm,pno,it,stat,pay,ttyp,btyp,als,ssn,bill_typ,blnon,adj_blno,retn_stat,'$sl'
from main_drcr where sl = '$sl'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn)); 

mysqli_query($conn,"DELETE FROM main_drcr where sl='$sl'") or die (mysqli_error($conn));

?>
<script>
alert("Cancelled Successfuly...!!");
sh();
</script>