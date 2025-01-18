<?php 
$reqlevel=0;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];		
$data= mysqli_query($conn,"SELECT * FROM main_drcr where sl='$sl'");
while ($row = mysqli_fetch_array($data))
{
	$dt= $row['dt'];
	$pno= $row['pno'];
	//$vno= $row['vno'];
	$cldgr= $row['cldgr'];
	$dldgr= $row['dldgr'];
	$mtd= $row['mtd'];
	$mtddtl= $row['mtddtl'];
	$amm= $row['amm'];
	$nrtn= $row['nrtn'];
	$it= $row['it'];
	$sid= $row['sid'];
	$brncd= $row['brncd'];
}
$dt=date('Y-m-d', strtotime($dt));
?>
<div class="box box-success">
<div class="box-header">
<input type="hidden" name="proj" id="proj" value="NA" class="form-control" readonly>
<input type="hidden" name="vno" id="vno" value="NA" class="form-control" readonly style="background :transparent; color : red;">
<div class="form-group col-md-6">
<label><font color="red">*</font>Date:</label>
<input type="date" name="dt" id="dt" value="<?php echo $dt;?>" class="form-control">
</div>

<div class="form-group col-md-6">
<label><font color="red">*</font>Branch:</label>
	<select name="brncd" id="brncd" class="form-control">
	<?php 
	if($user_current_level<0)
	{
	$query="Select * from main_branch";
	}
	else
	{
	$query="Select * from main_branch where sl='$branch_code'";
	}
	$result3 = mysqli_query($conn,$query);
	while ($R = mysqli_fetch_array ($result3))
	{
	$bbsl=$R['sl'];
	$bnm=$R['bnm'];

	?>
	<option value="<?php  echo $bbsl;?>"<?php  echo $R['sl'] == $brncd ? 'selected' : '' ?>><?php  echo $bnm;?></option>
	<?php 
	}
	?>
	</select>
</div>

<div class="form-group col-md-6">
<label><font color="red">*</font>Supplier:</label>
	<input type="hidden" value="12" id="dldgr" name="dldgr">
	<select id="sid" name="sid" onchange="gtcrvl1()" class="form-control">
	<option value="">---Select---</option>
	<?php 
		$query6="select * from  main_suppl order by spn";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
			?>
			<option value="<?php  echo $row['sl'];?>"<?php  echo $row['sl'] == $sid ? 'selected' : '' ?>><?php  echo $row['spn'];?></option>
			<?php 
		}
	?>
	</select>
</div>
<div class="form-group col-md-6">
<label><font color="red">*</font>Cash Or Bank Ac.:</label>
	<select name="cldgr" id="cldgr" class="form-control">
	<option value="">-- Select --</option>
	<?php  
		$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2' or gcd='22'") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($get))
		{
			?>
			<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $cldgr ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
			<?php  
		}
	?>
	</select>
</div>   
<div class="form-group col-md-6">
<label><font color="red">*</font>Payment Mode:</label>
	<select name="paymtd" id="paymtd" class="form-control">
	<option value="">-- Select --</option>
	<?php  
		$get = mysqli_query($conn,"SELECT * FROM ac_paymtd") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($get))
		{
		?>
		<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $mtd ? 'selected' : '' ?>><?php  echo $row['mtd']?></option>
		<?php  
		} 
	?>
	</select>
</div>
<div class="form-group col-md-6">
<label>Ref. No. :</label>
<input type="text" name="refno" id="refno" value="<?php echo $mtddtl;?>" class="form-control">
</div>   
<div class="form-group col-md-6">
<label><font color="red">*</font>Amount:</label><br>
<img src="images\rp.png" height="15px"><input type="text" name="amm" id="amm" value="<?php echo $amm;?>" class="sc" style="width:230px; height:30px;">
</div>
<div class="form-group col-md-6">
<label><font color="red">*</font>Narration:</label>
<input type="text" name="nrtn" id="nrtn" value="<?php echo $nrtn;?>" class="form-control">
<input type="hidden" name="it" id="it" value="NA" readonly >
</div>
<div class="form-group col-md-12" style="text-align:center;">
<label></label>
<input type="submit" value="Update" class="btn btn-success">
<input type="hidden" name="updt" id="updt" value="<?php echo $sl;?>">
<script type="text/javascript">
$('#sid').chosen({no_results_text: "Oops, nothing found!",});
</script>
</div>
</div>
</div>