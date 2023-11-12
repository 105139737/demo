<?php
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
$tblnm=$_REQUEST['tblnm'];

?>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link rel="stylesheet" href="wb.validation.css" type="text/css">
<script type="text/javascript" src="wb.validation.min.js"></script>
<input type="text" value="<? echo $fv;?>"  id="tb" name="tb" onblur="edt1('<?=$sl;?>','<?=$fn;?>',this.value,'<?=$div;?>','<?=$tblnm;?>')" style="color:red" class="form-control">
<script type="text/javascript"> 
$(document).ready(function()
{
   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-M-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#tb").datepicker(jQueryDatePicker1Opts);
});
</script>