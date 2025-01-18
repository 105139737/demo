<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

$sl=$_REQUEST['ssl'];

$get=mysqli_query($conn,"select * from main_gst where sl='$sl'") or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($get);
while($row=mysqli_fetch_array($get))
{
	$sgst=$row['sgst'];
	$cgst=$row['cgst'];
	$igst=$row['igst'];
}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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
</style> 
<script>
 function get_list()
{
	$('#div_list').load("gst_list.php").fadeIn('fast');
}
</script>

	
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    GST
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">GST</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   
<div class="box box-success">
<form method="post" action="gsts.php" id="form1" onSubmit="return check1()" name="form1">
<input type="hidden" name="sl" id="sl" value="<?php echo $sl;?>">
<table border="0" width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:right;padding-top:15px;"><b>S-GST :</b></td>
<td style="text-align:left;">
<input type="text" class="form-control" name="sgst" id="sgst" value="<?php echo $sgst;?>" size="20" placeholder="Enter SGST">
</td>

<td style="text-align:right;padding-top:15px;"><b>C-GST :</b></td>
<td style="text-align:left;">
<input type="text" class="form-control" name="cgst" id="cgst" value="<?php echo $cgst;?>" size="20" placeholder="Enter CGST">
</td>

<td style="text-align:right;padding-top:15px;"><b>I-GST :</b></td>
<td style="text-align:left;">
<input type="text" class="form-control" name="igst" id="igst" value="<?php echo $igst;?>" size="20" placeholder="Enter IGST">
</td>
<td style="text-align:left; padding-right:8px;">
<input type="submit" value="Update" class="btn btn-primary" name="B1">
</td>
</tr>
</table>
</form>

</div>
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