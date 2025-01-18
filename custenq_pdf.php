<?php 
$reqlevel = 3;
include("config.php");
date_default_timezone_set('Asia/Kolkata');
ini_set("memory_limit","780M");
set_time_limit(0);
$edt = date('d/m/Y h:i:s a', time());
ob_start();
$tiamm=0;
$teamm=0;
$a=$_REQUEST['sl'];
$tdt=$_REQUEST['tdt'];
$fdt=$_REQUEST['fdt'];

$file=$a;

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
else
{
	$fdt=date('Y-m-d', strtotime($fdt));
}
if($tdt=="")
{
    $tdt=date('Y-m-d');
}
else
{
	$tdt=date('Y-m-d', strtotime($tdt));
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
	$query1="Select * from main_cnm ";		 
 $result1 = mysqli_query($conn,$query1);
while ($R = mysqli_fetch_array ($result1))
{
$comp_nm=$R['cnm'];
$comp_addr=$R['addr'];
$cont=$R['cont'];
}
	?>

	<page backtop="50mm" >
    <page_header>
	 <table style="width: 100%;">
  <tr>
  <td   style="text-align: center;    width: 100%;font-size:18pt"><font size="7"> <b><u>Customer Statement</u></b></font></td>
  </tr>
  </table>
  
	<table style="width: 100%;">
  <tr style="border-bottom: 1px solid #000;" >
  <td valign="top" style="text-align: left;    width: 90%;valign:top;border-bottom: 1px solid #000;">
  <font size="5" style="font-size:14pt">
  <b>
<?php  echo $comp_nm;?>
  </b>
  </font>
  <br/>
  <font size="2" >
<?php  echo $comp_addr;?>
  <br/>
  Mobile : <?php  echo $cont;?>
  </font>
  </td>
  <td style="text-align: right;    width: 10%;valign:top;border-bottom: 1px solid #000;" >
 
<font size="2" >
page [[page_cu]]/[[page_nb]]<br/> <br/>

</font> </td>
  </tr>
<tr style="border-bottom: 1px solid #000;">
  <td colspan="2" style="font-family: Arial, Helvetica, sans-serif;width:100%;text-align:center;border-bottom: 1px solid #000;" ><b>Statement for the period (From : <?php  echo date('d-m-Y', strtotime($fdt)); ?>&nbsp; To : <?php  echo date('d-m-Y', strtotime($tdt)); ?>)</b>
  </td>

  </tr>
  <tr style="border-bottom: 1px solid #000;height:90px" >
  <td align="left" valign="top" colspan="2"><font size="2" >TO :
 <b>  <?php  echo $bto."</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$baddr."<br/>";

if($bmob!="")
{
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mob : ".$bmob;
}
?>
  
  </font></td>

  </tr>
  </table>
   </page_header>



  <table style="width: 100%;">
  <tr >
  <td align="center" style="width: 10%;border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="2" >Date</font></td>
  <td align="left" style="width: 20%;border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="2" >Ref</font></td>
  <td align="left" style="width: 40%;border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="2" >Perticulars</font></td>
  <td align="right" style="width: 10%;border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="2" >Debit</font></td>
  <td align="right" style="width: 10%;border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="2" >Credit</font></td>
  <td align="right" style="width: 10%;border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="2" >Balance</font></td>

  </tr>
    <tr >
  <td align="center" colspan="5" style="width: 90%;" ><font size="2" >Opening Balance</font></td>

  <td align="right" style="width: 10%;"><font size="2" ><?php  echo $opbl;?></font></td>
  </tr>
  <?php 
 $nbal=$opbl;
 $tdebt=0;
 $tcredt=0;
 
 $pag=0;
$query1="select * from ".$DBprefix."drcr where (dldgr='4' or cldgr='4') and cid='$a' and dt between '$fdt' and '$tdt'  order by dt,sl";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
  $dsl=$R1['sl'];
$bno=$R1['cbill'];
$vno=$R1['vno'];
$pmd=$R1['mtd'];
$amm=round($R1['amm'],2);
$rd=$R1['dt'];
$cldgr=$R1['cldgr'];
$dldgr=$R1['dldgr'];
$ref=$R1['mtddtl'];
$brncd=$R1['brncd'];
$nrtn=$R1['nrtn'];
$pno=$R1['pno'];
$bb="";
$bb1="";
if($amm<0)
{
	$amm=($amm*(-1));
}


if($dldgr!='4' and $cldgr!='-2')
{
$bno="";
}
if($bno!="")
{
$dscrp=$bno;
}
else
{
$dscrp=$ref;
}
if($dldgr==4){
    $damm=$amm;
    $camm="";
    $nbal=round($nbal+$amm,2);
    if($nbal<0)
   {
    $nbalf=$nbal*-1;
    $nbalf.=" Cr";
   } 
   else
   {
    $nbalf=$nbal;
    $nbalf.=" Dr";
   }
}
if($cldgr==4){
    $camm=$amm;
    $damm="";
    $nbal=$nbal-$amm;
    if($nbal<0)
   {
    $nbalf=$nbal*-1;
    $nbalf.=" Cr";
   } 
   else
   {
    $nbalf=$nbal;
    $nbalf.=" Dr";
   }
}

if($colo=='')
{
	$colo="#ededed";
}
else
{
	$colo="";
}
if($nrtn!='Sale')
{
	if($user_current_level < 0)
	{
$rd1=$rd;
	}
	else
{
$rd1=$rd;	
}
}
else
{
$rd1=$rd;	
}

$nrtn0=substr($nrtn,0,32);
$nrtn1=$nrtn0.'<br/>'.substr($nrtn,33,32);
		  ?>
		  <tr bgcolor="<?php  echo $colo;?>">
		  <td align="center" ><font size="2" ><?php  echo $rd1;?></font></td>
		  <td align="left" ><font size="2" ><?php  echo $dscrp;?></font></td>
		  <td align="left" ><font size="2" ><?php  echo $nrtn1;?></font></td>
		  <td align="right" ><font size="2" ><?php echo round($damm,2);?></font></td>
		  <td align="right"><font size="2" ><?php echo round($camm,2);?></font></td>
		  <td align="right" title="<?php  echo $dsl;?>" ><font size="2" ><span style="color:<?php  if($nbal<0){echo "#0034ff";}else{echo "#FF0000";}?>;font-family:Arial;font-size:15px;"><?php  echo $nbalf;?></span></font></td>
		 
		  </tr>
		  <?php $pcs1=$pcs+$pcs1;
		  if($cldgr!=-1 and $dldgr!=-1)
		  {
		  $tdebt=$tdebt+$damm;
		   $tcredt=$tcredt+$camm;
		     }
		  
		 
		  }
		  
		  ?>
		  <tr style="border-top: 1px solid #000;">
		  <td colspan="3" style="width:70%;text-align:right;border-top: 1px solid #000;border-bottom: 1px solid #000;">
		  <b>Total </b>
		  </td>
		  <td align="right" style="width:10%;border-top: 1px solid #000;border-bottom: 1px solid #000;">
		  <font size="2" ><b><?php  echo $tdebt;?></b></font>
		  </td>
		  <td align="right" style="width:10%;border-top: 1px solid #000;border-bottom: 1px solid #000;">
		 <font size="2" ><b> <?php  echo $tcredt;?></b></font>
		  </td>
		   <td style="width:10%;border-top: 1px solid #000;border-bottom: 1px solid #000;">
		  </td>
		  </tr>
		  
		  </table>
	
		
	</page>

	<?php 
		$content = ob_get_clean();
    // convert in PDF
		require_once('html2pdf/html2pdf.class.php');
		try
		{
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
   $html2pdf->Output($file.'.pdf','F');
		//$html2pdf->Output($path2.'/'.$flnm.'.pdf', 'F');
		}
		catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
		}
		echo 'true';
}
else
{
	echo 'false';
}
?>