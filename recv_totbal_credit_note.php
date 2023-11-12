<?php
$reqlevel = 3;
include("membersonly.inc.php");
$id = $_REQUEST['cid'];
$brncd=$_REQUEST['brncd'];
$pno=$_REQUEST['pno'];

$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='4' and cid='$id' and brncd='$brncd'");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='4' and  cid='$id' and brncd='$brncd'");
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;			
?>
<img src="images\rp.png" height="15px"><input type="text" name="dbal1" id="dbal1"  value="<?php echo $T;?>" style="background :transparent;color :red;width:120px;;font-weight:bold;" readonly>
