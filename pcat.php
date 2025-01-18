<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
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
function dlts(psls)
{
	
		 if (confirm("Are You Confirm To Delete ?")){
          $('#sgh').load('delete_product.php?psls='+psls).fadeIn('fast');
         }

	
}

function brnd_swap()
{
	 
     //$('#sghv').load('brand_swaps.php').fadeIn('fast');
	 
	 document.location = 'brand_swaps.php';
}


function show()
 {
 var all= document.getElementById('cat').value;
 $('#sgh').load('tech_list.php?all='+encodeURIComponent(all)).fadeIn('fast');
 }
function pagnt(pno){
var ps=document.getElementById('ps').value;
var src=document.getElementById('cat').value;
$('#sgh').load("tech_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}

function edit(sl)
{
document.location='tech_edit.php?sl='+sl;
}
</script>
            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Brand
                        <small>Setup</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Brand</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show()">
 <div class="box box-success " >
<form method="post" action="pcatlst.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
            <tr>
		    <td align="right" width="20%" style="padding-top:15px;" ><b>Brand :</b></td>
            <td  align="left" width="50%">
            <input type="text" class="form-control" name="cat" id="cat" onkeyup="show()"  size="40" placeholder="Enter Brand...." required>
			</td>
			<td align="left" colspan="">
		    <input type="submit" class="btn btn-success" value="Submit" name="B1" >
			<input type="button" class="btn btn-warning" value="Brand Swap" onclick="brnd_swap()" name="B2">
		    </td>
		    </tr>
</table>
</div>

<div class="box box-success" id="sgh" >

</div>
<div class="box box-success" id="sghv" >

</div>
</form>	
</body>
