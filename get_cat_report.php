<?
$reqlevel = 1;
include("membersonly.inc.php");
$brand=$_REQUEST['brand'];
?>
<select name="scat[]"  class="form-control" size="1" id="scat" multiple>
<?
$data1 = mysqli_query($conn,"Select * from main_scat where sl>0 and FIND_IN_SET(cat, '$brand')>0");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$nm=$row1['nm'];
?>
<Option value="<?=$sl;?>"><?=$nm;?></option>
	<?}?>
</select>
     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#scat').chosen({no_results_text: "Oops, nothing found!",});	
$('#scat').css('width','100%');	

</script>