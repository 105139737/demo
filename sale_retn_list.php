<?php 
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pnm=rawurldecode($_REQUEST['pnm']);

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and edt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}

if($pnm!="")
{
	$pnm1=" and prsl='$pnm'";
}
else
{
$pnm1="";	
}
?>
 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Date</b>
			</td>
			 <td  align="center" >
		<b>Invoice</b>
			</td>
          <td  align="center" >
			<b>Shop Name</b>
			</td>
			
			<td  align="center" >
			<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Quantity/Unit</b>
			</td>
			<td  align="center" >
			<b>Rate</b>
			</td>
			<td  align="center" >
			<b>Amount</b>
			</td>
		
			<td  align="center" >
			<b>Close Stock</b>
			</td>
		
		     </tr>
			 <?php 
		$sln=0;
		$tota=0;
$tq=0;
if($user_current_level<0)
{
$data1= mysqli_query($conn,"select * from  main_billing where sl>0 and rstat='1'".$todt.$snm1)or die(mysqli_error($conn));
  }
  else
  {
	  $data1= mysqli_query($conn,"select * from  main_billing where sl>0 and bcd='$branch_code' and rstat='1'".$todt.$snm1)or die(mysqli_error($conn));

  
  }	
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$edt=$row1['edt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$car=$row1['car'];
//$pbill=$row1['inv'];
$sid=$row1['cid'];
$edt=date('d-m-Y', strtotime($edt));
$sln++;

$datad= mysqli_query($conn,"select * from main_suppl where sid='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{


$spn=$rowd['spn'];
$nm=$rowd['nm'];
$addr=$rowd['addr'];
$mob1=$rowd['mob1'];
}

$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno' and qty<0".$pnm1)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$pty1=$row['qty'];


          $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd' group by sl";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
//$pcd=$R['sl'];
$csl=$R['csl'];
$co=$R['co'];
$pname=$R['pname'];
$c=$R['pkgunt'];
}

$data4= mysqli_query($conn,"select * from main_catg where sl='$csl'")or die(mysqli_error($conn));
while ($row4 = mysqli_fetch_array($data4))
{
$tech=$row4['tnm'];
}





$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
 $query4="Select sum(qty) as pty1 from main_billdtls where prsl='$pcd' and blno='$blno' group by prsl";
  $result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
//$pty1=$R4['pty1'];
}
if($pty1!=0 and $ptu!=0)
{
$stkf=$pty1/$ptu;
$prc1=$prc/$ptu;
$vat1=($ttl*$vat)/100;
$ppt1=$ppt+$vat1;			 
}		
	$stck=0;
 $query5=mysqli_query($conn,"Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$edt1'");

  while ($R5 = mysqli_fetch_array ($query5))
{
$stck=$R5['stck1'];
}	
    $query6="Select sum(opst) as open from ".$DBprefix."stock where  pcd='$pcd' and dt<='$edt1'";

  
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
$query7="Select sum(stin) as stin1 from ".$DBprefix."stock where  pcd='$pcd' and dt<='$edt1'";
$stin1=0;
$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin1=$R7['stin1'];
}
$stout1=0;
    $query8="Select sum(stout) as stout1 from ".$DBprefix."stock where  pcd='$pcd' and dt<='$edt1'";
$result8 = mysqli_query($conn,$query8);
  while ($R8 = mysqli_fetch_array ($result8))
{
$stout1=$R8['stout1'];
}	


			 ?>
		   <tr>
		    <td  align="center"  >
			<?php  echo $sln;?>
			</td>
			 <td  align="center" >
			<?php  echo $edt;?>
			</td>
			<td  align="center" >
				<a href="#" onclick="view('<?php  echo $blno;?>')" title="Print"><?php  echo $blno;?></a>
			</td>
            <td  align="left" >
			<?php  echo $spn;?>
			</td>
			
			<td  align="center" title="<?php  echo $pcd;?>" >
			<?php  echo $pname;?>
			</td>
			<td  align="center" >
			<b><?php  echo $pty1;?></b>/<?php  echo $punt;?>
			</td>
			<td  align="center" >
			<?php  echo $prc;?>
			</td>
			<td  align="center" >
			<?php  echo $ttl;?>
			</td>
		
			<td  align="center" >
			<?php  echo $stck;?>
			</td>
		
		     </tr>	 
			 
<?php 

$tq=$pty1+$tq;
}}?>
<tr>
<td colspan="5" align="right">
<b>Total Quantity</b>
</td>
<td align="center">
<b>
<?php  echo $tq;?>
</b>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
</tr>

	  </table>