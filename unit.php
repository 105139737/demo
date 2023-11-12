<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>
        
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
	width: 250px;
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

 		



<script type="text/javascript" src="atosg_2.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosg_2.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="popup_sedtunt.js"></script>

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
$("#expdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});

});
   </script>
<script type="text/javascript">
$(document).ready(function()
{
$('#overlay').fadeOut('fast');

});


function rstunt(){
  closeOfferslDialog('boxpopup');
  document.getElementById('unm').value='';  
  document.getElementById('pun').value='';
  document.getElementById('sunt').value='';
  document.getElementById('unp').value='';  
}
function sbmunt(){

    var a=document.getElementById('unm').value;
    var b=document.getElementById('pun').value;
    var c=document.getElementById('sunt').value;
    var d=document.getElementById('unp').value;
    $('#untlst').load('adunt.php?unm='+a+'&pun='+b+'&sunt='+c+'&pup='+d).fadeIn('fast'); 
     closeOfferslDialog('boxpopup');
       document.getElementById('unm').value='';  
  document.getElementById('pun').value='';
  document.getElementById('sunt').value='';
  document.getElementById('unp').value='';  
}
</script>

	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                  Unit
                        <small>Add</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Unit</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form name="f" method="post" action="units.php">
                              
							
								



  <center>
        <div class="box box-success" >
 <table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
		
		     <tr>
            <td  align="right" style="padding-top:17px">Unit Name :</td>
            <td  align="left">
			<input type="text" class="form-control" id="unm"  name="unm" value="" size="50" placeholder="Enter Unit Name">

            </td>
       
            <td  align="right" style="padding-top:17px">Package Unit :</td>
            <td  align="left">
		<input type="text" class="form-control" id="pun"  name="pun" value="" size="50" placeholder="Enter Package Unit">

            </td>
          </tr>
		   <tr>
            <td  align="right" style="padding-top:17px">Small Unit :</td>
            <td  align="left">
		<input type="text" class="form-control" id="sunt"  name="sunt" value="" size="50" placeholder="Enter Small Unit">

            </td>
         
            <td  align="right" style="padding-top:17px">Unit/Package :</td>
            <td  align="left">
		<input type="text" class="form-control" id="unp"  name="unp" value="" size="50" placeholder="Enter Unit/Package">

            </td>
          </tr>
		  

        
      <tr>
               <td colspan="4" align="right"  style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset" >

            </td>
          </tr>
		
		  </table>


</form>


	</div>



</center>
	 
                             
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
	   </div>
</html>