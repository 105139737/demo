<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$pno=$_REQUEST[pno];
$cid=$_REQUEST[cid];
$blno=rawurldecode($_REQUEST[blno]);
$brncd=$_REQUEST[brncd];
$ramm=$_REQUEST[ramm];
$blno_ref=$_REQUEST[blno_ref];
$today=$_REQUEST['dt'];
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
$T=round($t1-$t2,2);
$due_amm=$T;
?>
<input type="text" name="cal_dbal" id="cal_dbal" value="<?echo $T;?>" class="sc" style="background :transparent; color : red;font-weight:bold;" readonly>
<?



$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
	$dt=$row2['dt'];
}

$diff = abs(strtotime($today) - strtotime($dt));
$day=($diff/60/60/24);
$result = mysqli_query($conn,"SELECT * FROM main_discount where custid='$cid' and days>='$day' order by days limit 0,1");
if(mysqli_num_rows($result)>0)
{
while ($row = mysqli_fetch_array($result))
{
	$custid=$row['custid'];
	$days=$row['days'];
	$prefnd=$row['prefnd'];
}
}
else
{
   	$days=0;
	$prefnd=0; 
}
if($prefnd==0)
{
if($T<0){$T=$T*(-1);}
if($T>$ramm){$T=$ramm;}
}
else
{
    if($T<0){$T=$T*(-1);}
if($T>$ramm){$T=$ramm;}

$damm=round($T*($prefnd/100),0);
$trcv=$T+$damm;

//echo $due_amm;
if($due_amm<$trcv)
{
    $T=round(($due_amm/(100+$prefnd))*100,0,0);
    $damm=round($T*($prefnd/100),0,2);
}

}



?>
<script>
document.getElementById('amm').value='<?=$T;?>';
document.getElementById('damm').value='<?=$damm;?>';
</script>