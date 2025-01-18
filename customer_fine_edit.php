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
$dt=date('d-m-Y', strtotime($dt));
?>
<form name="Form1" method="post" action="customer_fine_edits.php" id="Form1">
<div class="box box-success" >
<table width="100%" class="table table-hover table-striped table-bordered">
<tr >
<td align="left" width="50%" ><font color="red">*</font>Date :
<input type="text" name="dt" class="form-control dat" id="dt" value="<?php  echo $dt; ?>"> 
</td>
<td align="left" width="50%" ><font color="red">*</font>Branch  :						
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="gtcrvl1();get_blno();" >
<?php 
if($user_current_level<0)
{
?>
<option value="">---Select---</option>
<?php 
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
</td>
</tr>
  
   <tr >
    <td align="left" ><font color="red">*</font>Income Head :
		<select  name="cldgr" id="cldgr" class="form-control" onchange="gtcrvl1()"  >
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
	</td>  

<td align="left" ><font color="red">*</font>Customer :
<input type="hidden" value="4" id="dldgr" name="dldgr"/> 
<table width="100%">	
<tr>
<td width="50%">
<select id="cid"  name="cid"   tabindex="2" class="form-control" ><!--onchange="get_blno()"-->
<option value="">---Select---</option>
<?php 
$query="select * from main_cust  WHERE sl>0 order by nm";
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
</td>
</tr>
</table>
	</td>
  </tr>
  
  
  <tr >
    <td align="left" >Ref. No. :
       <input type="text" name="cbill" class="form-control" id="cbill" size="40" value="<?php echo $cbill;?>">
	</td>  
    <td align="left" ><font color="red">*</font>Ammount :
	 <input type="text" name="amm" id="amm" class="form-control" value="<?php echo $amm;?>">
	</td>	
  </tr>
  
  <tr >
    <td align="left"  colspan="3" ><font color="red">*</font>Narration :
	<input type="text" name="nrtn" class="form-control" id="nrtn" size="100" value="<?php echo $nrtn;?>">
	</td>
  </tr>

  <tr >
    <td colspan="4" align="right"><input type="submit" class="btn btn-info" value="Update"></td>
  </tr>
 <input type="hidden" name="sl" id="sl" value="<?php echo $sl;?>">
</table>
</div>
</form>

<script>
  $('#cid').chosen({
  no_results_text: "Oops, nothing found!",
  })
  

var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-M-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $(".dat").datepicker(jQueryDatePicker1Opts);
   
   

</script>