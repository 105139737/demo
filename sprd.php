<?
$reqlevel = 3;
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];
?>
            <select name="prd" id="prd" class="form-control">
			<option value="">-----Select-----</option>
<?
			$get=mysqli_query($conn,"select * from main_reorder where pcd='$sl' order by pcd")or die(mysqli_error($conn));
			$rcnt=mysqli_num_rows($get);
			if($rcnt>0)
			{
			while($row=mysqli_fetch_array($get))
			{	
		    $pcd=$row['pcd'];
			$qr=mysqli_query($conn,"select * from main_product where sl!='$pcd' order by sl")or die(mysqli_error($conn));
			while($r=mysqli_fetch_array($qr))
			{
					$sl=$r['sl'];	
					$pnm=$r['pnm'];
				?>
				<option value="<?=$sl;?>"><?=$pnm;?></option>
				<?
			}
			}
			}
			else
			{
			$qr=mysqli_query($conn,"select * from main_product order by sl")or die(mysqli_error($conn));
			while($r=mysqli_fetch_array($qr))
			{
					$sl=$r['sl'];	
					$pnm=$r['pnm'];
				?>
				<option value="<?=$sl;?>"><?=$pnm;?></option>
				<?
			}	
			}
			?>
			</select>
<script>

	
		  $('#prd').chosen({
  no_results_text: "Oops, nothing found!",

  });

</script>