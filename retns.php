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
			<b>Action</b>
			</td>
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
			 
		     </tr>
			 <?php 
		$sln=0;
		$tota=0;
$tq=0;
		if($user_current_level<0)
{
$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$todt.$snm1)or die(mysqli_error($conn));
  }
  else
  {
	  $data1= mysqli_query($conn,"select * from  main_billing where sl>0 and bcd='$branch_code'".$todt.$snm1)or die(mysqli_error($conn));
	   
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

			 ?>
		   <tr>
		   <td  align="center"  >
			<a href="#" onclick="retn('<?php  echo $blno;?>')" title="Return"><i class="fa fa-times"></i><br>Return</a>
			</td>
		    <td  align="center"  >
			<?php  echo $sln;?>
			</td>
			 <td  align="center" >
			<?php  echo $edt;?>
			</td>
			<td  align="center" >
				<a href="#" onclick="view('<?php  echo $blno;?>')" title="Print"><i class="fa fa-print"></i><br><?php  echo $blno;?></a>
			</td>
            <td  align="left" >
			<?php  echo $spn;?>
			</td>
		     </tr>	 
			 
<?php 
}?>


	  </table>