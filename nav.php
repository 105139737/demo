<?PHP $reqlevel = 1; include("membersonly.inc.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html>
        <head>

                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script type="text/javascript" src="./jquery-1.4.2.min.js"></script>
<script>
 var auto_refresh = setInterval(
 function()
 {
 $('#loaddiv').load('rmsg.php').fadeIn("slow");
 
 $('#mdiv').load('rmain.php').fadeIn("slow");
 }, 5000);
 </script>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: none;
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
   text-decoration: none;
}
</style>
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.accordion.min.js"></script>
<link rel="stylesheet" href="fcsmenu.css" type="text/css">

<style type="text/css">
#accordionMenu .ui-accordion-header
{
   font-family: Arial;
   font-size: 13px;
   height: 26px;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
}
#accordionMenu .ui-accordion-header a
{
   padding: 5px 5px 5px 30px;
}
#accordionMenu .ui-accordion-header .ui-icon
{
   left: 10px;
}
#accordionMenu .ui-accordion-content
{
   padding: 5px 5px 5px 30px;
}
#accordionMenu .ui-accordion-content a
{
   display:block;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   font-family: Arial;
   font-size: 13px;
}
#accordionMenu .ui-accordion-content a:hover
{
   text-decoration:underline;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
	//Add Inactive Class To All Accordion Headers
	$('.accordion-header').toggleClass('inactive-header');
	
	//Set The Accordion Content Width
	var contentwidth = $('.accordion-header').width();
	$('.accordion-content').css({'width' : contentwidth });
	
	//Open The First Accordion Section When Page Loads
	$('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
	$('.accordion-content').first().slideDown().toggleClass('open-content');
	
	// The Accordion Effect
	$('.accordion-header').click(function () {
		if($(this).is('.inactive-header')) {
			$('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
			$(this).toggleClass('active-header').toggleClass('inactive-header');
			$(this).next().slideToggle().toggleClass('open-content');
		}
		
		else {
			$(this).toggleClass('active-header').toggleClass('inactive-header');
			$(this).next().slideToggle().toggleClass('open-content');
		}
	});
	
	return false;
});
</script>
<style type="text/css">
body
{

   background-image: url(images/bg.png);

}
</style>
                <style type="text/css">
<!--
/* CSS Tabs */
.accordion-content {
        width: 200px;
        border-right: 0px solid #000;
        padding: 0 0 0 0;
        margin-bottom: 0;
        font-family: Tahoma, Arial, sans-serif;
                /*'Trebuchet MS', 'Lucida Grande', Verdana, Arial, sans-serif;*/
        font-size : 10px;
        
        color: #333;
        }

        .accordion-content ul {
                list-style: none;
                margin: 0;
                padding: 0;
                border: none;
                }

        .accordion-content li {
                border-bottom: 1px solid #90bade;
                margin: 0;
                list-style: none;
                list-style-image: none;
                }

        .accordion-content li a {
                display: block;
                padding: 5px 5px 5px 0.5em;
                border-left: 10px solid #E3F3FB;
                
                border-right: 10px solid #E3F3FB;
                background-color: #D7EBF9;
                color: #00f;
                text-decoration: none;
                width: 200px;
                }

        html>body .accordion-content li a {
                width: 135px;
                }

        .accordion-content li a:hover {
                border-left: 10px solid #1c64d1;
                border-right: 10px solid #5ba3e0;
                background-color: #2586d7;
                color: #fff;
                }

        .accordion-content li #active {
                border-left: 10px solid #1c64d1;
                border-right: 10px solid #5ba3e0;
                background-color: #2586d7;
                color: #fff;
                }
-->
</style>
<script>
<!--
function hidestatus(){
window.status=''
return true
}

if (document.layers)
document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT)

document.onmouseover=hidestatus
document.onmouseout=hidestatus
-->
</script>
</head>

        <body>
<font color="#ffffff">Welcome <?PHP 
//echo the username that was used to login from the session
echo $user_current_name." ".$user_current_Rank; 
echo ("<br>");
if($user_current_ammount_new>0)
{
echo "You have ".$user_current_ammount_new." Message to Read.";
}
?>

<div id="accordion-container"> 
     <h2 class="accordion-header">Invoice</h2> 
     <div class="accordion-content"> 
                            
                                <?

if ($user_current_level < 0){
	
	echo "<li><a href=\"nbrnch.php\" target=\"mainFrame\">Branch</a></li>";
}
if ($user_current_level < 0 || $user_current_level > 2){
    echo "<li><a href=\"pcat.php\" target=\"mainFrame\">Product Category</a></li>";
    echo "<li><a href=\"pent.php\" target=\"mainFrame\">Product Entry</a></li>";
	/*echo "<li><a href=\"pent.php\" target=\"mainFrame\">Open Stock</a></li>";*/
    echo "<li><a href=\"stk_trn.php\" target=\"mainFrame\">Stock Transfer</a></li>";
	echo "<li><a href=\"sentry.php\" target=\"mainFrame\">Supplier Entry</a></li>";
	echo "<li><a href=\"centry.php\" target=\"mainFrame\">Customer Entry</a></li>";  
    echo "<li><a href=\"stock_recv.php\" target=\"mainFrame\">Receive</a></li>";  
  
      
   
	echo "<li><a href=\"expence.php\" target=\"mainFrame\">Expence Entry</a></li>";
    echo "<li><a href=\"billing.php\" target=\"mainFrame\">Sale Invoice</a></li>";
	 echo "<li><a href=\"purchase.php\" target=\"mainFrame\">Purchase</a></li>";
}
?>
</div>
     <h2 class="accordion-header">View & Edit</h2>                        
       <div class="accordion-content">                       
                                <?


if ($user_current_level < 0 || $user_current_level > 2){
echo "<li><a href=\"stock_list.php\" target=\"mainFrame\">Stock</a></li>";
    echo "<li><a href=\"supsrc.php\" target=\"mainFrame\">Supplier List</a></li>";
	echo "<li><a href=\"assrc.php\" target=\"mainFrame\">Customer List</a></li>";
    echo "<li><a href=\"prdsrc.php\" target=\"mainFrame\">Product List</a></li>";
	echo "<li><a href=\"cifdtl.php\" target=\"mainFrame\">Customer Enquery</a></li>";    
    echo "<li><a href=\"edtbill.php\" target=\"mainFrame\">Edit Bill</a></li>";
    echo "<li><a href=\"dpbill.php\" target=\"mainFrame\">Duplicate Bill</a></li>";
}
if ($user_current_level < 0 || $user_current_level > 3){
echo "<li><a href=\"totpol.php\" target=\"mainFrame\">Cash Book</a></li>";
}
?>
</div>
     <h2 class="accordion-header">Accounts</h2>                        
       <div class="accordion-content">                       
                                <?


if ($user_current_level < 0 || $user_current_level > 4){

	echo "<li><a href=\"nmake.php\" target=\"mainFrame\">Account Group Entry</a></li>";
    echo "<li><a href=\"nledg.php\" target=\"mainFrame\">New Ledger Create</a></li>";
	
    
    
}
?>

<?
if ($user_current_level < 0 || $user_current_level >2){
    echo "<li><a href=\"totcol.php\" target=\"mainFrame\">Transaction</a></li>";
    echo "<li><a href=\"ftrn.php\" target=\"mainFrame\">Fund Transfer</a></li>";
    echo "<li><a href=\"pfnd.php\" target=\"mainFrame\">Pending to Approval</a></li>";
}
?>
</div>
     <h2 class="accordion-header">System</h2>                        
       <div class="accordion-content">                       
                                <?
if ($user_current_level < 0){
	
?><li><?
	echo "<a href=\"nrcv.php\" target=\"mainFrame\">Not Verified</a>";
?></li><li><?
	echo "<a href=\"billstp.php\" target=\"mainFrame\">Bill Format Setup</a>";
?></li><li><?
	echo "<a href=\"mdtls.php\" target=\"mainFrame\">System Members</a>";
?></li><li><?
	echo "<a href=\"db.php\" target=\"mainFrame\">Backup Database</a>";
?></li><?
}
?>
<li>
<a href="changepass.php" target="mainFrame">Change Password</a>
</li>
<li>
<a href="logoff.php" target="_top">Logout</a> 
</li>
</div>


</div>

</body>
</html>