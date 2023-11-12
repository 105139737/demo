<?
$reqlevel = 1; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}

if($fdt=="" or $tdt=="")
{
?>
<center>
<font color="pink">
<b>
<?
echo "Please Fill All The Fields.....";
?>
</b>
</font>
</center>
<?
}
else
{

$c=0;
$c2='odd';

$cr1=mysqli_query($conn,"select * from main_billing where edt between '$fdt' and '$tdt'".$brncd1);




$rcnt=mysqli_num_rows($cr1);
if($rcnt==0)
{
?>
<center>
<font color="pink">
<b>
<?
echo "There Are No Bills Between These Dates.....";
?>
</b>
</font>
</center>
<?
}
else
{
		
?>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
 <thead>
<tr style="background-color:#2396d6;">
<th align="center">Sl.</th>
<th align="center">Bill No.</th>
<th align="center">Date</th>

<th align="center">Customer Name</th>
<th align="center">Contact No.</th>
<th align="center">Amount Rs.</th>
</tr></thead>
<?
$sln=0;
$tot=0;
while($r=mysqli_fetch_array($cr1))
{
$blno=$r['blno'];

$cid=$r['cid'];

$caddr=$r['caddr'];
$cnt=$r['cnt'];
$edt=$r['edt'];
$vat=$r['vat'];
$d=date('d-m-Y', strtotime($edt));
 //$data4= mysqli_query($conn,"select * from  main_suppl where sid='$cid' and (tp='Debtors' or tp='Both')")or die(mysqli_error($conn));
 $data4= mysqli_query($conn,"select * from  main_cust where sl='$cid' ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data4))
{

$cont=$row['cont'];
$cnm=$row['nm'];
}


 $query1 = "SELECT sum(ttl) as gttl,sum(qty) as qttl FROM main_billdtls where blno='$blno' group by blno";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}
if($vat!=0)
{
	$vat1=($gttl*$vat)/100;
	$gttl1=$gttl+$vat1;
}
else
{
	$gttl1=$gttl;
}
$sln++;
$tot=$gttl1+$tot;
?>

<tr>
<td align="center"><?=$sln;?></td>
<td align="center"><a href="#" onclick="view('<?=$blno;?>')" title="Print"><?=$blno;?></a></td>
<td align="center"><?=$d;?></td>
<td align="center"><?=$cnm;?></td>
<td align="center"><?=$cont;?></td>
<td align="right">
<?=number_format($gttl1,2);?>
</td>



</tr>
<?
$vat="";
$gttl1="";
}
}
}

?>
<tr>
<td colspan="5" align="right">
<b> Total </b>
</td>
<td align="right">
<?=number_format($tot,2);?>
</td>
</tr>

</table>