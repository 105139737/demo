<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$sper=$_REQUEST['sper'];


$geti=mysqli_query($conn,"select * from main_slp_brnd where spsl='$sper'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
	$catsl=$rowi['catsl'];
}
?>
	<select name="brand"  class="form-control" size="1" id="brand" tabindex="8" onchange="show()"  >
	<option value="">---ALL---</option>
	<?php
	$data13 = mysqli_query($conn,"Select * from main_catg where sl>0 and find_in_set(sl,'$catsl')>0");
	while ($row13 = mysqli_fetch_array($data13))
	{
	$sl3=$row13['sl'];
	$cnm=$row13['cnm'];
	?>
	<Option value="<?=$sl3;?>"  ><?=$cnm;?></option>
	<?php 
	}
	?>
	</select>
	     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#brand').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand_chosen').css('width','100%');	
</script>
