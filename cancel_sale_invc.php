<?php  
include("membersonly.inc.php");
$billno=rawurldecode($_REQUEST['billno']);
$edtm = date('d-m-Y h:i:s a', time());
$dt=date('Y-m-d');	




$typ="ADV77";

$data1= mysqli_query($conn,"select * from  main_billing where blno='$billno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cid=$row1['cid'];
$bcd=$row1['bcd'];
$sale_per=$row1['sale_per'];
}

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='4' and cid='$cid' and brncd='$bcd' and cbill='$billno'");
while ($row = mysqli_fetch_array($data))
{
$rgttl=$row['t1'];
}
/*	
$query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM ".$DBprefix."billdtls where blno='$billno'";
$result1 = mysqli_query($conn,$query1);
$count_row = mysqli_num_rows($result1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}
$gstam=$cgst+$sgst+$igst;
$bilamm=$gttl+$cgst+$sgst+$igst;
$rgttl=round($bilamm);

$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno1','$dt','Bill Cancel ( $billno )','$typ','-2','$paymtd','$refno','7','$rgttl','$user_currently_loged','$edtm','$cid','$bcd','$blno','$sale_per','$btyp','$als','$ssn','$bsl','$blnon','$billno')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
//mysqli_query($conn,"DELETE FROM main_drcr WHERE cbill='$billno' AND dldgr!='7' AND cldgr='4'");

mysqli_query($conn,"UPDATE main_drcr SET cbill='',nrtn='Bill Cancel ( $billno )' WHERE cbill='$billno' AND dldgr='7' AND cldgr='4'");


*/
$blno="";
if($billno!='')
{
$data1= mysqli_query($conn,"select * from  main_drcr where cbill='$billno' AND cldgr='4' AND pay='1' and typ='CC01'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
}	
mysqli_query($conn,"DELETE FROM main_drcr WHERE cbill='$billno' AND dldgr='4' AND (cldgr='-2' OR cldgr='37' OR cldgr='38' OR cldgr='39' or cldgr='183')");

mysqli_query($conn,"DELETE FROM main_drcr WHERE cbill='$billno' AND cldgr='4' AND pay='1' and typ='CC01'");
mysqli_query($conn,"DELETE FROM main_stock WHERE sbill='$billno'");
mysqli_query($conn,"UPDATE main_billing SET cstat='1' WHERE blno='$billno'");
mysqli_query($conn,"UPDATE main_recv_dtl SET disl='',damm='',remk='' WHERE ref='$blno' and blno='$billno'");
mysqli_query($conn,"UPDATE main_recv_dtl_app SET disl='',damm='',remk='' WHERE ref='$blno' and blno='$billno'");

$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$billno'") or die(mysqli_error($conn));
}

?>
<script>
alert("Canceled Successfully.Thank You....");
show1();
</script>