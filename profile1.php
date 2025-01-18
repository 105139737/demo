<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$sa=date('Y-m-d');
$saa=date('Y-m')."-"."01";
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
</style> 

 		












<script>

	function show1()
{

 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
if(document.getElementById('fdt').value=='')
						{
							alert("Please Enter From Date");
							document.getElementById('fdt').focus();
							return false;
						}
						if(document.getElementById('tdt').value=='')
						{
							alert("Please Enter To Date");
							document.getElementById('tdt').focus();
							return false;
						}
						else
						{
 $('#data1').load('dpbills.php?fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}
}

function view(blno)
{

document.location = 'billnew.php?blno='+blno;


}



</script>

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
$("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
$("#tdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
   </script>
	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Duplicate Bill
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Duplicate Bill</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form method="post" action="dpbills.php" name="form1" onsubmit="return check1()" id="form1">
                              
							
								



  <center>
        <div class="box box-success" >
     <table border="0" width="860px" class="table table-hover table-striped table-bordered">
<thead>
<tr style="background-color:#2396d6;" >
<td>Form Date &nbsp &nbsp: &nbsp &nbsp <input type="text" id="fdt" name="fdt" size="40" value="<?php echo $saa;?>" placeholder="Please Enter From Date" > </td>
<td>To Date &nbsp &nbsp: &nbsp &nbsp
<input type="text" id="tdt" name="tdt" size="40" value="<?php echo $sa;?>" placeholder="Please Enter To Date"></td>


</tr>
</thead>
<tr>
<td align="right" colspan="4">
<input type="button" class="btn btn-primary" value="Show" onclick="show1()"></td>
</tr>


</table>
<div id="data1">
</div>
	 
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