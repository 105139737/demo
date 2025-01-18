<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
$edt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$custnm=$_POST['custnm'];
$brncd=$_POST['brncd'];
$dt1=$_POST['dt'];
$dt=date('Y-m-d', strtotime($dt1));


$prnm=$_POST['prnm'];
$qnty=$_POST['qnty'];
$prc=$_POST['prc'];
$point=$_POST['point'];
$lttl=$_POST['lttl'];


if($custnm=="" and $dt=="" and $brncd=="")
{
	?>
	<script>
	alert("Please Fill all Field Correctly...");
	window.history.go(-1);
	</script>
	<?php 
}
else
{
/*Bill No Create start*/
$m=date('m', strtotime($dt));
$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy="OTH/".$y."-".($y+1)."/";	
}
elseif($m<=3)
{
$yy="OTH/".($y-1)."-".$y."/";	
}	
$query51="select * from ".$DBprefix."billing_oth order by sl";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['blno'];
}
	$vid1=substr($vnos,11,8);
$count6=5;
while($count6>0){
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 8, '0', STR_PAD_LEFT);
$blno=$yy.$vnoc;
$query5="select * from ".$DBprefix."billing_oth where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);
}
/*Bill No Create end*/

$getdata=mysqli_query($conn,"select * from main_slt_oth where eby='$user_currently_loged'")or die(mysqli_error($conn));

while($r=mysqli_fetch_array($getdata))	
{
	$prnm=$r['prnm'];
	$qty=$r['qty'];
	$prc=$r['prc'];
	$point=$r['point'];
	$ttl=$r['ttl'];
	
	$qr1=mysqli_query($conn,"insert into main_bildtls_oth(bilno,prnm,qty,prc,point,ttl,eby) values('$blno','$prnm','$qty','$prc','$point','$ttl','$user_currently_loged')")or die(mysqli_error($conn));

}

$query1 = "SELECT sum(ttl) as gttl ,sum(point) as pttl FROM ".$DBprefix."slt_oth where eby='$user_currently_loged'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$pttl=$R1['pttl'];
}


	
$qr=mysqli_query($conn,"insert into main_billing_oth(blno,cid,dt,bcd,tamm,tpoint,edt,edtm,eby) values('$blno','$custnm','$dt','$brncd','$gttl','$pttl','$edt','$dttm','$user_currently_loged')")or die(mysqli_error($conn));
$qr1=mysqli_query($conn,"insert into main_cust_point(refno,dt,cid,point,edtm,eby) values('$blno','$dt','$custnm','$pttl','$dttm','$user_currently_loged')")or die(mysqli_error($conn));


$query2 = "DELETE FROM ".$DBprefix."slt_oth WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2);



 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM ".$DBprefix."bildtls_oth where bilno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}
if($vat!="")
{
$vat1=($gttl*$vat)/100;
$gttl1=($gttl+$vat1+$car)-$dis;
}
else
{
	$gttl1=($gttl+$car)-$dis;
}

$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl1);








	?>
	
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>

<style>
.bor{
	
border: 1px solid #000;
  
}
.css{
	border:1px solid #000;
	padding: 0px 0px;

	font-size:14px;
	
	color: #000000;
}
#line{
    border-bottom: 1px black solid;

    height:9px;        
   
}

</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="advancedtable.css" rel="stylesheet" type="text/css" />




</head>
<body >
 <center>						
							
<form method="post" action="centrys.php" name="form1"  id="form1">
<table border="0" width="677px">
<tr>
<td  align="center" colspan="2">
<font size="7"><b><?php  echo $comp_nm;?></b></font>
<br>
<font size="4"><b><?php  echo $comp_addr;?></b></font>
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="oth_billing.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_oth.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Bill No. : <?php  echo $blno;?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Total Amount : <?php echo number_format($gttl1,2);?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> In Word : <?php  echo $aiw;?></b></font>
</td>

</tr>
</table>


 </form>      
    </center> 
</body>
</div>
</html>
	
	
	
	
	
	
<?php 
}
?>	