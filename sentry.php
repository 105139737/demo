<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
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

if(document.getElementById('spnm').value=='')
{
alert("Please Enter Shop/Company !");
document.form1.spnm.focus();
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
                Supplier
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Supplier</li>
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
<form method="post" action="sentrys.php" id="form1"  name="form1" onsubmit="return check1()">
<center>
<div class="box box-success" >
<table border="0"  width="860px" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right">Shop/Company : </td>
<td>
<input type="text" class="form-control" id="spnm" name="spnm" value="" placeholder="Please Enter Shop Name" style="width:420px">
</td>
<td align="right">Contact Person : </td>
<td>
<input type="text" class="form-control" id="cprsn"  name="cprsn" value="" placeholder="Please Enter Contact Person" style="width:420px">
</td>
</tr>
<tr>
<td align="right">Address : </td>
<td>
<input type="text" class="form-control" id="addr"  name="addr" value="" placeholder=" Address" style="width:420px">
</td>
<td align="right">E-Mail ID :</td>
<td >
<input type="text" class="form-control" id="email"  name="email" value="" placeholder="Please Enter  E-Mail" style="width:420px">
</td>
</tr>
<tr>
<td align="right">Mobile No. 1 :</td>
<td>
<input type="text" class="form-control" id="mob1" name="mob1" onkeypress="return isNumber(event)" maxlength="10" minlength="10" placeholder="Enter Mobile No." style="width:420px">
</td>
<td align="right">Mobile No. 2 :</td>
<td>
<input type="text" class="form-control" id="mob2" name="mob2" onkeypress="return isNumber(event)" maxlength="10" minlength="10" placeholder="Enter Mobile No."  style="width:420px">
</td>
</tr>

<tr>
<td colspan="4" align="right"  style="padding-right: 8px;">
<input type="submit" class="btn btn-success" id="Button1" name="" value="Submit">
<input type="reset" class="btn btn-warning" id="Button2" name="" value="Reset">
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