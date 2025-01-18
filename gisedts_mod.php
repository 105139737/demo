<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set("Asia/Kolkata");
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s a');
$sl=rawurldecode($_REQUEST['sl']);
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$fv1=rawurldecode($_REQUEST['fv']);
$tblnm=$_REQUEST['tblnm'];
$dt=$_REQUEST['dt'];
$ldgr=$_REQUEST['ldgr'];
$dt=date('Y-m-d',strtotime($dt));
if($fv!='')
{
if($fn=='brs_dt'){$fv=date('Y-m-d',strtotime($fv));}
}
else
{
$fv="0000-00-00";	
}
if(($fv>date('Y-m-d',strtotime('2010-01-01')) or $fv=="0000-00-00") and $ldgr!='')	
{
if($fv=="0000-00-00"){$fv='';}
$sql =mysqli_query($conn,"UPDATE  $tblnm set $fn='$fv' where blnon='$sl' and dt='$dt' and  (dldgr='$ldgr' or cldgr='$ldgr')")or die(mysqli_error($conn));

?>
<font color="green"><b>Success</b></font>
<?php }
else
{
?>
<font color="red"><b>Error</b></font>
<?php 	
}
?>

<script>
ttl();
</script>
