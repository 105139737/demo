<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Bill Setup</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 691px;
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
#Layer1
{
   background-color: transparent;
   border: 1px #000000 solid;
   -moz-border-radius: 1px;
   -webkit-border-radius: 1px;
   border-radius: 1px;
}
.dragclass{
position : relative;
cursor : move;
}

</style>
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="style_sedtbill.css" />
<script type="text/javascript" src="popup_sedtbill.js"></script>
<script type="text/javascript" src="prdcedt.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$('#overlay').fadeOut('fast');
});
function addel()
{
 var als=document.getElementById("als").value;   
 var tp=document.getElementById("tp").value;
 var nm=document.getElementById("nm").value;  
 var fv=document.getElementById("fv").value;
 var sv=document.getElementById("sv").value;
 if(tp==1)
 {
 $("#Layer1").append("<div id='"+als+"' class='dragclass' style='font-size:"+fv+"px;'>"+nm+"</div>");   
 }
 if(tp==2)
 {
  $("#Layer1").append("<img id='"+als+"' class='dragclass' style='height:"+fv+"px;width:"+sv+"px;' src='logo.png'>");  
 }
 
 closeOfferslDialog();
}

if  (document.getElementById){

(function(){

//Stop Opera selecting anything whilst dragging.
if (window.opera){
document.write("<input type='hidden' id='Q' value=' '>");
}

var n = 500;
var dragok = false;
var y,x,d,dy,dx;
var alrt=false;
function move(e){
if (!e) e = window.event;
 if (dragok){
  d.style.left = dx + e.clientX - x + "px";
  d.style.top  = dy + e.clientY - y + "px";
  return false;
 }
}

function down(e){
if (!e) e = window.event;
var temp = (typeof e.target != "undefined")?e.target:e.srcElement;
if (temp.tagName != "HTML"|"BODY" && temp.className != "dragclass"){
 temp = (typeof temp.parentNode != "undefined")?temp.parentNode:temp.parentElement;
 }
if (temp.className == "dragclass"){
 if (window.opera){
  document.getElementById("Q").focus();
 }
 dragok = true;
 alrt=true;
 temp.style.zIndex = n++;
 d = temp;
 dx = parseInt(temp.style.left+0);
 dy = parseInt(temp.style.top+0);
 x = e.clientX;
 y = e.clientY;
 document.onmousemove = move;
 return false;
 }
}

function up(e){
if (!e) e = window.event;
var temp = (typeof e.target != "undefined")?e.target:e.srcElement;
var td=temp.id;
dragok = false;
document.onmousemove = null;
dx = parseInt(temp.style.left+0);
if(alrt){
alert(dx+"/"+td);
alrt=false;
}

}

document.onmousedown = down;
document.onmouseup = up;

})();
}//End.
</script>
</head>
<body>
<div id="container">
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:689px;height:996px;z-index:0;" title="">
</div>
</div>

<div id="wrapper">
<div id="overlay" class="overlay"></div>
<div id="boxpopup" class="box">
	
	<div class="topb">
	<a class="boxopen" onclick="openOfferslDialog('boxpopup');"></a>
    <div class="top_leftb" id="news_ttl">
      <h3>Add Field</h3></div>
  </div>
	   <hr />
	
	<div id="edtcnt">
    <table border="1">
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
            <td width="60%" align="left"><div id="fl"><select name="fld" id="fld" style="font-size: 18pt; color: #008000">
            </select></div></td>
          </tr>
          <tr>
            <td width="40%" align="left"><font size="5" color="#FFFF66">Name</font></td>
            <td width="60%" align="left">
            <input type="text" name="nm" id="nm" size="10" style="font-size: 18pt; color: #008000"></td>
          </tr>
          <tr>
            <td width="40%" align="left"><font size="5" color="#FFFF66">Alias</font></td>
            <td width="60%" align="left">
            <input type="text" name="als" id="als" size="10" style="font-size: 18pt; color: #008000"></td>
          </tr>
          <tr>
            <td width="40%" align="left"><font size="5" color="#FFFF66">Type</font></td>
            <td width="60%" align="left">
            <select name="tp" id="tp" style="font-size: 18pt; color: #008000">
            <option value="1">Text</option>
            <option value="2">Image</option>
            </select><br />
            <input type="text" size="2" name="fv" id="fv" />
            <input type="text" size="2" name="sv" id="sv" />
            </td>
          </tr>
    </table>
    <p align="center"><input type="button" value="A D D" onclick="addel()" /></p>
	</div>
</div>
</div>

</body>
</html>