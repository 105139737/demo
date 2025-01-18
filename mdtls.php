<?php  
$reqlevel = 0;
include("membersonly.inc.php");?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Important Dates</title>

<SCRIPT LANGUAGE="JavaScript" SRC="ajax.js"></SCRIPT>
</head>

<body background="images/bg.png" onload="adduser('','','','','','',0,'','')">
<p align="center"> <u><font size="7" color="#FF0000">Member Details</font></u></p>
<center>
<table border="2" cellspacing="1" width="90%" id="AutoNumber1">
  <tr>
    <td>
<center>
<table border="2" cellspacing="1" width="60%" id="AutoNumber1">
  <tr>
    <td>Desired Username</td><td><input Type="text" name="unm" id="unm"></td>
</tr><tr>
    <td>Name</td><td><input Type="text" name="nm" id="nm"></td>
</tr><tr>
    <td>Mobile</td><td><input Type="text" name="mob" id="mob"></td>
</tr><tr>
    <td>E-Mail</td><td><input Type="text" name="eml" id="eml"></td>
</tr><tr>
    <td>Designation</td><td>
<select name="desg" id="desg">

<option value='2'>Entry Operator</option>
<option value='3'>Editor</option>
	
</select>
</td></tr>
<tr>
    <td>Branch Name</td><td>
<select name="brn" id="brn">

<?php 

 $query = "SELECT * FROM ".$DBprefix."branch order by bnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$a=$R['sl'];
$b=$R['bnm'];
echo "<option value=\"$a\">".$b."</option>";
}
?>		
</select>
</td></tr>

<tr>
    <td colspan="2" align="center"><input type="button" Value="Add User" onclick="adduser('','','','','','',1,'','')"></td>
</tr></table>
<table border="2" cellspacing="1" width="90%" id="AutoNumber1">
  <tr>
    <td><div id="list">&nbsp;</div></td></tr></table>
</td>
</tr>
</table>
</center>
</body>
</html>