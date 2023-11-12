<?php
$reqlevel = 3;
include("membersonly.inc.php");

$cno=$_REQUEST[cno];
?>
<select name="dnm" class="form-control"  id="dnm"   >
<option value="">All</option>
<?
$query="Select * from  main_dirver where cno='$cno' order by dnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$dnm=$R['dnm'];
?>
<option value="<? echo $sl;?>"><? echo $dnm;?></option>
<?
}
?>
</select>
<script>

	
		  $('#dnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  </script>