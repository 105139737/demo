<?
$reqlevel = 1;
include("membersonly.inc.php");
$cs=rawurldecode($_REQUEST[cs]);
$tp=rawurldecode($_REQUEST[tp]);
$brand=rawurldecode($_REQUEST[brand]);
?>
	<select id="cid" name="cid" tabindex="1"  class="form-control" onchange="get_blno();get_app();"  >
	<option value="">---Select---</option>
	<option value="Add">---Add New Customer---</option>
	<?
	$qury2=" and (nm like '%$cs%' or cont like '%$cs%')";
	if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
		$query="select * from main_cust WHERE sl>0 and typ='$tp'  and stat='0' $qury2 $qury order by nm limit 0,10";
		$result=mysqli_query($conn,$query);
		while($R=mysqli_fetch_array($result))
		{
			$sid=$R['sl'];
			$spn=$R['nm'];
			$cont=$R['cont'];
			$addr=$R['addr'];			
			?>
			<option value="<? echo $sid;?>" <?if($cid==$sid){?> selected <? } ?> ><? echo $spn;?>  - <? echo $cont;?></option>
			<?
		}
	?>
	</select>
<script>
$('#cid').chosen({
no_results_text: "Oops, nothing found!",

});
$('#cid_chosen .chosen-drop').click(function(e) {
  e.stopPropagation();
});
$("#cid").trigger("chosen:open");
// addClass=(selector,classes)=>document.querySelector(selector).classList(...classes.split(' '));
// addClass('#invto_chosen','chosen-container chosen-container-single chosen-with-drop chosen-container-active');
//document.getElementById("invto_chosen").classList.add("chosen-container chosen-container-single chosen-with-drop chosen-container-active")
document.getElementById('cid_chosen').className+=' chosen-with-drop chosen-container-active'
document.getElementById("cs").focus();
//chosen-container chosen-container-single chosen-with-drop chosen-container-active
</script>