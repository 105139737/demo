<?php
include("config.php");
$a=$_REQUEST['key'];

$a=base64_decode($a);
$bcd=explode('@', $a);
$bc=$bcd[0];
$bnm=$bcd[1];
$ndt=$bcd[2];

?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Already Expired on <? echo date('d-m-Y', strtotime($ndt));?>.............. Please Register</title>
<style type="text/css">
body
{

   background-image: url(images/bg.png);

}
</style>
<script type="text/javascript">
function chklccd(lcvl)
{
    var lnth1=lcvl.length;
    if(lnth1==5||lnth1==11||lnth1==17||lnth1==23){
    var nvl=lcvl.toUpperCase()+"-";
    }
    else
    {
        var nvl=lcvl.toUpperCase();
    }
    document.getElementById('actcd').value=nvl.substring(0,29);
    document.getElementById('actcd').focus();
}
</script>
</head>

<body>
<form method="post" action="registers.php" name="f">
<p align="center"><u><font size="7" color="#FF0000">Expired on <? echo date('d-m-Y', strtotime($ndt));?></font></u></p>
<p align="center">&nbsp;</p>
<div align="center">
  <center>
  <table border="1" cellspacing="1" width="80%" id="AutoNumber1" height="260">
    <tr>
      <td width="100%" height="255">
      <div align="center">
        <center>
        <table border="1" cellspacing="1" width="90%" id="AutoNumber2">
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Company Code</font></td>
            <td width="60%">
            <div id="alsd"><input type="text" name="bcd" size="20" style="font-size: 18pt; color: #008000" value="<? echo $bc;?>" readonly></div></td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Company Name</font></td>
            <td width="60%">
            <input type="text" name="sn" size="30" style="font-size: 18pt; color: #008000" value="<? echo $bnm;?>" readonly></td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">License To.</font></td>
            <td width="60%">
            <input type="text" name="lto" size="40" style="font-size: 18pt; color: #008000"></td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Activation Code</font></td>
            <td width="60%">
            <input type="text" name="actcd" size="40" id="actcd" style="font-size: 18pt; color: #008000" onkeyup="chklccd(this.value)" onfocus="this.value = this.value"></td>
          </tr>
        </table>
        </center>
      </div>
      </td>
    </tr>
  </table>
<p>
      <input type="submit" value="Continue" name="B1"><input type="reset" value="Reset" name="B2"></p>
  </center>
</div>