<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$yrs = date('Y');

$sl1=$_REQUEST['sl'] ?? "";

if($sl1==''){
    $val='Submit';
    $clr='primary';
}
else{
    $val='Update';
    $clr='warning';
}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>
function get_assign_spid()
{
var spid= document.getElementById('spid').value;
$('#custdv').load('get_assign_spid.php?spid='+spid).fadeIn('fast');
}
</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Sales Person Assign 
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Sales Person Assign </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show(),get_assign_spid()">
<div class="box box-success " >
<form method="post" action="sale_person_assigns.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td  align="left" width="50%">
<b>Main Sales Person :</b><br>
<select name="spid" class="form-control" id="spid" required onchange="get_assign_spid(),show()">
<Option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$spid=$row1['spid'];
?>
<Option value="<?php  echo $spid;?>" <?php  if($spid==$sl1){echo 'selected';}?>><?php  echo $spid;?></option>
<?php }?>
</select>
</td>
<td  align="left" width="50%">
<b>Sales Person Assign :</b><br>
<div id="custdv">
<select name="assign_spid[]"  multiple class="form-control" id="assign_spid" required>
<?php 
$data13 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row13 = mysqli_fetch_array($data13))
{
$sl2=$row13['sl'];
$spid2=$row13['spid'];
?>
<Option value="<?php  echo $spid2;?>"><?php  echo $spid2;?></option>
<?php }?>
</select>
</div>
</td>
</tr>
<tr>

<td align="left">
<b>Brand : </b><br>
<select id="brand"  name="brand" class="form-control" >
<option value="" >---Select---</option>

	<?php 
	$sq="SELECT * FROM main_catg WHERE sl>0 ORDER BY sl";
	$res = mysqli_query($conn,$sq) or die(mysqli_error($conn));
	while($ro=mysqli_fetch_array($res))
	{
	?>
    <option value="<?php  echo $ro['sl'];?>"><?php  echo $ro['cnm'];?></option>
	<?php }?>
</select>

    
</td>

<td>

</td>
</tr>
<tr>
<td align="right" colspan="2">
<input type="submit" class="btn btn-primary" value="Submit" name="B1" >
</td>
</tr>
</table>
</div>
</form>
<div class="box box-success" id="sgh">
</div>	
</body>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>

function show()
 {
 var spid= document.getElementById('spid').value;
 $('#sgh').load('sale_person_assign_list.php?spid='+spid).fadeIn('fast');
 }
 function pagnt(pno){
var ps=document.getElementById('ps').value;
var spid=document.getElementById('spid').value;
$('#sgh').load("sale_person_assign_list.php?ps="+ps+"&pno="+pno+"&spid="+spid).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}
$('#spid').chosen({no_results_text: "Oops, nothing found!",});	
$('#assign_spid').chosen({no_results_text: "Oops, nothing found!",});	
</script>