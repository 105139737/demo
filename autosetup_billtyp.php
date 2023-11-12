<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$cy1=date('y');
?>

<form name="f11" method="post" action="autosetup_billtyps.php">
<table class="table table-bordered table-striped">
<tr>
<td align="right" style="padding-top:15px;"><b>Session:</b> </td>
<td>
<input type="text" class="form-control" name="sesn" id="sesn">
</td>
<td  align="right">
<input type="submit" value="Submit" class="btn btn-primary">
</td>
</tr>

</table>
</form>
