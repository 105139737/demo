<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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

 		




	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Point
                        <small>Add</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Point</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form name="f" method="post" action="point_ntrys.php">
                              
							
								



  <center>
        <div class="box box-success" >
 <table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
		
		     <tr>
            <td  align="right" style="padding-top:17px">Product Name :</td>
            <td  align="left">
			<select name="psl" id="psl" class="form-control" onChange="get_pack(this.value)" >
          <option value="">---Select---</option>
<?php 

	
$q1="SELECT * FROM main_product ORDER BY pname";
$r1= mysqli_query($conn,$q1) or die (mysqli_error($conn));
while ($M=mysqli_fetch_array($r1))
{
	$pname=$M['pname'];
	$sl=$M['sl'];
	
	$q11="SELECT * FROM main_point where pcd='$sl'";
	$r11= mysqli_query($conn,$q11) or die (mysqli_error($conn));
	$oi=mysqli_num_rows($r11);
if($oi==0)
{
	?>
	<option value="<?php  echo $sl;?>"><?php  echo $pname;?></option>
	<?php 

}
}
     ?>
</select>
          </tr>
          <tr>
            </td>
       
            <td  align="right" style="padding-top:17px">Pack:</td>
            <td  align="left">
		<input type="text" class="form-control" id="pack"  name="pack" value="" size="50" readonly>

            </td>
          </tr>
          <tr>
            <td  align="right" style="padding-top:17px">Point:</td>
            <td  align="left">
		<input type="text" class="form-control" id="point"  name="point" value="">

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

     
     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
		  $('#psl').chosen({
  no_results_text: "Oops, nothing found!",

  });

function get_pack(psl)
{
	$.get('get_pack.php?psl='+psl, function(data) 
	{
		$('#pack').val(data);
	});
}
</script>
    </body>
	   </div>
</html>