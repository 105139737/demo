<?php
require("config.php");
$mnth=$_REQUEST['mnth'];
$yr=$_REQUEST['yr'];
$fdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-01"));
$tdt=date('Y-m-d', strtotime($yr."-".str_pad($mnth,2,"0",STR_PAD_LEFT)."-".date('t',strtotime($fdt))));
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
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
  echo 'val="b2b" ';
  echo 'title="B2B Invoices - 4A, 4B, 4C, 6B, 6C" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="b2cl" ';
  echo 'title="B2C(Large) Invoices - 5A, 5B" ';
  echo '/>';
	  

  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="b2cs" ';
  echo 'title="B2C(Small) Details - 7" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="cdnr" ';
  echo 'title="Credit/Debit Notes(Registered) - 9B" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="cdnur" ';
  echo 'title="Credit/Debit Notes(Unregistered) - 9B" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="exp" ';
  echo 'title="Exports Invoices - 6A" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="at" ';
  echo 'title="Tax Liability(Advances Recieved) - 11A(1), 11A(2)" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
   echo 'val="atadj" ';
  echo 'title="Adjustment of Advances - 11B(1), 11B(2)" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';
  echo 'val="exemp" ';
  echo 'title="exemp" ';
  echo '/>';

  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" ';  
   echo 'val="hsn" ';
  echo 'title="HSN-wise Summary of Outward Supplies - 12" ';
  echo '/>';
  echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" '; 
 echo 'val="docs" ';  
  echo 'title="docs" ';
  echo '/>';
    echo '<marker ';
  echo 'fdt="' . parseToXML($fdt) . '" ';
  echo 'tdt="' . parseToXML($tdt) . '" '; 
 echo 'val="email~' . parseToXML('ikbal.jafar46@gmail.com') . '" ';  
  echo 'title="E-Mail" ';
  echo '/>';
  
echo '</markers>';
?>

