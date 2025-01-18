<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');

$fbcd=$_REQUEST[fbcd];
$tbcd=$_REQUEST[tbcd];

$err="";

if($fbcd=='' or $tbcd=='')
{
	$err="Please Fill All Fields....";
}


$dt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
 $query1 = "SELECT sum(qty) as gttl FROM ".$DBprefix."gordrtmp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];

}

if($gttl==0){
    $err="Please Add Some Product First";
}



$m=date('m');
$y=date('y');
if($m>=4)
{
$yy="OG/".$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy="OG/".($y-1)."-".$y."/";	
}


if($err=="")
{


	
	
    $vid=0;
$count5=1;

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 8, '0', STR_PAD_LEFT);

$blno=$yy.$vno;
$query6="select * from ".$DBprefix."gordr where blno='$blno'";
$result5 = mysqli_query($conn,$query6);
$count5=mysqli_num_rows($result5);

}
$query211 = "INSERT INTO  main_gordr (blno,fbcd,tbcd,edt,dt,eby,edtm) VALUES ('$blno','$fbcd','$tbcd','$dt','$dt','$user_currently_loged','$edtm')";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 


$log="";
 $query100 = "SELECT * FROM ".$DBprefix."gordrtmp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$rmk=$R100['rmk'];
$fbcd=$R100['fbcd'];
$query21 = "INSERT INTO ".$DBprefix."gordrdtl (fbcd,prsl,prnm,qty,blno,rmk) VALUES ('$fbcd','$prsl','$prnm','$qnty','$blno','$rmk')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
        



}



$query2 = "DELETE FROM ".$DBprefix."gordrtmp WHERE eby='$user_currently_loged'";
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
<font size="5"> <b><a href="gorder.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_trn.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Transfer No. : <?php  echo $blno;?></b></font>
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
document.location="gorder.php";
</script>
<?php 
}
?>
