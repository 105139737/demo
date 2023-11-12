<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
/*
$a=$_REQUEST[custid];
$b=$_REQUEST[custnm];
$c=$_REQUEST[mob];
$d=$_REQUEST[ddt];
$e=$_REQUEST[deltm];
$f=$_REQUEST[Combobox1];
$g=$_REQUEST[bnm];
$h=$_REQUEST[Combobox2];
$caddr=$_REQUEST[addr];
$bsl=$_REQUEST[sl];
$cbnm=$_REQUEST[cbnm];
$sprs=$_REQUEST[sprs];
$pamm=$_REQUEST[pamm];

if($h=='Cash')
{
if($pamm==0)
{
$cldgr=3;
}
else
{
$cldgr=1;
}
}  
else
{
$cldgr=$g;
}                                                                                                                                                 

if($caddr=="")
{
    $caddr="N/A";
}
$err="";


/*
if($sprs==""){
    $err="Please Select Sales Person";
}


$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."slt where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
}
if($gttl==0){
    $err="Please Add Some Product First";
}
$query311 = "SELECT * FROM ".$DBprefix."cust where cid='$a' and mob1='$c'";
								$result311 = mysqli_query($conn,$query311);
                                $rc=mysqli_num_rows($result311);
if($rc==0){
    $vid=0;
$count5=5;

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 8, '0', STR_PAD_LEFT);

$blno=$branch_als.$vno;
$query5="select * from ".$DBprefix."billing where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count5=mysqli_num_rows($result5);

}
    $logo="blogo.gif";
    $pnm="Nani Gopal Das";
    $tlno="311/S";
    $wbst="www.shareekuthi.com";
    $tdsp="Total";
        $a="10001";
   $paid=$gttl;
   $due=0;
   $coll=$gttl; 

}
else
{
    $vid=0;
$count5=5;

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 7, '0', STR_PAD_LEFT);

$blno="N".$branch_als.$vno;
$query5="select * from ".$DBprefix."billing where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count5=mysqli_num_rows($result5);

}
    $logo="nblogo.gif";
    $pnm="";
    $tlno="37/S";
    $wbst="";
    $tdsp="Total Due";
   $query31 = "SELECT * FROM ".$DBprefix."cust where cid='$a'";
								$result31 = mysqli_query($conn,$query31);
								while ($R1 = mysqli_fetch_array ($result31))
								{
								$dbl=$R1['dbl'];
                                $b1=$R1['spn'];
								}
if($gttl>$dbl){
    $paid=$dbl;
    $due=$gttl-$paid;
    $nbal=$dbl-$gttl;
    $query211 = "UPDATE ".$DBprefix."cust set dbl='$nbal',lsld='$dt' where cid='$a'";
	$result211 = mysqli_query($conn,$query211);
    
}
else
{

    $paid=$gttl;
    $due=$gttl-$paid;
    $nbal=$dbl-$paid;
    $query211 = "UPDATE ".$DBprefix."cust set dbl='$nbal',lsld='$dt' where cid='$a'";
	$result211 = mysqli_query($conn,$query211);
} 

  $vid1=0;
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vno=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vcno="SV".$vno;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

}

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,bill,dt,nrtn,dldgr,mtd,mtddtl,idt,cldgr,amm,eby,edt,pnm,paddr,cont,brncd) VALUES ('$vcno','$blno','$dt','$nrtn','5','$pmtd','$ref','$idt','$cldgr','$gttl1','$user_currently_loged','$dt','$b','$caddr','$c','$branch_code')";
$result21 = mysqli_query($conn,$query21);

}



if($err==""){





$query211 = "INSERT INTO ".$DBprefix."billing (blno,cid,cnm,caddr,cnt,amm,paid,due,crdtp,bnm,ortp,edt,eby,pdts,cbnm) VALUES ('$blno','$a','$b','$caddr','$c','$gttl','$paid','$due','$h','$g','$f','$dt','$user_currently_loged','$dttm','$cbnm')";
$result211 = mysqli_query($conn,$query211); 
 $query111 = "SELECT * FROM ".$DBprefix."billing where cid='$a' and pdts='$dttm' and eby='$user_currently_loged'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$blno=$R111['blno'];
}


 $query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$rmk=$R100['rmk'];
$query21 = "INSERT INTO ".$DBprefix."billdtls (bsl,prsl,prnm,qty,prc,ttl,blno,rmk) VALUES ('$bsl','$prsl','$prnm','$qnty','$prc','$ttl','$blno','$rmk')";
$result21 = mysqli_query($conn,$query21); 
$pstk=0;
        $query = "SELECT * FROM ".$DBprefix."product where sl='$prsl'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pkgunt=$R['pkgunt'];
}
$bsl+=1;
$queryw = "SELECT * FROM ".$DBprefix."unit where sl='$pkgunt'";
   $resultw = mysqli_query($conn,$queryw);
while ($Rw = mysqli_fetch_array ($resultw))
{
$tunt=$Rw['tunt'];
}

$queryw1 = "SELECT * FROM ".$DBprefix."stock where pcd='$prsl'";
   $resultw1 = mysqli_query($conn,$queryw1);
while ($Rw1 = mysqli_fetch_array ($resultw1))
{
$stin=$Rw1['stin'];
$opst=$Rw1['opst'];
}
$stout=$qnty*$tunt;
$clst=(($stin+$opst)-$stout);

$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,stout,nrtn,eby,dtm) VALUES ('$prsl','$branch_code','$dt','$stout','Sale','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21); 

}



$query5 = "update ".$DBprefix."billing set slpr = '$sprsf' where blno='$blno'";
$result5 = mysqli_query($conn,$query5);


$query2 = "DELETE FROM ".$DBprefix."slt WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2);

if($c==""){
    $b=$b;
}
else
{
    $b=$b." (".$c.")";
}
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Page</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
width: auto;
	left:auto;
	position: relative;
	align:center;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
   background-image: url(images/bg.png);
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style type="text/css">
#Layer1
{
   background-color: #FFFFFF;
   border: 1px #000000 solid;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text1 div
{
   text-align: center;
}
#Image1
{
   border: 0px #000000 solid;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text2 div
{
   text-align: center;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text3 div
{
   text-align: center;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text4 div
{
   text-align: center;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text5 div
{
   text-align: center;
}
#Line1
{
   color: #000000;
   background-color: #000000;
   border-width: 0px;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text7 div
{
   text-align: right;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text6 div
{
   text-align: center;
}
#Line2
{
   color: #000000;
   background-color: #000000;
   border-width: 0px;
}
#wb_Textbl 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text8 div
{
   text-align: left;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text9 div
{
   text-align: left;
}
#wb_Text10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text10 div
{
   text-align: left;
}
#Table1
{
   border: 1px #000000 solid;
   background-color: transparent;
   border-spacing: 1px;
}
#Table1 td
{
   padding: 0px 0px 0px 0px;
}
#Table1 td div
{
   white-space: nowrap;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text11 div
{
   text-align: left;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text12 div
{
   text-align: left;
}
#wb_Text13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text13 div
{
   text-align: left;
}
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text14 div
{
   text-align: right;
}
#wb_Text15 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text15 div
{
   text-align: center;
}
#wb_Text16 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text16 div
{
   text-align: left;
}
#Image2
{
   border: 0px #000000 solid;
}

#hms {
	margin: 0px;
	padding: 0px;
	float: center;
	height: 80px;
	width: auto;
	left:auto;
	position: relative;
	
	background-repeat: repeat;
}
</style>
<script type="text/javascript">
function blprnt(blno,bltp){
    if(confirm('Are You Sure?')){
        $('#wb_Textbl').load('prntbills.php?bltp='+bltp+'&blno='+blno).fadeIn('fast'); 
        window.print();
    }
   
}
</script>

</head>
<body >
<div id="hms"><center><img src="drdc.png" alt="hms" />

 </center>
</div>

<div id="container">

<div id="wb_Text1" style="position:absolute;left:10px;top:25px;width:330px;height:19px;text-align:center;z-index:2;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><strong><u>Cash/Credit Memo</u></strong></span></div>

<table border="1"  style="position:absolute;top:50px;" width="80%">
<tr>
<td>
Customer Name & Address
</td>
<td>
Invoice No. :
</td>
</tr>
</table>

<div id="wb_Text2" style="position:absolute;left:10px;top:75px;width:330px;height:17px;text-align:center;z-index:4;">
<span style="color:#000000;font-family:Arial;font-size:15px;"><strong><em>Prop: <? echo $pnm;?></em></strong></span></div>
<div id="wb_Text3" style="position:absolute;left:10px;top:95px;width:330px;height:16px;text-align:center;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $branch_address;?></span></div>
<div id="wb_Text4" style="position:absolute;left:10px;top:127px;width:330px;height:16px;text-align:center;z-index:6;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $branch_phone;?></span></div>
<div id="wb_Text5" style="position:absolute;left:10px;top:126px;width:330px;height:16px;text-align:center;z-index:7;">
<span style="color:#000000;font-family:Arial;font-size:14px;"><? echo $wbst;?></span></div>
<hr id="Line1" style="margin:0;padding:0;position:absolute;left:10px;top:145px;width:330px;height:2px;z-index:8;">
<div id="wb_Text6" style="position:absolute;left:10px;top:147px;width:330px;height:16px;text-align:center;z-index:10;">
<span style="color:#000000;font-family:Arial;font-size:13px;">TANGAIL SHAREE MANUFACTURER &amp; SELLER</span></div>
<hr id="Line2" style="margin:0;padding:0;position:absolute;left:10px;top:162px;width:330px;height:2px;z-index:11;">

<div id="Layer1" style="position:absolute;text-align:left;left:10px;top:170px;width:330px;height:20px;z-index:1;" title="">
<div id="wb_Text8" style="position:absolute;left:6px;top:2px;width:141px;height:16px;z-index:0;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">T.L. No. <? echo $tlno;?></span></div>
<div id="wb_Textbl" style="position:absolute;left:0px;top:2px;width:330px;height:16px;z-index:0;text-align:center;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong></strong></span></div>
<div id="wb_Text7" style="position:absolute;left:197px;top:2px;width:125px;height:16px;text-align:right;z-index:9;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Date : <? echo date('d-m-Y', strtotime($dt));?></span></div>
</div>

<div id="wb_Text9" style="position:absolute;left:10px;top:194px;width:330px;height:15px;z-index:12;text-align:left;">
<span style="color:#000000;font-family:'Times New Roman';font-size:13px;"><em>Name: <? echo $b;?></em></span></div>
<div id="wb_Text10" style="position:absolute;left:10px;top:210px;width:330px;height:15px;z-index:13;text-align:left;">
<span style="color:#000000;font-family:'Times New Roman';font-size:13px;"><em>Address: <? echo $caddr;?></em></span></div>

<table style="position:absolute;left:10px;top:250px;width:331px;height:458px;z-index:14;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:middle;width:32px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> SL.</span></div>
</td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:middle;width:158px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Description</span></div>
</td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:middle;width:42px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Qnty</span></div>
</td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:middle;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Amount</span></div>
</td>
</tr>

<?
$csl=1;
 $query100 = "SELECT * FROM ".$DBprefix."billdtls where blno='$blno' order by bsl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
    $brmk="";
$csl=$R100['bsl'];     
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$ttl=$R100['ttl'];
$bprc=$R100['prc'];
$brmk=$R100['rmk'];
$ctsl=$ctsl.$csl."<br>";
$ctpr=$ctpr." ".$brmk." ".$bprc." X ...................<br>";
$cttl=$cttl.number_format($ttl,2)."<br>";
$cqnt=$cqnt.$qnty."<br>";
$csl=$csl+1;
}


if($h!="Cash"){
    $ctpr=$ctpr."<p align=\"left\">".$h."<br>";
    $ctpr.=$cbnm."</p>";
}
$ctpr.="<br>".$slprs;

 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM ".$DBprefix."billdtls where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}
$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl);

?>


<tr>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:top;width:32px;height:375px;border-bottom: 0px;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $ctsl;?></span></td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:right;vertical-align:top;width:158px;height:375px;border-bottom: 0px;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $ctpr;?></span></td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:top;width:42px;height:375px;border-bottom: 0px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> <? echo $cqnt;?></span></div>
</td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:right;vertical-align:top;height:375px;border-bottom: 0px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> <? echo $cttl;?></span></div>
</td>
</tr>



<tr>
<td colspan="2" style="background-color:transparent;border:1px #000000 solid;vertical-align:top;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:8px;text-align: left;">&nbsp;&nbsp;<? echo $sprsf;?></span><span style="color:#000000;font-family:Arial;font-size:13px;text-align: right;width: 50px;padding-left: 100px;"><strong>&nbsp;&nbsp; <? echo $tdsp;?>&nbsp; </strong></span></div>
</td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:center;vertical-align:top;height:18px;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong><? echo $qttl;?> </strong></span></td>
<td style="background-color:transparent;border:1px #000000 solid;text-align:right;vertical-align:top;height:18px;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong><? echo number_format($gttl,2);?> </strong></span></td>
</tr>





</table>


<div id="wb_Text11" style="position:absolute;left:10px;top:762px;width:330px;height:16px;z-index:15;text-align:justify;">
<span style="color:#000000;font-family:Arial;font-size:13px;">In Words: Rupees <? echo $aiw;?> Only</span></div>
<div id="wb_Text12" style="position:absolute;left:283px;top:795px;width:57px;height:16px;z-index:16;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">E &amp; O.E.</span></div>
<div id="wb_Text13" style="position:absolute;left:10px;top:825px;width:140px;height:19px;z-index:17;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Party's Signature</strong></span></div>
<div id="wb_Text14" style="position:absolute;left:200px;top:825px;width:140px;height:19px;text-align:right;z-index:18;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Signature</strong></span></div>
<div id="wb_Text15" style="position:absolute;left:10px;top:850px;width:330px;height:22px;text-align:center;z-index:19;">
<span style="background-color:#424648;color:#FFFFFF;font-family:Arial;font-size:19px;"><strong>EVERY DAY OPEN 7 A.M. TO 7 P.M.</strong></span></div>


<div id="wb_Text16" style="position:absolute;left:10px;top:4px;width:151px;height:16px;z-index:20;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Bill No.:<? echo $blno;?></span></div>

</div>
</body>
</html>

<?
/*
}
else
{
    ?>
<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
}
*/
?>
