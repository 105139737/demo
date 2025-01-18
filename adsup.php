<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$typ=$_REQUEST[typ];
?>
<div class="box box-success" >
<table border="0"  width="100%" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" width="30%"  >Company : </td>
<td width="70%">
<input type="text" class="form-control" id="snm" name="snm" value="" placeholder="Please Enter Shop Name" style="width:430px">
</td>
</tr>
<tr>
<td align="right">Contact Person : </td>
<td>
<input type="text" class="form-control" id="cpnm" name="cpnm" value="" placeholder="Please Enter Supplier Name" style="width:430px">
</td>
</tr>
<tr>
<td align="right">Address : </td>
<td>
<input type="text" class="form-control" id="addr1"  name="addr1" value="" placeholder="Please Enter Address" style="width:430px">
</td>
</tr>
<tr>
<td align="right">GSTIN : </td>
<td>
<input type="text" class="form-control" id="gstin_no"  name="gstin_no" value="" placeholder="Please Enter GSTIN" style="width:430px">
</td>
</tr>
<tr>
<td align="right">Mobile No. 1 :</td>
<td>
<input type="text" class="form-control" id="mob1" name="mob1" maxlength="10" minlength="10" onkeypress="return isNumber(event)" placeholder="Please Enter Mobile No." style="width:430px"></td>
</tr>
<tr>
<td align="right">Mobile No. 2 :</td>
<td>
<input type="text" class="form-control" id="mob2" name="mob2" maxlength="10" minlength="10" onkeypress="return isNumber(event)" placeholder="Please Enter Mobile No." style="width:430px"></td>
</tr>
<tr>
<td align="right">E-Mail ID :</td>
<td>
<input type="text" class="form-control" id="email"  name="email" value="" placeholder="Please Enter  E-Mail" style="width:430px"></td>
</tr>


<tr>
<td colspan="2" align="right" style="padding-right: 8px;">
<input type="button" class="btn btn-primary" id="Button1" name="Button1" value="ADD" onclick="addspnm();">
</td>
</tr>
</table>
</div>
<script>
   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
	   $("#dob").datepicker(jQueryDatePicker2Opts);
	  $("#dob").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	   $("#doa").datepicker(jQueryDatePicker2Opts);
	  $("#doa").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});	  
	  </script>