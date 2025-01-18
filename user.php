<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$m=date('m');
$y=date('y');
if($m>3)
{
$yy="G&co/".$y."-".($y+1)."/";	
	
}
elseif($m<3)
{
$yy="G&co/".($y-1)."-".$y."/";	
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


a{
cursor:pointer;
}
</style> 
 <script>
 		

 function check1()
{

	  

 if(document.form1.nm.value=='')
{

alert("Please Enter User Name !");
		
document.form1.nm.focus();
 return false;
	  }
 if(document.form1.mob.value=='')
{

alert("Please Enter Mobile No. !");
		
document.form1.mob.focus();
 return false;
	  }

 if(document.form1.addr.value=='')
{

alert("Please Enter  Address !");
		
document.form1.addr.focus();
 return false;
	  }
else
{
 document.forms["form1"].submit();
}

}
		

 </script>

	
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   <font > New User</font>
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"><i class="fa fa-user"></i> New User</li>
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
                          
 	<form method="post" action="users.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								



  <center>
        <div class="box box-success" >
		
        <table border="0"  width="800px"  align="center" class="table table-hover table-striped table-bordered">
	
          <tr>
            <td align="right" >Username :</td>
            <td align="left" >
            <input type="text" class="form-control" name="username" id="username" size="20" placeholder="Enter Username ..." ></td>
			
			   <td align="right" ></td>
            <td align="left" >
            </td>

          </tr> 
    
		
          <tr>
            <td align="right" >Name :</td>
            <td align="left" >
            <input type="text" class="form-control" name="nm" id="nm" size="20" placeholder="Enter User Name" ></td>
         
         
            <td align="right" >Mobile :</td>
            <td align="left" >
            <input type="text" name="mob" id="mob" class="form-control" value="" size="20" placeholder="Enter Mobile"></td>
          </tr>
     <tr>
            <td align="right" >E-Mail :</td>
            <td align="left" >
            <input type="text" name="email" id="email" class="form-control" size="20" placeholder="Enter E-Mail"></td>
     
            <td align="right" >
			Address :
			</td>
            <td align="left" >
			       <input type="text" name="addr" id="addr" class="form-control" size="20" placeholder="Enter Address"></td>
     
			</tr>
			  <tr>
            <td align="right" >Branch :</td>
            <td align="left" >
    <select name="brncd" class="form-control" size="1" id="brncd"   >
<?php 
$query="Select * from main_branch";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
	
            <td align="right" >
		Designation :
			</td>
            <td align="left" >
<select name="userlevel" class="form-control" size="1" id="userlevel"   >
<?php 
$query1="Select * from main_deg";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$sl1=$R1['lvl'];
$deg=$R1['deg'];
?>
<option value="<?php  echo $sl1;?>"><?php  echo $deg;?></option>
<?php 
}
?>
</select>
</td>
     
			</tr>
		
		
		  <tr >

            <td colspan="4" align="right"  style="padding-right: 8px;">
             <input type="submit" value="Submit" class="btn btn-success" name="B1">
			  <input type="reset" class="btn btn-danger" value="Reset" name="B2">
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