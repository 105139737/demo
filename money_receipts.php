<?
$reqlevel=3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$new_ammount_in_word = new Numbers_Words();
$sl=$_REQUEST[sl];
	
	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Money Reciepts<? echo $nm; ?></title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 803px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: center;
   align:center;
   
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
   color: #000000;
   align:center;

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
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text2 div
{
   text-align: left;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text3 div
{
   text-align: left;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text4 div
{
   text-align: left;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text5 div
{
   text-align: left;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text6 div
{
   text-align: left;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text7 div
{
   text-align: left;
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
#Editbox1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
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
#Image1
{
   border: 0px #000000 solid;
}
#Line1
{
   color: #000000;
   background-color: #000000;
   border-colspan="2"
}
#Line2
{
   color: #000000;
   background-color: #000000;
   border-width: 0px;
}
#Line3
{
   color: #000000;
   background-color: #000000;
   border-width: 0px;
}
#Line4
{
   color: #000000;
   background-color: #000000;
   border-width: 0px;
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
#Editbox3
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
div {
	position: absolute;
    top: 240px;
    right: 110px;
width: 600px;
	 
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
<?

$datatt= mysqli_query($conn,"SELECT * FROM main_drcr where sl='$sl'")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
while ($row = mysqli_fetch_array($datatt))
		{
		$sl1= $row['sl'];
		$dt= $row['dt'];
		$dt=date('d-M-Y', strtotime($dt));
		$dt1= $row['dt'];
		$pno= $row['pno'];
		$vno= $row['vno'];
		$cldgr= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$mtd= $row['mtd'];
		$mtddtl= $row['mtddtl'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$eby= $row['eby'];
		$edt= $row['edt'];
		$cid= $row['cid'];
		$brncd= $row['brncd'];
	
	
	$nw = new Numbers_Words();
$ammtow=$nw->toWords($amm);
		
							
								
								$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$mtd'");
								while ($row3 = mysqli_fetch_array($data3))
								{
									$mtd1= $row3['mtd'];
								}
								$data21= mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'");
								while ($row21 = mysqli_fetch_array($data21))
								{
									$pno= $row21['nm'];
								}
								if($pno=='0')
								{$pno='NA';
								}
								$query6="select * from  main_suppl where sl='$cid'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$spn=$row['spn'];
								$mob1=$row['mob1'];
								$addr=$row['addr'];
								}
		
		}


date_default_timezone_set('Asia/Kolkata');
$fdt3=date('y',strtotime($dt1));	
$m=date('m',strtotime($dt1));	


if($m>=4)
{
$fdtss=$fdt3.'-'.($fdt3+1);	
}
elseif($m<=3)
{
$fdtss=($fdt3-1).'-'.$fdt3;
}

		

?>

</head>
<script type="text/javascript">
function blprnt()
{
    if(confirm('Are You Sure To Print??'))
	{
    
    window.print();
   }
   
}
</script>
</head>
<body onload="blprnt()">

<div class="bg" >
	<img src="dkm_back.png"  height="70" width="650" >
	</div>	
<br>
<br>
<br>
<br>
<br>
<br>
<table align='center' border="0" width="770px">
<tr>
<td  align="center" colspan="2">
<font size="5"><b><?=$mtd1;?> Receipt</b></font>
</td>
</tr>
<tr height="45px;">
<td  align="left">
Receipt No : <?=$vno.'/'.$fdtss  ?>
</td>
<td  align="right">
Date : <?=$dt ?>
</td>
</tr>
</table>


<table align='center' border="0" width="780px">
<tr height="40px;">
<td  align="left" width="25%">
Name :
</td><td  align="left" colspan="2">
<?=$spn;?>
</td>
</tr>
<tr height="30px;">
<td  align="left">
Address :
</td><td  align="left" colspan="2">
<?=$addr;?>
</td>
</tr>
<tr height="30px;">
<td  align="left">
Mobile No. :
</td><td  align="left" colspan="2">
<?=$mob1;?>
</td>
</tr>
<tr height="30px;">
<td  align="left" >
Amount :
</td><td  align="left" colspan="2">
<b><?=$amm;?>/-</b>

 ( <? echo $ammtow." only"; ?> )
</td>
</tr>
<tr height="30px;">
<td  align="left">
Naration :
</td><td  align="left" colspan="2">
<?=$nrtn;?>
</td>
</tr>
<tr height="30px;">
<td  align="left">

</td><td  align="left" width="35%">

</td><td  align="center" width="40%"><br>
______________________________<br>Authorized Signature
</td>
</tr>


</table>




</body>
</html>