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
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 450px;
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
<script type="text/javascript" src="light3.js" ></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="popup_sedtunt.js"></script>

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
$("#expdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

});

 </script>

   
      <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{

   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   
   $("#expdt").datepicker(jQueryDatePicker2Opts);
   });

   </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

   

	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Free Product
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Free Product</li>
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
                          
 	<form name="f" method="post" action="free_pents.php">
     <center>
        <div class="box box-success" >
		
 <table border="0"  class="table table-hover table-striped table-bordered" >
		
		     <tr>
            <td  align="right" style="padding-top:17px"><b>Category :</b></td>
            <td  align="left">
		<select name="cat" class="form-control" size="1" id="cat" tabindex="8"  required>
				<Option value="">---Select---</option>
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
       
            <td  align="right" style="padding-top:17px"><b>Brand Name :</b></td>
            <td  align="left">
		<select name="bnm" class="form-control" size="1" id="bnm" tabindex="8"  required>
				<Option value="">---Select---</option>
<?php 

$data2 = mysqli_query($conn,"Select * from main_brand order by brand");

		while ($row1 = mysqli_fetch_array($data2))
	{
	$sl=$row1['sl'];
	$brand=$row1['brand'];
	echo "<option value='".$sl."'>".$brand."</option>";
	}
	
 

?>
</select>
            </td>
          </tr>
		   <tr>
			 <td  align="right" style="padding-top:17px"><b>Product Name :</b></td>
            <td  align="left">
			<input type="text" class="form-control" id="pnm"  name="pnm" value="" size="50" placeholder="Product Name... "  required>
			</td>
			

 <td colspan="2" align="center" >
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset" >

            </td>
          </tr>
		
		  </table>

</div> 
</form>

</center>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>
</html>