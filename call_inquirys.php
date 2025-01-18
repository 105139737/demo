<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=date('d-M-Y');
$cy=date('Y');

$mobid=rawurldecode($_REQUEST[mobid]);

if($mobid!="")
{
	$mobid1=" and (call_id='$mobid' or cmob='$mobid')";

	$get=mysqli_query($conn,"select * from main_call where sl>0 $mobid1") or die(mysqli_error($conn));
	$total=mysqli_num_rows($get);
	if($total!=0)
	{
		while($row=mysqli_fetch_array($get))
		{
			//call_id	tech_id	cnm	cmob	addr	brand	model	serial_no	call_type	remark	parts	edt	edtm	eby	stat
			$c++;
			$sl=$row['sl'];
			$call_id=$row['call_id'];
			$tech_id=$row['tech_id'];
			$cnmsl=$row['cnm'];
			$cmob=$row['cmob'];
			$addr=$row['addr'];
			$brandsl=$row['brand'];
			$model=$row['model'];
			$serial_no=$row['serial_no'];
			$call_typesl=$row['call_type'];
			$remark=$row['remark'];
			$parts=$row['parts'];
			$edt=$row['edt'];
			$edtm=$row['edtm'];
			$eby=$row['eby'];
			
			$get1=mysqli_query($conn,"select * from main_cust where sl='$cnmsl'") or die(mysqli_error($conn));
			while($row1=mysqli_fetch_array($get1))
			{
				$cnm=$row1['nm'];
			}
			$get2=mysqli_query($conn,"select * from main_brand where sl='$brandsl'") or die(mysqli_error($conn));
			while($row2=mysqli_fetch_array($get2))
			{
				$brand=$row2['brand'];
			}
			$get3=mysqli_query($conn,"select * from main_call_typ where sl='$call_typesl'") or die(mysqli_error($conn));
			while($row3=mysqli_fetch_array($get3))
			{
				$call_type=$row3['call_typ'];
			}
		
	?>
	<div class="box box-success">
	<table class="table table-hover table-striped table-bordered" style="width:100%;" align="center">
	<tr><td colspan="5" style="text-align:center"><font size="4" color="#109e59"><b>Customer Details</b></font></td></tr>
	<tr>
	<td style="text-align:left;">
	<b>Name: </b><?php  echo $cnm;?><br>
	<b>Address: </b><?php  echo $addr;?><br>
	<b>Mobile: </b><?php  echo $cmob;?>
	</td>
	<td style="text-align:left;">
	<b>Brand: </b><?php  echo $brand;?><br>
	<b>Model: </b><?php  echo $model;?><br>
	<b>Serial No.: </b><?php  echo $serial_no;?>
	</td>
	<td style="text-align:left;">
	<b>Call ID: </b><?php  echo $call_id;?><br>
	<b>Call Type: </b><?php  echo $call_type;?>
	</td>
	</tr>
	</table>
	
	<?php 															
		}
		?>

<table class="table table-hover table-striped table-bordered" style="width:100%;" align="center">
<tr><td colspan="5" style="text-align:center"><font size="4" color="#109e59"><b>Call History</b></font></td></tr>
<tr>
<td style="text-align:center"><font size="2" color="#109e59"><b>Date</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Status</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Technician Name</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Parts</b></font></td>
<td style="text-align:center"><font size="2" color="#109e59"><b>Remark</b></font></td>

</tr>
		<?php 
		$getdtl=mysqli_query($conn,"select * from main_call_dtls where callid='$call_id'") or die(mysqli_error($conn));
		$rcntdtl=mysqli_num_rows($getdtl);
		while($rowdtl=mysqli_fetch_array($getdtl))
		{
			//callid	techid	cmob	stat	remark	parts	edt	edtm
			$dtlcallid=$rowdtl['callid'];
			$dtltechid=$rowdtl['techid'];
			$dtlcmob=$rowdtl['cmob'];
			$dtlstat=$rowdtl['stat'];
			$dtlremark=$rowdtl['remark'];
			$dtlparts=$rowdtl['parts'];
			$dtledt=$rowdtl['edt'];
			$dtledtm=$rowdtl['edtm'];
			if($dtlstat==1)
			{
				$dtlstatus='Pending';
			}
			elseif($dtlstat==2)
			{
				$dtlstatus='Technician Assign';
			}
			elseif($dtlstat==3)
			{
				$dtlstatus='Done';
			}
			if($dtltechid==""){$tchnm='NA';}
			if($dtlparts==""){$dtlparts='NA';}
			
			$dtlget1=mysqli_query($conn,"select * from main_technician where sl='$dtltechid'") or die(mysqli_error($conn));
			while($dtlrow1=mysqli_fetch_array($dtlget1))
			{
				$tchnm=$dtlrow1['nm'];
			}
			?>

<tr>
<td style="text-align:center"><?php echo date('d-m-Y', strtotime($dtledt));?></td>
<td style="text-align:center"><?php  echo $dtlstatus;?></td>
<td style="text-align:center"><?php  echo $tchnm;?></td>
<td style="text-align:center"><?php  echo $dtlparts;?></td>
<td style="text-align:center"><?php  echo $dtlremark;?></td>
</tr>
			<?php 
		}
?>
</table>
</div>
<?php 
	}
	else
	{
	?>
	<table class="table table-hover table-striped table-bordered">
	<tr>
	<td style="text-align:center;"><font size="4" color="red"><b>Please Enter Valid Mobile No or Call ID</b></font></td>
	</tr>
	</table>
	<?php 
	}
}
else
{
	?>
	<table class="table table-hover table-striped table-bordered">
	<tr>
	<td style="text-align:center;"><font size="4" color="red"><b>Please Enter a Mobile No or Call ID</b></font></td>
	</tr>
	</table>
	<?php 
}
?>