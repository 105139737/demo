<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$disam=0;
$mrp=0;
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


?>
<input type="text" class="sc"  tabindex="1" id="prc" name="prc" style="text-align:right" value="<?php  echo $mrp;?>" onblur="cal()" >
<script>
//document.getElementById('disp').value="<?php  echo $dis;?>";
//document.getElementById('disa').value="<?php  echo $disam;?>";
//cal();
</script>