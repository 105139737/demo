<?php 
$reqlevel=5;
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
	$cid= $row['cid'];
	$brncd= $row['brncd'];
	$cbill= $row['cbill'];
}
$dt=date('Y-m-d', strtotime($dt));
if($dldgr==7){$cbill="ADVANCE-PAYMENT";}
?>
<div class="box box-success">
<div class="box-header">
<div class="form-group col-md-6">
<label><font color="red">*</font>Date:</label>
<input type="date" name="dt" id="dt" value="<?php echo $dt;?>" class="form-control">
</div>
 
<div class="form-group col-md-6">
<label><font color="red">*</font>Branch:</label>
	<select name="brncd" class="form-control" id="brncd1" onchange="gtcrvl1();gtcrvlfi()" >
	<?php 
	if($user_current_level<0)
	{

	}
	if($user_current_level<0)
	{
		$query="Select * from main_branch";
	}
	else
	{
		$query="Select * from main_branch where sl='$branch_code'";
	}
		$result = mysqli_query($conn,$query);
		while ($R = mysqli_fetch_array ($result))
		{
			$slb=$R['sl'];
			$bnm=$R['bnm'];
			?>
			<option value="<?php  echo $slb;?>"<?php  echo $R['sl'] == $brncd ? 'selected' : '' ?>><?php  echo $bnm;?></option>
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
<label><font color="red">*</font>Customer:</label>
	<input type="hidden" value="4" id="dldgr1" name="dldgr"> 
<select id="cid1" name="cid" class="form-control" onchange="get_blno_edt('<?php  echo $cbill;?>')">
<option value="">---Select---</option>
<?php 
$query="select * from main_cust  WHERE sl='$cid' order by nm";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['nm'];
$cont=$R['cont'];
$addr=$R['addr'];
?>
<option value="<?php  echo $sid;?>" <?php if($cid==$sid){?> selected <?php  } ?> ><?php  echo $spn;?>  - <?php  echo $cont;?></option>
<?php 
}
?>
</select>
</div>

<div class="form-group col-md-6">
Bill No.
<div id="blno_div_edt">
<select id="blno1"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvlfi()">
<option value="">---Select---</option>
</select>
</div>
</div>

<div class="form-group col-md-6">
<label><font color="red">*</font>Payment Mode :</label>
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
<label><font color="red">*</font>Amount:</label><br>
<img src="images\rp.png" height="15px"><input type="text" name="amm" id="amm" value="<?php echo $amm;?>" class="sc" style="width:230px; height:30px;">
</div>
 
<div class="form-group col-md-6">
<label><font color="red">*</font>Narration:</label>
<input type="text" name="nrtn" id="nrtn" value="<?php echo $nrtn;?>" class="form-control">
</div>
<div class="form-group col-md-12" style="text-align:center;">
<label></label>
<input type="submit" value="Update" class="btn btn-success">
<input type="hidden" name="updt" id="updt" value="<?php echo $sl;?>">
</div>
</div>
</div>
<script>
  $('#cid').chosen({
  no_results_text: "Oops, nothing found!",
  })
  
get_blno_edt("<?php echo rawurlencode($cbill);?>");
</script>