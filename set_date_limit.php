<?php
$reqlevel = 0;
include("membersonly.inc.php");
include "header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">

#underlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:#000;
    -moz-opacity:0.5;
    opacity:.50;
    filter:alpha(opacity=50);
}
</style>


<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}

</style>






 



<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<script>
function sedt(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedt.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
function edt1(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedts.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
</script>
<body >
 <aside class="right-side">

  <section class="content-header">
                    <h1 align="center">
               Set Date Limit 
                        <small> Set Date Limit </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> System</a></li>
                        <li class="active"> Set Date Limit </li>
                    </ol>
                </section>
				   <section class="content">

 <div class="box box-success" >


<?
$sq=mysqli_query($conn,"select * from main_dt") or die (mysqli_error($conn));
while($r=mysqli_fetch_array($sq))
{
	$cnt++;
	$dt=$r['dt'];
	$sl1=$r['sl'];
}
?>
<table align="center">
<tr>
<td align="right">
<label for="exampleInputEmail1" ><font size="6">Date Limit:</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
</td>
<td align="left">
<div id="dt<?=$sl1;?>" >
<a href="#" onclick="sedt('<?echo $sl1;?>','dt','<?echo $dt;?>','dt<?=$sl1;?>','main_dt')"><b><font size="6" color="red"><?=$dt;?></font></b></a>
</div>
</td>
</tr>
</table>







       
</div>


</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>


</div>
</html>
