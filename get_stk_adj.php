<?
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";

$prnm=$_REQUEST['prnm'];
$brncd=$_REQUEST['brncd'];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}

$stck=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prnm'".$brncd1." group by pcd order by pcd ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}

?>
<input type="text" name="sih" id="sih" class="form-control" value="<?php echo $stck;?>" style="color:red;font-size:18px;font-weight:bold;" readonly onkeypress="return isNumber(event)">
