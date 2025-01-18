<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST['sl'];
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

 $data= mysqli_query($conn,"select * from main_signup where  sl='$sl'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
	$x=$row['sl'];
$username=$row['username'];
$password=$row['password'];
$name=$row['name'];
$brncd=$row['brncd'];
$mob=$row['mob'];
$addr=$row['addr'];
$mailadres=$row['mailadres'];
$actnum=$row['actnum'];
$userlevel=$row['userlevel'];
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
                <section class="skin-black" style="background-color:#333333;">
                    <h1 align="center">
                   <font color="#FFF"> User Update</font>
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
						 <li><a href="user_show.php"><i class="fa fa-users"></i> User List</a></li>
                        <li class="active"><i class="fa fa-pencil-square-o"></i>User Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   
                          
 	<form method="post" action="user_edts.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								



  <center>
        <div class="box box-success" >
		
        <table border="0"  width="800px"  align="center" class="table table-hover table-striped table-bordered">
	
        
    <input type="hidden" value="<?php  echo $sl;?>" name="sl" id="sl">    <input type="hidden" value="<?php  echo $username;?>" name="sid" id="sid">
		
          <tr>
            <td align="right" >Name :</td>
            <td align="left" >
            <input type="text" class="form-control" name="nm" id="nm" value="<?php  echo $name;?>" size="20" placeholder="Enter User Name" ></td>
         
         
            <td align="right" >Mobile :</td>
            <td align="left" >
            <input type="text" name="mob" id="mob" class="form-control" value="<?php  echo $mob;?>" size="20" placeholder="Enter Mobile"></td>
          </tr>
     <tr>
            <td align="right" >E-Mail :</td>
            <td align="left" >
            <input type="text" name="email" id="email" class="form-control" value="<?php  echo $mailadres;?>" size="20" placeholder="Enter E-Mail"></td>
     
            <td align="right" >
			Address :
			</td>
            <td align="left" >
			       <input type="text" name="addr" id="addr" value="<?php  echo $addr;?>" class="form-control" size="20" placeholder="Enter Address"></td>
     
			</tr>
<tr>
<td align="right">Branch:</td>
<td align="left">
<select name="brncd" class="form-control" size="1" id="brncd">
<?php 
$query="Select * from main_branch";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
	$sl=$R['sl'];
	$bnm=$R['bnm'];
	?>
	<option value="<?php  echo $sl;?>"<?php  echo $brncd==$sl ? 'selected' : ''?>><?php  echo $bnm;?></option>
	<?php 
}
?>
</select>

<td align="right" >Designation :</td>
<td align="left">
<select name="userlevel" class="form-control" size="1" id="userlevel"   >
<?php 
$query1="Select * from main_deg";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$sl1=$R1['lvl'];
$deg=$R1['deg'];
?>
<option value="<?php  echo $sl1;?>"<?php  echo $userlevel==$sl1 ? 'selected' : ''?>><?php  echo $deg;?></option>
<?php 
}
?>
</select>
</td>
</tr>
		
		
		  <tr >

            <td colspan="4" align="right"  style="padding-right: 8px;">
             <input type="submit" value="Update" class="btn btn-success" name="B1">
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