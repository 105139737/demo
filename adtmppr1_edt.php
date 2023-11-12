<?php
$reqlevel = 1;
include("membersonly.inc.php");
$prnm=$_REQUEST[prnm];
$unit=$_REQUEST[unit];
$usl=$_REQUEST[usl];
$qnty=$_REQUEST[qnty];
$mrp=$_REQUEST[mrp];
$total=$_REQUEST[total];
$disp=$_REQUEST[disp];
$disa=$_REQUEST[disa];
$ldis=$_REQUEST[ldis];
$ldisa=$_REQUEST[ldisa];
$lttl=$_REQUEST[lttl];
$fst=$_REQUEST[fst];
$tst=$_REQUEST[tst];
$cgst_rt=$_REQUEST[cgst_rt];
$sgst_rt=$_REQUEST[sgst_rt];
$igst_rt=$_REQUEST[igst_rt];
$cgst_am=$_REQUEST[cgst_am];
$sgst_am=$_REQUEST[sgst_am];
$igst_am=$_REQUEST[igst_am];
$net_am=$_REQUEST[net_amm];
$bcd=$_REQUEST[bcd];
$rate=$_REQUEST[rate];
$blno=$_REQUEST[blno];
$tsl=$_REQUEST[tsl];
$betno=$_REQUEST[betno];
$ssl="";
if($tsl!=""){$ssl=" and sl!='$tsl'";}
$err="";
if($prnm=='' or $unit=='' or $qnty=='' or $mrp=='' or $bcd=='' or $net_am<1)
{
$err="Please Fill All Fields ...";
}
$query1 = "SELECT * FROM main_purchasedet_edt where prsl='$prnm' and eby='$user_currently_loged' and blno='$blno' $ssl";
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
if($tsl=="")
{
$query21 = "INSERT INTO main_purchasedet_edt(cat,scat,unit,prsl,qty,mrp,ttl,eby,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,blno,betno)
VALUES('$cat','$scat','$unit','$prnm','$qnty','$mrp','$lttl','$user_currently_loged','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$lttl','$usl','$total','$disp','$disa','$ldis','$ldisa','$bcd','$rate','$blno','$betno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
else
{
$query21 = "UPDATE main_purchasedet_edt SET cat='$cat',scat='$scat',unit='$unit',prsl='$prnm',qty='$qnty',mrp='$mrp',
ttl='$lttl',eby='$user_currently_loged',fst='$fst',tst='$tst',cgst_rt='$cgst_rt',sgst_rt='$sgst_rt',igst_rt='$igst_rt',
cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am',amm='$lttl',usl='$usl',total='$total',
disp='$disp',disa='$disa',ldis='$ldis',ldisa='$ldisa',bcd='$bcd',rate='$rate',blno='$blno',betno='$betno' WHERE sl='$tsl'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 	
?>
<script>
$('.upd').html('<input type="button" value="ADD" onclick="add()" style="padding:2px;width:100%" class="btn btn-info">');
reset();

</script>
<?
}
?>
<script>
tmppr1();
reset();

</script>
<?
}
else
{
?>
<script>
alert('<?=$err;?>');
tmppr1();
</script>
<?	
}
?>
