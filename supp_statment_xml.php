<?php 
require("config.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

header("Content-type: text/xml");
echo '<markers>';
$tiamm=0;
$teamm=0;
$a=$_REQUEST['sl'];
$tdt=$_REQUEST['tdt'];
$fdt=$_REQUEST['fdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
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

	 $gbt=mysqli_query($conn,"select * from main_suppl where sl='$a'");
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
$query11="select sum(amm) as pcrdt from ".$DBprefix."drcr where cldgr='12' and sid='$a' and dt < '$fdt' ";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pcrdt=$R11['pcrdt'];
}
$query11="select sum(amm) as pdbdt from ".$DBprefix."drcr where dldgr='12' and sid='$a' and dt < '$fdt' ";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pdbdt=$R11['pdbdt'];
}
$opbl=$opbl-$pcrdt+$pdbdt;
$pageno=1;
if($i==1)
{
	   echo '<marker ';
  echo 'date="NA" ';
  echo 'refno="NA" ';
  echo 'nrtn="Opening Balance" ';
  echo 'dr="0" ';
  echo 'cr="0" ';
  echo 'bal="' . parseToXML($opbl) . '" ';
  echo '/>';

 $nbal=$opbl;
 $tdebt=0;
 $tcredt=0;
 
 $pag=0;
$query1="select * from ".$DBprefix."drcr where (dldgr='12' or cldgr='12') and sid='$a' and dt between '$fdt' and '$tdt'  order by dt,sl";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
  $dsl=$R1['sl'];
$bno=$R1['sbill'];
$vno=$R1['vno'];
$pmd=$R1['mtd'];
$amm=$R1['amm'];
$rd=$R1['dt'];
$cldgr=$R1['cldgr'];
$dldgr=$R1['dldgr'];
$ref=$R1['mtddtl'];
$brncd=$R1['brncd'];
$nrtn=$R1['nrtn'];
$pno=$R1['pno'];
$bb="";
$bb1="";



if($dldgr!='-3' and $cldgr!='12')
{
$bno="";
}
if($bno!="")
{

}
else
{
$dscrp=$vno;
}
if($dldgr==12){
    $damm=$amm;
    $camm="";
    $nbal=$nbal+$amm;
    if($nbal<0)
   {
    $nbalf=$nbal*-1;
    $nbalf.=" Dr";
   } 
   else
   {
    $nbalf=$nbal;
    $nbalf.=" Cr";
   }
}
if($cldgr==12){
    $camm=$amm;
    $damm="";
    $nbal=$nbal-$amm;
    if($nbal<0)
   {
    $nbalf=$nbal*-1;
    $nbalf.=" Dr";
   } 
   else
   {
    $nbalf=$nbal;
    $nbalf.=" Cr";
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
$pag++;
if($dscrp==''){$dscrp="NA";}
if($nrtn==''){$nrtn="NA";}
if($damm==''){$damm=0;}
if($camm==''){$camm=0;}
  
  echo '<marker ';
  echo 'date="' . parseToXML($rd1) . '" ';
  echo 'refno="' . parseToXML($dscrp) . '" ';
  echo 'nrtn="' . parseToXML($nrtn) . '" ';
  echo 'dr="' . parseToXML($damm) . '" ';
  echo 'cr="' . parseToXML($camm) . '" ';
  echo 'bal="' . parseToXML($nbalf) . '" ';
  echo '/>';	  
		  $pcs1=$pcs+$pcs1;
		  if($cldgr!=-1 and $dldgr!=-1)
		  {
		  $tdebt=$tdebt+$damm;
		   $tcredt=$tcredt+$camm;
		     }
		  }
		  


}
echo '</markers>';
mysqli_close($conn);


