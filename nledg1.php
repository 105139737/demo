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
<script type="text/javascript" src="validate.js"></script>
<script type="text/javascript" src="jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="prdcedt.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#tp').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#tp').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#tp').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>
<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#tp{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	left: 0px;
	top:10px;
	margin: 26px 0px 0px 0px;
	width: 300px;
	padding:0px;
	background-color: #9F1301;
	border-top: 3px solid #FFFF66;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}

</style>

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


</head>

<body bgcolor="#9F1301" onload="ledg('','')">

<p align="center"><u><font size="7" color="#FFFFFF">Ledger Create </font></u></p>
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
            <td width="40%"><font size="5" color="#FFFF66">Group</font></td>
            <td width="60%"><div id="suggest">
            <input type="text" name="tp" id="tp" size="20" style="font-family: Times New Roman; font-size: 18pt" onkeyup="suggest(this.value);" onblur="fill();" class="">
      <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div></div>
</td>
          </tr>
          <tr>
            <td width="40%"><font size="5" color="#FFFF66">Ledger</font></td>
            <td width="60%">
            <input type="text" name="sn" id="sn" size="20" style="font-size: 18pt; color: #008000"></td>
          </tr>

          </table>
        </center>
      </div>
      </td>
    </tr>
<tr><td align="center"><p><input type="button" value="Add" name="B1" onclick="ledg('','')"> </p><font size="7" color="#FFFFFF">Ledger List</font></td></tr>
<tr><td align="center"><div id="sdtl"></div></td></tr>
  </table>
<input type="hidden" id="edtbx"/>
     
  </center>
</div>
</form>
</body>

</html>
