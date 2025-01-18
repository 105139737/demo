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
$data1= mysqli_query($conn,"select * from  main_trns where sl>0")or die(mysqli_error($conn));
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
 $query8=mysqli_query($conn,"Select * from ".$DBprefix."stock where pcd='$pcd' and stout='$qty' and betno='$betno' and expdt='$expdt' and dt='$dt' and nrtn='Transfer' and refno='$blno' and bcd='$bcd'")or die(mysqli_error($conn));
 
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
<td valign="top">

<table  border="1" width="100%">
<tr>
<td>
Sl
</td>
<td>
Bill No. 
</td>
<td>
Product Name
</td>
<td>
Qty
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
</tr>
<?php 
$l1=0;
$data2= mysqli_query($conn,"select * from  main_billing where sl>0")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{

$blno=$row1['blno'];
$edt=$row1['edt'];
$edt1=$row1['edt'];
$data5= mysqli_query($conn,"select * from  main_billdtls where blno='$blno' and qty>0")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data5))
{
$pcd=$row['prsl'];
$qty=$row['qty'];
$betno=$row['betno'];
$expdt=$row['expdt'];
$query2 = "SELECT * FROM ".$DBprefix."product where sl='$pcd' group by sl";
$result2 = mysqli_query($conn,$query2);
while ($R = mysqli_fetch_array ($result2))
{
$pname=$R['pname'];
}
$l1++;
?>
<tr>
<td>
<?php  echo $l1;?>
</td>
<td>
<?php  echo $blno;?>
</td>
<td>
<?php  echo $pname;?>
</td>
<td>
<?php  echo $qty;?>
</td>
<td>
<?php  echo $edt;?>
</td>

<td>
<?php  echo $betno;?>
</td>
<td>
<?php  echo $expdt;?>
</td>
</tr>

<?php 
}
}
?>
</table>
</td>
</tr>
</table>