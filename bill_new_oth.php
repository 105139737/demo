<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=rawurldecode($_REQUEST['blno'] ?? "");
?>
<html>
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
div {
	position: absolute;
    top: 520px;
    right: 20px;
	 
 opacity: 0.2;
z-index:20;
    /* Rotate div */
 -webkit-transform: rotate(-40deg);
    -moz-transform: rotate(-40deg);
    -o-transform: rotate(-40deg);
    -ms-transform: rotate(-40deg);
    transform: rotate(-30deg)
	
	
}

</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="advancedtable_bill.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function blprnt(){
    if(confirm('Are You Sure?')){
    
    window.print();
   }
   
}
</script>
</head>
<body onload="blprnt()" style="width:300px;align:center" >
          
	  <center>						
							
<form method="post" action="centrys.php" name="form1"  id="form1">
<?php     
$csl=1;
$sln=0;
 $query111 = "SELECT * FROM ".$DBprefix."billing_oth where blno='$blno'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$dt5=$R111['dt'];
$cid=$R111['cid'];
$tpoint=$R111['tpoint'];

$dt=date("d-m-Y", strtotime($dt5));	
}


 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM ".$DBprefix."bildtls_oth where bilno='$blno' and qty>0";
 	$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}

	$query = "SELECT * from ".$DBprefix."cust where sl='$cid'";
	$result = mysqli_query($conn,$query);
          while($row = mysqli_fetch_array($result))
		 {
                $cusl=$row['sl'];
                $cnm=$row['nm'];
                $caddr=$row['addr'];
                $cnt=$row['cont'];
                $email=$row['mail'];
                }
?>

	


	
<table border="0" width="100%">
<tr>
<td  align="center">
<font size="5"><b>BALARAM & SONS</b></font>
<br>
<font size="4"><b>Proprietor Name : SUJOY SEN</b> </font>

<br>
<font size="3"><b>Mobile No. : 7384048641</b></font>
<br>
<font size="4"><b>Post Office More, Krishnagar, Nadia</b></font>

</td>
</tr>
<tr>
<td  align="center" style="font-family: Arial, Helvetica, sans-serif;">
<font size="4" color="#114f2a"> <b>TAX INVOICE</b></font>
</td>
</tr>

</table>

<table border="0" width="100%">
<tr>
<td colspan="2">
<hr>
</td>
</tr>
<tr>
<td  align="left"  >
<font size="2"><b>Bill No :</b></font>
</td>
<td>
<font size="2"><b><?php  echo $blno;?></b></font>
</td>
</tr>
<tr>
<td  align="left" style="font-family: Arial, Helvetica, sans-serif;">
<font size="2"><b>Date :</b></font>
</td>
<td>
<font size="2"><b><?php  echo $dt;?></b></font>
</td>
</tr>
<tr>
<td  align="left" style="font-family: Arial, Helvetica, sans-serif;">
<font size="2"><b>Name :</b></font>
</td>
<td>
<font size="2"><b><?php  echo $cnm;?></b></font>
</td>
</tr>
<tr>
<td  align="left" style="font-family: Arial, Helvetica, sans-serif;">
<font size="2"><b>Serial No. :</b></font>
</td>
<td>
<font size="2"><b><?php  echo $cusl;?> </b></font>
</td>
</tr>
<tr>
<td  align="left" style="font-family: Arial, Helvetica, sans-serif;">
<font size="2"><b>Contact :</b></font>
</td>
<td>
<font size="2"><b><?php  echo $cnt;?></b></font>
</td>
</tr>

<tr>
<td colspan="2">
<hr>
</td>
</tr>
</table>





<table border="0" width="100%">


<tr>
<td  align="left"  >
<b>Total Amount :
</b>
</td>
<td  align="right" style="font-family: Arial, Helvetica, sans-serif;" >
<font size="3"><b><?php echo number_format($gttl,2);?></b></font>
</td>
</tr>

<?php 

$sln=0;
$ppoint=0;
	$result5 = mysqli_query($conn,"SELECT sum(point)as tpp,sl as ssll from main_cust_point where cid='$cid' and stat='0' and refno='$blno'");
	while($row5 = mysqli_fetch_array($result5))
	{
	$ppoint=$row5['tpp'];/* Currrent poient*/	
	$ssll=$row5['ssll'];/* Currrent poient*/	
	if($ppoint=="")
	{
		$ppoint=0;
	}
	}
$cpoint=0;
	$result55 = mysqli_query($conn,"SELECT sum(point)as tpp from main_cust_point where cid='$cid' and stat='0' and sl<'$ssll'");
	while($row55 = mysqli_fetch_array($result55))
	{
	$cpoint=$row55['tpp'];/* Prev poient*/	
	if($cpoint=="")
	{
		$cpoint=0;
	}
	}?>







<tr>
<td colspan="2">
<hr>
</td>
</tr>

</table>
<table border="0" width="100%">
<tr>
<td >Previou point :</td><td align="right"> <?php  echo $cpoint;?></td ></tr><tr>
<td >Current point :</td><td align="right"> <?php  echo $ppoint;?></td ></tr><tr>
<tr><td colspan="2"><hr></td></tr>
<td ><b>Total point :</b></td><td align="right"> <b><?php  echo $cpoint+$ppoint;?></b></td ></tr>
<tr><td colspan="2"><hr></td></tr>
</table>




 </form>      
    </center> 
    </body>
</html>