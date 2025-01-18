<?php $_REQUEST['brncd'] ?? ""
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST[pcd];
$scat=$_REQUEST['scat'] ?? "";
$brncd=$_REQUEST[brncd];
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
$query41="Select sum(stout) as stck1 from ".$DBprefix."stock where pcd='$scat' and bcd='$brncd'";
$result41 = mysqli_query($conn,$query41);
while ($R4 = mysqli_fetch_array ($result41))
{
$stck_out=$R4['stck1'];
}
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$scat' and bcd='$brncd'";
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
$rate='';
$log=0;
$query6="select * from main_stock where pcd='$scat' and nrtn='Purchase' order by dt";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$mrp=round($row['ret'],2);
$stin+=$row['stin'];
if($stin>=$stck_out)
{
if($log==0)	
{
$rate=$mrp;
$log=1;
}	
}
}
if($rate=='')
{
$rate=$mrp;
}
?>
<input type="text" class="sc" id="sih" readonly tabindex="10" name="sih" style="text-align:center" value="<?php  echo $stock_in;?>"  size="12">
<input type="hidden" class="sc" id="scat_unit" readonly name="scat_unit" style="text-align:center" value="<?php  echo $unit;?>"  size="12">
<input type="hidden" class="sc"  id="srt" name="srt" style="text-align:right" value="<?php  echo $rate;?>"   >
<script>
document.getElementById('scat').value='<?php  echo $scat;?>';
$('#scat').trigger('chosen:updated');
get_unit();
get_gstval();
</script>

