<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";

$cno=$_POST['cno'];
$cdet=$_POST['cdet'];
$dnm=$_POST['dnm'];
$addr=$_POST['addr'];
$mob1=$_POST['mob1'];
$mob2=$_POST['mob2'];
$lno=$_POST['lno'];
$ltyp=$_POST['ltyp'];
$dt=$_POST['dt'];

                                                                                                                                              
$d=date('Y-m-d', strtotime($dt));



$err="";
if($cno=="" and $dnm=="")
{
	$err="Please Enter Car No. and Driver Name ?";
}



$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
 $query1 = "SELECT sum(ttl) as gttl FROM main_ctemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
}

if($gttl==0){
    $err="Please Add Some Product First";
}

date_default_timezone_set('Asia/Kolkata');

$m=date('m');
$y=date('y');
if($m>=4)
{
$yy="RC-".$branch_als."/".$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy="RC-".$branch_als."/".($y-1)."-".$y."/";	
}


if($err=="")
{

$queryx="select * from  main_dirver where cno='$cno' and dnm='$dnm'";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx>0){
   while($cr=mysqli_fetch_array($resultx))
   {
	   $sid=$cr['sl'];
   }
   
}
else
{

$query6 = "INSERT INTO main_dirver (cno,cdet,dnm,addr,mob1,mob2,lno,ltyp,edtm,eby) VALUES ('$cno','$cdet','$dnm','$addr','$mob1','$mob2','$lno','$ltyp','$dttm','$user_currently_loged')";
$result6 = mysqli_query($conn,$query6) or die(mysqli_error($conn));

}

	
	
$vid=0;
$count5=1;

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 6, '0', STR_PAD_LEFT);

$blno=$yy.$vno;
$query6="select * from main_chnl where blno='$blno'";
$result5 = mysqli_query($conn,$query6);
$count5=mysqli_num_rows($result5);
}
   

$vat1="";
$amm="";
 $query1 = "SELECT sum(ttl) as gttl FROM main_ctemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}


$query211 = "INSERT INTO main_chnl (blno,cid,cnm,caddr,cnt,amm,paid,due,crdtp,bnm,ortp,edt,eby,pdts,cbnm,vat,car,dis,fid,bcd) VALUES ('$blno','$sid','$dnm','$addr','$mob1','$gttl','$paid','$due','$h','$g','$f','$d','$user_currently_loged','$dttm','$cbnm','$vat','$car','$dis','$fid','$branch_code')";
$result211 = mysqli_query($conn,$query211); 


$log="";
 $query100 = "SELECT * FROM main_ctemp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$rmk=$R100['rmk'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];
$usl=$R100['usl'];
$ret=$prc;



$log="";

$unit=mysqli_query($conn,"select * from main_unit where sl='$usl'");
while($pr=mysqli_fetch_array($unit))
{
$punt=$pr['pkgunt'];
$upkg=$pr['untpkg'];
$ptu1=$pr['tunt'];	
}


if($punt==$unt)
{
	
$ret1=$ret/$ptu1;
$log=0;
}
else
{
$ret1=$ret;
$log=1;
}
$query21 = "INSERT INTO main_chnldtl (bsl,prsl,prnm,qty,prc,ttl,blno,rmk,unt,betno,expdt) VALUES ('$bsl','$prsl','$prnm','$qnty','$prc','$ttl','$blno','$rmk','$unt','$betno','$expdt')";
$result21 = mysqli_query($conn,$query21); 





}


$query2 = "DELETE FROM main_ctemp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2);



 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM main_chnldtl where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
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
<img src="drdc.png">
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="billing.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_challan.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Bill No. : <?php  echo $blno;?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Total Amount : <?php echo number_format($gttl,2);?></b></font>
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
else
{
    ?>
<Script language="JavaScript">
alert('<?php  echo $err;?>');
document.location="challan.php";
</script>
<?php 
}
?>
