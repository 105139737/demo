<?
$reqlevel = 3;
include("membersonly.inc.php");
$cust_typ=$_REQUEST['cust_typ'];
$brand=$_REQUEST['brand'];
?>
<div class="box box-success" >
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >
<tr style="display:none">
<td align="right">Customer Type:</td>
<td>
<select id="ctyp1" name="ctyp1" class="span2 form-control" style="width:100%">
			<?
			$p=mysqli_query($conn,"select * from main_cus_typ where sl='$cust_typ'") or die (mysqli_error($conn));
			while($rw2=mysqli_fetch_array($p))
		{
			?>
			<option value="<?=$rw2['sl'];?>" ><?=$rw2['tp'];?></option>
			<?
		}
			?>
</select> 
</td>
</tr>
<tr>
<td align="right">Name : </td>
<td>
<input type="text" class="form-control" id="nm1" name="nm1" value="" placeholder="Please Enter Customer Name" style="width:100%">
</td>
</tr>
<tr>
<td align="right">Print Name : </td>
<td>
<input type="text" class="form-control" id="nmp1" name="nmp1" value="" placeholder="Please Enter Customer Print Name" style="width:100%">
</td>
</tr>
<tr>
<td align="right">Mobile No. :</td>
<td>
<input type="text" class="form-control" id="mob11" name="mob11" maxlength="10" minlength="10" placeholder="Enter Mobile No." style="width:100%" onkeypress="return isNumber(event)"></td>
</tr>
<tr>
<td align="right">Pin :</td>
<td>
<input type="text" class="form-control" id="pin1" name="pin1" value="" placeholder="Please Enter Pin" onkeypress="return isNumber(event)" maxlength="6">
</td>
</tr>

<tr>
<td align="right">Town/ City :</td>
<td>
<input type="text" class="form-control" id="town1" name="town1" value="" placeholder="Please Enter Town/ City">
</td>
</tr>
<tr>
<td align="right">Distance :</td>
<td>
<input type="text" class="form-control" id="distn1" name="distn1" value="" placeholder="Please Enter Distance">
</td>
</tr>

<tr>
<td align="right">Address : </td>
<td>
<input type="text" class="form-control" id="addr11"  name="addr11" value="" placeholder=" Address" style="width:100%">
</td>
</tr>
<tr style="display:none">
<td align="right">Brand:</td>
<td>
<select name="brand1" id="brand1" class="form-control">

</select>
</td>
</tr>
<tr>
<td align="right">GSTIN No. : </td>
<td>
<input type="text" class="form-control" id="gstin_no1" name="gstin_no1" value="" placeholder="Please Enter GSTIN No." style="width:100%">
</td>
</tr>
<tr>
<td align="right" width="20%">GSTIN Applicable Date : </td>
<td  width="30%">
<input type="text" class="form-control" id="gstdt1" name="gstdt1" value="" style="width:100%">
</td>
</tr>


<tr>
<td align="right">Sales Person:</td>
<td>
<select name="s_per1" id="s_per1" class="form-control">
<option value="">---Select---</option>
<?
$dsql=mysqli_query($conn,"select * from main_sale_per order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$spid=$erow['spid'];
?>
<option value="<?php echo $spid;?>"><?php echo $spid;?></option>
<?
}
?>
</select>
</td>
</tr>






<tr style="display:none">
<td align="right">E-Mail ID :</td>
<td>
<input type="text" class="form-control" id="email1"  name="email1" value="" placeholder="Please Enter  E-Mail" style="width:100%"></td>
</tr>
<tr>
<td colspan="2" align="right" style="padding-right: 8px;">
<input type="button" class="btn btn-primary" id="Button1" name="Button1" value="ADD" onclick="addspnm1();">
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
  
$("#gstdt1").datepicker(jQueryDatePicker2Opts);
$("#gstdt1").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});	  

});

</script>