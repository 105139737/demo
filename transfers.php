<?php
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$fbcd=$_REQUEST['fbcd'];
$tbcd=$_REQUEST['tbcd'];

$dt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');

if($fbcd=="" or $tbcd=="")
{
    $err="Please Fill All Fields..!!";
}


$query1 = "SELECT sum(qty) as gttl FROM ".$DBprefix."trntemp where eby='$user_currently_loged'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}

if($gttl==0)
{
    $err="Please Add Some Product First..!!";
}



$m=date('m');
$y=date('y');
if($m>=4)
{
$yy="TRN-".$branch_als."/".$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy="TRN-".$branch_als."/".($y-1)."-".$y."/";	
}


if($err=="")
{
$vid=0;
$count5=1;
while($count5>0)
{
$vid=$vid+1;
$vno=str_pad($vid, 8, '0', STR_PAD_LEFT);

$blno=$yy.$vno;
$query6="select * from ".$DBprefix."trns where blno='$blno'";
$result5 = mysqli_query($conn,$query6);
$count5=mysqli_num_rows($result5);
}
$query211 = "INSERT INTO main_trns (blno,fbcd,tbcd,edt,dt,eby,edtm) VALUES ('$blno','$fbcd','$tbcd','$dt','$dt','$user_currently_loged','$edtm')";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 




$log="";
$query100 = "SELECT * FROM ".$DBprefix."trntemp where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$remk=$R100['remk'];
$fbcd=$R100['fbcd'];
$refno=$R100['refno'];
$unit=$R100['unit'];
$usl=$R100['usl'];
$betno=$R100['betno'];


/*
$stk_rate=0;
$rate=0;
$query41="Select sum(stk_rate) as stk_rate,sum(rate) as rate,count(*) as total from main_stock where pcd='$prsl' and stk_rate>0 and rate>0 and (stin+opst)>0";
$result41 = mysqli_query($conn,$query41);
while ($R4 = mysqli_fetch_array ($result41))
{
$stk_rate=$R4['stk_rate'];	
$rate=$R4['rate'];	
$total=$R4['total'];	
if($total>0)
{
$stk_rate=round($stk_rate/$total,4);	
$rate=round($rate/$total,4);	
}
}
*/
$avg_rate=avg_rate($prsl);
$rate_array=explode("@@",$avg_rate);
$stk_rate=$rate_array[0];
$rate=$rate_array[1];

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prsl'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$stock_in=$qnty*$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$qnty*$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$qnty*$bgvlu;$uval=$bgvlu;}


$query21 = "INSERT INTO ".$DBprefix."trndtl (fbcd,prsl,prnm,qty,blno,remk,refno,unit,usl,ret,rate,stk_rate,betno,uval) VALUES ('$fbcd','$prsl','$prnm','$qnty','$blno','$remk','$refno','$unit','$usl','$ret','$rate','$stk_rate','$betno','$uval')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
        
 $query1 = "SELECT * FROM ".$DBprefix."trndtl where blno='$blno' order by sl desc limit 0,1";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$trn_sl=$R1['sl'];
}

$query21 = "INSERT INTO ".$DBprefix."stock(pcd,bcd,dt,stout,nrtn,eby,dtm,stat,refno,tout,ret,rate,stk_rate,unit,usl,betno,uval,trn_sl) VALUES ('$prsl','$fbcd','$dt','$stock_in','Transfer','$user_currently_loged','$edtm','0','$refno','$blno','$ret','$rate','$stk_rate','$unit','$usl','$betno','$uval','$trn_sl')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

}



$query2 = "DELETE FROM ".$DBprefix."trntemp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));



 $query1 = "SELECT  sum(qty) as qttl FROM ".$DBprefix."trndtl where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$qttl=$R1['qttl'];
}


?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
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
 Products Trandsferred
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="trnsfer.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_trn.php?blno=<?=rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Transfer No. : <?=$blno;?></b></font>
</td>

</tr>


</table>


 </form>      
    </center> 
</body>
</div>
</html>
<?
}
else
{
    ?>
<Script language="JavaScript">
alert('<? echo $err;?>');
document.location="trnsfer.php";
</script>
<?
}
?>
