<?
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt1=$_REQUEST['fdt'];
$tdt1=$_REQUEST['tdt'];


$fdt=date('Y-m-d', strtotime($fdt1));
$tdt=date('Y-m-d', strtotime($tdt1));

if($fdt1!="" and $tdt1!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}


?>

<table  class="advancedtable" width="100%" >
		
		<tr bgcolor="#e8ecf6">

			<td  align="center" ><b>Sl</b></td>
			<td  align="left" ><b>Nature Of Document</b></td>
			<td  align="center" ><b>Sr. No. From</b></td>
			<td  align="center" ><b>Sr. No. To</b></td>
			<td  align="center" ><b>Total Number</b></td>
			<td  align="center" ><b>Cancelled</b></td>
			
			</tr>
			 <?
$sln=0;
$get= mysqli_query($conn,"select * from main_billtype where inv_typ='0' or inv_typ='2' or inv_typ='1' order by sl")or die(mysqli_error($conn));
while ($PP=mysqli_fetch_array($get))
{
	
	$bill_typ_sl=$PP['sl'];

$fblno="";
$data1= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no limit 0,1")or die(mysqli_error($conn));
$fcount=mysqli_num_rows($data1);
while ($row1=mysqli_fetch_array($data1))
{
 $fblno=$row1['blno'];
}
$toblno="";
$data2= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no desc limit 0,1")or die(mysqli_error($conn));
$lcount=mysqli_num_rows($data2);
while ($row2=mysqli_fetch_array($data2))
{
 $toblno=$row2['blno'];
}

$SM= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt'")or die(mysqli_error($conn));
$TOT=mysqli_num_rows($SM);


$SK= mysqli_query($conn,"select * from main_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' and cstat='1'")or die(mysqli_error($conn));
$Cancel=mysqli_num_rows($SK);

/*Service bill*/

$fblno_sr="";
$data1_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no limit 0,1")or die(mysqli_error($conn));
$fcount_sr=mysqli_num_rows($data1_sr);
while ($row1_sr=mysqli_fetch_array($data1_sr))
{
 $fblno_sr=$row1_sr['blno'];
}
$toblno_sr="";
$data2_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no desc limit 0,1")or die(mysqli_error($conn));
$lcount_sr=mysqli_num_rows($data2_sr);
while ($row2_sr=mysqli_fetch_array($data2_sr))
{
 $toblno_sr=$row2_sr['blno'];
}

$SM_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt'")or die(mysqli_error($conn));
$TOT_sr=mysqli_num_rows($SM_sr);


$SK_sr= mysqli_query($conn,"select * from main_ser_billing where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' and cstat='1'")or die(mysqli_error($conn));
$Cancel_sr=mysqli_num_rows($SK_sr);

/*Credit Note*/

$fblno_sr_cr="";
$data1_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no limit 0,1")or die(mysqli_error($conn));
$fcount_sr_cr=mysqli_num_rows($data1_sr_cr);
while ($row1_sr_cr=mysqli_fetch_array($data1_sr_cr))
{
 $fblno_sr_cr=$row1_sr_cr['blno'];
}
$toblno_sr_cr="";
$data2_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' order by bill_no desc limit 0,1")or die(mysqli_error($conn));
$lcount_sr_cr=mysqli_num_rows($data2_sr_cr);
while ($row2_sr_cr=mysqli_fetch_array($data2_sr_cr))
{
 $toblno_sr_cr=$row2_sr_cr['blno'];
}

$SM_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt'")or die(mysqli_error($conn));
$TOT_sr_cr=mysqli_num_rows($SM_sr_cr);


$SK_sr_cr= mysqli_query($conn,"select * from main_billing_ret where bill_typ='$bill_typ_sl' and dt between '$fdt' and '$tdt' and cstat='1'")or die(mysqli_error($conn));
$Cancel_sr_cr=mysqli_num_rows($SK_sr_cr);

if($fblno!="")
{
	$sln++;
?>

<tr>
		<td  align="center" ><?=$sln;?></td>
		<td  align="left" >Invoice For Outward Supply</td>
		<td  align="center" ><?=$fblno;?></td>
		<td  align="center" ><?=$toblno;?></td>
		<td  align="center" ><?=$TOT;?></td>
		<td  align="center" ><?=$Cancel;?></td>
			
</tr>	
 
<?
}
if($fblno_sr!="")
{
	$sln++;
?>
<tr>
		<td  align="center" ><?=$sln;?></td>
		<td  align="left" >Invoice For Outward Supply</td>
		<td  align="center" ><?=$fblno_sr;?></td>
		<td  align="center" ><?=$toblno_sr;?></td>
		<td  align="center" ><?=$TOT_sr;?></td>
		<td  align="center" ><?=$Cancel_sr;?></td>
			
</tr>
<?
}
if($fblno_sr_cr!="")
{
	$sln++;
?>
<tr>
		<td  align="center" ><?=$sln;?></td>
		<td  align="left" >Credit Note</td>
		<td  align="center" ><?=$fblno_sr_cr;?></td>
		<td  align="center" ><?=$toblno_sr_cr;?></td>
		<td  align="center" ><?=$TOT_sr_cr;?></td>
		<td  align="center" ><?=$Cancel_sr_cr;?></td>
			
</tr>
<?
}
}
?>

</table>