<?php
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
$tblnm=$_REQUEST['tblnm'];

?>
<div class="col-xs-6"><input type="text" size="25"style="text-align:center; font-size:24px; color:red; " onkeypress="return check(event)" value="<? echo $fv;?>"  id="tb" name="tb" onblur="edt1('<?=$sl;?>','<?=$fn;?>',this.value,'<?=$div;?>','<?=$tblnm;?>')" class="form-control"></div>
<script>
document.getElementById('tb').focus();
</script>