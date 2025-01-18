<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$cy=date('Y');
?> 
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;

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
function show()
{
var ttl= document.getElementById('ttl').value;
$('#sgh').load('prod_upload_pdf_list.php?ttl='+encodeURIComponent(ttl)).fadeIn('fast');
}
</script>
</head>
<body onload="show()">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Product Price Upload In PDF 
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Product Price Upload In PDF </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
 <form method="post" action="prod_upload_pdfs.php" id="form1"  enctype="multipart/form-data" name="form1">
<div class="box box-success" >
<table class="table table-hover table-striped table-bordered">
<tr>
<td  align="left" width="20%"><font color="red">*</font><b>Brand :</b><br/>
<select name="cat" class="form-control" size="1" id="cat" required style="width:300px;">
<?php 
$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</td>
<td  align="left" width="20%"><font color="red">*</font><b>Type :</b>
<select name="typ" class="form-control" size="1" id="typ" required>
<Option value="">---Select---</option>
<?php 
$data11 = mysqli_query($conn,"Select * from main_cus_typ");
while ($row11 = mysqli_fetch_array($data11))
{
$sl=$row11['sl'];
$tp=$row11['tp'];
echo "<option value='".$sl."'>".$tp."</option>";
}
?>
</select>
</td>
<td align="left" width="20%">
<b>Title:</b>
<input type="text" name="ttl" id="ttl" class="form-control" onkeyup="show()">
</td>

<td align="left" width="30%" >
<label>
<input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-info" accept=".pdf" style="width:100%">
<font color="red"> Choose the '.pdf' file to Upload</font>
</label>
</td>

<td  align="center" width="10%">
<input type="submit" value=" Submit " class="btn btn-success" >
</td>
</tr>


</tbody>
</table>
<div id="sgh">
</div>
	</div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                </div>
							</div>
							<!-- /.box -->
                        <!-- right col -->
                   <!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        <!-- add new calendar event modal -->
    </body>
</html>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>	
$('#cat').chosen({
no_results_text: "Oops, nothing found!",
});
</script>	
