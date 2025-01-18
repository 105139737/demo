<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];		
		$data= mysqli_query($conn,$conn,"SELECT * FROM main_drcr where sl='$sl'");
								while ($row = mysqli_fetch_array($data))
		{
		$dt= $row['dt'];
		$pno= $row['pno'];
		$vno= $row['vno'];
		$cldgr= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$mtd= $row['mtd'];
		$mtddtl= $row['mtddtl'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$it= $row['it'];
		$cid= $row['cid'];
		$brncd= $row['brncd'];
		}
		$dt=date('Y-m-d', strtotime($dt));
?>
<div class="box box-success">
<div class="box-header">
<div class="form-group col-md-6">
<label><font color="red">*</font>Date:</label>
<input type="date" name="dt" id="dt" value="<?php  echo $dt;?>" class="form-control">
</div>
<div class="form-group col-md-6">
<label><font color="red">*</font>JF No.:</label>
<input type="text" name="vno" id="vno" class="form-control" value="<?php  echo $vno;?>" readonly style="background :transparent; color : red;">
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
	$result3 = mysqli_query($conn,$conn,$query);
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
<label><font color="red">*</font>Project:</label>
<input type="text" name="proj" id="proj" value="NA" class="form-control" readonly>
</div>
<div class="form-group col-md-6">
<label><font color="red">*</font>Customer:</label>
<input type="hidden" value="4" id="cldgr" name="cldgr"> 
	<select id="cid" name="cid" onchange="gtcrvl1()" class="form-control">
	<option value="">---Select---</option>
	<?php 
		$query="Select * from  main_cust order by nm";
		$result = mysqli_query($conn,$conn,$query);
		while ($R = mysqli_fetch_array ($result))
		{
			$spn=$R['nm'];
			?>
			<option value="<?php  echo $R['sl'];?>"<?php  echo $R['sl'] == $cid ? 'selected' : '' ?>><?php  echo $spn;?></option>
			<?php 
		}
	?>
	</select>
</div>
<div class="form-group col-md-6">
<label><font color="red">*</font>Cash Or Bank Ac.:</label>
	<select name="dldgr" id="dldgr" class="form-control">
	<option value="">-- Select --</option>
	<?php  
	$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
	while($row = mysqli_fetch_array($get))
	{
	?>
	<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $dldgr ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
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
		$get4 = mysqli_query($conn,"SELECT * FROM ac_paymtd") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($get4))
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
<input type="text" name="refno" id="refno" class="form-control" value="<?php  echo $mtddtl;?>">
</div>   
<div class="form-group col-md-6">
<label><font color="red">*</font>Amount:</label><br>
<img src="images\rp.png" height="15px"><input type="text" name="amm" id="amm" class="sc" value="<?php  echo $amm;?>" style="width:230px; height:30px;">
</div>
<div class="form-group col-md-6">
<label><font color="red">*</font>IT/Non-IT:</label>
<input type="text" name="it" id="it" value="NA" class="form-control" readonly >
</div>   
<div class="form-group col-md-12">
<label><font color="red">*</font>Narration:</label>
<input type="text" name="nrtn" id="nrtn" class="form-control" value="<?php  echo $nrtn;?>">
</div>
<div class="form-group col-md-12" style="text-align:center;">
<label></label>
<input type="submit" value="Update" class="btn btn-success">
<input type="hidden" name="updt" id="updt" value="<?php  echo $sl;?>">
</div>
</div>
</div>