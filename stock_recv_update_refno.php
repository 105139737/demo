<?
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
<?
$l=0;
$data1= mysqli_query($conn,"select * from  main_trns where sl>0 and stat='1'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$dt=$row1['dt'];
$bcd=$row1['tbcd'];
$edtm=$row1['edtm'];
	
$data= mysqli_query($conn,"select * from  main_trndtl where blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['prsl'];
$qty=$row['qty'];
$betno=$row['betno'];
$expdt=$row['expdt'];
$bccnt++;
 $query8=mysqli_query($conn,"Select * from ".$DBprefix."stock where pcd='$pcd' and stin='$qty' and betno='$betno' and expdt='$expdt' and nrtn='Receive' and refno='$blno' and bcd='$bcd'")or die(mysqli_error($conn));
 
  while ($R5 = mysqli_fetch_array ($query8))
{
$stout=$R5['stin'];
$sl=$R5['sl'];
$up="update ".$DBprefix."stock set tin='$blno' where sl='$sl'";
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
<?=$l;?>
</td>



<td>
<?=$edt1;?>
</td>

<td>
<?=$betno;?>
</td>
<td>
<?=$expdt;?>
</td>
<td>
<?=$stout;?>
</td>
<td>
<?=$pname;?>
</td>
<td>
<?=$blno;?>
</td>
</tr>

<?

$sccnt++;
}

}

}

?>
</table>
</td>
</tr>
</table>