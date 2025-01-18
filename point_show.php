<?php 
$reqlevel = 1;
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
font-weight: 900;
color:#000;
border:1px solid #37880a;

}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script type="text/javascript" src="prdcedt.js"></script>
 	<script>

	function show()
{

 var srch= document.getElementById('srch').value;
 	 var psl= document.getElementById('psl').value;
 $('#showdiv').load('point_list.php?srch='+encodeURIComponent(srch)+'&psl='+psl).fadeIn('fast');

}

function sedt(sl,fn,fv,div)
{
$("#"+div).load("pedt.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div).fadeIn('fast');
}
function edt1(sl,fn,fv,div)
{
$("#"+div).load("edtpoints.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div).fadeIn('fast');
}
</script>
	</head>
 <body onLoad="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Point View & Edit
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Point List</li>
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
                          
							
							
							
							
							
							
<HR> 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
<input type="hidden">
<center>
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td align="right" width="30%" style="padding-top:15px"> 
<font size="3">
<b>Product:</b>
</font>
</td>
<td align="left">

<select name="psl" class="form-control" size="1" id="psl" style="width:400px"   >
<option value="">--Select--</option>
<?php 
$query="Select * from main_product ORDER BY pname";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$pname=$R['pname'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $pname;?></option>
<?php 
}
?>
</select>


</td>



<td align="right" width="30%" style="padding-top:15px"> 
<font size="3">
<b>Search :</b>
</font>
</td>
<td align="left">
<input type="text" name="srch" id="srch" class="form-control" style="width:400px">

</td>
</tr>
<tr>
<td align="right" colspan="4">
<input type="button" id="Button1" name="" value="Show" class="templatemo-blue-button" onClick="show()">

</td>
</tr>


</tbody>
</table>
<div id="showdiv" class="table table-hover table-striped table-bordered" >

 </div>
	

	</div>
								</form><!-- /.box-body -->
								
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
		  $('#psl').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
</script>							
								
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