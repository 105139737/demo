<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
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
function check1()
{

						if(document.getElementById('Editbox11').value=='')
						{
							alert("Please Enter Shop Keeper Name");
							document.getElementById('Editbox11').focus();
							return false;
						}
						if(document.getElementById('Editbox2').value=='')
						{
							alert("Please Enter Address");
							document.getElementById('Editbox2').focus();
							return false;
						}
						if(document.getElementById('Editbox3').value=='')
						{
							alert("Please Enter Mobile1");
							document.getElementById('Editbox3').focus();
							return false;
						}
						if(document.getElementById('Editbox5').value=='')
						{
							alert("Please Enter Email");
							document.getElementById('Editbox5').focus();
							return false;
						}
						if(document.getElementById('Editbox6').value=='')
						{
							alert("Please Enter Balance");
							document.getElementById('Editbox6').focus();
							return false;
						}
						
							else
								{
								document.forms["form1"].submit();
								}
}
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





</script>

		

 </script>

	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Customer
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Customer</li>
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
                          
							
							
							
							
							
							
	<HR> 	<form method="post" action="centrys.php" name="form1" onsubmit="return check1()" id="form1">
                              
							
								



  <center>
        <div class="box box-success" >
   <table border="0"  width="860px" class="table table-hover table-striped table-bordered">

   

<tr><td align="right">
Name : </td>
<td>
<input type="text" class="form-control" id="Editbox11"  name="cnm" value="" placeholder="Please Enter Customer Name" style="width:430px" ></td>


<td align="right">
Address : 
</td>
<td>
<input type="text" class="form-control" id="Editbox2"  name="addr" value="" placeholder="Customer Address" style="width:430px">
</td>
</tr>
<tr>
<td align="right">
Mobile No. 1 :</td>
<td>
<input type="text" class="form-control" id="Editbox3" name="mob1" value="" placeholder="Enter Mobile No."  maxlength="10" onkeypress="return isNumber(event)" style="width:430px">
</td>
<td align="right">
Mobile No. 2 :</td>

<td>
<input type="text" class="form-control" id="Editbox4" name="mob2" value="" placeholder="Enter Mobile /Land Line No."   maxlength="10" onkeypress="return isNumber(event)" style="width:430px">
</td>
</tr>



<tr>
<td align="right">
E-Mail ID :</td>
<td>
<input type="text" class="form-control" id="Editbox5"  name="eml" value="" placeholder="Please Enter Customer E-Mail" style="width:430px"
</td>
<td align="right">
Balance :</td>
<td>
<input type="text" class="form-control" id="Editbox6" name="bal" value="" placeholder="Please Enter Previous Balance" style="width:430px" onkeypress="return isNumber1(event)" >
</td>
</tr>
<tr>
<td align="right">
Branch Name:
</td>
<td>
<select name="from"  id="from" class="sc" >

<?
if ($user_current_level < 0)
{
?>
<?
$query="Select * from main_branch";

   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
<?	
}
else
{
?>
<option value="<? echo $branch_sl;?>"><? echo $branch_nm;?></option>
<?
}
?>
</select>
</td>
</tr>
<tr>
<td colspan="4" align="right"  style="padding-right: 20px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit">
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset"></td>
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