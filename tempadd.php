<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$cid=$_REQUEST["cid"];
$blno=$_REQUEST["blno"];
$amm=$_REQUEST["amm"];
$ramm=$_REQUEST["ramm"];
$nrtn=rawurldecode($_REQUEST["nrtn"]);

$eby=$user_currently_loged;
$err="";
if($cid==""){$err="Please Select Customer .....";}
if($blno==""){$err="Please Select Bill No .....";}
if($amm<0){$err="Please Enter Amount .....";}
if($ramm<$amm)
{
$err="Amount Can't be More Than Rest Amount";	
}
if($amm==0){$err="Amount Cant be Zero";}
$qr10=mysqli_query($conn,"select * from main_credit where blno='$blno' and cid='$cid' and amm='$amm' and eby='$eby'") or die(mysqli_error($conn));
$qcount=mysqli_num_rows($qr10);
if($qcount>0)
{
$err="Duplicate Entry ......";
}


if($err=="")
{
	$qr=mysqli_query($conn,"insert into main_credit(cid,blno,amm,nrtn,eby) values('$cid','$blno','$amm','$nrtn','$eby')");
?>
<script>
document.getElementById('blno').value='';
document.getElementById('cal_dbal').value=0;
document.getElementById('amm').value=0;
$("#blno option[value='<?php  echo $blno;?>']").remove(); 
$('#blno').trigger("chosen:updated");
recallRamm();
</script>
<?php 
}
else{
?>
<script>
alert("<?php  echo $err;?>");
ctmppr();
</script>
<?php  } ?>