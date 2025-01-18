<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$fbcd=$_REQUEST[fbcd];

?>
	<select id="prnm" name="prnm" class="sc1" onchange="gtt_unt();getb();get_betno();" tabindex="1" >
	<option value="">---Select---</option>
	<?php 
	$query6="select * from  ".$DBprefix."product where typ='0' order by pnm";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$sl=$row['sl'];
	$pnm=$row['pnm'];
	$cat=$row['cat'];
	$bnm=$row['bnm'];
	$mnm=$row['mnm'];
	$stck=0;
	$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$sl' and bcd='$fbcd'";
	$result4 = mysqli_query($conn,$query4);
	while ($R4 = mysqli_fetch_array ($result4))
	{
		$stck=$R4['stck1'];
	}
	?>
	<option value="<?php  echo $row['sl'];?>"><?php echo reformat($pnm);?>  (Stock : <?php  echo $stck;?> )</option>
	<?php 
	}
	?>
	</select>
<script type="text/javascript">
   $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
</script>