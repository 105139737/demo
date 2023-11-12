<?PHP

$reqlevel = 1;
include("membersonly.inc.php");
$idas=$_REQUEST[ids];
include("ttl.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
body
{
   text-align: left;
   margin: 0;
   background-image: url(images/bg.png);
   background-attachment: fixed;
   color: #000;
}
a{
    color:#000;
}
</style>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<title>Details</title>
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script src="jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>
	<script type="text/javascript" src="demo.js"></script>
	<link rel="stylesheet" href="jquery.treeview.css" />


</head>

<body><p>&nbsp;</p>
<?
	$query5 = "SELECT * from ".$DBprefix."associate where uname='$idas'";
	$result5 = mysqli_query($conn,$query5);
 	while($row5 = mysqli_fetch_array($result5)){
	$a=$row5['name'];
	}

?>

<p align="center"><font size="5" color="#FF0000">
Welcome <?PHP 

echo $a."(".$idas.")"; ?></font>


<font color="#000000">
<p align="center"><font size="4" color="#FF0000">Down Line List</p>
</font>



<?
$tot=cdll($DBprefix,$idas,$tu);

        $tcn=explode("|", $tot);
	$fro=$tcn[0];
	$sro=$tcn[1];


        $pn=explode(":", $fro);
	$cnt=count($pn);
	$cnt2=0;

?>
<div id="treecontrol">
		<a title="Collapse the entire tree below" href="#">Collapse All</a> | 
		<a title="Expand the entire tree below" href="#"> Expand All</a> | 
		<a title="Toggle the tree below" href="#"> Toggle All</a>
	</div>

<ul id="red" class="treeview-red">
<li><span><font color="#000"><? echo strtoupper($idas);?></font></span>

<? echo $tot;?> 
 
 
 
 

</li></ul>





<a href="asslp.php?ids=<?=$idas;?>" target="_blank">Print</a>

</body>
</html>