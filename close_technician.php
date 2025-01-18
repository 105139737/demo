<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
date_default_timezone_set('Asia/Kolkata');
$dt=date('d-M-Y');

$sl=$_REQUEST['sl'];

$get=mysqli_query($conn,"select * from main_call where sl='$sl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$call_type=$row['call_type'];
	$tech_id=$row['tech_id'];
	$callid=$row['call_id'];
	 $refno=$row['refno'];
	 $cnm=$row['cnm'];
}
?>



<form name="form1" method="post" action="close_technicians.php" id="form1" onsubmit="return check1()" enctype="multipart/form-data">
<input type="hidden" name="sl" id="sl" value="<?php  echo $sl;?>">
<input type="hidden" name="calltyp" id="calltyp" value="<?php  echo $call_type;?>">
<input type="hidden" name="callid" id="callid" value="<?php  echo $callid;?>">
<input type="hidden" name="refno" id="refno" value="<?php  echo $refno;?>">
<input type="hidden" name="cid" id="cid" value="<?php  echo $cnm;?>">

<?php 
if($call_type==1)
{
?>
<table border="0" align="center" class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:right;"><label>Type:</label></td>
<td>
	<select name="typ" id="typ" class="form-control" size="1">
	<Option value="">---Select---</option>
	<Option value="Card">Card</option>
	<Option value="Payment">Payment</option>
	</select>
</td>
<td align="right"><font color="red">* </font>Amount :</td>
<td align="left"><input type="text" class="span2 form-control" name="amm" id="amm" size="20"></td>
</tr>
<tr>
<td align="right"><font color="red">* </font>Remark :</td>
<td colspan="3" align="left"><input type="text" class="span2 form-control" name="rmk" id="rmk" size="20"></td>
</tr>
<tr>
<td colspan="4" style="text-align:center;">
<input type="submit" class="btn btn-success btn-sm" id="Button1" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit" >
</td>
</tr>
</table>
<?php 
}
elseif($call_type==2)
{
	//Repiar
?>
<table border="0" align="center" class="advancedtable" width="100%">
<tr class="even">
<th width="25%"><label>Parts</label></th>
<th width="25%"><label>Warranty type</label></th>
<th width="10%">Rate </th>
<th width="15%">Stock On Hand</th>
<th width="10%">Quantity </th>
<th colspan="2" width="15%">Total Amount </th>
</tr>
<tr>
<td width="25%">
<select name="pcd" id="pcd" class="form-control" size="1">
<Option value="">---Select---</option>
<?php 
$sql=mysqli_query($conn,"select main_parts.pnm as pnm,main_tech_det.pcd as pcd,main_tech_det.qty as qty from main_parts,main_tech_det where main_parts.sl=main_tech_det.pcd and main_tech_det.refno='$refno'") or die (mysqli_error($conn));
while($r=mysqli_fetch_array($sql))
{
	$pnm=$r['pnm'];
	$pcd=$r['pcd'];
	$qty=$r['qty'];
	?>
	<Option value="<?php  echo $pcd;?>"><?php  echo $pnm;?>--Quantity-<?php  echo $qty;?></option>
	<?php 
}
?>



</select>
</td>

<td width="25%">
<select name="wtyp" id="wtyp" class="sc1" style="width:100%" size="1" onchange="showrt()">
<Option value="">---Select---</option>
<Option value="1">In Warranty</option>
<Option value="2">Out Warranty</option>




</select>
</td>


<td align="left" width="10%">
<input type="text" class="sc" name="rt" id="rt">
<input type="hidden" class="span2 form-control" name="tid" id="tid"  value="<?php  echo $tech_id;?>">
</td>
<td align="left" width="15%"><input type="text" class="sc" name="qnty2" id="qnty2"  ></td>
<td align="left" width="10%"><input type="text" class="sc" name="qnty" id="qnty"  onblur="chkval()"></td>
<td align="left" width="10%"><input type="text" class="sc" name="amm" id="amm" ></td>
<td align="left" width="5%"><input type="button" class="btn btn-primary btn-sm" style="width:100%;padding:5px" value="ADD" onclick="add()"></td>
</tr>


<tr><td valign="top" colspan="7" height="250px;">
<div id="wb_Text13">

</div>
</td></tr>
</table>
<table class="advancedtable" width="100%">
<tr>
<td align="left"><font color="red">* </font>
<b>Remark :</b>
<textarea class="span2 form-control" name="rmk" id="rmk" size="20" cols="10" rows="5"></textarea></td>
</tr>
<tr>
<td colspan="4" style="text-align:center;">
<input type="submit" class="btn btn-success btn-sm" id="Button1" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit" >
</td>
</tr>
</table>
<?php 
}
elseif($call_type==3)
{
	//Service
	
	?>
<table border="0" align="center" class="table table-hover table-striped table-bordered">
<tr>
<td align="right"><font color="red">* </font>Amount :</td>
<td align="left"><input type="text" class="span2 form-control" name="amm" id="amm" size="20"></td>
</tr>
<tr>
<td align="right"><font color="red">* </font>Remark :</td>
<td align="left"><input type="text" class="span2 form-control" name="rmk" id="rmk" size="20"></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;">
<input type="submit" class="btn btn-success btn-sm" id="Button1" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit" >
</td>
</tr>
</table>
	<?php 
}
else
{
	//Demo
		?>
<table border="0" align="center" class="table table-hover table-striped table-bordered">
<tr>
<td align="right"><font color="red">* </font>Remark :</td>
<td align="left"><input type="text" class="span2 form-control" name="rmk" id="rmk" size="20"></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;">
<input type="submit" class="btn btn-success btn-sm" id="Button1" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit" >
</td>
</tr>
</table>
	<?php 
}
?>
</form>

     <link rel="stylesheet" href="chosen.css">
	<script src="chosen.jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" href="chosen.min.css">
<script>
	$('#pcd').chosen({
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
