<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('Asia/Kolkata');
$dt=date('d-m-Y');
$sl=$_REQUEST['sl'];
?>
<form name="form1" method="post" action="assign_technicians.php" id="form1" onsubmit="return check1()" enctype="multipart/form-data">
<input type="hidden" name="sl" id="sl" value="<?php  echo $sl;?>">
<table border="0" align="center" class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:right;padding-top:15px"><label>Technician Name:</label></td>
<td>
<select name="tech_id" id="tech_id" class="form-control" size="1">
<Option value="">---Select---</option>
	<?php 
		$data=mysqli_query($conn,"Select * from main_technician order by nm");
		while($row=mysqli_fetch_array($data))
		{
			$tsl=$row['sl'];
			$tnm=$row['nm'];
			?>
			<option value="<?php  echo $tsl;?>"><?php  echo $tnm;?></option>
			<?php 
		}
	?>
	</select>
</td>
<td align="right" style="padding-top:17px" width="20%"><b>Godown :</b></td>
<td align="left" width="30%">
	<select name="branch" class="form-control" size="1" id="branch" tabindex="8">
	<?php 
		if($user_current_level<0)
		{
			$data2=mysqli_query($conn,"Select * from main_branch order by bnm");
			echo "<option value=''>--- Select ---</option>";
		}
		else
		{
			$data2=mysqli_query($conn,"Select * from main_branch where sl='$branch_code'");
		}
		while($row1=mysqli_fetch_array($data2))
		{
			$sl=$row1['sl'];
			$bnm=$row1['bnm'];
			echo "<option value='".$sl."'>".$bnm."</option>";
		}
	?>
	</select>
</td>
</tr>
<tr>
<td align="right" style="padding-top:15px"><font color="red">* </font><b>Date :</b></td>
<td align="left"><input type="text" class="span2 form-control" name="dt" id="dt" size="20" value="<?php  echo $dt;?>"></td>
<td align="right" style="padding-top:15px"><b>Remark :</b></td>
<td align="left"><input type="text" class="span2 form-control" name="rmk" id="rmk" size="20"></td>
</tr>
</table>

<table width="100%" class="table table-hover table-striped table-bordered">
<tr>
<td>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="center" width="50%"><b>Particulars</b></td>
<td align="center" width="35%" ><b>Quantity</b></td>
<td align="center" width="35%" ><b>Stock On Hand</b></td>
<td align="center" width="15%"><b>Action</b></td>
</tr>
<tr>
<td> 
<div id="plst">
	<select id="pnm"  name="pnm" class="form-control" onchange="showrt()">
	<option value="">---Select---</option>
	<?php 
		$result56 = mysqli_query($conn,"Select * from ".$DBprefix."parts");
		while ($R56 = mysqli_fetch_array ($result56))
		{
			$psl=$R56['sl'];
			$pnm=$R56['pnm'];
			$bnm=$R56['bnm'];
			$cat=$R56['cat'];
			
			$cnm="";
			$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
			while ($row1 = mysqli_fetch_array($data1))
			{
				$cnm=$row1['cnm'];
			}
			$brand="";

			$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
			while ($row1 = mysqli_fetch_array($data2))
			{
				$brand=$row1['brand'];
			}
			?>
			<option value="<?php  echo $psl?>"><?php  echo $pnm?> - <?php  echo $cnm?> - <?php  echo $brand?></option>
			<?php 
		}
	?>
	</select>
</div>
</td>
<td>
<input type="text" id="qnty" class="sc" autocomplete="off" tabindex="2" name="qnty" value="" onkeypress="return check(event)" style="text-align:center">
</td>
<td>
<input type="text" id="qnty2" class="sc"  tabindex="2" name="qnty2" value="" readonly style="text-align:center">
</td>
<td>
<input type="button" class="btn btn-primary btn-xs" id="Button1" name="" tabindex="3" value="Add"  onclick="add()" style="width:100%;" >
</td>
</tr>
</table>
</td>
</tr>
<tr height="230px">
<td>
<div id="wb_Text13" >
</div>
</td>
</tr>
<tr class="odd">
<td colspan="5" align="right">
<input type="submit" class="btn btn-success btn-sm" id="Button1" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit"  >
</td>
</tr>
</table>
</form>

<script>
   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
 $("#dt").datepicker(jQueryDatePicker2Opts);
$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
 </script>
     <link rel="stylesheet" href="chosen.css">
	<script src="chosen.jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" href="chosen.min.css">
<script>
	$('#pnm').chosen({
	no_results_text: "Oops, nothing found!",
	width: '100%',
  });
</script>
<style>

#pnm_chosen
{
	width:100%;
}

</style>