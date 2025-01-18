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
 function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 48 || iKeyCode > 57)
		{
            return false;
}

        return true;
    }    
</script>

<script>


</script>
<script>
 function isNumber1(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
		{
            return false;
}

        return true;
    }    


	
function check1()
{

if(document.getElementById('cno').value=='')
{
alert("Please Enter Car No. !");
 document.getElementById('cno').focus();
return false;
}
else if(document.getElementById('dnm').value=='')
{
alert("Please Enter Driver Name !");
 document.getElementById('dnm').focus();
return false;
}
else if(document.getElementById('lno').value=='')
{
alert("Please Enter Driving license No. !");
 document.getElementById('lno').focus();
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
                Car Driver
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Car Driver</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form method="post" action="cardivers.php" id="form1"  name="form1" onsubmit="return check1()">
                              
							
								



  <center>
        <div class="box box-success" >
    <table border="0"  width="860px" class="table table-hover table-striped table-bordered" >


<tr>

<td align="right">
Car No. : </td>
<td>
	<input type="text"  list="browsers" id="cno" class="form-control" name="cno" value="" style="width:430px" tabindex="1" placeholder="Car No.">
	    
  <datalist id="browsers">
	<?php 
	$data1= mysqli_query($conn,"select * from main_dirver group by cno")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
	$cno=$row1['cno'];
	?>
  <option value="<?php  echo $cno;?>"/>
<?php 
}
?>

  </datalist>
  </td>
<td align="right">
Car Details : </td>
<td>
<input type="text" class="form-control" id="cdet"  name="cdet" value="" placeholder="Please Enter Car Details" style="width:430px">
</td>
</tr>
<tr>
<td align="right">
Driver Name : 
</td>
<td>
<input type="text" class="form-control" id="dnm"  name="dnm" value="" placeholder="Please Enter Driver Name" style="width:430px">
</td>

<td align="right">
Address :</td>
<td >
<input type="text" class="form-control" id="addr"  name="addr" value="" placeholder="Please Enter Address" style="width:430px">
</td>
</tr>
<tr>
<td align="right">
Mobile No. 1 :</td>
<td>
<input type="text" class="form-control" id="mob1" name="mob1" value="" placeholder="Please Enter Mobile No." style="width:430px" maxlength="11" onkeypress="return isNumber(event)">
</td>
<td align="right">
Mobile No. 2 :
</td>

<td>
<input type="text" class="form-control" id="mob2" name="mob2" value="" placeholder="Please Enter Mobile /Land Line No."  style="width:430px" maxlength="11" onkeypress="return isNumber(event)">
</td>
</tr>

<tr>
<td align="right">
Driving license No. :</td>
<td>
<input type="text" class="form-control" id="lno" name="lno" value="" placeholder="Please Enter Driving license No." style="width:430px">
</td>
<td align="right">
License Type :
</td>

<td>
<input type="text" class="form-control" id="ltyp" name="ltyp" value="" placeholder="Please Enter License Type "  style="width:430px" >
</td>
</tr>


<tr>
<td colspan="4" align="right"  style="padding-right: 100px;">
<input type="submit" class="btn btn-success " id="Button1" name="" value="Submit">
<input type="reset" class="btn btn-danger" id="Button2" name="" value="Reset">
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