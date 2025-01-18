<?php 
$reqlevel = 3; 
 
include("membersonly.inc.php");
set_time_limit(0);
$bccnt=0;
$sccnt=0;
?>
<table width="90%" border="1">
<tr>
<td valign="top">
<table  border="1" width="100%">
<tr>
<td>
SL
</td>
<td>
Date 
</td>
<td>
Batch No.
</td>
<td>
Exp Date
</td>
<td>
Qty
</td>
<td>
Product Name
</td>
<td>
Bill No. 
</td>
</tr>
<?php 
$l=0;
$data1= mysqli_query($conn,"select * from  main_trns where sl>0 ")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$dt=$row1['dt'];
$fbcd=$row1['fbcd'];
$edtm=$row1['edtm'];
	
$data= mysqli_query($conn,"select * from  main_trndtl where blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['prsl'];
$qty=$row['qty'];
$betno=$row['betno'];
$expdt=$row['expdt'];
$bcd=$row['fbcd'];
$bccnt++;
 $query8=mysqli_query($conn,"Select * from ".$DBprefix."stock where pcd='$pcd' and stout='$qty' and betno='$betno' and expdt='$expdt' and dt='$dt' and nrtn='Transfer' and dtm='$edtm' and refno='' and bcd='$bcd'")or die(mysqli_error($conn));
 
  while ($R5 = mysqli_fetch_array ($query8))
{
$stout=$R5['stout'];
$sl=$R5['sl'];
$up="update ".$DBprefix."stock set tout='$blno' where sl='$sl'";
$result=mysqli_query($conn,$up);

$query = "SELECT * FROM ".$DBprefix."product where sl='$pcd' group by sl";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pname=$R['pname'];
}
$l++;
?>
<tr>
<td>
<?php  echo $l;?>
</td>



<td>
<?php  echo $edt1;?>
</td>

<td>
<?php  echo $betno;?>
</td>
<td>
<?php  echo $expdt;?>
</td>
<td>
<?php  echo $stout;?>
</td>
<td>
<?php  echo $pname;?>
</td>
<td>
<?php  echo $blno;?>
</td>
</tr>

<?php 

$sccnt++;
}

}

}

?>
</table>
</td>
</tr>
</table>