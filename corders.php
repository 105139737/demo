<?php 

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$custnm=$_POST[custnm];
$addr=$_POST[addr];
$mob=$_POST[mob];
$mail=$_POST[mail];
$brncd=$_POST[brncd];
$dt=$_POST[dt];


$pamm=$_POST[pamm];

                                                                                                                                         
$dt=date('Y-m-d', strtotime($dt));
if($idt=="")
{
	$idt="0000-00-00";
}
else
{
$idt=date('Y-m-d', strtotime($idt));
}

$err="";
if($custnm=="")
{
	$err="Please Enter Customer Name...";
}
$query1 = "SELECT * FROM main_ordertmp where eby='$user_currently_loged'";
$result1 = mysqli_query($conn,$query1);
$rowcount=mysqli_num_rows($result1);

if($rowcount==0){
$err="Please Add Some Product First";
}

$m=date('m', strtotime($dt));

$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy="OC/".$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy="OC/".($y-1)."-".$y."/";	
}
if($err=="")
{
	
$query51="select * from main_order order by sl";
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
$query5="select * from main_order where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

}
   

$vatamm=0;
$amm="";
$totamm=$pamm;


$query211 = "INSERT INTO main_order (blno,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby) VALUES ('$blno','$custnm','$gttl','$pamm','$mdt','$cbnm','$dt','$cdt','$dttm','$vat','$vatamm','$car','$dis','$brncd','$user_currently_loged')";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 

 $query100 = "SELECT * FROM ".$DBprefix."ordertmp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$pslno=$R100['pslno'];
$rmk=$R100['rmk'];
$ret=$prc;
$query21 = "INSERT INTO main_orderdtl(prsl,prnm,qty,prc,ttl,blno,rmk,pslno) VALUES ('$prsl','$prnm','$qnty','$prc','$ttl','$blno','$rmk','$pslno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 


$stout=$qnty;

$query6="select * from  ".$DBprefix."product where sl='$prsl'";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
				
				}

		

}
$query2 = "DELETE FROM ".$DBprefix."ordertmp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));



 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM main_orderdtl where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}


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
<font size="5"> <b><a href="corder.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
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
alert('<?php  echo $err;?>');
document.location="corder.php";
</script>
<?php 
}
?>
