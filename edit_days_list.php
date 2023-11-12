<?php
$reqlevel = 1;
include("membersonly.inc.php");
?>
<form name="form1" id="form1" method="post" action="edit_dayss.php">
<table class="table table-hover table-striped table-bordered">	 
<tr>
<td class="hdng" align="center">SL</td>
<td class="hdng" align="center">Days</td>
<td class="hdng" align="center" hidden>User Permissions</td>
<td class="hdng" align="center" hidden>Action</td>
</tr>
<?php
$sln=0;
$data=mysqli_query($conn,"select * from main_edit_days where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($data);
while($row=mysqli_fetch_array($data))
{
$sln++;
$x=$row['sl'];
$days=$row['days'];
$puser=$row['puser'];

?>
<tr>
<td align="center" class="hdng" style="width: 10%;"><?php echo $sln;?></td>
<td align="center" class="hdng" style="width: 50%">
<div id="days<?php echo $x;?>">
<a onclick="sedt('<?php echo $x;?>','days','<?php echo $days;?>','days<?php echo $x;?>','main_edit_days')"><b><?php echo $days;?></b></a>
</div>
</td>
<td width="40%" hidden>
	<select  name="puser[]" id="puser" class="form-control" multiple>

<?php
		$select=mysqli_query($conn,"SELECT * FROM main_signup where sl>0 and FIND_IN_SET(username, '$puser')>0  ORDER BY username") or die(mysqli_error($conn));;
		while($r1=mysqli_fetch_array($select))   
		{
			$sl=$r1['sl'];
			$username=$r1['username'];
			$name=$r1['name'];
			?>
			<option value="<?=$username;?>" selected><?=$username;?> - ( <?=$name?> )</option><?php
		}
	?>
	
	<?php
		$select=mysqli_query($conn,"SELECT * FROM main_signup where sl>0 and FIND_IN_SET(username, '$puser')=0  ORDER BY username") or die(mysqli_error($conn));;
		while($r1=mysqli_fetch_array($select))   
		{
			$sl=$r1['sl'];
			$username=$r1['username'];
			$name=$r1['name'];
			?>
			<option value="<?=$username;?>"><?=$username;?> - ( <?=$name?> )</option><?php
		}
	?>
	</select>
</td>
<td align="center" class="hdng" style="width: 10%;" hidden><input type="submit" class="btn btn-success" value="Submit"></td>
</tr>	 
<?php
}
$datas=mysqli_query($conn,"select * from global where sl=1")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($datas))
{
$sms=$row['sms'];
}
?>
</table>
<br>
<table class="table table-hover table-striped table-bordered">
<tr>
<td>
	<b>SMS</b><br>
	<select  name="sms" id="sms" class="form-control" onchange="smsChange(this.value)">
	<option value="1" <?php if($sms==1){echo 'selected';}?> >On</option>
	<option value="0" <?php if($sms==0){echo 'selected';}?>>Off</option>
</select>
</td>	

<td>
	<b>Link Change</b><br>
<input type="button" value="Key Generate" onclick="linkid()" id="k" name="k" class="btn btn-success">
</td>

</tr>
</table>
</form>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>  
$('#puser').chosen({no_results_text: "Oops, nothing found!",});
</script>