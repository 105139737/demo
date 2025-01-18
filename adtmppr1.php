<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'] ?? "";
$unit=$_REQUEST['unit'] ?? "";
$usl=$_REQUEST['usl'] ?? "";
$qnty=$_REQUEST['qnty'] ?? 0;
$mrp=$_REQUEST['mrp'] ?? 0;
$total=$_REQUEST['total'] ?? 0;
$disp=$_REQUEST['disp'] ?? 0;
$disa=$_REQUEST['disa'] ?? 0;
$ldis=$_REQUEST['ldis'] ?? "";
$ldisa=$_REQUEST['ldisa'] ?? "";
$lttl=$_REQUEST['lttl'] ?? "";
$fst=$_REQUEST['fst'] ?? "";
$tst=$_REQUEST['tst']?? "";
$cgst_rt=$_REQUEST['cgst_rt'] ?? 0;
$sgst_rt=$_REQUEST['sgst_rt'] ?? 0;
$igst_rt=$_REQUEST['igst_rt'] ?? 0;
$cgst_am=$_REQUEST['cgst_am'] ?? 0;
$sgst_am=$_REQUEST['sgst_am'] ?? 0;
$igst_am=$_REQUEST['igst_am'] ?? 0;
$net_am=$_REQUEST['net_amm'] ?? 0;
$bcd=$_REQUEST['bcd'] ?? "";
$rate=$_REQUEST['rate'] ?? "";
$betno=$_REQUEST['betno'] ?? "";
$tsl=$_REQUEST['tsl'] ?? "";
$ssl="";
if($tsl!=""){$ssl=" and sl!='$tsl'";}

$err="";
if($prnm=='' or $unit=='' or $qnty=='' or $mrp==''  or $bcd=='' or $net_am<1)
{
$err="Please Fill All Fields ...";
}
$query1 = "SELECT * FROM ".$DBprefix."ptemp where prsl='$prnm' and eby='$user_currently_loged' $ssl";
$result1 = mysqli_query($conn,$query1);
$count=mysqli_num_rows($result1);
if($count>0)
{
//$err="Product Already Exists....";	
}

$query6="select * from  ".$DBprefix."product where sl='$prnm'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$cat=$row['cat'];
$scat=$row['scat'];
}

if($err=="")
{
$tpcd="";
if($tsl=='')
{
$res=mysqli_query($conn,"select * from  main_product_to where fpcd='$prnm'");
while($row=mysqli_fetch_array($res))
{
$tpcd=$row['tpcd'];
}
}	
	
	
if($tsl=="")
{
$query21 = "INSERT INTO ".$DBprefix."ptemp(cat,scat,unit,prsl,qty,mrp,ttl,eby,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,betno)
VALUES('$cat','$scat','$unit','$prnm','$qnty','$mrp','$lttl','$user_currently_loged','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$lttl','$usl','$total','$disp','$disa','$ldis','$ldisa','$bcd','$rate','$betno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
else
{
$query21 = "UPDATE main_ptemp SET cat='$cat',scat='$scat',unit='$unit',prsl='$prnm',qty='$qnty',mrp='$mrp',
ttl='$lttl',eby='$user_currently_loged',fst='$fst',tst='$tst',cgst_rt='$cgst_rt',sgst_rt='$sgst_rt',igst_rt='$igst_rt',
cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am',amm='$lttl',usl='$usl',total='$total',
disp='$disp',disa='$disa',ldis='$ldis',ldisa='$ldisa',bcd='$bcd',rate='$rate',betno='$betno' WHERE sl='$tsl'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 	
?>
<script>
$('.upd').html('<input type="button" value="ADD" onclick="add()" style="padding:2px;width:100%" class="btn btn-info">');
reset();
//get_prod('<?php  echo $prnm;?>');
document.getElementById("prnm3").focus();
</script>
<?php 
}

if($tpcd!='')
{

$query67="select * from main_purchasedet where prsl='$tpcd' order by sl desc limit 0,1";
$result57 = mysqli_query($conn,$query67) or die (mysqli_error($conn));
while($row7=mysqli_fetch_array($result57))
{
$mrp=$row7['mrp'];
$disp=$row7['disp'];
$disa=$row7['disa'];
}

?>
<script>

$('#cat').trigger('chosen:open');

$('#prnm').append("<option value='"+<?php  echo $tpcd;?>+"'>Auto Adding</option>");
document.getElementById('prnm').value="<?php  echo $tpcd;?>";
$('#prnm').trigger("chosen:updated");
document.getElementById('bcd').value="<?php  echo $bcd;?>";
document.getElementById('mrp').value="<?php  echo $mrp;?>";
document.getElementById('qnty').value="<?php  echo $qnty;?>";
document.getElementById('total').value="<?php  echo $mrp*$qnty;?>";
document.getElementById('ain').value="1";
$('#bcd').trigger("chosen:updated");	
get_gstval();
gtt_unt();

//get_prod('<?php  echo $prnm;?>');
</script>
<?php 



}
else
{
?>
<script>
reset();
</script>
<?php 	
}
?>
<script>
tmppr1();
//get_prod('<?php  echo $prnm;?>');
</script>
<?php 
}
else
{
?>
<script>
alert('<?php  echo $err;?>');
tmppr1();
</script>
<?php 	
}
?>
