<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$pno=$_REQUEST['pno'] ?? "";
$cid=$_REQUEST['cid'] ?? "";
$blno=rawurldecode($_REQUEST['blno'] ?? "");
$brncd=$_REQUEST['brncd'] ?? "";
$ramm=$_REQUEST['ramm']??0;
$blno_ref=$_REQUEST['blno_ref']??"";
$today=$_REQUEST['dt']??"";
//$today=date('Y-m-d');
$today=date('Y-m-d',strtotime($today));
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($cid!="")
{
	$cid1=" and (cid='$cid' or sid='$cid')";
}
else
{
$cid1="";
}

$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";
$blno_ref1="";
if($blno_ref!="")	
{
$blno_ref1=" and blno!='$blno_ref'";
}
$T=0;
$t1=0;
$t2=0;
/*
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld.$blno_ref1);
while ($row = mysqli_fetch_array($data))
{
$t1 = round($row['t1'],2);
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld.$blno_ref1);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = round($row1['t2'],2);
}
$T=round($t1-$t2,2);*/
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='$sl', amm, 0)) - SUM(IF(cldgr='$sl', amm, 0))) AS amm FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$blno_ref1)or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
$T=round($R16['amm'],2);
}
$due_amm=round($T,2);
?>
<input type="text" name="cal_dbal" id="cal_dbal" value="<?php echo $T;?>" class="sc" style="background :transparent; color : red;font-weight:bold;" readonly>
<?php 
if($T>$ramm){$T=$ramm;}
?>
<script>
document.getElementById('amm').value='<?php  echo $T;?>';
</script>