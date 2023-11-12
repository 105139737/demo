<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST[sl];

$query3 = "SELECT * FROM ".$DBprefix."catg where sl='$sl'";
$result3 = mysqli_query($conn,$query3);
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['sl'];
$cnm=$R['cnm'];
$hsn=$R['hsn'];
}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#FFF;
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

            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Brand
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">
						<a href="tech_show.php"><i class="fa fa-list"></i>Brand Update</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
							
							
							


<center>
    <div class="box box-success" >
	<form method="post" action="tech_edits.php" id="form1" onSubmit="return check1()" name="form1">
<div class="box-body">
<body >
<table border="0"  width="700px"  class="table table-hover table-striped table-bordered" >
<input type="hidden" name="sl" id="sl" value="<?=$sl;?>">

            <tr>
		    <td align="right" width="20%"><b>Brand :</b></td>
            <td  align="left" width="50%">
            <input type="text" class="form-control" name="cat" value="<?=$cnm;?>" id="cat"  size="40" placeholder="Enter  Company...">
			</td>
			<td  colspan=""  align="left" style="padding-right: 5px;">
             <input type="submit" class="btn btn-success" value="Update" name="B1" >
          </tr>
			
			<!--<td align="right" width="20%"><b>HSN ACS :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="hsn" value="<?=$hsn;?>" id="hsn"  size="40" placeholder="Enter  HSN ACS...">
			</td>
			</tr>
			<tr>
            <td align="right" width="20%" style="padding-top:15px;" ><b>Small Unit :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="sun" id="sun" value="<?=$sun1;?>" size="40" placeholder="Enter Small Unit....">
			</td>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Small Value :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="smvlu" id="smvlu" value="<?=$smvlu1;?>" size="40" readonly placeholder="Enter Small Value....">
			</td>
			</tr>
			<tr>
            <td align="right" width="20%" style="padding-top:15px;" ><b>Midle Unit :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="mun" id="mun" value="<?=$mun1;?>" size="40" placeholder="Enter Midle Unit....">
			</td>
            <td align="right" width="20%" style="padding-top:15px;" ><b>Midle Value :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="mdvlu" id="mdvlu" value="<?=$mdvlu1;?>" size="40" placeholder="Enter Midle Value....">
			</td>
			</tr>
			<tr>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Big Unit :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="bun" id="bun" value="<?=$bun1;?>" size="40" placeholder="Enter Big Unit....">
			</td>
			<td align="right" width="20%" style="padding-top:15px;" ><b>Big Value :</b></td>
            <td  align="left" width="30%">
            <input type="text" class="form-control" name="bgvlu" id="bgvlu" value="<?=$bgvlu1;?>" size="40" placeholder="Enter Big Value....">
			</td>
			</tr>
    
		    <tr >

            <td  colspan="4"  align="right" style="padding-right: 5px;">
             <input type="submit" class="btn btn-success" value="Update" name="B1" >
          </tr>-->
		   </table>


</form>
 </center>


</body>
