<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cont=$_REQUEST['cont'];
$data=mysqli_query($conn,"select * from main_cust where cont='$cont'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
$pin=$row['pin'];
$distn=$row['distn'];
}
?>
<input type="hidden" class="form-control" id="cont" name="cont" value="<?php  echo $cont;?>" >
<div class="box box-success" >
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >


<tr>
<td align="right">Pin :</td>
<td>
<input type="text" class="form-control" id="pin" name="pin" value="<?php  echo $pin;?>" placeholder="Please Enter Pin" onkeypress="return isNumber(event)" maxlength="6">
</td>
</tr>
<tr>
<td align="right">Distance :</td>
<td>
<input type="text" class="form-control" id="distn" name="distn" value="<?php  echo $distn;?>" placeholder="Please Enter Distance">
</td>
</tr>

<tr>
<td colspan="2" align="right" style="padding-right: 8px;">
<input type="button" class="btn btn-primary" id="Button1" name="Button1" value="Update" onclick="pin_diss();">
</td>
</tr>
</table>
</div>
