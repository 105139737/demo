<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$refno=rawurldecode($_REQUEST['refno'] ?? "");
$prnm=$_REQUEST['prnm']??"";
$cust_typ=$_REQUEST['cust_typ']??"";
$disam=0;
$mrp=0;
$read="";
$query6="select * from main_product_prc where psl='$prnm' order by edt desc limit 0,1";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$mrp=$row['prc'];
$dis=$row['dis'];
$disam=$row['disam'];
}
if($disam>0)
{
$dis=round((($disam*100)/$mrp),4);
}
if($cust_typ=="1")
{
	$read="";
	$mrp=0;
	$dis=0;
	$disam=0;
}
else if($cust_typ=="2")
{
	$read="";
}
?>
<input type="text" class="sc"  tabindex="18" id="prc" name="prc" style="text-align:right" value="<?php  echo $mrp;?>" <?php  echo $read;?> onblur="cal()" tabindex="6" size="15"  >
<input type="hidden" class="sc"  id="srt" name="srt" style="text-align:right" value="<?php  echo $mrp;?>"   >
<script>
//document.getElementById('disp').value="<?php  echo $dis;?>";
//document.getElementById('disa').value="<?php  echo $disam;?>";
cal();
</script>