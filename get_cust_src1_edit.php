<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$cs=rawurldecode($_REQUEST['cs'] ?? "");
$tp=rawurldecode($_REQUEST['tp'] ?? "");
?>
	<select id="invto" name="invto" tabindex="1"  class="form-control" >
	<option value="">---Select---</option>
	<?php 
	$qury2=" and (nm like '%$cs%' or cont like '%$cs%')";
	
		$query="select * from main_cust WHERE sl>0 and typ='$tp'  and stat='0' $qury2 order by nm limit 0,10";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
		$typ1=$rw['typ'];				
			?>
			<option value="<?php  echo $rw['sl'];?>"><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?> <?php if($rw['addr']!=""){?>( <?php  echo $rw['addr'];?> )<?php }?></option>
			<?php 
		}
	?>
	</select>
<script>
$('#invto').chosen({
no_results_text: "Oops, nothing found!",

});
$('#invto_chosen .chosen-drop').click(function(e) {
  e.stopPropagation();
});
$("#invto").trigger("chosen:open");
// addClass=(selector,classes)=>document.querySelector(selector).classList(...classes.split(' '));
// addClass('#invto_chosen','chosen-container chosen-container-single chosen-with-drop chosen-container-active');
//document.getElementById("invto_chosen").classList.add("chosen-container chosen-container-single chosen-with-drop chosen-container-active")
document.getElementById('invto_chosen').className+=' chosen-with-drop chosen-container-active'
document.getElementById("cs1").focus();
//chosen-container chosen-container-single chosen-with-drop chosen-container-active
</script>