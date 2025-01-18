<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

echo $sl=$_REQUEST['sl'];
	$q=mysqli_query($conn,"select * from main_cus_typ where sl='$sl'")or die(mysqli_error($conn));
	while($r=mysqli_fetch_array($q))
	{
		$tp=$r['tp'];
	}
	
?>
<html>
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
   function check()
   {
		if(document.form1.cat.value=='')
			{

	     alert("Please Enter Category ?");

		document.form1.cat.focus();
	return false;
			}
				else  
			{


		document.forms["form1"].submit();


				
			}  
   }
		   </script>	
  <aside class="right-side">
		    <section class="content-header">
                   
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Customer Entry</li>
                    </ol>
                </section> 
				   <section class="content">
		
	<form method="post" action="cus_edts.php" id="form1" onSubmit="return check1()" name="form1">

<div class="row">
<div class="col-md-0" >
</div>
	 <div class="col-md-12" >
              <div class="box box-myclass box-solid" >
                <div class="box-header with-border" >
                  <h3 class="box-title"> Customer Entry</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
				<div class="box-header ">                          
<form name="form1" id="form1" method="post" action="cus_edts.php" onsubmit="return check()">
 <table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
		
		     <tr>
            <td  align="right" ><b>Customer Type :</b></td>
            <td  align="left">
			<input type="text" class="form-control" id="tp"  name="tp" size="50" value="<?php  echo $tp;?>">
			<input type="hidden" class="form-control" id="sl"  name="sl" size="50" value="<?php  echo $sl;?>">

            </td>
               <td colspan="2" align="left"  style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Update" >

            </td>
          </tr>
		
		  </table>
   </div>
		</div>
 </div><!-- /.box-body -->
              </div><!-- /.box -->
</form>
            </div><!-- /.col -->
			<div class="col-md-3" >
</div>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</div>
    </body>
</html>




