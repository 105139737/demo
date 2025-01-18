<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$blno=$_REQUEST['blno'];
?>
<div class="box box-success" >
<form method="post" name="form1" id="form1" action="change_states.php">
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >
<tr>
<td><b>From State: </b> <br>
<select id="state" name="state" class="span2 form-control" width="50%" required="">
<option value="">---Select---</option>
	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($result))
		{
	?>
    <option value="<?php  echo $row['sl'];?>"<?php  if($row['sl']=='1'){echo 'selected';}?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
<?php }?>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="right" style="padding-right: 8px;">
<input type="hidden" id="blno" name="blno" value="<?php  echo $blno;?>">
<input type="submit" class="btn btn-primary" id="Button1" name="Button1" value="Update">
</td>
</tr>
</table>
</form>
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