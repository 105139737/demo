<?php 
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
$tblnm=$_REQUEST['tblnm'];

?>
<input type="text" <?php  if($fn=='cont'){?>onkeypress="return isNumber(event)" maxlength="10" <?php  } ?>  value="<?php  echo $fv;?>"  id="tb" name="tb" onblur="edt1('<?php  echo $sl;?>','<?php  echo $fn;?>',this.value,'<?php  echo $div;?>','<?php  echo $tblnm;?>')" style="color:green;width: 10%;" class="form-control">
<script>
document.getElementById('tb').focus();

function isNumber(evt) 
 {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 48 || iKeyCode > 57)
		{
            return false;
        }
        return true;
 }
</script>