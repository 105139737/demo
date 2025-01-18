<?php 
$reqlevel = 3; 
set_time_limit(0);
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$pnm=rawurldecode($_REQUEST['pnm']);

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($fdt!="" and $tdt!=""){$todt=" and edt between '$fdt' and '$tdt'";}else{$todt="";}
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}


if($pnm!="")
{
	$pnm1=" and pcd='$pnm'";
}
else
{
$pnm1="";	
}
?>
<input type="hidden" id="abc" name="abc" value=""size="150">
 <table  width="100%" class="advancedtable"  >
		
		     <tr bgcolor="#e8ecf6">
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
			<b>Vch Type</b>
			</td>
          <td  align="center" >
			<b>Shop Name</b>
			</td>
			
			<td  align="center" >
			<b>Product Name</b>
			</td>
			
			<td  align="center" >
			<b>Inwards</b>
			</td>
			<td  align="center" >
			<b>Outwards</b>
			</td>
			<td  align="center" >
			<b>Closing</b>
			</td>
		    </tr>
			 <?php 
			 /*
			 $open=0;
			  $query5=mysqli_query($conn,"Select sum((opst+stin)-stout) as stck1 from ".$DBprefix."stock where dt<='$fdt'".$pnm1)or die(mysqli_error($conn));
  while ($R5 = mysqli_fetch_array ($query5))
{
$open=$R5['stck1'];
}
?>
 <tr >
  <td  align="center" >
			
			</td>
 <td  align="center" >
			<b><?php  echo $fdt;?> </b>
			</td>
			  <td  align="center" colspan="4">
			<b>Opening </b>
			</td>
			
			
			<td  align="center" >
			<b><?php  echo $open;?></b>/Pcs
			</td>
			<td  align="center" >
			
			</td>
			<td  align="center" >
			
			</td>
		    </tr>
<?php 
*/
$sln=0;
$ccnt=0;
$ccnt1=1;

$data6= mysqli_query($conn,"select * from  main_stock where sl>0 and nrtn!='Open Stock'".$todts.$pnm1.$brncd1." group by dt order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data6))
{
$ccnt1++;
$pcd=$row1['pcd'];
$dt1=$row1['dt'];
	 
$asd=0;
$sln++;

$data3= mysqli_query($conn,"select * from  main_stock where dt='$dt1'and nrtn!='Open Stock' and pcd='$pcd'".$todts.$brncd1." order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data3))
{
$pcd=$row1['pcd'];
$dt=$row1['dt'];
$dt2=$row1['dt'];
$opst=$row1['opst'];
$stin=$row1['stin'];
$stout=$row1['stout'];
$nrtn=$row1['nrtn'];
$betno=$row1['betno'];
$pbill=$row1['pbill'];
$sbill=$row1['sbill'];
$rbill=$row1['rbill'];
$prbill=$row1['prbill'];
$tout=$row1['tout'];
$tin=$row1['tin'];
$stksl=$row1['sl'];	
$spn="";
$blno="";
$dt=date('d-m-Y', strtotime($dt));
if($stout>0)
{
		if($nrtn=='Purchase Return')
	{
$data5= mysqli_query($conn,"select * from main_purchase where blno='$prbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data5))
{

$edt=$row1['ddt'];
$blno=$row1['inv'];
$sid=$row1['sid'];
$edt=date('d-m-Y', strtotime($edt));

$datad1= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$spn=$rowd['spn'];
}
}	
$colo="#feec88";	
	}
	elseif($nrtn=='Transfer')
	{
	$data5= mysqli_query($conn,"select * from main_trns where blno='$tout'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data5))
{

$edt=$row1['dt'];
$blno=$row1['blno'];
$fbcd=$row1['fbcd'];
$tbcd=$row1['tbcd'];
$edt=date('d-m-Y', strtotime($edt));

$datad31= mysqli_query($conn,"select * from main_branch where sl='$tbcd'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad31))
{
$spn12=$rowd['bnm'];
}

$datad1= mysqli_query($conn,"select * from main_branch where sl='$fbcd'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$spn=$rowd['bnm']." To ".$spn12;
}

}	
$colo="#fff1a5";	
		
	}
	elseif($nrtn=='Sale')
	{
	
$data1= mysqli_query($conn,"select * from  main_billing where blno='$sbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$edt=$row1['edt'];
$sid=$row1['cid'];
$edt=date('d-m-Y', strtotime($edt));

$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['nm'];
}
}
$colo="";
	}
$stin="";


}

if($stin>0)
{
	if($nrtn=='Sale Return')
	{
	$data1= mysqli_query($conn,"select * from  main_billing where blno='$rbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$edt=$row1['edt'];
$sid=$row1['cid'];
$edt=date('d-m-Y', strtotime($edt));

$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$spn=$rowd['nm'];
}
}	
$colo="#20a463";	
	}
	elseif($nrtn=='Receive')
	{
	$data5= mysqli_query($conn,"select * from main_trns where blno='$tin'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data5))
{

$edt=$row1['dt'];
$blno=$row1['blno'];
$fbcd=$row1['fbcd'];
$tbcd=$row1['tbcd'];
$edt=date('d-m-Y', strtotime($edt));

$datad31= mysqli_query($conn,"select * from main_branch where sl='$tbcd'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad31))
{
$spn=$rowd['bnm'];
}


}	
$colo="#139c58";	
		
	}
	elseif($nrtn=='Purchase'){
	
	$data5= mysqli_query($conn,"select * from main_purchase where blno='$pbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data5))
{

$edt=$row1['ddt'];
$blno=$row1['inv'];
$sid=$row1['sid'];
$edt=date('d-m-Y', strtotime($edt));

$datad1= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$spn=$rowd['spn'];
}
}
$colo="#e8ecf6";
	}
$stout="";

}

		$query6="select * from  ".$DBprefix."product where sl='$pcd'";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
				}
$cnm="";				
$data11= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}

if($dt1==$dt2)
{
	$asd++;
}
$close=0;
$query9=mysqli_query($conn,"Select sum((opst+stin)-stout) as stck1 from ".$DBprefix."stock where dt<='$dt1' and pcd='$pcd'".$brncd1)or die(mysqli_error($conn));
while ($R5 = mysqli_fetch_array($query9))
{
$close=$R5['stck1'];
}

	 ?>
		   <tr title="<?php  echo $pcd." S Sl".$stksl;?>" bgcolor="<?php  echo $colo;?>">
		   <?php if($asd==1){?>
		   <td  align="center"  >
			<?php  echo $sln;?>
			</td>
			
			 <td  align="center" >
			<?php  echo $dt;?>
			</td>
			<?php }else
			{
			?>
			 <td  align="center"  >
			
			</td>
			<td  align="center" >
	
			</td>
			<?php }?>
			<td  align="center" >
			<?php  echo $blno;?>
			</td>
			<td  align="center" >
			<?php  echo $nrtn;?>
			</td>
            <td  align="left" >
			<?php  echo $spn;?>
			</td>
		  <td  align="left" title="<?php  echo $pcd;?>" >
			<?php  echo $pnm;?> - <?php  echo $cnm;?> - <?php  echo $brand;?> - <?php  echo $mnm;?>
			</td>
			<td  align="center" >
<b><?php  echo $stin;?></b>
			</td>
			<td  align="center" >
		
				<b><?php  echo $stout;?></b>
			</td>
			<td  align="center" >
		<?php 
if($dt1!=$dt2)
{
			echo $close;
}
		?>
			</td>
			
					
		     </tr>	 
			 
<?php 
}
?>
		   <tr bgcolor="#eeeeee">
		  
			 <td  align="center"  >
			
			</td>
			<td  align="center" >
	
			</td>
	
			<td  align="center" >
	
			</td>
			<td  align="center" >

			</td>
            <td  align="left" >

			</td>
		  <td  align="left" title="<?php  echo $pcd;?>" >

			</td>
			<td  align="center" >

			</td>
			<td  align="center" >
		
		
			</td>
			<td  align="center" >
			<b>
		<?php 

			echo $close;

		?>
		</b>
			</td>
			
					
		     </tr>	 

<?php 
}?>


	  </table>