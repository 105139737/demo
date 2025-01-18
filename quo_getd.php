<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$dis=0;
$query6="select * from main_product_prc where psl='$prnm' order by edt desc limit 0,1";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$dis=$row['dis'];
}
?>
<input type="text" class="sc" id="disp"  name="disp" value="<?php  echo $dis;?>" style="text-align:right" onblur="cal()" tabindex="20">
