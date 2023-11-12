<?php
include "config.php";
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
?>
<input type="text" value="<?=$fv;?>" id="tb" name="tb" onblur="edt1('<?=$sl;?>','<?=$fn;?>',this.value,'<?=$div;?>')">
<script>
document.getElementById('tb').focus();
</script>