<?php 
$reqlevel = 1;
include("membersonly.inc.php");
set_time_limit(0);
$sup=rawurldecode($_REQUEST['sup']);


if($sup==""){$sup1="";}else{$sup1=" and sup='$sup'";}


?>

<table width="100%"  class="table table-bordered">
<tr>
<th><b>SL.</b></th>
<th><b>Supplier</b></th>
<th><b>Barnd</b></th>
</tr>
<?php
$cnt=0;
$data11= mysqli_query($conn,"SELECT * FROM main_supplier_tag where sl>0 $sup1");
while ($row11= mysqli_fetch_array($data11))
{	
$cnt++;
$sup=$row11['sup'];
$brand=$row11['brand'];
$nm="";
$query="select * from main_suppl  WHERE sl='$sup'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['spn'];
}
$slno=1;
$cnm="";
$data13 = mysqli_query($conn,"Select * from main_catg where sl>0  and find_in_set(sl,'$brand')>0 ");
while ($row13 = mysqli_fetch_array($data13))
{
$sl3=$row13['sl'];
$cnm.=$slno.") ".$row13['cnm']."<br>";
$slno++;
}


?>
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $nm;?></td>
<td><?php echo $cnm;?></td>
</tr>
<?php }?>
</table>


