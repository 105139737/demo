<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST['sl'];
$get=mysqli_query($conn,"select * from main_prod_prc_pdf where sl='$sl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$title=$row['title'];
	$path=$row['path'];
	$typ=$row['typ'];
	$catsl=$row['cat'];
}
$cy=date('Y');
?> 
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
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



	</head>
 <body>
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
<input type="hidden" name="sl" id="sl" value="<?php echo $sl;?>">

 <div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>

<td align="left"  colspan="3">
<iframe src="<?=$path;?>" style="width:100%; height:100px;" frameborder="0"></iframe>
</td>
</tr>
<tr>
<td  align="left"><font color="red">*</font><b>Brand :</b><br/>
<select name="cat" class="form-control" size="1" id="cat"  style="width:300px;">
<?
$data1 = mysqli_query($conn,"Select * from main_catg where sl>0 and find_in_set(sl,'$catsl')>0 order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
?>
<Option value="<?=$sl;?>" selected ><?=$cnm;?></option>
	<?
	}
$data2 = mysqli_query($conn,"Select * from main_catg where sl>0 and find_in_set(sl,'$catsl')=0 order by cnm");
while ($row1 = mysqli_fetch_array($data2))
{
$sl31=$row1['sl'];
$cnm1=$row1['cnm'];
?>
<option value="<?=$sl31;?>"><?=$cnm1;?></option>
<?
}?>	
</select>
</td>
<td  align="left"><font color="red">*</font><b>Type :</b>
<select name="typ" class="form-control" size="1" id="typ" >
<Option value="">---Select---</option>
<?
$data11 = mysqli_query($conn,"Select * from main_cus_typ");
while ($row11 = mysqli_fetch_array($data11))
{
$tpsl=$row11['sl'];
$tp=$row11['tp'];
if($typ==$tpsl){$slct="selected";}
?>
<option value="<?php echo $tpsl;?>" <? if ($tpsl==$typ){?> selected <? } ?>><?php echo $tp;?></option>
<?
}
?>
</select>
</td>
<td align="left" width="25%" >
<b>Title:</b>
<input type="text" name="ttl" id="ttl" class="form-control" value="<?php echo $title;?>">
</td>
<td align="left" width="25%" >
<label>
<input type="file" name="fileToUpload" id="fileToUpload" class="btn btn-info" accept=".pdf" style="width:100%">
<font color="red"> Choose the '.pdf' file to Upload</font>
</label>
</td>

<td  align="left">
<input type="submit" value=" Update " class="btn btn-success" >
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
	     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#cat').chosen({no_results_text: "Oops, nothing found!",});	
</script>
</html>
</html>