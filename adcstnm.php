<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cust_typ=$_REQUEST['cust_typ'];
$brand=$_REQUEST['brand'];
?>
<div class="box box-success" >
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >
<tr style="display:none">
<td align="right" width="30%">Ledger Type:</td>
<td  width="70%">
<select id="ctyp" name="ctyp" class="span2 form-control" style="width:100%">
			<?php 
			$p=mysqli_query($conn,"select * from main_cus_typ where sl='$cust_typ'") or die (mysqli_error($conn));
			while($rw2=mysqli_fetch_array($p))
		{
			?>
			<option value="<?php  echo $rw2['sl'];?>" ><?php  echo $rw2['tp'];?></option>
			<?php 
		}
			?>
</select> 
</td>
</tr>
<tr>
<td align="right">Name : </td>
<td>
<input type="text" class="form-control" id="nm" name="nm" value="" placeholder="Please Enter Customer Name" style="width:100%">
</td>
</tr>

<tr>
<td align="right">GSTIN No. : </td>
<td>
<input type="text" class="form-control" id="gstin_no" name="gstin_no" value="" placeholder="Please Enter GSTIN No." style="width:100%">
</td>
</tr>
<tr>
<td align="right" width="20%">GSTIN Applicable Date : </td>
<td  width="30%">
<input type="text" class="form-control" id="gstdt" name="gstdt" value="" style="width:100%">
</td>
</tr>

<tr>
<td align="right">Brand:</td>
<td>
<select id="brand"  name="brand" class="form-control" >
	<?php 
	$sq="SELECT * FROM main_catg WHERE sl='$brand'";
	$res = mysqli_query($conn,$sq) or die(mysqli_error($conn));
	while($ro=mysqli_fetch_array($res))
	{
	?>
    <option value="<?php  echo $ro['sl'];?>"><?php  echo $ro['cnm'];?></option>
	<?php }?>
</select>
</td>
</tr>


<tr>
<td align="right">Pin :</td>
<td>
<input type="text" class="form-control" id="pin" name="pin" value="" placeholder="Please Enter Pin" onkeypress="return isNumber(event)" maxlength="6">
</td>
</tr>

<tr>
<td align="right">Town/ City :</td>
<td>
<input type="text" class="form-control" id="town" name="town" value="" placeholder="Please Enter Town/ City">
</td>
</tr>
<tr>
<td align="right">Distance :</td>
<td>
<input type="text" class="form-control" id="distn" name="distn" value="" placeholder="Please Enter Distance">
</td>
</tr>
<tr>
<td align="right">Sales Person:</td>
<td>
<select name="s_per" id="s_per" class="form-control">
<option value="">---Select---</option>
<?php 
$dsql=mysqli_query($conn,"select * from main_sale_per order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$spid=$erow['spid'];
?>
<option value="<?php  echo $spid;?>"><?php  echo $spid;?></option>
<?php 
}
?>
</select>
</td>
</tr>


<tr>
<td align="right">Mobile No. :</td>
<td>
<input type="text" class="form-control" id="mob1" name="mob1" maxlength="10" minlength="10" placeholder="Enter Mobile No." style="width:100%" onkeypress="return isNumber(event)"></td>
</tr>
<tr>
<td align="right">Address : </td>
<td>
<input type="text" class="form-control" id="addr1"  name="addr1" value="" placeholder=" Address" style="width:100%">
</td>
</tr>



<tr>
<td align="right">E-Mail ID :</td>
<td>
<input type="text" class="form-control" id="email"  name="email" value="" placeholder="Please Enter  E-Mail" style="width:100%"></td>
</tr>
<tr>
<td colspan="2" align="right" style="padding-right: 8px;">
<input type="button" class="btn btn-primary" id="Button1" name="Button1" value="ADD" onclick="addspnm();">
</td>
</tr>
</table>
</div>
<script type="text/javascript" language="javascript">
$(document).ready(function()
{

var jQueryDatePicker2Opts =
{
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};
  
$("#gstdt").datepicker(jQueryDatePicker2Opts);
$("#gstdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});	  

});

</script>