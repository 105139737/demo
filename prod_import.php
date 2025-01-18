<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
			
            ?>
<head>
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
</style> 
<script>
function showw()
{
$('#showdiv').load("prod_import_tmp_list.php").fadeIn('fast');
}
function delt()
{
	if(confirm('Are You Sure to All Delete ?'))
	{
	$('#showdiv').load("prod_import_del_tmp.php").fadeIn('fast');
	}
	
}
function subb()
{
	
		if(confirm('Are You Sure to Submit ?'))
		{
		$('#showdiv').load("prod_import_final.php").fadeIn('fast');
		}
	
	
}
</script>
</head>
<body onload="showw()">
<aside class="right-side">
	<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"> Model Rate Import</li>
    </ol>
    </section> 
	<section class="content"> 
<div class="row">
<div class="col-md-0" >
</div>
	<div class="col-md-12" >
    <div class="box box-myclass box-solid" >
                <div class="box-header with-border" >
                  <h3 class="box-title"> Model Rate Import</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
    <div class="box-body" >
<div class="box-header">
<div class="box-success">
<form name="form1" id="form1" method="post" action="prod_imports.php" enctype="multipart/form-data">
<table width="800px" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" style="padding-top:15px;" width="20%"><font size="4"><b> Import Excel :</b></font></td>
<td align="left" width="40%">
<label>
<input type="file" class="btn btn-info" id="file"  name="file" required accept=".xlsx"> 
<font color="red"> Choose the '.xlsx' file to Upload <a href="ProductPriceList.xlsx"><b>**Click Here For Sample**</b></a></font>
</label>
</td>

<td align="left" style="padding-right:8px;" width="40%"><br>
<input type="submit" class="btn btn-success" id="Button1" name="" value="UPLOAD" >
<input type="button" class="btn btn-danger" id="Button2" onclick="delt()" value="DELETE EXCEL DATA" >
</td>
</tr>
</table>
</form>
</div>
</div>

<div class="box-success" id="showdiv">
</div>


   
	</div>
	</div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->
           
	<div class="col-md-3" ></div>

 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</div>
    </body>
</html>




