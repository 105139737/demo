<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];		
$data= mysqli_query($conn,"SELECT * FROM main_drcr where sl='$sl'");
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
	$brncd= $row['brncd'];
	
	$imgpath="img/income/".$vno.".jpg";
		
		if (!file_exists($imgpath)) {
		$imgpath1="img/noimg.jpg";
		}
		else
		{
		$imgpath1=$imgpath;
		}
		
}
$dt=date('Y-m-d', strtotime($dt));
?>
<div class="box box-success">
<div class="box-header">
<div class="form-group col-md-6">
<input type="hidden" name="vno" id="vno" value="<?php  echo $vno?>" class="form-control" readonly style="background :transparent; color : red;">
<select name="proj" id="proj" class="form-control" style="display:none">
	<option value="0" <?php  echo $pno == 0 ? 'selected' : '' ?>> NA </option>
	<?php  
	$get = mysqli_query($conn,"SELECT * FROM main_project") or die(mysqli_error($conn));
	while($row = mysqli_fetch_array($get))
	{
		?>
		<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $pno ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
		<?php  
	} 
	?>
	</select>
	<select  name="it" id="it" class="form-control" style="display:none">
	<option value="">-- Select --</option>
	<option value="1" <?php  echo $it == 1 ? 'selected' : '' ?>>IT</option>
	<option value="0" <?php  echo $it == 0 ? 'selected' : '' ?>>Non-IT</option>
	</select>
<label><font color="red">*</font>Date:</label>
<input type="date" name="dt" id="dt" value="<?php echo $dt;?>" class="form-control">
</div>
<div class="form-group col-md-6">


</div>   
<div class="form-group col-md-6">
<label><font color="red">*</font>Branch:</label>
	<select name="brncd" id="brncd" class="form-control">
	<?php 
		if($user_current_level<0)
		{
			$query="Select * from main_branch where sl='$brncd'";
		}
		else
		{
			$query="Select * from main_branch where sl='$brncd'";
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
<label><font color="red">*</font>Cash Or Bank Ac.:</label>
	<select name="dldgr" id="dldgr" onchange="gtcrvl(this.value)" class="form-control">
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
<label><font color="red">*</font>Income Head:</label>
	<select name="cldgr" id="cldgr" class="form-control" onchange="gtcrvl1(this.value)">
	<option value="">-- Select --</option>
	<?php  
		$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='3' or gcd='4'") or die(mysqli_error($conn));
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
<input type="text" name="refno" id="refno" class="form-control" value="<?php echo $mtddtl;?>">
</div>   
<div class="form-group col-md-6">
<label><font color="red">*</font>Amount :</label><br>
<img src="images\rp.png" height="15px"><input type="text" name="amm" id="amm" value="<?php echo $amm;?>" class="sc" style="width:240px; height:35px;">
</div> 
<div class="form-group col-md-6">
<label><font color="red">*</font>Narration :</label>
<input type="text" name="nrtn" id="nrtn" value="<?php echo $nrtn;?>" class="form-control">
</div>
<div class="form-group col-md-12">
<label><font color="red">*</font>Upload File :</label>
<!--<input type="file" name="fileToUpload1" id="fileToUpload1" class="hidden" onchange="readURL1(this);" accept="image/x-png, image/gif, image/jpeg">--->
<input type="file" name="fileToUpload1" id="fileToUpload1" onchange="readURL1(this);" >
</div>
<div class="form-group col-md-12" style="text-align:center;">
<input type="submit" value="Update" class="btn btn-success">
<input type="hidden" name="updt" id="updt" value="<?php echo $sl;?>" size="40">
</div>
</div>
</div>