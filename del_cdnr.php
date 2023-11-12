<?php
/**
 * @author Onnet Solution
 * @copyright 2013
 */
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");

$refno=$_REQUEST['refno'];
//$typ=$_REQUEST['typ'];


$data=mysqli_query($conn,"select * from main_cdnr where refno='$refno'");
while($row=mysqli_fetch_array($data))
{
//$refno=$row['refno'];
$sup=$row['sup'];
$sgstin=$row['sgstin'];
$name=$row['name'];
$note_no=$row['note_no'];
$dt=$row['dt'];
$inv=$row['inv'];
$invdt=$row['invdt'];
$note_typ=$row['note_typ'];
$typ=$row['typ'];
$tax_rate=$row['tax_rate'];
$tax=$row['tax'];
$net=$row['net'];
$amm=$row['amm'];
$styp=$row['styp'];
$edt=$row['edt'];
$dsl=$row['dsl'];
$vno=$row['vno'];
}


$query51="select * from main_cdnr_del order by del_ref";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['del_ref'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
while($count6>0)
{
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
$del_ref="DEL".$vnoc;
$query5="select * from main_cdnr_del where del_ref='$del_ref'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);
}


$result=mysqli_query($conn,"insert into main_cdnr_del(del_ref,refno,sup,sgstin,name,note_no,dt,inv,invdt,note_typ,typ,tax_rate,tax,net,amm,styp,edt,dsl,vno )values('$del_ref','$refno','$sup','$sgstin','$name','$note_no','$dt','$inv','$invdt','$note_typ','$typ','$tax_rate','$tax','$net','$amm','$styp','$edt','$dsl','$vno')");		


$query2 = "DELETE FROM main_cdnr WHERE refno='$refno'";
$result2 = mysqli_query($conn,$query2);

$query23 = "DELETE FROM main_drcr WHERE sbill='$refno' and typ='C02'";
$result23 = mysqli_query($conn,$query23);


?>
<script>
show();
</script>