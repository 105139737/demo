<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$adl=rawurldecode($_REQUEST['adl']);
$remkk=$_REQUEST['remkk'];
?>
  		<select  name="remk" id="remk" tabindex="1"  class="form-control">
		<option value="">---Select---</option>
		<?php 
		if($adl=="+")
		{
		$gettt = mysqli_query($conn,"SELECT * FROM main_group WHERE pcd='8'") or die(mysqli_error($conn));	
		}
		else if($adl=="-")
		{
		$gettt = mysqli_query($conn,"SELECT * FROM main_group WHERE pcd='7'") or die(mysqli_error($conn));		
		}
		while($SS = mysqli_fetch_array($gettt))
		{
		$gsl=$SS['sl'];	
		$getl = mysqli_query($conn,"SELECT * FROM main_ledg WHERE gcd='$gsl'") or die(mysqli_error($conn));	
		while($PM = mysqli_fetch_array($getl))
		{
		?>
		<option value="<?=$PM['sl'];?>" <?php if($PM['sl']==$remkk){?> selected <? } ?>><?=$PM['nm']?></option>
		<?php 
		}
		} 
		?>
		</select>
<script>	

   $('#remk').chosen({
  no_results_text: "Oops, nothing found!",
   }); 
</script>