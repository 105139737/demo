<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$blno_ref=$_REQUEST['blno'];

$sln=0;

$data1=mysqli_query($conn,"SELECT * FROM main_recv where sl>0 and blno='$blno_ref'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$sln++;
$sl=$row1['sl'];
$dt=$row1['dt'];
$nrtn=$row1['nrtn'];
$tamm=$row1['tamm'];
$refno=$row1['refno'];
$paymtd=$row1['paymtd'];
$dldgr=$row1['dldgr'];
$sman=$row1['eby'];
$bcd=$row1['bcd'];
$cid=$row1['cid'];
}
$dt=date('d-m-Y',strtotime($dt));

$result2 = mysqli_query($conn,"DELETE FROM main_recv_reg_temp WHERE eby='$user_currently_loged' and cid='$cid' and brncd='$bcd' and app_ref='$blno_ref'");

$query100 = "SELECT * FROM main_recv_dtl where  ref='$blno_ref' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$bill_no=$R100['blno'];
$amm=$R100['amm'];
$cldgr=$R100['cldgr'];
$disl=$R100['disl'];
$damm=$R100['damm'];
$remk=$R100['remk'];
$cid=$R100['cid'];
$brncd=$R100['brncd'];
$err=0;
$T=0;
$t1=0;
$t2=0;

if($err==0)
{
$query21 = "INSERT INTO main_recv_reg_temp (blno,amm,sman,cid,eby,brncd,disl,damm,remk,app_ref)
VALUES ('$bill_no','$amm','$sman','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk','$blno_ref')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));		
}

}

?>
<script>

document.getElementById('dt').value="<?php  echo $dt;?>";
document.getElementById('nrtn').value="<?php  echo $nrtn;?>";
$('#dldgr').val('<?php  echo $dldgr;?>');
$('#dldgr').trigger('chosen:updated');
$('#paymtd').val('<?php  echo $paymtd;?>');
$('#paymtd').trigger('chosen:updated');
//document.getElementById('tamm').value="<?php  echo $tamm;?>";
document.getElementById('refno').value="<?php  echo $refno;?>";
document.getElementById('blno_ref').value="<?php  echo $blno_ref;?>";
$('#compose-modal1').modal('hide');	
temp();
reset();
</script>
