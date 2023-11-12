<?php
$reqlevel = 3;
include("membersonly.inc.php");
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Make</title>
<style type="text/css">
body
{
   text-align: center;
   margin: 0;
   background-image: url(images/bg.png);
   color: #fde052;
}
A {
cursor:pointer;
}
</style>
<script type="text/javascript" src="validate.js"></script>
<script type="text/javascript" src="prdcedt.js"></script>
</head>

<body onload="makes('','')">

<p align="center"><u><font size="7" color="#FFFFFF">Manufacturing Company Entry </font></u></p>
<p align="center">&nbsp;</p>
<div align="center">
  <center>
  <table border="0" cellspacing="1" width="80%" id="AutoNumber1">
    <tr>
      <td width="100%" >
      <div align="center">
        <center>
        <table border="1" cellspacing="1" width="90%" id="AutoNumber2">
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Primary</font></td>
            <td width="60%">
            <select name="tp" id="tp" size="1" style="font-family: Times New Roman; font-size: 18pt">
<?
$query3 = "SELECT * FROM ".$DBprefix."primary";
   $result3 = mysqli_query($conn,$query3);
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['sl'];
$y=$R['nm'];
?>
<option value="<? echo $x;?>"><? echo $y;?></option>
<?
}
?>
</select>
</td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">New Group</font></td>
            <td width="60%">
            <input type="text" name="sn" id="sn" size="20" style="font-size: 18pt; color: #008000"></td>
          </tr>

          </table>
        </center>
      </div>
      </td>
    </tr>
<tr><td align="center"><p><input type="button" value="Add" name="B1" onclick="makes('','')"> </p><font size="7" color="#FFFFFF">Group List</font></td></tr>
<tr><td align="center"><div id="sdtl"></div></td></tr>
  </table>
<input type="hidden" id="edtbx"/>
     
  </center>
</div>
</form>
</body>

</html>
