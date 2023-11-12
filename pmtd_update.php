<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

$sl=base64_decode($_REQUEST[sl]);
$data= mysqli_query($conn,"select * from ac_paymtd where sl='$sl'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$mtd=$row['mtd'];
}
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
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
select.sc {
	width: 430px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
</style> 

<script>
function isNumber(evt) 
 {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 48 || iKeyCode > 57)
		{
            return false;
        }
        return true;
 }    
   
	
function check1()
{

if(document.getElementById('mtd').value=='')
{
alert("Please Enter Method !");
document.form1.mtd.focus();
return false;
}
else
{
document.forms["form1"].submit();
}
}

</script>
</head>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Payment Method
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Payment Method</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
 
                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->

<HR> 	
<form method="post" action="pmtd_updates.php" id="form1"  name="form1" onsubmit="return check1()">
<input type="hidden" name="sl" id="sl" value="<?=$sl;?>">
<center>
<div class="box box-success" >
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" width="30%">Method : </td>
<td align="left" width="50%">
<input type="text" class="form-control" id="mtd" name="mtd" value="<?=$mtd;?>" placeholder="Please Enter Method" style="width:420px">
</td>
<td align="left" align="20%">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Update">
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset">
</td>
</tr>
</table>
	 
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