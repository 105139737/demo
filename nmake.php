<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
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

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
select.sc1 {
	width: 300px;
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
<script type="text/javascript" src="validate.js"></script>
<script type="text/javascript" src="prdcedt.js"></script>

	
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                  Manufacturing Company
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Account Group </li>
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
                          
							
							
							
							
	<body onload="makes('','')">						
							
					<HR> 	<form method="post" action="#" id="form1"  name="form1">
                              
							
								



  <center>
        <div class="box box-success" style="width:900px" >
        <table border="0"   align="center" class="table table-hover table-striped table-bordered">
	
        
    
		
          <tr>
            <td align="right" style="padding-top:15px" >Primary :</td>
            <td align="left" >
                  <select name="tp" id="tp"  size="1" class="sc1">
<?php 
$query3 = "SELECT * FROM ".$DBprefix."primary";
   $result3 = mysqli_query($conn,$query3);
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['sl'];
$y=$R['nm'];
?>
<option value="<?php  echo $x;?>"><?php  echo $y;?></option>
<?php 
}
?>
</select>
    </td>     
            <td align="right" style="padding-top:15px" >New Group :</td>
            <td align="left" >
           
			<input type="text" name="sn" id="sn" class="form-control" size="30">
			</td>
          </tr>
   		
		
		  <tr >

            <td colspan="4" align="right"  style="padding-right: 8px;">
             <input type="button" value="Submit" onclick="makes('','')" class="btn btn-primary" name="B1">
			  <input type="reset" class="btn btn-primary" value="Reset" name="B2">
			  </td>
          </tr>
		  

          </table>
	 
                                </div>
								<div class="box box-success" style="width:900px"  >
								<div id="sdtl">
								
								</div>
								</div>
								<input type="hidden" id="edtbx"/>
								</form><!-- /.box-body -->.
								    </body>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            </div>
							
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     


</html>