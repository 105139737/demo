<?
$reqlevel = 3;
include("membersonly.inc.php");
$blno=$_REQUEST['blno'];
?>
<form method="post" action="bfl_uploads.php" name="form1"  id="form1"  enctype="multipart/form-data" >

<input type="hidden" class="form-control" id="blno" name="blno" value="<?php echo $blno;?>">
<div class="box box-success" >
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right">File : </td>
<td>
<input type="file" class="form-control" id="blno_file" name="blno_file" required style="width:100%">
</td>
</tr>
<tr>
<td colspan="2" align="right" style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="Button1" value="Upload" >
</td>
</tr>
</table>
</div>
</form>
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