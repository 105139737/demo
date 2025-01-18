<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$pnm=rawurldecode($_REQUEST['pnm']);
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and tbcd='$brncd'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!="")
{
	$fdt=date("Y-m-d", strtotime($fdt));
$tdt=date("Y-m-d", strtotime($tdt));
$dtt=" and dt between '$fdt' and '$tdt'";
}else{$dtt="";}

if($pnm!="")
{
	$pnm1=" and prsl='$pnm'";
}
else
{
$pnm1="";	
}

?>
   
        <div class="box box-success" >

		
		   
	<table border="0" width="100%" class="advancedtable">
	<tr  bgcolor="#9bff9b">
	<td  align="left" ><b>Sl</b></td>
<td  align="left" ><b>Send Branch</b></td>
<td  align="left" ><b>Trn. No.</b></td>
<td  align="left" ><b>Date</b></td>
<td  align="left" ><b>Particulars</b></td>


<td align="center"  ><b>Quantity</b></td>

<td  align="center" ><b>Status</b></td>



</tr>
 <?php 
 $slno=0;
 $Tqty=0;
 $data= mysqli_query($conn,"select * from main_trns where sl>0".$brncd1.$dtt." order by dt")or die(mysqli_error($conn));

   while ($row = mysqli_fetch_array($data))
{
$fbcd=$row['fbcd'];

$tbcd=$row['tbcd'];
$dt=$row['dt'];
$blno=$row['blno'];
$stat=$row['stat'];


  $q111=mysqli_query($conn,"SELECT * FROM ".$DBprefix."branch where sl='$fbcd'");
while($r111=mysqli_fetch_array($q111))
{
$fbnm=$r111['bnm'];
}
  $q=mysqli_query($conn,"SELECT * FROM ".$DBprefix."branch where sl='$tbcd'");
while($r=mysqli_fetch_array($q))
{
$tbnm=$r['bnm'];
}

 
 
 $ptu1=1;
 $query100 = "SELECT * FROM main_trndtl where blno='$blno'".$pnm1;
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
	
	/*fbcd	prsl	prnm	rmk	qty	blno*/
	
$tsl=$R100['sl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];
$usl=$R100['usl'];
$prc1="";
$un="";
if($expdt!="0000-00-00")
{
$expdt=date('d-m-Y', strtotime($expdt));
}
$log="";

$unit=mysqli_query($conn,"select * from main_unit where sl='$usl'");
while($pr=mysqli_fetch_array($unit))
{
$punt=$pr['pkgunt'];
$upkg=$pr['untpkg'];
$ptu1=$pr['tunt'];	
}


if($punt==$unt)
{	
$log=0;

$qnt1=$qnty/$ptu1;
}
else
{
$qnt1=$qnty;		
$log=1;
}
$slno++;

if($stat==1)
{
	$stat1="Receive";
}elseif($stat==1){$stat1="Pending";}

?>


<tr class="even">
<td  align="left" ><b><?php  echo $slno;?></b></td>
<td  align="left" ><b><?php  echo $fbnm;?></b></td>
<td  align="left" ><b><?php  echo $blno;?></b></td>
<td  align="left" ><b><?php echo date("d-m-Y", strtotime($dt));?></b></td>
<td  align="left" ><b><?php  echo $prnm;?></b></td>


<td align="center"  ><b><?php  echo $qnt1;?></b></td>




<td align="center"  ><b><?php  echo $stat1;?></b></td>



</tr>
<?php 
$Tqty=$qnt1+$Tqty;
}}?>
<tr>
<td colspan="5" align="right">
<b>Total :</b>
</td>
<td align="center">
<b><?php  echo $Tqty;?></b>
</td>
<td>
</td>
<td>
</td>
</tr>
</table>
	  
		
  </div>