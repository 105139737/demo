<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST['sl'];
$data= mysqli_query($conn,"select * from   main_stock where sl='$sl'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{

$expdt=$row['expdt'];
$betno=$row['betno'];
$pcd=$row['pcd'];
$x=$row['sl'];
}
if($expdt!="0000-00-00")
{
$expdt=date('d-m-Y', strtotime($expdt));
}
$data1= mysqli_query($conn,"select * from main_product where sl='$pcd'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$pname=$row1['pname'];

}

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

#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
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

document.form1.ops.focus();

});

function get(cat,tech,csl)
{
	document.getElementById('cat').value=cat;
	document.getElementById('tech').value=tech;
	document.getElementById('csl').value=csl;
	clr();
}
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
   
     function scat4(cat)
   {
	  $('#scat').load('scat.php?cat='+encodeURIComponent(cat)).fadeIn('fast');  
	 
   }
   </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

	</head>
 <body  onclick="clr()">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    Batch No./Expiry Date
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                   <li class="active">
						<a href="prod_show.php"><i class="fa fa-list"></i>Batch No./Expiry Date</a></li>
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
                	<form name="form1" id="form1" method="post" action="beth_edits.php">
                              
							
								
<input type="hidden" value="<?php  echo $sl;?>" name="sl" id="sl">


  <center>
        <div class="box box-success" >
		<input type="hidden" name="csl" id="csl" value="<?php  echo $csl;?>">
		<table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
		
		     <tr>
               
            <td  align="right" style="padding-top:17px">Product Name :</td>
            <td  align="left">
		<input type="text" class="form-control" id="Editbox2"  name="pnm" value="<?php  echo $pname;?>" size="50" placeholder="Enter Product Name">

            </td>
			  <td  align="right" style="padding-top:17px"></td>
            <td  align="left">

            </td>
          </tr>
	
		  		<tr>

        
            <td  align="right" style="padding-top:17px">Batch No. :</td>
            <td  align="left">
<input type="text" class="form-control" id="betno"  name="betno" value="<?php  echo $betno;?>" size="50" placeholder="Enter Batch No.">

            </td>
			            <td  align="right" style="padding-top:17px">Expiry Date :</td>
            <td  align="left">
<input type="text" class="form-control" id="expdt"  name="expdt" value="<?php  echo $expdt;?>" size="50" placeholder="Enter Expiry Date">

            </td>
          </tr>
		  <tr>

        
      
               <td colspan="4" align="right"  style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset" >

            </td>
          </tr>
		
		  </table>
		
<div id='sfdtl' align='center'>
Loding.....<br>
<img src="images/loading.gif">



	</div>

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