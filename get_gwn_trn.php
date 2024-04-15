<?
$reqlevel = 3;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
?>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt();getb();get_betno();">
<option value="">---Select---</option>
<?
$geti=mysqli_query($conn,"select * from main_godown where stat=1 order by gnm") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];

$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where  pcd='$prnm' and bcd='$sl'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}	
if($stck==''){$stck=0;}
?>
<option value="<? echo $sl;?>"><? echo $gnm;?>  (Stock : <?=$stck;?> )</option>
<?
}
?>
</select>

<script>
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	
gtt_unt();getb();get_betno();
</script>
