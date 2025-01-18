<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$pno=$_REQUEST['pno'] ?? "";
$cid=$_REQUEST['cid'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";
$blno_ref=$_REQUEST['blno_ref']??"";
$brncd1=" and brncd='$brncd'";
$cid1=" and cid='$cid'";
$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";

$blno_ref1="";
if($blno_ref!="")	
{
$blno_ref1=" and blno!='$blno_ref'";
}
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' ".$cid1.$brncd1.$dld.$blno_ref1);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
		

$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where stat='1' ".$cid1.$brncd1.$cld.$blno_ref1);

	while ($row1 = mysqli_fetch_array($data1))
		{
			$t2 = $row1['t2'];
		}
		$T=$t1-$t2;
			?>
<input type="text" name="dbal" id="dbal" value="<?php echo $T;?>" style="background :transparent; color : red;" readonly>
<?php 
if($sl=='7' or $sl=='5')
{
if($T<0){$T=$T*(-1);}
?>
<script>

document.getElementById("tamm").readOnly = false;
document.getElementById('tamm').value='<?php  echo $T;?>';
</script>
<?php }
else
{
?>
<script>
document.getElementById("tamm").readOnly = false;	
</script>
<?php 
	
}
?>
<script>
temp();
</script>
