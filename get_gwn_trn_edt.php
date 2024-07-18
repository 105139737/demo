<?
$reqlevel = 3;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$blno=$_REQUEST['blno'];
$fbcd="";
$query100 = "SELECT * FROM main_trndtl where blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$fbcd=$R100['fbcd'];
}
?>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt();get_betno();">
<?php
if($fbcd==""){
?>
<option value="">---Select---</option>
<?php
}
//if($fbcd!=""){$fbcdq=" and sl='$fbcd'";}
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
$stat="";
if(!empty($fbcd)){

if($fbcd!=$sl){
    $stat="disabled";
}
}
?>
<option value="<? echo $sl;?>" <?php echo $stat;?>><? echo $gnm;?>  (Stock : <?=$stck;?> )</option>
<?
}
?>
</select>

<script>
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	
gtt_unt();get_betno();
</script>
