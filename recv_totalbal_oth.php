<?php
$reqlevel = 3;
include("membersonly.inc.php");
$id = $_REQUEST['cid'];
$brncd=$_REQUEST['brncd'];
$pno=$_REQUEST['pno'];
$tt=$_REQUEST['tt'];

$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='4' and cid='$id' and brncd='$brncd'");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='4' and  cid='$id' and brncd='$brncd' ");
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;	
if($tt==1)	
{	
?>
<input type="text" name="tdbal" id="tdbal"  value="<?php echo round($T,2);?>" style="background :transparent;color :red;font-weight:bold;" readonly>
<?
}
if($tt==2)
{
?>
<input type="text" name="tdbal" id="tdbal"  value="<?php echo round($T,2);?>" style="background :transparent;color :red;font-weight:bold;font-size:20px;" readonly>
<?
}
?>