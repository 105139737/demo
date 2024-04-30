<?php
$reqlevel = 1;
include("membersonly.inc.php");
$cs=rawurldecode($_REQUEST[cs]);
$brncd=$_REQUEST[brncd];
$brand=$_REQUEST[brand];
$tp=$_REQUEST[tp];


?>
	<select id="custnm" name="custnm" tabindex="1" class="form-control" onchange="gtid()">
	<option value="">---Select---</option>
	<?php
		if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
	$qury2=" and (nm like '%$cs%' or cont like '%$cs%')";
	$query="select * from main_cust  WHERE sl>0 and brncd='$brncd' and stat='0' $qury $qury2 order by nm";
	$result=mysqli_query($conn,$query);
	while($rw=mysqli_fetch_array($result))
	{
	$typ1=$rw['typ'];				
	?>
	<option value="<?php echo $rw['sl'];?>" <?php if($cid==$rw['sl']){?> selected <?php }?>><?php echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php echo $rw['cont'];?> )<?php }?> </option>
	<?php
	}
	?>
	</select>
<?php
//echo $query="select * from main_cust  WHERE sl>0 and brncd='$brncd' and stat='0' $qury $qury2 order by nm";
?>
<script>
$('#custnm').chosen({
no_results_text: "Oops, nothing found!",

});
</script>