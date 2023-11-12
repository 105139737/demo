<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Bill Setup</title>
<style type="text/css">
body
{

   background-image: url(images/bg.png);

}
</style>

<script type="text/javascript" src="prdcedt.js"></script>


</head>

<body>
<form method="post" action="billstps.php" name="f">
<p align="center"><u><font size="7" color="#FF0000">Bill Setup </font></u></p>
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
            <td width="40%"><font size="5" color="#FFFF66">Table</font></td>
            <td width="60%">
            <select name="tbl" style="font-size: 18pt; color: #008000" onchange="gfld(this.value)">
            <option value="">---S e l e c t---</option>
            <option value="company">Company</option>
            <option value="billing">Bill</option>
            </select>
            </td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Field</font></td>
            <td width="60%"><div id="fl"><select name="fld" style="font-size: 18pt; color: #008000">
            </select></div></td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Name</font></td>
            <td width="60%">
            <input type="text" name="nm" size="40" style="font-size: 18pt; color: #008000"></td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Alias</font></td>
            <td width="60%">
            <input type="text" name="als" size="40" style="font-size: 18pt; color: #008000"></td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Type</font></td>
            <td width="60%">
            <select name="tbl" style="font-size: 18pt; color: #008000" onchange="gfld(this.value)">
            <option value="Image">Image</option>
            <option value="Text">Text</option>
            </select>
            </td>
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
</form>
</body>

</html>
