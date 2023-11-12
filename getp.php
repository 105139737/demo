<?
$reqlevel = 1;
include("membersonly.inc.php");
$refno=rawurldecode($_REQUEST[refno]);
$prnm=$_REQUEST['prnm'];
$unit=$_REQUEST['unit'];
$cust_typ=$_REQUEST['cust_typ'];
$prc=$_REQUEST['prc'];
$spl=$_REQUEST['spl'];




$query6="select * from main_product_prc where psl='$prnm' order by sl desc limit 0,1";
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
	if($mrp>0)
	{
	$read="readonly";
	}
	else
	{
	$read="";	
	}
}



?>
<input type="text" class="sc"  tabindex="18" id="prc" name="prc" style="text-align:right" value="<?=$mrp;?>" <?php echo $spl;?> onblur="cal()" tabindex="6" size="15"  >
<input type="hidden" class="sc"  id="srt" name="srt" style="text-align:right" value="<?=$mrp;?>"   >
<script>
document.getElementById('disp').value="<?=$dis;?>";
document.getElementById('disa').value="<?=$disam;?>";
cal();
</script>