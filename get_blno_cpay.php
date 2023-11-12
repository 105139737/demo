<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$pno=$_REQUEST[pno];
 $cid=$_REQUEST[cid];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($cid!="")
{
$cid1=" and cid='$cid' ";
}
else
{
$cid1="";
}
$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";
?>
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvlfi()">
<!--<option value="Opening">Opening</option>-->
<?

$data2= mysqli_query($conn,"select * from  main_billing where bcd='$brncd' and invto='$cid'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$blno=$row2['blno'];
$payam=$row2['payam'];
$paid=$row2['paid'];

$nm="";
$query="select * from main_cust WHERE sl='$cid'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['nm'];
}
$T=$payam-$paid;
/*
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and sbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and sbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;
*/

?>
<option value="<?=$blno?>"><?=$blno?> <?=$nm;?> <?=$sfno;?> Due Am. : <?=round($T,2)?>/- (Date : <?=$dt;?>) </option>
<?


?>

<?}?>

<?
$data11= mysqli_query($conn,"select * from  main_addon where brncd='$brncd' and cid='$cid'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;
if($T>0)
{
?>
<option value="<?=$blno?>"><?=$blno?> (Date : <?=$dt;?>)</option>
<?
}

?>

<?}?>
</select>
<script type="text/javascript">
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
  gtcrvlfi();
</script>