<?php $_REQUEST['brncd'] ?? ""
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST[pcd];
$scat=$_REQUEST['scat'] ?? "";
$brncd=$_REQUEST[brncd];
$blno=$_REQUEST['blno'] ?? "";
$tsl=$_REQUEST[tsl];
$query100 = "SELECT * FROM main_billdtls where sl='$tsl' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$refno=$R100['refno'];
$srt=$R100['srt'];
}
if($scat=='')
{
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$scat=$row['scat'];
}
}
$query7="select * from main_scat where sl='$scat'";
$result7 = mysqli_query($conn,$query7);
while($row=mysqli_fetch_array($result7))
{
$unit=$row['unit'];
}
?>
<select name="refno"  id="refno" class="sc1" style="width:100%" onchange="get_prc()" tabindex="10" >
<Option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$scat' group by refno order by sl");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$rtmm=$row1['rtmm'];
	$refno1=$row1['refno'];
$queryx = "SELECT * FROM main_purchasedet where blno='$refno1' and scat='$scat'";
$resultx = mysqli_query($conn,$queryx)or die(mysqli_error($conn));
while ($rowx = mysqli_fetch_array ($resultx))
{
$mrp=round($rowx['mrp'],4);
}
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$scat' and bcd='$brncd' and refno='$refno1'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($stck=="")
{
$stck=0;	
}
else
{
if($unit=='1')
{
$stock_in1=$stck/1000;
$stock_in1=number_format($stock_in1,3);
$val=explode(".",$stock_in1);
$stock_in=$val[0]." Kg , ".$val[1]." Gram";
}
if($unit=='2'){$stock_in=$stck." Pcs";}
if($unit=='3'){$stock_in=$stck." Pcs";}
}
if($stck>0)	
{
?>
<option value="<?php  echo $refno1?>"><?php echo round($mrp,4)?> --- <?php  echo $stock_in?> --- <?php  echo $refno1?></option>
<?php 
}

}
?>
</select>
<input type="hidden" class="sc" id="scat_unit" readonly name="scat_unit" style="text-align:center" value="<?php  echo $unit;?>"  size="12">
<script>
document.getElementById('scat').value='<?php  echo $scat;?>';
$('#scat').trigger('chosen:updated');
get_unit();
get_gstval();
</script>

