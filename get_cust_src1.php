<?
$reqlevel = 1;
include("membersonly.inc.php");
$cs=rawurldecode($_REQUEST[cs]);
$tp=rawurldecode($_REQUEST[tp]);
?>
	<select id="invto" name="invto" tabindex="1"  class="form-control"  onchange="adnew()" onblur="cust_srch1()"  >
	<option value="">---Select---</option>
	<option value="Add">---Add New Customer---</option>
	<?
	$qury2=" and (nm like '%$cs%' or cont like '%$cs%')";
	
		$query="select * from main_cust WHERE sl>0 and typ='$tp'  and stat='0' $qury2 order by nm limit 0,10";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
		$typ1=$rw['typ'];				
			?>
			<option value="<?=$rw['sl'];?>"><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?> <?if($rw['addr']!=""){?>( <?=$rw['addr'];?> )<?}?></option>
			<?
		}
	?>
	</select>
<script>
$('#invto').chosen({
no_results_text: "Oops, nothing found!",

});
</script>