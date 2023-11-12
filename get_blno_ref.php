<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$sl=$_REQUEST[sl];
$cid=$_REQUEST[cid];
$cbill=$_REQUEST[blno];
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
<select id="blno"  name="blno"   tabindex="1" class="sc1" style="width:98%;" onchange="gtcrvlfi()">

<?
$data11= mysqli_query($conn,"select * from  main_drcr where brncd='$brncd' and cid='$cid' and paid='0'  group by  cbill order by sl,dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['cbill'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$invto="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$sfno=$row2['sfno'];
}
$nm="";
$query="select * from main_cust  WHERE sl='$invto'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['nm'];
}
/*
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
*/
?>
<option value="<?=$blno?>"<?if($cbill==$blno){echo 'selected';}?>><?=reformat($blno)?> <?=$nm;?> <?=$sfno;?> Due Am. : <?=round($T,2)?>/- (Date : <?=$dt;?>) </option>
<?


?>

<?}
?>
</select>
<script type="text/javascript">
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
  
  gtcrvlfi();
</script>