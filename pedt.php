<?php 
include "config.php";
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
?>
<input type="text" value="<?php  echo $fv;?>" id="tb" name="tb" onblur="edt1('<?php  echo $sl;?>','<?php  echo $fn;?>',this.value,'<?php  echo $div;?>')">
<script>
document.getElementById('tb').focus();
</script>