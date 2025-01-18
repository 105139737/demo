<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$cs=rawurldecode($_REQUEST['cs'] ?? "");
$id=rawurldecode($_REQUEST['id'] ?? "");
$fn=rawurldecode($_REQUEST["fn"]);
$searchid=rawurldecode($_REQUEST["searchid"]);
$querys=rawurldecode($_REQUEST["query"]);
$efn=rawurldecode($_REQUEST["efn"]);
?>
<select id="<?php  echo $id;?>" name="<?php  echo $id;?>" tabindex="1"  class="form-control" <?php  if(!empty($fn)){?> onchange="<?php  echo $fn;?>();<?php  echo $efn;?>" <?php  } ?> >
<option value="">---Select---</option>
<?php 
$qury2=" and (nm like '%$cs%' or cont like '%$cs%')";

$query="select * from main_cust WHERE sl>0 $qury2 $querys order by nm limit 0,20";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$typ1=$rw['typ'];				
?>
<option value="<?php  echo $rw['sl'];?>"><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?></option>
<?php 
}
?>
</select>
<script>
$('#<?php  echo $id;?>').chosen({
no_results_text: "Oops, nothing found!",

});
$('#<?php  echo $id;?>_chosen .chosen-drop').click(function(e) {
  e.stopPropagation();
});
$("#<?php  echo $id;?>").trigger("chosen:open");
document.getElementById('<?php  echo $id;?>_chosen').className+=' chosen-with-drop chosen-container-active'
document.getElementById("<?php  echo $searchid;?>").focus();
</script>