<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");

include "header.php";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$cust_nm=$_POST['cust_nm'];
$cont=$_POST['cont'];
$adrs=$_POST['adrs'];
$gstin=$_POST['gstin'];
$dt=$_POST['dt'];
$bcd=$_POST['brncd'];
$fst=$_POST['fst'];
$tst=$_POST['tst'];
$tamm=$_POST['tamm'];
$tgst=$_POST['tgst'];
$payam=$_POST['pay'];

                                                                                                                                         

if($dt=="")
{
	$dt="0000-00-00";
}
else
{
$dt=date('Y-m-d', strtotime($dt));
}

$err="";
if($cust_nm=="")
{
	$err="Please Enter Customer Name...";
}


$query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM main_quo_temp where eby='$user_currently_loged'";
$result1 = mysqli_query($conn,$query1)or die(mysqli_error($conn));
/*$count_row = mysqli_num_rows($result1);*/
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}

if($gttl==0)
{
$err="Please Add Some Product First";
}

if($err=="")
{
$query51="select * from main_quo order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['blno'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
while($count6>0)
{
	$vid1=(int)$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$blno="QUO".$vnoc;
	$query5="select * from main_quo where blno='$blno'";
	$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
	$count6=mysqli_num_rows($result5);
}

$bilamm=$gttl+$cgst+$sgst+$igst;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);

$query211 = "INSERT INTO main_quo (blno,cust_nm,cont,adrs,gstin,fst,tst,gst,amm,tamm,gstam,roff,payam,dt,edt,dttm,bcd,eby) 
VALUES ('$blno','$cust_nm','$cont','$adrs','$gstin','$fst','$tst','1','$tamm','$bilamm','$tgst','$roff','$payam','$dt','$edt','$dttm','$bcd','$user_currently_loged')";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 
	

$query100 = "SELECT * FROM main_quo_temp where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$cat=$R100['cat'];
$scat=$R100['scat'];
$prsl=$R100['prsl'];
$pcs=$R100['pcs'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$fst=$R100['fst'];
$tst=$R100['tst'];
$cgst_rt=$R100['cgst_rt'];
$cgst_am=$R100['cgst_am'];
$sgst_rt=$R100['sgst_rt'];
$sgst_am=$R100['sgst_am'];
$igst_rt=$R100['igst_rt'];
$igst_am=$R100['igst_am'];
$net_am=$R100['net_am'];
$total=$R100['total'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$bcd=$R100['bcd'];
$rate=$R100['rate'];
$tamm1=$R100['tamm'];
$desc=$R100['description'];
$eby=$R100['eby'];
$rate=$net_am/$pcs;


$query21 = "INSERT INTO main_quo_details (blno,total,disp,disa,cat,scat,prsl,description,bcd,pcs,prc,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,rate,eby) 
VALUES ('$blno','$total','$disp','$disa','$cat','$scat','$prsl','$desc','$bcd','$pcs','$prc','$ttl','$tamm1','$fst','$tst','$cgst_rt','$cgst_am','$sgst_rt','$sgst_am','$igst_rt','$igst_am','$net_am','$rate','$user_currently_loged')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
	
}
$query2 = "DELETE FROM main_quo_temp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

$query1 = "SELECT sum(net_am) as gttl FROM main_quo_details where blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}
$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl);


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
<font size="5"> <b><a href="quotation.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="quo_bill_new.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>


<tr>
<td  align="center"  colspan="2">
<font size="4" color="red"> <b> Bill No. : <?php  echo $blno;?></b></font>
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
else
{
?>
<Script language="JavaScript">
alert("<?php  echo $err;?>");
document.location="quotation.php";
</script>
<?php 
}
?>
