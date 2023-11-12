<?php
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
ini_set("memory_limit","780M");
set_time_limit(0);
$edt = date('d/m/Y h:i:s a', time());
ob_start();
$tiamm=0;
$teamm=0;
$a=$_REQUEST[sl];
$tdt=$_REQUEST[tdt];
$fdt=$_REQUEST[fdt];
if($fdt=="")
{
    if(date('m')>3){
        $fdt=date('Y')."-04-01";
    }
    else
    {
        $fdt=(date('Y')-1)."-04-01";
    }
    
}
if($tdt=="")
{
    $tdt=date('Y-m-d');
}
$i=0;

	 $gbt=mysqli_query($conn,"select * from main_cust where sl='$a'");
while($GB=mysqli_fetch_array($gbt))
{

	
$bto=$GB['nm'];
$baddr=$GB['addr'];
$bmob=$GB['cont'];

$i=1;
}


$cstp="Whole Saler";
if($fdt==""){
    $fdt='2013-08-01';
}

if($tdt==""){
    $tdt=date('Y-m-d');
    
}
$query11="select sum(amm) as pcrdt from ".$DBprefix."drcr where cldgr='4' and cid='$a' and dt < '$fdt' ";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pcrdt=$R11['pcrdt'];
}
$query11="select sum(amm) as pdbdt from ".$DBprefix."drcr where dldgr='4' and cid='$a' and dt < '$fdt' ";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pdbdt=$R11['pdbdt'];
}
$opbl=$opbl-$pcrdt+$pdbdt;
$pageno=1;
if($i==1)
{


$file="Customer Statement $bto-$bmob $edt";
		$content = ob_get_clean();
    // convert in PDF
		require_once('html2pdf/html2pdf.class.php');
		try
		{
         $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML(
		'
<style type="text/css">
div#container
{
   width: 698px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
   
   color: #000000;
}
  input.sc {
	width: 100%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 2px solid #d8d8d8;
	
	padding-right: 0px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding: 3px;
}

input.sc1 {
	width: 100%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #a7a7ab;
	
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 4px;
	padding: 4px;
}
</style>
<style type="text/css">
a
{
   color: #000000;
   text-decoration: none;
   cursor: pointer;
}
a:visited
{
   color: #000;
}
a:active
{
   color: #000;
}
a:hover
{
   color: #000;
   text-decoration: underline;
}
@media print
{
    #rem
    {
        display: none !important;
    }
}
</style>
<style type="text/css">

#con
{
   background-color: transparent;
}
</style>
<div id="prnt" style="position:absolute;left:10px;top:2px;width:320px;height:88px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><a onclick="prnt()">Print</a></span>
</div>


  <table border="0" width="677px">
  <tr>
  <td  align="center" style="font-family: Arial, Helvetica, sans-serif;"><font size="5"> <b><u>Customer Statement</u></b></font></td>
  </tr>
  </table>
<table   style="border-collapse:collapse;"  cellpadding="0" cellspacing="0" width="800px">
  <tr style="border-bottom: 1px solid #000;" >
  <td valign="top" width="70%"    style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
  <font size="5" >
  <b>
P.R.C ENTERPRISE  </b>
  </font>
  <br/>
  <font size="2" >
Chakdah  <br/>
  Mobile : 9733200217  </font>
  </td>
  <td width="50%" valign="top" align="right" style="height:30px;font-family: Arial, Helvetica, sans-serif;" >
 
<font size="2" >
Page No. 1<br/> <br/>

</font> </td>
  </tr>
<tr style="border-bottom: 1px solid #000;">
  <td align="center" colspan="2" style="font-family: Arial, Helvetica, sans-serif;" ><b>Statement for the period (From : 01-04-2017&nbsp; To : 15-11-2017)</b>
  </td>

  </tr>
  <tr style="border-bottom: 1px solid #000;height:90px" >
  <td align="left" valign="top" colspan="2"><font size="2" >TO :
 <b>  SREE GOPAL ELECTRIC </b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;76 PANDIT KALIMOY GHATAK LANE, P.O - RANAGHAT, NADIA<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mob : 9733618967  
  </font></td>

  </tr>
  </table>
  <table  style="border-collapse:collapse;" width="800px"  cellpadding="0" cellspacing="0">
  <tr  style="height:530px" valign="top" >
  <td>
  <table width="100%" border="0" style="border-collapse:collapse;">
  <tr style="border-bottom: 1px solid #000;">
  <td align="center" ><font size="2" >Date</font></td>
  <td align="left" ><font size="2" >Ref</font></td>
  <td align="left" ><font size="2" >Perticulars</font></td>
  <td align="right"><font size="2" >Debit</font></td>
  <td align="right" ><font size="2" >Credit</font></td>
  <td align="right" ><font size="2" >Balance</font></td>
  </tr>
    <tr >
  <td align="center" colspan="5" ><font size="2" >Opening Balance</font></td>

  <td align="right" ><font size="2" >0</font></td>
  </tr>
  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-08-28</font></td>
		  <td align="left" ><font size="2" >H/17-18/00007</font></td>
		  <td align="left" ><font size="2" >Sale</font></td>
		  <td align="right" ><font size="2" >11926.95</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="76" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">11926.95 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-08-28</font></td>
		  <td align="left" ><font size="2" >H/17-18/00007</font></td>
		  <td align="left" ><font size="2" >C-GST</font></td>
		  <td align="right" ><font size="2" >715.63</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="77" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">12642.58 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-08-28</font></td>
		  <td align="left" ><font size="2" >H/17-18/00007</font></td>
		  <td align="left" ><font size="2" >S-GST</font></td>
		  <td align="right" ><font size="2" >715.63</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="78" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">13358.21 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-08-28</font></td>
		  <td align="left" ><font size="2" ></font></td>
		  <td align="left" ><font size="2" >Round Off</font></td>
		  <td align="right" ><font size="2" >0</font></td>
		  <td align="right"><font size="2" >0.21</font></td>
		  <td align="right" title="79" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">13358 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00008</font></td>
		  <td align="left" ><font size="2" >Sale</font></td>
		  <td align="right" ><font size="2" >4522.4</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="82" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">17880.4 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00008</font></td>
		  <td align="left" ><font size="2" >C-GST</font></td>
		  <td align="right" ><font size="2" >271.34</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="83" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">18151.74 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00008</font></td>
		  <td align="left" ><font size="2" >S-GST</font></td>
		  <td align="right" ><font size="2" >271.34</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="84" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">18423.08 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" ></font></td>
		  <td align="left" ><font size="2" >Round Off</font></td>
		  <td align="right" ><font size="2" >0</font></td>
		  <td align="right"><font size="2" >0.08</font></td>
		  <td align="right" title="85" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">18423 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00009</font></td>
		  <td align="left" ><font size="2" >Sale</font></td>
		  <td align="right" ><font size="2" >1535.7</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="86" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">19958.7 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00009</font></td>
		  <td align="left" ><font size="2" >C-GST</font></td>
		  <td align="right" ><font size="2" >92.14</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="87" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">20050.84 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00009</font></td>
		  <td align="left" ><font size="2" >S-GST</font></td>
		  <td align="right" ><font size="2" >92.14</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="88" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">20142.98 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-05</font></td>
		  <td align="left" ><font size="2" >H/17-18/00009</font></td>
		  <td align="left" ><font size="2" >Round Off</font></td>
		  <td align="right" ><font size="2" >0.02</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="89" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">20143 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-16</font></td>
		  <td align="left" ><font size="2" >H/17-18/00053</font></td>
		  <td align="left" ><font size="2" >Sale</font></td>
		  <td align="right" ><font size="2" >32509.68</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="290" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">52652.68 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-16</font></td>
		  <td align="left" ><font size="2" >H/17-18/00053</font></td>
		  <td align="left" ><font size="2" >C-GST</font></td>
		  <td align="right" ><font size="2" >4551.35</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="291" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">57204.03 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-16</font></td>
		  <td align="left" ><font size="2" >H/17-18/00053</font></td>
		  <td align="left" ><font size="2" >S-GST</font></td>
		  <td align="right" ><font size="2" >4551.35</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="292" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">61755.38 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-16</font></td>
		  <td align="left" ><font size="2" ></font></td>
		  <td align="left" ><font size="2" >Round Off</font></td>
		  <td align="right" ><font size="2" >0</font></td>
		  <td align="right"><font size="2" >0.38</font></td>
		  <td align="right" title="293" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">61755 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-18</font></td>
		  <td align="left" ><font size="2" ></font></td>
		  <td align="left" ><font size="2" >CASH PAYMENT FOR POLYCAB CHEQUE NO 20767 IDBI BANK</font></td>
		  <td align="right" ><font size="2" >0</font></td>
		  <td align="right"><font size="2" >13358</font></td>
		  <td align="right" title="372" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">48397 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-21</font></td>
		  <td align="left" ><font size="2" ></font></td>
		  <td align="left" ><font size="2" > PAYMENT FOR WIRE through cheque no 20769 idbi bank</font></td>
		  <td align="right" ><font size="2" >0</font></td>
		  <td align="right"><font size="2" >41612</font></td>
		  <td align="right" title="422" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">6785 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-22</font></td>
		  <td align="left" ><font size="2" >H/17-18/00080</font></td>
		  <td align="left" ><font size="2" >Sale</font></td>
		  <td align="right" ><font size="2" >3928.5</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="418" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">10713.5 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-22</font></td>
		  <td align="left" ><font size="2" >H/17-18/00080</font></td>
		  <td align="left" ><font size="2" >C-GST</font></td>
		  <td align="right" ><font size="2" >235.71</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="419" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">10949.21 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-09-22</font></td>
		  <td align="left" ><font size="2" >H/17-18/00080</font></td>
		  <td align="left" ><font size="2" >S-GST</font></td>
		  <td align="right" ><font size="2" >235.71</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="420" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">11184.92 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-09-22</font></td>
		  <td align="left" ><font size="2" >H/17-18/00080</font></td>
		  <td align="left" ><font size="2" >Round Off</font></td>
		  <td align="right" ><font size="2" >0.08</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="421" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">11185 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-10-03</font></td>
		  <td align="left" ><font size="2" >H/17-18/00128</font></td>
		  <td align="left" ><font size="2" >Sale</font></td>
		  <td align="right" ><font size="2" >11785.5</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="668" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">22970.5 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-10-03</font></td>
		  <td align="left" ><font size="2" >H/17-18/00128</font></td>
		  <td align="left" ><font size="2" >C-GST</font></td>
		  <td align="right" ><font size="2" >707.13</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="669" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">23677.63 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="#ededed">
		  <td align="center" ><font size="2" >2017-10-03</font></td>
		  <td align="left" ><font size="2" >H/17-18/00128</font></td>
		  <td align="left" ><font size="2" >S-GST</font></td>
		  <td align="right" ><font size="2" >707.13</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="670" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">24384.76 Dr</span></font></td>
		 
		  </tr>
		  		  <tr bgcolor="">
		  <td align="center" ><font size="2" >2017-10-03</font></td>
		  <td align="left" ><font size="2" >H/17-18/00128</font></td>
		  <td align="left" ><font size="2" >Round Off</font></td>
		  <td align="right" ><font size="2" >0.24</font></td>
		  <td align="right"><font size="2" >0</font></td>
		  <td align="right" title="671" ><font size="2" ><span style="color:#FF0000;font-family:Arial;font-size:15px;">24385 Dr</span></font></td>
		 
		  </tr>
		  		  <tr style="border-top: 1px solid #000;">
		  <td colspan="3" align="right">
		  <b>Total </b>
		  </td>
		  <td align="right">
		  <font size="2" ><b>79355.67</b></font>
		  </td>
		  <td align="right">
		 <font size="2" ><b> 54970.67</b></font>
		  </td>
		   <td>
		  </td>
		  </tr>
		    <tr style="border-top: 1px solid #000;">
		  <td colspan="3" align="right">
		 
		  </td>
		  <td>
		  </td>
		   <td>
		  </td>
		   <td>
		  </td>
		  </tr>
		  
		  </table>
		  </td>
		  </tr>
		  </table>
'
		);
        $html2pdf->Output('exemple00.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
}
?>